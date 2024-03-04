/*
 Navicat Premium Data Transfer

 Source Server         : MySQL - Local
 Source Server Type    : MySQL
 Source Server Version : 100424
 Source Host           : localhost:3306
 Source Schema         : tamanlangit

 Target Server Type    : MySQL
 Target Server Version : 100424
 File Encoding         : 65001

 Date: 28/02/2024 00:01:15
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for article_categories
-- ----------------------------
DROP TABLE IF EXISTS `article_categories`;
CREATE TABLE `article_categories`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of article_categories
-- ----------------------------
INSERT INTO `article_categories` VALUES (1, 'Profile Perusahaan', 'about-us', 1, NULL, '2024-02-10 13:39:49', NULL);
INSERT INTO `article_categories` VALUES (3, 'Syarat & Ketentuan', 'terms-condition', 1, NULL, '2024-02-10 13:39:49', NULL);
INSERT INTO `article_categories` VALUES (4, 'Kebijakan Privacy', 'privacy-policy', 1, NULL, '2024-02-10 13:39:49', NULL);
INSERT INTO `article_categories` VALUES (7, 'Berita 2024', 'berita-2024', 1, NULL, '2024-02-11 16:15:08', '2024-02-11 16:15:08');
INSERT INTO `article_categories` VALUES (8, 'Februari Berseri', 'februari-berseri', 1, NULL, '2024-02-11 16:15:31', '2024-02-11 16:15:31');

-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tags` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `count_views` int(11) NULL DEFAULT NULL,
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES (1, 1, 'Tentang Kami', '<p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. s</p><p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.&nbsp;</p><p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.&nbsp;</p><p>Untuk melihat keseruan lainnya silahkan tonton video dibawah ini.</p><figure class=\"media\"><oembed url=\"https://www.youtube.com/watch?v=BYVZh5kqaFg\"></oembed></figure><p>&nbsp;</p><p>&nbsp;</p>', 'published', NULL, NULL, 'tentang-kami', 1, NULL, '2024-02-10 13:44:17', '2024-02-10 17:09:45');
INSERT INTO `articles` VALUES (2, 3, 'Syarat & Ketentuan', '<p>syarat dan ketentuan</p>', 'published', NULL, NULL, 'syarat-&-ketentuan', 1, NULL, '2024-02-10 13:44:17', '2024-02-10 17:09:57');
INSERT INTO `articles` VALUES (3, 4, 'Kebijakan Privacy', '<p>kebijakan privacy</p>', 'published', NULL, NULL, 'kebijakan-privacy', 1, NULL, '2024-02-10 13:44:17', '2024-02-10 17:10:18');

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache
-- ----------------------------
INSERT INTO `cache` VALUES ('taman_langit_360_cache_divider', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:8:{i:0;O:18:\"App\\Models\\Divider\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"divider\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:1;s:5:\"title\";s:4:\"Main\";s:5:\"order\";i:1;}s:11:\"\0*\0original\";a:3:{s:2:\"id\";i:1;s:5:\"title\";s:4:\"Main\";s:5:\"order\";i:1;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:2:{i:0;s:5:\"title\";i:1;s:5:\"order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:18:\"App\\Models\\Divider\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"divider\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:2;s:5:\"title\";s:6:\"Wahana\";s:5:\"order\";i:2;}s:11:\"\0*\0original\";a:3:{s:2:\"id\";i:2;s:5:\"title\";s:6:\"Wahana\";s:5:\"order\";i:2;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:2:{i:0;s:5:\"title\";i:1;s:5:\"order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:18:\"App\\Models\\Divider\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"divider\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:3;s:5:\"title\";s:20:\"Inventory Management\";s:5:\"order\";i:3;}s:11:\"\0*\0original\";a:3:{s:2:\"id\";i:3;s:5:\"title\";s:20:\"Inventory Management\";s:5:\"order\";i:3;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:2:{i:0;s:5:\"title\";i:1;s:5:\"order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:18:\"App\\Models\\Divider\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"divider\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:4;s:5:\"title\";s:25:\"Content Management System\";s:5:\"order\";i:4;}s:11:\"\0*\0original\";a:3:{s:2:\"id\";i:4;s:5:\"title\";s:25:\"Content Management System\";s:5:\"order\";i:4;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:2:{i:0;s:5:\"title\";i:1;s:5:\"order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:18:\"App\\Models\\Divider\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"divider\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:5;s:5:\"title\";s:9:\"Transaksi\";s:5:\"order\";i:5;}s:11:\"\0*\0original\";a:3:{s:2:\"id\";i:5;s:5:\"title\";s:9:\"Transaksi\";s:5:\"order\";i:5;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:2:{i:0;s:5:\"title\";i:1;s:5:\"order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:5;O:18:\"App\\Models\\Divider\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"divider\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:6;s:5:\"title\";s:17:\"Management Parkir\";s:5:\"order\";i:6;}s:11:\"\0*\0original\";a:3:{s:2:\"id\";i:6;s:5:\"title\";s:17:\"Management Parkir\";s:5:\"order\";i:6;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:2:{i:0;s:5:\"title\";i:1;s:5:\"order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:6;O:18:\"App\\Models\\Divider\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"divider\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:7;s:5:\"title\";s:19:\"Access Control List\";s:5:\"order\";i:7;}s:11:\"\0*\0original\";a:3:{s:2:\"id\";i:7;s:5:\"title\";s:19:\"Access Control List\";s:5:\"order\";i:7;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:2:{i:0;s:5:\"title\";i:1;s:5:\"order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:7;O:18:\"App\\Models\\Divider\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:7:\"divider\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:3:{s:2:\"id\";i:8;s:5:\"title\";s:16:\"Printable Report\";s:5:\"order\";i:8;}s:11:\"\0*\0original\";a:3:{s:2:\"id\";i:8;s:5:\"title\";s:16:\"Printable Report\";s:5:\"order\";i:8;}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:2:{i:0;s:5:\"title\";i:1;s:5:\"order\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1708828522);
INSERT INTO `cache` VALUES ('taman_langit_360_cache_menus', 'N;', 1708828566);
INSERT INTO `cache` VALUES ('taman_langit_360_cache_spatie.permission.cache', 'a:3:{s:5:\"alias\";a:4:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";s:1:\"r\";s:5:\"roles\";}s:11:\"permissions\";a:81:{i:0;a:4:{s:1:\"a\";i:1;s:1:\"b\";s:14:\"dashboard-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:5:{i:0;i:1;i:1;i:2;i:2;i:3;i:3;i:4;i:4;i:5;}}i:1;a:4:{s:1:\"a\";i:2;s:1:\"b\";s:15:\"dashboard-graph\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:2;a:4:{s:1:\"a\";i:3;s:1:\"b\";s:16:\"dashboard-widget\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:3;a:4:{s:1:\"a\";i:4;s:1:\"b\";s:15:\"dashboard-table\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:4;a:4:{s:1:\"a\";i:5;s:1:\"b\";s:11:\"wahana-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:5;a:4:{s:1:\"a\";i:6;s:1:\"b\";s:13:\"wahana-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:6;a:4:{s:1:\"a\";i:7;s:1:\"b\";s:11:\"wahana-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:7;a:4:{s:1:\"a\";i:8;s:1:\"b\";s:13:\"wahana-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:8;a:4:{s:1:\"a\";i:9;s:1:\"b\";s:10:\"kupon-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:9;a:4:{s:1:\"a\";i:10;s:1:\"b\";s:12:\"kupon-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:10;a:4:{s:1:\"a\";i:11;s:1:\"b\";s:10:\"kupon-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:11;a:4:{s:1:\"a\";i:12;s:1:\"b\";s:12:\"kupon-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:12;a:4:{s:1:\"a\";i:13;s:1:\"b\";s:15:\"monitoring-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:13;a:4:{s:1:\"a\";i:14;s:1:\"b\";s:23:\"inventory-kategori-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:14;a:4:{s:1:\"a\";i:15;s:1:\"b\";s:25:\"inventory-kategori-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:15;a:4:{s:1:\"a\";i:16;s:1:\"b\";s:23:\"inventory-kategori-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:16;a:4:{s:1:\"a\";i:17;s:1:\"b\";s:25:\"inventory-kategori-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:17;a:4:{s:1:\"a\";i:18;s:1:\"b\";s:21:\"inventory-produk-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:18;a:4:{s:1:\"a\";i:19;s:1:\"b\";s:23:\"inventory-produk-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:19;a:4:{s:1:\"a\";i:20;s:1:\"b\";s:21:\"inventory-produk-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:20;a:4:{s:1:\"a\";i:21;s:1:\"b\";s:23:\"inventory-produk-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:21;a:4:{s:1:\"a\";i:22;s:1:\"b\";s:25:\"inventory-purchasing-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:22;a:4:{s:1:\"a\";i:23;s:1:\"b\";s:27:\"inventory-purchasing-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:23;a:4:{s:1:\"a\";i:24;s:1:\"b\";s:25:\"inventory-purchasing-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:24;a:4:{s:1:\"a\";i:25;s:1:\"b\";s:27:\"inventory-purchasing-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:25;a:4:{s:1:\"a\";i:26;s:1:\"b\";s:20:\"inventory-stock-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:26;a:4:{s:1:\"a\";i:27;s:1:\"b\";s:20:\"inventory-stock-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:27;a:4:{s:1:\"a\";i:28;s:1:\"b\";s:22:\"inventory-stock-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:28;a:4:{s:1:\"a\";i:29;s:1:\"b\";s:8:\"cms-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:29;a:4:{s:1:\"a\";i:32;s:1:\"b\";s:15:\"cms-kontak-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:30;a:4:{s:1:\"a\";i:35;s:1:\"b\";s:12:\"cms-faq-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:31;a:4:{s:1:\"a\";i:36;s:1:\"b\";s:14:\"cms-faq-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:32;a:4:{s:1:\"a\";i:37;s:1:\"b\";s:12:\"cms-faq-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:33;a:4:{s:1:\"a\";i:38;s:1:\"b\";s:14:\"cms-faq-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:34;a:4:{s:1:\"a\";i:41;s:1:\"b\";s:22:\"cms-blog-kategori-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:35;a:4:{s:1:\"a\";i:42;s:1:\"b\";s:24:\"cms-blog-kategori-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:36;a:4:{s:1:\"a\";i:43;s:1:\"b\";s:22:\"cms-blog-kategori-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:37;a:4:{s:1:\"a\";i:44;s:1:\"b\";s:24:\"cms-blog-kategori-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:38;a:4:{s:1:\"a\";i:45;s:1:\"b\";s:21:\"cms-blog-artikel-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:39;a:4:{s:1:\"a\";i:46;s:1:\"b\";s:23:\"cms-blog-artikel-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:40;a:4:{s:1:\"a\";i:47;s:1:\"b\";s:21:\"cms-blog-artikel-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:41;a:4:{s:1:\"a\";i:48;s:1:\"b\";s:23:\"cms-blog-artikel-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:2;}}i:42;a:4:{s:1:\"a\";i:49;s:1:\"b\";s:20:\"kasir-inventory-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:43;a:4:{s:1:\"a\";i:50;s:1:\"b\";s:22:\"kasir-inventory-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:4;}}i:44;a:4:{s:1:\"a\";i:51;s:1:\"b\";s:20:\"kasir-reservasi-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:45;a:4:{s:1:\"a\";i:52;s:1:\"b\";s:22:\"kasir-reservasi-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:46;a:4:{s:1:\"a\";i:53;s:1:\"b\";s:18:\"kasir-checkin-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:47;a:4:{s:1:\"a\";i:54;s:1:\"b\";s:20:\"kasir-checkin-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:48;a:4:{s:1:\"a\";i:55;s:1:\"b\";s:19:\"kasir-checkout-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:49;a:4:{s:1:\"a\";i:56;s:1:\"b\";s:21:\"kasir-checkout-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:3;}}i:50;a:4:{s:1:\"a\";i:57;s:1:\"b\";s:16:\"parkir-data-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:51;a:4:{s:1:\"a\";i:58;s:1:\"b\";s:16:\"parkir-data-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:52;a:4:{s:1:\"a\";i:59;s:1:\"b\";s:18:\"parkir-data-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:53;a:4:{s:1:\"a\";i:60;s:1:\"b\";s:14:\"parkir-in-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:54;a:4:{s:1:\"a\";i:61;s:1:\"b\";s:16:\"parkir-in-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:55;a:4:{s:1:\"a\";i:62;s:1:\"b\";s:15:\"parkir-out-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:56;a:4:{s:1:\"a\";i:63;s:1:\"b\";s:17:\"parkir-out-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:2:{i:0;i:1;i:1;i:5;}}i:57;a:4:{s:1:\"a\";i:64;s:1:\"b\";s:9:\"role-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:58;a:4:{s:1:\"a\";i:65;s:1:\"b\";s:11:\"role-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:59;a:4:{s:1:\"a\";i:66;s:1:\"b\";s:9:\"role-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:60;a:4:{s:1:\"a\";i:67;s:1:\"b\";s:11:\"role-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:61;a:4:{s:1:\"a\";i:68;s:1:\"b\";s:9:\"user-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:62;a:4:{s:1:\"a\";i:69;s:1:\"b\";s:11:\"user-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:63;a:4:{s:1:\"a\";i:70;s:1:\"b\";s:9:\"user-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:64;a:4:{s:1:\"a\";i:71;s:1:\"b\";s:11:\"user-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:65;a:4:{s:1:\"a\";i:72;s:1:\"b\";s:16:\"report-reservasi\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:66;a:4:{s:1:\"a\";i:73;s:1:\"b\";s:16:\"report-inventory\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:67;a:4:{s:1:\"a\";i:74;s:1:\"b\";s:13:\"report-parkir\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:68;a:4:{s:1:\"a\";i:75;s:1:\"b\";s:17:\"report-purchasing\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:69;a:4:{s:1:\"a\";i:76;s:1:\"b\";s:23:\"inventory-supplier-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:70;a:4:{s:1:\"a\";i:77;s:1:\"b\";s:25:\"inventory-supplier-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:71;a:4:{s:1:\"a\";i:78;s:1:\"b\";s:23:\"inventory-supplier-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:72;a:4:{s:1:\"a\";i:79;s:1:\"b\";s:25:\"inventory-supplier-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:73;a:4:{s:1:\"a\";i:80;s:1:\"b\";s:7:\"eo-list\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:74;a:4:{s:1:\"a\";i:81;s:1:\"b\";s:9:\"eo-create\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:75;a:4:{s:1:\"a\";i:82;s:1:\"b\";s:7:\"eo-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:76;a:4:{s:1:\"a\";i:83;s:1:\"b\";s:9:\"eo-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:77;a:4:{s:1:\"a\";i:84;s:1:\"b\";s:20:\"kasir-reservasi-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:78;a:4:{s:1:\"a\";i:85;s:1:\"b\";s:22:\"kasir-reservasi-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:79;a:4:{s:1:\"a\";i:86;s:1:\"b\";s:20:\"kasir-inventory-edit\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}i:80;a:4:{s:1:\"a\";i:87;s:1:\"b\";s:22:\"kasir-inventory-delete\";s:1:\"c\";s:3:\"web\";s:1:\"r\";a:1:{i:0;i:1;}}}s:5:\"roles\";a:5:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:13:\"Administrator\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:10:\"Editor CMS\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:15:\"Kasir Reservasi\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:15:\"Kasir Inventory\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:9:\"OP Parkir\";s:1:\"c\";s:3:\"web\";}}}', 1708914322);
INSERT INTO `cache` VALUES ('taman_langit_360_cache_user_menu', 'O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:25:{i:0;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:1;s:5:\"title\";s:9:\"Dashboard\";s:10:\"divider_id\";s:1:\"1\";s:9:\"parent_id\";N;s:5:\"order\";i:1;s:4:\"icon\";s:10:\"icon-home2\";s:5:\"route\";s:9:\"dashboard\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:1;s:5:\"title\";s:9:\"Dashboard\";s:10:\"divider_id\";s:1:\"1\";s:9:\"parent_id\";N;s:5:\"order\";i:1;s:4:\"icon\";s:10:\"icon-home2\";s:5:\"route\";s:9:\"dashboard\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:2;s:5:\"title\";s:12:\"Paket Wahana\";s:10:\"divider_id\";s:1:\"2\";s:9:\"parent_id\";N;s:5:\"order\";i:1;s:4:\"icon\";s:12:\"icon-images3\";s:5:\"route\";s:18:\"wahana.paket.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:2;s:5:\"title\";s:12:\"Paket Wahana\";s:10:\"divider_id\";s:1:\"2\";s:9:\"parent_id\";N;s:5:\"order\";i:1;s:4:\"icon\";s:12:\"icon-images3\";s:5:\"route\";s:18:\"wahana.paket.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:9;s:5:\"title\";s:10:\"Perusahaan\";s:10:\"divider_id\";s:1:\"4\";s:9:\"parent_id\";N;s:5:\"order\";i:1;s:4:\"icon\";s:11:\"icon-office\";s:5:\"route\";s:1:\"#\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:9;s:5:\"title\";s:10:\"Perusahaan\";s:10:\"divider_id\";s:1:\"4\";s:9:\"parent_id\";N;s:5:\"order\";i:1;s:4:\"icon\";s:11:\"icon-office\";s:5:\"route\";s:1:\"#\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:5:{i:0;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:10;s:5:\"title\";s:7:\"Profile\";s:10:\"divider_id\";s:1:\"4\";s:9:\"parent_id\";i:9;s:5:\"order\";i:2;s:4:\"icon\";s:11:\"icon-circle\";s:5:\"route\";s:22:\"cms.perusahaan.profile\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:10;s:5:\"title\";s:7:\"Profile\";s:10:\"divider_id\";s:1:\"4\";s:9:\"parent_id\";i:9;s:5:\"order\";i:2;s:4:\"icon\";s:11:\"icon-circle\";s:5:\"route\";s:22:\"cms.perusahaan.profile\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:11;s:5:\"title\";s:6:\"Kontak\";s:10:\"divider_id\";s:1:\"4\";s:9:\"parent_id\";i:9;s:5:\"order\";i:2;s:4:\"icon\";s:11:\"icon-circle\";s:5:\"route\";s:16:\"cms.kontak.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:11;s:5:\"title\";s:6:\"Kontak\";s:10:\"divider_id\";s:1:\"4\";s:9:\"parent_id\";i:9;s:5:\"order\";i:2;s:4:\"icon\";s:11:\"icon-circle\";s:5:\"route\";s:16:\"cms.kontak.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:2;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:12;s:5:\"title\";s:18:\"Syarat & Ketentuan\";s:10:\"divider_id\";s:1:\"4\";s:9:\"parent_id\";i:9;s:5:\"order\";i:3;s:4:\"icon\";s:11:\"icon-circle\";s:5:\"route\";s:20:\"cms.syarat-ketentuan\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:12;s:5:\"title\";s:18:\"Syarat & Ketentuan\";s:10:\"divider_id\";s:1:\"4\";s:9:\"parent_id\";i:9;s:5:\"order\";i:3;s:4:\"icon\";s:11:\"icon-circle\";s:5:\"route\";s:20:\"cms.syarat-ketentuan\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:13;s:5:\"title\";s:3:\"FAQ\";s:10:\"divider_id\";s:1:\"4\";s:9:\"parent_id\";i:9;s:5:\"order\";i:4;s:4:\"icon\";s:11:\"icon-circle\";s:5:\"route\";s:13:\"cms.faq.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:13;s:5:\"title\";s:3:\"FAQ\";s:10:\"divider_id\";s:1:\"4\";s:9:\"parent_id\";i:9;s:5:\"order\";i:4;s:4:\"icon\";s:11:\"icon-circle\";s:5:\"route\";s:13:\"cms.faq.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:14;s:5:\"title\";s:14:\"Privacy Policy\";s:10:\"divider_id\";s:1:\"4\";s:9:\"parent_id\";i:9;s:5:\"order\";i:5;s:4:\"icon\";s:11:\"icon-circle\";s:5:\"route\";s:18:\"cms.privacy-policy\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:14;s:5:\"title\";s:14:\"Privacy Policy\";s:10:\"divider_id\";s:1:\"4\";s:9:\"parent_id\";i:9;s:5:\"order\";i:5;s:4:\"icon\";s:11:\"icon-circle\";s:5:\"route\";s:18:\"cms.privacy-policy\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:3;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:22;s:5:\"title\";s:11:\"Data Parkir\";s:10:\"divider_id\";s:1:\"6\";s:9:\"parent_id\";N;s:5:\"order\";i:1;s:4:\"icon\";s:11:\"icon-grid52\";s:5:\"route\";s:17:\"parkir.data.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:22;s:5:\"title\";s:11:\"Data Parkir\";s:10:\"divider_id\";s:1:\"6\";s:9:\"parent_id\";N;s:5:\"order\";i:1;s:4:\"icon\";s:11:\"icon-grid52\";s:5:\"route\";s:17:\"parkir.data.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:4;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:25;s:5:\"title\";s:4:\"Role\";s:10:\"divider_id\";s:1:\"7\";s:9:\"parent_id\";N;s:5:\"order\";i:1;s:4:\"icon\";s:10:\"icon-vcard\";s:5:\"route\";s:19:\"acl.usergroup.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:25;s:5:\"title\";s:4:\"Role\";s:10:\"divider_id\";s:1:\"7\";s:9:\"parent_id\";N;s:5:\"order\";i:1;s:4:\"icon\";s:10:\"icon-vcard\";s:5:\"route\";s:19:\"acl.usergroup.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:5;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:31;s:5:\"title\";s:8:\"Supplier\";s:10:\"divider_id\";s:1:\"3\";s:9:\"parent_id\";N;s:5:\"order\";i:1;s:4:\"icon\";s:10:\"icon-store\";s:5:\"route\";s:24:\"inventory.supplier.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:31;s:5:\"title\";s:8:\"Supplier\";s:10:\"divider_id\";s:1:\"3\";s:9:\"parent_id\";N;s:5:\"order\";i:1;s:4:\"icon\";s:10:\"icon-store\";s:5:\"route\";s:24:\"inventory.supplier.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:6;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:3;s:5:\"title\";s:17:\"Monitoring Wahana\";s:10:\"divider_id\";s:1:\"2\";s:9:\"parent_id\";N;s:5:\"order\";i:2;s:4:\"icon\";s:9:\"icon-eye4\";s:5:\"route\";s:23:\"wahana.monitoring.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:3;s:5:\"title\";s:17:\"Monitoring Wahana\";s:10:\"divider_id\";s:1:\"2\";s:9:\"parent_id\";N;s:5:\"order\";i:2;s:4:\"icon\";s:9:\"icon-eye4\";s:5:\"route\";s:23:\"wahana.monitoring.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:7;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:5;s:5:\"title\";s:15:\"Kategori Produk\";s:10:\"divider_id\";s:1:\"3\";s:9:\"parent_id\";N;s:5:\"order\";i:2;s:4:\"icon\";s:15:\"icon-price-tags\";s:5:\"route\";s:31:\"inventory.kategori-produk.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:5;s:5:\"title\";s:15:\"Kategori Produk\";s:10:\"divider_id\";s:1:\"3\";s:9:\"parent_id\";N;s:5:\"order\";i:2;s:4:\"icon\";s:15:\"icon-price-tags\";s:5:\"route\";s:31:\"inventory.kategori-produk.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:8;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:15;s:5:\"title\";s:4:\"Blog\";s:10:\"divider_id\";s:1:\"4\";s:9:\"parent_id\";N;s:5:\"order\";i:2;s:4:\"icon\";s:13:\"icon-magazine\";s:5:\"route\";s:1:\"#\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:15;s:5:\"title\";s:4:\"Blog\";s:10:\"divider_id\";s:1:\"4\";s:9:\"parent_id\";N;s:5:\"order\";i:2;s:4:\"icon\";s:13:\"icon-magazine\";s:5:\"route\";s:1:\"#\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:2:{i:0;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:16;s:5:\"title\";s:8:\"Kategori\";s:10:\"divider_id\";s:1:\"4\";s:9:\"parent_id\";i:15;s:5:\"order\";i:5;s:4:\"icon\";s:11:\"icon-circle\";s:5:\"route\";s:26:\"cms.kategori-artikel.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:16;s:5:\"title\";s:8:\"Kategori\";s:10:\"divider_id\";s:1:\"4\";s:9:\"parent_id\";i:15;s:5:\"order\";i:5;s:4:\"icon\";s:11:\"icon-circle\";s:5:\"route\";s:26:\"cms.kategori-artikel.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:1;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:17;s:5:\"title\";s:7:\"Artikel\";s:10:\"divider_id\";s:1:\"4\";s:9:\"parent_id\";i:15;s:5:\"order\";i:5;s:4:\"icon\";s:11:\"icon-circle\";s:5:\"route\";s:17:\"cms.artikel.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:17;s:5:\"title\";s:7:\"Artikel\";s:10:\"divider_id\";s:1:\"4\";s:9:\"parent_id\";i:15;s:5:\"order\";i:5;s:4:\"icon\";s:11:\"icon-circle\";s:5:\"route\";s:17:\"cms.artikel.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:0:{}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:9;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:23;s:5:\"title\";s:18:\"Kasir Parkir Masuk\";s:10:\"divider_id\";s:1:\"6\";s:9:\"parent_id\";N;s:5:\"order\";i:2;s:4:\"icon\";s:17:\"icon-circle-left2\";s:5:\"route\";s:15:\"parkir.in.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:23;s:5:\"title\";s:18:\"Kasir Parkir Masuk\";s:10:\"divider_id\";s:1:\"6\";s:9:\"parent_id\";N;s:5:\"order\";i:2;s:4:\"icon\";s:17:\"icon-circle-left2\";s:5:\"route\";s:15:\"parkir.in.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:10;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:26;s:5:\"title\";s:4:\"User\";s:10:\"divider_id\";s:1:\"7\";s:9:\"parent_id\";N;s:5:\"order\";i:2;s:4:\"icon\";s:11:\"icon-users2\";s:5:\"route\";s:14:\"acl.user.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:26;s:5:\"title\";s:4:\"User\";s:10:\"divider_id\";s:1:\"7\";s:9:\"parent_id\";N;s:5:\"order\";i:2;s:4:\"icon\";s:11:\"icon-users2\";s:5:\"route\";s:14:\"acl.user.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:11;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:27;s:5:\"title\";s:16:\"Income Reservasi\";s:10:\"divider_id\";s:1:\"8\";s:9:\"parent_id\";N;s:5:\"order\";i:2;s:4:\"icon\";s:15:\"icon-file-text2\";s:5:\"route\";s:26:\"report.lap-reservasi.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:27;s:5:\"title\";s:16:\"Income Reservasi\";s:10:\"divider_id\";s:1:\"8\";s:9:\"parent_id\";N;s:5:\"order\";i:2;s:4:\"icon\";s:15:\"icon-file-text2\";s:5:\"route\";s:26:\"report.lap-reservasi.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:12;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:28;s:5:\"title\";s:16:\"Income Inventory\";s:10:\"divider_id\";s:1:\"8\";s:9:\"parent_id\";N;s:5:\"order\";i:2;s:4:\"icon\";s:15:\"icon-file-text2\";s:5:\"route\";s:26:\"report.lap-inventory.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:28;s:5:\"title\";s:16:\"Income Inventory\";s:10:\"divider_id\";s:1:\"8\";s:9:\"parent_id\";N;s:5:\"order\";i:2;s:4:\"icon\";s:15:\"icon-file-text2\";s:5:\"route\";s:26:\"report.lap-inventory.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:13;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:29;s:5:\"title\";s:12:\"Income Pakir\";s:10:\"divider_id\";s:1:\"8\";s:9:\"parent_id\";N;s:5:\"order\";i:2;s:4:\"icon\";s:15:\"icon-file-text2\";s:5:\"route\";s:23:\"report.lap-parkir.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:29;s:5:\"title\";s:12:\"Income Pakir\";s:10:\"divider_id\";s:1:\"8\";s:9:\"parent_id\";N;s:5:\"order\";i:2;s:4:\"icon\";s:15:\"icon-file-text2\";s:5:\"route\";s:23:\"report.lap-parkir.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:14;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:30;s:5:\"title\";s:17:\"Expense Pembelian\";s:10:\"divider_id\";s:1:\"8\";s:9:\"parent_id\";N;s:5:\"order\";i:2;s:4:\"icon\";s:15:\"icon-file-text2\";s:5:\"route\";s:27:\"report.lap-purchasing.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:30;s:5:\"title\";s:17:\"Expense Pembelian\";s:10:\"divider_id\";s:1:\"8\";s:9:\"parent_id\";N;s:5:\"order\";i:2;s:4:\"icon\";s:15:\"icon-file-text2\";s:5:\"route\";s:27:\"report.lap-purchasing.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:15;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:32;s:5:\"title\";s:19:\"Penjualan Inventory\";s:10:\"divider_id\";s:1:\"5\";s:9:\"parent_id\";N;s:5:\"order\";i:2;s:4:\"icon\";s:12:\"icon-printer\";s:5:\"route\";s:30:\"transaksi.cash-inventory.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:32;s:5:\"title\";s:19:\"Penjualan Inventory\";s:10:\"divider_id\";s:1:\"5\";s:9:\"parent_id\";N;s:5:\"order\";i:2;s:4:\"icon\";s:12:\"icon-printer\";s:5:\"route\";s:30:\"transaksi.cash-inventory.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:16;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:4;s:5:\"title\";s:5:\"Kupon\";s:10:\"divider_id\";s:1:\"2\";s:9:\"parent_id\";N;s:5:\"order\";i:3;s:4:\"icon\";s:11:\"icon-ticket\";s:5:\"route\";s:18:\"wahana.kupon.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:4;s:5:\"title\";s:5:\"Kupon\";s:10:\"divider_id\";s:1:\"2\";s:9:\"parent_id\";N;s:5:\"order\";i:3;s:4:\"icon\";s:11:\"icon-ticket\";s:5:\"route\";s:18:\"wahana.kupon.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:17;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:6;s:5:\"title\";s:6:\"Produk\";s:10:\"divider_id\";s:1:\"3\";s:9:\"parent_id\";N;s:5:\"order\";i:3;s:4:\"icon\";s:11:\"icon-stack2\";s:5:\"route\";s:22:\"inventory.produk.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:6;s:5:\"title\";s:6:\"Produk\";s:10:\"divider_id\";s:1:\"3\";s:9:\"parent_id\";N;s:5:\"order\";i:3;s:4:\"icon\";s:11:\"icon-stack2\";s:5:\"route\";s:22:\"inventory.produk.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:18;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:19;s:5:\"title\";s:14:\"Data Reservasi\";s:10:\"divider_id\";s:1:\"5\";s:9:\"parent_id\";N;s:5:\"order\";i:3;s:4:\"icon\";s:15:\"icon-calendar22\";s:5:\"route\";s:30:\"transaksi.cash-reservasi.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:19;s:5:\"title\";s:14:\"Data Reservasi\";s:10:\"divider_id\";s:1:\"5\";s:9:\"parent_id\";N;s:5:\"order\";i:3;s:4:\"icon\";s:15:\"icon-calendar22\";s:5:\"route\";s:30:\"transaksi.cash-reservasi.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:19;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:24;s:5:\"title\";s:19:\"Kasir Parkir Keluar\";s:10:\"divider_id\";s:1:\"6\";s:9:\"parent_id\";N;s:5:\"order\";i:3;s:4:\"icon\";s:18:\"icon-circle-right2\";s:5:\"route\";s:16:\"parkir.out.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:24;s:5:\"title\";s:19:\"Kasir Parkir Keluar\";s:10:\"divider_id\";s:1:\"6\";s:9:\"parent_id\";N;s:5:\"order\";i:3;s:4:\"icon\";s:18:\"icon-circle-right2\";s:5:\"route\";s:16:\"parkir.out.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:20;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:7;s:5:\"title\";s:9:\"Pembelian\";s:10:\"divider_id\";s:1:\"3\";s:9:\"parent_id\";N;s:5:\"order\";i:4;s:4:\"icon\";s:10:\"icon-truck\";s:5:\"route\";s:26:\"inventory.purchasing.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:7;s:5:\"title\";s:9:\"Pembelian\";s:10:\"divider_id\";s:1:\"3\";s:9:\"parent_id\";N;s:5:\"order\";i:4;s:4:\"icon\";s:10:\"icon-truck\";s:5:\"route\";s:26:\"inventory.purchasing.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:21;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:34;s:5:\"title\";s:15:\"Event Organizer\";s:10:\"divider_id\";s:1:\"2\";s:9:\"parent_id\";N;s:5:\"order\";i:4;s:4:\"icon\";s:15:\"ph-address-book\";s:5:\"route\";s:15:\"wahana.eo.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:34;s:5:\"title\";s:15:\"Event Organizer\";s:10:\"divider_id\";s:1:\"2\";s:9:\"parent_id\";N;s:5:\"order\";i:4;s:4:\"icon\";s:15:\"ph-address-book\";s:5:\"route\";s:15:\"wahana.eo.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:22;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:8;s:5:\"title\";s:5:\"Stock\";s:10:\"divider_id\";s:1:\"3\";s:9:\"parent_id\";N;s:5:\"order\";i:5;s:4:\"icon\";s:12:\"icon-archive\";s:5:\"route\";s:21:\"inventory.stock.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:8;s:5:\"title\";s:5:\"Stock\";s:10:\"divider_id\";s:1:\"3\";s:9:\"parent_id\";N;s:5:\"order\";i:5;s:4:\"icon\";s:12:\"icon-archive\";s:5:\"route\";s:21:\"inventory.stock.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:23;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:20;s:5:\"title\";s:21:\"Check-In Confirmation\";s:10:\"divider_id\";s:1:\"5\";s:9:\"parent_id\";N;s:5:\"order\";i:5;s:4:\"icon\";s:10:\"icon-enter\";s:5:\"route\";s:28:\"transaksi.cash-checkin.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:20;s:5:\"title\";s:21:\"Check-In Confirmation\";s:10:\"divider_id\";s:1:\"5\";s:9:\"parent_id\";N;s:5:\"order\";i:5;s:4:\"icon\";s:10:\"icon-enter\";s:5:\"route\";s:28:\"transaksi.cash-checkin.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}i:24;O:19:\"App\\Models\\MenuItem\":30:{s:13:\"\0*\0connection\";s:5:\"mysql\";s:8:\"\0*\0table\";s:4:\"menu\";s:13:\"\0*\0primaryKey\";s:2:\"id\";s:10:\"\0*\0keyType\";s:3:\"int\";s:12:\"incrementing\";b:1;s:7:\"\0*\0with\";a:0:{}s:12:\"\0*\0withCount\";a:0:{}s:19:\"preventsLazyLoading\";b:0;s:10:\"\0*\0perPage\";i:15;s:6:\"exists\";b:1;s:18:\"wasRecentlyCreated\";b:0;s:28:\"\0*\0escapeWhenCastingToString\";b:0;s:13:\"\0*\0attributes\";a:7:{s:2:\"id\";i:21;s:5:\"title\";s:22:\"Check-Out Confirmation\";s:10:\"divider_id\";s:1:\"5\";s:9:\"parent_id\";N;s:5:\"order\";i:6;s:4:\"icon\";s:9:\"icon-exit\";s:5:\"route\";s:29:\"transaksi.cash-checkout.index\";}s:11:\"\0*\0original\";a:7:{s:2:\"id\";i:21;s:5:\"title\";s:22:\"Check-Out Confirmation\";s:10:\"divider_id\";s:1:\"5\";s:9:\"parent_id\";N;s:5:\"order\";i:6;s:4:\"icon\";s:9:\"icon-exit\";s:5:\"route\";s:29:\"transaksi.cash-checkout.index\";}s:10:\"\0*\0changes\";a:0:{}s:8:\"\0*\0casts\";a:0:{}s:17:\"\0*\0classCastCache\";a:0:{}s:21:\"\0*\0attributeCastCache\";a:0:{}s:13:\"\0*\0dateFormat\";N;s:10:\"\0*\0appends\";a:0:{}s:19:\"\0*\0dispatchesEvents\";a:0:{}s:14:\"\0*\0observables\";a:0:{}s:12:\"\0*\0relations\";a:1:{s:8:\"children\";O:39:\"Illuminate\\Database\\Eloquent\\Collection\":2:{s:8:\"\0*\0items\";a:0:{}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}}s:10:\"\0*\0touches\";a:0:{}s:10:\"timestamps\";b:0;s:13:\"usesUniqueIds\";b:0;s:9:\"\0*\0hidden\";a:0:{}s:10:\"\0*\0visible\";a:0:{}s:11:\"\0*\0fillable\";a:6:{i:0;s:5:\"title\";i:1;s:10:\"divider_id\";i:2;s:9:\"parent_id\";i:3;s:5:\"order\";i:4;s:4:\"icon\";i:5;s:5:\"route\";}s:10:\"\0*\0guarded\";a:1:{i:0;s:1:\"*\";}}}s:28:\"\0*\0escapeWhenCastingToString\";b:0;}', 1708828724);

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks`  (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for contacts
-- ----------------------------
DROP TABLE IF EXISTS `contacts`;
CREATE TABLE `contacts`  (
  `phone_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `mobile_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `facebook_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `instagram_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `youtube_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `pinterest_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `tiktok_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `twitter_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of contacts
-- ----------------------------
INSERT INTO `contacts` VALUES ('022-5945526', '081313092581', 'hersdyanataf@gmail.com', 'https://facebook.com/hersdyanata', 'https://instagram.com/hersdyanata', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for coupon_wahana
-- ----------------------------
DROP TABLE IF EXISTS `coupon_wahana`;
CREATE TABLE `coupon_wahana`  (
  `coupon_id` bigint(20) NOT NULL,
  `wahana_id` bigint(20) NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of coupon_wahana
-- ----------------------------
INSERT INTO `coupon_wahana` VALUES (2, 4);
INSERT INTO `coupon_wahana` VALUES (2, 5);

-- ----------------------------
-- Table structure for coupons
-- ----------------------------
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `discount_type` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount` int(11) NOT NULL,
  `valid_for` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of coupons
-- ----------------------------
INSERT INTO `coupons` VALUES (2, '#TahunBaru2024Serus', 'kuy kuy kuys', 'NA', '2024-02-12', '2024-02-17', 20, 0, 'nominal', 10000, 'both', 1, 1, '2024-02-09 16:15:36', '2024-02-22 22:35:39');

-- ----------------------------
-- Table structure for divider
-- ----------------------------
DROP TABLE IF EXISTS `divider`;
CREATE TABLE `divider`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 10 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of divider
-- ----------------------------
INSERT INTO `divider` VALUES (1, 'Main', 1);
INSERT INTO `divider` VALUES (2, 'Wahana', 2);
INSERT INTO `divider` VALUES (3, 'Inventory Management', 3);
INSERT INTO `divider` VALUES (4, 'Content Management System', 4);
INSERT INTO `divider` VALUES (5, 'Transaksi', 5);
INSERT INTO `divider` VALUES (6, 'Management Parkir', 7);
INSERT INTO `divider` VALUES (7, 'Access Control List', 8);
INSERT INTO `divider` VALUES (8, 'Printable Report', 9);
INSERT INTO `divider` VALUES (9, 'Ticketing', 6);

-- ----------------------------
-- Table structure for event_organizers
-- ----------------------------
DROP TABLE IF EXISTS `event_organizers`;
CREATE TABLE `event_organizers`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `commission` int(11) NULL DEFAULT NULL,
  `commission_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of event_organizers
-- ----------------------------
INSERT INTO `event_organizers` VALUES (1, 'Jumain', 10, 'persentase', 1, 1, '2024-02-21 22:40:14', '2024-02-25 22:56:36');
INSERT INTO `event_organizers` VALUES (2, 'Roni', 15000, 'nominal', 1, 1, '2024-02-22 20:32:41', '2024-02-25 22:56:58');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT current_timestamp(0),
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `failed_jobs_uuid_unique`(`uuid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for faqs
-- ----------------------------
DROP TABLE IF EXISTS `faqs`;
CREATE TABLE `faqs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `question` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of faqs
-- ----------------------------
INSERT INTO `faqs` VALUES (3, 'Jam berapa check-in dan check-out?', '<p>Check-in jam 08:00</p><p>Check-out jam 08:00 esok harinya</p>');
INSERT INTO `faqs` VALUES (4, 'Apa key feature Taman Langit?', '<ul><li>Panroma view, menyajikan pemandangan 360° yang menyejukkan mata.</li><li>Pemandangan yang sangat memanjakan mata. Jika anda penat dengan rutinitas dan pekerjaan anda. Kuy healing kesini 😁</li><li>Udara segar dan bersih! Anda mungkin terlalu banyak menghirup udara yang terkontaminasi oleh polusi, sehingga paru-paru dan tubuh anda kurang mendapatkan oksigen yang baik. Kuy healing kesini, udara disini <strong>Segerrrrrrr!</strong></li></ul>');

-- ----------------------------
-- Table structure for inventory_stocks
-- ----------------------------
DROP TABLE IF EXISTS `inventory_stocks`;
CREATE TABLE `inventory_stocks`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `min_stock_reminder` int(11) NULL DEFAULT NULL,
  `price` int(11) NULL DEFAULT NULL,
  `last_purchase` datetime(0) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of inventory_stocks
-- ----------------------------
INSERT INTO `inventory_stocks` VALUES (1, 6, 50, NULL, NULL, '2024-02-21 21:27:28');

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `divider_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `parent_id` int(10) UNSIGNED NULL DEFAULT NULL,
  `order` int(11) NULL DEFAULT NULL,
  `icon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `route` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 37 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES (1, 'Dashboard', '1', NULL, 1, 'icon-home2', 'dashboard');
INSERT INTO `menu` VALUES (2, 'Paket Wahana', '2', NULL, 1, 'icon-images3', 'wahana.paket.index');
INSERT INTO `menu` VALUES (3, 'Monitoring Wahana', '2', NULL, 2, 'icon-eye4', 'wahana.monitoring.index');
INSERT INTO `menu` VALUES (4, 'Kupon', '2', NULL, 3, 'icon-percent', 'wahana.kupon.index');
INSERT INTO `menu` VALUES (5, 'Kategori Produk', '3', NULL, 2, 'icon-price-tags', 'inventory.kategori-produk.index');
INSERT INTO `menu` VALUES (6, 'Produk', '3', NULL, 3, 'icon-stack2', 'inventory.produk.index');
INSERT INTO `menu` VALUES (7, 'Pembelian', '3', NULL, 4, 'icon-truck', 'inventory.purchasing.index');
INSERT INTO `menu` VALUES (8, 'Stock', '3', NULL, 5, 'icon-archive', 'inventory.stock.index');
INSERT INTO `menu` VALUES (9, 'Perusahaan', '4', NULL, 1, 'icon-office', '#');
INSERT INTO `menu` VALUES (10, 'Profile', '4', 9, 2, 'icon-circle', 'cms.perusahaan.profile');
INSERT INTO `menu` VALUES (11, 'Kontak', '4', 9, 2, 'icon-circle', 'cms.kontak.index');
INSERT INTO `menu` VALUES (12, 'Syarat & Ketentuan', '4', 9, 3, 'icon-circle', 'cms.syarat-ketentuan');
INSERT INTO `menu` VALUES (13, 'FAQ', '4', 9, 4, 'icon-circle', 'cms.faq.index');
INSERT INTO `menu` VALUES (14, 'Privacy Policy', '4', 9, 5, 'icon-circle', 'cms.privacy-policy');
INSERT INTO `menu` VALUES (15, 'Blog', '4', NULL, 2, 'icon-magazine', '#');
INSERT INTO `menu` VALUES (16, 'Kategori', '4', 15, 5, 'icon-circle', 'cms.kategori-artikel.index');
INSERT INTO `menu` VALUES (17, 'Artikel', '4', 15, 5, 'icon-circle', 'cms.artikel.index');
INSERT INTO `menu` VALUES (19, 'Data Reservasi', '5', NULL, 3, 'icon-calendar22', 'transaksi.cash-reservasi.index');
INSERT INTO `menu` VALUES (20, 'Check-In Confirmation', '5', NULL, 5, 'icon-enter', 'transaksi.cash-checkin.index');
INSERT INTO `menu` VALUES (21, 'Check-Out Confirmation', '5', NULL, 6, 'icon-exit', 'transaksi.cash-checkout.index');
INSERT INTO `menu` VALUES (22, 'Data Parkir', '6', NULL, 1, 'icon-grid52', 'parkir.data.index');
INSERT INTO `menu` VALUES (23, 'Kasir Parkir Masuk', '6', NULL, 2, 'icon-circle-right2', 'parkir.in.index');
INSERT INTO `menu` VALUES (24, 'Kasir Parkir Keluar', '6', NULL, 3, 'icon-circle-left2', 'parkir.out.index');
INSERT INTO `menu` VALUES (25, 'Role', '7', NULL, 1, 'icon-vcard', 'acl.usergroup.index');
INSERT INTO `menu` VALUES (26, 'User', '7', NULL, 2, 'icon-users2', 'acl.user.index');
INSERT INTO `menu` VALUES (27, 'Income Reservasi', '8', NULL, 2, 'icon-file-text2', 'report.lap-reservasi.index');
INSERT INTO `menu` VALUES (28, 'Income Inventory', '8', NULL, 2, 'icon-file-text2', 'report.lap-inventory.index');
INSERT INTO `menu` VALUES (29, 'Income Pakir', '8', NULL, 2, 'icon-file-text2', 'report.lap-parkir.index');
INSERT INTO `menu` VALUES (30, 'Expense Pembelian', '8', NULL, 2, 'icon-file-text2', 'report.lap-purchasing.index');
INSERT INTO `menu` VALUES (31, 'Supplier', '3', NULL, 1, 'icon-store', 'inventory.supplier.index');
INSERT INTO `menu` VALUES (32, 'Penjualan Inventory', '5', NULL, 2, 'icon-printer', 'transaksi.cash-inventory.index');
INSERT INTO `menu` VALUES (34, 'Event Organizer', '2', NULL, 4, 'ph-address-book', 'wahana.eo.index');
INSERT INTO `menu` VALUES (35, 'Tiket', '9', NULL, 1, 'ph-textbox', 'tiket.data.index');
INSERT INTO `menu` VALUES (36, 'Tiket Terjual', '9', NULL, 2, 'ph-ticket', 'tiket.terjual.index');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 44 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_reset_tokens_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` VALUES (5, '2024_01_31_011330_create_menu', 2);
INSERT INTO `migrations` VALUES (6, '2024_01_31_011545_create_divider', 2);
INSERT INTO `migrations` VALUES (13, '2024_02_05_081941_create_permission_tables', 3);
INSERT INTO `migrations` VALUES (14, '2024_01_27_092702_wahana', 4);
INSERT INTO `migrations` VALUES (15, '2024_01_27_104952_wahana_rooms', 4);
INSERT INTO `migrations` VALUES (16, '2024_01_27_105416_wahana_facilities', 4);
INSERT INTO `migrations` VALUES (17, '2024_01_29_094928_wahana_image', 4);
INSERT INTO `migrations` VALUES (18, '2024_02_09_093324_create_coupons_table', 5);
INSERT INTO `migrations` VALUES (19, '2024_02_09_094811_create_coupon_wahana_table', 5);
INSERT INTO `migrations` VALUES (20, '2024_02_10_131049_articles', 6);
INSERT INTO `migrations` VALUES (21, '2024_02_10_131111_article_categories', 6);
INSERT INTO `migrations` VALUES (22, '2024_02_10_134812_create_contacts_table', 7);
INSERT INTO `migrations` VALUES (23, '2024_02_10_135840_create_f_a_q_s_table', 7);
INSERT INTO `migrations` VALUES (24, '2024_02_10_205206_product_categories', 8);
INSERT INTO `migrations` VALUES (25, '2024_02_10_210604_products', 8);
INSERT INTO `migrations` VALUES (26, '2024_02_11_152117_suppliers', 9);
INSERT INTO `migrations` VALUES (27, '2024_02_13_122102_create_purchases_table', 10);
INSERT INTO `migrations` VALUES (28, '2024_02_13_122110_create_purchase_details_table', 10);
INSERT INTO `migrations` VALUES (29, '2024_02_14_175827_create_inventory_stocks_table', 10);
INSERT INTO `migrations` VALUES (30, '2024_02_18_083343_create_sales_table', 11);
INSERT INTO `migrations` VALUES (31, '2024_02_18_083401_create_sales_details_table', 11);
INSERT INTO `migrations` VALUES (33, '2024_02_18_100325_create_payments_table', 11);
INSERT INTO `migrations` VALUES (35, '2024_02_21_220759_create_event_organizers_table', 12);
INSERT INTO `migrations` VALUES (36, '2024_02_25_090555_create_cache_table', 13);
INSERT INTO `migrations` VALUES (39, '2024_02_18_084707_create_reservations_table', 14);
INSERT INTO `migrations` VALUES (42, '2024_02_26_110452_create_tickets_table', 15);
INSERT INTO `migrations` VALUES (43, '2024_02_26_111004_create_ticket_serials_table', 15);

-- ----------------------------
-- Table structure for model_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE `model_has_permissions`  (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_permissions_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
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
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`, `model_id`, `model_type`) USING BTREE,
  INDEX `model_has_roles_model_id_model_type_index`(`model_id`, `model_type`) USING BTREE,
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of model_has_roles
-- ----------------------------
INSERT INTO `model_has_roles` VALUES (1, 'App\\Models\\User', 1);
INSERT INTO `model_has_roles` VALUES (5, 'App\\Models\\User', 1104);
INSERT INTO `model_has_roles` VALUES (5, 'App\\Models\\User', 1107);

-- ----------------------------
-- Table structure for password_reset_tokens
-- ----------------------------
DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens`  (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of password_reset_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for payments
-- ----------------------------
DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `payment_for` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `trans_id` bigint(20) NOT NULL,
  `method` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pay_date` datetime(0) NOT NULL,
  `received_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 51 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of payments
-- ----------------------------
INSERT INTO `payments` VALUES (1, 'sales', 2, 'cash', 200000, 'paid', '2024-02-18 19:50:49', 1);
INSERT INTO `payments` VALUES (2, 'sales', 2, 'transfer', 272860, 'paid', '2024-02-18 19:50:49', 1);
INSERT INTO `payments` VALUES (3, 'sales', 3, 'cash', 50000, 'paid', '2024-02-18 20:01:46', 1);
INSERT INTO `payments` VALUES (4, 'sales', 3, 'transfer', 68000, 'paid', '2024-02-18 20:01:46', 1);
INSERT INTO `payments` VALUES (5, 'sales', 4, 'cash', 20000, 'paid', '2024-02-18 20:03:27', 1);
INSERT INTO `payments` VALUES (6, 'sales', 5, 'cash', 10000, 'paid', '2024-02-18 20:03:36', 1);
INSERT INTO `payments` VALUES (7, 'sales', 5, 'transfer', 18000, 'paid', '2024-02-18 20:03:36', 1);
INSERT INTO `payments` VALUES (8, 'sales', 6, 'cash', 36000, 'paid', '2024-02-18 20:03:56', 1);
INSERT INTO `payments` VALUES (9, 'sales', 7, 'transfer', 118000, 'paid', '2024-02-18 20:07:37', 1);
INSERT INTO `payments` VALUES (10, 'sales', 8, 'cash', 22200, 'paid', '2024-02-18 20:08:16', 1);
INSERT INTO `payments` VALUES (11, 'sales', 9, 'cash', 18000, 'paid', '2024-02-18 22:10:35', 1);
INSERT INTO `payments` VALUES (12, 'sales', 10, 'cash', 99900, 'paid', '2024-02-18 22:12:22', 1);
INSERT INTO `payments` VALUES (13, 'sales', 11, 'cash', 90000, 'paid', '2024-02-18 22:13:22', 1);
INSERT INTO `payments` VALUES (14, 'sales', 12, 'cash', 119880, 'paid', '2024-02-18 22:13:42', 1);
INSERT INTO `payments` VALUES (15, 'sales', 13, 'cash', 90000, 'paid', '2024-02-18 23:03:54', 1);
INSERT INTO `payments` VALUES (20, 'sales', 15, 'cash', 5550, 'paid', '2024-02-21 01:11:56', 1);
INSERT INTO `payments` VALUES (21, 'sales', 16, 'cash', 5500, 'paid', '2024-02-21 01:12:24', 1);
INSERT INTO `payments` VALUES (22, 'sales', 17, 'cash', 5500, 'paid', '2024-02-21 01:13:32', 1);
INSERT INTO `payments` VALUES (23, 'sales', 18, 'cash', 11000, 'paid', '2024-02-21 01:17:55', 1);
INSERT INTO `payments` VALUES (24, 'sales', 19, 'cash', 6000, 'paid', '2024-02-21 01:19:51', 1);
INSERT INTO `payments` VALUES (48, 'reservation', 1, 'cash', 610500, 'paid', '2024-02-26 07:50:06', 1);
INSERT INTO `payments` VALUES (49, 'reservation', 2, 'cash', 4884000, 'paid', '2024-02-26 10:04:36', 1);
INSERT INTO `payments` VALUES (50, 'reservation', 3, 'cash', 610500, 'paid', '2024-02-26 10:09:45', 1);

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_guard_name_unique`(`name`, `guard_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 96 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'dashboard-list', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (2, 'dashboard-graph', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (3, 'dashboard-widget', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (4, 'dashboard-table', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (5, 'wahana-list', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (6, 'wahana-create', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (7, 'wahana-edit', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (8, 'wahana-delete', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (9, 'kupon-list', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (10, 'kupon-create', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (11, 'kupon-edit', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (12, 'kupon-delete', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (13, 'monitoring-list', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (14, 'inventory-kategori-list', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (15, 'inventory-kategori-create', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (16, 'inventory-kategori-edit', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (17, 'inventory-kategori-delete', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (18, 'inventory-produk-list', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (19, 'inventory-produk-create', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (20, 'inventory-produk-edit', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (21, 'inventory-produk-delete', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (22, 'inventory-purchasing-list', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (23, 'inventory-purchasing-create', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (24, 'inventory-purchasing-edit', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (25, 'inventory-purchasing-delete', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (26, 'inventory-stock-list', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (27, 'inventory-stock-edit', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (28, 'inventory-stock-delete', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (29, 'cms-edit', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (32, 'cms-kontak-edit', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (35, 'cms-faq-list', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (36, 'cms-faq-create', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (37, 'cms-faq-edit', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (38, 'cms-faq-delete', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (41, 'cms-blog-kategori-list', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (42, 'cms-blog-kategori-create', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (43, 'cms-blog-kategori-edit', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (44, 'cms-blog-kategori-delete', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (45, 'cms-blog-artikel-list', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (46, 'cms-blog-artikel-create', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (47, 'cms-blog-artikel-edit', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (48, 'cms-blog-artikel-delete', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (49, 'kasir-inventory-list', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (50, 'kasir-inventory-create', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (51, 'kasir-reservasi-list', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (52, 'kasir-reservasi-create', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (53, 'kasir-checkin-list', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (54, 'kasir-checkin-create', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (55, 'kasir-checkout-list', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (56, 'kasir-checkout-create', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (57, 'parkir-data-list', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (58, 'parkir-data-edit', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (59, 'parkir-data-delete', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (60, 'parkir-in-list', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (61, 'parkir-in-create', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (62, 'parkir-out-list', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (63, 'parkir-out-create', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (64, 'role-list', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (65, 'role-create', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (66, 'role-edit', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (67, 'role-delete', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (68, 'user-list', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (69, 'user-create', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (70, 'user-edit', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (71, 'user-delete', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (72, 'report-reservasi', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (73, 'report-inventory', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (74, 'report-parkir', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (75, 'report-purchasing', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (76, 'inventory-supplier-list', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (77, 'inventory-supplier-create', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (78, 'inventory-supplier-edit', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (79, 'inventory-supplier-delete', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (80, 'eo-list', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (81, 'eo-create', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (82, 'eo-edit', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (83, 'eo-delete', 'web', '2024-02-06 13:59:10', '2024-02-06 13:59:10');
INSERT INTO `permissions` VALUES (84, 'kasir-reservasi-edit', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (85, 'kasir-reservasi-delete', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (86, 'kasir-inventory-edit', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (87, 'kasir-inventory-delete', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (88, 'tiket-list', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (89, 'tiket-create', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (90, 'tiket-edit', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (91, 'tiket-delete', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (92, 'tiket-sales-list', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (93, 'tiket-sales-create', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (94, 'tiket-sales-edit', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `permissions` VALUES (95, 'tiket-sales-delete', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `last_used_at` timestamp(0) NULL DEFAULT NULL,
  `expires_at` timestamp(0) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `personal_access_tokens_token_unique`(`token`) USING BTREE,
  INDEX `personal_access_tokens_tokenable_type_tokenable_id_index`(`tokenable_type`, `tokenable_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of personal_access_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for product_categories
-- ----------------------------
DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE `product_categories`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) NULL DEFAULT NULL,
  `updated_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of product_categories
-- ----------------------------
INSERT INTO `product_categories` VALUES (1, 'Perlengkapan Camping', 1, 1, '2024-02-10 21:57:55', '2024-02-10 22:06:05');
INSERT INTO `product_categories` VALUES (3, 'Food and Baverage', 1, NULL, '2024-02-21 00:59:01', '2024-02-21 00:59:01');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) NOT NULL,
  `code` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `inventory_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` bigint(20) NULL DEFAULT NULL,
  `updated_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (2, 1, 'C1F25CLS', 'Kayu Bakar', 'sale', 1, 1, '2024-02-10 22:22:08', '2024-02-20 21:52:53');
INSERT INTO `products` VALUES (3, 1, 'F6M0T4NB', 'Gas', 'sale', 1, 1, '2024-02-14 21:51:40', '2024-02-20 21:53:49');
INSERT INTO `products` VALUES (4, 1, 'T5LCRNRN', 'Sleeping Bag', 'loan', 1, 1, '2024-02-14 21:51:52', '2024-02-20 21:54:00');
INSERT INTO `products` VALUES (5, 1, 'TZ9RFNO2', 'Tenda', 'loan', 1, 1, '2024-02-14 21:52:22', '2024-02-20 21:54:09');
INSERT INTO `products` VALUES (6, 3, '6EW432RH', 'Air Mineral - Aqua', 'sale', 1, NULL, '2024-02-21 00:59:23', '2024-02-21 00:59:23');
INSERT INTO `products` VALUES (7, 3, 'XUEKNGLS', 'Chitato', 'sale', 1, NULL, '2024-02-21 01:00:07', '2024-02-21 01:00:07');

-- ----------------------------
-- Table structure for purchase_details
-- ----------------------------
DROP TABLE IF EXISTS `purchase_details`;
CREATE TABLE `purchase_details`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `purchase_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of purchase_details
-- ----------------------------
INSERT INTO `purchase_details` VALUES (1, 1, 5, 50, 30000, 1500000);
INSERT INTO `purchase_details` VALUES (2, 2, 6, 50, 1500, 75000);

-- ----------------------------
-- Table structure for purchases
-- ----------------------------
DROP TABLE IF EXISTS `purchases`;
CREATE TABLE `purchases`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `trans_num` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `trans_date` datetime(0) NOT NULL,
  `supplier_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `ppn` int(11) NULL DEFAULT NULL,
  `ppn_amount` int(11) NULL DEFAULT NULL,
  `total_amount` int(11) NOT NULL,
  `non_stock` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` bigint(20) NULL DEFAULT NULL,
  `updated_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of purchases
-- ----------------------------
INSERT INTO `purchases` VALUES (1, '24020001', '2024-02-21 21:22:33', '1', 1500000, 11, 165000, 1665000, 'non stock', 1, 1, '2024-02-21 21:10:13', '2024-02-21 21:22:33');
INSERT INTO `purchases` VALUES (2, '24020001', '2024-02-21 21:27:28', '1', 75000, 11, 8250, 83250, 'stock', 1, NULL, '2024-02-21 21:27:28', '2024-02-21 21:27:28');

-- ----------------------------
-- Table structure for reservations
-- ----------------------------
DROP TABLE IF EXISTS `reservations`;
CREATE TABLE `reservations`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `trans_num` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `trans_via` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `night_count` int(11) NOT NULL,
  `checkin_date` datetime(0) NULL DEFAULT NULL,
  `checkout_date` datetime(0) NULL DEFAULT NULL,
  `wahana_id` bigint(20) NOT NULL,
  `room_id` bigint(20) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `wa_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `persons` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `ppn` int(11) NULL DEFAULT NULL,
  `ppn_amount` int(11) NULL DEFAULT NULL,
  `total_amount` int(11) NOT NULL,
  `coupon_id` bigint(20) NULL DEFAULT NULL,
  `discount` int(11) NULL DEFAULT NULL,
  `discount_type` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `discount_amount` int(11) NULL DEFAULT NULL,
  `payment_status` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cancel_flag` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `cancel_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `complete_flag` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eo_id` int(11) NULL DEFAULT NULL,
  `eo_commission` int(11) NULL DEFAULT NULL,
  `eo_commission_type` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eo_total_commission` int(11) NULL DEFAULT NULL,
  `omzet` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `rv_index`(`id`, `trans_num`, `trans_via`, `start_date`, `end_date`, `checkin_date`, `checkout_date`, `wahana_id`, `room_id`, `coupon_id`, `payment_status`, `cancel_flag`, `complete_flag`, `eo_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reservations
-- ----------------------------
INSERT INTO `reservations` VALUES (1, '24027M1D', 'onsite', '2024-03-01', '2024-03-02', 1, NULL, NULL, 5, 131, 'Hermansyah Handya Pranata', 'apocalypsix@gmail.com', '+6281313092581', 2, 550000, 550000, 11, 60500, 610500, NULL, NULL, NULL, NULL, 'paid', NULL, NULL, NULL, 1, 10, 'persentase', 61050, 549450, '2024-02-26 07:50:06', '2024-02-26 07:50:06');
INSERT INTO `reservations` VALUES (2, '24025LLU', 'onsite', '2024-03-01', '2024-03-09', 8, NULL, NULL, 5, 132, 'Hermansyah Handya Pranata', 'apocalypsix@gmail.com', '+6281313092581', 4, 550000, 4400000, 11, 484000, 4884000, NULL, NULL, NULL, NULL, 'paid', NULL, NULL, NULL, 2, 15000, 'nominal', 120000, 4764000, '2024-02-26 10:04:36', '2024-02-26 10:04:36');
INSERT INTO `reservations` VALUES (3, '24024RR5', 'onsite', '2024-02-26', '2024-02-27', 1, '2024-02-26 10:58:40', NULL, 5, 131, 'Hermansyah Handya Pranata', 'apocalypsix@gmail.com', '+6281313092581', 2, 550000, 550000, 11, 60500, 610500, NULL, NULL, NULL, NULL, 'paid', NULL, NULL, NULL, NULL, NULL, NULL, 0, 610500, '2024-02-26 10:09:45', '2024-02-26 10:58:40');

-- ----------------------------
-- Table structure for role_has_permissions
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE `role_has_permissions`  (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `role_has_permissions_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of role_has_permissions
-- ----------------------------
INSERT INTO `role_has_permissions` VALUES (1, 1);
INSERT INTO `role_has_permissions` VALUES (1, 2);
INSERT INTO `role_has_permissions` VALUES (1, 3);
INSERT INTO `role_has_permissions` VALUES (1, 4);
INSERT INTO `role_has_permissions` VALUES (1, 5);
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
INSERT INTO `role_has_permissions` VALUES (21, 1);
INSERT INTO `role_has_permissions` VALUES (22, 1);
INSERT INTO `role_has_permissions` VALUES (23, 1);
INSERT INTO `role_has_permissions` VALUES (24, 1);
INSERT INTO `role_has_permissions` VALUES (25, 1);
INSERT INTO `role_has_permissions` VALUES (26, 1);
INSERT INTO `role_has_permissions` VALUES (27, 1);
INSERT INTO `role_has_permissions` VALUES (28, 1);
INSERT INTO `role_has_permissions` VALUES (29, 1);
INSERT INTO `role_has_permissions` VALUES (29, 2);
INSERT INTO `role_has_permissions` VALUES (32, 1);
INSERT INTO `role_has_permissions` VALUES (32, 2);
INSERT INTO `role_has_permissions` VALUES (35, 1);
INSERT INTO `role_has_permissions` VALUES (35, 2);
INSERT INTO `role_has_permissions` VALUES (36, 1);
INSERT INTO `role_has_permissions` VALUES (36, 2);
INSERT INTO `role_has_permissions` VALUES (37, 1);
INSERT INTO `role_has_permissions` VALUES (37, 2);
INSERT INTO `role_has_permissions` VALUES (38, 1);
INSERT INTO `role_has_permissions` VALUES (38, 2);
INSERT INTO `role_has_permissions` VALUES (41, 1);
INSERT INTO `role_has_permissions` VALUES (41, 2);
INSERT INTO `role_has_permissions` VALUES (42, 1);
INSERT INTO `role_has_permissions` VALUES (42, 2);
INSERT INTO `role_has_permissions` VALUES (43, 1);
INSERT INTO `role_has_permissions` VALUES (43, 2);
INSERT INTO `role_has_permissions` VALUES (44, 1);
INSERT INTO `role_has_permissions` VALUES (44, 2);
INSERT INTO `role_has_permissions` VALUES (45, 1);
INSERT INTO `role_has_permissions` VALUES (45, 2);
INSERT INTO `role_has_permissions` VALUES (46, 1);
INSERT INTO `role_has_permissions` VALUES (46, 2);
INSERT INTO `role_has_permissions` VALUES (47, 1);
INSERT INTO `role_has_permissions` VALUES (47, 2);
INSERT INTO `role_has_permissions` VALUES (48, 1);
INSERT INTO `role_has_permissions` VALUES (48, 2);
INSERT INTO `role_has_permissions` VALUES (49, 1);
INSERT INTO `role_has_permissions` VALUES (49, 4);
INSERT INTO `role_has_permissions` VALUES (50, 1);
INSERT INTO `role_has_permissions` VALUES (50, 4);
INSERT INTO `role_has_permissions` VALUES (51, 1);
INSERT INTO `role_has_permissions` VALUES (51, 3);
INSERT INTO `role_has_permissions` VALUES (52, 1);
INSERT INTO `role_has_permissions` VALUES (52, 3);
INSERT INTO `role_has_permissions` VALUES (53, 1);
INSERT INTO `role_has_permissions` VALUES (53, 3);
INSERT INTO `role_has_permissions` VALUES (54, 1);
INSERT INTO `role_has_permissions` VALUES (54, 3);
INSERT INTO `role_has_permissions` VALUES (55, 1);
INSERT INTO `role_has_permissions` VALUES (55, 3);
INSERT INTO `role_has_permissions` VALUES (56, 1);
INSERT INTO `role_has_permissions` VALUES (56, 3);
INSERT INTO `role_has_permissions` VALUES (57, 1);
INSERT INTO `role_has_permissions` VALUES (57, 5);
INSERT INTO `role_has_permissions` VALUES (58, 1);
INSERT INTO `role_has_permissions` VALUES (58, 5);
INSERT INTO `role_has_permissions` VALUES (59, 1);
INSERT INTO `role_has_permissions` VALUES (59, 5);
INSERT INTO `role_has_permissions` VALUES (60, 1);
INSERT INTO `role_has_permissions` VALUES (60, 5);
INSERT INTO `role_has_permissions` VALUES (61, 1);
INSERT INTO `role_has_permissions` VALUES (61, 5);
INSERT INTO `role_has_permissions` VALUES (62, 1);
INSERT INTO `role_has_permissions` VALUES (62, 5);
INSERT INTO `role_has_permissions` VALUES (63, 1);
INSERT INTO `role_has_permissions` VALUES (63, 5);
INSERT INTO `role_has_permissions` VALUES (64, 1);
INSERT INTO `role_has_permissions` VALUES (65, 1);
INSERT INTO `role_has_permissions` VALUES (66, 1);
INSERT INTO `role_has_permissions` VALUES (67, 1);
INSERT INTO `role_has_permissions` VALUES (68, 1);
INSERT INTO `role_has_permissions` VALUES (69, 1);
INSERT INTO `role_has_permissions` VALUES (70, 1);
INSERT INTO `role_has_permissions` VALUES (71, 1);
INSERT INTO `role_has_permissions` VALUES (72, 1);
INSERT INTO `role_has_permissions` VALUES (73, 1);
INSERT INTO `role_has_permissions` VALUES (74, 1);
INSERT INTO `role_has_permissions` VALUES (75, 1);
INSERT INTO `role_has_permissions` VALUES (76, 1);
INSERT INTO `role_has_permissions` VALUES (77, 1);
INSERT INTO `role_has_permissions` VALUES (78, 1);
INSERT INTO `role_has_permissions` VALUES (79, 1);
INSERT INTO `role_has_permissions` VALUES (80, 1);
INSERT INTO `role_has_permissions` VALUES (81, 1);
INSERT INTO `role_has_permissions` VALUES (82, 1);
INSERT INTO `role_has_permissions` VALUES (83, 1);
INSERT INTO `role_has_permissions` VALUES (84, 1);
INSERT INTO `role_has_permissions` VALUES (85, 1);
INSERT INTO `role_has_permissions` VALUES (86, 1);
INSERT INTO `role_has_permissions` VALUES (87, 1);
INSERT INTO `role_has_permissions` VALUES (88, 1);
INSERT INTO `role_has_permissions` VALUES (89, 1);
INSERT INTO `role_has_permissions` VALUES (90, 1);
INSERT INTO `role_has_permissions` VALUES (91, 1);
INSERT INTO `role_has_permissions` VALUES (92, 1);
INSERT INTO `role_has_permissions` VALUES (93, 1);
INSERT INTO `role_has_permissions` VALUES (94, 1);
INSERT INTO `role_has_permissions` VALUES (95, 1);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_guard_name_unique`(`name`, `guard_name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'Administrator', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `roles` VALUES (2, 'Editor CMS', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `roles` VALUES (3, 'Kasir Reservasi', 'web', '2024-02-06 13:59:09', '2024-02-06 21:57:13');
INSERT INTO `roles` VALUES (4, 'Kasir Inventory', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');
INSERT INTO `roles` VALUES (5, 'OP Parkir', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');

-- ----------------------------
-- Table structure for sales
-- ----------------------------
DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `trans_num` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `trans_date` datetime(0) NOT NULL,
  `ppn` int(11) NULL DEFAULT NULL,
  `ppn_amount` int(11) NULL DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_by` bigint(20) NULL DEFAULT NULL,
  `updated_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sales
-- ----------------------------
INSERT INTO `sales` VALUES (2, 'S24020001', '2024-02-18 19:50:49', 11, 46860, 426000, 472860, 'paid', 1, NULL, '2024-02-18 19:50:49', '2024-02-18 19:50:49');
INSERT INTO `sales` VALUES (3, 'S24020002', '2024-02-18 20:01:46', NULL, NULL, 118000, 118000, 'paid', 1, NULL, '2024-02-18 20:01:46', '2024-02-18 20:01:46');
INSERT INTO `sales` VALUES (4, 'S24020003', '2024-02-18 20:03:27', NULL, NULL, 20000, 20000, 'paid', 1, NULL, '2024-02-18 20:03:27', '2024-02-18 20:03:27');
INSERT INTO `sales` VALUES (5, 'S24020004', '2024-02-18 20:03:36', NULL, NULL, 28000, 28000, 'paid', 1, NULL, '2024-02-18 20:03:36', '2024-02-18 20:03:36');
INSERT INTO `sales` VALUES (6, 'S24020005', '2024-02-18 20:03:56', NULL, NULL, 36000, 36000, 'paid', 1, NULL, '2024-02-18 20:03:56', '2024-02-18 20:03:56');
INSERT INTO `sales` VALUES (7, 'S24020006', '2024-02-18 20:07:37', NULL, NULL, 118000, 118000, 'paid', 1, NULL, '2024-02-18 20:07:37', '2024-02-18 20:07:37');
INSERT INTO `sales` VALUES (8, 'S24020007', '2024-02-18 20:08:16', 11, 2200, 20000, 22200, 'paid', 1, NULL, '2024-02-18 20:08:16', '2024-02-18 20:08:16');
INSERT INTO `sales` VALUES (9, 'S24020008', '2024-02-18 22:10:35', NULL, NULL, 18000, 18000, 'paid', 1, NULL, '2024-02-18 22:10:35', '2024-02-18 22:10:35');
INSERT INTO `sales` VALUES (10, 'S24020009', '2024-02-18 22:12:22', 11, 9900, 90000, 99900, 'paid', 1, NULL, '2024-02-18 22:12:22', '2024-02-18 22:12:22');
INSERT INTO `sales` VALUES (11, 'S24020010', '2024-02-18 22:13:22', NULL, NULL, 90000, 90000, 'paid', 1, NULL, '2024-02-18 22:13:22', '2024-02-18 22:13:22');
INSERT INTO `sales` VALUES (12, 'S24020011', '2024-02-18 22:13:42', 11, 11880, 108000, 119880, 'paid', 1, NULL, '2024-02-18 22:13:42', '2024-02-18 22:13:42');
INSERT INTO `sales` VALUES (13, 'S24020012', '2024-02-18 23:03:54', NULL, NULL, 90000, 90000, 'paid', 1, NULL, '2024-02-18 23:03:54', '2024-02-18 23:03:54');
INSERT INTO `sales` VALUES (15, 'S24020013', '2024-02-21 01:11:56', 11, 550, 5000, 5550, 'paid', 1, NULL, '2024-02-21 01:11:56', '2024-02-21 01:11:56');
INSERT INTO `sales` VALUES (16, 'S24020014', '2024-02-21 01:12:24', NULL, NULL, 5500, 5500, 'paid', 1, NULL, '2024-02-21 01:12:24', '2024-02-21 01:12:24');
INSERT INTO `sales` VALUES (17, 'S24020015', '2024-02-21 01:13:32', NULL, NULL, 5500, 5500, 'paid', 1, NULL, '2024-02-21 01:13:32', '2024-02-21 01:13:32');
INSERT INTO `sales` VALUES (18, 'S24020016', '2024-02-21 01:17:55', NULL, NULL, 11000, 11000, 'paid', 1, NULL, '2024-02-21 01:17:55', '2024-02-21 01:17:55');
INSERT INTO `sales` VALUES (19, 'S24020017', '2024-02-21 01:19:51', NULL, NULL, 6000, 6000, 'paid', 1, NULL, '2024-02-21 01:19:51', '2024-02-21 01:19:51');

-- ----------------------------
-- Table structure for sales_details
-- ----------------------------
DROP TABLE IF EXISTS `sales_details`;
CREATE TABLE `sales_details`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `sales_id` bigint(20) NOT NULL,
  `stock_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NULL DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sales_details
-- ----------------------------
INSERT INTO `sales_details` VALUES (1, 2, 2, 3, 2, 18000, 36000);
INSERT INTO `sales_details` VALUES (2, 2, 1, 2, 3, 10000, 30000);
INSERT INTO `sales_details` VALUES (3, 2, 3, 4, 4, 90000, 360000);
INSERT INTO `sales_details` VALUES (4, 3, 3, 4, 1, 90000, 90000);
INSERT INTO `sales_details` VALUES (5, 3, 2, 3, 1, 18000, 18000);
INSERT INTO `sales_details` VALUES (6, 3, 1, 2, 1, 10000, 10000);
INSERT INTO `sales_details` VALUES (7, 4, 1, 2, 2, 10000, 20000);
INSERT INTO `sales_details` VALUES (8, 5, 1, 2, 1, 10000, 10000);
INSERT INTO `sales_details` VALUES (9, 5, 2, 3, 1, 18000, 18000);
INSERT INTO `sales_details` VALUES (10, 6, 2, 3, 2, 18000, 36000);
INSERT INTO `sales_details` VALUES (11, 7, 2, 3, 1, 18000, 18000);
INSERT INTO `sales_details` VALUES (12, 7, 3, 4, 1, 90000, 90000);
INSERT INTO `sales_details` VALUES (13, 7, 1, 2, 1, 10000, 10000);
INSERT INTO `sales_details` VALUES (14, 8, 1, 2, 2, 10000, 20000);
INSERT INTO `sales_details` VALUES (15, 9, 2, 3, 1, 18000, 18000);
INSERT INTO `sales_details` VALUES (16, 10, 3, 4, 1, 90000, 90000);
INSERT INTO `sales_details` VALUES (17, 11, 3, 4, 1, 90000, 90000);
INSERT INTO `sales_details` VALUES (18, 12, 2, 3, 1, 18000, 18000);
INSERT INTO `sales_details` VALUES (19, 12, 3, 4, 1, 90000, 90000);
INSERT INTO `sales_details` VALUES (20, 13, 3, 4, 1, 90000, 90000);
INSERT INTO `sales_details` VALUES (21, 15, 4, 6, 1, 5000, 5000);
INSERT INTO `sales_details` VALUES (22, 16, 4, 6, 1, 5500, 5500);
INSERT INTO `sales_details` VALUES (23, 17, 4, 6, 1, 5500, 5500);
INSERT INTO `sales_details` VALUES (24, 18, 4, 6, 2, 5500, 11000);
INSERT INTO `sales_details` VALUES (25, 19, 5, 7, 1, 6000, 6000);

-- ----------------------------
-- Table structure for suppliers
-- ----------------------------
DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE `suppliers`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `pic_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) NULL DEFAULT NULL,
  `updated_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of suppliers
-- ----------------------------
INSERT INTO `suppliers` VALUES (1, 'Elpijis', 'Dadang', '0813130925813', 1, 1, '2024-02-11 15:42:15', '2024-02-11 15:45:28');

-- ----------------------------
-- Table structure for ticket_serials
-- ----------------------------
DROP TABLE IF EXISTS `ticket_serials`;
CREATE TABLE `ticket_serials`  (
  `ticket_id` bigint(20) NOT NULL,
  `serial_number` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sold_date` datetime(0) NULL DEFAULT NULL,
  INDEX `serial_index`(`ticket_id`, `serial_number`, `status`, `sold_date`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ticket_serials
-- ----------------------------

-- ----------------------------
-- Table structure for tickets
-- ----------------------------
DROP TABLE IF EXISTS `tickets`;
CREATE TABLE `tickets`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `valid_from` date NOT NULL,
  `valid_to` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `category` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `created_by` bigint(20) NULL DEFAULT NULL,
  `updated_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `tickets_index`(`id`, `code`, `description`, `valid_from`, `valid_to`, `category`, `status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tickets
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1108 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'hersdyanata', 'apocalypsix@gmail.com', NULL, '$2y$12$kR.ksPBM99y5qrsgSJMtKeCPyfUXtR7N63LBGd82rf4JIUxmlrLnS', NULL, '2024-01-30 11:58:33', '2024-02-11 20:35:40');
INSERT INTO `users` VALUES (1104, 'Abet surabet', 'hersdyanataf@gmail.com', NULL, '$2y$12$8xrxQMv7IsgzIePHDd4NM.JKSICqPTCnKt.NfMPaz9fWCju6Bzdby', NULL, '2024-02-05 00:43:27', '2024-02-06 17:57:29');
INSERT INTO `users` VALUES (1107, 'Oday suroday', 'oday@gmail.com', NULL, '$2y$12$MwA0DBlh1xwgNjig1ioiQeCy98K2dA9CVK12UxoaBQib6kmlsBDuq', NULL, '2024-02-06 18:23:51', '2024-02-06 18:23:51');

-- ----------------------------
-- Table structure for wahana
-- ----------------------------
DROP TABLE IF EXISTS `wahana`;
CREATE TABLE `wahana`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `max_person` int(11) NOT NULL,
  `room_wide` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_available` int(11) NOT NULL,
  `user_choose_room` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `room_name` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wahana
-- ----------------------------
INSERT INTO `wahana` VALUES (2, 'PRIVATE CAMPING', '<p>Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament. Lorem ipsum dolor sit ament.&nbsp;</p>', 3, '30', 20, 'Y', 'GF', 300000, 'private-camping', '2024-02-07 06:38:59', '2024-02-09 11:26:24');
INSERT INTO `wahana` VALUES (4, 'SUNRISE CAMPING DECK', '<p>lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet.&nbsp;</p>', 2, '30', 10, 'Y', 'SR', 650000, 'sunrise-camping-deck', '2024-02-09 11:22:16', '2024-02-09 11:22:16');
INSERT INTO `wahana` VALUES (5, 'MEDIUM PACK', '<p>lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet. lorem ipsum dolor sit amet.&nbsp;</p>', 4, '6', 40, 'Y', 'H2', 550000, 'medium-pack', '2024-02-21 14:20:09', '2024-02-21 14:20:09');

-- ----------------------------
-- Table structure for wahana_facilities
-- ----------------------------
DROP TABLE IF EXISTS `wahana_facilities`;
CREATE TABLE `wahana_facilities`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `wahana_id` bigint(20) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wahana_facilities
-- ----------------------------
INSERT INTO `wahana_facilities` VALUES (1, 2, 'OPUIY');
INSERT INTO `wahana_facilities` VALUES (2, 2, 'API UNGGUN');
INSERT INTO `wahana_facilities` VALUES (9, 2, 'SLEEPING BAG');
INSERT INTO `wahana_facilities` VALUES (14, 2, 'GALON');
INSERT INTO `wahana_facilities` VALUES (15, 4, 'Wifi');
INSERT INTO `wahana_facilities` VALUES (16, 4, 'Sleeping Bag');
INSERT INTO `wahana_facilities` VALUES (17, 4, 'Tenda');
INSERT INTO `wahana_facilities` VALUES (18, 5, 'Tenda Quechua 4.0');
INSERT INTO `wahana_facilities` VALUES (19, 5, 'Sleeping Bag');
INSERT INTO `wahana_facilities` VALUES (20, 5, 'Listrik');
INSERT INTO `wahana_facilities` VALUES (21, 5, 'Kayu Bakar');

-- ----------------------------
-- Table structure for wahana_images
-- ----------------------------
DROP TABLE IF EXISTS `wahana_images`;
CREATE TABLE `wahana_images`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `wahana_id` bigint(20) NOT NULL,
  `image_path` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wahana_images
-- ----------------------------
INSERT INTO `wahana_images` VALUES (12, 2, 'assets/images/wahana/20240207_279869243_1018156695346712_2284597254397374264_n.jpg');
INSERT INTO `wahana_images` VALUES (13, 5, 'assets/images/wahana/20240221_0001317.jpg');
INSERT INTO `wahana_images` VALUES (14, 5, 'assets/images/wahana/20240221_14121.jpg');
INSERT INTO `wahana_images` VALUES (15, 5, 'assets/images/wahana/20240221_4172.jpg');
INSERT INTO `wahana_images` VALUES (16, 5, 'assets/images/wahana/20240221_1777.jpg');

-- ----------------------------
-- Table structure for wahana_rooms
-- ----------------------------
DROP TABLE IF EXISTS `wahana_rooms`;
CREATE TABLE `wahana_rooms`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `wahana_id` bigint(20) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_checkin` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 171 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wahana_rooms
-- ----------------------------
INSERT INTO `wahana_rooms` VALUES (6, 2, 'GF_1', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (7, 2, 'GF_2', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (8, 2, 'GF_3', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (9, 2, 'GF_4', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (18, 2, 'GF_5', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (19, 2, 'GF_6', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (20, 2, 'GF_7', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (38, 2, 'GF_8', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (39, 2, 'GF_9', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (40, 2, 'GF_10', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (111, 4, 'SR_1', 'NA', NULL);
INSERT INTO `wahana_rooms` VALUES (112, 4, 'SR_2', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (113, 4, 'SR_3', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (114, 4, 'SR_4', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (115, 4, 'SR_5', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (116, 4, 'SR_6', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (117, 4, 'SR_7', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (118, 4, 'SR_8', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (119, 4, 'SR_9', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (120, 4, 'SR_10', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (121, 2, 'GF_11', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (122, 2, 'GF_12', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (123, 2, 'GF_13', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (124, 2, 'GF_14', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (125, 2, 'GF_15', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (126, 2, 'GF_16', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (127, 2, 'GF_17', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (128, 2, 'GF_18', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (129, 2, 'GF_19', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (130, 2, 'GF_20', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (131, 5, 'H2_1', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (132, 5, 'H2_2', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (133, 5, 'H2_3', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (134, 5, 'H2_4', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (135, 5, 'H2_5', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (136, 5, 'H2_6', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (137, 5, 'H2_7', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (138, 5, 'H2_8', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (139, 5, 'H2_9', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (140, 5, 'H2_10', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (141, 5, 'H2_11', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (142, 5, 'H2_12', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (143, 5, 'H2_13', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (144, 5, 'H2_14', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (145, 5, 'H2_15', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (146, 5, 'H2_16', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (147, 5, 'H2_17', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (148, 5, 'H2_18', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (149, 5, 'H2_19', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (150, 5, 'H2_20', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (151, 5, 'H2_21', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (152, 5, 'H2_22', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (153, 5, 'H2_23', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (154, 5, 'H2_24', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (155, 5, 'H2_25', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (156, 5, 'H2_26', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (157, 5, 'H2_27', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (158, 5, 'H2_28', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (159, 5, 'H2_29', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (160, 5, 'H2_30', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (161, 5, 'H2_31', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (162, 5, 'H2_32', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (163, 5, 'H2_33', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (164, 5, 'H2_34', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (165, 5, 'H2_35', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (166, 5, 'H2_36', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (167, 5, 'H2_37', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (168, 5, 'H2_38', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (169, 5, 'H2_39', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (170, 5, 'H2_40', 'A', NULL);

-- ----------------------------
-- View structure for reserved_dates
-- ----------------------------
DROP VIEW IF EXISTS `reserved_dates`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `reserved_dates` AS with recursive daterange as (
  select trans_num, start_date as date, end_date, wahana_id, room_id, night_count
    from reservations
   where cancel_flag is null
     and complete_flag is null
   union all
  select trans_num, date_add(date, interval 1 day) as date, end_date, wahana_id, room_id, night_count
    from daterange
   where date_add(date, interval 1 day) < end_date
)
select trans_num, date, wahana_id, room_id, night_count
  from daterange
 order by trans_num, date ;

SET FOREIGN_KEY_CHECKS = 1;
