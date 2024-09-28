/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50726 (5.7.26)
 Source Host           : 127.0.0.1:3306
 Source Schema         : layui-admin

 Target Server Type    : MySQL
 Target Server Version : 50726 (5.7.26)
 File Encoding         : 65001

 Date: 28/09/2024 17:54:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for xfl_admin_auths
-- ----------------------------
DROP TABLE IF EXISTS `xfl_admin_auths`;
CREATE TABLE `xfl_admin_auths`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '规则名',
  `title` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '规则标题',
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '类型(1:菜单,2:按钮)',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态(-1:禁用,1:启用)',
  `pid` int(11) NOT NULL DEFAULT 0 COMMENT '父级',
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '图标',
  `sort` smallint(5) NOT NULL DEFAULT 0 COMMENT '排序(越小越前)',
  `created` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `updated` int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  `deleted` int(11) NULL DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uniq_name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '后台权限表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xfl_admin_auths
-- ----------------------------
INSERT INTO `xfl_admin_auths` VALUES (1, '#总后台', '总后台', 1, 1, 0, 'layui-icon layui-icon-component', 0, 1689660985, 1689660985, NULL);
INSERT INTO `xfl_admin_auths` VALUES (2, '#系统管理', '系统管理', 1, 1, 1, 'layui-icon layui-icon-set', 99, 1689660985, 1689660985, NULL);
INSERT INTO `xfl_admin_auths` VALUES (3, '#用户管理', '用户管理', 1, 1, 2, 'layui-icon layui-icon-user', 0, 1689660985, 1689660985, NULL);
INSERT INTO `xfl_admin_auths` VALUES (4, '#角色管理', '角色管理', 1, 1, 2, 'layui-icon layui-icon-username', 0, 1689660985, 1689660985, NULL);
INSERT INTO `xfl_admin_auths` VALUES (5, '#权限管理', '权限管理', 1, 1, 2, 'layui-icon layui-icon-auz', 0, 1689660985, 1689660985, NULL);
INSERT INTO `xfl_admin_auths` VALUES (6, '/admin/user/list', '用户列表', 1, 1, 3, 'layui-icon layui-icon-group', 0, 1689660985, 1689660985, NULL);
INSERT INTO `xfl_admin_auths` VALUES (7, '/admin/role/list', '角色列表', 1, 1, 4, 'layui-icon layui-icon-friends', 0, 1689660985, 1689660985, NULL);
INSERT INTO `xfl_admin_auths` VALUES (8, '/admin/auth/list', '权限列表', 1, 1, 5, 'layui-icon layui-icon-vercode', 0, 1689660985, 1689660985, NULL);
INSERT INTO `xfl_admin_auths` VALUES (9, '/admin/user/save/*', '添加或修改用户', 2, 1, 3, '', 0, 1689911782, 1689911782, NULL);
INSERT INTO `xfl_admin_auths` VALUES (10, '/admin/user/delete', '删除用户', 2, 1, 3, '', 0, 1689911901, 1689911901, NULL);
INSERT INTO `xfl_admin_auths` VALUES (11, '/admin/user/set_role/*', '分配角色', 2, 1, 3, '', 0, 1689911954, 1689911954, NULL);
INSERT INTO `xfl_admin_auths` VALUES (12, '/admin/role/save/*', '添加或修改角色', 2, 1, 4, '', 0, 1689918296, 1689918296, NULL);
INSERT INTO `xfl_admin_auths` VALUES (13, '/admin/role/delete', '删除角色', 2, 1, 4, '', 0, 1689918318, 1689918318, NULL);
INSERT INTO `xfl_admin_auths` VALUES (14, '/admin/auth/save/*', '添加或修改权限', 2, 1, 5, '', 0, 1689918353, 1689918353, NULL);
INSERT INTO `xfl_admin_auths` VALUES (15, '/admin/auth/delete', '删除权限', 2, 1, 5, '', 0, 1689918376, 1689918376, NULL);
INSERT INTO `xfl_admin_auths` VALUES (16, '/admin/welcome', '欢迎页', 2, 1, 1, '', -98, 1689918625, 1689918625, NULL);
INSERT INTO `xfl_admin_auths` VALUES (17, '/admin/logout', '退出', 2, 1, 3, '', 0, 1689918663, 1689918663, NULL);
INSERT INTO `xfl_admin_auths` VALUES (18, 'admin', '后台首页', 2, 1, 1, '', -99, 1689993187, 1727368473, NULL);
INSERT INTO `xfl_admin_auths` VALUES (19, '#系统配置', '系统配置', 1, 1, 2, 'layui-icon  layui-icon-set-fill', 0, 1727407347, 1727407347, NULL);
INSERT INTO `xfl_admin_auths` VALUES (20, '#字典管理', '字典管理', 1, 1, 2, 'layui-icon  layui-icon-app', 0, 1727407494, 1727407494, NULL);
INSERT INTO `xfl_admin_auths` VALUES (21, '/admin/config/website', '网站设置', 1, 1, 19, 'layui-icon layui-icon-website', 0, 1727407741, 1727407741, NULL);
INSERT INTO `xfl_admin_auths` VALUES (22, '/admin/dict/list', '字典列表', 1, 1, 20, 'layui-icon layui-icon-template-1', 0, 1727407766, 1727407766, NULL);

-- ----------------------------
-- Table structure for xfl_admin_role_assocs
-- ----------------------------
DROP TABLE IF EXISTS `xfl_admin_role_assocs`;
CREATE TABLE `xfl_admin_role_assocs`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `admin_id` int(11) NOT NULL DEFAULT 0 COMMENT '用户ID',
  `role_id` int(11) NOT NULL DEFAULT 0 COMMENT '角色ID',
  `created` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `updated` int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  `deleted` int(11) NULL DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uniq_role_admin`(`role_id`, `admin_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '后台用户角色关联表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xfl_admin_role_assocs
-- ----------------------------
INSERT INTO `xfl_admin_role_assocs` VALUES (1, 1, 1, 1689660985, 1689660985, NULL);

-- ----------------------------
-- Table structure for xfl_admin_roles
-- ----------------------------
DROP TABLE IF EXISTS `xfl_admin_roles`;
CREATE TABLE `xfl_admin_roles`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '角色名',
  `auth_ids` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '权限ID(逗号分割)',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态(-1:禁用,1:启用)',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `created` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `updated` int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  `deleted` int(11) NULL DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '后台用户角色表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xfl_admin_roles
-- ----------------------------
INSERT INTO `xfl_admin_roles` VALUES (1, '管理员', '1,18,16,2,3,6,9,10,11,17,4,7,12,13,5,8,14,15,19,21,20,22', 1, '系统角色请勿删除', 1689660985, 1727450655, 0);

-- ----------------------------
-- Table structure for xfl_admins
-- ----------------------------
DROP TABLE IF EXISTS `xfl_admins`;
CREATE TABLE `xfl_admins`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `account` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '账号',
  `nick_name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '昵称',
  `real_name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '真实姓名',
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '头像',
  `sex` tinyint(1) NOT NULL DEFAULT 0 COMMENT '性别(0:未知,1:男,2:女)',
  `salt` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '加密盐',
  `password` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '密码(md5(md5(salt) . password))',
  `phone` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '手机号',
  `tel` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '座机',
  `email` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '邮箱',
  `weixin` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '微信',
  `last_login_ip` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '最后登录IP',
  `last_login_time` int(11) NOT NULL DEFAULT 0 COMMENT '最后登录时间',
  `is_super` tinyint(1) NOT NULL DEFAULT -1 COMMENT '超级管理员(-1:否,1:是)',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态(-1:禁用,1:启用)',
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '地址',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '备注',
  `created` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `updated` int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  `deleted` int(11) NULL DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uniq_account`(`account`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '后台用户表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xfl_admins
-- ----------------------------
INSERT INTO `xfl_admins` VALUES (1, 'admin', 'admin', 'admin', '', 0, 'daISFX', 'aafed593a0134edae0adbe8a1e4d79b5', '1', '1', '1', '1', '127.0.0.1', 1727512002, 1, 1, '1', '1', 1689660985, 1727512002, NULL);

-- ----------------------------
-- Table structure for xfl_configs
-- ----------------------------
DROP TABLE IF EXISTS `xfl_configs`;
CREATE TABLE `xfl_configs`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '中文名',
  `key` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '键',
  `sub_key` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '子键',
  `value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT '内容',
  `pid` int(11) NOT NULL DEFAULT 0 COMMENT '父级',
  `sort` smallint(5) NOT NULL DEFAULT 0 COMMENT '排序(越小越前)',
  `created` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `updated` int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  `deleted` int(11) NOT NULL DEFAULT 0 COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uniq_key_sub`(`key`, `sub_key`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '配置表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xfl_configs
-- ----------------------------
INSERT INTO `xfl_configs` VALUES (1, '', 'website', 'admin_title', NULL, 0, 0, 1727432927, 1727450051, 0);
INSERT INTO `xfl_configs` VALUES (2, '', 'website', 'admin_keywords', NULL, 0, 0, 1727432927, 1727450051, 0);
INSERT INTO `xfl_configs` VALUES (3, '', 'website', 'admin_description', NULL, 0, 0, 1727432927, 1727450051, 0);
INSERT INTO `xfl_configs` VALUES (4, '', 'website', 'admin_ico', NULL, 0, 0, 1727432927, 1727450051, 0);
INSERT INTO `xfl_configs` VALUES (5, '', 'website', 'admin_logo', NULL, 0, 0, 1727432927, 1727450051, 0);
INSERT INTO `xfl_configs` VALUES (6, '', 'website', 'admin_login_banner', NULL, 0, 0, 1727432927, 1727450051, 0);
INSERT INTO `xfl_configs` VALUES (7, '', 'website', 'beian', NULL, 0, 0, 1727433496, 1727450126, 0);
INSERT INTO `xfl_configs` VALUES (8, '', 'website', 'beian_url', NULL, 0, 0, 1727433496, 1727450126, 0);
INSERT INTO `xfl_configs` VALUES (9, '', 'website', 'admin_service_agreement', NULL, 0, 0, 1727440095, 1727450124, 0);
INSERT INTO `xfl_configs` VALUES (10, '', 'website', 'admin_privacy_agreement', NULL, 0, 0, 1727440095, 1727450124, 0);
INSERT INTO `xfl_configs` VALUES (11, '', 'website', 'admin_index_title', NULL, 0, 0, 1727448447, 1727450051, 0);
INSERT INTO `xfl_configs` VALUES (12, '', 'website', 'admin_login_title', NULL, 0, 0, 1727450051, 1727450051, 0);
INSERT INTO `xfl_configs` VALUES (13, '', 'website', 'admin_footer', NULL, 0, 0, 1727450051, 1727450051, 0);

-- ----------------------------
-- Table structure for xfl_dicts
-- ----------------------------
DROP TABLE IF EXISTS `xfl_dicts`;
CREATE TABLE `xfl_dicts`  (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '中文名',
  `code` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '编码',
  `type` tinyint(1) NOT NULL DEFAULT 1 COMMENT '类型(1:原始内容,2:json)',
  `value` varchar(3000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '内容',
  `pid` int(11) NOT NULL DEFAULT 0 COMMENT '父级',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '状态(-1:禁用,1:启用)',
  `sort` smallint(5) NOT NULL DEFAULT 0 COMMENT '排序(越小越前)',
  `created` int(11) NOT NULL DEFAULT 0 COMMENT '创建时间',
  `updated` int(11) NOT NULL DEFAULT 0 COMMENT '更新时间',
  `deleted` int(11) NULL DEFAULT NULL COMMENT '删除时间',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uniq_code`(`code`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = '数据字典' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of xfl_dicts
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
