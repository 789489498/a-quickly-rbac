-- MySQL dump 10.16  Distrib 10.1.19-MariaDB, for Win32 (AMD64)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.1.19-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `zm_admin_user`
--

DROP TABLE IF EXISTS `zm_admin_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_admin_user` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `username` varchar(32) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '登录密码',
  `operator` varchar(32) NOT NULL DEFAULT '' COMMENT '操作人',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_admin_user`
--

LOCK TABLES `zm_admin_user` WRITE;
/*!40000 ALTER TABLE `zm_admin_user` DISABLE KEYS */;
INSERT INTO `zm_admin_user` VALUES (46,'zhuwanxiong-xy','d117f2771ec2ae5236b59212e7f015ee','zhuwanxiong-xy','2017-01-07 15:58:05','2017-02-12 06:06:12'),(47,'test','e10adc3949ba59abbe56e057f20f883e','zhuwanxiong-xy','2017-02-18 12:07:16','2017-03-17 14:57:56');
/*!40000 ALTER TABLE `zm_admin_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_article`
--

DROP TABLE IF EXISTS `zm_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_article` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `title` varchar(64) NOT NULL DEFAULT '' COMMENT '文章标题',
  `content` text NOT NULL COMMENT '详情信息',
  `image` varchar(255) NOT NULL DEFAULT '' COMMENT '图片',
  `video` varchar(255) NOT NULL DEFAULT '' COMMENT '视频',
  `vimg` varchar(255) NOT NULL DEFAULT '' COMMENT '视频图片',
  `category_id` int(12) unsigned NOT NULL DEFAULT '0' COMMENT '文章分类fk',
  `tag` varchar(12) NOT NULL DEFAULT '' COMMENT '标签',
  `favorite` bigint(12) unsigned NOT NULL DEFAULT '0' COMMENT '喜欢次数',
  `pageview` bigint(12) unsigned NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `comment` bigint(12) unsigned NOT NULL DEFAULT '0' COMMENT '评论次数',
  `is_display` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否显示(0:否1:是)',
  `item_id` int(12) unsigned NOT NULL DEFAULT '0' COMMENT '商品_fk',
  `operator` varchar(32) NOT NULL DEFAULT '' COMMENT '操作人',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `k_item_id` (`item_id`) USING BTREE,
  KEY `k_title` (`title`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_article`
--

LOCK TABLES `zm_article` WRITE;
/*!40000 ALTER TABLE `zm_article` DISABLE KEYS */;
INSERT INTO `zm_article` VALUES (17,'香奈儿高级成衣 秀场妆容揭秘','<p style=\"margin-bottom: 0px; padding: 0px; list-style: none; line-height: 26px; font-family: SimSun; color: rgb(43, 43, 43); text-align: -webkit-center; overflow: visible !important;\"><font face=\"华文细黑\" size=\"3\"><span style=\"line-height: 27.2px;\"><b><img src=\"http://himg2.huanqiu.com/attachment2010/2017/0317/17/21/20170317052131572.jpg\" style=\"border-width: initial; border-style: none; max-width: 600px; height: 266px; overflow: hidden; margin: 30px auto 10px; width: 400px;\"></b></span></font></p><p style=\"margin: 23px auto 0px; padding: 0px; list-style: none; line-height: 26px; font-family: SimSun; color: rgb(43, 43, 43); overflow: visible !important;\">　　<span style=\"line-height: 26.6667px; font-size: 11pt; font-family: _534e_6587_7ec6_9ed1;\">&nbsp; &nbsp; &nbsp;本季，</span><span style=\"line-height: 26.6667px; font-size: 11pt; font-family: _534e_6587_7ec6_9ed1;\">卡尔·拉格斐</span><span style=\"line-height: 26.6667px; font-size: 11pt; font-family: _534e_6587_7ec6_9ed1;\">在巴黎大皇宫中央建起一座香奈儿5号发射台，并架起一艘高达35米的火箭。九十位模特穿着闪烁星芒的镶钻长靴，头戴绣有水晶和人造珍珠的发带，迈着优雅的步伐，走向宇宙星空。“这是一场穿越天际的旅行，像<a href=\"http://country.huanqiu.com/france\" class=\"linkAbout\" target=\"_blank\" title=\"法国\" style=\"color: rgb(6, 52, 111); border-bottom-width: 1px; border-bottom-style: dotted; border-bottom-color: rgb(6, 52, 111); margin: 0px 5px; padding: 0px 0px 2px; font-size: 14px;\">法国</a>宇航员Thomas Pesquet那样，在群星中遨游。”</span><span style=\"line-height: 26.6667px; font-size: 11pt; font-family: _534e_6587_7ec6_9ed1;\">卡尔·拉格</span><span style=\"line-height: 26.6667px; font-size: 11pt; font-family: _534e_6587_7ec6_9ed1;\">斐解说道。</span></p><p style=\"margin: 23px auto 0px; padding: 0px; list-style: none; line-height: 26px; font-family: SimSun; color: rgb(43, 43, 43); text-align: center; overflow: visible !important;\"><span style=\"line-height: 26.6667px; font-size: 11pt; font-family: _534e_6587_7ec6_9ed1;\"><img src=\"http://himg2.huanqiu.com/attachment2010/2017/0317/17/21/20170317052159576.jpg\" style=\"border-width: initial; border-style: none; max-width: 600px; height: 266px; overflow: hidden; margin: 30px auto 10px; width: 400px;\"></span></p><p style=\"margin: 23px auto 0px; padding: 0px; list-style: none; line-height: 26px; font-family: SimSun; color: rgb(43, 43, 43); overflow: visible !important;\">　　经典斜纹软呢套装采用巧妙的幻象设计，利落的方肩衣袖，仿佛叠加于无袖外套上的独立配饰。银色长款露指手套优雅地盖住手腕。半裙、连衣裙和斜纹软呢大衣等营造出纤长的廓形，下面搭配帅气时髦的百慕大短裤，色调以黑色、白色、银色和灰色为主，偶尔穿插几抹缤纷彩色。此外还有电光蓝与紫，以及闪耀光泽的亮片、幻彩丝线、水晶刺绣以及金属和珠子编结等璀璨元素。</p><p style=\"margin: 23px auto 0px; padding: 0px; list-style: none; line-height: 26px; font-family: SimSun; color: rgb(43, 43, 43); text-align: center; overflow: visible !important;\"><img src=\"http://himg2.huanqiu.com/attachment2010/2017/0317/17/22/20170317052244953.jpg\" style=\"border-width: initial; border-style: none; max-width: 600px; height: 350px; overflow: hidden; margin: 30px auto 10px; width: 400px;\"></p><p style=\"margin: 23px auto 0px; padding: 0px; list-style: none; line-height: 26px; font-family: SimSun; color: rgb(43, 43, 43); overflow: visible !important;\"><span style=\"font-family: _534e_6587_7ec6_9ed1; font-size: 14.6667px; line-height: 26.6667px;\">&nbsp; &nbsp; 这一季的设计强调服装的量感，颇具未来气息的双排扣厚上衣和超大款大衣采用彩色丝线编织软呢、千鸟格纹马海毛或米色细毛呢面料，并配以透明纽扣，下面搭配双面绉绸翻边阔腿裤。名贵树脂材质的上衣则搭配长款钩织鱼尾摆半身裙。直线型剪裁运用严谨的结构表现手法——椭圆形缝线勾勒出连衣裙的主体轮廓，并以流畅的大衣烘托身体线条。晶莹的斜纹软呢外套和丝缎或双面绉绸连衣裙的衣领高高竖起，线条圆润且立挺。晚宴裙装与雪纺衬衫上印有抵抗失重感的宇航员图案，并在领口饰以宛如土星光环的珠宝。</span></p><p style=\"margin: 23px auto 0px; padding: 0px; list-style: none; line-height: 26px; font-family: SimSun; color: rgb(43, 43, 43); text-align: center; overflow: visible !important;\"><span style=\"font-family: _534e_6587_7ec6_9ed1; font-size: 14.6667px; line-height: 26.6667px;\"><img src=\"http://himg2.huanqiu.com/attachment2010/2017/0317/17/23/20170317052308689.jpg\" style=\"border-width: initial; border-style: none; max-width: 600px; height: 266px; overflow: hidden; margin: 30px auto 10px; width: 400px;\"></span></p><p style=\"margin: 23px auto 0px; padding: 0px; list-style: none; line-height: 26px; font-family: SimSun; color: rgb(43, 43, 43); overflow: visible !important;\">一款饰有珍珠滚边的午夜蓝色外套仿佛来自天穹，深邃纯净的色调惹人遐想。连衣裙饰绣以幻彩丝线，或以双面绉绸拼接，模拟未知星球表面的名贵树脂材质。刺绣装饰如此瑰丽璀璨，如点点繁星般落在衣领上、露肩连衣裙的肩带上、丝网绢纱及蕾丝连衣裙上。</p><p style=\"margin: 23px auto 0px; padding: 0px; list-style: none; line-height: 26px; font-family: SimSun; color: rgb(43, 43, 43); overflow: visible !important;\"></p><div class=\"spTopic\" style=\"color: rgb(43, 43, 43); font-family: SimSun; line-height: 26px;\"></div><div class=\"editorSign\" style=\"display: inline-block; width: 596px; text-align: right; color: rgb(154, 154, 154); margin: 50px 0px 10px; padding: 10px 0px 0px; border-top-style: none; font-family: SimSun; line-height: 26px; font-size: 12px !important;\"></div>','http://7xussr.com1.z0.glb.clouddn.com/m42.jpg','http://7xussr.com1.z0.glb.clouddn.com/big_buck_bunny_trailer.webm','http://7xussr.com1.z0.glb.clouddn.com/m42.jpg',2,'国际',0,0,0,0,0,'test','2017-03-19 09:17:57','2017-03-25 13:07:25'),(18,'Gucci 合并男女装秀，性别是不是这年头不太重要的事？','<p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">时尚圈的中性化趋势再一次得到强有力的支持，这次的主角是 Gucci。周二在法国凡尔赛召开的《纽约时报》国际奢侈品大会上，Gucci 首席执行官 Marco Bizzarri 发言呼吁未来的时装展取消性别区分，至少他们的产品系列发布将不再进行男女装的划分。从 2017 年开始，这一开云集团主力品牌将混合男女装进行单一场次的新季发布。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">Bizzarri 认为，“合二为一无疑会大大简化我们的商业运作流程，而男女装分别发布，时间流程上不协调，仅仅是保留传统而非出于实际考虑。”如今男装发布及批发销售都在每年 1 月和 7 月进行，而女装则在 9 月、10 月以及 2 月、3 月进行。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">此举并非创新，此前 Burberry （将于今年 9 月起合并男女装的发布）、Tom Ford (ditto) 以及法国品牌 Vetements （2017 年 1 月举行首场男女装发布会）等都有意改革，<a href=\"http://www.nytimes.com/2016/02/11/fashion/new-york-fashion-week-smartphones-killing-off-runway-show.html\" style=\"color: rgb(15, 20, 25); vertical-align: top; padding-bottom: 4px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(255, 200, 31);\">消除庞杂、费时、费钱的传统模式与当代消费期望之间的差异</a>。不过不同于其他品牌同时宣布将推行“现展、现卖”模式，或者至少像 Vetements 那样，发布会后尽快进行销售——Gucci 并不打算改变现有的产销模式，换言之，其所展示的服装将在 6 个月后进入市场。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">姑且称之为“先看、后卖”政策。考虑到 Gucci 的市场规模及其行业领袖的地位，其战略实际上比听起来更为大胆（据报道称，Gucci 2015 年销售收入为 39 亿欧元，约合 44 亿美元，其在全世界范围内拥有 525 家门店）。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">美国奢侈品百货公司 Barneys New York 前任时尚总监、顾问 Julie Gilhart 表示，“Gucci 绝对算得上行业拓荒者。考虑到其地位，此次可以说是目前为止最具突破性的举动。”</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">表面看来，统一男女装发布合情合理，不仅是因为在消费者看来男装、女装都是衣服。合并两个系列的发布可以直接提高产销效率，并且可以节省大约 100 万欧元的发布成本。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\"></p><div class=\"com-insert-images\" style=\"margin: 33px 40px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\"><figure><img alt=\"\" class=\" lazyloaded\" data-ratio=\"0.66666667\" data-format=\"jpeg\" data-src=\"http://img.qdaily.com/uploads/20160702150549cT8KdO0Uvr2m7LDx.jpg-WebpWebW640\" src=\"http://img.qdaily.com/uploads/20160702150549cT8KdO0Uvr2m7LDx.jpg-WebpWebW640\" style=\"vertical-align: top; opacity: 1; transition: opacity 0.5s; display: block; margin: 0px auto 16px; width: 575px; height: 383.333px; max-width: 100%;\"><figcaption class=\"\" style=\"padding: 0px 20px 16px; color: rgb(166, 166, 166); text-align: center; font-size: 15px; line-height: 24px;\">米兰时装周期间 Gucci 2016 秋装发布后台。图片版权：Valerio Mezzanotti／纽约时报</figcaption></figure></div><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">此外，当下男女装真正越走越近（LV 请美国男星<a href=\"http://www.nytimes.com/2016/01/07/fashion/jaden-smith-for-louis-vuitton-the-new-man-in-a-skirt.html\" style=\"color: rgb(15, 20, 25); vertical-align: top; padding-bottom: 4px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(255, 200, 31);\">&nbsp;Jaden Smith</a>&nbsp;穿上女裙拍摄广告），中性服饰日益走红，Gucci 创意总监 Alessandro Michele 也时常请男模参与女装发布，双线合并所传达的真正讯息在于单一品牌的审美取向将超越性别的界限。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">Michele 在声明中指出，“这样做将赋予我叙事的新方法。”</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">不过，针对合并男女时装周的倡议，从机构和地方政府的角度都不乏反对的声音。时装周期间举办城市作为东道主自然可以大赚一笔。每一季新品发布都会吸引大量买家、评论家以及各种协助人员涌入各个城市，对于相关产业而言意味着经济上的一次次爆发。根据 2012 年非盈利机构纽约市经济发展组织的分析，女装发布周“可以实现每年 8.87 亿美元的经济影响力”。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">2015 年 7 月纽约时装周引入男装发布，此前 2012 年伦敦首度开始男装发布。在此之前，男装发布专门在米兰和巴黎特定时间段上演，配合佛罗伦萨 Pitti Uomo 男装展销会同步进行。纽约男装周首秀吸引了约 3000 人前往。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">目前尚未公布 Gucci 首次男女装联合发布会的具体时间，不过考虑当下 Gucci 男装的销售占总额的 35%，而女装占 65%，估计联合发布将在女装发布季期间进行。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">倘若如此，Gucci 将缺席米兰男装周，对于大量买家而言意味着一大时间空档。再者，考虑到当下网络看秀十分便捷，众多买家、评论人士可能因此缺席现场，至少人数上会减少。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">Bizzarri 表示 Gucci 向来与<a href=\"http://topics.nytimes.com/top/reference/timestopics/subjects/m/milan_fashion_week/index.html?inline=nyt-classifier\" style=\"color: rgb(15, 20, 25); vertical-align: top; padding-bottom: 4px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(255, 200, 31);\">米兰时装周</a>官方组织意大利国家时尚协会（Camera Nazionale della Moda Italiana）关系密切，不过目前一切还没有定论。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">该协会主席 Carlo Capasa 表示，“计划不如变化，很难预料会有怎样的负面影响。”不过他表示重要的是意大利人“团结一致”——这番话很有可能指的是携手转型进入新模式。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">关于 Gucci 的决定还有一点颇为引人关注，即关于安排组织上的一系列不确定因素。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">例如，公司是否将在 9 月同时邀请男女装评论家同时到场？面对质疑，Bizzarri 表示尚无定论。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">对于那些销售多品牌的精品店以及百货公司而言，他们要在 7 月派出买手去参加男装发布季，是否还要在 9 月再出动一次呢？“我还不清楚。” Bizzarri 先生笑道，毕竟 2015 年 Gucci 销售收入 85% 是在自家门店内完成的，成衣销售仅仅占到总额的 11%——可能对于公司而言有点微不足道。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">姑且不论这些未知因素，Gucci 方面的决定倒是做得爽快。“一切似乎水到渠成，显然有必要进行改革了，从这方面着手不是很好吗？”</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">目前尚不清楚其他开云旗下品牌，例如 Bottega Veneta、Yves Saint Laurent 以及 Alexander McQueen 等是否都会效法。当下，开云集团似乎要拿看上去不会引发很大混乱的 Gucci 做个实验。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">Gilhart 女士称，“即使大家一起改革也没有什么大不了，不过各家的发展方向各不相同。这本就是块有待拓荒之地。”</p>','','','',3,'',0,0,0,0,0,'test','2017-03-19 09:19:27','2017-03-25 13:38:26'),(19,'柏林最酷的商场，变成了 3 万束鲜花的“风干”台','<p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">Bikini Berlin 是 2014 年春天在柏林开业的一家概念商场，位于柏林动物园核心地带，靠近 Kufürstendamm 购物街地区，是柏林西区新的时尚消费地标。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">这座建筑早在 1950 年代就已经建成，见证了柏林动荡的历史，在战后复苏时期，是柏林西部的标志性建筑。整个商场均采用环保的落地玻璃外立面设计，尽量利用自然光线，以节省能源。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">这里没有国际一线大牌或大家熟知的连锁店，取而代之的是一些在柏林或者德国刚刚兴起的新品牌的精品店、概念店或者旗舰店。到柏林，如果想买一些只有柏林才能买到的酷酷的东西，那就是这里了。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">最近，Bikini Berlin 邀请伦敦艺术家 Rebecca Louise Law 在其一楼中庭位置创造一个以鲜花为主题的艺术装置，将 3 万束鲜花从天花板上悬吊下来，在略高于游客穿行而过的中庭上方，好似一个倾泻而下的盛开的春天花园。</p><div class=\"com-insert-images\" style=\"margin: 33px 40px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\"><figure><img alt=\"\" data-ratio=\"0.66748166\" data-format=\"jpeg\" class=\" lazyloaded\" data-src=\"http://img.qdaily.com/uploads/20160703120527UwGe8KM5ZbE6pvF4.jpg-WebpWebW640\" src=\"http://img.qdaily.com/uploads/20160703120527UwGe8KM5ZbE6pvF4.jpg-WebpWebW640\" style=\"vertical-align: top; opacity: 1; transition: opacity 0.5s; display: block; margin: 0px auto 16px; width: 575px; height: 383.802px; max-width: 100%;\"></figure></div><div class=\"com-insert-images\" style=\"margin: 33px 40px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\"><figure><img alt=\"\" data-ratio=\"0.66748166\" data-format=\"jpeg\" class=\" lazyloaded\" data-src=\"http://img.qdaily.com/uploads/20160703120527l6LDWesXNchP4pmY.jpg-WebpWebW640\" src=\"http://img.qdaily.com/uploads/20160703120527l6LDWesXNchP4pmY.jpg-WebpWebW640\" style=\"vertical-align: top; opacity: 1; transition: opacity 0.5s; display: block; margin: 0px auto 16px; width: 575px; height: 383.802px; max-width: 100%;\"></figure><figure><img alt=\"\" data-ratio=\"0.66748166\" data-format=\"jpeg\" class=\" lazyloaded\" data-src=\"http://img.qdaily.com/uploads/20160703120528mJjBKPz6kdDf0GUh.jpg-WebpWebW640\" src=\"http://img.qdaily.com/uploads/20160703120528mJjBKPz6kdDf0GUh.jpg-WebpWebW640\" style=\"vertical-align: top; opacity: 1; transition: opacity 0.5s; display: block; margin: 0px auto 16px; width: 575px; height: 383.802px; max-width: 100%;\"></figure></div><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">整个装置的构造极其简单，把倒置的鲜花一束束用铜线系在上方的固定钢架上便可以了。</p><div class=\"com-insert-images medium-insert-images-wide\" style=\"margin: 33px 40px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\"><figure><img alt=\"\" class=\" lazyloaded\" data-ratio=\"0.66625917\" data-format=\"jpeg\" data-src=\"http://img.qdaily.com/uploads/20160703120529TqG4DgbOy9sAm75h.jpg-WebpWebW640\" src=\"http://img.qdaily.com/uploads/20160703120529TqG4DgbOy9sAm75h.jpg-WebpWebW640\" style=\"vertical-align: top; opacity: 1; transition: opacity 0.5s; display: block; margin: 0px auto 16px; width: 575px; height: 383.099px; max-width: 100%;\"></figure><figure><img alt=\"\" data-ratio=\"0.66503667\" data-format=\"jpeg\" class=\" lazyloaded\" data-src=\"http://img.qdaily.com/uploads/20160703120529hErXsanN8MTtPZJy.jpg-WebpWebW640\" src=\"http://img.qdaily.com/uploads/20160703120529hErXsanN8MTtPZJy.jpg-WebpWebW640\" style=\"vertical-align: top; opacity: 1; transition: opacity 0.5s; display: block; margin: 0px auto 16px; width: 575px; height: 382.396px; max-width: 100%;\"></figure><figure><img alt=\"\" data-ratio=\"0.66503667\" data-format=\"jpeg\" class=\" lazyloaded\" data-src=\"http://img.qdaily.com/uploads/20160703120530nioCcb5sGezDRNY0.jpg-WebpWebW640\" src=\"http://img.qdaily.com/uploads/20160703120530nioCcb5sGezDRNY0.jpg-WebpWebW640\" style=\"vertical-align: top; opacity: 1; transition: opacity 0.5s; display: block; margin: 0px auto 16px; width: 575px; height: 382.396px; max-width: 100%;\"></figure></div><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">值得一提的是，这 3 万束鲜花均是荷兰花卉协会（Flower council of Holland）的分支机构 Tollwasblumenmachen 捐赠的。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">也许你会质疑鲜花的花期太过短暂，不过<a href=\"http://www.designboom.com/art/rebecca-louise-law-bikini-berlin-flower-garten-03-30-2016/\" style=\"color: rgb(15, 20, 25); vertical-align: top; padding-bottom: 4px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(255, 200, 31);\">在 Rebecca 看来</a>，随着时间的推移，鲜花从花苞、慢慢舒展、完全绽放直至最后衰败的过程，也是这个艺术装置重要的一部分，不同阶段景观不同，盛放时有它绚烂的一面，破败变成干花后亦有它颓靡的美。</p><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\"></p><div class=\"com-insert-images medium-insert-images-wide\" style=\"margin: 33px 40px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\"><figure><img alt=\"\" class=\" lazyloaded\" data-ratio=\"0.66503667\" data-format=\"jpeg\" data-src=\"http://img.qdaily.com/uploads/20160703120530m9uHLoAd1NyQJWTn.jpg-WebpWebW640\" src=\"http://img.qdaily.com/uploads/20160703120530m9uHLoAd1NyQJWTn.jpg-WebpWebW640\" style=\"vertical-align: top; opacity: 1; transition: opacity 0.5s; display: block; margin: 0px auto 16px; width: 575px; height: 382.396px; max-width: 100%;\"></figure><figure><img alt=\"\" data-ratio=\"0.66503667\" data-format=\"jpeg\" class=\" lazyloaded\" data-src=\"http://img.qdaily.com/uploads/20160703120531rXj4dSfBKpkmRxQT.jpg-WebpWebW640\" src=\"http://img.qdaily.com/uploads/20160703120531rXj4dSfBKpkmRxQT.jpg-WebpWebW640\" style=\"vertical-align: top; opacity: 1; transition: opacity 0.5s; display: block; margin: 0px auto 16px; width: 575px; height: 382.396px; max-width: 100%;\"></figure><figure><img alt=\"\" data-ratio=\"0.66748166\" data-format=\"jpeg\" class=\" lazyloaded\" data-src=\"http://img.qdaily.com/uploads/20160703120531uHALaD5k19INMWsP.jpg-WebpWebW640\" src=\"http://img.qdaily.com/uploads/20160703120531uHALaD5k19INMWsP.jpg-WebpWebW640\" style=\"vertical-align: top; opacity: 1; transition: opacity 0.5s; display: block; margin: 0px auto 16px; width: 575px; height: 383.802px; max-width: 100%;\"></figure></div><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">Bikini Berlin 方面希望游客们在游逛至商场时也能偶遇自然之美，不光是花朵明丽的色彩，还有香味也在提醒着游客们感知户外的气息。</p><div class=\"com-insert-images medium-insert-images-wide\" style=\"margin: 33px 40px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\"><figure><img alt=\"\" class=\" lazyloaded\" data-ratio=\"0.66503667\" data-format=\"jpeg\" data-src=\"http://img.qdaily.com/uploads/201607031205328FUzT7HjOGXM1epE.jpg-WebpWebW640\" src=\"http://img.qdaily.com/uploads/201607031205328FUzT7HjOGXM1epE.jpg-WebpWebW640\" style=\"vertical-align: top; opacity: 1; transition: opacity 0.5s; display: block; margin: 0px auto 16px; width: 575px; height: 382.396px; max-width: 100%;\"></figure><figure><img alt=\"\" data-ratio=\"0.66503667\" data-format=\"jpeg\" class=\" lazyloaded\" data-src=\"http://img.qdaily.com/uploads/20160703120532qR1zeJ50YH3NIoxt.jpg-WebpWebW640\" src=\"http://img.qdaily.com/uploads/20160703120532qR1zeJ50YH3NIoxt.jpg-WebpWebW640\" style=\"vertical-align: top; opacity: 1; transition: opacity 0.5s; display: block; margin: 0px auto 16px; width: 575px; height: 382.396px; max-width: 100%;\"></figure><figure><img alt=\"\" data-ratio=\"1.49877751\" data-format=\"jpeg\" class=\" lazyloaded\" data-src=\"http://img.qdaily.com/uploads/20160703120533kE2YoA6uDmaJbsUg.jpg-WebpWebW640\" src=\"http://img.qdaily.com/uploads/20160703120533kE2YoA6uDmaJbsUg.jpg-WebpWebW640\" style=\"vertical-align: top; opacity: 1; transition: opacity 0.5s; display: block; margin: 0px auto 16px; width: 575px; height: 861.797px; max-width: 100%;\"></figure></div><p style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\"><a href=\"http://www.designboom.com/art/rebecca-louise-law-bikini-berlin-flower-garten-03-30-2016/\" style=\"color: rgb(15, 20, 25); vertical-align: top; padding-bottom: 4px; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(255, 200, 31);\">Rebecca Louise Law 解释说</a>，“我们决定就给它起个简单的名字‘Garten’（也就是英语中的‘Garden’ ，符合二战后复苏时期这座建筑简单、朴素的形象。”她很想借这个装置与游客们一道来庆祝春天缤纷色彩的绽放。</p><div class=\"com-insert-images\" style=\"margin: 33px 40px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\"><figure><img alt=\"\" data-ratio=\"0.66625917\" data-format=\"jpeg\" class=\" lazyloaded\" data-src=\"http://img.qdaily.com/uploads/201607031205349yDjOtImpr3k4N6f.jpg-WebpWebW640\" src=\"http://img.qdaily.com/uploads/201607031205349yDjOtImpr3k4N6f.jpg-WebpWebW640\" style=\"vertical-align: top; opacity: 1; transition: opacity 0.5s; display: block; margin: 0px auto 16px; width: 575px; height: 383.099px; max-width: 100%;\"></figure></div><p class=\"\" style=\"margin-bottom: 24px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\">话说 Rebecca Louise Law 的确是一个喜欢拿花做文章的艺术家，她的很多作品都用到了花的元素。</p><div class=\"com-insert-images\" style=\"margin: 33px 40px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\"><figure><img alt=\"\" class=\" lazyloaded\" data-ratio=\"1.44522968\" data-format=\"jpeg\" data-src=\"http://img.qdaily.com/uploads/20160703120534eXJ84tI72qpcm5ho.jpg-WebpWebW640\" src=\"http://img.qdaily.com/uploads/20160703120534eXJ84tI72qpcm5ho.jpg-WebpWebW640\" style=\"vertical-align: top; opacity: 1; transition: opacity 0.5s; display: block; margin: 0px auto 16px; width: 575px; height: 831.007px; max-width: 100%;\"><figcaption class=\"\" style=\"padding: 0px 20px 16px; color: rgb(166, 166, 166); text-align: center; font-size: 15px; line-height: 24px;\">时报广场，纽约 &nbsp;2015 年</figcaption></figure></div><div class=\"com-insert-images\" style=\"margin: 33px 40px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\"><figure><img alt=\"\" class=\" lazyloaded\" data-ratio=\"0.69193154\" data-format=\"jpeg\" data-src=\"http://img.qdaily.com/uploads/201607031205353VNtOaXHC5ZiKQWl.jpg-WebpWebW640\" src=\"http://img.qdaily.com/uploads/201607031205353VNtOaXHC5ZiKQWl.jpg-WebpWebW640\" style=\"vertical-align: top; opacity: 1; transition: opacity 0.5s; display: block; margin: 0px auto 16px; width: 575px; height: 397.861px; max-width: 100%;\"><figcaption class=\"\" style=\"padding: 0px 20px 16px; color: rgb(166, 166, 166); text-align: center; font-size: 15px; line-height: 24px;\">切尔西花卉展，2015 年</figcaption></figure></div><div class=\"com-insert-images\" style=\"margin: 33px 40px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\"><figure><img alt=\"\" class=\" lazyloaded\" data-ratio=\"0.69193154\" data-format=\"jpeg\" data-src=\"http://img.qdaily.com/uploads/20160703120535GvWXmHtMUzTyaole.jpg-WebpWebW640\" src=\"http://img.qdaily.com/uploads/20160703120535GvWXmHtMUzTyaole.jpg-WebpWebW640\" style=\"vertical-align: top; opacity: 1; transition: opacity 0.5s; display: block; margin: 0px auto 16px; width: 575px; height: 397.861px; max-width: 100%;\"><figcaption class=\"\" style=\"padding: 0px 20px 16px; color: rgb(166, 166, 166); text-align: center; font-size: 15px; line-height: 24px;\">斯考夫特公园，伦敦 2015 年</figcaption></figure></div><div class=\"com-insert-images\" style=\"margin: 33px 40px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\"><figure><img alt=\"\" class=\" lazyloaded\" data-ratio=\"1.44522968\" data-format=\"jpeg\" data-src=\"http://img.qdaily.com/uploads/20160703120536kdUGX2yWVZQ14fF7.jpg-WebpWebW640\" src=\"http://img.qdaily.com/uploads/20160703120536kdUGX2yWVZQ14fF7.jpg-WebpWebW640\" style=\"vertical-align: top; opacity: 1; transition: opacity 0.5s; display: block; margin: 0px auto 16px; width: 575px; height: 831.007px; max-width: 100%;\"><figcaption class=\"\" style=\"padding: 0px 20px 16px; color: rgb(166, 166, 166); text-align: center; font-size: 15px; line-height: 24px;\">伦敦市政厅，2014 年</figcaption></figure></div><div class=\"com-insert-images medium-insert-active\" style=\"margin: 33px 40px; color: rgb(54, 54, 54); font-family: Arial, \'Hiragino Sans GB\', 冬青黑, \'Microsoft YaHei\', 微软雅黑, SimSun, 宋体, Helvetica, Tahoma, \'Arial sans-serif\'; font-size: 16px; line-height: 32px; text-align: justify;\"><figure><img alt=\"\" class=\" lazyloaded\" data-ratio=\"0.69193154\" data-format=\"jpeg\" data-src=\"http://img.qdaily.com/uploads/20160703120537mJY0hUQHoI86MwKN.jpg-WebpWebW640\" src=\"http://img.qdaily.com/uploads/20160703120537mJY0hUQHoI86MwKN.jpg-WebpWebW640\" style=\"vertical-align: top; opacity: 1; transition: opacity 0.5s; display: block; margin: 0px auto 16px; width: 575px; height: 397.861px; max-width: 100%;\"><figcaption class=\"\" style=\"padding: 0px 20px 16px; color: rgb(166, 166, 166); text-align: center; font-size: 15px; line-height: 24px;\">日本佐世保，2014 年</figcaption></figure></div>','','','',2,'',0,0,0,1,0,'test','2017-03-19 09:20:20','2017-03-25 12:31:39');
/*!40000 ALTER TABLE `zm_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_article_msg`
--

DROP TABLE IF EXISTS `zm_article_msg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_article_msg` (
  `id` int(12) unsigned NOT NULL COMMENT '自增id',
  `pid` int(12) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  `article_id` int(12) unsigned NOT NULL DEFAULT '0' COMMENT '文章id',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '评论内容',
  `user_id` bigint(12) unsigned NOT NULL DEFAULT '0' COMMENT '用户id_fk',
  `is_display` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示(0:否1:是)',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `k_article_id` (`article_id`) USING BTREE,
  KEY `k_user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_article_msg`
--

LOCK TABLES `zm_article_msg` WRITE;
/*!40000 ALTER TABLE `zm_article_msg` DISABLE KEYS */;
/*!40000 ALTER TABLE `zm_article_msg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_category`
--

DROP TABLE IF EXISTS `zm_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_category` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `category_name` varchar(12) NOT NULL DEFAULT '' COMMENT '分类名称',
  `category_pid` int(12) unsigned NOT NULL DEFAULT '0',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '类型(1:文章2:商品)',
  `operator` varchar(32) NOT NULL DEFAULT '' COMMENT '操作人',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_category_name` (`category_name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_category`
--

LOCK TABLES `zm_category` WRITE;
/*!40000 ALTER TABLE `zm_category` DISABLE KEYS */;
INSERT INTO `zm_category` VALUES (2,'beartistic',0,1,'zhuwanxiong-xy','2017-02-26 14:45:58','2017-02-28 12:26:10'),(3,'技术日刊',0,1,'test','2017-03-25 13:38:11','2017-03-25 13:38:11');
/*!40000 ALTER TABLE `zm_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_menu`
--

DROP TABLE IF EXISTS `zm_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_menu` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '菜单名称',
  `pid` int(12) NOT NULL DEFAULT '0' COMMENT '父id',
  `is_show` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0表示不显示 1表示显示',
  `icon` varchar(256) NOT NULL DEFAULT '' COMMENT 'icon class',
  `badge` varchar(256) NOT NULL DEFAULT '' COMMENT 'badge class',
  `msgnum` int(12) NOT NULL DEFAULT '0' COMMENT 'message count',
  `sortnum` tinyint(12) NOT NULL DEFAULT '0' COMMENT '排列顺序',
  `operator` varchar(32) NOT NULL DEFAULT '' COMMENT '操作人',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_menu`
--

LOCK TABLES `zm_menu` WRITE;
/*!40000 ALTER TABLE `zm_menu` DISABLE KEYS */;
INSERT INTO `zm_menu` VALUES (39,'用户',0,0,' icon-users icon  text-primary','',0,2,'zhuwanxiong-xy','0000-00-00 00:00:00','2017-02-26 13:21:57'),(40,'账号授权',39,0,'icon-user','',0,1,'zhuwanxiong-xy','0000-00-00 00:00:00','2017-02-12 14:35:24'),(41,'菜单管理',40,0,'fa fa-angle-right text-xs','',0,-1,'zhuwanxiong-xy','0000-00-00 00:00:00','2017-02-16 13:44:29'),(42,'路由管理',40,0,'fa fa-angle-right text-xs','',0,0,'zhuwanxiong-xy','0000-00-00 00:00:00','2017-02-12 14:42:06'),(43,'角色管理',40,0,'fa fa-angle-right text-xs','',0,3,'zhuwanxiong-xy','0000-00-00 00:00:00','2017-02-16 13:45:21'),(44,'权限管理',40,0,'fa fa-angle-right text-xs','',0,0,'zhuwanxiong-xy','0000-00-00 00:00:00','2017-02-12 14:42:17'),(47,'发现',49,0,'icon-compass icon text-success','badge bg-info pull-right text-success',0,1,'zhuwanxiong-xy','2017-02-12 08:25:48','2017-02-16 13:58:13'),(49,'应用',0,1,'icon-disc icon text-success','',0,1,'zhuwanxiong-xy','2017-02-12 10:15:19','2017-02-19 13:44:45'),(56,'用户管理',40,0,'fa fa-angle-right text-xs','',0,0,'zhuwanxiong-xy','2017-02-16 14:38:36','2017-02-16 14:38:36'),(61,'产品',0,0,'icon-briefcase','',0,2,'zhuwanxiong-xy','2017-02-26 13:09:36','2017-03-16 15:01:38'),(62,'资源分配',61,0,'icon-briefcase','',0,0,'test','2017-02-26 13:14:38','2017-03-18 16:35:44'),(63,'类目列表',62,0,'fa fa-angle-right text-xs','',0,1,'zhuwanxiong-xy','2017-02-26 13:16:16','2017-02-28 12:31:37'),(64,'全部产品',62,0,'fa fa-angle-right text-xs','',0,3,'zhuwanxiong-xy','2017-02-26 13:25:41','2017-02-28 12:31:55'),(65,'全部文章',62,0,'fa fa-angle-right text-xs','',0,2,'zhuwanxiong-xy','2017-02-28 12:31:18','2017-02-28 12:32:02'),(66,'文章',49,1,'icon-drawer icon text-primary-lter text-info','',0,2,'test','2017-03-19 08:57:49','2017-03-19 08:58:34');
/*!40000 ALTER TABLE `zm_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_order`
--

DROP TABLE IF EXISTS `zm_order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_order` (
  `id` bigint(12) unsigned NOT NULL DEFAULT '0' COMMENT '自增id',
  `user_id` bigint(12) unsigned NOT NULL DEFAULT '0' COMMENT '用户id_fk',
  `item_id` int(12) unsigned NOT NULL DEFAULT '0' COMMENT '商品id',
  `buy_count` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '购买数量',
  `pay_count` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '支付金额',
  `pay_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '支付时间',
  `receiver` varchar(12) NOT NULL DEFAULT '' COMMENT '收件人',
  `address` varchar(32) NOT NULL DEFAULT '' COMMENT '收货地址',
  `is_remove` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '用户是否删除(0:否1:是)',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `k_user_id` (`user_id`) USING BTREE,
  KEY `k_item_id` (`item_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_order`
--

LOCK TABLES `zm_order` WRITE;
/*!40000 ALTER TABLE `zm_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `zm_order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_product`
--

DROP TABLE IF EXISTS `zm_product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_product` (
  `id` int(12) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(64) NOT NULL DEFAULT '' COMMENT '商品名称',
  `price` decimal(7,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '商品价格',
  `images` varchar(64) NOT NULL DEFAULT '' COMMENT '详情页头部滑动图片(json)',
  `video_uri` varchar(32) NOT NULL DEFAULT '' COMMENT '视频地址(优先)',
  `content` text NOT NULL COMMENT '商品详情,相当于List<T1,T2>,T1:类型 T2:text or pic,json格式',
  `category_id` int(12) NOT NULL DEFAULT '0' COMMENT '商品分类',
  `deals` int(12) unsigned NOT NULL DEFAULT '0' COMMENT '成交数量',
  `favorite` bigint(12) unsigned NOT NULL DEFAULT '0' COMMENT '喜欢次数',
  `pageview` bigint(12) unsigned NOT NULL DEFAULT '0' COMMENT '浏览次数',
  `comment` bigint(12) unsigned NOT NULL DEFAULT '0' COMMENT '评论次数',
  `is_onsale` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否上线(0:否1:是)',
  `operator` varchar(12) NOT NULL DEFAULT '' COMMENT '操作人',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `k_name` (`name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_product`
--

LOCK TABLES `zm_product` WRITE;
/*!40000 ALTER TABLE `zm_product` DISABLE KEYS */;
/*!40000 ALTER TABLE `zm_product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_product_msg`
--

DROP TABLE IF EXISTS `zm_product_msg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_product_msg` (
  `id` int(12) unsigned NOT NULL COMMENT '自增id',
  `pid` int(12) unsigned NOT NULL DEFAULT '0' COMMENT '父id',
  `item_id` int(12) unsigned NOT NULL DEFAULT '0' COMMENT '商品id_fk',
  `content` varchar(128) NOT NULL DEFAULT '' COMMENT '评论内容',
  `user_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '用户id_fk',
  `is_display` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '是否显示(0:否1:是)',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `k_item_id` (`item_id`) USING BTREE,
  KEY `k_user_id` (`user_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_product_msg`
--

LOCK TABLES `zm_product_msg` WRITE;
/*!40000 ALTER TABLE `zm_product_msg` DISABLE KEYS */;
/*!40000 ALTER TABLE `zm_product_msg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_role`
--

DROP TABLE IF EXISTS `zm_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_role` (
  `id` int(12) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '角色名称',
  `operator` varchar(32) NOT NULL DEFAULT '' COMMENT '操作人',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_role`
--

LOCK TABLES `zm_role` WRITE;
/*!40000 ALTER TABLE `zm_role` DISABLE KEYS */;
INSERT INTO `zm_role` VALUES (12,'超级管理员','zhuwanxiong-xy','2017-02-11 02:56:21','2017-02-11 12:04:32'),(13,'客户端组','zhuwanxiong-xy','2017-02-11 09:45:51','2017-02-11 09:45:51'),(14,'测试组','zhuwanxiong-xy','2017-02-11 09:45:56','2017-02-11 09:45:56'),(15,'服务端组','zhuwanxiong-xy','2017-02-11 09:46:02','2017-02-11 09:46:02');
/*!40000 ALTER TABLE `zm_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_role_route`
--

DROP TABLE IF EXISTS `zm_role_route`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_role_route` (
  `id` int(12) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `role_id` int(12) NOT NULL DEFAULT '0' COMMENT '角色fk',
  `has_route` varchar(255) NOT NULL DEFAULT '' COMMENT '路由',
  `operator` varchar(32) NOT NULL DEFAULT '' COMMENT '操作人',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=555 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_role_route`
--

LOCK TABLES `zm_role_route` WRITE;
/*!40000 ALTER TABLE `zm_role_route` DISABLE KEYS */;
INSERT INTO `zm_role_route` VALUES (128,13,'App\\Http\\Controllers\\Zuimei\\MenuController@getList','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(129,13,'App\\Http\\Controllers\\Zuimei\\MenuController@postQuery','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(130,13,'App\\Http\\Controllers\\Zuimei\\MenuController@postAdd','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(131,13,'App\\Http\\Controllers\\Zuimei\\MenuController@postRow','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(132,13,'App\\Http\\Controllers\\Zuimei\\MenuController@postUpdate','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(133,13,'App\\Http\\Controllers\\Zuimei\\MenuController@postDelete','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(134,13,'App\\Http\\Controllers\\Zuimei\\RouteController@getList','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(135,13,'App\\Http\\Controllers\\Zuimei\\RouteController@postQuery','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(136,13,'App\\Http\\Controllers\\Zuimei\\RouteController@postAdd','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(137,13,'App\\Http\\Controllers\\Zuimei\\RouteController@postRow','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(138,13,'App\\Http\\Controllers\\Zuimei\\RouteController@postUpdate','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(139,13,'App\\Http\\Controllers\\Zuimei\\RouteController@postDelete','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(140,13,'App\\Http\\Controllers\\Zuimei\\RoleController@getList','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(141,13,'App\\Http\\Controllers\\Zuimei\\RoleController@postQuery','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(142,13,'App\\Http\\Controllers\\Zuimei\\RoleController@postAdd','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(143,13,'App\\Http\\Controllers\\Zuimei\\RoleController@postRow','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(144,13,'App\\Http\\Controllers\\Zuimei\\RoleController@postUpdate','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(145,13,'	App\\Http\\Controllers\\Zuimei\\RoleController@postDelete','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(146,13,'App\\Http\\Controllers\\Zuimei\\RoleController@setting','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(147,13,'App\\Http\\Controllers\\Zuimei\\RoleController@postSetting','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(148,13,'App\\Http\\Controllers\\Zuimei\\UserRoleController@getList','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(149,13,'App\\Http\\Controllers\\Zuimei\\UserRoleController@postQuery','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(150,13,'App\\Http\\Controllers\\Zuimei\\UserRoleController@postAdd','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(151,13,'App\\Http\\Controllers\\Zuimei\\UserRoleController@postDelete','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(152,13,'App\\Http\\Controllers\\Zuimei\\UserController@getList','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(153,13,'App\\Http\\Controllers\\Zuimei\\UserController@postQuery','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(154,13,'App\\Http\\Controllers\\Zuimei\\UserController@postAdd','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(155,13,'App\\Http\\Controllers\\Zuimei\\UserController@postRow','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(156,13,'App\\Http\\Controllers\\Zuimei\\UserController@postUpdate','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(157,13,'App\\Http\\Controllers\\Zuimei\\UserController@postDelete','zhuwanxiong-xy','2017-02-19 08:02:18','2017-02-19 08:02:18'),(513,12,'App\\Http\\Controllers\\Zuimei\\MenuController@getList','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(514,12,'App\\Http\\Controllers\\Zuimei\\MenuController@postQuery','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(515,12,'App\\Http\\Controllers\\Zuimei\\MenuController@postAdd','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(516,12,'App\\Http\\Controllers\\Zuimei\\MenuController@postRow','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(517,12,'App\\Http\\Controllers\\Zuimei\\MenuController@postUpdate','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(518,12,'App\\Http\\Controllers\\Zuimei\\MenuController@postDelete','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(519,12,'App\\Http\\Controllers\\Zuimei\\RouteController@getList','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(520,12,'App\\Http\\Controllers\\Zuimei\\RouteController@postQuery','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(521,12,'App\\Http\\Controllers\\Zuimei\\RouteController@postAdd','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(522,12,'App\\Http\\Controllers\\Zuimei\\RouteController@postRow','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(523,12,'App\\Http\\Controllers\\Zuimei\\RouteController@postUpdate','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(524,12,'App\\Http\\Controllers\\Zuimei\\RouteController@postDelete','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(525,12,'App\\Http\\Controllers\\Zuimei\\RoleController@getList','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(526,12,'App\\Http\\Controllers\\Zuimei\\RoleController@postQuery','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(527,12,'App\\Http\\Controllers\\Zuimei\\RoleController@postAdd','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(528,12,'App\\Http\\Controllers\\Zuimei\\RoleController@postRow','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(529,12,'App\\Http\\Controllers\\Zuimei\\RoleController@postUpdate','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(530,12,'App\\Http\\Controllers\\Zuimei\\RoleController@postDelete','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(531,12,'App\\Http\\Controllers\\Zuimei\\RoleController@setting','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(532,12,'App\\Http\\Controllers\\Zuimei\\RoleController@postSetting','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(533,12,'App\\Http\\Controllers\\Zuimei\\UserRoleController@getList','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(534,12,'App\\Http\\Controllers\\Zuimei\\UserRoleController@postQuery','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(535,12,'App\\Http\\Controllers\\Zuimei\\UserRoleController@postAdd','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(536,12,'App\\Http\\Controllers\\Zuimei\\UserRoleController@postDelete','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(537,12,'App\\Http\\Controllers\\Zuimei\\UserController@getList','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(538,12,'App\\Http\\Controllers\\Zuimei\\UserController@postQuery','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(539,12,'App\\Http\\Controllers\\Zuimei\\UserController@postAdd','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(540,12,'App\\Http\\Controllers\\Zuimei\\UserController@postRow','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(541,12,'App\\Http\\Controllers\\Zuimei\\UserController@postUpdate','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(542,12,'App\\Http\\Controllers\\Zuimei\\UserController@postDelete','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(543,12,'App\\Http\\Controllers\\Product\\CategoryController@getList','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(544,12,'App\\Http\\Controllers\\Product\\CategoryController@postAdd','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(545,12,'App\\Http\\Controllers\\Product\\CategoryController@postQuery','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(546,12,'App\\Http\\Controllers\\Product\\CategoryController@postRow','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(547,12,'App\\Http\\Controllers\\Product\\CategoryController@postUpdate','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(548,12,'App\\Http\\Controllers\\Product\\CategoryController@postDelete','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(549,12,'App\\Http\\Controllers\\Product\\ArticleController@getList','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:12:45'),(550,12,'App\\Http\\Controllers\\Product\\ArticleController@postQuery','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:12:58'),(551,12,'App\\Http\\Controllers\\Product\\ArticleController@postAdd','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(552,12,'App\\Http\\Controllers\\Product\\ArticleController@postRow','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(553,12,'App\\Http\\Controllers\\Product\\ArticleController@postUpdate','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20'),(554,12,'App\\Http\\Controllers\\Product\\ArticleController@postDelete','zhuwanxiong-xy','2017-02-28 13:02:20','2017-02-28 13:02:20');
/*!40000 ALTER TABLE `zm_role_route` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_route`
--

DROP TABLE IF EXISTS `zm_route`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_route` (
  `id` int(12) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '路由名称',
  `route` varchar(255) NOT NULL DEFAULT '' COMMENT '路由',
  `mid` int(12) NOT NULL DEFAULT '0' COMMENT '菜单id',
  `is_default` tinyint(1) NOT NULL COMMENT '是否默认 0:否1:是',
  `operator` varchar(21) NOT NULL DEFAULT '' COMMENT '操作人',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_route` (`route`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_route`
--

LOCK TABLES `zm_route` WRITE;
/*!40000 ALTER TABLE `zm_route` DISABLE KEYS */;
INSERT INTO `zm_route` VALUES (7,'菜单首页','App\\Http\\Controllers\\Zuimei\\MenuController@getList',41,1,'zhuwanxiong-xy','2017-01-30 13:24:01','2017-01-31 14:55:05'),(8,'菜单查询','App\\Http\\Controllers\\Zuimei\\MenuController@postQuery',41,0,'zhuwanxiong-xy','2017-01-30 13:25:52','2017-01-31 14:47:45'),(9,'菜单添加','App\\Http\\Controllers\\Zuimei\\MenuController@postAdd',41,0,'zhuwanxiong-xy','2017-01-30 13:27:47','2017-01-30 13:27:47'),(10,'菜单获取指定行','App\\Http\\Controllers\\Zuimei\\MenuController@postRow',41,0,'zhuwanxiong-xy','2017-01-30 13:28:54','2017-01-30 13:28:54'),(11,'菜单更新','App\\Http\\Controllers\\Zuimei\\MenuController@postUpdate',41,0,'zhuwanxiong-xy','2017-01-30 13:29:47','2017-01-30 13:29:47'),(12,'菜单删除','App\\Http\\Controllers\\Zuimei\\MenuController@postDelete',41,0,'zhuwanxiong-xy','2017-01-30 13:30:25','2017-01-30 13:30:25'),(13,'路由首页','App\\Http\\Controllers\\Zuimei\\RouteController@getList',42,1,'zhuwanxiong-xy','2017-01-30 13:31:50','2017-01-30 13:31:50'),(14,'路由查询','App\\Http\\Controllers\\Zuimei\\RouteController@postQuery',42,0,'zhuwanxiong-xy','2017-01-30 13:32:29','2017-01-30 13:32:29'),(15,'路由添加','App\\Http\\Controllers\\Zuimei\\RouteController@postAdd',42,0,'zhuwanxiong-xy','2017-01-30 13:33:00','2017-01-30 13:33:01'),(16,'路由获取一行','App\\Http\\Controllers\\Zuimei\\RouteController@postRow',42,0,'zhuwanxiong-xy','2017-01-30 13:34:09','2017-01-30 13:34:09'),(17,'路由更新','App\\Http\\Controllers\\Zuimei\\RouteController@postUpdate',42,0,'zhuwanxiong-xy','2017-01-30 13:34:39','2017-01-30 13:34:39'),(18,'路由删除','App\\Http\\Controllers\\Zuimei\\RouteController@postDelete',42,0,'zhuwanxiong-xy','2017-01-30 13:35:09','2017-01-30 13:35:09'),(19,'角色首页','App\\Http\\Controllers\\Zuimei\\RoleController@getList',43,1,'zhuwanxiong-xy','2017-02-16 14:12:51','2017-02-16 14:14:29'),(20,'角色查询','App\\Http\\Controllers\\Zuimei\\RoleController@postQuery',43,0,'zhuwanxiong-xy','2017-02-16 14:16:17','2017-02-16 14:16:17'),(21,'角色添加','App\\Http\\Controllers\\Zuimei\\RoleController@postAdd',43,0,'zhuwanxiong-xy','2017-02-16 14:16:54','2017-02-16 14:16:54'),(22,'角色获取指定行','App\\Http\\Controllers\\Zuimei\\RoleController@postRow',43,0,'zhuwanxiong-xy','2017-02-16 14:17:24','2017-02-16 14:17:24'),(23,'角色更新','App\\Http\\Controllers\\Zuimei\\RoleController@postUpdate',43,0,'zhuwanxiong-xy','2017-02-16 14:17:46','2017-02-16 14:17:46'),(24,'角色删除','App\\Http\\Controllers\\Zuimei\\RoleController@postDelete',43,0,'zhuwanxiong-xy','2017-02-16 14:18:07','2017-02-19 12:42:55'),(25,'权限首页','App\\Http\\Controllers\\Zuimei\\UserRoleController@getList',44,1,'zhuwanxiong-xy','2017-02-16 14:21:05','2017-02-16 14:21:05'),(26,'权限查询','App\\Http\\Controllers\\Zuimei\\UserRoleController@postQuery',44,0,'zhuwanxiong-xy','2017-02-16 14:21:46','2017-02-16 14:21:46'),(27,'权限添加','App\\Http\\Controllers\\Zuimei\\UserRoleController@postAdd',44,0,'zhuwanxiong-xy','2017-02-16 14:22:35','2017-02-16 14:22:35'),(28,'权限删除','App\\Http\\Controllers\\Zuimei\\UserRoleController@postDelete',44,0,'zhuwanxiong-xy','2017-02-16 14:23:12','2017-02-16 14:23:12'),(29,'用户首页','App\\Http\\Controllers\\Zuimei\\UserController@getList',56,1,'zhuwanxiong-xy','2017-02-16 14:39:21','2017-02-16 14:39:21'),(30,'用户查询','App\\Http\\Controllers\\Zuimei\\UserController@postQuery',56,0,'zhuwanxiong-xy','2017-02-16 14:40:06','2017-02-16 14:40:06'),(31,'用户添加','App\\Http\\Controllers\\Zuimei\\UserController@postAdd',56,0,'zhuwanxiong-xy','2017-02-16 14:40:58','2017-02-16 14:40:58'),(32,'用户获取指定行','App\\Http\\Controllers\\Zuimei\\UserController@postRow',56,0,'zhuwanxiong-xy','2017-02-16 14:41:25','2017-02-16 14:41:25'),(33,'用户更新','App\\Http\\Controllers\\Zuimei\\UserController@postUpdate',56,0,'zhuwanxiong-xy','2017-02-16 14:41:47','2017-02-16 14:41:47'),(34,'用户删除','App\\Http\\Controllers\\Zuimei\\UserController@postDelete',56,0,'zhuwanxiong-xy','2017-02-16 14:42:21','2017-02-16 14:42:21'),(35,'角色设置路由','App\\Http\\Controllers\\Zuimei\\RoleController@setting',43,0,'zhuwanxiong-xy','2017-02-18 11:13:07','2017-02-18 11:13:07'),(36,'角色设置路由post','App\\Http\\Controllers\\Zuimei\\RoleController@postSetting',43,0,'zhuwanxiong-xy','2017-02-18 12:02:24','2017-02-18 12:02:24'),(37,'类目首页','App\\Http\\Controllers\\Product\\CategoryController@getList',63,1,'zhuwanxiong-xy','2017-02-26 14:00:15','2017-02-26 14:02:51'),(38,'类目添加','App\\Http\\Controllers\\Product\\CategoryController@postAdd',63,0,'zhuwanxiong-xy','2017-02-26 14:32:41','2017-02-26 14:32:41'),(39,'类目查询','App\\Http\\Controllers\\Product\\CategoryController@postQuery',63,0,'zhuwanxiong-xy','2017-02-26 14:32:59','2017-02-26 14:32:59'),(40,'类目获取指定行','App\\Http\\Controllers\\Product\\CategoryController@postRow',63,0,'zhuwanxiong-xy','2017-02-26 14:33:28','2017-02-26 14:33:28'),(41,'类目更新','App\\Http\\Controllers\\Product\\CategoryController@postUpdate',63,0,'zhuwanxiong-xy','2017-02-26 14:36:55','2017-02-26 14:36:55'),(42,'类目删除','App\\Http\\Controllers\\Product\\CategoryController@postDelete',63,0,'zhuwanxiong-xy','2017-02-26 14:37:48','2017-02-26 14:37:48'),(43,'文章首页','App\\Http\\Controllers\\Product\\ArticleController@getList',65,1,'zhuwanxiong-xy','2017-02-28 12:51:46','2017-02-28 13:05:00'),(44,'文章查询','App\\Http\\Controllers\\Product\\ArticleController@postQuery',65,0,'zhuwanxiong-xy','2017-02-28 12:52:30','2017-02-28 13:06:37'),(45,'文章添加','App\\Http\\Controllers\\Product\\ArticleController@postAdd',65,0,'zhuwanxiong-xy','2017-02-28 12:53:04','2017-02-28 12:53:04'),(46,'文章获取特定行','App\\Http\\Controllers\\Product\\ArticleController@postRow',65,0,'zhuwanxiong-xy','2017-02-28 12:53:32','2017-02-28 12:53:32'),(47,'文章更新','App\\Http\\Controllers\\Product\\ArticleController@postUpdate',65,0,'zhuwanxiong-xy','2017-02-28 12:53:53','2017-02-28 12:53:53'),(48,'文章删除','App\\Http\\Controllers\\Product\\ArticleController@postDelete',65,0,'zhuwanxiong-xy','2017-02-28 12:54:06','2017-02-28 12:54:06'),(49,'web首页','App\\Http\\Controllers\\Web\\WebController@getList',47,1,'test','2017-03-19 08:46:51','2017-03-19 08:50:11');
/*!40000 ALTER TABLE `zm_route` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_user`
--

DROP TABLE IF EXISTS `zm_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_user` (
  `id` bigint(12) unsigned NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `username` varchar(32) NOT NULL DEFAULT '' COMMENT '用户名',
  `password` char(32) NOT NULL DEFAULT '' COMMENT '用户密码',
  `birthday` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '出生日期',
  `picture` varchar(32) NOT NULL DEFAULT '' COMMENT '头像',
  `cellphone` varchar(11) NOT NULL DEFAULT '' COMMENT '手机号码',
  `gender` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0:未知1:男2:女',
  `address` varchar(32) NOT NULL DEFAULT '' COMMENT '地址',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_username` (`username`) USING BTREE,
  UNIQUE KEY `uk_cellphone` (`cellphone`) USING BTREE,
  KEY `k_cellphone` (`cellphone`) USING BTREE,
  KEY `k_username` (`username`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_user`
--

LOCK TABLES `zm_user` WRITE;
/*!40000 ALTER TABLE `zm_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `zm_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zm_user_role`
--

DROP TABLE IF EXISTS `zm_user_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zm_user_role` (
  `id` int(12) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `username` varchar(32) NOT NULL DEFAULT '' COMMENT '用户名',
  `role_id` int(12) NOT NULL DEFAULT '0' COMMENT '角色fk',
  `operator` varchar(32) NOT NULL DEFAULT '' COMMENT '操作人',
  `create_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_role` (`username`,`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zm_user_role`
--

LOCK TABLES `zm_user_role` WRITE;
/*!40000 ALTER TABLE `zm_user_role` DISABLE KEYS */;
INSERT INTO `zm_user_role` VALUES (41,'zhuwanxiong-xy',12,'zhuwanxiong-xy','2017-02-18 12:08:34','2017-02-18 12:08:34'),(48,'test',12,'zhuwanxiong-xy','2017-02-19 12:39:22','2017-02-19 12:39:22');
/*!40000 ALTER TABLE `zm_user_role` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-03-26 14:39:41
