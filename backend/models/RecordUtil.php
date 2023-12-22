<?php

namespace backend\models;
use common\models\HistoricalActivity;
use Yii;


class RecordUtil
{
    public static function generateRecord($table, $operation)
    {
        $rec = new HistoricalActivity();
        $rec->user_id = Yii::$app->user->id;
        date_default_timezone_set('PRC');
        $rec->time = date('Y-m-d H:i:s');
        $rec->table_name = $table;
        $rec->operation = $operation;
        $rec->save();
    }
}