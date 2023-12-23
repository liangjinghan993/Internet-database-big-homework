<?php

/**
 * Team: 抵制核污水小队
 * Created by 梁婧涵
 * 新闻评论表
 */

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%news_comment}}".
 *
 * @property int $comment_id 标号
 * @property int $comment_news 所属新闻
 * @property int $comment_user 来源用户
 * @property string $comment_content 评论内容
 * @property string $comment_time 评论时间
 *
 * @property News $commentNews
 * @property User $commentUser
 */
class NewsComment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%news_comment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment_news', 'comment_user', 'comment_content', 'comment_time'], 'required'],
            [['comment_news', 'comment_user'], 'integer'],
            [['comment_content'], 'string'],
            [['comment_time'], 'safe'],
            [['comment_news'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['comment_news' => 'news_id']],
            [['comment_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['comment_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'comment_id' => '标号',
            'comment_news' => '所属新闻',
            'comment_user' => '来源用户',
            'comment_content' => '评论内容',
            'comment_time' => '评论时间',
        ];
    }

    /**
     * Gets query for [[CommentNews]].
     *
     * @return \yii\db\ActiveQuery|NewsQuery
     */
    public function getCommentNews()
    {
        return $this->hasOne(News::className(), ['news_id' => 'comment_news']);
    }

    /**
     * Gets query for [[CommentUser]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getCommentUser()
    {
        return $this->hasOne(User::className(), ['id' => 'comment_user']);
    }

    /**
     * {@inheritdoc}
     * @return NewsCommentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NewsCommentQuery(get_called_class());
    }
}
