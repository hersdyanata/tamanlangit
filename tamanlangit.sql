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

 Date: 02/06/2024 22:42:52
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
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES (1, 1, 'Tentang Kami', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Felis donec et odio pellentesque. Nisi est sit amet facilisis magna. Semper feugiat nibh sed pulvinar. Id leo in vitae turpis massa sed elementum tempus. Eget est lorem ipsum dolor. Bibendum enim facilisis gravida neque. Nibh ipsum consequat nisl vel. Luctus venenatis lectus magna fringilla urna porttitor rhoncus dolor. Fermentum dui faucibus in ornare quam viverra. Mi quis hendrerit dolor magna eget est. Nunc faucibus a pellentesque sit amet. Donec pretium vulputate sapien nec sagittis aliquam. Ullamcorper sit amet risus nullam eget. Nulla aliquet porttitor lacus luctus accumsan tortor.</p><p>&nbsp;</p><p>Vestibulum lectus mauris ultrices eros. Pharetra massa massa ultricies mi quis hendrerit dolor magna eget. Sit amet nisl purus in mollis nunc sed. Aenean euismod elementum nisi quis eleifend.</p><p>&nbsp;</p><p>Pulvinar neque laoreet suspendisse interdum consectetur libero. Urna id volutpat lacus laoreet non curabitur gravida arcu ac. Varius morbi enim nunc faucibus. Ornare suspendisse sed nisi lacus sed viverra tellus in. Massa tincidunt dui ut ornare lectus sit amet. Suspendisse sed nisi lacus sed viverra tellus in. Dapibus ultrices in iaculis.</p><p>&nbsp;</p><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Felis donec et odio pellentesque. Nisi est sit amet facilisis magna. Semper feugiat nibh sed pulvinar. Id leo in vitae turpis massa sed elementum tempus. Eget est lorem ipsum dolor. Bibendum enim facilisis gravida neque. Nibh ipsum consequat nisl vel. Fermentum dui faucibus in ornare quam viverra.</p><p>&nbsp;</p><p>Sollicitudin ac. Pellentesque elit eget gravida cum sociis. In fermentum et sollicitudin ac. Leo integer malesuada nunc vel risus commodo viverra maecenas.</p>', 'published', NULL, NULL, 'tentang-kami', 1, NULL, '2024-02-10 13:44:17', '2024-03-09 22:11:54', 'camping ground,pangalengan,jawa barat');
INSERT INTO `articles` VALUES (2, 3, 'Syarat & Ketentuan', '<p>syarat dan ketentuan</p>', 'published', NULL, NULL, 'syarat-&-ketentuan', 1, NULL, '2024-02-10 13:44:17', '2024-02-10 17:09:57', '');
INSERT INTO `articles` VALUES (3, 4, 'Kebijakan Privacy', '<p><strong>Efektif per tanggal: [01 Januari 2023]</strong></p><p>Kami di Taman Langit Pangalengan menghargai privasi Anda dan berkomitmen untuk melindungi informasi pribadi yang Anda berikan kepada kami. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda saat Anda menggunakan layanan kami. Harap baca kebijakan ini dengan seksama.</p><p><strong>Informasi yang Kami Kumpulkan:</strong></p><p>a. Informasi Pribadi:&nbsp;</p><p>Kami dapat mengumpulkan informasi pribadi, seperti nama, alamat, nomor telepon, alamat email, dan informasi identifikasi lainnya saat Anda membuat reservasi atau berinteraksi dengan kami melalui saluran komunikasi yang disediakan.</p><p>b. Informasi Transaksi:<strong>&nbsp;</strong></p><p>Kami dapat mengumpulkan informasi terkait dengan transaksi yang Anda lakukan dengan kami, termasuk informasi pembayaran dan rincian transaksi.</p><p>c. Informasi Log:&nbsp;</p><p>Kami dapat mengumpulkan informasi tertentu secara otomatis, seperti alamat IP, jenis perangkat, browser yang digunakan, waktu akses, dan aktivitas di situs web kami melalui penggunaan teknologi pelacakan.</p><p><strong>Penggunaan Informasi:</strong></p><p>a. Kami menggunakan informasi pribadi Anda untuk memproses reservasi Anda, menghubungi Anda terkait dengan reservasi atau permintaan Anda, menyediakan layanan yang diminta, dan untuk tujuan administratif dan komunikasi lainnya yang terkait dengan layanan kami.</p><p>b. Informasi transaksi digunakan untuk memproses pembayaran, memverifikasi identitas, mengelola reservasi, dan untuk keperluan akuntansi dan pelaporan internal.</p><p>c. Informasi log digunakan untuk analisis statistik, pemeliharaan dan perbaikan situs web kami, serta untuk melacak dan mengatasi masalah keamanan.</p><p>&nbsp;</p><p><strong>Pengungkapan Informasi kepada Pihak Ketiga:</strong></p><p>a. Kami tidak akan menjual, menyewakan, atau menukar informasi pribadi Anda kepada pihak ketiga tanpa persetujuan Anda, kecuali jika diwajibkan oleh hukum atau dalam situasi darurat yang melibatkan kepentingan keamanan.</p><p>b. Kami dapat mengungkapkan informasi kepada pihak ketiga yang bekerja sama dengan kami dalam menyediakan layanan atau dukungan teknis yang berkaitan dengan operasional Taman Langit Pangalengan. Namun, mereka akan diberi instruksi untuk menjaga kerahasiaan informasi tersebut.</p><p>&nbsp;</p><p><strong>Keamanan Informasi:</strong></p><p>a. Kami menerapkan langkah-langkah keamanan yang sesuai untuk melindungi informasi pribadi Anda dari akses yang tidak sah, penggunaan, atau pengungkapan yang tidak sah. Namun, tidak ada sistem keamanan yang dapat dijamin sepenuhnya bebas dari risiko.</p><p>b. Kami akan menyimpan informasi pribadi Anda selama diperlukan untuk memenuhi tujuan yang dijelaskan dalam kebijakan ini, kecuali jika ada persyaratan retensi data yang lebih lama yang ditetapkan oleh hukum yang berlaku.</p><p>&nbsp;</p><p><strong>Hak Anda:</strong></p><p>a. Anda memiliki hak untuk mengakses, memperbaiki, dan menghapus informasi pribadi Anda yang kami miliki. Anda juga dapat meminta kami untuk tidak menggunakan informasi pribadi Anda untuk tujuan pemasaran.</p><p>b. Harap hubungi kami melalui saluran yang disediakan untuk mengajukan permintaan tersebut atau jika Anda memiliki pertanyaan atau kekhawatiran terkait dengan privasi Anda.</p><p>&nbsp;</p><p>Kebijakan Privasi ini dapat diperbarui dari waktu ke waktu untuk mencerminkan perubahan dalam praktik kami atau perubahan hukum yang berlaku. Perubahan signifikan akan diberitahukan kepada Anda melalui pemberitahuan di situs web kami atau melalui saluran komunikasi lain yang tersedia.</p><p>&nbsp;</p><p>Dengan menggunakan layanan kami, Anda menyetujui pengumpulan, penggunaan, dan pengungkapan informasi Anda sesuai dengan Kebijakan Privasi ini.</p>', 'published', NULL, NULL, 'kebijakan-privacy', 1, NULL, '2024-02-10 13:44:17', '2024-03-07 17:19:17', '');
INSERT INTO `articles` VALUES (5, 7, 'testtttttto', '<p>asdfasdfasdf</p>', 'published', NULL, NULL, 'testtttttto', 1, 1, '2024-03-09 22:22:39', '2024-03-09 22:26:28', 'test,tost,tist,tast');

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
-- Table structure for configurations
-- ----------------------------
DROP TABLE IF EXISTS `configurations`;
CREATE TABLE `configurations`  (
  `prefix` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parameter` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `value` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of configurations
-- ----------------------------
INSERT INTO `configurations` VALUES ('cancel', 'more_than_3', 'Refund lebih dari 3 hari', '70');
INSERT INTO `configurations` VALUES ('cancel', 'less_than_3', 'Refund kurang dari 3 hari', '0');
INSERT INTO `configurations` VALUES ('ppn', 'ppn', 'PPn', '11');

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
INSERT INTO `coupon_wahana` VALUES (2, 1);
INSERT INTO `coupon_wahana` VALUES (2, 2);

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
INSERT INTO `coupons` VALUES (2, '#abcd', 'kuy kuy kuys', 'A', '2024-03-01', '2024-03-31', 20, 14, 'nominal', 30000, 'both', 1, 1, '2024-02-09 16:15:36', '2024-04-14 16:50:12');

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
INSERT INTO `faqs` VALUES (3, 'Jam berapa check-in dan check-out?', '<p>Check-in jam 08:00.<br>Check-out jam 08:00 esok harinya</p>');
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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of inventory_stocks
-- ----------------------------
INSERT INTO `inventory_stocks` VALUES (1, 6, 39, 12, 6000, '2024-02-21 21:27:28');
INSERT INTO `inventory_stocks` VALUES (2, 3, 7, 3, 20000, '2024-03-16 11:59:09');
INSERT INTO `inventory_stocks` VALUES (3, 2, 4, 12, 12000, '2024-03-25 05:25:44');
INSERT INTO `inventory_stocks` VALUES (4, 5, 1, 6, 60000, '2024-03-25 05:27:06');
INSERT INTO `inventory_stocks` VALUES (5, 4, 12, 3, 90000, '2024-03-25 05:27:06');

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
) ENGINE = InnoDB AUTO_INCREMENT = 38 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `menu` VALUES (25, 'Role', '7', NULL, 1, 'icon-vcard', 'acl.usergroup.index');
INSERT INTO `menu` VALUES (26, 'User', '7', NULL, 2, 'icon-users2', 'acl.user.index');
INSERT INTO `menu` VALUES (31, 'Supplier', '3', NULL, 1, 'icon-store', 'inventory.supplier.index');
INSERT INTO `menu` VALUES (32, 'Penjualan Inventory', '5', NULL, 2, 'icon-printer', 'transaksi.cash-inventory.index');
INSERT INTO `menu` VALUES (34, 'Event Organizer', '2', NULL, 4, 'ph-address-book', 'wahana.eo.index');
INSERT INTO `menu` VALUES (35, 'Tiket', '9', NULL, 1, 'ph-textbox', 'tiket.data.index');
INSERT INTO `menu` VALUES (36, 'Penjualan Tiket', '9', NULL, 2, 'ph-ticket', 'tiket.sales.presale.index');
INSERT INTO `menu` VALUES (37, 'Laporan', '8', NULL, 1, 'ph-book', 'laporan');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 61 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `migrations` VALUES (44, '2024_03_01_192144_create_ticket_sales_table', 16);
INSERT INTO `migrations` VALUES (47, '2024_03_04_105655_create_ticket_directs_table', 17);
INSERT INTO `migrations` VALUES (48, '2024_01_27_092702_wahana', 18);
INSERT INTO `migrations` VALUES (49, '2024_03_06_160247_alter_wahana_image', 19);
INSERT INTO `migrations` VALUES (50, '2024_03_08_141415_add_column_all_tables', 20);
INSERT INTO `migrations` VALUES (51, '2024_03_16_215918_create_ticket_categories_table', 21);
INSERT INTO `migrations` VALUES (52, '2024_03_20_222920_create_ticket_direct_sales_table', 22);
INSERT INTO `migrations` VALUES (54, '2024_03_20_223220_create_ticket_direct_sales_details_table', 23);
INSERT INTO `migrations` VALUES (57, '2024_03_25_214354_create_reservation_extra_services_table', 24);
INSERT INTO `migrations` VALUES (58, '2024_03_25_214442_reservation_extrabill', 24);
INSERT INTO `migrations` VALUES (59, '2024_04_09_041649_create_configurations_table', 25);
INSERT INTO `migrations` VALUES (60, '2024_05_04_182257_create_reviews_table', 26);

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
  `pay_date` datetime(0) NULL DEFAULT NULL,
  `received_by` bigint(20) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 127 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `payments` VALUES (51, 'sales', 20, 'cash', 24000, 'paid', '2024-03-05 14:48:07', 1);
INSERT INTO `payments` VALUES (54, 'reservation', 1, 'cash', 1221000, 'paid', '2024-03-12 21:24:34', 1);
INSERT INTO `payments` VALUES (55, 'reservation', 2, 'cash', 580500, 'cancel', '2024-03-14 21:30:37', 1);
INSERT INTO `payments` VALUES (56, 'reservation', 3, 'midtrans', 1524000, 'paid', NULL, NULL);
INSERT INTO `payments` VALUES (57, 'reservation', 4, 'midtrans', 1554000, 'unpaid', NULL, NULL);
INSERT INTO `payments` VALUES (58, 'reservation', 5, 'midtrans', 854000, 'unpaid', NULL, NULL);
INSERT INTO `payments` VALUES (61, 'reservation', 8, 'midtrans', 1554000, 'unpaid', NULL, NULL);
INSERT INTO `payments` VALUES (62, 'reservation', 9, 'midtrans', 1554000, 'unpaid', NULL, NULL);
INSERT INTO `payments` VALUES (63, 'reservation', 10, 'midtrans', 854000, 'unpaid', NULL, NULL);
INSERT INTO `payments` VALUES (64, 'reservation', 11, 'midtrans', 854000, 'unpaid', NULL, NULL);
INSERT INTO `payments` VALUES (65, 'reservation', 12, 'cash', 200000, 'paid', '2024-03-16 11:52:39', 1);
INSERT INTO `payments` VALUES (66, 'reservation', 12, 'transfer', 1324000, 'paid', '2024-03-16 11:52:39', 1);
INSERT INTO `payments` VALUES (67, 'reservation', 13, 'midtrans', 721500, 'unpaid', NULL, NULL);
INSERT INTO `payments` VALUES (68, 'reservation', 14, 'midtrans', 1070000, 'unpaid', NULL, NULL);
INSERT INTO `payments` VALUES (74, 'reservation', 20, 'midtrans', 777000, 'unpaid', NULL, NULL);
INSERT INTO `payments` VALUES (75, 'reservation', 21, 'midtrans', 777000, 'unpaid', NULL, NULL);
INSERT INTO `payments` VALUES (76, 'reservation', 22, 'midtrans', 777000, 'pending', NULL, NULL);
INSERT INTO `payments` VALUES (77, 'reservation', 23, 'midtrans', 777000, 'pending', NULL, NULL);
INSERT INTO `payments` VALUES (78, 'reservation', 24, 'midtrans', 777000, 'pending', NULL, NULL);
INSERT INTO `payments` VALUES (79, 'reservation', 25, 'midtrans', 777000, 'pending', NULL, NULL);
INSERT INTO `payments` VALUES (98, 'reservation', 44, 'midtrans', 3052500, 'pending', NULL, NULL);
INSERT INTO `payments` VALUES (99, 'reservation', 45, 'midtrans', 1221000, 'pending', NULL, NULL);
INSERT INTO `payments` VALUES (100, 'reservation', 46, 'midtrans', 3885000, 'pending', NULL, NULL);
INSERT INTO `payments` VALUES (101, 'reservation', 47, 'midtrans', 3607500, 'pending', NULL, NULL);
INSERT INTO `payments` VALUES (102, 'reservation', 48, 'midtrans', 1221000, 'pending', NULL, NULL);
INSERT INTO `payments` VALUES (111, 'reservation', 57, 'midtrans', 1554000, 'pending', NULL, NULL);
INSERT INTO `payments` VALUES (112, 'reservation', 58, 'midtrans', 777000, 'pending', NULL, NULL);
INSERT INTO `payments` VALUES (113, 'reservation', 59, 'midtrans', 1443000, 'pending', NULL, NULL);
INSERT INTO `payments` VALUES (114, 'reservation', 60, 'cash', 610500, 'cancel', '2024-03-31 23:17:37', 1);
INSERT INTO `payments` VALUES (115, 'reservation', 83, 'cash', 300000, 'paid', '2024-05-29 14:45:45', 1);
INSERT INTO `payments` VALUES (116, 'reservation', 83, 'transfer', 310500, 'paid', '2024-05-29 14:45:45', 1);
INSERT INTO `payments` VALUES (125, 'reservation', 91, 'cash', 500000, 'paid', '2024-06-01 21:45:25', 1);
INSERT INTO `payments` VALUES (126, 'reservation', 91, 'transfer', 1331500, 'paid', '2024-06-01 21:45:25', 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 97 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `permissions` VALUES (96, 'report-list', 'web', '2024-02-06 13:59:09', '2024-02-06 13:59:09');

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
INSERT INTO `products` VALUES (3, 1, 'F6M0T4NB', 'Gas', 'loan', 1, 1, '2024-02-14 21:51:40', '2024-03-16 11:57:51');
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
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of purchase_details
-- ----------------------------
INSERT INTO `purchase_details` VALUES (1, 1, 5, 50, 30000, 1500000);
INSERT INTO `purchase_details` VALUES (2, 2, 6, 50, 1500, 75000);
INSERT INTO `purchase_details` VALUES (3, 3, 3, 4, 20000, 80000);
INSERT INTO `purchase_details` VALUES (4, 4, 2, 6, 10000, 60000);
INSERT INTO `purchase_details` VALUES (5, 5, 5, 6, 90000, 540000);
INSERT INTO `purchase_details` VALUES (6, 5, 4, 6, 130000, 780000);

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
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of purchases
-- ----------------------------
INSERT INTO `purchases` VALUES (1, '24020001', '2024-02-21 21:22:33', '1', 1500000, 11, 165000, 1665000, 'non stock', 1, 1, '2024-02-21 21:10:13', '2024-02-21 21:22:33');
INSERT INTO `purchases` VALUES (2, '24020001', '2024-02-21 21:27:28', '1', 75000, 11, 8250, 83250, 'stock', 1, NULL, '2024-02-21 21:27:28', '2024-02-21 21:27:28');
INSERT INTO `purchases` VALUES (3, '24030001', '2024-03-16 11:59:09', '1', 80000, NULL, NULL, 80000, 'stock', 1, NULL, '2024-03-16 11:59:09', '2024-03-16 11:59:09');
INSERT INTO `purchases` VALUES (4, '24030001', '2024-03-25 05:25:44', '1', 60000, NULL, NULL, 60000, 'stock', 1, NULL, '2024-03-25 05:25:44', '2024-03-25 05:25:44');
INSERT INTO `purchases` VALUES (5, '24030001', '2024-03-25 05:27:06', '1', 1320000, NULL, NULL, 1320000, 'stock', 1, NULL, '2024-03-25 05:27:06', '2024-03-25 05:27:06');

-- ----------------------------
-- Table structure for reservation_extra_services
-- ----------------------------
DROP TABLE IF EXISTS `reservation_extra_services`;
CREATE TABLE `reservation_extra_services`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `reservation_id` bigint(20) NOT NULL,
  `type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock_id` bigint(20) NULL DEFAULT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `rev_extra`(`reservation_id`, `type`, `stock_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reservation_extra_services
-- ----------------------------
INSERT INTO `reservation_extra_services` VALUES (19, 3, 'person', NULL, 50000, 2, 100000);
INSERT INTO `reservation_extra_services` VALUES (20, 3, 'item', 2, 20000, 2, 40000);
INSERT INTO `reservation_extra_services` VALUES (21, 3, 'item', 5, 90000, 2, 180000);
INSERT INTO `reservation_extra_services` VALUES (22, 3, 'item', 3, 12000, 1, 12000);
INSERT INTO `reservation_extra_services` VALUES (30, 87, 'person', NULL, 60000, 2, 120000);
INSERT INTO `reservation_extra_services` VALUES (31, 87, 'item', 1, 6000, 3, 18000);
INSERT INTO `reservation_extra_services` VALUES (32, 87, 'item', 2, 20000, 3, 60000);
INSERT INTO `reservation_extra_services` VALUES (33, 87, 'item', 4, 60000, 1, 60000);
INSERT INTO `reservation_extra_services` VALUES (34, 87, 'item', 5, 90000, 2, 180000);

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
  `reservation_status` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `payment_url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `payment_via` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `va_number` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `expiry_time` timestamp(0) NULL DEFAULT NULL,
  `cancel_reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `refund` int(11) NULL DEFAULT NULL,
  `refund_status` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `refund_date` datetime(0) NULL DEFAULT NULL,
  `eo_id` int(11) NULL DEFAULT NULL,
  `eo_commission` int(11) NULL DEFAULT NULL,
  `eo_commission_type` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `eo_total_commission` int(11) NULL DEFAULT NULL,
  `omzet` int(11) NOT NULL,
  `extra_bill` int(11) NULL DEFAULT NULL,
  `snap_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `rv_index`(`id`, `trans_num`, `trans_via`, `start_date`, `end_date`, `checkin_date`, `checkout_date`, `wahana_id`, `room_id`, `coupon_id`, `payment_status`, `eo_id`, `reservation_status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 93 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reservations
-- ----------------------------
INSERT INTO `reservations` VALUES (1, '2403BJ3M', 'onsite', '2024-03-14', '2024-03-16', 2, '2024-03-16 11:27:15', '2024-03-16 11:28:11', 1, 171, 'edam gundul', 'edamgundul@gmail.com', '0812391230', 2, 550000, 1100000, 11, 121000, 1221000, NULL, NULL, NULL, NULL, 'paid', 'selesai', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 'persentase', 122100, 1098900, NULL, NULL, '2024-03-12 21:24:34', '2024-03-16 11:28:11');
INSERT INTO `reservations` VALUES (2, '2403DTWN', 'onsite', '2024-03-29', '2024-03-30', 1, NULL, NULL, 1, 172, 'Hermansyah Handya Pranata', 'hersdyanataf@gmail.com', '+6287836415796', 2, 550000, 550000, 11, 60500, 580500, 2, 30000, 'nominal', 30000, 'cancel', 'cancel', NULL, NULL, NULL, NULL, 'pindah paket', NULL, NULL, NULL, NULL, NULL, NULL, 0, 580500, NULL, NULL, '2024-03-14 21:30:37', '2024-03-16 11:47:00');
INSERT INTO `reservations` VALUES (3, '2403ONTJ', 'online', '2024-03-28', '2024-03-30', 2, '2024-03-26 05:13:08', '2024-05-20 19:24:32', 2, 183, 'Hermansyah Handya Pranata', 'hersdyanataf@gmail.com', '0812391238', 1, 700000, 1400000, 11, 154000, 1524000, 2, 30000, 'nominal', 30000, 'paid', 'selesai', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1524000, 332000, NULL, '2024-03-14 22:17:36', '2024-05-20 19:24:32');
INSERT INTO `reservations` VALUES (4, '2403WEDP', 'online', '2024-03-28', '2024-03-30', 2, '2024-03-26 06:02:12', NULL, 2, 184, 'ekky pradipta', 'hersdyanataf@gmail.com', '234234234', 1, 700000, 1400000, 11, 154000, 1554000, NULL, NULL, NULL, NULL, 'unpaid', 'aktif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1554000, NULL, NULL, '2024-03-14 22:20:58', '2024-03-26 06:02:12');
INSERT INTO `reservations` VALUES (5, '2403ABIP', 'online', '2024-03-17', '2024-03-18', 1, NULL, NULL, 2, 184, 'dudeng', 'dudeng@gmail.com', '923482349', 1, 700000, 700000, 11, 154000, 854000, NULL, NULL, NULL, NULL, 'unpaid', 'aktif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 854000, NULL, NULL, '2024-03-14 22:26:22', '2024-03-14 22:26:22');
INSERT INTO `reservations` VALUES (8, '2403RO2W', 'online', '2024-04-16', '2024-04-18', 2, NULL, NULL, 2, 183, 'Hermansyah Handya Pranata', 'hersdyanataf@gmail.com', '234234234', 1, 700000, 1400000, 11, 154000, 1554000, NULL, NULL, NULL, NULL, 'unpaid', 'aktif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1554000, NULL, NULL, '2024-03-15 23:01:19', '2024-03-15 23:01:19');
INSERT INTO `reservations` VALUES (9, '2403L6UX', 'online', '2024-04-25', '2024-04-27', 2, NULL, NULL, 2, 183, 'Hermansyah Handya Pranata', 'hersdyanataf@gmail.com', '234234234', 1, 700000, 1400000, 11, 154000, 1554000, NULL, NULL, NULL, NULL, 'unpaid', 'aktif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1554000, NULL, NULL, '2024-03-15 23:03:51', '2024-03-15 23:03:51');
INSERT INTO `reservations` VALUES (10, '2403CEU8', 'online', '2024-05-28', '2024-05-29', 1, NULL, NULL, 2, 183, 'Hermansyah Handya Pranata', 'hersdyanataf@gmail.com', '234234234', 1, 700000, 700000, 11, 154000, 854000, NULL, NULL, NULL, NULL, 'unpaid', 'aktif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 854000, NULL, NULL, '2024-03-15 23:07:22', '2024-03-15 23:07:22');
INSERT INTO `reservations` VALUES (11, '2403DMCV', 'online', '2024-05-30', '2024-05-31', 1, NULL, NULL, 2, 183, 'Hermansyah Handya Pranata', 'hersdyanataf@gmail.com', '234234234', 1, 700000, 700000, 11, 154000, 854000, NULL, NULL, NULL, NULL, 'unpaid', 'aktif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 854000, NULL, NULL, '2024-03-15 23:09:06', '2024-03-15 23:09:06');
INSERT INTO `reservations` VALUES (12, '2403ILEN', 'onsite', '2024-03-26', '2024-03-28', 2, NULL, NULL, 2, 182, 'ekky pradipta', 'eqpradipta@gmail.com', '+6281221996446', 4, 700000, 1400000, 11, 154000, 1524000, 2, 30000, 'nominal', 30000, 'paid', 'aktif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 'persentase', 152400, 1371600, NULL, NULL, '2024-03-16 11:52:39', '2024-03-16 11:52:39');
INSERT INTO `reservations` VALUES (13, '2403ZU4E', 'online', '2024-04-16', '2024-04-17', 1, NULL, NULL, 3, 192, 'Kang idan', 'ridwanidansetiawan@gmail.com', '018230423482', 2, 650000, 650000, 11, 71500, 721500, NULL, NULL, NULL, NULL, 'unpaid', 'aktif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 721500, NULL, NULL, '2024-03-16 12:28:52', '2024-03-16 12:28:52');
INSERT INTO `reservations` VALUES (14, '2403TREY', 'online', '2024-03-26', '2024-03-28', 2, NULL, NULL, 1, 174, 'kang azhar', 'azharmuhamad12@gmail.com', '923482348', 2, 550000, 1100000, 11, 0, 1070000, 2, 30000, 'nominal', 30000, 'unpaid', 'aktif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1070000, NULL, NULL, '2024-03-16 12:31:53', '2024-03-16 12:31:53');
INSERT INTO `reservations` VALUES (20, '2403QNF9', 'online', '2024-04-29', '2024-04-30', 1, NULL, NULL, 2, 183, 'Hermansyah Handya Pranata', 'hersdyanata@indouniversalspices.com', '34234234234234', 1, 700000, 700000, 11, 77000, 777000, NULL, NULL, NULL, NULL, 'unpaid', 'aktif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 777000, NULL, '18784bc9-9615-4a5f-9e4e-d9299f8cdd8f', '2024-03-26 19:44:14', '2024-03-26 19:44:15');
INSERT INTO `reservations` VALUES (21, '2403BSXI', 'online', '2024-04-29', '2024-04-30', 1, NULL, NULL, 2, 182, 'Hermansyah Handya Pranata', 'hersdyanataf@gmail.com', '234234', 1, 700000, 700000, 11, 77000, 777000, NULL, NULL, NULL, NULL, 'unpaid', 'aktif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 777000, NULL, '3b767f82-d3c1-42a4-84cc-0e455b7103f8', '2024-03-26 19:50:34', '2024-03-26 19:50:35');
INSERT INTO `reservations` VALUES (22, '2403GQCS', 'online', '2024-04-29', '2024-04-30', 1, NULL, NULL, 2, 189, 'Hermansyah Handya Pranata', 'hersdyanataf@gmail.com', '234234', 1, 700000, 700000, 11, 77000, 777000, NULL, NULL, NULL, NULL, 'pending', 'aktif', 'https://app.sandbox.midtrans.com/snap/v3/redirection/7c3a6967-f96c-468d-9210-6e298fbc9b2e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 777000, NULL, NULL, '2024-03-26 20:49:27', '2024-03-26 20:49:29');
INSERT INTO `reservations` VALUES (23, '2403CG3J', 'online', '2024-04-29', '2024-04-30', 1, NULL, NULL, 2, 189, 'Hermansyah Handya Pranata', 'hersdyanataf@gmail.com', '234234', 1, 700000, 700000, 11, 77000, 777000, NULL, NULL, NULL, NULL, 'capture', 'aktif', 'https://app.sandbox.midtrans.com/snap/v3/redirection/09b626f2-006d-4eed-b46b-1f055c2050ab', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 777000, NULL, NULL, '2024-03-26 20:49:40', '2024-03-26 21:51:23');
INSERT INTO `reservations` VALUES (24, '24039UKX', 'online', '2024-04-29', '2024-04-30', 1, NULL, NULL, 2, 181, 'Hermansyah Handya Pranata', 'hersdyanataf@gmail.com', '234234', 1, 700000, 700000, 11, 77000, 777000, NULL, NULL, NULL, NULL, 'capture', 'aktif', 'https://app.sandbox.midtrans.com/snap/v3/redirection/f728cdaf-f53f-4db7-b071-59f3bf736d7c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 777000, NULL, NULL, '2024-03-26 20:54:29', '2024-03-26 21:51:42');
INSERT INTO `reservations` VALUES (25, '2403BNIZ', 'online', '2024-04-29', '2024-04-30', 1, NULL, NULL, 2, 184, 'Hermansyah Handya Pranata', 'hersdyanataf@gmail.com', '234234', 1, 700000, 700000, 11, 77000, 777000, NULL, NULL, NULL, NULL, 'capture', 'aktif', 'https://app.sandbox.midtrans.com/snap/v3/redirection/d5eaacdc-fb55-4bfa-9ed9-f12fdc7686c3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 777000, NULL, NULL, '2024-03-26 20:55:39', '2024-03-26 21:52:25');
INSERT INTO `reservations` VALUES (44, '24035GJR', 'online', '2024-03-28', '2024-04-02', 5, NULL, NULL, 1, 173, 'Hermansyah Handya Pranata', 'hersdyanataf@gmail.com', '123123', 1, 550000, 2750000, 11, 302500, 3052500, NULL, NULL, NULL, NULL, 'paid', 'aktif', 'https://app.sandbox.midtrans.com/snap/v3/redirection/198dbab7-2079-4e35-8e9c-74cce04fc568', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3052500, NULL, NULL, '2024-03-26 22:41:25', '2024-03-27 19:40:20');
INSERT INTO `reservations` VALUES (45, '2403PG3F', 'online', '2024-03-28', '2024-03-30', 2, NULL, NULL, 1, 171, 'Hermansyah Handya Pranata', 'hersdyanataf@gmail.com', '8098098', 1, 550000, 1100000, 11, 121000, 1221000, NULL, NULL, NULL, NULL, 'paid', 'aktif', 'https://app.sandbox.midtrans.com/snap/v3/redirection/8b136664-f35a-4a10-a31f-c6dc9a39b013', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1221000, NULL, NULL, '2024-03-26 23:01:06', '2024-03-27 19:37:44');
INSERT INTO `reservations` VALUES (46, '2403DOVM', 'online', '2024-03-29', '2024-04-03', 5, NULL, NULL, 2, 190, 'ekky pradipta', 'hersdyanataf@gmail.com', '234', 1, 700000, 3500000, 11, 385000, 3885000, NULL, NULL, NULL, NULL, 'cancel', 'cancel', 'https://app.sandbox.midtrans.com/snap/v4/redirection/5f90a709-6dd7-4434-9b43-23c03598741d', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3885000, NULL, NULL, '2024-03-27 19:08:03', '2024-03-27 19:25:19');
INSERT INTO `reservations` VALUES (47, '24039ME2', 'online', '2024-03-27', '2024-04-01', 5, NULL, NULL, 3, 200, 'ekky pradipta', 'hersdyanataf@gmail.com', '234', 1, 650000, 3250000, 11, 357500, 3607500, NULL, NULL, NULL, NULL, 'ditinjau', 'aktif', 'https://app.sandbox.midtrans.com/snap/v4/redirection/e87234f9-846c-46c0-a254-dbace50ef00e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3607500, NULL, NULL, '2024-03-27 19:28:09', '2024-03-27 19:43:10');
INSERT INTO `reservations` VALUES (48, '2403WRNB', 'online', '2024-03-29', '2024-03-31', 2, NULL, NULL, 1, 174, 'ekky pradipta', 'hersdyanataf@gmail.com', '234', 1, 550000, 1100000, 11, 121000, 1221000, NULL, NULL, NULL, NULL, 'ditinjau', 'aktif', 'https://app.sandbox.midtrans.com/snap/v4/redirection/0c77c2d8-463d-45a9-9553-a78fafa8dfe2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1221000, NULL, NULL, '2024-03-27 22:29:59', '2024-03-27 22:31:27');
INSERT INTO `reservations` VALUES (57, '2403YFVO', 'online', '2024-04-23', '2024-04-25', 2, NULL, NULL, 2, 182, 'ekky pradipta', 'hersdyanataf@gmail.com', '34343', 1, 700000, 1400000, 11, 154000, 1554000, NULL, NULL, NULL, NULL, 'pending', 'aktif', 'https://app.sandbox.midtrans.com/snap/v4/redirection/a56fafa7-4a0a-47aa-aecb-d36f2a7a7d85', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1554000, NULL, NULL, '2024-03-27 22:54:23', '2024-03-27 22:54:28');
INSERT INTO `reservations` VALUES (58, '2403N6AP', 'online', '2024-04-23', '2024-04-24', 1, NULL, NULL, 2, 188, 'dadang konelo', 'hersdyanataf@gmail.com', '34343', 1, 700000, 700000, 11, 77000, 777000, NULL, NULL, NULL, NULL, 'pending', 'aktif', 'https://app.sandbox.midtrans.com/snap/v4/redirection/b9b14fa7-abd0-4c16-aafb-6207b7f2f332', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 777000, NULL, NULL, '2024-03-27 23:06:49', '2024-03-31 22:23:47');
INSERT INTO `reservations` VALUES (59, '2403XQ6U', 'online', '2024-04-15', '2024-04-17', 2, NULL, NULL, 3, 193, 'ekky pradipta', 'hersdyanataf@gmail.com', '23424', 1, 650000, 1300000, 11, 143000, 1443000, NULL, NULL, NULL, NULL, 'ditinjau', 'aktif', 'https://app.sandbox.midtrans.com/snap/v4/redirection/bf950529-8ba9-47ee-a996-66a23ab73ec0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1443000, NULL, NULL, '2024-03-29 21:11:18', '2024-03-29 21:17:31');
INSERT INTO `reservations` VALUES (60, '2403LXQ8', 'onsite', '2024-04-12', '2024-04-13', 1, NULL, NULL, 1, 172, 'Hermansyah Handya Pranata', 'apocalypsix@gmail.com', '+6281313092581', 2, 550000, 550000, 11, 60500, 610500, NULL, NULL, NULL, NULL, 'paid', 'cancel', NULL, NULL, NULL, NULL, 'tes', NULL, NULL, NULL, NULL, NULL, NULL, 0, 610500, NULL, NULL, '2024-03-31 23:17:37', '2024-03-31 23:38:14');
INSERT INTO `reservations` VALUES (67, '2404LD6C', 'online', '2024-04-12', '2024-04-13', 1, '2024-04-14 17:28:10', NULL, 1, 171, 'ilkay can', 'hersdyanataf@gmail.com', '123', 1, 550000, 550000, 11, 60500, 610500, NULL, NULL, NULL, NULL, 'paid', 'aktif', 'https://app.sandbox.midtrans.com/snap/v4/redirection/907e4ba5-81cf-40fd-82b3-40ca6769d054', 'bca', '21695656502', '2024-04-05 22:06:58', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 610500, NULL, NULL, '2024-04-04 21:59:38', '2024-04-14 17:28:10');
INSERT INTO `reservations` VALUES (74, '2404CEOR', 'online', '2024-04-19', '2024-04-20', 1, NULL, NULL, 3, 193, 'dadang konelo', 'hersdyanataf@gmail.com', '12123123', 1, 650000, 650000, 11, 71500, 721500, NULL, NULL, NULL, NULL, 'paid', 'aktif', 'https://app.sandbox.midtrans.com/snap/v4/redirection/30947c37-300a-466b-8cd6-23854f398d71', 'permata', '2160002848363908', '2024-04-05 23:11:56', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 721500, NULL, NULL, '2024-04-04 23:02:44', '2024-04-04 23:15:20');
INSERT INTO `reservations` VALUES (75, '2404D6SI', 'online', '2024-04-18', '2024-04-19', 1, NULL, NULL, 1, 172, 'dadang konelo', 'hersdyanataf@gmail.com', '12123123', 1, 550000, 550000, 11, 60500, 610500, NULL, NULL, NULL, NULL, 'paid', 'aktif', 'https://app.sandbox.midtrans.com/snap/v4/redirection/5915656e-1022-4322-9ed0-ddc77fb1e379', 'permata', '2160063057349922', '2024-04-05 23:19:17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 610500, NULL, NULL, '2024-04-04 23:18:14', '2024-04-04 23:19:20');
INSERT INTO `reservations` VALUES (76, '2404ALAT', 'online', '2024-04-16', '2024-04-17', 1, NULL, NULL, 2, 181, 'dadang konelo', 'hersdyanataf@gmail.com', '12123123', 1, 700000, 700000, 11, 77000, 777000, NULL, NULL, NULL, NULL, 'paid', 'aktif', 'https://app.sandbox.midtrans.com/snap/v4/redirection/ae81aca6-68e6-4563-9ac0-36eaaf3d689a', 'bni', '9882169550983239', '2024-04-05 23:22:40', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 777000, NULL, NULL, '2024-04-04 23:21:58', '2024-04-04 23:23:12');
INSERT INTO `reservations` VALUES (78, '2404O0PB', 'online', '2024-04-21', '2024-04-22', 1, NULL, NULL, 2, 181, 'roni gin', 'hersdyanataf@gmail.com', '123123', 1, 700000, 700000, 11, 77000, 777000, NULL, NULL, NULL, NULL, 'paid', 'aktif', 'https://app.sandbox.midtrans.com/snap/v4/redirection/7d40cc4b-1f3b-4224-b2b4-1355da484799', 'mandiri', '645494653948', '2024-04-06 20:22:51', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 777000, NULL, NULL, '2024-04-05 20:21:58', '2024-04-05 20:29:09');
INSERT INTO `reservations` VALUES (79, '2404XEUH', 'online', '2024-04-28', '2024-04-29', 1, NULL, NULL, 1, 171, 'roni gin', 'hersdyanataf@gmail.com', '123123', 1, 550000, 550000, 11, 60500, 580500, 2, 30000, 'nominal', 30000, 'paid', 'cancel', 'https://app.sandbox.midtrans.com/snap/v4/redirection/0a1a4797-73cc-4b6b-9eba-1fc36adca930', 'bri', '216957076147166308', '2024-04-06 20:31:10', 'gak jadi', 406350, 'selesai', '2024-06-01 22:05:02', NULL, NULL, NULL, NULL, 174150, NULL, NULL, '2024-04-05 20:30:41', '2024-06-01 22:05:02');
INSERT INTO `reservations` VALUES (80, '24041ZFI', 'online', '2024-04-23', '2024-04-24', 1, NULL, NULL, 2, 181, 'roni gin', 'hersdyanataf@gmail.com', '123123', 1, 700000, 700000, 11, 77000, 747000, 2, 30000, 'nominal', 30000, 'paid', 'cancel', 'https://app.sandbox.midtrans.com/snap/v4/redirection/5ea94ea4-2503-4afb-a389-22138010d392', 'bca', '21695731480', '2024-04-06 22:21:35', 'pindah jadwal', 522900, 'selesai', '2024-06-01 22:01:14', NULL, NULL, NULL, NULL, 224100, NULL, NULL, '2024-04-05 22:20:59', '2024-06-01 22:01:14');
INSERT INTO `reservations` VALUES (81, '24042QFP', 'online', '2024-04-17', '2024-04-18', 1, NULL, NULL, 1, 173, 'Hermansyah Handya Pranata', 'hersdyanataf@gmail.com', '123123', 1, 550000, 550000, 11, 60500, 610500, NULL, NULL, NULL, NULL, 'pending', 'aktif', 'https://app.sandbox.midtrans.com/snap/v4/redirection/80a7ee79-7122-40f3-bdce-4acb75bdd636', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 610500, NULL, NULL, '2024-04-05 22:26:50', '2024-04-05 22:26:51');
INSERT INTO `reservations` VALUES (82, '2405Q1UC', 'online', '2024-05-31', '2024-06-01', 1, NULL, NULL, 2, 182, 'jojon surojon', 'hersdyanataf@gmail.com', '123123', 1, 700000, 700000, 11, 77000, 777000, NULL, NULL, NULL, NULL, 'paid', 'aktif', 'https://app.sandbox.midtrans.com/snap/v4/redirection/ebaa735a-4688-4d51-9dd4-04ab462c1164', 'bca', '21695156244', '2024-05-25 14:41:25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 777000, NULL, NULL, '2024-05-24 14:39:13', '2024-05-24 14:41:39');
INSERT INTO `reservations` VALUES (83, '2405D8EB', 'onsite', '2024-06-07', '2024-06-08', 1, NULL, NULL, 1, 171, 'Hermansyah Handya Pranata', 'apocalypsix@gmail.com', '081313092581', 3, 550000, 550000, 11, 60500, 610500, NULL, NULL, NULL, NULL, 'paid', 'aktif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 'persentase', 61050, 549450, NULL, NULL, '2024-05-29 14:45:45', '2024-05-29 14:45:45');
INSERT INTO `reservations` VALUES (86, '2405386P', 'online', '2024-05-31', '2024-06-01', 1, NULL, NULL, 2, 183, 'ekky pradipta', 'hersdyanataf@gmail.com', '081313092581', 1, 700000, 700000, 11, 77000, 777000, NULL, NULL, NULL, NULL, 'pending', 'aktif', 'https://app.sandbox.midtrans.com/snap/v4/redirection/b6cfa762-80cc-4ee3-9a8a-dfec46282b1b', 'bca', '21695421192', '2024-05-30 14:52:01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 777000, NULL, NULL, '2024-05-29 14:51:12', '2024-05-29 14:52:02');
INSERT INTO `reservations` VALUES (87, '2405AMSD', 'online', '2024-06-10', '2024-06-11', 1, '2024-05-30 21:21:15', NULL, 2, 182, 'dadang suradang', 'hersdyanataf@gmail.com', '923482348', 2, 700000, 700000, 11, 77000, 777000, NULL, NULL, NULL, NULL, 'paid', 'aktif', 'https://app.sandbox.midtrans.com/snap/v4/redirection/fc3828df-62ac-4aed-8dbd-7348f09cde4b', 'bca', '21695851071', '2024-05-30 14:56:53', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 777000, 438000, NULL, '2024-05-29 14:56:25', '2024-05-30 21:21:15');
INSERT INTO `reservations` VALUES (91, '2405QTZK', 'onsite', '2024-06-04', '2024-06-07', 3, '2024-05-30 22:11:27', NULL, 1, 173, 'nana', 'nana@gmail.com', '2323402348', 3, 550000, 1650000, 11, 181500, 1831500, NULL, NULL, NULL, NULL, 'paid', 'aktif', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 10, 'persentase', 183150, 1648350, NULL, NULL, '2024-05-30 22:11:27', '2024-06-01 21:45:25');
INSERT INTO `reservations` VALUES (92, '2406U4IH', 'online', '2024-07-07', '2024-07-08', 1, NULL, NULL, 2, 183, 'test doang', 'hersdyanataf@gmail.com', '234234234', 2, 700000, 700000, 11, 77000, 777000, NULL, NULL, NULL, NULL, 'paid', 'aktif', 'https://app.sandbox.midtrans.com/snap/v4/redirection/ba0ccc01-3e3d-40db-8dd9-39f2edaf4f24', 'bca', '21695383012', '2024-06-03 22:34:34', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 777000, NULL, NULL, '2024-06-02 22:33:27', '2024-06-02 22:39:51');

-- ----------------------------
-- Table structure for reviews
-- ----------------------------
DROP TABLE IF EXISTS `reviews`;
CREATE TABLE `reviews`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `wahana_id` bigint(20) NOT NULL,
  `reservation_id` bigint(20) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `star` int(11) NOT NULL,
  `testimonial` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of reviews
-- ----------------------------
INSERT INTO `reviews` VALUES (1, 1, 1, 'edam gundul', 4, 'tempatnya keren banget! gak nyesel', '2024-05-20 19:00:14', '2024-05-20 19:00:14');
INSERT INTO `reviews` VALUES (2, 2, 3, 'Hermansyah Handya Pranata', 5, 'Cucok tempatnya! Gak nyesel kemah 1 minggu disini!', '2024-05-20 19:25:06', '2024-05-20 19:25:06');

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
INSERT INTO `role_has_permissions` VALUES (58, 1);
INSERT INTO `role_has_permissions` VALUES (59, 1);
INSERT INTO `role_has_permissions` VALUES (60, 1);
INSERT INTO `role_has_permissions` VALUES (61, 1);
INSERT INTO `role_has_permissions` VALUES (62, 1);
INSERT INTO `role_has_permissions` VALUES (63, 1);
INSERT INTO `role_has_permissions` VALUES (64, 1);
INSERT INTO `role_has_permissions` VALUES (65, 1);
INSERT INTO `role_has_permissions` VALUES (66, 1);
INSERT INTO `role_has_permissions` VALUES (67, 1);
INSERT INTO `role_has_permissions` VALUES (68, 1);
INSERT INTO `role_has_permissions` VALUES (69, 1);
INSERT INTO `role_has_permissions` VALUES (70, 1);
INSERT INTO `role_has_permissions` VALUES (71, 1);
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
INSERT INTO `role_has_permissions` VALUES (92, 5);
INSERT INTO `role_has_permissions` VALUES (93, 1);
INSERT INTO `role_has_permissions` VALUES (93, 5);
INSERT INTO `role_has_permissions` VALUES (94, 1);
INSERT INTO `role_has_permissions` VALUES (95, 1);
INSERT INTO `role_has_permissions` VALUES (96, 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `sales` VALUES (20, 'S24030001', '2024-03-05 14:48:07', 11, 660, 23340, 24000, 'paid', 1, NULL, '2024-03-05 14:48:07', '2024-03-05 14:48:07');

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
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `sales_details` VALUES (26, 20, 1, 6, 4, 6000, 24000);

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
-- Table structure for ticket_categories
-- ----------------------------
DROP TABLE IF EXISTS `ticket_categories`;
CREATE TABLE `ticket_categories`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ticket_categories
-- ----------------------------
INSERT INTO `ticket_categories` VALUES (1, 'Kunjungan', '2024-03-16 22:02:11', '2024-03-17 19:52:36');
INSERT INTO `ticket_categories` VALUES (2, 'Parkir', '2024-03-16 22:02:20', '2024-03-17 19:53:32');
INSERT INTO `ticket_categories` VALUES (9, 'Kunjungan Wisata', '2024-03-22 21:52:53', '2024-03-22 21:52:53');
INSERT INTO `ticket_categories` VALUES (10, 'Tiket Camping', '2024-05-29 15:09:52', '2024-05-29 15:09:52');

-- ----------------------------
-- Table structure for ticket_direct
-- ----------------------------
DROP TABLE IF EXISTS `ticket_direct`;
CREATE TABLE `ticket_direct`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `ticket_directs_category_price_index`(`category`, `price`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ticket_direct
-- ----------------------------
INSERT INTO `ticket_direct` VALUES (3, 1, 35000, 1, NULL, '2024-03-17 21:29:42', '2024-03-17 21:29:42');
INSERT INTO `ticket_direct` VALUES (4, 2, 2000, 1, NULL, '2024-03-17 21:29:58', '2024-03-17 21:29:58');
INSERT INTO `ticket_direct` VALUES (5, 9, 15000, 1, NULL, '2024-03-22 21:53:46', '2024-03-22 21:53:46');
INSERT INTO `ticket_direct` VALUES (6, 10, 60000, 1, NULL, '2024-05-29 15:10:11', '2024-05-29 15:10:11');

-- ----------------------------
-- Table structure for ticket_direct_sales
-- ----------------------------
DROP TABLE IF EXISTS `ticket_direct_sales`;
CREATE TABLE `ticket_direct_sales`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `trans_num` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `trans_date` datetime(0) NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `ticket_direct_sales_parent_idx`(`trans_num`, `trans_date`, `name`, `created_at`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ticket_direct_sales
-- ----------------------------
INSERT INTO `ticket_direct_sales` VALUES (3, '240322XMOS', '2024-03-22 22:50:28', NULL, 2000, 1, NULL, '2024-03-22 22:50:28', '2024-03-22 22:50:28');
INSERT INTO `ticket_direct_sales` VALUES (5, '240322MRNC', '2024-03-22 22:50:55', NULL, 2000, 1, NULL, '2024-03-22 22:50:55', '2024-03-22 22:50:55');
INSERT INTO `ticket_direct_sales` VALUES (6, '240322CTRZ', '2024-03-22 22:53:05', NULL, 15000, 1, NULL, '2024-03-22 22:53:05', '2024-03-22 22:53:05');
INSERT INTO `ticket_direct_sales` VALUES (7, '240322VBIC', '2024-03-22 22:53:09', NULL, 2000, 1, NULL, '2024-03-22 22:53:09', '2024-03-22 22:53:09');
INSERT INTO `ticket_direct_sales` VALUES (8, '240322NAHP', '2024-03-22 22:53:12', NULL, 35000, 1, NULL, '2024-03-22 22:53:12', '2024-03-22 22:53:12');
INSERT INTO `ticket_direct_sales` VALUES (9, '240322BFTH', '2024-03-22 22:53:18', NULL, 52000, 1, NULL, '2024-03-22 22:53:18', '2024-03-22 22:53:18');
INSERT INTO `ticket_direct_sales` VALUES (10, '240322DASJ', '2024-03-22 22:53:32', NULL, 6000, 1, NULL, '2024-03-22 22:53:32', '2024-03-22 22:53:32');
INSERT INTO `ticket_direct_sales` VALUES (11, '240322KOWT', '2024-03-22 22:54:05', NULL, 10000, 1, NULL, '2024-03-22 22:54:05', '2024-03-22 22:54:05');
INSERT INTO `ticket_direct_sales` VALUES (12, '240322ULXF', '2024-03-22 22:54:10', NULL, 75000, 1, NULL, '2024-03-22 22:54:10', '2024-03-22 22:54:10');
INSERT INTO `ticket_direct_sales` VALUES (13, '240322XCUB', '2024-03-22 22:54:15', NULL, 4000, 1, NULL, '2024-03-22 22:54:15', '2024-03-22 22:54:15');
INSERT INTO `ticket_direct_sales` VALUES (14, '240322RAGL', '2024-03-22 22:54:42', NULL, 2000, 1, NULL, '2024-03-22 22:54:42', '2024-03-22 22:54:42');
INSERT INTO `ticket_direct_sales` VALUES (15, '240322LEGW', '2024-03-22 22:56:37', NULL, 35000, 1, NULL, '2024-03-22 22:56:37', '2024-03-22 22:56:37');
INSERT INTO `ticket_direct_sales` VALUES (16, '240322PAVS', '2024-03-22 22:56:47', NULL, 2000, 1, NULL, '2024-03-22 22:56:47', '2024-03-22 22:56:47');
INSERT INTO `ticket_direct_sales` VALUES (17, '240416WURA', '2024-04-16 20:08:34', NULL, 35000, 1107, NULL, '2024-04-16 20:08:34', '2024-04-16 20:08:34');
INSERT INTO `ticket_direct_sales` VALUES (18, '240416TCFE', '2024-04-16 20:08:55', NULL, 74000, 1107, NULL, '2024-04-16 20:08:55', '2024-04-16 20:08:55');
INSERT INTO `ticket_direct_sales` VALUES (19, '240529CHWT', '2024-05-29 15:15:11', NULL, 428000, 1, NULL, '2024-05-29 15:15:11', '2024-05-29 15:15:11');

-- ----------------------------
-- Table structure for ticket_direct_sales_details
-- ----------------------------
DROP TABLE IF EXISTS `ticket_direct_sales_details`;
CREATE TABLE `ticket_direct_sales_details`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `trans_id` bigint(20) NOT NULL,
  `ticket_id` bigint(20) NULL DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `ticket_direct_sales_idx`(`trans_id`, `ticket_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ticket_direct_sales_details
-- ----------------------------
INSERT INTO `ticket_direct_sales_details` VALUES (1, 3, 4, 1, 2000, 2000);
INSERT INTO `ticket_direct_sales_details` VALUES (2, 5, 4, 1, 2000, 2000);
INSERT INTO `ticket_direct_sales_details` VALUES (3, 6, 5, 1, 15000, 15000);
INSERT INTO `ticket_direct_sales_details` VALUES (4, 7, 4, 1, 2000, 2000);
INSERT INTO `ticket_direct_sales_details` VALUES (5, 8, 3, 1, 35000, 35000);
INSERT INTO `ticket_direct_sales_details` VALUES (6, 9, 3, 1, 35000, 35000);
INSERT INTO `ticket_direct_sales_details` VALUES (7, 9, 4, 1, 2000, 2000);
INSERT INTO `ticket_direct_sales_details` VALUES (8, 9, 5, 1, 15000, 15000);
INSERT INTO `ticket_direct_sales_details` VALUES (9, 10, 4, 3, 2000, 6000);
INSERT INTO `ticket_direct_sales_details` VALUES (10, 11, 4, 5, 2000, 10000);
INSERT INTO `ticket_direct_sales_details` VALUES (11, 12, 5, 5, 15000, 75000);
INSERT INTO `ticket_direct_sales_details` VALUES (12, 13, 4, 2, 2000, 4000);
INSERT INTO `ticket_direct_sales_details` VALUES (13, 14, 4, 1, 2000, 2000);
INSERT INTO `ticket_direct_sales_details` VALUES (14, 15, 3, 1, 35000, 35000);
INSERT INTO `ticket_direct_sales_details` VALUES (15, 16, 4, 1, 2000, 2000);
INSERT INTO `ticket_direct_sales_details` VALUES (16, 17, 3, 1, 35000, 35000);
INSERT INTO `ticket_direct_sales_details` VALUES (17, 18, 3, 2, 35000, 70000);
INSERT INTO `ticket_direct_sales_details` VALUES (18, 18, 4, 2, 2000, 4000);
INSERT INTO `ticket_direct_sales_details` VALUES (19, 19, 3, 3, 35000, 105000);
INSERT INTO `ticket_direct_sales_details` VALUES (20, 19, 4, 4, 2000, 8000);
INSERT INTO `ticket_direct_sales_details` VALUES (21, 19, 5, 5, 15000, 75000);
INSERT INTO `ticket_direct_sales_details` VALUES (22, 19, 6, 4, 60000, 240000);

-- ----------------------------
-- Table structure for ticket_presale
-- ----------------------------
DROP TABLE IF EXISTS `ticket_presale`;
CREATE TABLE `ticket_presale`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `code` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `status` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `created_by` bigint(20) NULL DEFAULT NULL,
  `updated_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `tickets_index`(`id`, `code`, `description`, `category_id`, `status`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ticket_presale
-- ----------------------------
INSERT INTO `ticket_presale` VALUES (1, '240318QA', 'test 1', 5, 1, 'selesai', 100000, 1, 1, '2024-03-18 07:53:41', '2024-03-18 12:26:41');
INSERT INTO `ticket_presale` VALUES (2, '240322LC', 'testtt', 20, 1, 'selesai', 50000, 1, 1, '2024-03-22 21:30:03', '2024-03-22 21:30:42');
INSERT INTO `ticket_presale` VALUES (3, '2405298L', 'tiket konser a7x', 20, 1, 'selesai', 15000, 1, 1, '2024-05-29 15:11:29', '2024-05-29 15:13:06');
INSERT INTO `ticket_presale` VALUES (4, '240602AU', 'tiket konser DT', 4, 1, 'aktif', 250000, 1, NULL, '2024-06-02 19:14:41', '2024-06-02 19:14:41');

-- ----------------------------
-- Table structure for ticket_sales
-- ----------------------------
DROP TABLE IF EXISTS `ticket_sales`;
CREATE TABLE `ticket_sales`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `trans_type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` bigint(20) NULL DEFAULT NULL,
  `serial_number` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `sold_date` datetime(0) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `ticket_sales_idx`(`trans_type`, `reference_id`, `serial_number`, `category_id`, `sold_date`, `created_by`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 96 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ticket_sales
-- ----------------------------
INSERT INTO `ticket_sales` VALUES (55, 'presale', 1, 'GMHL', 1, 100000, '2024-03-18 12:26:41', 1);
INSERT INTO `ticket_sales` VALUES (56, 'presale', 1, 'PAJK', 1, 100000, '2024-03-18 12:26:41', 1);
INSERT INTO `ticket_sales` VALUES (57, 'presale', 1, 'MXZO', 1, 100000, '2024-03-18 12:26:41', 1);
INSERT INTO `ticket_sales` VALUES (58, 'presale', 1, 'BVVW', 1, 100000, '2024-03-18 12:26:41', 1);
INSERT INTO `ticket_sales` VALUES (59, 'presale', 2, 'WGLZ', 1, 50000, '2024-03-22 21:30:42', 1);
INSERT INTO `ticket_sales` VALUES (60, 'presale', 2, 'TNOJ', 1, 50000, '2024-03-22 21:30:42', 1);
INSERT INTO `ticket_sales` VALUES (61, 'presale', 2, 'ULYA', 1, 50000, '2024-03-22 21:30:42', 1);
INSERT INTO `ticket_sales` VALUES (62, 'presale', 2, 'WXXS', 1, 50000, '2024-03-22 21:30:42', 1);
INSERT INTO `ticket_sales` VALUES (63, 'presale', 2, 'HSTQ', 1, 50000, '2024-03-22 21:30:42', 1);
INSERT INTO `ticket_sales` VALUES (64, 'presale', 2, 'GEEM', 1, 50000, '2024-03-22 21:30:42', 1);
INSERT INTO `ticket_sales` VALUES (65, 'presale', 2, 'HDPD', 1, 50000, '2024-03-22 21:30:42', 1);
INSERT INTO `ticket_sales` VALUES (66, 'presale', 2, 'RNHV', 1, 50000, '2024-03-22 21:30:42', 1);
INSERT INTO `ticket_sales` VALUES (67, 'presale', 2, 'TTDM', 1, 50000, '2024-03-22 21:30:42', 1);
INSERT INTO `ticket_sales` VALUES (68, 'presale', 2, 'XHSY', 1, 50000, '2024-03-22 21:30:42', 1);
INSERT INTO `ticket_sales` VALUES (69, 'presale', 2, 'AJTP', 1, 50000, '2024-03-22 21:30:42', 1);
INSERT INTO `ticket_sales` VALUES (70, 'presale', 2, 'EIWG', 1, 50000, '2024-03-22 21:30:42', 1);
INSERT INTO `ticket_sales` VALUES (71, 'presale', 2, 'DLQT', 1, 50000, '2024-03-22 21:30:42', 1);
INSERT INTO `ticket_sales` VALUES (72, 'presale', 2, 'OVFC', 1, 50000, '2024-03-22 21:30:42', 1);
INSERT INTO `ticket_sales` VALUES (73, 'presale', 2, 'NKRQ', 1, 50000, '2024-03-22 21:30:42', 1);
INSERT INTO `ticket_sales` VALUES (74, 'presale', 2, 'AZMQ', 1, 50000, '2024-03-22 21:30:42', 1);
INSERT INTO `ticket_sales` VALUES (75, 'presale', 2, 'UUXA', 1, 50000, '2024-03-22 21:30:42', 1);
INSERT INTO `ticket_sales` VALUES (76, 'presale', 2, 'JWNH', 1, 50000, '2024-03-22 21:30:42', 1);
INSERT INTO `ticket_sales` VALUES (77, 'presale', 3, 'BBNR', 1, 15000, '2024-05-29 15:13:05', 1);
INSERT INTO `ticket_sales` VALUES (78, 'presale', 3, 'CAQX', 1, 15000, '2024-05-29 15:13:05', 1);
INSERT INTO `ticket_sales` VALUES (79, 'presale', 3, 'DADK', 1, 15000, '2024-05-29 15:13:05', 1);
INSERT INTO `ticket_sales` VALUES (80, 'presale', 3, 'EPBG', 1, 15000, '2024-05-29 15:13:05', 1);
INSERT INTO `ticket_sales` VALUES (81, 'presale', 3, 'ETVW', 1, 15000, '2024-05-29 15:13:05', 1);
INSERT INTO `ticket_sales` VALUES (82, 'presale', 3, 'HYVM', 1, 15000, '2024-05-29 15:13:05', 1);
INSERT INTO `ticket_sales` VALUES (83, 'presale', 3, 'IUFO', 1, 15000, '2024-05-29 15:13:05', 1);
INSERT INTO `ticket_sales` VALUES (84, 'presale', 3, 'KJQY', 1, 15000, '2024-05-29 15:13:05', 1);
INSERT INTO `ticket_sales` VALUES (85, 'presale', 3, 'KLZS', 1, 15000, '2024-05-29 15:13:05', 1);
INSERT INTO `ticket_sales` VALUES (86, 'presale', 3, 'KZXE', 1, 15000, '2024-05-29 15:13:05', 1);
INSERT INTO `ticket_sales` VALUES (87, 'presale', 3, 'PFMM', 1, 15000, '2024-05-29 15:13:05', 1);
INSERT INTO `ticket_sales` VALUES (88, 'presale', 3, 'PRLN', 1, 15000, '2024-05-29 15:13:05', 1);
INSERT INTO `ticket_sales` VALUES (89, 'presale', 3, 'RFOD', 1, 15000, '2024-05-29 15:13:05', 1);
INSERT INTO `ticket_sales` VALUES (90, 'presale', 3, 'SFMF', 1, 15000, '2024-05-29 15:13:05', 1);
INSERT INTO `ticket_sales` VALUES (91, 'presale', 3, 'SGAO', 1, 15000, '2024-05-29 15:13:05', 1);
INSERT INTO `ticket_sales` VALUES (92, 'presale', 3, 'SKJD', 1, 15000, '2024-05-29 15:13:05', 1);
INSERT INTO `ticket_sales` VALUES (93, 'presale', 3, 'THEB', 1, 15000, '2024-05-29 15:13:05', 1);
INSERT INTO `ticket_sales` VALUES (94, 'presale', 3, 'WFTH', 1, 15000, '2024-05-29 15:13:05', 1);
INSERT INTO `ticket_sales` VALUES (95, 'presale', 3, 'ZFMO', 1, 15000, '2024-05-29 15:13:05', 1);

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
  `print_date` datetime(0) NULL DEFAULT NULL,
  INDEX `serial_index`(`ticket_id`, `serial_number`, `status`, `sold_date`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of ticket_serials
-- ----------------------------
INSERT INTO `ticket_serials` VALUES (1, 'OHBZ', 100000, 'expired', NULL, NULL);
INSERT INTO `ticket_serials` VALUES (1, 'GMHL', 100000, 'sold', '2024-03-18 12:26:41', NULL);
INSERT INTO `ticket_serials` VALUES (1, 'PAJK', 100000, 'sold', '2024-03-18 12:26:41', NULL);
INSERT INTO `ticket_serials` VALUES (1, 'MXZO', 100000, 'sold', '2024-03-18 12:26:41', NULL);
INSERT INTO `ticket_serials` VALUES (1, 'BVVW', 100000, 'sold', '2024-03-18 12:26:41', NULL);
INSERT INTO `ticket_serials` VALUES (2, 'MAAG', 50000, 'expired', NULL, NULL);
INSERT INTO `ticket_serials` VALUES (2, 'FYSC', 50000, 'expired', NULL, NULL);
INSERT INTO `ticket_serials` VALUES (2, 'WGLZ', 50000, 'sold', '2024-03-22 21:30:42', NULL);
INSERT INTO `ticket_serials` VALUES (2, 'TNOJ', 50000, 'sold', '2024-03-22 21:30:42', NULL);
INSERT INTO `ticket_serials` VALUES (2, 'ULYA', 50000, 'sold', '2024-03-22 21:30:42', NULL);
INSERT INTO `ticket_serials` VALUES (2, 'WXXS', 50000, 'sold', '2024-03-22 21:30:42', NULL);
INSERT INTO `ticket_serials` VALUES (2, 'HSTQ', 50000, 'sold', '2024-03-22 21:30:42', NULL);
INSERT INTO `ticket_serials` VALUES (2, 'GEEM', 50000, 'sold', '2024-03-22 21:30:42', NULL);
INSERT INTO `ticket_serials` VALUES (2, 'HDPD', 50000, 'sold', '2024-03-22 21:30:42', NULL);
INSERT INTO `ticket_serials` VALUES (2, 'RNHV', 50000, 'sold', '2024-03-22 21:30:42', NULL);
INSERT INTO `ticket_serials` VALUES (2, 'TTDM', 50000, 'sold', '2024-03-22 21:30:42', NULL);
INSERT INTO `ticket_serials` VALUES (2, 'XHSY', 50000, 'sold', '2024-03-22 21:30:42', NULL);
INSERT INTO `ticket_serials` VALUES (2, 'AJTP', 50000, 'sold', '2024-03-22 21:30:42', NULL);
INSERT INTO `ticket_serials` VALUES (2, 'EIWG', 50000, 'sold', '2024-03-22 21:30:42', NULL);
INSERT INTO `ticket_serials` VALUES (2, 'DLQT', 50000, 'sold', '2024-03-22 21:30:42', NULL);
INSERT INTO `ticket_serials` VALUES (2, 'OVFC', 50000, 'sold', '2024-03-22 21:30:42', NULL);
INSERT INTO `ticket_serials` VALUES (2, 'NKRQ', 50000, 'sold', '2024-03-22 21:30:42', NULL);
INSERT INTO `ticket_serials` VALUES (2, 'AZMQ', 50000, 'sold', '2024-03-22 21:30:42', NULL);
INSERT INTO `ticket_serials` VALUES (2, 'UUXA', 50000, 'sold', '2024-03-22 21:30:42', NULL);
INSERT INTO `ticket_serials` VALUES (2, 'JWNH', 50000, 'sold', '2024-03-22 21:30:42', NULL);
INSERT INTO `ticket_serials` VALUES (3, 'EPBG', 15000, 'sold', '2024-05-29 15:13:05', NULL);
INSERT INTO `ticket_serials` VALUES (3, 'KJQY', 15000, 'sold', '2024-05-29 15:13:05', NULL);
INSERT INTO `ticket_serials` VALUES (3, 'BBNR', 15000, 'sold', '2024-05-29 15:13:05', NULL);
INSERT INTO `ticket_serials` VALUES (3, 'SKJD', 15000, 'sold', '2024-05-29 15:13:05', NULL);
INSERT INTO `ticket_serials` VALUES (3, 'KLZS', 15000, 'sold', '2024-05-29 15:13:05', NULL);
INSERT INTO `ticket_serials` VALUES (3, 'HYVM', 15000, 'sold', '2024-05-29 15:13:05', NULL);
INSERT INTO `ticket_serials` VALUES (3, 'ETVW', 15000, 'sold', '2024-05-29 15:13:05', NULL);
INSERT INTO `ticket_serials` VALUES (3, 'CAQX', 15000, 'sold', '2024-05-29 15:13:05', NULL);
INSERT INTO `ticket_serials` VALUES (3, 'PFMM', 15000, 'sold', '2024-05-29 15:13:05', NULL);
INSERT INTO `ticket_serials` VALUES (3, 'THEB', 15000, 'sold', '2024-05-29 15:13:05', NULL);
INSERT INTO `ticket_serials` VALUES (3, 'WFTH', 15000, 'sold', '2024-05-29 15:13:05', NULL);
INSERT INTO `ticket_serials` VALUES (3, 'DADK', 15000, 'sold', '2024-05-29 15:13:05', NULL);
INSERT INTO `ticket_serials` VALUES (3, 'PRLN', 15000, 'sold', '2024-05-29 15:13:05', NULL);
INSERT INTO `ticket_serials` VALUES (3, 'SGAO', 15000, 'sold', '2024-05-29 15:13:05', NULL);
INSERT INTO `ticket_serials` VALUES (3, 'IUFO', 15000, 'sold', '2024-05-29 15:13:05', NULL);
INSERT INTO `ticket_serials` VALUES (3, 'ZFMO', 15000, 'sold', '2024-05-29 15:13:05', NULL);
INSERT INTO `ticket_serials` VALUES (3, 'KZXE', 15000, 'sold', '2024-05-29 15:13:05', NULL);
INSERT INTO `ticket_serials` VALUES (3, 'RFOD', 15000, 'sold', '2024-05-29 15:13:05', NULL);
INSERT INTO `ticket_serials` VALUES (3, 'SFMF', 15000, 'sold', '2024-05-29 15:13:05', NULL);
INSERT INTO `ticket_serials` VALUES (3, 'CRQM', 15000, 'expired', NULL, NULL);
INSERT INTO `ticket_serials` VALUES (4, 'EUMM', 250000, 'aktif', NULL, NULL);
INSERT INTO `ticket_serials` VALUES (4, 'FPHP', 250000, 'aktif', NULL, NULL);
INSERT INTO `ticket_serials` VALUES (4, 'HTDG', 250000, 'aktif', NULL, NULL);
INSERT INTO `ticket_serials` VALUES (4, 'HAKG', 250000, 'aktif', NULL, NULL);

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
INSERT INTO `users` VALUES (1107, 'Oday suroday', 'oday@gmail.com', NULL, '$2y$12$kR.ksPBM99y5qrsgSJMtKeCPyfUXtR7N63LBGd82rf4JIUxmlrLnS', NULL, '2024-02-06 18:23:51', '2024-02-06 18:23:51');

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
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `keywords` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wahana
-- ----------------------------
INSERT INTO `wahana` VALUES (1, 'MEDIUM CAMPING', '<p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.&nbsp;</p>', 4, '5', 50, 'Y', 'CM', 550000, 'medium-camping', 1, 1, '2024-03-06 15:46:02', '2024-05-29 14:35:15', 'CAMPING,CAMPING SERU');
INSERT INTO `wahana` VALUES (2, 'CAMPING PRIVATE', '<p>Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet.&nbsp;</p>', 4, '5', 10, 'N', 'CP', 700000, 'camping-private', 1, 1, '2024-03-06 15:48:18', '2024-03-06 15:49:17', '');
INSERT INTO `wahana` VALUES (3, 'SUNRISE CAMPING', '<p>Nikmati pagi yang menakjubkan dengan terbitnya matahari di Taman Langit Pangalengan, sambil menikmati udara segar dan keindahan alam yang menakjubkan. Dengan Sunrise Camping Deck, pengalaman berkemah Anda akan menjadi lebih nyaman, seru dan mengesankan</p>', 4, '5', 10, 'Y', 'SC', 650000, 'sunrise-camping', 1, 1, '2024-03-06 15:51:51', '2024-03-06 15:52:06', '');

-- ----------------------------
-- Table structure for wahana_facilities
-- ----------------------------
DROP TABLE IF EXISTS `wahana_facilities`;
CREATE TABLE `wahana_facilities`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `wahana_id` bigint(20) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 35 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wahana_facilities
-- ----------------------------
INSERT INTO `wahana_facilities` VALUES (22, 1, 'Tenda');
INSERT INTO `wahana_facilities` VALUES (23, 1, 'Api Unggun');
INSERT INTO `wahana_facilities` VALUES (24, 1, 'Listrik');
INSERT INTO `wahana_facilities` VALUES (25, 1, 'Penerangan');
INSERT INTO `wahana_facilities` VALUES (26, 2, 'Tenda');
INSERT INTO `wahana_facilities` VALUES (27, 2, 'Api Unggun');
INSERT INTO `wahana_facilities` VALUES (28, 2, 'Listrik');
INSERT INTO `wahana_facilities` VALUES (29, 3, 'Tenda');
INSERT INTO `wahana_facilities` VALUES (30, 3, 'Api Unggun');
INSERT INTO `wahana_facilities` VALUES (31, 3, 'Listrik');
INSERT INTO `wahana_facilities` VALUES (32, 3, 'Wifi');
INSERT INTO `wahana_facilities` VALUES (33, 3, 'Sarapan');
INSERT INTO `wahana_facilities` VALUES (34, 3, 'Makan Malam');

-- ----------------------------
-- Table structure for wahana_images
-- ----------------------------
DROP TABLE IF EXISTS `wahana_images`;
CREATE TABLE `wahana_images`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `wahana_id` bigint(20) NOT NULL,
  `image_path` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_map` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 29 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wahana_images
-- ----------------------------
INSERT INTO `wahana_images` VALUES (17, 1, 'assets/images/wahana/20240306_4172.jpg', 'Y');
INSERT INTO `wahana_images` VALUES (18, 1, 'assets/images/wahana/20240306_0001317.jpg', NULL);
INSERT INTO `wahana_images` VALUES (19, 1, 'assets/images/wahana/20240306_1777.jpg', NULL);
INSERT INTO `wahana_images` VALUES (20, 2, 'assets/images/wahana/20240306_RE4wtcl.jpg', 'Y');
INSERT INTO `wahana_images` VALUES (21, 2, 'assets/images/wahana/20240306_The_Coast.jpg', NULL);
INSERT INTO `wahana_images` VALUES (22, 2, 'assets/images/wahana/20240306_The_Forbidden_City_by_Daniel_Mathis.jpg', NULL);
INSERT INTO `wahana_images` VALUES (26, 3, 'assets/images/wahana/20240306_hillside-2560x1440.jpg', NULL);
INSERT INTO `wahana_images` VALUES (27, 3, 'assets/images/wahana/20240306_photo-1464983953574-0892a716854b.webp', 'Y');
INSERT INTO `wahana_images` VALUES (28, 3, 'assets/images/wahana/20240306_Free-Irish-Wallpaper-Download.jpg', NULL);

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
) ENGINE = InnoDB AUTO_INCREMENT = 241 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of wahana_rooms
-- ----------------------------
INSERT INTO `wahana_rooms` VALUES (171, 1, 'CM_1', 'A', '2024-04-14 17:28:10');
INSERT INTO `wahana_rooms` VALUES (172, 1, 'CM_2', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (173, 1, 'CM_3', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (174, 1, 'CM_4', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (175, 1, 'CM_5', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (176, 1, 'CM_6', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (177, 1, 'CM_7', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (178, 1, 'CM_8', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (179, 1, 'CM_9', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (180, 1, 'CM_10', 'NA', NULL);
INSERT INTO `wahana_rooms` VALUES (181, 2, 'CP_1', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (182, 2, 'CP_2', 'RV', '2024-05-30 21:21:15');
INSERT INTO `wahana_rooms` VALUES (183, 2, 'CP_3', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (184, 2, 'CP_4', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (185, 2, 'CP_5', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (186, 2, 'CP_6', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (187, 2, 'CP_7', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (188, 2, 'CP_8', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (189, 2, 'CP_9', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (190, 2, 'CP_10', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (191, 3, 'SC_1', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (192, 3, 'SC_2', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (193, 3, 'SC_3', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (194, 3, 'SC_4', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (195, 3, 'SC_5', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (196, 3, 'SC_6', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (197, 3, 'SC_7', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (198, 3, 'SC_8', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (199, 3, 'SC_9', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (200, 3, 'SC_10', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (201, 1, 'CM_11', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (202, 1, 'CM_12', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (203, 1, 'CM_13', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (204, 1, 'CM_14', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (205, 1, 'CM_15', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (206, 1, 'CM_16', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (207, 1, 'CM_17', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (208, 1, 'CM_18', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (209, 1, 'CM_19', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (210, 1, 'CM_20', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (211, 1, 'CM_21', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (212, 1, 'CM_22', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (213, 1, 'CM_23', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (214, 1, 'CM_24', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (215, 1, 'CM_25', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (216, 1, 'CM_26', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (217, 1, 'CM_27', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (218, 1, 'CM_28', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (219, 1, 'CM_29', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (220, 1, 'CM_30', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (221, 1, 'CM_31', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (222, 1, 'CM_32', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (223, 1, 'CM_33', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (224, 1, 'CM_34', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (225, 1, 'CM_35', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (226, 1, 'CM_36', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (227, 1, 'CM_37', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (228, 1, 'CM_38', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (229, 1, 'CM_39', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (230, 1, 'CM_40', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (231, 1, 'CM_41', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (232, 1, 'CM_42', 'NA', NULL);
INSERT INTO `wahana_rooms` VALUES (233, 1, 'CM_43', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (234, 1, 'CM_44', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (235, 1, 'CM_45', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (236, 1, 'CM_46', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (237, 1, 'CM_47', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (238, 1, 'CM_48', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (239, 1, 'CM_49', 'A', NULL);
INSERT INTO `wahana_rooms` VALUES (240, 1, 'CM_50', 'A', NULL);

-- ----------------------------
-- View structure for reserved_dates
-- ----------------------------
DROP VIEW IF EXISTS `reserved_dates`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `reserved_dates` AS with recursive daterange as (
  select trans_num, start_date as date, end_date, wahana_id, room_id, night_count
    from reservations
   where reservation_status = 'aktif'
   union all
  select trans_num, date_add(date, interval 1 day) as date, end_date, wahana_id, room_id, night_count
    from daterange
   where date_add(date, interval 1 day) < end_date
)
select trans_num, date, wahana_id, room_id, night_count
  from daterange
 order by date desc ;

SET FOREIGN_KEY_CHECKS = 1;
