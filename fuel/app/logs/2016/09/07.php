<?php defined('COREPATH') or exit('No direct script access allowed'); ?>

ERROR - 2016-09-07 06:45:39 --> Error - Class 'Task' not found in /Applications/MAMP/htdocs/hg/fuel/app/classes/controller/servers.php on line 40
ERROR - 2016-09-07 06:47:17 --> Error - syntax error, unexpected ')', expecting function (T_FUNCTION) in /Applications/MAMP/htdocs/hg/fuel/app/classes/model/servers.php on line 7
ERROR - 2016-09-07 06:47:26 --> Error - Class 'Task' not found in /Applications/MAMP/htdocs/hg/fuel/app/classes/controller/servers.php on line 40
ERROR - 2016-09-07 06:57:15 --> Notice - Undefined index: type in /Applications/MAMP/htdocs/hg/fuel/app/classes/model/task.php on line 53
ERROR - 2016-09-07 06:57:31 --> Notice - Undefined variable: Report in /Applications/MAMP/htdocs/hg/fuel/app/classes/model/task.php on line 55
ERROR - 2016-09-07 07:03:29 --> Notice - Undefined index: op in /Applications/MAMP/htdocs/hg/fuel/app/views/conversations/conversations.php on line 6
ERROR - 2016-09-07 07:24:34 --> Error - Class 'Task' not found in /Applications/MAMP/htdocs/hg/fuel/app/classes/controller/knowledge.php on line 26
ERROR - 2016-09-07 07:24:42 --> Error - The requested view could not be found: knowledge/knowledge_learning.php in /Applications/MAMP/htdocs/hg/fuel/core/classes/view.php on line 440
ERROR - 2016-09-07 07:29:55 --> Notice - Undefined variable: k_id in /Applications/MAMP/htdocs/hg/fuel/app/classes/model/task.php on line 60
ERROR - 2016-09-07 07:50:56 --> Notice - Undefined index: raning_points in /Applications/MAMP/htdocs/hg/fuel/app/views/group/group.php on line 7
ERROR - 2016-09-07 11:46:22 --> Error - syntax error, unexpected 'array' (T_ARRAY), expecting ')' in /Applications/MAMP/htdocs/hg/fuel/app/classes/controller/shop.php on line 16
ERROR - 2016-09-07 11:54:04 --> Error - Class 'Model\DB' not found in /Applications/MAMP/htdocs/hg/fuel/app/classes/model/task.php on line 56
ERROR - 2016-09-07 13:29:07 --> Error - Class 'Model\DB' not found in /Applications/MAMP/htdocs/hg/fuel/app/classes/model/servers.php on line 59
ERROR - 2016-09-07 13:29:22 --> Notice - Undefined index: id in /Applications/MAMP/htdocs/hg/fuel/app/views/servers/server.php on line 41
ERROR - 2016-09-07 13:37:42 --> Notice - Undefined index: plants in /Applications/MAMP/htdocs/hg/fuel/app/classes/controller/servers.php on line 44
ERROR - 2016-09-07 13:40:27 --> Notice - Undefined index: server_app_id in /Applications/MAMP/htdocs/hg/fuel/app/classes/model/servers.php on line 47
ERROR - 2016-09-07 13:43:47 --> Error - Call to undefined method Fuel\Core\DB::where() in /Applications/MAMP/htdocs/hg/fuel/app/classes/model/servers.php on line 60
ERROR - 2016-09-07 13:44:10 --> Notice - Undefined index: server_app_id in /Applications/MAMP/htdocs/hg/fuel/app/classes/model/servers.php on line 47
ERROR - 2016-09-07 14:10:11 --> Error - Could not find asset: bootstrap.css in /Applications/MAMP/htdocs/hg/fuel/core/classes/asset/instance.php on line 413
ERROR - 2016-09-07 14:11:04 --> Error - Could not find asset: bootstrap.css in /Applications/MAMP/htdocs/hg/fuel/core/classes/asset/instance.php on line 413
ERROR - 2016-09-07 14:11:44 --> Notice - Undefined index: name in /Applications/MAMP/htdocs/hg/fuel/app/views/cardinal/cardinal_quest.php on line 6
ERROR - 2016-09-07 14:17:16 --> Error - The requested view could not be found: cardina/cardinal_quest_menu.php in /Applications/MAMP/htdocs/hg/fuel/core/classes/view.php on line 440
ERROR - 2016-09-07 15:02:58 --> Notice - Undefined variable: side_o in /Applications/MAMP/htdocs/hg/fuel/app/views/cardinal/quest/cardinal_quest_objectives.php on line 18
ERROR - 2016-09-07 15:26:34 --> 23000 - SQLSTATE[23000]: Integrity constraint violation: 1052 Column 'quest_id' in where clause is ambiguous with query: "SELECT `qss`.*, `qs`.`hostname` FROM `quest_server_service` AS `qss` JOIN `quest_server` AS `qs` ON (`qs`.`server_id` = `qss`.`server_id`) WHERE `quest_id` = '1'" in /Applications/MAMP/htdocs/hg/fuel/core/classes/database/pdo/connection.php on line 253
ERROR - 2016-09-07 15:26:57 --> 1054 - SQLSTATE[42S22]: Column not found: 1054 Unknown column 'qs.server_id' in 'on clause' with query: "SELECT `qss`.*, `qs`.`hostname` FROM `quest_server_service` AS `qss` JOIN `quest_server` AS `qs` ON (`qs`.`server_id` = `qss`.`server_id`) WHERE `qss`.`quest_id` = '1'" in /Applications/MAMP/htdocs/hg/fuel/core/classes/database/pdo/connection.php on line 253
ERROR - 2016-09-07 15:27:27 --> Notice - Undefined offset: 0 in /Applications/MAMP/htdocs/hg/fuel/app/views/cardinal/quest/cardinal_quest_objectives.php on line 31
ERROR - 2016-09-07 15:40:20 --> 1051 - SQLSTATE[42S02]: Base table or view not found: 1051 Unknown table 'qse' with query: "SELECT `qse`.*, `qs`.`hostname`, `qss`.`port` FROM `quest_service_entity` JOIN `quest_server_service` AS `qss` ON (`qs`.`service_id` = `qse`.`service_id`) JOIN `quest_server` AS `qs` ON (`qs`.`quest_server_id` = `qss`.`quest_server_id`) WHERE `quest_id` = '1'" in /Applications/MAMP/htdocs/hg/fuel/core/classes/database/pdo/connection.php on line 253
ERROR - 2016-09-07 15:40:34 --> 23000 - SQLSTATE[23000]: Integrity constraint violation: 1052 Column 'quest_id' in where clause is ambiguous with query: "SELECT `qse`.*, `qs`.`hostname`, `qss`.`port` FROM `quest_service_entity` AS `qse` JOIN `quest_server_service` AS `qss` ON (`qs`.`service_id` = `qse`.`service_id`) JOIN `quest_server` AS `qs` ON (`qs`.`quest_server_id` = `qss`.`quest_server_id`) WHERE `quest_id` = '1'" in /Applications/MAMP/htdocs/hg/fuel/core/classes/database/pdo/connection.php on line 253
ERROR - 2016-09-07 15:40:49 --> 1054 - SQLSTATE[42S22]: Column not found: 1054 Unknown column 'qs.service_id' in 'on clause' with query: "SELECT `qse`.*, `qs`.`hostname`, `qss`.`port` FROM `quest_service_entity` AS `qse` JOIN `quest_server_service` AS `qss` ON (`qs`.`service_id` = `qse`.`service_id`) JOIN `quest_server` AS `qs` ON (`qs`.`quest_server_id` = `qss`.`quest_server_id`) WHERE `qse`.`quest_id` = '1'" in /Applications/MAMP/htdocs/hg/fuel/core/classes/database/pdo/connection.php on line 253
ERROR - 2016-09-07 15:40:51 --> 1054 - SQLSTATE[42S22]: Column not found: 1054 Unknown column 'qs.service_id' in 'on clause' with query: "SELECT `qse`.*, `qs`.`hostname`, `qss`.`port` FROM `quest_service_entity` AS `qse` JOIN `quest_server_service` AS `qss` ON (`qs`.`service_id` = `qse`.`service_id`) JOIN `quest_server` AS `qs` ON (`qs`.`quest_server_id` = `qss`.`quest_server_id`) WHERE `qse`.`quest_id` = '1'" in /Applications/MAMP/htdocs/hg/fuel/core/classes/database/pdo/connection.php on line 253
ERROR - 2016-09-07 15:44:43 --> Notice - Undefined variable: e in /Applications/MAMP/htdocs/hg/fuel/app/views/cardinal/quest/cardinal_quest_objectives.php on line 57
ERROR - 2016-09-07 15:53:36 --> Error - Could not find asset: bootstrap.css in /Applications/MAMP/htdocs/hg/fuel/core/classes/asset/instance.php on line 413
ERROR - 2016-09-07 15:58:18 --> Notice - Undefined variable: servers in /Applications/MAMP/htdocs/hg/fuel/app/views/cardinal/quest/cardinal_quest_servers.php on line 7
ERROR - 2016-09-07 15:58:33 --> Notice - Undefined index: server_id in /Applications/MAMP/htdocs/hg/fuel/app/views/cardinal/quest/cardinal_quest_servers.php on line 18
ERROR - 2016-09-07 16:09:16 --> 1054 - SQLSTATE[42S22]: Column not found: 1054 Unknown column 'add_service' in 'field list' with query: "UPDATE `quest_server_service` SET `service_id` = '1', `port` = '23', `type` = '1', `security` = '10', `discovered` = '0', `welcome` = 'r', `add_service` = 'true' WHERE `service_id` = '1'" in /Applications/MAMP/htdocs/hg/fuel/core/classes/database/pdo/connection.php on line 253
ERROR - 2016-09-07 16:13:21 --> Notice - Undefined variable: side_type in /Applications/MAMP/htdocs/hg/fuel/app/views/cardinal/quest/cardinal_quest_objectives.php on line 45
ERROR - 2016-09-07 16:18:16 --> Notice - Undefined index: name in /Applications/MAMP/htdocs/hg/fuel/app/views/shop/shop.php on line 5
ERROR - 2016-09-07 16:18:42 --> Error - Could not find asset: bootstrap.css in /Applications/MAMP/htdocs/hg/fuel/core/classes/asset/instance.php on line 413
ERROR - 2016-09-07 16:20:04 --> Notice - Undefined variable: tVars in /Applications/MAMP/htdocs/hg/fuel/app/classes/controller/shop.php on line 47
ERROR - 2016-09-07 16:20:56 --> Notice - Undefined variable: shop in /Applications/MAMP/htdocs/hg/fuel/app/views/shop/shop_server.php on line 3
ERROR - 2016-09-07 16:26:29 --> Notice - Undefined index: ssd in /Applications/MAMP/htdocs/hg/fuel/app/classes/model/servers.php on line 62
ERROR - 2016-09-07 16:27:21 --> Notice - Undefined index: ssd in /Applications/MAMP/htdocs/hg/fuel/app/classes/model/servers.php on line 62
ERROR - 2016-09-07 16:27:59 --> Notice - Undefined variable: shop in /Applications/MAMP/htdocs/hg/fuel/app/classes/controller/shop.php on line 22
ERROR - 2016-09-07 17:11:43 --> Error - The requested view could not be found: database/database.php in /Applications/MAMP/htdocs/hg/fuel/core/classes/view.php on line 440
ERROR - 2016-09-07 17:25:51 --> Error - Could not find asset: bootstrap.css in /Applications/MAMP/htdocs/hg/fuel/core/classes/asset/instance.php on line 413
ERROR - 2016-09-07 17:26:10 --> Error - Call to undefined method Fuel\Core\DB::from() in /Applications/MAMP/htdocs/hg/fuel/app/classes/controller/database.php on line 17
ERROR - 2016-09-07 17:31:05 --> 1054 - SQLSTATE[42S22]: Column not found: 1054 Unknown column 'quest_group_order' in 'order clause' with query: "SELECT * FROM `quest_group` ORDER BY `quest_group_order` ASC" in /Applications/MAMP/htdocs/hg/fuel/core/classes/database/pdo/connection.php on line 253
ERROR - 2016-09-07 17:39:58 --> Notice - Undefined variable: quest in /Applications/MAMP/htdocs/hg/fuel/app/views/cardinal/quest/cardinal_quests.php on line 17
ERROR - 2016-09-07 18:34:04 --> Error - Class 'Model\Auth' not found in /Applications/MAMP/htdocs/hg/fuel/app/classes/model/missions.php on line 8
ERROR - 2016-09-07 18:35:29 --> 42000 - SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'null)' at line 1 with query: "SELECT * FROM `quest_group` JOIN `user_mission` ON (`user_mission`.`quest_id` = `required_quest_id` AND `user_mission`.`user_id` = `1`) WHERE `type` = 1 AND `live` = 1 AND `level` <= '1' AND (`required_quest_id` = 0 OR `user_mission_id` NOT null)" in /Applications/MAMP/htdocs/hg/fuel/core/classes/database/pdo/connection.php on line 253
ERROR - 2016-09-07 18:35:53 --> 1054 - SQLSTATE[42S22]: Column not found: 1054 Unknown column 'level' in 'where clause' with query: "SELECT * FROM `quest_group` JOIN `user_mission` ON (`user_mission`.`quest_id` = `required_quest_id` AND `user_mission`.`user_id` = `1`) WHERE `type` = 1 AND `live` = 1 AND `level` <= '1' AND (`required_quest_id` = 0 OR `user_mission_id` IS NOT null)" in /Applications/MAMP/htdocs/hg/fuel/core/classes/database/pdo/connection.php on line 253
ERROR - 2016-09-07 18:36:21 --> 1054 - SQLSTATE[42S22]: Column not found: 1054 Unknown column 'user_mission.user_id' in 'on clause' with query: "SELECT * FROM `quest_group` JOIN `user_mission` ON (`user_mission`.`quest_id` = `required_quest_id` AND `user_mission`.`user_id` = `1`) WHERE `type` = 1 AND `live` = 1 AND `level` <= '1' AND (`required_quest_id` = 0 OR `user_mission_id` IS NOT null)" in /Applications/MAMP/htdocs/hg/fuel/core/classes/database/pdo/connection.php on line 253
ERROR - 2016-09-07 18:36:39 --> 1054 - SQLSTATE[42S22]: Column not found: 1054 Unknown column '1' in 'on clause' with query: "SELECT * FROM `quest_group` JOIN `user_mission` ON (`user_mission`.`quest_id` = `required_quest_id` AND `user_mission`.`user_id` = `1`) WHERE `type` = 1 AND `live` = 1 AND `level` <= '1' AND (`required_quest_id` = 0 OR `user_mission_id` IS NOT null)" in /Applications/MAMP/htdocs/hg/fuel/core/classes/database/pdo/connection.php on line 253
ERROR - 2016-09-07 18:37:08 --> Warning - Missing argument 2 for Fuel\Core\Database_Query_Builder_Select::and_on(), called in /Applications/MAMP/htdocs/hg/fuel/app/classes/model/missions.php on line 9 and defined in /Applications/MAMP/htdocs/hg/fuel/core/classes/database/query/builder/select.php on line 177
ERROR - 2016-09-07 18:37:14 --> Warning - Missing argument 2 for Fuel\Core\Database_Query_Builder_Select::on(), called in /Applications/MAMP/htdocs/hg/fuel/app/classes/model/missions.php on line 9 and defined in /Applications/MAMP/htdocs/hg/fuel/core/classes/database/query/builder/select.php on line 161
ERROR - 2016-09-07 18:37:42 --> 1054 - SQLSTATE[42S22]: Column not found: 1054 Unknown column '1' in 'on clause' with query: "SELECT * FROM `quest_group` JOIN `user_mission` ON (`user_mission`.`quest_id` = `required_quest_id` AND `user_mission`.`user_id` = `1`) WHERE `type` = 1 AND `live` = 1 AND `level` <= '1' AND (`required_quest_id` = 0 OR `user_mission_id` IS NOT null)" in /Applications/MAMP/htdocs/hg/fuel/core/classes/database/pdo/connection.php on line 253
ERROR - 2016-09-07 18:40:46 --> Notice - Undefined variable: type in /Applications/MAMP/htdocs/hg/fuel/app/classes/model/missions.php on line 21
ERROR - 2016-09-07 19:23:51 --> Notice - Undefined variable: quests in /Applications/MAMP/htdocs/hg/fuel/app/views/cardinal/quest/cardinal_quest.php on line 15
ERROR - 2016-09-07 19:25:28 --> Error - Could not find asset: bootstrap.css in /Applications/MAMP/htdocs/hg/fuel/core/classes/asset/instance.php on line 413
ERROR - 2016-09-07 19:25:54 --> Error - Could not find asset: bootstrap.css in /Applications/MAMP/htdocs/hg/fuel/core/classes/asset/instance.php on line 413
ERROR - 2016-09-07 19:26:01 --> Error - Could not find asset: bootstrap.css in /Applications/MAMP/htdocs/hg/fuel/core/classes/asset/instance.php on line 413
ERROR - 2016-09-07 19:26:22 --> Error - Could not find asset: bootstrap.css in /Applications/MAMP/htdocs/hg/fuel/core/classes/asset/instance.php on line 413
ERROR - 2016-09-07 19:29:43 --> Error - Class 'Model\Uri' not found in /Applications/MAMP/htdocs/hg/fuel/app/classes/model/missions.php on line 61
ERROR - 2016-09-07 20:14:27 --> Compile Error - Class declarations may not be nested in /Applications/MAMP/htdocs/hg/fuel/app/classes/controller/train.php on line 25
ERROR - 2016-09-07 20:14:44 --> Error - Cannot delete file: given path "/Applications/MAMP/htdocs/hg/fuel/app/tmp/train_1.db" is not a file. in /Applications/MAMP/htdocs/hg/fuel/core/classes/file.php on line 679
ERROR - 2016-09-07 20:14:54 --> Error - Cannot delete file: given path "/Applications/MAMP/htdocs/hg/fuel/app/tmp/train_1.db" is not a file. in /Applications/MAMP/htdocs/hg/fuel/core/classes/file.php on line 679
ERROR - 2016-09-07 20:15:52 --> Error - Cannot delete file: given path "/Applications/MAMP/htdocs/hg/fuel/app/tmp/train_1.db" is not a file. in /Applications/MAMP/htdocs/hg/fuel/core/classes/file.php on line 679
ERROR - 2016-09-07 20:17:16 --> Error - Cannot delete file: given path "/Applications/MAMP/htdocs/hg/fuel/app/tmp/train_1.db" is not a file. in /Applications/MAMP/htdocs/hg/fuel/core/classes/file.php on line 679
ERROR - 2016-09-07 20:17:43 --> Error - Cannot delete file: given path "/Applications/MAMP/htdocs/hg/fuel/app/tmp/train_1.db" is not a file. in /Applications/MAMP/htdocs/hg/fuel/core/classes/file.php on line 679
ERROR - 2016-09-07 20:18:31 --> Error - File: "/Applications/MAMP/htdocs/hg/fuel/app/tmp/train_1.db" already exists, cannot be created. in /Applications/MAMP/htdocs/hg/fuel/core/classes/file.php on line 150
ERROR - 2016-09-07 20:19:14 --> Warning - SQLite3::exec(): table COMPANY already exists in /Applications/MAMP/htdocs/hg/fuel/app/classes/controller/train.php on line 49
ERROR - 2016-09-07 20:20:23 --> Error - The requested view could not be found: train/train_3.php in /Applications/MAMP/htdocs/hg/fuel/core/classes/view.php on line 440
ERROR - 2016-09-07 20:24:33 --> Warning - SQLite3::exec(): near &quot;sadf&quot;: syntax error in /Applications/MAMP/htdocs/hg/fuel/app/classes/controller/train.php on line 72
ERROR - 2016-09-07 20:38:15 --> Warning - print_r() expects at least 1 parameter, 0 given in /Applications/MAMP/htdocs/hg/fuel/app/views/skills/skills.php on line 4
ERROR - 2016-09-07 20:38:21 --> Notice - Undefined offset: 2 in /Applications/MAMP/htdocs/hg/fuel/app/views/skills/skills.php on line 7
ERROR - 2016-09-07 21:14:43 --> Error - The requested view could not be found: missions/missions_service_smtp.php in /Applications/MAMP/htdocs/hg/fuel/core/classes/view.php on line 440