<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\console\controllers;

use Yii;
use yii\base\BaseObject;
use yii\base\InvalidConfigException;
use yii\base\NotSupportedException;
use yii\console\Controller;
use yii\console\Exception;
use yii\console\ExitCode;
use yii\db\MigrationInterface;
use yii\helpers\Console;
use yii\helpers\FileHelper;
use yii\helpers\Inflector;

/**
 * BaseMigrateController is the base class for migrate controllers.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
abstract class BaseMigrateController extends Controller
{
    /**
     * The name of the dummy databasemigration that marks the beginning of the whole databasemigration history.
     */
    const BASE_MIGRATION = 'm000000_000000_base';

    /**
     * @var string the default command action.
     */
    public $defaultAction = 'up';
    /**
     * @var string|array the directory containing the databasemigration classes. This can be either
     * a [path alias](guide:concept-aliases) or a directory path.
     *
     * Migration classes located at this path should be declared without a namespace.
     * Use [[databasemigrationNamespaces]] property in case you are using namespaced databasemigrations.
     *
     * If you have set up [[databasemigrationNamespaces]], you may set this field to `null` in order
     * to disable usage of databasemigrations that are not namespaced.
     *
     * Since version 2.0.12 you may also specify an array of databasemigration paths that should be searched for
     * databasemigrations to load. This is mainly useful to support old extensions that provide databasemigrations
     * without namespace and to adopt the new feature of namespaced databasemigrations while keeping existing databasemigrations.
     *
     * In general, to load databasemigrations from different locations, [[databasemigrationNamespaces]] is the preferable solution
     * as the databasemigration name contains the origin of the databasemigration in the history, which is not the case when
     * using multiple databasemigration paths.
     *
     * @see $databasemigrationNamespaces
     */
    public $databasemigrationPath = ['@app/databasemigrations'];
    /**
     * @var array list of namespaces containing the databasemigration classes.
     *
     * Migration namespaces should be resolvable as a [path alias](guide:concept-aliases) if prefixed with `@`, e.g. if you specify
     * the namespace `app\databasemigrations`, the code `Yii::getAlias('@app/databasemigrations')` should be able to return
     * the file path to the directory this namespace refers to.
     * This corresponds with the [autoloading conventions](guide:concept-autoloading) of Yii.
     *
     * For example:
     *
     * ```php
     * [
     *     'app\databasemigrations',
     *     'some\extension\databasemigrations',
     * ]
     * ```
     *
     * @since 2.0.10
     * @see $databasemigrationPath
     */
    public $databasemigrationNamespaces = [];
    /**
     * @var string the template file for generating new databasemigrations.
     * This can be either a [path alias](guide:concept-aliases) (e.g. "@app/databasemigrations/template.php")
     * or a file path.
     */
    public $templateFile;
    /**
     * @var bool indicates whether the console output should be compacted.
     * If this is set to true, the individual commands ran within the databasemigration will not be output to the console.
     * Default is false, in other words the output is fully verbose by default.
     * @since 2.0.13
     */
    public $compact = false;


    /**
     * {@inheritdoc}
     */
    public function options($actionID)
    {
        return array_merge(
            parent::options($actionID),
            ['databasemigrationPath', 'databasemigrationNamespaces', 'compact'], // global for all actions
            $actionID === 'create' ? ['templateFile'] : [] // action create
        );
    }

    /**
     * This method is invoked right before an action is to be executed (after all possible filters.)
     * It checks the existence of the [[databasemigrationPath]].
     * @param \yii\base\Action $action the action to be executed.
     * @throws InvalidConfigException if directory specified in databasemigrationPath doesn't exist and action isn't "create".
     * @return bool whether the action should continue to be executed.
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (empty($this->databasemigrationNamespaces) && empty($this->databasemigrationPath)) {
                throw new InvalidConfigException('At least one of `databasemigrationPath` or `databasemigrationNamespaces` should be specified.');
            }

            foreach ($this->databasemigrationNamespaces as $key => $value) {
                $this->databasemigrationNamespaces[$key] = trim($value, '\\');
            }

            if (is_array($this->databasemigrationPath)) {
                foreach ($this->databasemigrationPath as $i => $path) {
                    $this->databasemigrationPath[$i] = Yii::getAlias($path);
                }
            } elseif ($this->databasemigrationPath !== null) {
                $path = Yii::getAlias($this->databasemigrationPath);
                if (!is_dir($path)) {
                    if ($action->id !== 'create') {
                        throw new InvalidConfigException("Migration failed. Directory specified in databasemigrationPath doesn't exist: {$this->databasemigrationPath}");
                    }
                    FileHelper::createDirectory($path);
                }
                $this->databasemigrationPath = $path;
            }

            $version = Yii::getVersion();
            $this->stdout("Yii Migration Tool (based on Yii v{$version})\n\n");

            return true;
        }

        return false;
    }

    /**
     * Upgrades the application by applying new databasemigrations.
     *
     * For example,
     *
     * ```
     * yii migrate     # apply all new databasemigrations
     * yii migrate 3   # apply the first 3 new databasemigrations
     * ```
     *
     * @param int $limit the number of new databasemigrations to be applied. If 0, it means
     * applying all available new databasemigrations.
     *
     * @return int the status of the action execution. 0 means normal, other values mean abnormal.
     */
    public function actionUp($limit = 0)
    {
        $databasemigrations = $this->getNewMigrations();
        if (empty($databasemigrations)) {
            $this->stdout("No new databasemigrations found. Your system is up-to-date.\n", Console::FG_GREEN);

            return ExitCode::OK;
        }

        $total = count($databasemigrations);
        $limit = (int) $limit;
        if ($limit > 0) {
            $databasemigrations = array_slice($databasemigrations, 0, $limit);
        }

        $n = count($databasemigrations);
        if ($n === $total) {
            $this->stdout("Total $n new " . ($n === 1 ? 'databasemigration' : 'databasemigrations') . " to be applied:\n", Console::FG_YELLOW);
        } else {
            $this->stdout("Total $n out of $total new " . ($total === 1 ? 'databasemigration' : 'databasemigrations') . " to be applied:\n", Console::FG_YELLOW);
        }

        foreach ($databasemigrations as $databasemigration) {
            $nameLimit = $this->getMigrationNameLimit();
            if ($nameLimit !== null && strlen($databasemigration) > $nameLimit) {
                $this->stdout("\nThe databasemigration name '$databasemigration' is too long. Its not possible to apply this databasemigration.\n", Console::FG_RED);
                return ExitCode::UNSPECIFIED_ERROR;
            }
            $this->stdout("\t$databasemigration\n");
        }
        $this->stdout("\n");

        $applied = 0;
        if ($this->confirm('Apply the above ' . ($n === 1 ? 'databasemigration' : 'databasemigrations') . '?')) {
            foreach ($databasemigrations as $databasemigration) {
                if (!$this->migrateUp($databasemigration)) {
                    $this->stdout("\n$applied from $n " . ($applied === 1 ? 'databasemigration was' : 'databasemigrations were') . " applied.\n", Console::FG_RED);
                    $this->stdout("\nMigration failed. The rest of the databasemigrations are canceled.\n", Console::FG_RED);

                    return ExitCode::UNSPECIFIED_ERROR;
                }
                $applied++;
            }

            $this->stdout("\n$n " . ($n === 1 ? 'databasemigration was' : 'databasemigrations were') . " applied.\n", Console::FG_GREEN);
            $this->stdout("\nMigrated up successfully.\n", Console::FG_GREEN);
        }
    }

    /**
     * Downgrades the application by reverting old databasemigrations.
     *
     * For example,
     *
     * ```
     * yii migrate/down     # revert the last databasemigration
     * yii migrate/down 3   # revert the last 3 databasemigrations
     * yii migrate/down all # revert all databasemigrations
     * ```
     *
     * @param int|string $limit the number of databasemigrations to be reverted. Defaults to 1,
     * meaning the last applied databasemigration will be reverted. When value is "all", all databasemigrations will be reverted.
     * @throws Exception if the number of the steps specified is less than 1.
     *
     * @return int the status of the action execution. 0 means normal, other values mean abnormal.
     */
    public function actionDown($limit = 1)
    {
        if ($limit === 'all') {
            $limit = null;
        } else {
            $limit = (int) $limit;
            if ($limit < 1) {
                throw new Exception('The step argument must be greater than 0.');
            }
        }

        $databasemigrations = $this->getMigrationHistory($limit);

        if (empty($databasemigrations)) {
            $this->stdout("No databasemigration has been done before.\n", Console::FG_YELLOW);

            return ExitCode::OK;
        }

        $databasemigrations = array_keys($databasemigrations);

        $n = count($databasemigrations);
        $this->stdout("Total $n " . ($n === 1 ? 'databasemigration' : 'databasemigrations') . " to be reverted:\n", Console::FG_YELLOW);
        foreach ($databasemigrations as $databasemigration) {
            $this->stdout("\t$databasemigration\n");
        }
        $this->stdout("\n");

        $reverted = 0;
        if ($this->confirm('Revert the above ' . ($n === 1 ? 'databasemigration' : 'databasemigrations') . '?')) {
            foreach ($databasemigrations as $databasemigration) {
                if (!$this->migrateDown($databasemigration)) {
                    $this->stdout("\n$reverted from $n " . ($reverted === 1 ? 'databasemigration was' : 'databasemigrations were') . " reverted.\n", Console::FG_RED);
                    $this->stdout("\nMigration failed. The rest of the databasemigrations are canceled.\n", Console::FG_RED);

                    return ExitCode::UNSPECIFIED_ERROR;
                }
                $reverted++;
            }
            $this->stdout("\n$n " . ($n === 1 ? 'databasemigration was' : 'databasemigrations were') . " reverted.\n", Console::FG_GREEN);
            $this->stdout("\nMigrated down successfully.\n", Console::FG_GREEN);
        }
    }

    /**
     * Redoes the last few databasemigrations.
     *
     * This command will first revert the specified databasemigrations, and then apply
     * them again. For example,
     *
     * ```
     * yii migrate/redo     # redo the last applied databasemigration
     * yii migrate/redo 3   # redo the last 3 applied databasemigrations
     * yii migrate/redo all # redo all databasemigrations
     * ```
     *
     * @param int|string $limit the number of databasemigrations to be redone. Defaults to 1,
     * meaning the last applied databasemigration will be redone. When equals "all", all databasemigrations will be redone.
     * @throws Exception if the number of the steps specified is less than 1.
     *
     * @return int the status of the action execution. 0 means normal, other values mean abnormal.
     */
    public function actionRedo($limit = 1)
    {
        if ($limit === 'all') {
            $limit = null;
        } else {
            $limit = (int) $limit;
            if ($limit < 1) {
                throw new Exception('The step argument must be greater than 0.');
            }
        }

        $databasemigrations = $this->getMigrationHistory($limit);

        if (empty($databasemigrations)) {
            $this->stdout("No databasemigration has been done before.\n", Console::FG_YELLOW);

            return ExitCode::OK;
        }

        $databasemigrations = array_keys($databasemigrations);

        $n = count($databasemigrations);
        $this->stdout("Total $n " . ($n === 1 ? 'databasemigration' : 'databasemigrations') . " to be redone:\n", Console::FG_YELLOW);
        foreach ($databasemigrations as $databasemigration) {
            $this->stdout("\t$databasemigration\n");
        }
        $this->stdout("\n");

        if ($this->confirm('Redo the above ' . ($n === 1 ? 'databasemigration' : 'databasemigrations') . '?')) {
            foreach ($databasemigrations as $databasemigration) {
                if (!$this->migrateDown($databasemigration)) {
                    $this->stdout("\nMigration failed. The rest of the databasemigrations are canceled.\n", Console::FG_RED);

                    return ExitCode::UNSPECIFIED_ERROR;
                }
            }
            foreach (array_reverse($databasemigrations) as $databasemigration) {
                if (!$this->migrateUp($databasemigration)) {
                    $this->stdout("\nMigration failed. The rest of the databasemigrations are canceled.\n", Console::FG_RED);

                    return ExitCode::UNSPECIFIED_ERROR;
                }
            }
            $this->stdout("\n$n " . ($n === 1 ? 'databasemigration was' : 'databasemigrations were') . " redone.\n", Console::FG_GREEN);
            $this->stdout("\nMigration redone successfully.\n", Console::FG_GREEN);
        }
    }

    /**
     * Upgrades or downgrades till the specified version.
     *
     * Can also downgrade versions to the certain apply time in the past by providing
     * a UNIX timestamp or a string parseable by the strtotime() function. This means
     * that all the versions applied after the specified certain time would be reverted.
     *
     * This command will first revert the specified databasemigrations, and then apply
     * them again. For example,
     *
     * ```
     * yii migrate/to 101129_185401                          # using timestamp
     * yii migrate/to m101129_185401_create_user_table       # using full name
     * yii migrate/to 1392853618                             # using UNIX timestamp
     * yii migrate/to "2014-02-15 13:00:50"                  # using strtotime() parseable string
     * yii migrate/to app\databasemigrations\M101129185401CreateUser # using full namespace name
     * ```
     *
     * @param string $version either the version name or the certain time value in the past
     * that the application should be migrated to. This can be either the timestamp,
     * the full name of the databasemigration, the UNIX timestamp, or the parseable datetime
     * string.
     * @throws Exception if the version argument is invalid.
     */
    public function actionTo($version)
    {
        if (($namespaceVersion = $this->extractNamespaceMigrationVersion($version)) !== false) {
            $this->migrateToVersion($namespaceVersion);
        } elseif (($databasemigrationName = $this->extractMigrationVersion($version)) !== false) {
            $this->migrateToVersion($databasemigrationName);
        } elseif ((string) (int) $version == $version) {
            $this->migrateToTime($version);
        } elseif (($time = strtotime($version)) !== false) {
            $this->migrateToTime($time);
        } else {
            throw new Exception("The version argument must be either a timestamp (e.g. 101129_185401),\n the full name of a databasemigration (e.g. m101129_185401_create_user_table),\n the full namespaced name of a databasemigration (e.g. app\\databasemigrations\\M101129185401CreateUserTable),\n a UNIX timestamp (e.g. 1392853000), or a datetime string parseable\nby the strtotime() function (e.g. 2014-02-15 13:00:50).");
        }
    }

    /**
     * Modifies the databasemigration history to the specified version.
     *
     * No actual databasemigration will be performed.
     *
     * ```
     * yii migrate/mark 101129_185401                        # using timestamp
     * yii migrate/mark m101129_185401_create_user_table     # using full name
     * yii migrate/mark app\databasemigrations\M101129185401CreateUser # using full namespace name
     * yii migrate/mark m000000_000000_base # reset the complete databasemigration history
     * ```
     *
     * @param string $version the version at which the databasemigration history should be marked.
     * This can be either the timestamp or the full name of the databasemigration.
     * You may specify the name `m000000_000000_base` to set the databasemigration history to a
     * state where no databasemigration has been applied.
     * @return int CLI exit code
     * @throws Exception if the version argument is invalid or the version cannot be found.
     */
    public function actionMark($version)
    {
        $originalVersion = $version;
        if (($namespaceVersion = $this->extractNamespaceMigrationVersion($version)) !== false) {
            $version = $namespaceVersion;
        } elseif (($databasemigrationName = $this->extractMigrationVersion($version)) !== false) {
            $version = $databasemigrationName;
        } elseif ($version !== static::BASE_MIGRATION) {
            throw new Exception("The version argument must be either a timestamp (e.g. 101129_185401)\nor the full name of a databasemigration (e.g. m101129_185401_create_user_table)\nor the full name of a namespaced databasemigration (e.g. app\\databasemigrations\\M101129185401CreateUserTable).");
        }

        // try mark up
        $databasemigrations = $this->getNewMigrations();
        foreach ($databasemigrations as $i => $databasemigration) {
            if (strpos($databasemigration, $version) === 0) {
                if ($this->confirm("Set databasemigration history at $originalVersion?")) {
                    for ($j = 0; $j <= $i; ++$j) {
                        $this->addMigrationHistory($databasemigrations[$j]);
                    }
                    $this->stdout("The databasemigration history is set at $originalVersion.\nNo actual databasemigration was performed.\n", Console::FG_GREEN);
                }

                return ExitCode::OK;
            }
        }

        // try mark down
        $databasemigrations = array_keys($this->getMigrationHistory(null));
        $databasemigrations[] = static::BASE_MIGRATION;
        foreach ($databasemigrations as $i => $databasemigration) {
            if (strpos($databasemigration, $version) === 0) {
                if ($i === 0) {
                    $this->stdout("Already at '$originalVersion'. Nothing needs to be done.\n", Console::FG_YELLOW);
                } else {
                    if ($this->confirm("Set databasemigration history at $originalVersion?")) {
                        for ($j = 0; $j < $i; ++$j) {
                            $this->removeMigrationHistory($databasemigrations[$j]);
                        }
                        $this->stdout("The databasemigration history is set at $originalVersion.\nNo actual databasemigration was performed.\n", Console::FG_GREEN);
                    }
                }

                return ExitCode::OK;
            }
        }

        throw new Exception("Unable to find the version '$originalVersion'.");
    }

    /**
     * Truncates the whole database and starts the databasemigration from the beginning.
     *
     * ```
     * yii migrate/fresh
     * ```
     *
     * @since 2.0.13
     */
    public function actionFresh()
    {
        if (YII_ENV_PROD) {
            $this->stdout("YII_ENV is set to 'prod'.\nRefreshing databasemigrations is not possible on production systems.\n");
            return ExitCode::OK;
        }

        if ($this->confirm(
            "Are you sure you want to reset the database and start the databasemigration from the beginning?\nAll data will be lost irreversibly!")) {
            $this->truncateDatabase();
            return $this->actionUp();
        }

        $this->stdout('Action was cancelled by user. Nothing has been performed.');
        return ExitCode::OK;
    }

    /**
     * Checks if given databasemigration version specification matches namespaced databasemigration name.
     * @param string $rawVersion raw version specification received from user input.
     * @return string|false actual databasemigration version, `false` - if not match.
     * @since 2.0.10
     */
    private function extractNamespaceMigrationVersion($rawVersion)
    {
        if (preg_match('/^\\\\?([\w_]+\\\\)+m(\d{6}_?\d{6})(\D.*)?$/is', $rawVersion, $matches)) {
            return trim($rawVersion, '\\');
        }

        return false;
    }

    /**
     * Checks if given databasemigration version specification matches databasemigration base name.
     * @param string $rawVersion raw version specification received from user input.
     * @return string|false actual databasemigration version, `false` - if not match.
     * @since 2.0.10
     */
    private function extractMigrationVersion($rawVersion)
    {
        if (preg_match('/^m?(\d{6}_?\d{6})(\D.*)?$/is', $rawVersion, $matches)) {
            return 'm' . $matches[1];
        }

        return false;
    }

    /**
     * Displays the databasemigration history.
     *
     * This command will show the list of databasemigrations that have been applied
     * so far. For example,
     *
     * ```
     * yii migrate/history     # showing the last 10 databasemigrations
     * yii migrate/history 5   # showing the last 5 databasemigrations
     * yii migrate/history all # showing the whole history
     * ```
     *
     * @param int|string $limit the maximum number of databasemigrations to be displayed.
     * If it is "all", the whole databasemigration history will be displayed.
     * @throws \yii\console\Exception if invalid limit value passed
     */
    public function actionHistory($limit = 10)
    {
        if ($limit === 'all') {
            $limit = null;
        } else {
            $limit = (int) $limit;
            if ($limit < 1) {
                throw new Exception('The limit must be greater than 0.');
            }
        }

        $databasemigrations = $this->getMigrationHistory($limit);

        if (empty($databasemigrations)) {
            $this->stdout("No databasemigration has been done before.\n", Console::FG_YELLOW);
        } else {
            $n = count($databasemigrations);
            if ($limit > 0) {
                $this->stdout("Showing the last $n applied " . ($n === 1 ? 'databasemigration' : 'databasemigrations') . ":\n", Console::FG_YELLOW);
            } else {
                $this->stdout("Total $n " . ($n === 1 ? 'databasemigration has' : 'databasemigrations have') . " been applied before:\n", Console::FG_YELLOW);
            }
            foreach ($databasemigrations as $version => $time) {
                $this->stdout("\t(" . date('Y-m-d H:i:s', $time) . ') ' . $version . "\n");
            }
        }
    }

    /**
     * Displays the un-applied new databasemigrations.
     *
     * This command will show the new databasemigrations that have not been applied.
     * For example,
     *
     * ```
     * yii migrate/new     # showing the first 10 new databasemigrations
     * yii migrate/new 5   # showing the first 5 new databasemigrations
     * yii migrate/new all # showing all new databasemigrations
     * ```
     *
     * @param int|string $limit the maximum number of new databasemigrations to be displayed.
     * If it is `all`, all available new databasemigrations will be displayed.
     * @throws \yii\console\Exception if invalid limit value passed
     */
    public function actionNew($limit = 10)
    {
        if ($limit === 'all') {
            $limit = null;
        } else {
            $limit = (int) $limit;
            if ($limit < 1) {
                throw new Exception('The limit must be greater than 0.');
            }
        }

        $databasemigrations = $this->getNewMigrations();

        if (empty($databasemigrations)) {
            $this->stdout("No new databasemigrations found. Your system is up-to-date.\n", Console::FG_GREEN);
        } else {
            $n = count($databasemigrations);
            if ($limit && $n > $limit) {
                $databasemigrations = array_slice($databasemigrations, 0, $limit);
                $this->stdout("Showing $limit out of $n new " . ($n === 1 ? 'databasemigration' : 'databasemigrations') . ":\n", Console::FG_YELLOW);
            } else {
                $this->stdout("Found $n new " . ($n === 1 ? 'databasemigration' : 'databasemigrations') . ":\n", Console::FG_YELLOW);
            }

            foreach ($databasemigrations as $databasemigration) {
                $this->stdout("\t" . $databasemigration . "\n");
            }
        }
    }

    /**
     * Creates a new databasemigration.
     *
     * This command creates a new databasemigration using the available databasemigration template.
     * After using this command, developers should modify the created databasemigration
     * skeleton by filling up the actual databasemigration logic.
     *
     * ```
     * yii migrate/create create_user_table
     * ```
     *
     * In order to generate a namespaced databasemigration, you should specify a namespace before the databasemigration's name.
     * Note that backslash (`\`) is usually considered a special character in the shell, so you need to escape it
     * properly to avoid shell errors or incorrect behavior.
     * For example:
     *
     * ```
     * yii migrate/create 'app\\databasemigrations\\createUserTable'
     * ```
     *
     * In case [[databasemigrationPath]] is not set and no namespace is provided, the first entry of [[databasemigrationNamespaces]] will be used.
     *
     * @param string $name the name of the new databasemigration. This should only contain
     * letters, digits, underscores and/or backslashes.
     *
     * Note: If the databasemigration name is of a special form, for example create_xxx or
     * drop_xxx, then the generated databasemigration file will contain extra code,
     * in this case for creating/dropping tables.
     *
     * @throws Exception if the name argument is invalid.
     */
    public function actionCreate($name)
    {
        if (!preg_match('/^[\w\\\\]+$/', $name)) {
            throw new Exception('The databasemigration name should contain letters, digits, underscore and/or backslash characters only.');
        }

        list($namespace, $className) = $this->generateClassName($name);
        // Abort if name is too long
        $nameLimit = $this->getMigrationNameLimit();
        if ($nameLimit !== null && strlen($className) > $nameLimit) {
            throw new Exception('The databasemigration name is too long.');
        }

        $databasemigrationPath = $this->findMigrationPath($namespace);

        $file = $databasemigrationPath . DIRECTORY_SEPARATOR . $className . '.php';
        if ($this->confirm("Create new databasemigration '$file'?")) {
            $content = $this->generateMigrationSourceCode([
                'name' => $name,
                'className' => $className,
                'namespace' => $namespace,
            ]);
            FileHelper::createDirectory($databasemigrationPath);
            file_put_contents($file, $content, LOCK_EX);
            $this->stdout("New databasemigration created successfully.\n", Console::FG_GREEN);
        }
    }

    /**
     * Generates class base name and namespace from databasemigration name from user input.
     * @param string $name databasemigration name from user input.
     * @return array list of 2 elements: 'namespace' and 'class base name'
     * @since 2.0.10
     */
    private function generateClassName($name)
    {
        $namespace = null;
        $name = trim($name, '\\');
        if (strpos($name, '\\') !== false) {
            $namespace = substr($name, 0, strrpos($name, '\\'));
            $name = substr($name, strrpos($name, '\\') + 1);
        } elseif ($this->databasemigrationPath === null) {
            $databasemigrationNamespaces = $this->databasemigrationNamespaces;
            $namespace = array_shift($databasemigrationNamespaces);
        }

        if ($namespace === null) {
            $class = 'm' . gmdate('ymd_His') . '_' . $name;
        } else {
            $class = 'M' . gmdate('ymdHis') . Inflector::camelize($name);
        }

        return [$namespace, $class];
    }

    /**
     * Finds the file path for the specified databasemigration namespace.
     * @param string|null $namespace databasemigration namespace.
     * @return string databasemigration file path.
     * @throws Exception on failure.
     * @since 2.0.10
     */
    private function findMigrationPath($namespace)
    {
        if (empty($namespace)) {
            return is_array($this->databasemigrationPath) ? reset($this->databasemigrationPath) : $this->databasemigrationPath;
        }

        if (!in_array($namespace, $this->databasemigrationNamespaces, true)) {
            throw new Exception("Namespace '{$namespace}' not found in `databasemigrationNamespaces`");
        }

        return $this->getNamespacePath($namespace);
    }

    /**
     * Returns the file path matching the give namespace.
     * @param string $namespace namespace.
     * @return string file path.
     * @since 2.0.10
     */
    private function getNamespacePath($namespace)
    {
        return str_replace('/', DIRECTORY_SEPARATOR, Yii::getAlias('@' . str_replace('\\', '/', $namespace)));
    }

    /**
     * Upgrades with the specified databasemigration class.
     * @param string $class the databasemigration class name
     * @return bool whether the databasemigration is successful
     */
    protected function migrateUp($class)
    {
        if ($class === self::BASE_MIGRATION) {
            return true;
        }

        $this->stdout("*** applying $class\n", Console::FG_YELLOW);
        $start = microtime(true);
        $databasemigration = $this->createMigration($class);
        if ($databasemigration->up() !== false) {
            $this->addMigrationHistory($class);
            $time = microtime(true) - $start;
            $this->stdout("*** applied $class (time: " . sprintf('%.3f', $time) . "s)\n\n", Console::FG_GREEN);

            return true;
        }

        $time = microtime(true) - $start;
        $this->stdout("*** failed to apply $class (time: " . sprintf('%.3f', $time) . "s)\n\n", Console::FG_RED);

        return false;
    }

    /**
     * Downgrades with the specified databasemigration class.
     * @param string $class the databasemigration class name
     * @return bool whether the databasemigration is successful
     */
    protected function migrateDown($class)
    {
        if ($class === self::BASE_MIGRATION) {
            return true;
        }

        $this->stdout("*** reverting $class\n", Console::FG_YELLOW);
        $start = microtime(true);
        $databasemigration = $this->createMigration($class);
        if ($databasemigration->down() !== false) {
            $this->removeMigrationHistory($class);
            $time = microtime(true) - $start;
            $this->stdout("*** reverted $class (time: " . sprintf('%.3f', $time) . "s)\n\n", Console::FG_GREEN);

            return true;
        }

        $time = microtime(true) - $start;
        $this->stdout("*** failed to revert $class (time: " . sprintf('%.3f', $time) . "s)\n\n", Console::FG_RED);

        return false;
    }

    /**
     * Creates a new databasemigration instance.
     * @param string $class the databasemigration class name
     * @return \yii\db\MigrationInterface the databasemigration instance
     */
    protected function createMigration($class)
    {
        $this->includeMigrationFile($class);

        /** @var MigrationInterface $databasemigration */
        $databasemigration = Yii::createObject($class);
        if ($databasemigration instanceof BaseObject && $databasemigration->canSetProperty('compact')) {
            $databasemigration->compact = $this->compact;
        }

        return $databasemigration;
    }

    /**
     * Includes the databasemigration file for a given databasemigration class name.
     *
     * This function will do nothing on namespaced databasemigrations, which are loaded by
     * autoloading automatically. It will include the databasemigration file, by searching
     * [[databasemigrationPath]] for classes without namespace.
     * @param string $class the databasemigration class name.
     * @since 2.0.12
     */
    protected function includeMigrationFile($class)
    {
        $class = trim($class, '\\');
        if (strpos($class, '\\') === false) {
            if (is_array($this->databasemigrationPath)) {
                foreach ($this->databasemigrationPath as $path) {
                    $file = $path . DIRECTORY_SEPARATOR . $class . '.php';
                    if (is_file($file)) {
                        require_once $file;
                        break;
                    }
                }
            } else {
                $file = $this->databasemigrationPath . DIRECTORY_SEPARATOR . $class . '.php';
                require_once $file;
            }
        }
    }

    /**
     * Migrates to the specified apply time in the past.
     * @param int $time UNIX timestamp value.
     */
    protected function migrateToTime($time)
    {
        $count = 0;
        $databasemigrations = array_values($this->getMigrationHistory(null));
        while ($count < count($databasemigrations) && $databasemigrations[$count] > $time) {
            ++$count;
        }
        if ($count === 0) {
            $this->stdout("Nothing needs to be done.\n", Console::FG_GREEN);
        } else {
            $this->actionDown($count);
        }
    }

    /**
     * Migrates to the certain version.
     * @param string $version name in the full format.
     * @return int CLI exit code
     * @throws Exception if the provided version cannot be found.
     */
    protected function migrateToVersion($version)
    {
        $originalVersion = $version;

        // try migrate up
        $databasemigrations = $this->getNewMigrations();
        foreach ($databasemigrations as $i => $databasemigration) {
            if (strpos($databasemigration, $version) === 0) {
                $this->actionUp($i + 1);

                return ExitCode::OK;
            }
        }

        // try migrate down
        $databasemigrations = array_keys($this->getMigrationHistory(null));
        foreach ($databasemigrations as $i => $databasemigration) {
            if (strpos($databasemigration, $version) === 0) {
                if ($i === 0) {
                    $this->stdout("Already at '$originalVersion'. Nothing needs to be done.\n", Console::FG_YELLOW);
                } else {
                    $this->actionDown($i);
                }

                return ExitCode::OK;
            }
        }

        throw new Exception("Unable to find the version '$originalVersion'.");
    }

    /**
     * Returns the databasemigrations that are not applied.
     * @return array list of new databasemigrations
     */
    protected function getNewMigrations()
    {
        $applied = [];
        foreach ($this->getMigrationHistory(null) as $class => $time) {
            $applied[trim($class, '\\')] = true;
        }

        $databasemigrationPaths = [];
        if (is_array($this->databasemigrationPath)) {
            foreach ($this->databasemigrationPath as $path) {
                $databasemigrationPaths[] = [$path, ''];
            }
        } elseif (!empty($this->databasemigrationPath)) {
            $databasemigrationPaths[] = [$this->databasemigrationPath, ''];
        }
        foreach ($this->databasemigrationNamespaces as $namespace) {
            $databasemigrationPaths[] = [$this->getNamespacePath($namespace), $namespace];
        }

        $databasemigrations = [];
        foreach ($databasemigrationPaths as $item) {
            list($databasemigrationPath, $namespace) = $item;
            if (!file_exists($databasemigrationPath)) {
                continue;
            }
            $handle = opendir($databasemigrationPath);
            while (($file = readdir($handle)) !== false) {
                if ($file === '.' || $file === '..') {
                    continue;
                }
                $path = $databasemigrationPath . DIRECTORY_SEPARATOR . $file;
                if (preg_match('/^(m(\d{6}_?\d{6})\D.*?)\.php$/is', $file, $matches) && is_file($path)) {
                    $class = $matches[1];
                    if (!empty($namespace)) {
                        $class = $namespace . '\\' . $class;
                    }
                    $time = str_replace('_', '', $matches[2]);
                    if (!isset($applied[$class])) {
                        $databasemigrations[$time . '\\' . $class] = $class;
                    }
                }
            }
            closedir($handle);
        }
        ksort($databasemigrations);

        return array_values($databasemigrations);
    }

    /**
     * Generates new databasemigration source PHP code.
     * Child class may override this method, adding extra logic or variation to the process.
     * @param array $params generation parameters, usually following parameters are present:
     *
     *  - name: string databasemigration base name
     *  - className: string databasemigration class name
     *
     * @return string generated PHP code.
     * @since 2.0.8
     */
    protected function generateMigrationSourceCode($params)
    {
        return $this->renderFile(Yii::getAlias($this->templateFile), $params);
    }

    /**
     * Truncates the database.
     * This method should be overwritten in subclasses to implement the task of clearing the database.
     * @throws NotSupportedException if not overridden
     * @since 2.0.13
     */
    protected function truncateDatabase()
    {
        throw new NotSupportedException('This command is not implemented in ' . get_class($this));
    }

    /**
     * Return the maximum name length for a databasemigration.
     *
     * Subclasses may override this method to define a limit.
     * @return int|null the maximum name length for a databasemigration or `null` if no limit applies.
     * @since 2.0.13
     */
    protected function getMigrationNameLimit()
    {
        return null;
    }

    /**
     * Returns the databasemigration history.
     * @param int $limit the maximum number of records in the history to be returned. `null` for "no limit".
     * @return array the databasemigration history
     */
    abstract protected function getMigrationHistory($limit);

    /**
     * Adds new databasemigration entry to the history.
     * @param string $version databasemigration version name.
     */
    abstract protected function addMigrationHistory($version);

    /**
     * Removes existing databasemigration from the history.
     * @param string $version databasemigration version name.
     */
    abstract protected function removeMigrationHistory($version);
}
