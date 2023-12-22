SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;
-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `auth_key` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password_hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password_reset_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `status` smallint(0) NOT NULL DEFAULT 10,
  `created_at` int(0) NOT NULL,
  `updated_at` int(0) NOT NULL,
  `verification_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `purview` int(0) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `username`(`username`) USING BTREE,
  UNIQUE INDEX `email`(`email`) USING BTREE,
  UNIQUE INDEX `password_reset_token`(`password_reset_token`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (1, 'admin', 'dOukCdzkuR_bNC7m5w4MX7dIM8-xpDU0', '$2y$13$tyAaDKSNeoqImx7r3eKIuedpSANxoyzAvv30JxhyNdXreCxJ7CaLG', 'uClvX1oKNbKVCykeuk4BimMBZfejNprA_1675525876', 'admin@gmail.com', 10, 1674014197, 1675525876, 'IIlCzFSOBKAV61Q-pBPVXdiSrcBW2AcB_1674014197', 0);
INSERT INTO `user` VALUES (2, 'test', '8WxDxmV_G65cMPJin4-bP8DIPhiiHeX3', '$2y$13$qSFtv0a8j9/xdth6lUC9HuYtDOUwNUSxnUWjncto4nrhn/is.ntqO', NULL, 'test@gmail.com', 10, 1674014280, 1674014280, 'uRXxQH0WoMe7BIjWfAr6dariEW_hFwFI_1674014280', 0);
INSERT INTO `user` VALUES (3, 'user', 'W0ntFZEWpQd8UBTsSxJD8w119azHHlus', '$2y$13$9g/xDBc31hGcVwAsseVzduJdMW6euHXVxPUA9trrcRY7dlmQUROZ.', NULL, 'user@gmain.com', 10, 1675474822, 1675524673, 'lyIN5fYN65AlTk_5valgZI-PcPLjUK0a_1675474822', 1);
INSERT INTO `user` VALUES (4, 'root', '-MbGxKSd7MVMehBj_JEZtKBVovo_jGm_', '$2y$13$k2hH0ipzEV6SaaCAAxm5re5FtBcQUuZ.Og.uzlnMJL/NTnvt8mDk.', NULL, 'root@gmail.com', 10, 1675526325, 1675526350, 'o0R1EwEPDf2ySlAkoU_EHDqHGPI6xdUE_1675526325', 1);

SET FOREIGN_KEY_CHECKS = 1;

DROP TABLE IF EXISTS `photo`;
CREATE TABLE `photo`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `details` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `time` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `introduction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of photo
-- ----------------------------
INSERT INTO `photo` VALUES (1, '海洋', '福岛一号核电站3号机组爆炸后的照片', 'photo-1.jpg', '2011年3月11日福岛第一核电站发生严重事故', '美国一家用人工卫星专门拍摄高清晰照片的民间企业14日公布了当天拍摄到的东京电力第一核电站爆炸后的情形照片。从照片可以看到，核电站3号机组发生氢气爆炸后，建筑物外观一片狼藉并向上喷吐白烟。图为爆炸三分钟后的当地时间14日上午11时4分的事故现场。', '美国公布福岛一号核电站3号机组爆炸后的照片');
INSERT INTO `photo` VALUES (2, '海洋', '清华大学研究团队模拟核污水排放结果', 'photo-2.jpg', '2021年，清华大学就污水排放做了核废水在太平洋扩散机理的实验', '福岛沿岸拥有世界上最强的洋流。通过洋流和雨水，日本核污水将扩散到全球各地。早在2021年，清华大学就污水排放做了核废水在太平洋扩散机理的实验。宏观模拟结果表明，核废水在排放后240天就会到达我国沿岸海域，1200天后将到达北美沿岸并覆盖几乎整个北太平洋。随后，污染物一边在赤道洋流的作用下沿着美洲海岸向南太平洋快速扩散，另一边通过澳大利亚北部海域向印度洋转移。', '数据说｜清华大学研究团队模拟结果：美国受核污水影响程度在后期将高于中国');
INSERT INTO `photo` VALUES (3, '海洋', '日本核废水污染路径', 'photo-3.jpg', '2023年9月4日私人发表', '随着核废水进入大海，整个中国周边海域和太平洋都会受到核辐射的核废水的扩散影响，并且这个过程会持续1000年甚至1万年也不会消散，而其过程中，核废料进入食物链会彻底改变活细胞，并导致 DNA 突变和组织损伤，从而对人类健康构成威胁。包括 X 射线和核放射性元素。', '日本核废水影响出现了！ 鱼类 蔬菜 开始变异，整个亚洲海域太平洋污染 ，放射物持续1万年不会消散 ！');
INSERT INTO `photo` VALUES (4, '人民', '国际原子能机构总干事格罗西（右二）访问日本，站在一个储存核废水的储罐前', 'photo-4.jpg', '2022年五月', '经过多年国内外激辩，以及数个首相来来去去，日本政府计划在今夏将福岛第一核电站储存的超过 130 万吨核废水排入太平洋，引发全球关注及亚洲邻居紧张。由于这是人类史上第一起大规模核废水排放，争议甚巨，其中包含食品安全、海洋污染、放射性物质影响人体健康等议题，在亚洲引起激辩。 日本邻国及全球外环保人士忧心，将含有放射性同位素“氚”（Tritium）的核废水排入海洋，将对全球人体健康和海洋生态造成极大风险，并严重影响渔业。北京已经率先抨击日本罔顾邻居安全，港澳政府也扬言将扩大日本产品进口禁令范围。','日本福岛核废水排海箭在弦上亚洲邻居反应激烈 “不仅是经济问题，还生死攸关”');
INSERT INTO `photo` VALUES (5, '人民', '朝鮮24日批評日本犯反人類罪，菲律賓則稱會從科學角度檢視問題', 'photo-5.jpg', '2023年8月24日', '日本福島核污水8月24日開始排海。各國對日方的舉動持不同態度，朝鮮24日批評日本犯反人類罪，菲律賓則稱會從科學角度檢視問題。', '福島核污水｜一文看各國態度　朝鮮斥罪行　菲律賓稱科學角度檢視');
INSERT INTO `photo` VALUES (6, '人民', '排放問題牽扯著中日關係神經，在日本民間也引起莫大反彈。', 'photo-6.jpg', '2023年7月19日', '日本福島第一核電站事故發生已有12年，日本政府與管有核電站的東京電力公司凖備排放積存的核廢水，引發中國官方與鄰國民間團體的強烈抗議，一些太平洋島國也表達憂慮。', '福島核廢水：核災廢水與核電廠廢水哪個更可怕？');
INSERT INTO `photo` VALUES (7, '生物', '日本海域再现大规模死鱼', 'photo-7.jpg', '2021年12月12 日上午', '日本当地时间 12月12 日上午，日本渔民在青森县附近海域发现大量死鱼，随后日本海上自卫队八户航天基地上报了这个情况，日本海上保安部门也在第一时间赶到现场调查，从渔民拍摄到的视频可以看出海面上漂浮着大量死鱼，几乎都是体长 5 至 15 厘米的沙丁鱼，死鱼在一个长约 4 千米、宽约 50 至 100 米的区域内。', '天灾还是人祸？日本海域再现大规模死鱼，是偷排核废水导致的吗？');
INSERT INTO `photo` VALUES (8, '生物', '时隔两年福岛附近海域再现超标“辐射鱼”', 'photo-8.jpg', '2021-02-23','据日本广播协会（NHK）22日报道，日本福岛县海域当日的试验性捕鱼过程中，捕捞上一条放射性物质超标的海鱼。这是时隔约两年，再次发现福岛近海捕捞的鱼放射性物质超标。', '时刻知道丨日本再现超标“辐射鱼” 核辐射究竟有多可怕?');
INSERT INTO `photo` VALUES (9, '生物', '日本海域核污染导致大量鱼类死亡', 'photo-9.jpg', '2023-9-4', '详情见视频\url{https://quanmin.baidu.com/sv?source=share-h5&pd=qm_share_search&vid=3907491376254147787}', '日本海域核污染导致大量鱼类死亡，博主视频曝光引发全球关注');
-- ----------------------------

DROP TABLE IF EXISTS `price`;
CREATE TABLE `price`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `price` double(10, 2) NULL DEFAULT NULL,
  `measurement` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `img_path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `introduction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `currency` int(0) NULL DEFAULT NULL,
  `t_class` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of price
-- ----------------------------
INSERT INTO `price` VALUES (1, '食盐',10.87, '袋', 'price-1.jpg', '韩国食盐价格居高不下。韩媒称，目前的盐价比往年高六成以上。一名韩国食盐生产商称，“订单不断增加，仍然卖光了。这种情况十分罕见。”有观点认为，消费者对核污水排海而感到不安，希望在核污水排入海洋之前，多囤一些用海水提取的盐。 ', 2, '食品', '韩国盐价高涨 或为日本排污入海所致 ');
INSERT INTO `price` VALUES (2, '原油',84.48, '桶', 'price-2.jpg', '本周布伦特原油期货下跌 0.4%，至 84.48 美元/桶。本周伊朗原油供应增加削弱 OPEC+减产效果，国际原油小幅下滑', 1, '材料', '核污水排海致盐化工标的走强，油价有所走弱 ');
INSERT INTO `price` VALUES (3, '三文鱼', 5000, '公斤', 'price-3.jpg', '除了出口市场受挫外，日本的海产品在国内市场也遭遇了前所未有的冷淡。由于核污水排放引发了民众对食品安全的担忧和恐慌，许多消费者抵制或减少购买。这导致了日本海产品的供过于求和价格暴跌。据报道，在东京都中央批发市场举行的金枪鱼拍卖会上，一条重达200公斤左右的蓝鳍金枪鱼仅以100万日元成交，而去年同期的成交价则高达300万日元 ', 4, '海鲜', '排放核污水？日本海产单价下跌，订单量跌一半，自己人都不吃 ');
INSERT INTO `price` VALUES (4, '鸡蛋', 9356, '吨', 'price-4.jpg', '昨日鸡蛋期货2311合约盘中最高触及4678元/500千克的阶段性高点,本轮累计涨幅超17%。 造成鸡蛋价格上涨的原因主要有两个方面。首先,7、8月份天气持续炎热,导致鸡蛋产能出现阶段性不足,供给偏紧,从而推动了蛋价上涨。高温天气对鸡只生产造成一定影响,鸡蛋产量相对减少,供应相对紧张,市场供需失衡成为价格上涨的重要原因之一。 其次,受到近期日本核污水排海事件的影响,海产品消费锐减,这也对鸡蛋市场带来了影响。 ', 2, '食品', '日本排放核污水28天后,没想到鸡蛋大幅涨价 ');

DROP TABLE IF EXISTS `news_comment`;
CREATE TABLE `news_comment`  (
  `comment_id` int(0) NOT NULL AUTO_INCREMENT COMMENT '标号',
  `comment_news` int(0) NOT NULL COMMENT '所属新闻',
  `comment_user` int(0) NOT NULL COMMENT '来源用户',
  `comment_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '评论内容',
  `comment_time` datetime(0) NOT NULL COMMENT '评论时间',
  PRIMARY KEY (`comment_id`) USING BTREE,
  INDEX `comment_news_fk`(`comment_news`) USING BTREE,
  INDEX `comment_use_fk`(`comment_user`) USING BTREE,
  CONSTRAINT `comment_news_fk` FOREIGN KEY (`comment_news`) REFERENCES `news` (`news_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `comment_use_fk` FOREIGN KEY (`comment_user`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = '新闻评论' ROW_FORMAT = Dynamic;
show tables;
-- ----------------------------
-- Records of news_comment
-- ----------------------------
INSERT INTO `news_comment` VALUES (1, 18, 1, '抵制核污水，从我们做起！！！', '2023-11-22 10:33:57');
INSERT INTO `news_comment` VALUES (2, 19, 1, '此次会议坚决不能通过。', '2023-11-24 10:16:49');
INSERT INTO `news_comment` VALUES (3, 20, 1, '日本应按照意见书，中止核污水入海！', '2023-11-24 10:17:52');
INSERT INTO `news_comment` VALUES (4, 21, 1, '一起拉响警报！！！', '2023-11-24 10:21:16');
INSERT INTO `news_comment` VALUES (5,22, 1, '抵制核污水，从我们做起！！！', '2023-11-24 10:21:50');
INSERT INTO `news_comment` VALUES (6, 23, 1, '韩国的抵制值得借鉴', '2023-11-25 09:29:42');
INSERT INTO `news_comment` VALUES (7, 24, 3, '坚决不吃日本海鲜', '2023-12-04 09:45:21');
INSERT INTO `news_comment` VALUES (8, 25, 3, '大家不必大量屯盐', '2023-12-04 09:46:55');
INSERT INTO `news_comment` VALUES (9, 26, 4, '保护海洋生态系统', '2023-12-08 16:24:00');

DROP TABLE IF EXISTS `news_source`;
CREATE TABLE `news_source`  (
  `source_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '名称',
  `source_introduction` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '简介',
  `bilibili_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'twitter',
  `weibo_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'facebook',
  `douyin_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'instagram',
  `source_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '图标路径',
  PRIMARY KEY (`source_name`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci COMMENT = '新闻来源' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of news_source
-- ----------------------------
INSERT INTO `news_source` VALUES ('中国新闻网', '中国新闻网是中国新闻网络中心旗下的综合新闻网站，提供时政、国际、社会、财经、大湾区、华人、文体等各类新闻资讯，以及视频、直播、图片、创意等多媒体创作', 'https://space.bilibili.com/3494350480738883?spm_id_from=333.337.0.0', 'https://weibo.com/u/1784473157','https://www.douyin.com/user/MS4wLjABAAAAzj4u2OtfzpiT_YUAEIGfMXgAww1aW_Cqaat7ZDWtNGo',  'China_network.jpg');
INSERT INTO `news_source` VALUES ('央视网', '央视网新闻频道提供最新的国内外新闻、评论、视频、财经、体育、教育等资讯，以及央视各频道的直播、节目单、栏目、片库等内容。关注人民领袖习近平联播+、央视快评、央视 …', 'https://space.bilibili.com/33775467?spm_id_from=333.337.0.0', 'https://s.weibo.com/weibo?q=%E5%A4%AE%E8%A7%86%E7%BD%91','https://www.douyin.com/user/MS4wLjABAAAA4vgRHGrSG6rPlffm3RvwHWL8TBq7O4YnM5jHUNXz0-s', 'CCTV_network.jpg');
INSERT INTO `news_source` VALUES ('人民网', '人民网，是世界十大报纸之一《人民日报》建设的以新闻为主的大型网上信息发布平台，也是互联网上最大的中文和多语种新闻网站之一。 作为国家重点新闻网 …', 'https://live.bilibili.com/8178490?live_from=84002&spm_id_from=333.337.0.0','https://weibo.com/u/2286908003', 'https://www.douyin.com/user/MS4wLjABAAAA-Hb-4F9Y2cX_D0VZapSrRQ71BarAcaE1AUDI5gkZBEY', 'people_network.png');

DROP TABLE IF EXISTS `news`;
select* from news;
CREATE TABLE `news`  (
  `news_id` int(0) NOT NULL AUTO_INCREMENT COMMENT '标号',
  `news_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '标题',
  `news_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '内容',
  `news_photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '配图路径',
  `news_date` date NOT NULL COMMENT '发表日期',
  `news_source` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '来源',
  `news_abstract` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '摘要',
  `news_views` int(0) NULL DEFAULT 0 COMMENT '浏览计数',
  PRIMARY KEY (`news_id`) USING BTREE,
  INDEX `news_source_fk`(`news_source`) USING BTREE,
  CONSTRAINT `news_source_fk` FOREIGN KEY (`news_source`) REFERENCES `news_source` (`source_name`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;
create database yiiadvanced;
-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES (1, '核污水岂能“一排了之”', '2021年4月，日本政府宣布，将采取排放入海的方式解决与日俱增的核污水问题。为给核污水正名，日本政府还曾联系市民团体，要求停止使用“核污水”的说法，改为使用“核处理水”，以达到“洗白”目的。日本政府还就排海方案大力进行“公关”。这样的劣迹很难让人相信东电公司会将...','101.png','2023-06-16','人民网','核污水岂能“一排了之”', 1011);
INSERT INTO `news` VALUES (2, '日本福岛核污水排海隧道竣工，待处理核污水已累积133万吨', '日本政府将根据国际原子能机构关于核污水安全的综合报告内容，最终决定何时开始排海。','102.png' ,'2023-06-27','央视网','日本政府将根据国际原子能机构关于核污水安全的综合报告内容，最终决定何时开始排海。',523);
INSERT INTO `news` VALUES (3, '国际热评：日本应正视福岛核污水问题 停止混淆视听', '日本政府将根据国际原子能机构关于核污水安全的综合报告内容，最终决定何时开始排海。','103.png' ,'2023-06-27','央视网','日本政府将根据国际原子能机构关于核污水安全的综合报告内容，最终决定何时开始排海。',523);
INSERT INTO `news` VALUES (4, '韩媒评论：日本排了核污水，也丢了良心', '海外网6月16日电 据韩国《韩民族日报》16日发表评论文章，认为日本政府应放弃将核污水排入海洋，此举不光危害到其它国家的利益，还将对人类共同的资产海洋造成破坏。“日本排放了核污水，也丢了良心。”

《韩民族日报》表示，有人在办公室吸烟，别人提醒他注意时，他无理地说，“就算我在这里抽掉一整盒烟，你就会因为被动吸烟得癌症吗？”如今要将福岛核污水排入海洋，未来数十年将对相关海洋造成重大影响的日本的态度，和这位抽烟者如出一辙。日本排放了核污水，也丢掉了良心。

《韩民族日报》认为，2011年3月，福岛第一核电站发生重大事故，其影响至今留存。核电站1至3号机的1496个核燃料棒部分燃烧，铯元素等核分裂生成物质原本被封闭在核反应堆中，但事故发生后，这些物质大量随风流入大气中，散布到全球各地。

此外，核反应堆中溶解的核燃料残骸也在不断污染着地下水源。高浓度的核污水在一段时间内，每天向大海流入300吨。至于泄漏的核污水总量，没人能知道。福岛沿岸至今还能捕获到遭受污染的鱼类。','104.png' ,'2023-06-16','人民网','海外网6月16日电 据韩国《韩民族日报》16日发表评论文章，认为日本政府应放弃将核污水排入海洋，此举不光危害到其它国家的利益，还将对人类共同的资产海洋造成破坏。“日本排放了核污水，也丢了良心。”如今要将福岛核污水排入海洋，未来数十年将对相关海洋造成重大影响的日本的态度，和这位抽烟者如出一辙。日本排放了核污水，也丢掉了良心。高浓度的核污水在一段时间内，每天向大海流入300吨。',412);
INSERT INTO `news` VALUES (5, '一份报告背不动日本核污水排海这口“锅”（望海楼）', '近日，国际原子能机构发布了日本福岛核污染水处置综合评估报告。从日本国内到沿太平洋地区再到国际社会，有大量声音对这份报告认为日本核污水排海方案“总体符合国际安全标准”的说法表达了强烈反对和质疑。

　　中国外交部最近连续多天发声，明确指出，报告不能成为日方核污水排海的“护身符”和“通行证”。就连发布报告的国际原子能机构总干事格罗西也强调，核污水排海是日本政府的“国家决定”，报告并非是对这一决定的“推荐”或“背书”。

　　问题兜兜转转，仍然还在原点。日本所面临的问题始终是，核污水排海这个“国家决定”本身，具备正当性、合法性、安全性吗？

　　答案明显是否定的。福岛核事故发生之后，面对后续次生灾害，各国专家提出了很多处置方案。科学界认为，在这些方案中，核污水排海绝非最优解，而是史无前例的冒险之举。研究显示，福岛核污水一旦排海，57天内放射性物质将扩散至太平洋大半区域，10年后蔓延至全球海域。','105.png' ,'2023-06-27','人民网','中国外交部最近连续多天发声，明确指出，报告不能成为日方核污水排海的“护身符”和“通行证”。科学界认为，在这些方案中，核污水排海绝非最优解，而是史无前例的冒险之举。研究显示，福岛核污水一旦排海，57天内放射性物质将扩散至太平洋大半区域，10年后蔓延至全球海域。　　日方自从2021年4月宣布要将核污水排海后，就在想尽办法寻求佐证和背书。方案提出两年之后，日方依然未能就核污水排海对生',222);
INSERT INTO `news` VALUES (6, '日本政府：2023年夏季排放福岛核污水的计划不变', '中新网7月3日电 据日本时事通讯社报道，3日，日本内阁官房长官松野博一表示，日方计划在2023年夏季排放福岛核污水的计划没有变化。

　　据报道，此前，日本公明党党首山口那津男表示，排污日期“应尽量避免海水浴季节”。

　　对此，松野博一在会见记者时表示，日本政府决定在2023年夏季排放福岛核污水的方针没有改变。

　　此前报道，日本首相岸田文雄计划在7月4日会见国际原子能机构总干事格罗西，格罗西将在当天向日方提出关于福岛核污水排放问题的调查报告，日方计划对内容进行评估后，正式决定核污水排放日期。

　　根据东京电力公司的计划，将在2023年夏天正式开启福岛核污水排放。','106.png' ,'2023-06-27','人民网','中新网7月3日电 据日本时事通讯社报道，3日，日本内阁官房长官松野博一表示，日方计划在2023年夏季排放福岛核污水的计划没有变化。 　　对此，松野博一在会见记者时表示，日本政府决定在2023年夏季排放福岛核污水的方针没有改变。 　　此前报道，日本首相岸田文雄计划在7月4日会见国际原子能机构总干事格罗西，格罗西将在当天向日方提出关于福岛核污水排放问题的调查报告，日方计划对内容进',333);
INSERT INTO `news` VALUES (7, '余雯：福岛核污水排海的环境生态影响尚不明确', '北京师范大学国家安全与应急管理学院研究员、博士生导师余雯对人民网财经表示，福岛核污水排海对周边国家海洋生态、食品安全和人体健康的长期影响需长期监测、系统研究。

余雯认为，通过对比地质注存法、氢气排放法、地下埋藏法、蒸发法、排海法等5种福岛核污水处理方法后，日本政府最终决定选择成本最低、对本国环境影响最小的排海法，本质上是把本国的风险转移给全人类共同承担，此做法违背《国际海洋法公约》，也违反了《伦敦倾废公约》中禁止将放射性物质排放进入海洋的规定，不是一个负责任国家应该做出的决策。在排海决策正当合法性存在严重缺陷的情况下，即使IAEA作出排海计划符合国际安全标准的结论，也不能成为日方启动排海的“通行证”。','107.png' ,'2023-06-27','人民网','北京师范大学国家安全与应急管理学院研究员、博士生导师余雯对人民网财经表示，福岛核污水排海对周边国家海洋生态、食品安全和人体健康的长期影响需长期监测、系统研究。她指出，与核电站正常工况下的液态流出物完全不同，福岛核污水曾直接与熔融堆芯接触，至少包含60多种核素，其中氚和碳-14是日本提出的多核素处理系统（ALPS）完全无法去除的。“此外，ALPS对多种核素的去除效率也很不稳定，',567);
INSERT INTO `news` VALUES (8, '日本决定今年春夏季节开始将核污水排海', '人民网东京1月13日电 据日本TBS电视台报道，日本政府决定，将在今年春夏季节开始将福岛核污水排海。

据报道，日本政府在当天召开的相关阁僚会议上指出，福岛第一核电站核污水排放设备已完工，经过了原子能规则委员会的检查等，决定将于“今年春季至夏季期间”开始排海。

此外，面对日本国内渔业从业者的强烈抗议，日本政府将新设500亿日元基金用于补贴开拓新渔场所需费用。','108.png' ,'2023-06-27','人民网','人民网东京1月13日电 据日本TBS电视台报道，日本政府决定，将在今年春夏季节开始将福岛核污水排海。据报道，日本政府在当天召开的相关阁僚会议上指出，福岛第一核电站核污水排放设备已完工，经过了原子能规则委员会的检查等，决定将于“今年春季至夏季期间”开始排海。',345);
INSERT INTO `news` VALUES (9, '日本核监管机构正式批准福岛核污水排海计划', '日本核监管机构原子能规制委员会22日召开会议，正式认可了东京电力公司福岛第一核电站的核污水排海计划。按此计划，如果再获得地方政府同意，东京电力公司将于明年春天开始排放核污水。

　　日本原子能规制委员会5月对排放计划的“审查书”草案进行了确认，称内容“没有问题”，之后进入公开征集意见环节。公开征集到的1200多份意见中有670份是技术层面的意见，包括对核污水浓度测定和设备抗震方面的担心等。日本原子能规制委员会22日对征集到的意见进行了讨论，认为东京电力公司的应对“妥当”，对其核污水排放计划予以认可。

　　东京电力公司的排放计划获得日本原子能规制委员会的正式认可，且获得福岛县等的同意后，将可启动排放计划。共同社早前报道说，排放计划能否获得地方政府的同意将成为焦点。','109.png' ,'2023-06-27','人民网','新华社东京7月22日电（记者华义）日本核监管机构原子能规制委员会22日召开会议，正式认可了东京电力公司福岛第一核电站的核污水排海计划。按此计划，如果再获得地方政府同意，东京电力公司将于明年春天开始排放核污水。 　　日本原子能规制委员会5月对排放计划的“审查书”草案进行了确认，称内容“没有问题”，之后进入公开征集意见环节。公开征集到的1200多份意见中有670份是技术层面的意见，',111);
INSERT INTO `news` VALUES (10, '日本渔民悲呼:核污水一旦排海当地渔业将再受重创', '核污水一旦排放入海，经过十余年努力刚刚复苏的福岛渔业将再次遭受重创。福岛县相马原釜鱼市场竞买人协同组合长佐藤喜成表示：“现在福岛出产的鱼类价格依旧很低，十年过去了人们的收入还是不到过去的一半。如果政府排放核污水，肯定会导致产地形象受损。”

　　日本消费者厅在福岛核事故发生后开展的消费者意识调查显示，2013年40.9%的消费者注重食品产地的理由是“不想购买含有放射性物质的食品”，其中69.5%的消费者在购买福岛产地的食品时会感到犹豫。

　　福岛核事故发生后，福岛产地的食品陷入无人问津、销量不佳、进货量减少的恶性循环。近年来，福岛产生鲜食品销量虽然有所回升，但福岛县农产品流通科负责人表示：“一旦市场份额被其他地区的产品抢占，就很难恢复至以往的水平。”日本核污水排海计划对于正在恢复中的福岛产地形象可谓是雪上加霜。','110.png' ,'2023-06-27','人民网','人民网东京7月5日电 （许可、陈建军）日本福岛核污水排海计划进入倒计时。该报告虽然没有否定日本福岛核污水排海计划，但同时强调“并不意味着推荐和支持排海计划”。另外，国际原子能机构将在福岛第一核电站设置事务所，继续评估核污水排海过程中和排海后的安全',145);
INSERT INTO `news` VALUES (11, '日本福岛核污水排海部分设备已启动', '','111.png' ,'2023-06-27','人民网','',457);
INSERT INTO `news` VALUES (12, '', '中新网3月19日电 据共同社日前报道，福岛第一核电站核污水排海的部分相关设备，在通过日本原子能规制委员会的检查后于17日开始运行。报道称，这是核污水排海相关设备首次开始运行。

据报道，东京电力公司16日宣布，福岛第一核电站核污水(含放射性物质氚)的排海设备已完成施工并通过检查，从17日起，核电站正式启动设备运转，预计将用两个月左右的时间来推进核污染水的测定。

报道称，设备包含以管道连接的10个储罐共3组，注入待处理核污水后，通过搅拌9000吨核污水，使水中放射性物质浓度均一，在经过6天以上的循环后，可确认氚以外的放射性物质是否未超过标准值。

东电负责人表示，“将开始对计划实际最先排放的核污水进行循环和分析。”分析工作预计耗时约2个月。','112.png' ,'2023-06-27','央视网','中新网3月19日电 据共同社日前报道，福岛第一核电站核污水排海的部分相关设备，在通过日本原子能规制委员会的检查后于17日开始运行。报道称，这是核污水排海相关设备首次开始运行。据报道，东京电力公司16日宣布，福岛第一核电站核污水(含放射性物质氚)的排海设备已完成施工并通过检查，从17日起，核电站正式启动设备运转，预计将用两个月左右的时间来推进核污染水的测定。报道称，设备包含',763);
INSERT INTO `news` VALUES (13, '福岛核污水超标2万倍？韩国政府发布调查“打脸”日方', '15日，韩国国务调整室第一次长朴购然表示，韩方将密切关注日本福岛核电站核污水排放问题，即日起每天发布核污水排海安全检测相关信息。

　　针对此前有报道称，“即使经过处理，福岛核污水的污染数值仍超标2万倍”，朴购然表示报道属实，他补充说，按韩国标准来说，福岛核污水的放射性物质锶的检出量超标2.165万倍，即便按日本标准，也超出了近1.5万倍。

　　不仅如此，在16日的发布会上，朴购然进一步透露，韩国政府福岛核污水处理设施考察团在5月赴日实地考察时，获知福岛核电站的多核素处理系统(ALPS)在2013年至2022年间，共发生过8次故障，包括设备腐蚀、设备过滤器故障等。

　　目前，韩方工作组正在就相关资料进行分析，并将对多核素处理系统能否长期运转进行确认。','113.png' ,'2023-06-27','央视网','核污水处理后也不安全　　污染值超标2万倍　　15日，韩国国务调整室第一次长朴购然表示，韩方将密切关注日本福岛核电站核污水排放问题，即日起每天发布核污水排海安全检测相关信息。',359);
INSERT INTO `news` VALUES (14, '韩政府就福岛核污水入海问题召见日本公使 核污水已超百吨', '韩国外交部19日召见日本驻韩国大使馆经济公使，要求日本政府对福岛核电站污水排放计划作出说明。

　　韩国外交部表达了韩国政府对福岛核电站污水处理问题的关切和担忧，要求日本政府向国际社会公开透明地具体说明福岛核电站污水的处理计划。此前有消息称， 日本计划将100万吨以上的福岛核电站污水排入大海。

　　13日，韩国外交部发言人金仁澈在例行记者会上介绍，韩国政府于2018年8月首次获悉日本政府的核污水排放计划，此后持续向日方提出交涉，日方则始终回应称，何时、如何最终处理福岛核污水，仍处于研讨阶段。','114.png' ,'2023-06-27','央视网','13日，韩国外交部发言人金仁澈在例行记者会上介绍，韩国政府于2018年8月首次获悉日本政府的核污水排放计划，此后持续向日方提出交涉，日方则始终回应称，何时、如何最终处理福岛核污水，仍处于研讨阶段。',865);
INSERT INTO `news` VALUES (15, '韩国专家团在日本启动福岛核污水处理考察工作', '赴日考察福岛核电站污水排放工作的韩国专家考察团22日正式开启考察行程。

　　韩联社22日报道称，据福岛核污水应对部门工作组（TF）消息，21日抵日的韩国专家考察团22日召开筹备会议，随后将同日方举行技术会议。据悉，东京电力公司、日本经济产业省、日本原子力规制委员会等日方代表将与会，并回答韩方提问。

　　23日至24日，考察团将确认福岛第一核电站的污水管理情况，并于25日基于现场考察内容再次举行技术会议，对考察内容进行深度研讨。考察团将于26日返回韩国。

　　考察团共21人，包括韩国原子力安全技术院（KINS）的19名核电、辐射防护专家，以及韩国海洋科学技术院（KIOST）的1名海洋环境放射性污染监测专家，韩国原子能安全委员会委员长刘国熙担任团长。','115.png' ,'2023-06-27','央视网','福岛第一核电站核污水仓。视觉中国 资料图　　赴日考察福岛核电站污水排放工作的韩国专家考察团22日正式开启考察行程。　　',790);
INSERT INTO `news` VALUES (16, '日本政府确认福岛核污水预计于2023年春夏前后排放入海', '中新网1月13日电 据日本共同社报道，日本政府13日在首相官邸召开了东京电力福岛第一核电站核污水处置相关阁僚会议。会议确认在设备施工结束与经过原子能规制委员会的完工检验后，预计“今春至夏季前后”启动核污水排海。

　　据报道，会议还修改政府行动计划，写明将通过新设500亿日元基金，为受到排海影响的全国渔业人士提供支援。

　　2021年4月，日本政府正式决定将福岛核污水经过滤并稀释后排放入海，但该决定遭到国际社会广泛质疑和反对，在日本国内也引发强烈担忧。','116.png' ,'2023-06-27','央视网','中新网1月13日电 据日本共同社报道，日本政府13日在首相官邸召开了东京电力福岛第一核电站核污水处置相关阁僚会议。',385);
INSERT INTO `news` VALUES (17, '无视反对 日本东电称需在2030年前排40万吨核污水入海', '海外网2月5日电据日媒《福岛民友》4日报道，东京电力公司（东电）近日公布估算数据称，为确保2030年福岛第一核电站拆除工程有足够的场地，核电站需在此之前向海洋排放40万吨左右处理过的核污水。

　　根据计划，截至2030年左右，东电需在福岛核电站留出约5万至11万平方米的空地，届时将撤去排空的核污水容器，设置拆除设施。目前，福岛第一核电站有1066个核污水容器，及132万吨核污水。保存40万吨核污水的容器约占所有容器的四成左右。

　　受地下水流入核反应堆建筑等因素影响，核电站每天产生约100吨左右核污水。东电将核污水产生量也计算在内，估算了截至2030年需要排入海洋的核污水量。东电近期在福岛市召开会议，在会上公布了相关数据。参会的市民团体要求东电将排污入海计划详细向民众，特别是年轻人告知。

　　日本福岛核电站最早定于今年春季排污入海，该决定遭到国际社会广泛质疑和反对，在日本国内也引发强烈担忧。','117.png' ,'2023-06-27','央视网','保存40万吨核污水的容器约占所有容器的四成左右。　　受地下水流入核反应堆建筑等因素影响，核电站每天产生约100吨左右核污水。东电将核污水产生量也计算在内，估算了截至2030年需要排入海洋的核污水量。',754);
DELETE FROM news WHERE news_id = 18;
INSERT INTO `news` VALUES (18, '渔民与海，波涛中那份情感交织', '今年71岁的牛春霞从小在山东省烟台市初旺村长大，往年9月初，为期4个月的黄渤海休渔期结束，歌舞声中，百艘渔船离港，这是一年里渔民最重视的时刻。今年的开海节没了，村民们加班加点搭好的台子只得拆掉。她一打听，传言是因为核污水排放，开海不要“动静太大”。

　　依傍国内四大渔场之一黄渤海渔场的初旺村，有着胶东地区最大的群众性渔港。

　　当互联网上充斥着对海鲜与渔业的焦虑，现实中的初旺村似乎显得平静。

　　余波是漫长的。随着海洋资源衰退、出海成本增加，减船转产已成为渔村的普遍趋势。回不去的传统渔业，将走向何处？','1.png','2023-11-06','人民网','随着海洋资源衰退、出海成本增加，减船转产已成为渔村的普遍趋势。 　　轻量化的休闲渔业、水产品加工流通等附属产业会成为未来很多退捕渔民的转产方向。 　　但近海捕捞不会消亡。漫长海岸线上仍有500多万传统渔民，虽然本地年轻人正在退出捕捞...', 1011);
DELETE FROM news WHERE news_id = 19;
INSERT INTO `news` VALUES (19, '日本启动第二轮排海前准备工作 预计排放约7800吨核污水', '据报道，测定即将排入海洋的核污染水中的氚浓度，如果浓度符合其所谓的“标准”，将于5日正式开始第二轮核污染水排海。

　　报道称，第二轮排放的核污染水总量预计仍将在7800吨左右，与第一轮7788吨核污染水排放量大致相同，排放周期约为17天。

　　报道介绍，截至9月21日，福岛第一核电站内约有134万吨核污染水，达到储罐容量的约占98%，并计划于2023年分四次，排放共计约3.12万吨核污染水。

　　据此前报道，尽管排海决定遭到日本国内外强烈反对，日本政府和东京电力公司仍于8月24日启动了福岛第一核电站核污染水的排海，第一轮排海于9月11日结束。','2.png','2023-11-11','人民网','中新网10月3日电 据日本共同社报道，东京电力公司3日启动了福岛第一核电站核污染水第二轮排海前准备工作。 资料图：日本福岛第一核电站。 　　据报道，测定即将排入海洋的核污染水中的氚浓度，如果浓度符合其所谓的“标准”，将于5日正式...
', 1011);

DELETE FROM news WHERE news_id = 20;
INSERT INTO `news` VALUES (20, '这地议会通过意见书 要求日本政府中止核污染水排海', '2021年4月，日本政府宣布，将采取排放入海的方式解决与日俱增的核污水问题。为给核污水正名，日本政府还曾联系市民团体，要求停止使用“核污水”的说法，改为使用“核处理水”，以达到“洗白”目的。日本政府还就排海方案大力进行“公关”。这样的劣迹很难让人相信东电公司会将...','3.png','2023-10-31','人民网','中新网9月20日电 据日本共同社报道，当地时间19日，日本北海道函馆市议会以首相岸田文雄“无视渔业人士等的反对声音而实施”等为由，表决通过了要求政府立即中止核污染水排海的意见书。同时，该市议会还要求政府采取对策，防止核污水进一步增加。 ...', 1011);

DELETE FROM news WHERE news_id = 21;
INSERT INTO `news` VALUES (21, '日本7800吨核污水全部排入海洋 第二批已在路上！', '　报道称，该意见书指出，日本政府和东电无视对渔业人士做出的“在未获得相关人士理解之前不会处理”的承诺。意见书称，“绝不允许(因排海)妨碍当地渔业的重振”，政府应优先采取措施应对污染地下水等问题。

　　据北海道函馆市议会事务局介绍，当天，在全体会议上进行表决时，以14对12的多数赞成票通过了该意见书。','4.png','2023-12-01','人民网','核污水岂能“一排了之”', 1011);

DROP TABLE IF EXISTS `historical_activity`;
CREATE TABLE `historical_activity`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `user_id` int(0) NULL DEFAULT NULL,
  `time` datetime(0) NULL DEFAULT NULL,
  `table_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  `operation` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;
select *from historical_activity;
-- ----------------------------
-- Records of historical_activity
-- ----------------------------
INSERT INTO `historical_activity` VALUES (1, 1, '2023-12-01 11:42:31', 'news', 'update');
INSERT INTO `historical_activity` VALUES (2, 2, '2023-12-03 11:43:24', 'qa', 'delete');
INSERT INTO `historical_activity` VALUES (5, 1, '2023-12-03 21:38:12', 'news', 'update');
INSERT INTO `historical_activity` VALUES (6, 1, '2023-12-04 21:47:39', 'news', 'create');
INSERT INTO `historical_activity` VALUES (7, 1, '2023-12-04 21:54:39', 'qa', 'update');
INSERT INTO `historical_activity` VALUES (8, 1, '2023-12-06 10:10:41', 'news', 'create');
INSERT INTO `historical_activity` VALUES (9, 1, '2023-12-06 10:10:44', 'news', 'update');
INSERT INTO `historical_activity` VALUES (10, 1, '2023-12-08 10:23:11', 'news', 'update');
INSERT INTO `historical_activity` VALUES (11, 1, '2023-12-08 10:23:17', 'news', 'update');
INSERT INTO `historical_activity` VALUES (12, 3, '2023-12-08 15:11:23', 'news_comment', 'update');
INSERT INTO `historical_activity` VALUES (13, 4, '2023-12-10 00:03:32', 'price', 'update');

-- ----------------------------
-- Table structure for historical_views
-- ----------------------------
DROP TABLE IF EXISTS `historical_views`;
CREATE TABLE `historical_views`  (
  `id` int(0) NOT NULL AUTO_INCREMENT,
  `time` date NULL DEFAULT NULL,
  `count` int(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of historical_views
-- ----------------------------
INSERT INTO `historical_views` VALUES (1, '2023-12-01', 122);
INSERT INTO `historical_views` VALUES (2, '2023-12-01', 157);
INSERT INTO `historical_views` VALUES (3, '2023-12-02', 223);
INSERT INTO `historical_views` VALUES (4, '2023-12-02', 91);
INSERT INTO `historical_views` VALUES (5, '2023-12-04', 232);
INSERT INTO `historical_views` VALUES (6, '2023-12-04', 242);
INSERT INTO `historical_views` VALUES (7, '2023-12-08', 221);
INSERT INTO `historical_views` VALUES (8, '2023-12-08', 245);
INSERT INTO `historical_views` VALUES (9, '2023-12-09', 311);
INSERT INTO `historical_views` VALUES (10, '2023-12-09', 425);
INSERT INTO `historical_views` VALUES (11, '2023-12-10', 330);
INSERT INTO `historical_views` VALUES (12, '2023-12-10', 0);
INSERT INTO `historical_views` VALUES (13, '2023-12-11', 0);
INSERT INTO `historical_views` VALUES (14, '2023-12-12', 114);

DROP TABLE IF EXISTS `databasemigration`;
CREATE TABLE `databasemigration` (
  `version` varchar(180) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `application_date` int DEFAULT NULL,
  PRIMARY KEY (`version`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `databasemigration`
--

INSERT INTO `databasemigration` VALUES ('m111123_123123_base',1864624059),('m432563_243423_init',1864624059),('m764534_333245_base',1864624059);

DROP TABLE IF EXISTS `qa`;
CREATE TABLE `qa`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `question` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `answer` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` int NULL DEFAULT 9,
  `priority` int(11) UNSIGNED ZEROFILL NULL DEFAULT 00000000007,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of qa
-- ----------------------------
INSERT INTO `qa` VALUES (1, 'Q：核污水是什么？', 'A：核污水是指受到核污染的水体，通常由核事故引起。', 10, 00000000001);
INSERT INTO `qa` VALUES (2, 'Q：核污水是如何产生的？', 'A：核污水往往源于核事故，事故导致核电站安全措施受损，使得不期望的水体（例如渗入场址的地下水）与放射性物质直接接触而被污染。', 10, 00000000002);
INSERT INTO `qa` VALUES (3, 'Q: 核污水排海对经济发展的影响？', 'A：核污染水排放不仅对渔业产生直接冲击，还对整个经济系统造成了广泛的间接影响：旅游业受损: 污染影响美丽的海滩和沿海地区，可能损害旅游业，降低了旅游业的收入。', 10, 00000000003);
INSERT INTO `qa` VALUES (4, 'Q：核污水排海对人类健康的影响？', 'A：核污水中含有放射性物质,如铯、锶、钴等,这些物质会产生电离辐射。长期接触放射性物质会导致细胞遗传物质DNA的损伤,引发癌症、畸形儿等严重健康问题。', 10, 00000000004);
INSERT INTO `qa` VALUES (5, 'Q：核污水排海对海洋环境的影响？', 'A：将核污水排放到太平洋可能导致海洋生态系统受到污染。这些放射性物质将随着洋流和海洋生物扩散到全球各地，对海洋生态系统和人类健康构成潜在威胁。', 10, 00000000005);
INSERT INTO `qa` VALUES (6, 'Q：核污水排海对国际政治的影响？', 'A:日本核污水排放问题引发了国际社会的关注和争议。国家间会因此产生紧张关系，影响地区和谐与合作。', 10, 00000000006);
-- ----------------------------

DROP TABLE IF EXISTS `views`;
CREATE TABLE `views`  (
  `id` int NOT NULL,
  `country` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `img_path` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `identity` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of motto
-- ----------------------------
INSERT INTO `views` VALUES (1, '英国', '英国外交发展部发表声明称，英方支持日本政府采取核污水排海行动，对此驻英国使馆发言人表明立场，谴责日本将核污染风险转嫁给全世界，这是不负责任的行为。如果英国还是一个负责任的国家，就应该明确发对和谴责日本的错误行为。', '../web/statics/assets/img/testimonials/views-1.jpg', '采访');
INSERT INTO `views` VALUES (2, '加拿大', '许多加拿大产业者表示坚决反对日本核污水排海，这将对海洋生物和海洋环境造成极大的危害。日本将核污水排海是极不负责的行为。', '../web/statics/assets/img/testimonials/views-2.jpg', '街头采访');
INSERT INTO `views` VALUES (3, '中国', '中方反对福岛核污染水排海的立场是一贯、明确的。日本福岛核污染水排海事关人类健康，事关全球海洋环境，事关国际公共利益。', '../web/statics/assets/img/testimonials/views-3.jpg', '记者发布会');
INSERT INTO `views` VALUES (4, '新加坡', '新加坡居民表示，并不相信核污水排海会没有影响。至于日本的水产，也将严格进行放射物质检测，确保其安全性。', '../web/statics/assets/img/testimonials/views-4.jpg', '街头采访');
INSERT INTO `views` VALUES (5, '美国', '美国布林肯针对日本投放核废水一事给出明确的态度。他声称美国对于日本的所作所为感到“满意”，也就是认同的他们的作为，其理由无他，就是单单因为国际原子能机构的鉴定。', '../web/statics/assets/img/testimonials/views-5.jpg', '记者发布会');
