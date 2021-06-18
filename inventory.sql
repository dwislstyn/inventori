/*
 Navicat Premium Data Transfer

 Source Server         : Mysql
 Source Server Type    : MySQL
 Source Server Version : 100130
 Source Host           : localhost:3307
 Source Schema         : inventory

 Target Server Type    : MySQL
 Target Server Version : 100130
 File Encoding         : 65001

 Date: 17/06/2021 12:58:39
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for produk
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kode_barang` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `jumlah_barang` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of produk
-- ----------------------------
INSERT INTO `produk` VALUES (1, 'Polytex Sweamring', 'B030GH', 10, '2021-06-17');
INSERT INTO `produk` VALUES (2, 'Poliester', 'P030G', 3, '2021-06-17');
INSERT INTO `produk` VALUES (3, 'Polimatek Thread', 'B998', 6, '2021-06-17');

SET FOREIGN_KEY_CHECKS = 1;
