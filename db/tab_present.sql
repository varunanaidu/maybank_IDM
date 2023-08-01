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

 Date: 02/12/2021 21:59:56
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tab_present
-- ----------------------------
DROP TABLE IF EXISTS `tab_present`;
CREATE TABLE `tab_present`  (
  `present_id` int NOT NULL AUTO_INCREMENT,
  `present_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `present_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `present_stock` int NULL DEFAULT NULL,
  `present_flag` int NULL DEFAULT NULL,
  `present_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`present_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tab_present
-- ----------------------------
INSERT INTO `tab_present` VALUES (1, 'Hair Dryer', 'MHD - 201BP', 287, 0, NULL);
INSERT INTO `tab_present` VALUES (2, 'Setrika', 'HA-390', 168, 0, NULL);
INSERT INTO `tab_present` VALUES (3, 'Magic Jar', 'MRJ-1003TSS', 50, 0, NULL);
INSERT INTO `tab_present` VALUES (4, 'Kompor Gas', 'MKG-810C', 10, 0, NULL);
INSERT INTO `tab_present` VALUES (5, 'Blender', 'MT-1261PL', 286, 0, NULL);
INSERT INTO `tab_present` VALUES (6, 'Kompor Listrik', 'S-300', 199, 0, NULL);
INSERT INTO `tab_present` VALUES (7, 'Desk Fan', 'EX-308', 50, 0, NULL);
INSERT INTO `tab_present` VALUES (8, 'Mixer', 'MT-1190', 100, 0, NULL);
INSERT INTO `tab_present` VALUES (9, 'Kompor Induksi', 'MIC-01', 50, 0, NULL);
INSERT INTO `tab_present` VALUES (10, 'Motor Listrik ', '', 3, 1, NULL);
INSERT INTO `tab_present` VALUES (11, 'Sepeda Folding', '', 15, 1, NULL);
INSERT INTO `tab_present` VALUES (12, 'Sepeda Mountain', '', 15, 1, NULL);

SET FOREIGN_KEY_CHECKS = 1;
