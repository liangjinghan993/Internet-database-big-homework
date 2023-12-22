<?php

/**
 * Team: 抵制核污水小队
 * Created by 尚然.
 * 问答类
 */

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Question;

/**
 * Ask form
 * @property int $id 标号
 * @property string $question 问题
 */
class Ask extends \yii\db\ActiveRecord
{
    // public $question;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ask}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['question', 'required'],
            ['question', 'string', 'min' => 2, 'max' => 255],
        ];
    }

    // /**
    //  * Gets query for [[question]].
    //  *
    //  * @return \yii\db\ActiveQuery|QuestionQuery
    //  */
    // public function getNewsComments()
    // {
    //     if(!isset($this->comments)) {
    //         $this->comments = $this->hasMany(NewsComment::className(), ['comment_news' => 'news_id'])->orderBy('comment_time DESC');
    //     }
    //     return $this->comments;
    // }

    // public function getNewsCommentNum()
    // {
    //     return $this->getNewsComments()->count();
    // }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
public function uploadQuestion()
    {
        if (!$this->validate()) {
            return null;
        }

        $item = new Question();
        $item->question = $this->question;
        $item->generateAuthKey();
        return $item->save();
    }
}