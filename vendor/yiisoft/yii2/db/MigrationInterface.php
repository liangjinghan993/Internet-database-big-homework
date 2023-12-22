<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\db;

/**
 * The MigrationInterface defines the minimum set of methods to be implemented by a database databasemigration.
 *
 * Each databasemigration class should provide the [[up()]] method containing the logic for "upgrading" the database
 * and the [[down()]] method for the "downgrading" logic.
 *
 * @author Klimov Paul <klimov@zfort.com>
 * @since 2.0
 */
interface MigrationInterface
{
    /**
     * This method contains the logic to be executed when applying this databasemigration.
     * @return bool return a false value to indicate the databasemigration fails
     * and should not proceed further. All other return values mean the databasemigration succeeds.
     */
    public function up();

    /**
     * This method contains the logic to be executed when removing this databasemigration.
     * The default implementation throws an exception indicating the databasemigration cannot be removed.
     * @return bool return a false value to indicate the databasemigration fails
     * and should not proceed further. All other return values mean the databasemigration succeeds.
     */
    public function down();
}
