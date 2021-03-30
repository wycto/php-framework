/*
 Navicat MySQL Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50726
 Source Host           : 127.0.0.1:3306
 Source Schema         : bank_demo

 Target Server Type    : MySQL
 Target Server Version : 50726
 File Encoding         : 65001

 Date: 31/03/2021 00:31:35
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for account
-- ----------------------------
DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `money` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4032 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Table structure for account_trans
-- ----------------------------
DROP TABLE IF EXISTS `account_trans`;
CREATE TABLE `account_trans` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `to_name` varchar(255) DEFAULT NULL,
  `to_code` varchar(255) DEFAULT NULL,
  `money` varchar(255) DEFAULT NULL,
  `trans_no` varchar(100) DEFAULT NULL,
  `memo` varchar(255) DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4;

SET FOREIGN_KEY_CHECKS = 1;
