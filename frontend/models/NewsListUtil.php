<?php

/**
 * Team: 抵制核污水小队
 * Created by 刘雅文.
 * 新闻列表帮助类
 */

namespace frontend\models;

use common\models\News;

class NewsListUtil
{
    const NEWS_PER_PAGE = 4;
    public static $news_num;
    public static $news_page_num;
    public static $current_news_page;
    private static $news_list;

    /**
     * 用于选择初始化方式
     * @param $option
     * @return void
     */
    public static function init($option = [])
    {
        self::$news_list = News::find()->orderBy('news_date DESC')->all();
        if(isset($option['news_source'])) {
            self::$news_list = News::find()->orderBy('news_date DESC')->where(['news_source' => $option['news_source']])->all();
        }
        if(isset($option['search_keywords'])) {
            self::$news_list = News::find()->orderBy('news_date DESC')
                ->orFilterWhere(['like', 'news_title', $option['search_keywords']])
                ->orFilterWhere(['like', 'news_abstract', $option['search_keywords']])
                ->orFilterWhere(['like', 'news_content', $option['search_keywords']])
                ->orFilterWhere(['like', 'news_source', $option['search_keywords']])
                ->orFilterWhere(['like', 'news_date', $option['search_keywords']])
                ->all();
        }
        self::$news_num = count(self::$news_list, COUNT_RECURSIVE);
        self::$news_page_num = self::$news_num / 4;
        self::$current_news_page = 0;
    }

    /**
     * 获取初始化后的新闻列表
     * @return mixed
     */
    public static function getNewsList()
    {
        return self::$news_list;
    }

    /**
     * 按照新闻来源进行新闻筛选
     * @param $news_source 新闻来源
     * @return void
     */
    public static function filterNewsSource($news_source)
    {
        self::$news_list = News::find()->orderBy('news_date DESC')->where(['news_source' => $news_source])->all();
        self::$news_num = count(self::$news_list, COUNT_RECURSIVE);
        self::$news_page_num = self::$news_num / 4;
        self::$current_news_page = 0;
    }
}