import pymysql
import requests
import re
import bs4
import random
from bs4 import BeautifulSoup

url = 'https://sou.chinanews.com.cn/search.do?q=%E6%A0%B8%E6%B1%A1%E6%B0%B4' #中国新闻网

def crawl(sub_url):    
    r = requests.get(sub_url, verify=False)
    r.raise_for_status()

    # 创建一个BeautifulSoup解析对象
    soup = BeautifulSoup(r.text,'html.parser')

    titles = [each.get_text().strip() for each in soup.find_all(name='li', attrs={'class': 'news_title'})]
    contents = [each.get_text().strip() for each in soup.find_all(name='li', attrs={'class': 'news_content'})]
    times = [each.get_text()[-40:].strip() for each in soup.find_all(name='li', attrs={'class': 'news_other'})]

    return titles, contents, times

def updateDB():
    conn = pymysql.connect(host='127.0.0.1',  # 连接名称，默认为127.0.0.1
                           user='root',  # 用户名
                           passwd='Liuchuanfeng0306',  # 密码
                           port=3306,  # 端口，默认为3306
                           db='yii2advanced',  # 数据库名称
                           charset='utf8'  # 字符编码
                           )
    cur = conn.cursor()  # 生成游标对象
    
    num_id = 1
    for j in range(1, 11):
        sub_url = url + "&start=" + str(j*10)
        titles, contents, times = crawl(sub_url)
        
        for i in range(min(10, len(titles))):
            news_title = titles[i]
            news_content = contents[i]
            news_photo = str(num_id) + '.png'
            news_date = times[i]
            news_source = '中国新闻网'
            news_abstract = contents[i]
            news_views = random.randint(0, 500)

            sql = "INSERT INTO `news` (news_title, news_content, news_photo, news_date, news_source, news_abstract, news_views) VALUES (%s, %s, %s, %s, %s, %s, %s)"
            values = (news_title, news_content, news_photo, news_date, news_source, news_abstract, news_views)
            num_id += 1
            cur.execute(sql, values)  # 执行SQL语句
        
        sql = "SELECT * FROM `news`"
        cur.execute(sql)  # 执行SQL语句
        data = cur.fetchall()  # 通过fetchall方法获得数据
        for row in data[:2]:  # 打印输出前2条数据
            print(row)
        
        conn.commit()  # 提交之前的操作，如果之前已经执行多次的execute，那么就都进行提交
    
    cur.close()  # 关闭游标
    conn.close()  # 关闭连接
    

if __name__ == '__main__':
    updateDB()