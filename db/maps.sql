/*
 Navicat Premium Data Transfer

 Source Server         : mpampam
 Source Server Type    : MySQL
 Source Server Version : 50532
 Source Host           : localhost:3306
 Source Schema         : maps

 Target Server Type    : MySQL
 Target Server Version : 50532
 File Encoding         : 65001

 Date: 09/08/2019 22:49:00
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for history_location
-- ----------------------------
DROP TABLE IF EXISTS `history_location`;
CREATE TABLE `history_location`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_trans_kendaraan` int(11) NOT NULL,
  `token` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kordinat_start` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `kordinat_end` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `success` enum('t','y') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 't',
  `date_start` datetime NULL DEFAULT NULL,
  `date_end` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_trans_kendaraan`(`id_trans_kendaraan`) USING BTREE,
  CONSTRAINT `history_location_ibfk_1` FOREIGN KEY (`id_trans_kendaraan`) REFERENCES `trans_kendaraan` (`id_trans_kendaraan`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 190 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of history_location
-- ----------------------------
INSERT INTO `history_location` VALUES (184, 3, '020319102654', '-7.156680889449917,110.14652504025878', '-7.150975,110.14025939999999', 'y', '2019-03-02 10:27:00', '2019-03-02 10:27:06');
INSERT INTO `history_location` VALUES (185, 3, '020319103033', '-7.156042174026898,110.16590131818236', '-7.150975,110.14025939999999', 'y', '2019-03-02 10:30:40', '2019-03-02 10:30:45');
INSERT INTO `history_location` VALUES (186, 2, '090819084054', '-5.164148523162365,119.43475263592973', '-5.1725619,119.4308099', 'y', '2019-08-09 08:41:13', '2019-08-09 08:41:57');
INSERT INTO `history_location` VALUES (189, 2, '090819084838', '-5.172881778773242,119.42728500080216', '-5.1730099,119.4333491', 'y', '2019-08-09 08:48:43', '2019-08-09 08:48:46');

-- ----------------------------
-- Table structure for tb_jadwal
-- ----------------------------
DROP TABLE IF EXISTS `tb_jadwal`;
CREATE TABLE `tb_jadwal`  (
  `id_jadwal` int(11) NOT NULL AUTO_INCREMENT,
  `id_trans_kendaraan` int(11) NULL DEFAULT NULL,
  `waktu` datetime NULL DEFAULT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_jadwal`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_jadwal
-- ----------------------------
INSERT INTO `tb_jadwal` VALUES (1, 3, '2019-08-16 12:12:00', 'sdasda');

-- ----------------------------
-- Table structure for tb_jenis_perbaikan
-- ----------------------------
DROP TABLE IF EXISTS `tb_jenis_perbaikan`;
CREATE TABLE `tb_jenis_perbaikan`  (
  `id_jenis_perbaikan` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_perbaikan` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_jenis_perbaikan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_jenis_perbaikan
-- ----------------------------
INSERT INTO `tb_jenis_perbaikan` VALUES (1, 'Oli Mesin');
INSERT INTO `tb_jenis_perbaikan` VALUES (2, 'Saringan Udara');
INSERT INTO `tb_jenis_perbaikan` VALUES (3, 'Oli Transmisi');
INSERT INTO `tb_jenis_perbaikan` VALUES (4, 'Oli gardan');
INSERT INTO `tb_jenis_perbaikan` VALUES (5, 'Kerenggangan Baut');
INSERT INTO `tb_jenis_perbaikan` VALUES (6, 'Rem');
INSERT INTO `tb_jenis_perbaikan` VALUES (7, 'Tie Rods');
INSERT INTO `tb_jenis_perbaikan` VALUES (8, 'Gear Box Steering');
INSERT INTO `tb_jenis_perbaikan` VALUES (9, 'Drive Belt');
INSERT INTO `tb_jenis_perbaikan` VALUES (10, 'Radiator');
INSERT INTO `tb_jenis_perbaikan` VALUES (11, 'Busi');
INSERT INTO `tb_jenis_perbaikan` VALUES (12, 'Oli filter');
INSERT INTO `tb_jenis_perbaikan` VALUES (13, 'Shockbreaker');
INSERT INTO `tb_jenis_perbaikan` VALUES (14, 'Kampas kopling');
INSERT INTO `tb_jenis_perbaikan` VALUES (15, 'Clutch clover');
INSERT INTO `tb_jenis_perbaikan` VALUES (16, 'Kopling');
INSERT INTO `tb_jenis_perbaikan` VALUES (17, 'Saringan Bensin');
INSERT INTO `tb_jenis_perbaikan` VALUES (18, 'Tali Kipas');

-- ----------------------------
-- Table structure for tb_kendaraan
-- ----------------------------
DROP TABLE IF EXISTS `tb_kendaraan`;
CREATE TABLE `tb_kendaraan`  (
  `id_kendaraan` int(11) NOT NULL AUTO_INCREMENT,
  `no_kendaraan` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `merek_kendaraan` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `transmisi_kendaraan` enum('manual','automatic') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `cc_kendaraan` int(11) NULL DEFAULT NULL,
  `warna_kendaraan` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `tahun_pembuatan` int(11) NULL DEFAULT NULL,
  `waktu_pembelian` date NULL DEFAULT NULL,
  `kilometer` int(11) NULL DEFAULT NULL,
  `kilometer_skrg` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_kendaraan`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_kendaraan
-- ----------------------------
INSERT INTO `tb_kendaraan` VALUES (1, 'DD123HI', 'daihatsu', 'automatic', 100000, 'hitam', 2009, '2018-01-14', 13000, 15000);
INSERT INTO `tb_kendaraan` VALUES (2, 'DD1234HH', 'Kijjang Innova', 'manual', 100000, 'merah', 2011, '2018-07-24', 900, 1127);
INSERT INTO `tb_kendaraan` VALUES (3, 'DD1401H3', 'Honda brio', 'automatic', 9000, 'merah', 2016, '2017-06-21', 2100, 12122);
INSERT INTO `tb_kendaraan` VALUES (4, 'DD12344HH', 'kijang innova', 'manual', 9000, 'hitam', 2007, '2019-01-22', 100000, 100000);
INSERT INTO `tb_kendaraan` VALUES (5, 'DD21DAS', 'dsa', 'manual', 21321321, 'ds', 2009, '2018-12-30', 232222, 232222);

-- ----------------------------
-- Table structure for tb_login
-- ----------------------------
DROP TABLE IF EXISTS `tb_login`;
CREATE TABLE `tb_login`  (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telepon` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(32) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id_login`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_login
-- ----------------------------
INSERT INTO `tb_login` VALUES (3, 'Abdul Gaffar Jaelani', '111111', 'superadmin', '96e79218965eb72c92a549dd5a330112');
INSERT INTO `tb_login` VALUES (4, 'Muhammad irfan ibnu', '1234567', 'mpampam', '96e79218965eb72c92a549dd5a330112');

-- ----------------------------
-- Table structure for tb_notifikasi_cs
-- ----------------------------
DROP TABLE IF EXISTS `tb_notifikasi_cs`;
CREATE TABLE `tb_notifikasi_cs`  (
  `id_notif` int(11) NOT NULL AUTO_INCREMENT,
  `id_trans_kendaraan` int(11) NOT NULL,
  `notifikasi` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `waktu` date NULL DEFAULT NULL,
  `status` enum('belum','sudah') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'belum',
  PRIMARY KEY (`id_notif`) USING BTREE,
  INDEX `id_trans_kendaraan`(`id_trans_kendaraan`) USING BTREE,
  CONSTRAINT `tb_notifikasi_cs_ibfk_1` FOREIGN KEY (`id_trans_kendaraan`) REFERENCES `trans_kendaraan` (`id_trans_kendaraan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_notifikasi_cs
-- ----------------------------
INSERT INTO `tb_notifikasi_cs` VALUES (5, 5, 'dsads', '2019-01-04', 'sudah');
INSERT INTO `tb_notifikasi_cs` VALUES (6, 3, 'dsa', '2019-01-04', 'sudah');
INSERT INTO `tb_notifikasi_cs` VALUES (7, 2, 'saat ini anda berada pada tahap service 2, silahkan melakukan perbaikan dan perawatan.', '2019-01-04', 'sudah');
INSERT INTO `tb_notifikasi_cs` VALUES (8, 3, 'mn mki', '2019-01-04', 'sudah');
INSERT INTO `tb_notifikasi_cs` VALUES (9, 2, 'No index defined! Create one below No index defined! Create one below No index defined! Create one below', '2019-01-04', 'sudah');
INSERT INTO `tb_notifikasi_cs` VALUES (10, 3, 'No index defined! Create one below No index defined! Create one below No index defined! Create one below', '2019-01-04', 'sudah');
INSERT INTO `tb_notifikasi_cs` VALUES (11, 3, 'tolong prosesnya di aktifkan', '2019-01-05', 'sudah');
INSERT INTO `tb_notifikasi_cs` VALUES (12, 3, 'dsadsa', '2019-02-01', 'sudah');
INSERT INTO `tb_notifikasi_cs` VALUES (13, 3, 'Piuu', '2019-02-20', 'sudah');
INSERT INTO `tb_notifikasi_cs` VALUES (14, 3, 'tolong laHHH', '2019-08-09', 'belum');

-- ----------------------------
-- Table structure for tb_pemilik
-- ----------------------------
DROP TABLE IF EXISTS `tb_pemilik`;
CREATE TABLE `tb_pemilik`  (
  `id_pemilik` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pemilik` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `telepon_pemilik` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email_pemilik` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat_pemilik` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `jk_pemilik` enum('pria','wanita') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `foto_pemilik` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_pemilik`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_pemilik
-- ----------------------------
INSERT INTO `tb_pemilik` VALUES (3, 'Alex pablox', '085288882994', 'mpampam5@gmail.com', 'dsadsaasd', 'wanita', 'customer_15112018074033.jpg');
INSERT INTO `tb_pemilik` VALUES (4, 'Muhammad Irfan Ibnu', '085288882994', 'mpampam5@gmail.com', 'Jl. Mannuruki 1 Pondok 16', 'pria', '');
INSERT INTO `tb_pemilik` VALUES (5, 'Taufik', '098765273', 'taufik@mail.com', 'Jalan mannuruki raya no 13', 'pria', '');
INSERT INTO `tb_pemilik` VALUES (6, 'Pokit', '312321213', 'mpampam@mail.com', 'dsadas', 'pria', NULL);
INSERT INTO `tb_pemilik` VALUES (7, 'q', '31312', 'aaaa@mail.com', 'dsa', 'pria', NULL);

-- ----------------------------
-- Table structure for tb_profile
-- ----------------------------
DROP TABLE IF EXISTS `tb_profile`;
CREATE TABLE `tb_profile`  (
  `id_profile` int(11) NOT NULL AUTO_INCREMENT,
  `nama_bengkel` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `telepon` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `kordinat` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id_profile`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_profile
-- ----------------------------
INSERT INTO `tb_profile` VALUES (1, 'TITI MOTOR', 'titi@mail.com', '0853242343', 'Jl. mannuruki 1', '-5.157133717555321,119.42453240314944');

-- ----------------------------
-- Table structure for tb_service
-- ----------------------------
DROP TABLE IF EXISTS `tb_service`;
CREATE TABLE `tb_service`  (
  `id_service` int(11) NOT NULL AUTO_INCREMENT,
  `nama_service` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `jarak_tempuh` int(11) NULL DEFAULT NULL,
  `s_jarak_tempuh` int(11) NULL DEFAULT NULL,
  `waktu` int(11) NULL DEFAULT NULL,
  `s_waktu` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_service`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tb_service
-- ----------------------------
INSERT INTO `tb_service` VALUES (8, 'Service 1', 1000, 10000, 1, 6);
INSERT INTO `tb_service` VALUES (11, 'Service 2', 10000, 20000, 6, 12);
INSERT INTO `tb_service` VALUES (12, 'Service 3', 20000, 40000, 12, 18);
INSERT INTO `tb_service` VALUES (13, 'Service 4', 40000, 50000, 18, 24);
INSERT INTO `tb_service` VALUES (14, 'Service 5', 50000, 60000, 24, 30);
INSERT INTO `tb_service` VALUES (15, 'Service 6', 60000, 70000, 30, 36);
INSERT INTO `tb_service` VALUES (16, 'Service 7', 70000, 80000, 36, 42);
INSERT INTO `tb_service` VALUES (17, 'Service 8', 80000, 90000, 42, 48);
INSERT INTO `tb_service` VALUES (18, 'Service 9', 90000, 100000, 48, 54);
INSERT INTO `tb_service` VALUES (19, 'Service 10', 100000, 110000, 54, 60);
INSERT INTO `tb_service` VALUES (20, 'Service 11', 110000, 120000, 60, 66);
INSERT INTO `tb_service` VALUES (21, 'Service 12', 120000, 130000, 66, 72);
INSERT INTO `tb_service` VALUES (22, 'Service 13', 130000, 190000, 72, 78);

-- ----------------------------
-- Table structure for trans_cs_perbaikan
-- ----------------------------
DROP TABLE IF EXISTS `trans_cs_perbaikan`;
CREATE TABLE `trans_cs_perbaikan`  (
  `id_cs_perbaikan` int(11) NOT NULL AUTO_INCREMENT,
  `id_trans_cs_service` int(11) NOT NULL,
  `id_trans_service` int(11) NOT NULL,
  PRIMARY KEY (`id_cs_perbaikan`) USING BTREE,
  INDEX `id_perbaikan`(`id_trans_service`) USING BTREE,
  INDEX `id_trans_cs_service`(`id_trans_cs_service`) USING BTREE,
  INDEX `id_trans_cs_service_2`(`id_trans_cs_service`) USING BTREE,
  INDEX `id_trans_service`(`id_trans_service`) USING BTREE,
  CONSTRAINT `trans_cs_perbaikan_ibfk_1` FOREIGN KEY (`id_trans_cs_service`) REFERENCES `trans_cs_service` (`id_trans_cs_service`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trans_cs_perbaikan_ibfk_2` FOREIGN KEY (`id_trans_service`) REFERENCES `trans_service` (`id_trans_service`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 50 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of trans_cs_perbaikan
-- ----------------------------
INSERT INTO `trans_cs_perbaikan` VALUES (32, 22, 297);
INSERT INTO `trans_cs_perbaikan` VALUES (33, 22, 300);
INSERT INTO `trans_cs_perbaikan` VALUES (34, 22, 303);
INSERT INTO `trans_cs_perbaikan` VALUES (39, 23, 281);
INSERT INTO `trans_cs_perbaikan` VALUES (40, 23, 284);
INSERT INTO `trans_cs_perbaikan` VALUES (41, 24, 298);
INSERT INTO `trans_cs_perbaikan` VALUES (42, 24, 301);
INSERT INTO `trans_cs_perbaikan` VALUES (43, 24, 304);
INSERT INTO `trans_cs_perbaikan` VALUES (44, 25, 281);
INSERT INTO `trans_cs_perbaikan` VALUES (45, 25, 284);
INSERT INTO `trans_cs_perbaikan` VALUES (46, 25, 287);
INSERT INTO `trans_cs_perbaikan` VALUES (47, 26, 95);
INSERT INTO `trans_cs_perbaikan` VALUES (48, 26, 98);
INSERT INTO `trans_cs_perbaikan` VALUES (49, 26, 101);

-- ----------------------------
-- Table structure for trans_cs_service
-- ----------------------------
DROP TABLE IF EXISTS `trans_cs_service`;
CREATE TABLE `trans_cs_service`  (
  `id_trans_cs_service` int(11) NOT NULL AUTO_INCREMENT,
  `id_trans_kendaraan` int(11) NOT NULL,
  `id_service` int(11) NOT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `waktu_service` date NOT NULL,
  `waktu_tempuh` int(11) NULL DEFAULT NULL,
  `jarak_tempuh` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id_trans_cs_service`) USING BTREE,
  INDEX `id_trans_kendaraan`(`id_trans_kendaraan`) USING BTREE,
  INDEX `id_service`(`id_service`) USING BTREE,
  CONSTRAINT `trans_cs_service_ibfk_1` FOREIGN KEY (`id_trans_kendaraan`) REFERENCES `trans_kendaraan` (`id_trans_kendaraan`) ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `trans_cs_service_ibfk_2` FOREIGN KEY (`id_service`) REFERENCES `tb_service` (`id_service`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of trans_cs_service
-- ----------------------------
INSERT INTO `trans_cs_service` VALUES (22, 2, 11, '', '2019-01-01', 1, 100);
INSERT INTO `trans_cs_service` VALUES (23, 3, 8, 'Perbaikan dan perawatan kendaraan ', '2019-01-01', 1, 0);
INSERT INTO `trans_cs_service` VALUES (24, 3, 11, 'Perbaikan dan perawatan kendaraan ', '2019-01-01', 1, 0);
INSERT INTO `trans_cs_service` VALUES (25, 2, 8, 'Perbaikan dan perawatan kendaraan ', '2019-01-01', 1, 100);
INSERT INTO `trans_cs_service` VALUES (26, 3, 12, 'Perbaikan dan perawatan kendaraan ', '2019-01-01', 1, 0);

-- ----------------------------
-- Table structure for trans_kendaraan
-- ----------------------------
DROP TABLE IF EXISTS `trans_kendaraan`;
CREATE TABLE `trans_kendaraan`  (
  `id_trans_kendaraan` int(11) NOT NULL AUTO_INCREMENT,
  `no_registrasi` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `tgl_registrasi` date NULL DEFAULT NULL,
  `id_pemilik` int(11) NULL DEFAULT NULL,
  `id_kendaraan` int(11) NULL DEFAULT NULL,
  `aktif` enum('y','n') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'y',
  PRIMARY KEY (`id_trans_kendaraan`) USING BTREE,
  INDEX `id_kendaraan`(`id_kendaraan`) USING BTREE,
  INDEX `id_pemilik`(`id_pemilik`) USING BTREE,
  CONSTRAINT `trans_kendaraan_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `tb_pemilik` (`id_pemilik`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trans_kendaraan_ibfk_2` FOREIGN KEY (`id_kendaraan`) REFERENCES `tb_kendaraan` (`id_kendaraan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of trans_kendaraan
-- ----------------------------
INSERT INTO `trans_kendaraan` VALUES (2, '161118110736', '2018-12-08', 4, 2, 'y');
INSERT INTO `trans_kendaraan` VALUES (3, '101218040419', '2018-12-10', 5, 3, 'y');
INSERT INTO `trans_kendaraan` VALUES (4, '040119010334', '2019-01-04', 6, 4, 'n');
INSERT INTO `trans_kendaraan` VALUES (5, '040119043307', '2019-01-04', 7, 5, 'n');

-- ----------------------------
-- Table structure for trans_service
-- ----------------------------
DROP TABLE IF EXISTS `trans_service`;
CREATE TABLE `trans_service`  (
  `id_trans_service` int(11) NOT NULL AUTO_INCREMENT,
  `id_service` int(11) NOT NULL,
  `id_perbaikan` int(11) NOT NULL,
  PRIMARY KEY (`id_trans_service`) USING BTREE,
  INDEX `id_service`(`id_service`) USING BTREE,
  INDEX `id_perbaikan`(`id_perbaikan`) USING BTREE,
  CONSTRAINT `trans_service_ibfk_1` FOREIGN KEY (`id_service`) REFERENCES `tb_service` (`id_service`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `trans_service_ibfk_2` FOREIGN KEY (`id_perbaikan`) REFERENCES `tb_jenis_perbaikan` (`id_jenis_perbaikan`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 316 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of trans_service
-- ----------------------------
INSERT INTO `trans_service` VALUES (95, 12, 1);
INSERT INTO `trans_service` VALUES (96, 12, 2);
INSERT INTO `trans_service` VALUES (97, 12, 3);
INSERT INTO `trans_service` VALUES (98, 12, 5);
INSERT INTO `trans_service` VALUES (99, 12, 6);
INSERT INTO `trans_service` VALUES (100, 12, 7);
INSERT INTO `trans_service` VALUES (101, 12, 8);
INSERT INTO `trans_service` VALUES (102, 12, 10);
INSERT INTO `trans_service` VALUES (103, 12, 12);
INSERT INTO `trans_service` VALUES (112, 13, 2);
INSERT INTO `trans_service` VALUES (113, 13, 3);
INSERT INTO `trans_service` VALUES (114, 13, 5);
INSERT INTO `trans_service` VALUES (115, 13, 6);
INSERT INTO `trans_service` VALUES (116, 13, 7);
INSERT INTO `trans_service` VALUES (117, 13, 8);
INSERT INTO `trans_service` VALUES (118, 13, 10);
INSERT INTO `trans_service` VALUES (119, 14, 1);
INSERT INTO `trans_service` VALUES (120, 14, 2);
INSERT INTO `trans_service` VALUES (121, 14, 5);
INSERT INTO `trans_service` VALUES (122, 14, 6);
INSERT INTO `trans_service` VALUES (123, 14, 7);
INSERT INTO `trans_service` VALUES (124, 14, 8);
INSERT INTO `trans_service` VALUES (125, 14, 10);
INSERT INTO `trans_service` VALUES (126, 14, 11);
INSERT INTO `trans_service` VALUES (127, 14, 12);
INSERT INTO `trans_service` VALUES (135, 15, 1);
INSERT INTO `trans_service` VALUES (136, 15, 2);
INSERT INTO `trans_service` VALUES (137, 15, 5);
INSERT INTO `trans_service` VALUES (138, 15, 6);
INSERT INTO `trans_service` VALUES (139, 15, 7);
INSERT INTO `trans_service` VALUES (140, 15, 8);
INSERT INTO `trans_service` VALUES (141, 15, 10);
INSERT INTO `trans_service` VALUES (142, 16, 1);
INSERT INTO `trans_service` VALUES (143, 16, 2);
INSERT INTO `trans_service` VALUES (144, 16, 5);
INSERT INTO `trans_service` VALUES (145, 16, 6);
INSERT INTO `trans_service` VALUES (146, 16, 7);
INSERT INTO `trans_service` VALUES (147, 16, 8);
INSERT INTO `trans_service` VALUES (148, 16, 10);
INSERT INTO `trans_service` VALUES (149, 16, 12);
INSERT INTO `trans_service` VALUES (150, 17, 1);
INSERT INTO `trans_service` VALUES (151, 17, 2);
INSERT INTO `trans_service` VALUES (152, 17, 5);
INSERT INTO `trans_service` VALUES (153, 17, 6);
INSERT INTO `trans_service` VALUES (154, 17, 7);
INSERT INTO `trans_service` VALUES (155, 17, 8);
INSERT INTO `trans_service` VALUES (156, 17, 10);
INSERT INTO `trans_service` VALUES (166, 18, 1);
INSERT INTO `trans_service` VALUES (167, 18, 2);
INSERT INTO `trans_service` VALUES (168, 18, 5);
INSERT INTO `trans_service` VALUES (169, 18, 6);
INSERT INTO `trans_service` VALUES (170, 18, 7);
INSERT INTO `trans_service` VALUES (171, 18, 8);
INSERT INTO `trans_service` VALUES (172, 18, 10);
INSERT INTO `trans_service` VALUES (173, 18, 11);
INSERT INTO `trans_service` VALUES (174, 18, 12);
INSERT INTO `trans_service` VALUES (175, 18, 17);
INSERT INTO `trans_service` VALUES (176, 19, 1);
INSERT INTO `trans_service` VALUES (177, 19, 2);
INSERT INTO `trans_service` VALUES (178, 19, 5);
INSERT INTO `trans_service` VALUES (179, 19, 6);
INSERT INTO `trans_service` VALUES (180, 19, 10);
INSERT INTO `trans_service` VALUES (181, 20, 1);
INSERT INTO `trans_service` VALUES (182, 20, 2);
INSERT INTO `trans_service` VALUES (183, 20, 5);
INSERT INTO `trans_service` VALUES (184, 20, 6);
INSERT INTO `trans_service` VALUES (185, 20, 7);
INSERT INTO `trans_service` VALUES (186, 20, 8);
INSERT INTO `trans_service` VALUES (187, 20, 10);
INSERT INTO `trans_service` VALUES (188, 20, 12);
INSERT INTO `trans_service` VALUES (189, 20, 13);
INSERT INTO `trans_service` VALUES (190, 20, 14);
INSERT INTO `trans_service` VALUES (191, 20, 15);
INSERT INTO `trans_service` VALUES (209, 21, 1);
INSERT INTO `trans_service` VALUES (210, 21, 2);
INSERT INTO `trans_service` VALUES (211, 21, 5);
INSERT INTO `trans_service` VALUES (212, 21, 6);
INSERT INTO `trans_service` VALUES (213, 21, 7);
INSERT INTO `trans_service` VALUES (214, 21, 8);
INSERT INTO `trans_service` VALUES (215, 21, 10);
INSERT INTO `trans_service` VALUES (216, 21, 18);
INSERT INTO `trans_service` VALUES (281, 8, 1);
INSERT INTO `trans_service` VALUES (282, 8, 2);
INSERT INTO `trans_service` VALUES (283, 8, 3);
INSERT INTO `trans_service` VALUES (284, 8, 4);
INSERT INTO `trans_service` VALUES (285, 8, 5);
INSERT INTO `trans_service` VALUES (286, 8, 6);
INSERT INTO `trans_service` VALUES (287, 8, 7);
INSERT INTO `trans_service` VALUES (288, 8, 8);
INSERT INTO `trans_service` VALUES (289, 8, 9);
INSERT INTO `trans_service` VALUES (297, 11, 1);
INSERT INTO `trans_service` VALUES (298, 11, 2);
INSERT INTO `trans_service` VALUES (299, 11, 5);
INSERT INTO `trans_service` VALUES (300, 11, 6);
INSERT INTO `trans_service` VALUES (301, 11, 7);
INSERT INTO `trans_service` VALUES (302, 11, 8);
INSERT INTO `trans_service` VALUES (303, 11, 10);
INSERT INTO `trans_service` VALUES (304, 11, 16);
INSERT INTO `trans_service` VALUES (305, 22, 1);
INSERT INTO `trans_service` VALUES (306, 22, 2);
INSERT INTO `trans_service` VALUES (307, 22, 3);
INSERT INTO `trans_service` VALUES (308, 22, 5);
INSERT INTO `trans_service` VALUES (309, 22, 6);
INSERT INTO `trans_service` VALUES (310, 22, 7);
INSERT INTO `trans_service` VALUES (311, 22, 8);
INSERT INTO `trans_service` VALUES (312, 22, 10);
INSERT INTO `trans_service` VALUES (313, 22, 11);
INSERT INTO `trans_service` VALUES (314, 22, 12);
INSERT INTO `trans_service` VALUES (315, 22, 18);

-- ----------------------------
-- Table structure for waypoints_history
-- ----------------------------
DROP TABLE IF EXISTS `waypoints_history`;
CREATE TABLE `waypoints_history`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_history` int(11) NULL DEFAULT NULL,
  `kordinat` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_history`(`id_history`) USING BTREE,
  CONSTRAINT `waypoints_history_ibfk_1` FOREIGN KEY (`id_history`) REFERENCES `history_location` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of waypoints_history
-- ----------------------------
INSERT INTO `waypoints_history` VALUES (1, 186, '-5.1725619,119.4308099');

SET FOREIGN_KEY_CHECKS = 1;
