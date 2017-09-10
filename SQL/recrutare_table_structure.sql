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
-- Table structure for anime_old_deleted
-- ----------------------------
DROP TABLE IF EXISTS `anime_old_deleted`;
CREATE TABLE `anime_old_deleted` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `numele` text NOT NULL,
  `img` text NOT NULL,
  `categorie` text NOT NULL,
  `gen` text NOT NULL,
  `parteneri` text DEFAULT NULL,
  `link` text NOT NULL,
  `linkp` text DEFAULT NULL,
  `linkmal` text DEFAULT NULL,
  `alias` text DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for teste
-- ----------------------------
DROP TABLE IF EXISTS `teste`;
CREATE TABLE `teste` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `nume` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `skype` varchar(255) DEFAULT NULL,
  `post` varchar(255) DEFAULT NULL,
  `exp` text DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `testid` int(9) DEFAULT NULL,
  `testresult` longtext DEFAULT NULL,
  `status` varchar(255) DEFAULT 'In asteptare',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=204 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for traducere
-- ----------------------------
DROP TABLE IF EXISTS `traducere`;
CREATE TABLE `traducere` (
  `id` int(9) NOT NULL,
  `testid` int(9) NOT NULL,
  `text` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for verificare
-- ----------------------------
DROP TABLE IF EXISTS `verificare`;
CREATE TABLE `verificare` (
  `id` int(9) NOT NULL,
  `testid` int(9) NOT NULL,
  `text` longtext DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
