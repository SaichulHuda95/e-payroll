/*
 Navicat Premium Data Transfer

 Source Server         : local mysql
 Source Server Type    : MySQL
 Source Server Version : 50734
 Source Host           : localhost:8889
 Source Schema         : e-payroll

 Target Server Type    : MySQL
 Target Server Version : 50734
 File Encoding         : 65001

 Date: 17/09/2023 19:06:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for ref_jabatan
-- ----------------------------
DROP TABLE IF EXISTS `ref_jabatan`;
CREATE TABLE `ref_jabatan` (
  `id_jabatan` int(11) NOT NULL AUTO_INCREMENT,
  `jabatan` varchar(30) NOT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_jabatan
-- ----------------------------
BEGIN;
INSERT INTO `ref_jabatan` (`id_jabatan`, `jabatan`) VALUES (1, 'Manager');
INSERT INTO `ref_jabatan` (`id_jabatan`, `jabatan`) VALUES (2, 'Staff');
INSERT INTO `ref_jabatan` (`id_jabatan`, `jabatan`) VALUES (3, 'Supervisor');
COMMIT;

-- ----------------------------
-- Table structure for ref_jenis_kelamin
-- ----------------------------
DROP TABLE IF EXISTS `ref_jenis_kelamin`;
CREATE TABLE `ref_jenis_kelamin` (
  `id_jenis_kelamin` int(11) NOT NULL AUTO_INCREMENT,
  `jenis_kelamin` varchar(30) NOT NULL,
  PRIMARY KEY (`id_jenis_kelamin`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_jenis_kelamin
-- ----------------------------
BEGIN;
INSERT INTO `ref_jenis_kelamin` (`id_jenis_kelamin`, `jenis_kelamin`) VALUES (1, 'Pria');
INSERT INTO `ref_jenis_kelamin` (`id_jenis_kelamin`, `jenis_kelamin`) VALUES (2, 'Wanita');
COMMIT;

-- ----------------------------
-- Table structure for ref_status_karyawan
-- ----------------------------
DROP TABLE IF EXISTS `ref_status_karyawan`;
CREATE TABLE `ref_status_karyawan` (
  `id_status` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ref_status_karyawan
-- ----------------------------
BEGIN;
INSERT INTO `ref_status_karyawan` (`id_status`, `status`) VALUES (1, 'Tetap');
INSERT INTO `ref_status_karyawan` (`id_status`, `status`) VALUES (2, 'Kontrak');
INSERT INTO `ref_status_karyawan` (`id_status`, `status`) VALUES (3, 'HL');
COMMIT;

-- ----------------------------
-- Table structure for tbl_cuti
-- ----------------------------
DROP TABLE IF EXISTS `tbl_cuti`;
CREATE TABLE `tbl_cuti` (
  `id_cuti` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_cuti` date NOT NULL,
  `ket` text,
  `created_by` varchar(150) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id_cuti`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_cuti
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_gaji
-- ----------------------------
DROP TABLE IF EXISTS `tbl_gaji`;
CREATE TABLE `tbl_gaji` (
  `id_gaji` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `periode_awal` date NOT NULL,
  `periode_akhir` date NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `tunjangan` int(11) NOT NULL,
  `insentif` int(11) NOT NULL,
  `total_lembur` int(11) NOT NULL,
  `pot_nwnp` int(11) NOT NULL,
  `pot_bpjs` int(11) NOT NULL,
  `total_gaji` int(11) NOT NULL,
  `status_gaji` char(3) NOT NULL,
  `verifikator` varchar(150) DEFAULT NULL,
  `created_by` varchar(150) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id_gaji`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_gaji
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_karyawan
-- ----------------------------
DROP TABLE IF EXISTS `tbl_karyawan`;
CREATE TABLE `tbl_karyawan` (
  `id_karyawan` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `id_jenis_kelamin` char(3) NOT NULL,
  `id_jabatan` char(3) NOT NULL,
  `id_status` char(3) NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `tunjangan` int(11) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id_karyawan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_karyawan
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_lembur
-- ----------------------------
DROP TABLE IF EXISTS `tbl_lembur`;
CREATE TABLE `tbl_lembur` (
  `id_lembur` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `id_status` char(3) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `gaji_pokok` int(11) NOT NULL,
  `tunjangan` int(11) NOT NULL,
  `jam_masuk` datetime NOT NULL,
  `jam_keluar` datetime NOT NULL,
  `lama_lembur` int(11) NOT NULL,
  `uang_lembur` int(11) NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id_lembur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_lembur
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for tbl_nwnp
-- ----------------------------
DROP TABLE IF EXISTS `tbl_nwnp`;
CREATE TABLE `tbl_nwnp` (
  `id_nwnp` int(11) NOT NULL AUTO_INCREMENT,
  `id_karyawan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal_absen` date NOT NULL,
  `ket` text,
  `created_by` varchar(150) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id_nwnp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_nwnp
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '0',
  `is_active` int(1) DEFAULT '0',
  `created_at` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user
-- ----------------------------
BEGIN;
INSERT INTO `user` (`id`, `username`, `email`, `image`, `password`, `role_id`, `is_active`, `created_at`) VALUES (16, 'admin', 'admin@gmail.com', 'default.jpg', '$2y$10$PX47Uw/FpAJvaQ1DHfz2EuezSawtzpuNyeWUVpVP8pUf7zGykR6OC', 1, 1, '2022-03-03');
INSERT INTO `user` (`id`, `username`, `email`, `image`, `password`, `role_id`, `is_active`, `created_at`) VALUES (17, 'user', 'user@gmail.com', 'default.jpg', '$2y$10$FtKLDqnRRR55OuPcw74D9eG..o.owaO6D8FnAf4LeiEAuJEOD1jje', 2, 1, '2022-11-22');
INSERT INTO `user` (`id`, `username`, `email`, `image`, `password`, `role_id`, `is_active`, `created_at`) VALUES (18, 'joni', 'joni@gmail.com', 'default.jpg', '$2y$10$A5rUAqNnfMHPP8gxGDBaX.miAWKwoP6GRq4dZqP.5FDUjjwNapLSO', 3, 1, '2023-09-16');
COMMIT;

-- ----------------------------
-- Table structure for user_access_menu
-- ----------------------------
DROP TABLE IF EXISTS `user_access_menu`;
CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user_access_menu
-- ----------------------------
BEGIN;
INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES (2, 1, 2);
INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES (3, 1, 3);
INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES (4, 1, 4);
INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES (13, 2, 2);
INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES (14, 2, 3);
INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES (15, 3, 4);
COMMIT;

-- ----------------------------
-- Table structure for user_menu
-- ----------------------------
DROP TABLE IF EXISTS `user_menu`;
CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user_menu
-- ----------------------------
BEGIN;
INSERT INTO `user_menu` (`id`, `menu`) VALUES (1, 'Dashboard');
INSERT INTO `user_menu` (`id`, `menu`) VALUES (2, 'Karyawan');
INSERT INTO `user_menu` (`id`, `menu`) VALUES (3, 'Gaji Karyawan');
INSERT INTO `user_menu` (`id`, `menu`) VALUES (4, 'Verifikasi');
INSERT INTO `user_menu` (`id`, `menu`) VALUES (5, 'Laporan');
COMMIT;

-- ----------------------------
-- Table structure for user_role
-- ----------------------------
DROP TABLE IF EXISTS `user_role`;
CREATE TABLE `user_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user_role
-- ----------------------------
BEGIN;
INSERT INTO `user_role` (`id`, `role`) VALUES (1, 'Admin');
INSERT INTO `user_role` (`id`, `role`) VALUES (2, 'Staff');
INSERT INTO `user_role` (`id`, `role`) VALUES (3, 'Supervisor');
COMMIT;

-- ----------------------------
-- Table structure for user_sub_menu
-- ----------------------------
DROP TABLE IF EXISTS `user_sub_menu`;
CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `is_active` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of user_sub_menu
-- ----------------------------
BEGIN;
INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES (1, 1, 'Dashboard', 'dashboard', 'bi bi-speedometer2', '1');
INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES (2, 2, 'Data Karyawan', 'karyawan', 'bi bi-person', '1');
INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES (3, 3, 'Lemburan', 'lemburan', 'bi bi-watch', '1');
INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES (4, 3, 'NWNP', 'nwnp', 'bi bi-calendar-check', '1');
INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES (5, 3, 'Cuti', 'cuti', 'bi bi-calendar-check', '1');
INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES (6, 3, 'Manajemen Gaji', 'gaji', 'bi bi-cash', '1');
INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES (7, 4, 'Pengesahan Gaji', 'verifikasi', 'bi bi-card-checklist', '1');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
