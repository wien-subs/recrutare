/*
#Wien-Subs Developer Team#

Source Server         : local
Source Server Version : 100206
Source Host           : localhost:3306
Source Database       : recrutare

Target Server Type    : MYSQL
Target Server Version : 100206
File Encoding         : 65001
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` text NOT NULL,
  `password` longtext NOT NULL,
  `session` text DEFAULT NULL,
  `mail` text NOT NULL,
  `forgot` varchar(255) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
