-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2015 at 05:46 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('44f08112a58358c2c82d75899827c884', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0', 1441444793, '');

-- --------------------------------------------------------

--
-- Table structure for table `current_affairs`
--

CREATE TABLE IF NOT EXISTS `current_affairs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(126) NOT NULL,
  `description` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `current_affairs`
--

INSERT INTO `current_affairs` (`id`, `title`, `description`, `date`) VALUES
(1, 'Rodgers hails ''magic'' Coutinho after Liverpool win', 'Liverpool manager Brendan Rodgers was pleased to see his side avenge last season''s 6-1 defeat against Stoke, and reserved praise for matchwinner Philippe Coutinho.\r\n\r\nThe Brazilian struck on 86 minutes after at the end of a closely fought contest to hand his side a 1-0 win at the Britannia Stadium, during which there were few goalscoring opportunities at either end.\r\n\r\nAfter the game, Rodgers said: "It''s always difficult coming to Stoke. Defensively we were strong and we always know we have the quality to win a game.\r\n\r\n"It was embarrassing [the 6-1 loss in May] but today you''ve seen the determination and the quality. It was definitely one for [the fans]. They''ll be proud of the team tonight.\r\n\r\n"How close was I to taking Coutinho off? Very! I can''t profess to be a genius! Danny Ings was going to come on but I''m obviously happy he scored and stayed on.\r\n\r\n"Coutinho is already is a star. He''s only been back three weeks training so he''s not even at his peak."\r\nLiverpool now look ahead to the visit of newly promoted Bournemouth to Anfield on August 17.', '2015-08-10'),
(2, 'Is Google searching for India success with Sundar Pichai at helm?', 'Of course, everyone in Google loves Sundar Pichai. But is there more to his being named CEO of Google’s traditional business?\r\n\r\nThe answer might lie in something that happened in China soon after the Larry Page announced the creation of Alphabet Inc, the new holding company of the world’s largest online search and advertising company. The website for Alphabet (http://abc.xyz/) was duly blocked in mainland China, even though it has nothing more than a note by CEO Larry Page. That is the kind of stonewalling Google has been facing in China, the world’s largest Internet market with 642 million users', '2015-08-10'),
(3, 'Organ Donation: Kochi roads cleared to make way fo', 'In the first inter-state organ donation in Kerala, heart and lungs harvested from a brain dead person in Kochi was flown to Chennai on Tuesday noon.\r\n\r\nThe state government’s Kerala Network for Organ Sharing, police force and Kochi international airport ensured swift transportation of the harvested organs from Lakeshore Hospital in Kochi to Fortis Hospital in Chennai to ensure that the harvested organs were transplanted within four hours after retrieving them from the donor.\r\n\r\nPolice blocked traffic along the road from Lakeshore Hospital to the airport for the speedy movement of the ambulance and vehicles of medical team from Chennai that reached Kochi by a special aircraft on Tuesday morning. It took only around 30 minutes for the vehicles to cover 34 km from the hospital to the airport, despite the stretch is known for traffic snarls due to the ongoing work of Kochi metro and some of the busiest traffic junctions in Kerala.', '2015-08-12');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `option1` varchar(40) NOT NULL,
  `option2` varchar(40) CHARACTER SET utf32 DEFAULT NULL,
  `option3` varchar(40) DEFAULT NULL,
  `option4` varchar(40) DEFAULT NULL,
  `answer` varchar(128) NOT NULL,
  `is_starred` tinyint(1) NOT NULL DEFAULT '0',
  `no` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `is_starred` (`is_starred`),
  KEY `quiz_id` (`quiz_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `quiz_id`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`, `is_starred`, `no`) VALUES
(4, 60, 'New ques', 'one', 'two', 'three', 'four', 'fb1297036bd476d3789f0190dda8c4680696ad0baa132b4a56bff97ff5b18976cce84910015e0db9d79a68b4c3907ec144c6b6b6a7ca57c21edd99868fbd7130', 0, 1),
(7, 60, '4', '1', '2', '3', '4', '6ef3b6011492f7171d140e4ba8a692c32486e517bf6cf068ed0243a197fcb9c1ed5c3f14d3f3e1cb45f61ce2531dc267b77e450391a4885bcfd497fe2db14c41', 1, 2),
(9, 66, 'Who is the mottathalayan seen in our currency?', 'Vincent Gomez', 'Motta adicha obama', 'Gandhi', 'Suresh Gopi', '36b4c90ba76169c84d87f4b763f859380f3bf976fd560cdb608e6959cc6bba4bbc22dde07a35107c0a191dac703c64d9d0dfe926e16912352c79b7e2d1e6a62d', 0, 1),
(11, 66, 'Do you beleive in the system where the whole earth is divided into countries?', 'Yes', 'No', 'May be', 'No answer', '9ae6fa44a5f4acb88deef1cbe44fa2f71661dbfec47eb3847ed490f8c76b783818582b88c49f337302586f6eb360b6a7c610ff012410a5394e4d5ce455fb7754', 0, 2),
(12, 66, 'Best sport?', 'Cricket', 'Football', 'Hockey', 'Kallan and Police', 'b4659ccc06a3f810f2c42933f65281147b986536adff2cad5021fea03bc0bb72a4c09a5c658aea2f45adb73a03e987b3ea0b7299e1edbc46d66d5e95abfe2694', 1, 3),
(13, 66, 'Mekkadan engne full pass aayi?', 'Cheat cheytitt', 'Bit vechitt', 'Koodothram', 'Changayiare pattichitt', 'e697689ffec1bf622ce53341edf2a244201d86732dd1f9196d377919e27d0b2c3af2ab820ac2ace10c8d74da61aedc5f71ba0e94221873ea2f478635ed02c837', 1, 4),
(16, 60, 'ques? ques?', 'one', 'two', 'on', 'three', '38a930bc309ef8425c5e798d44b68ba40db8fd939207075f3d569577c62e249a8fbd044af2fd80004ba97df27df9d681d6a99fd66e3ca92de844fbbc8d0bc970', 0, 3),
(18, 60, 'This is a new question', 'lorem', 'ipsu', 'dolor', 'site', '5938ee7565f195eaa206d99e2b631a8b6bd635916e4c25e35714cdf71d121a46be6f019cd1d53ccc355ced3b827db2ed8758aaad4edfb95e49fdc1dcf51543c2', 0, 4),
(20, 60, 'New question of is the was?', 'which', 'was', 'where', 'whom', 'c52002c5faaec9c5d78a16972079ee192c1832e465208bfff03cc23b4e603cc8e1df87b76d959e5c934ceef585cf8435067d34b257bdeed53a2a59f8394bd851', 0, 5),
(21, 60, 'whom am i?', 'Kaun', 'Who', 'mein', 'wo hi', 'b74912351c705181b9c326a885ddec3ddaf546a0584ecfa4fc227f424bb31fca1e2c294928acfa5f5fd9a59eb5d31838d0f71f10e6af9c128b6d303c36107ccb', 0, 6),
(22, 60, 'This is a new entry to check the final status of the code', 'this', 'is', 'amazing', 'shit', 'f791e9884543eddcd5fe5490621aa579d0cab873100c066c5ccef5884a6aa280abd7d29ddc32febd4c3fe0905c30c15ffe12b92fdf9fb980c396ffb8c607c28d', 1, 7),
(24, 68, 'Indias new gen vedi?', 'XYZ', 'DEF', 'ABC', 'PQR', 'e314be6e2a30f8e2350e360be0b76c4c60fc7871dbb7c7fcdd29133faa2b07e4a56ae167f038e9913e6c8eeb5b3ddf52d0bb71542ede633cce6b9265b5317ef4', 1, 1),
(26, 68, 'Who coined the controversial term "Isha Talwar Hot in Tattathin marayath"', 'Suhail Kozhikkode', 'Dirty Pattar', 'Fucker PAA', 'Kundan Kuli', 'd939808ecedffb3e3156b76039d7aafb7fbc6eb9106c8b1310570d66b01e4a49d383d27ee420e0632dc7b9b37f49677dc856acfb20c6e565facb0fb06cffff2a', 0, 3),
(27, 68, 'Baggunu oru option undayirunenkil aval _____ ne matre vivaham kazikkumayirunullu', 'Anand P M', 'Vishnu M R', 'Athul N', 'Aswin B', '7f623a23f71220fba09a7589039740244f3089eeaef4b3c693e9604f6c1fc3cf243212d407b2702b8d83e4edfe20c3f58c660a3f58e208ff97ce53f7f3502230', 0, 4),
(28, 68, 'apple, munthiri, andiparipp, dates, kumkumapoo iva sammisranam cherth tayyar aakunna Fresh Lime evde ninnanu lambyamakunnath?', 'Vannathimoola', 'Koothuparamb bus stand', 'Pakisthan Mukk', 'Chittariparamb', '325214cce97e541b4b2a9e44495f884cd0dde1dbc783c6bb1740eaba632969a0657845c912b73889fd95be5a0f2851ebbf29376e665ae263789b8efedfb9d0cc', 1, 5),
(35, 68, 'World Quality Assurance Head? Clue: His family have a rich historical background in Kerala Clue: His famous quote "I dont want to be a variable in your equation" Clue: His famous lines on his birthplace "Take some molakupodi, take some mangoes, take some vinegar. Put it in the well. Pickle ready"', 'Arjun Padmarajan Nair', 'Arjun P Sasidharan Nair', 'Arjun Peringali Aredath Nambiar', 'Arjun V K Theeyan', '17d2a5e75daea087a2daa944e0c63ce0c753a0a28d257d598e54ff14d5f6db4023647e6b727aeee71bb97680a9b1b755e03c04ecdadc1f0e9877e9e27e4a6204', 1, 2),
(37, 59, 'This is a sample question', 'answer1', 'answer2', 'answer3', 'answer4', '1b2089dc125e85502a2dcfc7742bb0241ae253b61ed24d95254d4e27856193c29f980aa1d2a1568984ba7f31d4716183023a236630f8c706300b27ce39a239bd', 0, 1),
(38, 69, 'Question one', 'one', 'two', 'three', 'four', '38a930bc309ef8425c5e798d44b68ba40db8fd939207075f3d569577c62e249a8fbd044af2fd80004ba97df27df9d681d6a99fd66e3ca92de844fbbc8d0bc970', 0, 1),
(39, 69, 'Next', 'nextone', 'nexttwo', 'nextthree', 'nextfour', '59e27c67c1d426b4aab04924da0ad0cbada5272747dbf54d893fb4e775aecdcfb3620ab91b03d9fc72558538bbcaf5122e77232a66be84f3d6219c8946f7bcf8', 0, 2),
(40, 72, 'Question 1', 'answer1', 'answer2', 'answer3', 'answer4', '1b2089dc125e85502a2dcfc7742bb0241ae253b61ed24d95254d4e27856193c29f980aa1d2a1568984ba7f31d4716183023a236630f8c706300b27ce39a239bd', 0, 1),
(41, 72, 'Question 2', 'this', 'that', 'thismuch', 'that much', '817d531e22e957d57896307ef5279eb84136ade7b369d09dc8663bfd09ad55a913f02e93a947be0679eecb1850163a50707699d8b4af56835aad8840dce93a6f', 1, 2),
(42, 72, 'Bullshit', 'tick', 'tak', 'tok', 'tim', '47129d3adba9abdfcce7929f4c1c92e125993303dc1da17fa4516785295d19194508be15caf471d00806735c5772121f5511a6b15c8a5997ecfe235cf392dac9', 1, 3),
(43, 63, 'bdfgfdgfgdfgf', 'fgfdgfg', 'fdgdfgfd', 'ggggg', 'dddddd', '8e1e660f40e4f76a6b03d411f60156fd6de330e0d12ebe6ec0a3ed07008048575aa9fc9c4aab6b0088fab77b4edd514a5e654fdf33a0ce1a96fd3524cf5b5a64', 0, 1),
(44, 63, 'erhdfghsredrf', 'reeeeeee', 'rrrrrrrr', 'yyyyyyyyyyy', 'zzzzzzzzzzz', '1b3859cfe8bf76a040693230f2a44f54e996ad5c68427c30eb26aa74b2282b5d4d652a7757ad5ddb972ed757e9e6fae54dd4c6be8ed89d2394bd58cf7fa33f4d', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `question_bank`
--

CREATE TABLE IF NOT EXISTS `question_bank` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `answer` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `question_bank`
--

INSERT INTO `question_bank` (`id`, `question`, `answer`) VALUES
(5, 'Red red redeeee', 'Chopp'),
(6, 'Another sample quesiton to display?', 'Answer it is'),
(7, 'Question 1', 'Answer'),
(8, 'Question 2', 'Answer'),
(9, 'Question 3', 'Answer'),
(10, 'Question 4', 'Answer'),
(11, 'Question 5', 'Answer'),
(12, 'Question 6', 'Answer'),
(13, 'Question 7', 'Answer'),
(14, 'Question 8', 'Answer 8'),
(15, 'Question 9', 'Answer 9'),
(16, 'Question 10', 'Answer');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE IF NOT EXISTS `quiz` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `time_stamp` datetime NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `prize_money` smallint(6) NOT NULL,
  `cost` smallint(6) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `is_result_published` tinyint(1) NOT NULL DEFAULT '0',
  `tags` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `slug`, `title`, `description`, `time_stamp`, `date`, `start_time`, `end_time`, `prize_money`, `cost`, `active`, `is_result_published`, `tags`) VALUES
(63, 'qjk', 'Quiz 5', 'This is a quiz. We are doing a quiz', '2015-08-03 14:42:42', '2015-10-21', '02:00:00', '02:10:00', 0, 0, 1, 0, ''),
(66, 'gk', 'General Knowledge', 'This is a quiz, which is basically a test of the common sense of one. This is an easy test, and a sample one just to get the basic idea of the functioning of quiz in this site.', '2015-07-14 16:32:01', '2015-07-14', '00:00:00', '02:30:00', 0, 0, 0, 0, ''),
(68, 'indian_history_1', 'Indian History', 'This is a wonderfull quiz on the history of india.\r\n\r\nYou see india, not india. if you understand india, you must have sense, sensibility, sensitivity. Just remember that shit!!', '2015-08-04 19:51:33', '2015-08-04', '19:53:00', '21:00:00', 10000, 0, 1, 0, ''),
(69, 'quiz_in_making', 'Quiz in the making', 'This is a quiz in the making. It''s publish date will be then changed to a previous date', '2015-08-03 13:18:28', '2015-08-03', '14:30:00', '15:30:00', 1500, 0, 1, 0, ''),
(70, 'new', 'New1', 'This is new free quiz', '2015-05-06 18:02:35', '2015-05-06', '18:05:00', '19:30:00', 500, 0, 1, 0, ''),
(71, 'first', 'first', 'first quiz', '2015-05-02 17:41:47', '2015-05-02', '17:45:00', '19:30:00', 500, 0, 1, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE IF NOT EXISTS `result` (
  `user_id` int(11) unsigned NOT NULL,
  `quiz_id` int(11) unsigned NOT NULL,
  `time_stamp` datetime NOT NULL,
  `total_questions` smallint(6) NOT NULL,
  `attempted` smallint(6) NOT NULL,
  `total_correct` smallint(6) NOT NULL,
  `correct_starred` tinyint(4) NOT NULL,
  `score` smallint(6) NOT NULL,
  `rank` smallint(6) DEFAULT '0',
  KEY `user_id` (`user_id`),
  KEY `quiz_id` (`quiz_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`user_id`, `quiz_id`, `time_stamp`, `total_questions`, `attempted`, `total_correct`, `correct_starred`, `score`, `rank`) VALUES
(5, 66, '2015-08-04 21:11:42', 4, 3, 2, 2, 2, 0),
(5, 66, '2015-08-17 12:38:42', 4, 0, 0, 0, 0, 0),
(5, 66, '2015-08-17 12:44:00', 4, 0, 0, 0, 0, 0),
(5, 66, '2015-08-17 12:49:21', 4, 4, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'sports'),
(2, 'cricket'),
(3, 'politics'),
(4, 'general');

-- --------------------------------------------------------

--
-- Table structure for table `tags_questionbank`
--

CREATE TABLE IF NOT EXISTS `tags_questionbank` (
  `tag_id` int(11) unsigned NOT NULL,
  `question_id` int(11) unsigned NOT NULL,
  KEY `tag_id` (`tag_id`),
  KEY `question_id` (`question_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags_questionbank`
--

INSERT INTO `tags_questionbank` (`tag_id`, `question_id`) VALUES
(2, 5),
(1, 6),
(2, 6),
(3, 5),
(4, 7),
(4, 8),
(4, 9),
(4, 10),
(4, 11),
(4, 12),
(4, 13),
(4, 14),
(4, 15),
(4, 16);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`) VALUES
(1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', '', 'admin@admin.com', '', NULL, NULL, 'IFAP.qit6zU3lQF6lOHYle', 1268889823, 1439970480, 1),
(3, '::1', 'quastio codenamed', '$2y$08$Xi3/gS.6Qowzdv459xcSg.YxmtnvzWst.K/L7ifNACZMvttyn9F1G', NULL, 'codenamed.quastio@gmail.com', NULL, NULL, NULL, NULL, 1428590566, 1440426381, 1),
(5, '::1', 'sharath kumar', '$2y$08$IALwOJrbwR2RV823B4WpG.NbqFM8nBrj29OEgxZ6TdY8Dz/SO9TFe', NULL, 'sharath@gmail.com', NULL, NULL, NULL, NULL, 1431241980, 1439793925, 1),
(18, '::1', 'arjun, p nair', '$2y$08$VZdt92wpYlWBLuUGoV.Oxu927KxcJNKaYRMpnmfjCYleG0yH/VOTG', NULL, 'arju88nair@gmail.com', NULL, NULL, NULL, NULL, 1431340622, NULL, 1),
(30, '::1', 'arjun p', '$2y$08$H6TzACMHf/A61yjxM8BoaeKKLQgwiikqZfN.DHHgTYXhgghO7h9hO', NULL, 'mailarjun.p@gmail.com', NULL, NULL, NULL, NULL, 1431494000, NULL, 1),
(31, '::1', 'arjun p a', '$2y$08$Ochz5HW10bXnfApDHrnGQ.hoX48lNp234Uhoggqu3J06wWqO.VCda', NULL, 'arjun.pa2@gmail.com', NULL, NULL, NULL, NULL, 1431502265, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(11, 1, 1),
(12, 1, 2),
(8, 3, 1),
(9, 3, 2),
(16, 5, 2),
(25, 18, 2),
(37, 30, 2),
(38, 31, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_profile`
--

CREATE TABLE IF NOT EXISTS `users_profile` (
  `user_id` int(11) unsigned NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `dob` date NOT NULL,
  `edu_qual` text NOT NULL,
  `address` text NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `pincode` varchar(6) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_profile`
--

INSERT INTO `users_profile` (`user_id`, `first_name`, `last_name`, `gender`, `dob`, `edu_qual`, `address`, `city`, `state`, `pincode`, `phone_no`) VALUES
(5, 'Sharath', 'Kumar', 'male', '1992-03-05', 'graduate', 'my home, my street, my distc', 'kasargod', 'kerala', '671458', '9895513813'),
(18, 'Arjun', 'P Nair', 'male', '1993-02-02', 'higher_secondary', 'Ashirvad, Near Chonadam Eranholi', 'Kannur', 'kerala', '670107', '9567086818'),
(30, 'Arjun', 'P', 'male', '1992-06-18', 'higher_secondary', 'Line one, Line two', 'Kannur', 'kerala', '673307', '7894561230'),
(31, 'Arjun', 'P A', 'male', '1991-12-14', 'higher_secondary', 'Prasoonam,, KV Nagar Housing Colony', 'Kannur', 'kerala', '670567', '8289890472');

-- --------------------------------------------------------

--
-- Table structure for table `user_quiz`
--

CREATE TABLE IF NOT EXISTS `user_quiz` (
  `quiz_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `date_time` datetime NOT NULL,
  `reference_id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`quiz_id`,`user_id`),
  UNIQUE KEY `reference_id` (`reference_id`),
  UNIQUE KEY `transaction_id` (`transaction_id`),
  KEY `user_id` (`user_id`),
  KEY `quiz_id` (`quiz_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=100013 ;

--
-- Dumping data for table `user_quiz`
--

INSERT INTO `user_quiz` (`quiz_id`, `user_id`, `date_time`, `reference_id`, `transaction_id`) VALUES
(68, 5, '2015-07-10 18:00:12', 100006, NULL),
(69, 5, '2015-07-12 15:50:30', 100009, 1285),
(71, 5, '2015-07-12 15:50:30', 100012, 1286);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_quizid_fkcons` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `result_userid_fkcons` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tags_questionbank`
--
ALTER TABLE `tags_questionbank`
  ADD CONSTRAINT `fk_question_bank_question_id` FOREIGN KEY (`question_id`) REFERENCES `question_bank` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_tags_tag_id` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `user_quiz`
--
ALTER TABLE `user_quiz`
  ADD CONSTRAINT `fk_quiz_quiz_id` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_users_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
