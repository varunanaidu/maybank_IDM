/*
 Navicat Premium Data Transfer

 Source Server         : mysql_local_dev
 Source Server Type    : MySQL
 Source Server Version : 100421
 Source Host           : localhost:3306
 Source Schema         : metrofest

 Target Server Type    : MySQL
 Target Server Version : 100421
 File Encoding         : 65001

 Date: 02/12/2021 22:07:26
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tr_undian
-- ----------------------------
DROP TABLE IF EXISTS `tr_undian`;
CREATE TABLE `tr_undian`  (
  `undian_id` int NOT NULL AUTO_INCREMENT,
  `emp_id` int NULL DEFAULT NULL,
  `present_id` int NULL DEFAULT NULL,
  `addon` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`undian_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tr_undian
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
