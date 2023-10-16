-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2022 at 08:31 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asobou`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `acc_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `acc_name` varchar(255) NOT NULL,
  `acc_email` varchar(255) NOT NULL,
  `acc_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_id`, `role_id`, `acc_name`, `acc_email`, `acc_password`) VALUES
(1, 1, 'Admin Jake', 'jake.admin@asobou.com', 'AdminJake123##'),
(2, 2, 'Gojo Satoru', 'satoru123@gmail.com', 'GojoDaBest666!@#');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `model_id` int(11) NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `model_desc` varchar(255) NOT NULL,
  `model_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`model_id`, `model_name`, `model_desc`, `model_img`) VALUES
(1, 'Nintendo Switch', 'Nintendo Switch is designed to fit your life, transforming from home console to portable system in a snap.', 'resource/images/nintendo switch logo.png'),
(2, 'Play Station 4', 'The PS4 console, delivering awesome gaming power, incredible entertainment and vibrant HDR technology.', 'resource/images/PS4 logo.jpg'),
(3, 'Play Station 5', 'The PS5 is a genuine leap forward for console gaming, offering 4K performance, fast load times and a truly game-changing controller that makes playing games more immersive and tactile than ever.', 'resource/images/PS5 logo.jpg'),
(4, 'Xbox', 'Play thousands of games from four generations of Xbox with Backward Compatibility, including optimized titles at launch.', 'resource/images/xbox logo.png');

-- --------------------------------------------------------

--
-- Table structure for table `order_list`
--

CREATE TABLE `order_list` (
  `order_id` varchar(255) NOT NULL,
  `acc_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `contact_num` varchar(15) NOT NULL,
  `emerg_num` varchar(15) NOT NULL,
  `post_add` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `post_state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `postcode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_list`
--

INSERT INTO `order_list` (`order_id`, `acc_id`, `fname`, `lname`, `contact_num`, `emerg_num`, `post_add`, `country`, `post_state`, `city`, `postcode`) VALUES
('37nk7btbiboumbgba1me832cqq', 1, 'Jake', 'Tan', '0189464582', '01192874652', '123, Lorong Damai 2\nTaman Damai ', 'Malaysia', 'Johor', 'Johor Bahru', '57300'),
('3oshbslq853a12ho4uhpqvnqlt', 2, 'Kai', 'Yeoh', '0189464585', '01194645856', '8, Jalan Gemilang 2\nTaman Gemilang', 'Malaysia', 'Pulau Pinang', 'Bukit Mertajam', '14000'),
('60jek4dcurda1jn9h7upd6nr01', 1, 'Jake', 'Yeoh', '0129485686', '0129878765', '13B, Lorong Ciku 16\nTaman Ciku', 'Malaysia', 'Penang', 'Butterworth', '12000'),
('s5ghmr2t8h34t9mguajeec6vhr', 2, 'Wie Ben', 'Wong', '0123456789', '01123456789', '10, Lorong Sudoku 9\nTaman Sudoku', 'Malaysia', 'Kedah', 'Kulim', '09000'),
('vg9gk6ga9lb27bacafrpbodn0g', 2, 'Chie ', 'Heng', '0127566986', '01167648972', '13, Lorong Canai 2\nTaman Roti', 'Malaysia', 'Selangor', 'Petaling Jaya', '57400');

-- --------------------------------------------------------

--
-- Table structure for table `order_product`
--

CREATE TABLE `order_product` (
  `order_id` varchar(255) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `qty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_product`
--

INSERT INTO `order_product` (`order_id`, `prod_id`, `qty`) VALUES
('3oshbslq853a12ho4uhpqvnqlt', 1, 3),
('s5ghmr2t8h34t9mguajeec6vhr', 1, 1),
('vg9gk6ga9lb27bacafrpbodn0g', 2, 1),
('37nk7btbiboumbgba1me832cqq', 3, 1),
('s5ghmr2t8h34t9mguajeec6vhr', 3, 2),
('60jek4dcurda1jn9h7upd6nr01', 8, 1),
('60jek4dcurda1jn9h7upd6nr01', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_condition` varchar(255) NOT NULL,
  `price` varchar(10) NOT NULL,
  `prod_desc` mediumtext NOT NULL,
  `region` varchar(255) NOT NULL,
  `prod_img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `model_id`, `prod_name`, `prod_condition`, `price`, `prod_desc`, `region`, `prod_img`) VALUES
(1, 1, 'Nintendo Switch OLED Model', '2 Year(s)', '1000', 'The console is still functioning properly. A small scratch on the back of the controller but overall still in good condition.', 'Petaling Jaya', 'resource/images/nintendo_switch/nintendo_switch_console.jpg'),
(2, 2, 'PlayStation 4', '3 Year(s)', '1300', 'Fully functional console. Comes with two controllers which are in good condition.', 'Klang', 'resource/images/ps4/ps4_console.jpg'),
(3, 3, 'PlayStation 5', '2 Month(s)', '3000', 'Brand new PS5 out of the box. Played not more than 5 times, reselling due to previous owner being too busy.', 'Subang Jaya', 'resource/images/ps5/ps5_console.jpg'),
(4, 4, 'Xbox Series X', '1 Year(s)', '2350', 'The Xbox Series X delivers sensationally smooth frame rates of up to 120FPS with the visual pop of HDR.', 'Puchong', 'resource/images/xbox/xbox_series x_console.jpg'),
(5, 1, 'Minecraft', '2 Year(s)', '80', 'Minecraft is a game about placing blocks and going on adventures. Let your imagination run free in this infinite world.', 'Putrajaya', 'resource\\images\\nintendo_switch\\nintendo_switch_game3.jpeg'),
(6, 1, 'Mario + Rabbids: Sparks of Hope', '1 Year(s)', '150', 'Action-adventure turn-based strategy video game. ', 'Alor Setar', 'resource\\images\\nintendo_switch\\nintendo_switch_game1.jpeg'),
(7, 1, 'Sonic Frontiers', '8 Month(s)', '120', 'The player will explore the mysterious Starfall Islands to collect Chaos Emeralds as Sonic the Hedgehog.', 'Kuala Lumpur', 'resource\\images\\nintendo_switch\\nintendo_switch_game2.jpeg'),
(8, 1, 'Pokemon Brilliant Diamond', '1 Year(s)', '180', 'Relive a beloved adventure through the Sinnoh region, or embark on your very first Sinnoh quest with Pokemon Brilliant Diamond.', 'Klang', 'resource\\images\\nintendo_switch\\nintendo_switch_game4.jpg'),
(9, 2, 'Assassin\'s Creed Valhalla', '1 Year(s)', '120', 'Assassin\'s Creed Valhalla is a 2020 action role-playing video game developed by Ubisoft Montreal and published by Ubisoft.', 'Penang', 'resource\\images\\ps4\\ps4_game1.jpeg'),
(10, 2, 'Spider-Man', '3 Year(s)', '100', 'Marvel\'s Spider-Man is a 2018 action-adventure game developed by Insomniac Games and published by Sony Interactive Entertainment.', 'Kuala Lumpur', 'resource\\images\\ps4\\ps4_game2.jpg'),
(11, 2, 'Stray', '2 Month(s)', '100', 'Stray is a 2022 adventure game developed by BlueTwelve Studio and published by Annapurna Interactive. The story follows the adventures of a stray cat.', 'Shah Alam', 'resource\\images\\ps4\\ps4_game3.jpeg'),
(12, 2, 'FIFA 18', '3 Year(s)', '40', 'FIFA 18 is a football simulation video game developed and published by Electronic Arts.', 'Kajang', 'resource\\images\\ps4\\ps4_game4.jpg'),
(13, 2, 'Ghost of Tsushima', '3 Month(s)', '150', 'Uncover the hidden wonders of Tsushima in this open-world action adventure from Sucker Punch Productions and PlayStation Studios.', 'Puchong', 'resource\\images\\ps4\\ps4_game5.jpg'),
(14, 3, 'Demon\'s Souls', '1 Year(s)', '120', 'Demon\'s Souls is an action role-playing video game developed by Bluepoint Games and published by Sony Interactive Entertainment for the PlayStation 5', 'Puchong', 'resource\\images\\ps5\\ps5_game1.jpg'),
(15, 3, 'Returnal', '1 Year(s)', '150', 'Returnal is a third-person shooter roguelike video game developed by Housemarque and published by Sony Interactive Entertainment.', 'Johor Bahru', 'resource\\images\\ps5\\ps5_game2.jpg'),
(16, 3, 'Battlefield 2042 Gold Edition', '8 Month(s)', '200', 'Battlefield 2042 is a first-person shooter, developed by DICE and published by Electronic Arts', 'Petaling Jaya', 'resource\\images\\ps5\\ps5_game3.jpg'),
(17, 3, 'Hogwarts Legacy', '3 Month(s)', '200', 'Hogwarts Legacy is an action role-playing game, developed by Avalanche Software and published by Warner Bros.', 'Kuantan', 'resource\\images\\ps5\\ps5_game4.jpg'),
(18, 4, 'Elden Ring', '6 Month(s)', '180', 'Elden Ring is a 2022 action role-playing game developed by FromSoftware and published by Bandai Namco Entertainment.', 'Cyberjaya', 'resource\\images\\xbox\\xbox_game1.jpeg'),
(19, 4, 'Watch Dogs Legion', '2 Year(s)', '50', 'Watch Dogs: Legion is a 2020 action-adventure game developed by Ubisoft Toronto and published by Ubisoft.', 'Klang', 'resource\\images\\xbox\\xbox_game2.jpg'),
(20, 4, 'HALO Infinite', '9 Month(s)', '150', 'Halo Infinite is a 2021 first-person shooter game developed by 343 Industries and published by Xbox Game Studios.', 'Subang Jaya', 'resource\\images\\xbox\\xbox_game3.jpg'),
(21, 4, 'Forza Horizon 5', '5 Month(s)', '150', 'Forza Horizon 5 is a 2021 racing video game developed by Playground Games and published by Xbox Game Studios.', 'Subang Jaya', 'resource\\images\\xbox\\xbox_game4.jpg'),
(22, 1, 'Charging Dock', '2 Month(s)', '40', 'This charging dock charges the pro controller, the console and the Joy-Con.', 'Kuala Lumpur', 'resource\\images\\nintendo_switch\\nintendo_switch_charging_dock.jpeg'),
(23, 1, 'Joy-Con', '1 Year(s)', '150', 'They can be held vertically or horizontally, or even with one in either hand, for a variety of play styles.', 'Sungai Buloh', 'resource\\images\\nintendo_switch\\nintendo_switch_controller.jpg'),
(24, 1, 'Nintendo Switch Dock', '2 Year(s)', '200', 'Upgrade your gaming experience with the Nintendo Switch Dock set. It allows you to play the Nintendo Switch console in any other room with a TV.', 'Kuala Lumpur', 'resource\\images\\nintendo_switch\\nintendo_switch_dock.jpg'),
(25, 1, 'NeoGrip', '4 Month(s)', '50', 'An ergonomic grip for Nintendo Switch OLED and regular model.', 'Kuala Lumpur', 'resource\\images\\nintendo_switch\\nintendo_switch_grip.jpg'),
(26, 1, 'LVL 40 Wired Gaming Headset', '1 Year(s)', '80', 'Communicate with your team on a whole new LVL. The LVL40 wired headset delivers High quality audio through powerful 40mm audio drivers.', 'Kuala Lumpur', 'resource\\images\\nintendo_switch\\nintendo_switch_headset.jpg'),
(27, 1, 'Joy-Con Charging Grip', '2 Month(s)', '100', 'Create a grip-style controller simply by attaching a Joy-Con (L) and Joy-Con (R).', 'Kuala Lumpur', 'resource\\images\\nintendo_switch\\nintendo_switch_joy_con_charging_grip.jpg'),
(28, 2, 'DualShock 4 Back Button Attachment', '2 Year(s)', '95', 'Enhance the experience of your DualShock 4. It offers just the versatility and performance you need when gaming.', 'Subang Jaya', 'resource\\images\\ps4\\ps4_back_button_attachment.jpg'),
(29, 2, 'DualShock 4 Charging Station', '1 Month(s)', '30', 'Charge two DualShock controllers at the same time with AUTO Standby function once the pads hit the full charge.', 'Petaling Jaya', 'resource\\images\\ps4\\ps4_charging_station.jpeg'),
(30, 2, 'DualShock 4 Controller', '1 Year(s)', '150', 'Bring your games to life and hear every detail with sound effects coming directly from your DUALSHOCK 4 wireless controller.', 'Butterworth', 'resource\\images\\ps4\\ps4_controller.jpg'),
(31, 2, 'Gold Wireless Headset', '2 Year(s)', '155', 'Take sound to the next level with the advanced gaming headset for PS4 and PS VR.', 'Kuala Lumpur', 'resource\\images\\ps4\\ps4_headset.jpg'),
(32, 3, 'Media Remote', '4 Month(s)', '95', 'Conveniently navigate entertainment on your PlayStation 5 console with intuitive media and TV controls.', 'Puchong', 'resource\\images\\ps5\\ps5_media_remote.jpg'),
(33, 3, 'PS5 Console Cover', '1 Month(s)', '35', 'Pink cover for customization of the PS5 console.', 'Klang', 'resource\\images\\ps5\\ps5_console_cover.jpg'),
(34, 3, 'PS5 DualSense Wireless Controller', '1 Year(s)', '200', 'Discover a deeper gaming experience1 with the innovative new PS5™ controller.', 'Kuala Lumpur', 'resource\\images\\ps5\\ps5_controller.jpeg'),
(35, 3, 'PS5 DualSense Charging Station', '9 Month(s)', '125', 'Dock up to two DualSense wireless controllers5 quickly and easily with the charging station\'s click-in design.', 'Sungai Buloh', 'resource\\images\\ps5\\ps5_dual_sense_charger.jpg'),
(36, 3, 'PS5 HD Camera', '1 Year(s)', '185', 'Put yourself at the center of your gameplay sharing with the HD camera for PS5.', 'Kuala Lumpur', 'resource\\images\\ps5\\ps5_hd_camera.jpg'),
(37, 3, 'PULSE 3D Wireless Headset', '1 Year(s)', '385', 'Experience outstanding gaming audio with the PULSE 3D wireless headset - fully compatible with PS4 and PS5.', 'Petaling Jaya', 'resource\\images\\ps5\\ps5_headset.jpg'),
(38, 4, 'Wireless Controller Rechargeable Battery Play & Charge Kit', '10 Month(s)', '40', 'Keep the action going with the Xbox One Play & Charge Kit. Recharge while you play or afterwards, even when your Xbox is in standby.', 'Puchong', 'resource\\images\\xbox\\xbox_battery.jpeg'),
(39, 4, 'Xbox Wireless Controller', '2 Year(s)', '135', 'Experience the modernized design of the Xbox Wireless Controller, featuring sculpted surfaces and refined geometry for enhanced comfort during gameplay.', 'Subang Jaya', 'resource\\images\\xbox\\xbox_controller.jpg'),
(40, 4, 'Xbox Wireless Headset', '1 Year(s)', '295', 'Experience high quality audio with a low-latency, 100% wireless connection to your Xbox console, without the need for a dongle or a base station.', 'Puchong', 'resource\\images\\xbox\\xbox_headset.jpg'),
(41, 4, 'Nyko Sound Pad', '3 Month(s)', '80', 'Sound Pad provides a unique way to communicate in online games or party chats by sending fun sound effects over voice chat.', 'Kuala Lumpur', 'resource\\images\\xbox\\xbox_nyko_sound_pad.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `support_id` int(11) NOT NULL,
  `provider_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `feedback` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `support`
--

INSERT INTO `support` (`support_id`, `provider_name`, `email`, `feedback`) VALUES
(1, 'John', 'johntwz174@yahoo.com', 'This website is awesome but could have a dark mode option implemented.'),
(2, 'Finn', 'fn2187@gmail.com', 'The website design is very cool. The colours are very vibrant and the buttons are placed at a position that can be found easily. A wide range of products are available, would definitely shop again.'),
(3, 'Abigail', 'abigail1030@yahoo.com', 'The website should include multiple language support, this enables people who don’t understand English to be able to have a better experience.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`acc_id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`model_id`);

--
-- Indexes for table `order_list`
--
ALTER TABLE `order_list`
  ADD PRIMARY KEY (`order_id`,`acc_id`);

--
-- Indexes for table `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`prod_id`,`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`support_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `acc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `support_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
