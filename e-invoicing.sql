/*
 Navicat Premium Data Transfer

 Source Server         : my_local
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : localhost:3306
 Source Schema         : e-invoicing

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 17/12/2025 17:57:59
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for activity_log
-- ----------------------------
DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE `activity_log`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `log_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `event` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `subject_id` bigint UNSIGNED NULL DEFAULT NULL,
  `causer_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `causer_id` bigint UNSIGNED NULL DEFAULT NULL,
  `properties` json NULL,
  `batch_uuid` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `subject`(`subject_type` ASC, `subject_id` ASC) USING BTREE,
  INDEX `causer`(`causer_type` ASC, `causer_id` ASC) USING BTREE,
  INDEX `activity_log_log_name_index`(`log_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of activity_log
-- ----------------------------
INSERT INTO `activity_log` VALUES (1, 'App\\Models\\Role', 'Membuat Peran <a class=\"link\" target=\"_blank\" href=\"http://localhost:8000/role/2\">admin_swq</a>.', 'App\\Models\\Role', 'created', 2, 'App\\Models\\User', 1, '{\"attributes\": {\"name\": \"admin_swq\"}}', NULL, '2025-12-14 14:48:22', '2025-12-14 14:48:22');
INSERT INTO `activity_log` VALUES (2, 'App\\Models\\Role', 'Membuat Peran <a class=\"link\" target=\"_blank\" href=\"http://localhost:8000/role/3\">admin_sby</a>.', 'App\\Models\\Role', 'created', 3, 'App\\Models\\User', 1, '{\"attributes\": {\"name\": \"admin_sby\"}}', NULL, '2025-12-14 16:41:39', '2025-12-14 16:41:39');

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache
-- ----------------------------
INSERT INTO `cache` VALUES ('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:23:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:9:\"view_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:11:\"create_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:9:\"edit_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"delete_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"export_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:11:\"import_user\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:9:\"view_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:11:\"create_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:9:\"edit_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:11:\"delete_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:11:\"export_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:11:\"import_role\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:13:\"view_customer\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:15:\"create_customer\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:13:\"edit_customer\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:15:\"delete_customer\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:12:\"view_invoice\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:14:\"create_invoice\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:12:\"edit_invoice\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:14:\"delete_invoice\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:29:\"update_invoice_payment_status\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:2;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:16:\"download_invoice\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:12:\"send_invoice\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:3;}}}s:5:\"roles\";a:3:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:5:\"owner\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:9:\"admin_swq\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:9:\"admin_sby\";s:1:\"c\";s:3:\"web\";}}}', 1765794638);

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_toko` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pemilik` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `telepon` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES ('a104cdb6-de1e-4a71-9e75-1599923f47a3', 'Rofa Cake&#039;s', 'Ivani Ayu Wulandari', '08583342649', 'Jl.Mulawarman No.19B RT.02 Kel.Sepinggan Kec.Balikpapan Selatan KALTIM 76115', 'Sumbawa', 'robbishimozuki@gmail.com', '2025-12-14 13:43:04', '2025-12-14 16:00:27');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for invoice_items
-- ----------------------------
DROP TABLE IF EXISTS `invoice_items`;
CREATE TABLE `invoice_items`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `coli` int NULL DEFAULT NULL,
  `code` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `jenis_barang` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `berat` decimal(10, 2) NOT NULL,
  `ongkos_per_kg` decimal(15, 2) NOT NULL,
  `total_ongkos` decimal(15, 2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `invoice_items_invoice_id_foreign`(`invoice_id` ASC) USING BTREE,
  CONSTRAINT `invoice_items_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of invoice_items
-- ----------------------------
INSERT INTO `invoice_items` VALUES ('a096d4c5-d16b-46b7-92ce-38b56a45695d', 'e8eb3648-aab5-44d9-8524-7d9b0cca3215', 5, '12345', 'Sepeda Listrik', 100.00, 7000.00, 700000.00, '2025-12-14 14:19:12', '2025-12-14 14:19:12');
INSERT INTO `invoice_items` VALUES ('a096e26c-0c30-428d-9450-b05ee6d74340', 'b9e15925-e1d8-4606-9b8b-8baf6da67909', 5, '12345', 'Sepeda Listrik', 60.00, 7000.00, 420000.00, '2025-12-14 14:57:22', '2025-12-14 14:57:22');
INSERT INTO `invoice_items` VALUES ('a096e26c-1042-4065-b234-da85947ef466', 'b9e15925-e1d8-4606-9b8b-8baf6da67909', 9, '5433', 'Kertas', 70.00, 7000.00, 490000.00, '2025-12-14 14:57:22', '2025-12-14 14:57:22');
INSERT INTO `invoice_items` VALUES ('a096e5bd-3ff0-47c1-8e72-da3d2f01268b', 'e8eb3648-aab5-44d9-8524-7d9b0cca3215', 5, '7645', 'Buah', 50.00, 7000.00, 350000.00, '2025-12-14 15:06:39', '2025-12-14 15:06:39');
INSERT INTO `invoice_items` VALUES ('a096e5f6-42f3-43b6-ac04-40e0578aa84d', 'e8eb3648-aab5-44d9-8524-7d9b0cca3215', 6, '605', 'Kertas', 60.00, 7000.00, 420000.00, '2025-12-14 15:07:16', '2025-12-14 15:07:16');

-- ----------------------------
-- Table structure for invoices
-- ----------------------------
DROP TABLE IF EXISTS `invoices`;
CREATE TABLE `invoices`  (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `customer_id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota_asal` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota_tujuan` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `supir` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `no_polisi` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `total` decimal(15, 2) NOT NULL DEFAULT 0.00,
  `status_pembayaran` enum('belum_lunas','lunas') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'belum_lunas',
  `paid_at` timestamp NULL DEFAULT NULL,
  `paid_by` bigint UNSIGNED NULL DEFAULT NULL,
  `created_by` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `invoices_invoice_number_unique`(`invoice_number` ASC) USING BTREE,
  INDEX `invoices_customer_id_foreign`(`customer_id` ASC) USING BTREE,
  INDEX `invoices_created_by_foreign`(`created_by` ASC) USING BTREE,
  INDEX `invoices_paid_by_foreign`(`paid_by` ASC) USING BTREE,
  CONSTRAINT `invoices_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `invoices_paid_by_foreign` FOREIGN KEY (`paid_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of invoices
-- ----------------------------
INSERT INTO `invoices` VALUES ('b9e15925-e1d8-4606-9b8b-8baf6da67909', 'INV-2025-0002', '2025-12-14', 'a104cdb6-de1e-4a71-9e75-1599923f47a3', 'Surabaya', 'Sumbawa', 'Khairin Pratama', 'L 303 EA', 910000.00, 'lunas', NULL, NULL, 1, '2025-12-14 14:42:23', '2025-12-14 17:24:49');
INSERT INTO `invoices` VALUES ('e8eb3648-aab5-44d9-8524-7d9b0cca3215', 'INV-2025-0001', '2025-12-14', 'a104cdb6-de1e-4a71-9e75-1599923f47a3', 'Surabaya', 'Sumbawa', 'Khairin Pratama', 'L 303 EA', 1470000.00, 'belum_lunas', NULL, NULL, 1, '2025-12-14 14:19:12', '2025-12-14 15:07:16');

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches`  (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `cancelled_at` int NULL DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of job_batches
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED NULL DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `jobs_queue_index`(`queue` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '0001_01_01_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '0001_01_01_000001_create_cache_table', 1);
INSERT INTO `migrations` VALUES (3, '0001_01_01_000002_create_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2024_05_22_154314_add_locale_to_users_table', 1);
INSERT INTO `migrations` VALUES (5, '2025_02_18_154701_create_permission_tables', 1);
INSERT INTO `migrations` VALUES (6, '2025_02_20_115920_create_activity_log_table', 1);
INSERT INTO `migrations` VALUES (7, '2025_02_20_115921_add_event_column_to_activity_log_table', 1);
INSERT INTO `migrations` VALUES (8, '2025_02_20_115922_add_batch_uuid_column_to_activity_log_table', 1);
INSERT INTO `migrations` VALUES (9, '2025_12_14_123141_create_customers_table', 2);
INSERT INTO `migrations` VALUES (10, '2025_12_14_133121_create_invoices_table', 3);
INSERT INTO `migrations` VALUES (11, '2025_12_14_135705_create_invoice_items_table', 4);
INSERT INTO `migrations` VALUES (12, '2025_12_14_163400_add_payment_status_to_invoices', 5);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_permissions
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_roles
-- ----------------------------
DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE `model_has_roles`  (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id` ASC, `model_type` ASC) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (1, 'App\\Models\\User', 1);
INSERT INTO `model_has_roles` VALUES (2, 'App\\Models\\User', 2);
INSERT INTO `model_has_roles` VALUES (3, 'App\\Models\\User', 3);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 24 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'view_user', 'web', '2025-12-14 12:01:23', '2025-12-14 12:01:23');
INSERT INTO `permissions` VALUES (2, 'create_user', 'web', '2025-12-14 12:01:23', '2025-12-14 12:01:23');
INSERT INTO `permissions` VALUES (3, 'edit_user', 'web', '2025-12-14 12:01:23', '2025-12-14 12:01:23');
INSERT INTO `permissions` VALUES (4, 'delete_user', 'web', '2025-12-14 12:01:23', '2025-12-14 12:01:23');
INSERT INTO `permissions` VALUES (5, 'export_user', 'web', '2025-12-14 12:01:23', '2025-12-14 12:01:23');
INSERT INTO `permissions` VALUES (6, 'import_user', 'web', '2025-12-14 12:01:23', '2025-12-14 12:01:23');
INSERT INTO `permissions` VALUES (7, 'view_role', 'web', '2025-12-14 12:01:23', '2025-12-14 12:01:23');
INSERT INTO `permissions` VALUES (8, 'create_role', 'web', '2025-12-14 12:01:23', '2025-12-14 12:01:23');
INSERT INTO `permissions` VALUES (9, 'edit_role', 'web', '2025-12-14 12:01:23', '2025-12-14 12:01:23');
INSERT INTO `permissions` VALUES (10, 'delete_role', 'web', '2025-12-14 12:01:23', '2025-12-14 12:01:23');
INSERT INTO `permissions` VALUES (11, 'export_role', 'web', '2025-12-14 12:01:23', '2025-12-14 12:01:23');
INSERT INTO `permissions` VALUES (12, 'import_role', 'web', '2025-12-14 12:01:23', '2025-12-14 12:01:23');
INSERT INTO `permissions` VALUES (13, 'view_customer', 'web', '2025-12-14 12:55:18', '2025-12-14 12:55:18');
INSERT INTO `permissions` VALUES (14, 'create_customer', 'web', '2025-12-14 12:55:18', '2025-12-14 12:55:18');
INSERT INTO `permissions` VALUES (15, 'edit_customer', 'web', '2025-12-14 12:55:18', '2025-12-14 12:55:18');
INSERT INTO `permissions` VALUES (16, 'delete_customer', 'web', '2025-12-14 12:55:18', '2025-12-14 12:55:18');
INSERT INTO `permissions` VALUES (17, 'view_invoice', 'web', '2025-12-14 13:38:13', '2025-12-14 13:38:13');
INSERT INTO `permissions` VALUES (18, 'create_invoice', 'web', '2025-12-14 13:38:13', '2025-12-14 13:38:13');
INSERT INTO `permissions` VALUES (19, 'edit_invoice', 'web', '2025-12-14 13:38:13', '2025-12-14 13:38:13');
INSERT INTO `permissions` VALUES (20, 'delete_invoice', 'web', '2025-12-14 13:38:13', '2025-12-14 13:38:13');
INSERT INTO `permissions` VALUES (21, 'update_invoice_payment_status', 'web', '2025-12-14 16:59:19', '2025-12-14 16:59:19');
INSERT INTO `permissions` VALUES (22, 'download_invoice', 'web', '2025-12-14 17:29:52', '2025-12-14 17:29:52');
INSERT INTO `permissions` VALUES (23, 'send_invoice', 'web', '2025-12-14 17:29:52', '2025-12-14 17:29:52');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id` ASC) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES (1, 1);
INSERT INTO `role_has_permissions` VALUES (2, 1);
INSERT INTO `role_has_permissions` VALUES (3, 1);
INSERT INTO `role_has_permissions` VALUES (4, 1);
INSERT INTO `role_has_permissions` VALUES (5, 1);
INSERT INTO `role_has_permissions` VALUES (6, 1);
INSERT INTO `role_has_permissions` VALUES (7, 1);
INSERT INTO `role_has_permissions` VALUES (8, 1);
INSERT INTO `role_has_permissions` VALUES (9, 1);
INSERT INTO `role_has_permissions` VALUES (10, 1);
INSERT INTO `role_has_permissions` VALUES (11, 1);
INSERT INTO `role_has_permissions` VALUES (12, 1);
INSERT INTO `role_has_permissions` VALUES (13, 1);
INSERT INTO `role_has_permissions` VALUES (14, 1);
INSERT INTO `role_has_permissions` VALUES (15, 1);
INSERT INTO `role_has_permissions` VALUES (16, 1);
INSERT INTO `role_has_permissions` VALUES (17, 1);
INSERT INTO `role_has_permissions` VALUES (18, 1);
INSERT INTO `role_has_permissions` VALUES (19, 1);
INSERT INTO `role_has_permissions` VALUES (20, 1);
INSERT INTO `role_has_permissions` VALUES (13, 2);
INSERT INTO `role_has_permissions` VALUES (14, 2);
INSERT INTO `role_has_permissions` VALUES (15, 2);
INSERT INTO `role_has_permissions` VALUES (16, 2);
INSERT INTO `role_has_permissions` VALUES (17, 2);
INSERT INTO `role_has_permissions` VALUES (19, 2);
INSERT INTO `role_has_permissions` VALUES (21, 2);
INSERT INTO `role_has_permissions` VALUES (13, 3);
INSERT INTO `role_has_permissions` VALUES (14, 3);
INSERT INTO `role_has_permissions` VALUES (15, 3);
INSERT INTO `role_has_permissions` VALUES (16, 3);
INSERT INTO `role_has_permissions` VALUES (17, 3);
INSERT INTO `role_has_permissions` VALUES (18, 3);
INSERT INTO `role_has_permissions` VALUES (19, 3);
INSERT INTO `role_has_permissions` VALUES (20, 3);
INSERT INTO `role_has_permissions` VALUES (22, 3);
INSERT INTO `role_has_permissions` VALUES (23, 3);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name` ASC, `guard_name` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'owner', 'web', '2025-12-14 12:01:23', '2025-12-14 12:01:23');
INSERT INTO `roles` VALUES (2, 'admin_swq', 'web', '2025-12-14 14:48:22', '2025-12-14 14:48:22');
INSERT INTO `roles` VALUES (3, 'admin_sby', 'web', '2025-12-14 16:41:39', '2025-12-14 16:41:39');

-- ----------------------------
-- Table structure for sessions
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions`  (
  `id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED NULL DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `sessions_user_id_index`(`user_id` ASC) USING BTREE,
  INDEX `sessions_last_activity_index`(`last_activity` ASC) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sessions
-- ----------------------------
INSERT INTO `sessions` VALUES ('cnbfFd5ustpu9mKK3BqLJxyIYnCBDHRyiUjMv5Gu', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiRjl1V1ZCQk82cGFTdUJJeEVyYWNXNEhUUkxGYXZ2enBUUWxXSTVxNCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NjY6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9pbnZvaWNlL2I5ZTE1OTI1LWUxZDgtNDYwNi05YjhiLThiYWY2ZGE2NzkwOSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo2OiJsb2NhbGUiO3M6MjoiaWQiO30=', 1765714251);
INSERT INTO `sessions` VALUES ('imIMiAEQdcenlBMBpei2dYuMQUutEsnFN4RGh7Pu', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaXZXbUZqR3laTFBtQ0t1cDVydnhGaUdVYWU4SXNQZ2h6bjU5SWFBbSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NzA6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9pbnZvaWNlL2I5ZTE1OTI1LWUxZDgtNDYwNi05YjhiLThiYWY2ZGE2NzkwOS9wZGYiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1765708466);
INSERT INTO `sessions` VALUES ('lZlLl3ZrJcgPsHpg9YF8qvbctySQqYTavWh629wY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaVNnZlM1aFByUUJCUGF6cWtYSHluSG42TEg2Zk9meWdQTFFiVGVQTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC90ZXN0LWVtYWlsIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1765702294);
INSERT INTO `sessions` VALUES ('OBVgxx0VUfXFp6eIx4P0W9p6LUEuacNY5iBqhuSY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoib2RYWjc5NlVuRWpXdVFZalhOZTBJRlNFdjU4SDhkWWZCMGN4T3VOcSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1765762504);
INSERT INTO `sessions` VALUES ('tTvOjM7BVaVmDczds5UfDW0piBnI2edOMK1MUCLY', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQWJLUVNqUVM2bWJmaVh5OTFNZ2ZhUVE0eDN1clRDVnJ1bU5rUkpKYyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly9sb2NhbGhvc3Q6ODAwMC9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1765762613);

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `locale` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'id',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Test User', 'test@example.com', '2025-12-14 12:01:23', '$2y$12$Pc34h3NeynbkxS.wYFzi9..cU6mwcfdAyFKkgcisTZfpjzTqz0UMC', '36JFIUt3DH', '2025-12-14 12:01:23', '2025-12-14 12:17:51', 'id');
INSERT INTO `users` VALUES (2, 'admin sumbawa', 'maharddhika360@yahoo.com', NULL, '$2y$12$iPZXmIfMkXpGtefTdLLgcO26Ba554ejEK1QVZsQamZZ00lTSBQuzi', NULL, '2025-12-14 16:47:07', '2025-12-14 16:47:07', 'id');
INSERT INTO `users` VALUES (3, 'admin surabaya', 'bappeda@sumbawakab.go.id', NULL, '$2y$12$3uvd319oUK5s1TUow.NTW.cnkZsBijf8Euw9.2ZlIXUzI6zlve2tm', NULL, '2025-12-14 17:28:17', '2025-12-14 17:28:17', 'id');

SET FOREIGN_KEY_CHECKS = 1;
