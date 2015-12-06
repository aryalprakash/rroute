-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2015 at 05:06 AM
-- Server version: 5.5.42-37.1
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rangeen_community`
--

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE IF NOT EXISTS `advertisement` (
  `ad_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `thematic_id` int(11) NOT NULL,
  `thematic_type` text NOT NULL,
  `headline` text NOT NULL,
  `slogan` text NOT NULL,
  `territory` text NOT NULL,
  `age_min` int(11) NOT NULL,
  `age_max` int(11) NOT NULL,
  `gender` text NOT NULL,
  `currency` text NOT NULL,
  `amount` float NOT NULL,
  `time` int(11) NOT NULL,
  `schedule` int(11) NOT NULL,
  `link` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assigned_developers`
--

CREATE TABLE IF NOT EXISTS `assigned_developers` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `developers` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `assigned_developers`
--

INSERT INTO `assigned_developers` (`id`, `project_id`, `developers`) VALUES
(1, 1, '18,24,28');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comment_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `project_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(64) COLLATE latin1_general_ci NOT NULL,
  `iso_code` char(2) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `iso_code`) VALUES
(1, 'Afghanistan', 'AF'),
(2, 'Albania', 'AL'),
(3, 'Algeria', 'DZ'),
(5, 'Andorra', 'AD'),
(6, 'Angola', 'AO'),
(10, 'Argentina', 'AR'),
(11, 'Armenia', 'AM'),
(13, 'Australia', 'AU'),
(14, 'Austria', 'AT'),
(15, 'Azerbaijan', 'AZ'),
(16, 'Bahamas', 'BS'),
(17, 'Bahrain', 'BH'),
(18, 'Bangladesh', 'BD'),
(19, 'Barbados', 'BB'),
(20, 'Belarus', 'BY'),
(21, 'Belgium', 'BE'),
(22, 'Belize', 'BZ'),
(23, 'Benin', 'BJ'),
(24, 'Bermuda', 'BM'),
(25, 'Bhutan', 'BT'),
(26, 'Bolivia', 'BO'),
(27, 'Bosnia and Herzegowina', 'BA'),
(28, 'Botswana', 'BW'),
(29, 'Bouvet Island', 'BV'),
(30, 'Brazil', 'BR'),
(31, 'British Indian Ocean Territory', 'IO'),
(32, 'Brunei Darussalam', 'BN'),
(33, 'Bulgaria', 'BG'),
(34, 'Burkina Faso', 'BF'),
(35, 'Burundi', 'BI'),
(36, 'Cambodia', 'KH'),
(37, 'Cameroon', 'CM'),
(38, 'Canada', 'CA'),
(39, 'Cape Verde', 'CV'),
(41, 'Central African Republic', 'CF'),
(42, 'Chad', 'TD'),
(43, 'Chile', 'CL'),
(44, 'China', 'CN'),
(49, 'Congo', 'CG'),
(51, 'Costa Rica', 'CR'),
(52, 'Cote D''Ivoire', 'CI'),
(53, 'Croatia', 'HR'),
(54, 'Cuba', 'CU'),
(55, 'Cyprus', 'CY'),
(56, 'Czech Republic', 'CZ'),
(57, 'Denmark', 'DK'),
(58, 'Djibouti', 'DJ'),
(60, 'Dominican Republic', 'DO'),
(62, 'Ecuador', 'EC'),
(63, 'Egypt', 'EG'),
(64, 'El Salvador', 'SV'),
(65, 'Equatorial Guinea', 'GQ'),
(66, 'Eritrea', 'ER'),
(67, 'Estonia', 'EE'),
(68, 'Ethiopia', 'ET'),
(72, 'Finland', 'FI'),
(73, 'France', 'FR'),
(78, 'Gabon', 'GA'),
(79, 'Gambia', 'GM'),
(80, 'Georgia', 'GE'),
(81, 'Germany', 'DE'),
(82, 'Ghana', 'GH'),
(83, 'Gibraltar', 'GI'),
(84, 'Greece', 'GR'),
(85, 'Greenland', 'GL'),
(86, 'Grenada', 'GD'),
(87, 'Guadeloupe', 'GP'),
(88, 'Guam', 'GU'),
(89, 'Guatemala', 'GT'),
(90, 'Guinea', 'GN'),
(91, 'Guinea-bissau', 'GW'),
(92, 'Guyana', 'GY'),
(93, 'Haiti', 'HT'),
(95, 'Honduras', 'HN'),
(96, 'Hong Kong', 'HK'),
(97, 'Hungary', 'HU'),
(98, 'Iceland', 'IS'),
(99, 'India', 'IN'),
(100, 'Indonesia', 'ID'),
(101, 'Iran (Islamic Republic of)', 'IR'),
(102, 'Iraq', 'IQ'),
(103, 'Ireland', 'IE'),
(104, 'Israel', 'IL'),
(105, 'Italy', 'IT'),
(106, 'Jamaica', 'JM'),
(107, 'Japan', 'JP'),
(108, 'Jordan', 'JO'),
(109, 'Kazakhstan', 'KZ'),
(110, 'Kenya', 'KE'),
(112, 'Korea, Democratic People''s Republic of', 'KP'),
(113, 'Korea, Republic of', 'KR'),
(114, 'Kuwait', 'KW'),
(115, 'Kyrgyzstan', 'KG'),
(116, 'Lao People''s Democratic Republic', 'LA'),
(117, 'Latvia', 'LV'),
(118, 'Lebanon', 'LB'),
(119, 'Lesotho', 'LS'),
(120, 'Liberia', 'LR'),
(121, 'Libyan Arab Jamahiriya', 'LY'),
(122, 'Liechtenstein', 'LI'),
(123, 'Lithuania', 'LT'),
(124, 'Luxembourg', 'LU'),
(125, 'Macau', 'MO'),
(126, 'Macedonia, The Former Yugoslav Republic of', 'MK'),
(127, 'Madagascar', 'MG'),
(128, 'Malawi', 'MW'),
(129, 'Malaysia', 'MY'),
(130, 'Maldives', 'MV'),
(131, 'Mali', 'ML'),
(132, 'Malta', 'MT'),
(133, 'Marshall Islands', 'MH'),
(134, 'Martinique', 'MQ'),
(135, 'Mauritania', 'MR'),
(136, 'Mauritius', 'MU'),
(137, 'Mayotte', 'YT'),
(138, 'Mexico', 'MX'),
(140, 'Moldova, Republic of', 'MD'),
(141, 'Monaco', 'MC'),
(142, 'Mongolia', 'MN'),
(144, 'Morocco', 'MA'),
(145, 'Mozambique', 'MZ'),
(147, 'Namibia', 'NA'),
(149, 'Nepal', 'NP'),
(150, 'Netherlands', 'NL'),
(152, 'New Caledonia', 'NC'),
(153, 'New Zealand', 'NZ'),
(154, 'Nicaragua', 'NI'),
(155, 'Niger', 'NE'),
(156, 'Nigeria', 'NG'),
(160, 'Norway', 'NO'),
(161, 'Oman', 'OM'),
(162, 'Pakistan', 'PK'),
(164, 'Panama', 'PA'),
(165, 'Papua New Guinea', 'PG'),
(166, 'Paraguay', 'PY'),
(167, 'Peru', 'PE'),
(168, 'Philippines', 'PH'),
(170, 'Poland', 'PL'),
(171, 'Portugal', 'PT'),
(173, 'Qatar', 'QA'),
(174, 'Reunion', 'RE'),
(175, 'Romania', 'RO'),
(176, 'Russian Federation', 'RU'),
(177, 'Rwanda', 'RW'),
(181, 'Samoa', 'WS'),
(182, 'San Marino', 'SM'),
(184, 'Saudi Arabia', 'SA'),
(185, 'Senegal', 'SN'),
(186, 'Seychelles', 'SC'),
(187, 'Sierra Leone', 'SL'),
(188, 'Singapore', 'SG'),
(189, 'Slovakia (Slovak Republic)', 'SK'),
(190, 'Slovenia', 'SI'),
(191, 'Solomon Islands', 'SB'),
(192, 'Somalia', 'SO'),
(193, 'South Africa', 'ZA'),
(195, 'Spain', 'ES'),
(196, 'Sri Lanka', 'LK'),
(199, 'Sudan', 'SD'),
(200, 'Suriname', 'SR'),
(202, 'Swaziland', 'SZ'),
(203, 'Sweden', 'SE'),
(204, 'Switzerland', 'CH'),
(205, 'Syrian Arab Republic', 'SY'),
(206, 'Taiwan', 'TW'),
(207, 'Tajikistan', 'TJ'),
(208, 'Tanzania, United Republic of', 'TZ'),
(209, 'Thailand', 'TH'),
(210, 'Togo', 'TG'),
(212, 'Tonga', 'TO'),
(214, 'Tunisia', 'TN'),
(215, 'Turkey', 'TR'),
(216, 'Turkmenistan', 'TM'),
(219, 'Uganda', 'UG'),
(220, 'Ukraine', 'UA'),
(221, 'United Arab Emirates', 'AE'),
(222, 'United Kingdom', 'GB'),
(223, 'United States', 'US'),
(225, 'Uruguay', 'UY'),
(226, 'Uzbekistan', 'UZ'),
(228, 'Vatican City State (Holy See)', 'VA'),
(229, 'Venezuela', 'VE'),
(230, 'Viet Nam', 'VN'),
(234, 'Western Sahara', 'EH'),
(235, 'Yemen', 'YE'),
(236, 'Yugoslavia', 'YU'),
(238, 'Zambia', 'ZM'),
(239, 'Zimbabwe', 'ZW');

-- --------------------------------------------------------

--
-- Table structure for table `developers`
--

CREATE TABLE IF NOT EXISTS `developers` (
  `developer_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `specialization` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `featured_descriptions`
--

CREATE TABLE IF NOT EXISTS `featured_descriptions` (
  `description_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `featured_descriptions`
--

INSERT INTO `featured_descriptions` (`description_id`, `project_id`, `user_id`, `content`, `created_on`) VALUES
(1, 1, 75, 'feat text', '2015-11-23 17:10:38');

-- --------------------------------------------------------

--
-- Table structure for table `featured_images`
--

CREATE TABLE IF NOT EXISTS `featured_images` (
  `image_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `featured_videos`
--

CREATE TABLE IF NOT EXISTS `featured_videos` (
  `video_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `footnotes`
--

CREATE TABLE IF NOT EXISTS `footnotes` (
  `footnote_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `text` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ideathread_comments`
--

CREATE TABLE IF NOT EXISTS `ideathread_comments` (
  `comment_id` int(10) NOT NULL,
  `created_by` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ideathread_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `text` varchar(500) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ideathread_comments`
--

INSERT INTO `ideathread_comments` (`comment_id`, `created_by`, `ideathread_id`, `created_on`, `text`) VALUES
(32, '16', '95', '2015-10-04 14:26:22', 'Personally, I think it can inspire a lot of people and present the real side of entrepreneurship.'),
(31, '16', '92', '2015-10-02 22:33:37', 'This is going to be awesome :)'),
(33, '16', '101', '2015-10-11 14:05:06', 'This can improve the lifestyle of city-people. :) ');

-- --------------------------------------------------------

--
-- Table structure for table `ideathreads`
--

CREATE TABLE IF NOT EXISTS `ideathreads` (
  `ideathread_id` int(10) NOT NULL,
  `ideathread_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `source_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `thumbnail_img` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `original_creator` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `interactions` int(100) DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ideathreads`
--

INSERT INTO `ideathreads` (`ideathread_id`, `ideathread_title`, `description`, `source_url`, `thumbnail_img`, `original_creator`, `created_by`, `created_on`, `status`, `interactions`) VALUES
(93, 'Wahltv - The future of TV', 'Wahltv provides an integrated television system that merges the power and versatility of a computer with the convenience of a TV. No cable; one-time payment; streams Ultra HD. [Asking $65,000]', 'https://www.kickstarter.com/projects/1868215934/the-future-of-tv?ref=category_newest', 'uploads/images/ideathreads/Screen Shot 2015-10-03 at 8.43.09 AM.png', 'wahltv.us', 16, '2015-10-03 12:45:33', 'approved', 0),
(92, 'Elio Motors - A new personal transportation alternative', 'A revolutionary startup altering the course of American transportation. A Three-Wheel, 84 MPG Vehicle! For a base price of around $6,800! More than 40,000 reservation already!', 'https://www.startengine.com/startup/elio-motors', 'uploads/images/ideathreads/Screen Shot 2015-10-02 at 6.29.11 PM.png', 'Paul Elio', 16, '2015-10-02 22:31:22', 'approved', 2),
(91, 'Draw for Nepal - Drawing for Nepal', '"Drawing for Nepal" is a collaborative drawing project with the Nepalese people, local architects and Canadian architects to raise money to donate organizations involved in reconstruction of Nepal.', 'https://www.indiegogo.com/projects/dessiner-pour-le-nepal-drawing-for-nepal--2#/', 'uploads/images/ideathreads/yxzheg7disk6iy23tvda.jpg', 'Draw for Nepal', 75, '2015-10-02 17:29:42', 'approved', 0),
(90, 'TruPosture', 'TruPosture is a smart shirt designed to help you maintain a healthy back posture and help reduce back pain. TruPosture is a nano-sensor enabled, comfort-fit smart shirt thatâ€™s packed with technology and features.', 'https://www.indiegogo.com/projects/improve-posture-reduce-back-pain-with-truposture#/', 'uploads/images/ideathreads/e7aqeuom9zuxcbpo0ixy.png', 'Dan Ikoyan', 75, '2015-10-02 17:22:16', 'approved', 1),
(89, 'CAST - A thriller from the border', 'CAST is a feature film about a guy who is desperate for cash to pay his grandpa''s medical bills, a young man resorts to smuggling drugs. [Asking $25,000]', 'https://www.indiegogo.com/projects/cast-a-thriller-from-the-border#/', 'uploads/images/ideathreads/Screen Shot 2015-10-02 at 1.04.37 PM.png', 'David Garcia', 16, '2015-10-02 17:05:10', 'approved', 0),
(86, 'Ovobox - easy way to create website', 'This is the first platform for the front-end development and content management without limitations. New and easy way to create website and manage content. It takes only two clicks to see your first page. [Asking $12000]', 'https://www.kickstarter.com/projects/634944241/ovobox-easy-way-to-create-website', 'uploads/images/ideathreads/Ovobox .png', 'Ovobox.com', 16, '2015-10-02 16:08:45', 'approved', 1),
(94, 'Evapolar - World''s first personal air conditioner', 'Evapolar cools, humidifies and cleans the air creating local perfect microclimate.It is a desktop personal air conditioner that not only chills, but also humidifies & purifies air. Thanks to its portability. [Asking $100k]', 'https://www.indiegogo.com/projects/world-s-first-personal-air-conditioner#/', 'uploads/images/ideathreads/Screen Shot 2015-10-03 at 5.07.34 PM.png', 'Eugene Dubovoy', 16, '2015-10-03 21:10:51', 'approved', 1),
(95, 'IMPACT FOUNDER PROJECT', 'Impact Founder project is a photography and video exhibit on building a Movement of Authentic Entrepreneurship, Featuring Founders Sharing What''s Real. [Asking $3,500]', 'https://www.kickstarter.com/projects/477095538/impact-founder-project', 'uploads/images/ideathreads/Screen Shot 2015-10-04 at 10.20.43 AM.png', 'Kristin Darga', 16, '2015-10-04 14:23:54', 'approved', 2),
(96, 'Birdsong and the Evolution of Human Language', 'It is a research project in solving the mystery of human language evolution. Using "Exon-capture" coupled with DNA next-generation sequencing technologies, this research can be a milestone. From UC Berkeley.[Asking $5,000]', 'https://experiment.com/projects/birdsong-and-the-evolution-of-human-language', 'uploads/images/ideathreads/Screen Shot 2015-10-04 at 6.10.59 PM.png', 'Madza Yasodara and Jessi Sosnovskaya', 16, '2015-10-04 22:11:23', 'denied', 0),
(97, 'THE O: Wearable + App to Never Lose or Forget Anything.', 'Your personal assistant in a mobile app that immediately reminds you when you leave behind any of your most important belongings! [Asking $48,606 and succeeded]', 'https://www.kickstarter.com/projects/owithme/the-o-wearable-app-to-never-lose-or-forget-anythin', 'uploads/images/ideathreads/o.PNG', 'owithme.com', 16, '2015-10-05 17:36:13', 'approved', 1),
(98, 'LOONCUP â€“ The world''s first SMART menstrual cup.', 'Take back your freedom with the world''s first SMART menstrual cup. Measure, Analyze, and Track. This will definitely redefine menstruation. [Asking $50,000]', 'https://www.kickstarter.com/projects/700989404/looncup-the-worlds-first-smart-menstrual-cup', 'uploads/images/ideathreads/Screen Shot 2015-10-06 at 7.26.22 AM.png', 'looncup.com (Loon Lab, Inc)', 16, '2015-10-06 11:28:51', 'approved', 1),
(99, 'MyBookProgress', 'MyBookProgress is a plugin coming this November that "Let readers know about your upcoming book while growing your list and hitting your deadline."[Asking $2,500]', 'https://www.kickstarter.com/projects/authormedia/mybookprogress', 'uploads/images/ideathreads/Screen Shot 2015-10-06 at 6.26.14 PM.png', 'authormedia.com', 16, '2015-10-06 22:26:53', 'approved', 0),
(100, 'HUDWAY Glass: keeps your eyes on the road while driving', 'Hudway Glass is a universal vehicle accessory turning your smartphone into a head-up display (HUD) for any car. Features include Speedometer, Sygic, Naomi, Baidu map. [Asking $100k]', 'https://www.kickstarter.com/projects/361842686/hudway-glass-keeps-your-eyes-on-the-road-while-dri', 'uploads/images/ideathreads/Screen Shot 2015-10-08 at 7.33.18 AM.png', 'Hudwayglass.com', 16, '2015-10-08 11:37:37', 'approved', 0),
(101, 'Plug & Plant: A modular Smart Vertical Garden + An app ', 'Plug & Plant is a wall-mounted system of pods that not only neatly organizes the indoor plants, but each one is equipped with Bluetooth room, humidity and light sensors. "Improve your city-life now" [Asking $50,000]', 'https://www.kickstarter.com/projects/1810482715/plug-and-plant-smart-vertical-garden', 'uploads/images/ideathreads/Screen Shot 2015-10-11 at 9.56.22 AM.png', 'Verticalgreen.com', 16, '2015-10-11 14:01:39', 'approved', 2),
(102, 'SizeGenie: Scan and measure your body, get tailored fashion', 'Your personal body scanner. Quickly and accurately take your measurements so you always get the perfect fit when buying clothes online. [Asking $30,000]', 'https://www.kickstarter.com/projects/tombrooks/sizegenie-scan-and-measure-your-body-get-tailored', 'uploads/images/ideathreads/Screen Shot 2015-10-20 at 7.39.57 PM.png', 'Tom Brooks and Pietro Veragouth', 16, '2015-10-20 23:40:54', 'approved', 1),
(103, 'IronWire by Echo: the $10 Lifetime iPhone Cable', 'Ironwire is an iPhone cable licensed by the Apple. It has a life time warranty and is very reasonably priced for just $10. [Asking $50,000]', 'https://www.indiegogo.com/projects/ironwire-by-echo-the-10-lifetime-iphone-cable#/', 'uploads/images/ideathreads/ironwire.jpg', 'Matthew Cooper-Jones', 18, '2015-11-04 01:48:17', 'approved', 1),
(104, 'Draw Like a Boss : The Physical Book', '"Artists are lucky that they got the talent to draw". \r\n"Everyone else is very lucky that they got this amazing book which shows how easily they can bring their imagination into a wonderful Portrait".\r\n(pledged of $39,208)', 'https://www.kickstarter.com/projects/ashdrawsthings/draw-like-a-boss-the-physical-book?ref=home_popu', 'uploads/images/ideathreads/Screen Shot 2015-11-09 at 9.21.22 PM.png', '', 18, '2015-11-10 02:23:26', 'approved', 2),
(105, 'SecondOpinionExpert', 'SecondOpinionExpert platform enables patients to receive a second opinion from an independent, expert physician that is quick, easy and affordable. Wherever You Are, Whenever You Want. [Asking 500,000]', 'https://www.crowdfunder.com/secondopinionexpert/invest', 'uploads/images/ideathreads/Screen Shot 2015-11-18 at 7.22.29 PM.png', 'Mohan Ananda', 18, '2015-11-19 00:25:02', 'approved', 1),
(106, 'HomeBiogas - Turn Your Waste into Energy', 'HomeBiogas is a biogas system that turns waste into Energy. The energy generated can be used as clean cooking gas and as a liquid fertilizer for the garden. It is easy to use,assemble and affordable. (Asking 100,000). ', 'https://www.indiegogo.com/projects/homebiogas-turn-your-waste-into-energy#/', 'uploads/images/ideathreads/Screen Shot 2015-11-24 at 6.34.10 PM.png', 'Oshik Efrati', 18, '2015-11-24 23:37:24', 'approved', 0),
(107, 'Skriware - Home 3D Printing for everyone', 'Skriware is a 3D printer suitable for Professionals, Hobbyists, Moms, Dads and Children. It is user friendly 3D printing ecosystem where users can select 3D model and print it with one click. [Pledging $50,461]', 'https://www.kickstarter.com/projects/skriware/skriware-home-3d-printing-for-everyone/comments', 'uploads/images/ideathreads/Screen Shot 2015-11-26 at 10.28.44 PM.png', 'Daniel', 18, '2015-11-27 03:29:32', 'approved', 0),
(108, 'The Maya Angelou Documentary', 'Dr. Maya Angelou is author, winner Voice of peace award,director, producer and revolutionist. She was a national treasure. Lets help make a documentary on her life and inspire the world with her teachings.(Asking  150,000)', 'https://www.kickstarter.com/projects/692700038/the-maya-angelou-documentary?ref=category', 'uploads/images/ideathreads/Screen Shot 2015-11-29 at 6.56.12 PM.png', 'Bob Hercules and Rita Coburn Whack ', 18, '2015-11-29 23:58:07', 'approved', 0);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `image_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `interactions`
--

CREATE TABLE IF NOT EXISTS `interactions` (
  `interaction_id` int(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `action` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `author` int(10) NOT NULL,
  `type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `id` int(10) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `interactions`
--

INSERT INTO `interactions` (`interaction_id`, `created_by`, `action`, `author`, `type`, `id`, `created_on`) VALUES
(124, 16, 'like', 18, 'ideathread', 105, '2015-11-19 19:17:39'),
(123, 18, 'like', 18, 'ideathread', 104, '2015-11-13 18:46:44'),
(122, 16, 'like', 18, 'ideathread', 104, '2015-11-10 03:32:08'),
(121, 16, 'like', 18, 'ideathread', 103, '2015-11-04 03:26:54'),
(120, 16, 'like', 16, 'ideathread', 102, '2015-10-23 14:35:49'),
(119, 16, 'comment', 16, 'ideathread', 101, '2015-10-11 14:05:06'),
(118, 16, 'like', 16, 'ideathread', 101, '2015-10-11 14:04:00'),
(117, 16, 'like', 16, 'ideathread', 98, '2015-10-06 11:29:23'),
(116, 16, 'like', 16, 'ideathread', 97, '2015-10-05 22:10:03'),
(115, 16, 'comment', 16, 'ideathread', 95, '2015-10-04 14:26:22'),
(114, 16, 'like', 16, 'ideathread', 95, '2015-10-04 14:25:38'),
(113, 16, 'like', 16, 'ideathread', 94, '2015-10-03 21:16:59'),
(112, 16, 'comment', 16, 'ideathread', 92, '2015-10-02 22:33:38'),
(111, 16, 'like', 16, 'ideathread', 92, '2015-10-02 22:33:00'),
(110, 16, 'like', 75, 'ideathread', 90, '2015-10-02 17:45:44'),
(109, 75, 'comment', 16, 'ideathread', 87, '2015-10-02 16:51:19'),
(108, 75, 'like', 16, 'ideathread', 86, '2015-10-02 16:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `liked_ideas`
--

CREATE TABLE IF NOT EXISTS `liked_ideas` (
  `like_id` int(10) NOT NULL,
  `liked_by` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ideathread_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=92 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `liked_ideas`
--

INSERT INTO `liked_ideas` (`like_id`, `liked_by`, `ideathread_id`, `created_on`) VALUES
(88, '16', '103', '2015-11-04 03:26:54'),
(87, '16', '102', '2015-10-23 14:35:49'),
(86, '16', '101', '2015-10-11 14:04:00'),
(85, '16', '98', '2015-10-06 11:29:23'),
(84, '16', '97', '2015-10-05 22:10:03'),
(83, '16', '95', '2015-10-04 14:25:38'),
(82, '16', '94', '2015-10-03 21:16:59'),
(81, '16', '92', '2015-10-02 22:33:00'),
(80, '16', '90', '2015-10-02 17:45:44'),
(79, '75', '86', '2015-10-02 16:50:42'),
(89, '16', '104', '2015-11-10 03:32:08'),
(90, '18', '104', '2015-11-13 18:46:44'),
(91, '16', '105', '2015-11-19 19:17:39');

-- --------------------------------------------------------

--
-- Table structure for table `liked_projects`
--

CREATE TABLE IF NOT EXISTS `liked_projects` (
  `like_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `liked_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `recipient` int(11) NOT NULL,
  `message` text NOT NULL,
  `reply_on` int(11) NOT NULL DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender`, `recipient`, `message`, `reply_on`, `created_on`) VALUES
(1, 51, 55, '<p>Hi, Neal</p>', 0, '2015-03-26 15:14:32'),
(2, 75, 16, '<p>test</p>', 0, '2015-04-10 18:09:49'),
(3, 16, 75, 'test reply', 2, '2015-04-11 05:35:21'),
(4, 16, 16, 'is ok?', 3, '2015-05-24 15:44:45'),
(5, 16, 16, 'ok', 4, '2015-05-24 15:49:05'),
(6, 16, 16, '?', 5, '2015-05-24 15:58:04'),
(7, 16, 16, 'HI', 4, '2015-07-19 21:59:46');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `notify_id` int(11) NOT NULL,
  `sent_to` int(11) NOT NULL,
  `text` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL DEFAULT 'not-read'
) ENGINE=InnoDB AUTO_INCREMENT=378 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notify_id`, `sent_to`, `text`, `created_by`, `created_on`, `status`) VALUES
(340, 16, 'Prakash&nbsp;Aryal liked your ideathread Ovobox - easy way to create website', 75, '2015-10-02 16:50:42', 'read'),
(341, 16, 'Prakash&nbsp;Aryal commented ideathread CAST - A thriller from the border ', 75, '2015-10-02 16:51:19', 'read'),
(343, 16, 'Prakash&nbsp;Aryal accepted your route', 75, '2015-10-02 17:22:38', 'read'),
(344, 75, 'Krishna&nbsp;Dahal liked your ideathread TruPosture', 16, '2015-10-02 17:45:44', 'read'),
(345, 16, 'Krishna&nbsp;Dahal liked your ideathread Elio Motors - A new personal transportation alternative', 16, '2015-10-02 22:33:00', 'read'),
(346, 16, 'Krishna&nbsp;Dahal commented ideathread Elio Motors - A new personal transportation alternative', 16, '2015-10-02 22:33:38', 'read'),
(348, 18, 'Krishna&nbsp;Dahal accepted your route', 16, '2015-10-02 22:35:58', 'read'),
(351, 16, 'alex&nbsp;Blom accepted your route', 155, '2015-10-03 20:52:24', 'read'),
(352, 16, 'Krishna&nbsp;Dahal liked your ideathread IMPACT FOUNDER PROJECT', 16, '2015-10-04 14:25:38', 'read'),
(353, 16, 'Krishna&nbsp;Dahal commented ideathread IMPACT FOUNDER PROJECT', 16, '2015-10-04 14:26:22', 'read'),
(354, 16, 'Pawan&nbsp;Paudel accepted your route', 18, '2015-10-05 02:45:55', 'read'),
(355, 16, 'Krishna&nbsp;Dahal liked your ideathread THE O: Wearable + App to Never Lose or Forget Anything.', 16, '2015-10-05 22:10:03', 'read'),
(356, 158, 'Krishna Dahal wants to be a router with you. <a href="#" class="accept-route" data-routedby="16" data-user="158">Accept</a> <a href="#" class="decline-route" data-routedby="16" data-user="158">Decline</a>', 16, '2015-10-08 20:42:50', 'not-read'),
(357, 156, 'Krishna Dahal wants to be a router with you. <a href="#" class="accept-route" data-routedby="16" data-user="156">Accept</a> <a href="#" class="decline-route" data-routedby="16" data-user="156">Decline</a>', 16, '2015-10-08 20:43:01', 'not-read'),
(358, 149, 'Krishna Dahal wants to be a router with you. <a href="#" class="accept-route" data-routedby="16" data-user="149">Accept</a> <a href="#" class="decline-route" data-routedby="16" data-user="149">Decline</a>', 16, '2015-10-08 23:56:35', 'not-read'),
(359, 159, 'Krishna Dahal wants to be a router with you. <a href="#" class="accept-route" data-routedby="16" data-user="159">Accept</a> <a href="#" class="decline-route" data-routedby="16" data-user="159">Decline</a>', 16, '2015-10-09 20:50:28', 'not-read'),
(360, 16, 'Krishna&nbsp;Dahal liked your ideathread Plug & Plant: A modular Smart Vertical Garden + An app ', 16, '2015-10-11 14:04:00', 'read'),
(361, 16, 'Krishna&nbsp;Dahal commented ideathread Plug & Plant: A modular Smart Vertical Garden + An app ', 16, '2015-10-11 14:05:06', 'read'),
(363, 160, 'Krishna Dahal wants to be a router with you. <a href="#" class="accept-route" data-routedby="16" data-user="160">Accept</a> <a href="#" class="decline-route" data-routedby="16" data-user="160">Decline</a>', 16, '2015-10-19 18:21:31', 'not-read'),
(364, 157, 'Krishna Dahal wants to be a router with you. <a href="#" class="accept-route" data-routedby="16" data-user="157">Accept</a> <a href="#" class="decline-route" data-routedby="16" data-user="157">Decline</a>', 16, '2015-10-19 18:21:48', 'not-read'),
(365, 153, 'Krishna Dahal wants to be a router with you. <a href="#" class="accept-route" data-routedby="16" data-user="153">Accept</a> <a href="#" class="decline-route" data-routedby="16" data-user="153">Decline</a>', 16, '2015-10-19 18:22:00', 'not-read'),
(366, 16, 'Krishna&nbsp;Dahal liked your ideathread SizeGenie: Scan and measure your body, get tailored fashion', 16, '2015-10-23 14:35:49', 'read'),
(367, 148, 'Krishna Dahal wants to be a router with you. <a href="#" class="accept-route" data-routedby="16" data-user="148">Accept</a> <a href="#" class="decline-route" data-routedby="16" data-user="148">Decline</a>', 16, '2015-11-01 02:35:17', 'not-read'),
(368, 142, 'Krishna Dahal wants to be a router with you. <a href="#" class="accept-route" data-routedby="16" data-user="142">Accept</a> <a href="#" class="decline-route" data-routedby="16" data-user="142">Decline</a>', 16, '2015-11-01 02:35:38', 'not-read'),
(369, 102, 'Krishna Dahal wants to be a router with you. <a href="#" class="accept-route" data-routedby="16" data-user="102">Accept</a> <a href="#" class="decline-route" data-routedby="16" data-user="102">Decline</a>', 16, '2015-11-01 02:36:18', 'not-read'),
(370, 129, 'Krishna Dahal wants to be a router with you. <a href="#" class="accept-route" data-routedby="16" data-user="129">Accept</a> <a href="#" class="decline-route" data-routedby="16" data-user="129">Decline</a>', 16, '2015-11-01 02:36:32', 'not-read'),
(371, 88, 'Krishna Dahal wants to be a router with you. <a href="#" class="accept-route" data-routedby="16" data-user="88">Accept</a> <a href="#" class="decline-route" data-routedby="16" data-user="88">Decline</a>', 16, '2015-11-01 02:36:54', 'not-read'),
(372, 18, 'Krishna&nbsp;Dahal liked your ideathread IronWire by Echo', 16, '2015-11-04 03:26:54', 'read'),
(373, 18, 'Krishna&nbsp;Dahal liked your ideathread Draw Like a Boss : The Physical Book', 16, '2015-11-10 03:32:08', 'read'),
(374, 18, 'Pawan&nbsp;Paudel liked your ideathread Draw Like a Boss : The Physical Book', 18, '2015-11-13 18:46:44', 'read'),
(375, 16, 'Bibek &nbsp;Lamichhane accepted your route', 161, '2015-11-15 14:28:43', 'read'),
(376, 163, 'Krishna Dahal wants to be a router with you. <a href="#" class="accept-route" data-routedby="16" data-user="163">Accept</a> <a href="#" class="decline-route" data-routedby="16" data-user="163">Decline</a>', 16, '2015-11-18 12:38:43', 'not-read'),
(377, 18, 'Krishna&nbsp;Dahal liked your ideathread SecondOpinionExpert', 16, '2015-11-19 19:17:39', 'read');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `payment_id` int(11) NOT NULL,
  `transaction_id` text NOT NULL,
  `type` text NOT NULL,
  `description` text NOT NULL,
  `amount` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `project_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `privacy_settings`
--

CREATE TABLE IF NOT EXISTS `privacy_settings` (
  `setting_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `selected_option` int(11) NOT NULL DEFAULT '1',
  `limit_activity` int(11) NOT NULL,
  `router_available` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project_access`
--

CREATE TABLE IF NOT EXISTS `project_access` (
  `project_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `project_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_categories`
--

CREATE TABLE IF NOT EXISTS `project_categories` (
  `category_id` int(11) NOT NULL,
  `category_name` text NOT NULL,
  `is_optgroup` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_categories`
--

INSERT INTO `project_categories` (`category_id`, `category_name`, `is_optgroup`) VALUES
(1, 'Skills', 1),
(2, 'Crafts', 0),
(3, 'Dance', 0),
(4, 'Design', 0),
(5, 'Drama', 0),
(6, 'Drawing', 0),
(7, 'Fashion/Apparel/ Wearable', 0),
(8, 'Film & Videography', 0),
(9, 'Food', 0),
(10, 'Music', 0),
(11, 'Painting', 0),
(12, 'Photography', 0),
(13, 'Publishing', 0),
(14, 'Sculpture', 0),
(15, 'Technology', 1),
(16, 'Apps', 0),
(17, 'Games', 0),
(18, 'Hardware', 0),
(19, 'Internet & Websites', 0),
(20, 'Optics', 0),
(21, 'Software', 0),
(22, 'Material production', 1),
(23, 'Animal care', 0),
(24, 'Health care', 0),
(25, 'Household products', 0),
(26, 'Sports', 0),
(27, 'Engineering/Manufacturing', 1),
(28, 'Aeronautics', 0),
(29, 'Astronautics', 0),
(30, 'Chemical', 0),
(31, 'Electronics & Electrical', 0),
(32, 'Mechanical', 0),
(33, 'Structural', 0),
(34, 'Physical science', 1),
(35, 'Astronomy', 0),
(36, 'Chemistry', 0),
(37, 'Energy, sustainability & Environment', 0),
(38, 'Geography', 0),
(39, 'Geology', 0),
(40, 'Mathematics', 0),
(41, 'Physics', 0),
(42, 'Life science', 1),
(43, 'Anatomy', 0),
(44, 'Biochemistry', 0),
(45, 'Bioengineering', 0),
(46, 'Botany', 0),
(47, 'Genetics', 0),
(48, 'Medicine', 0),
(49, 'Neuroscience', 0),
(50, 'Pathology', 0),
(51, 'Pharmacology', 0),
(52, 'Physiology', 0),
(53, 'Psychological & Behavioral ', 0),
(54, 'Veterinary', 0),
(55, 'Zoology', 0),
(56, 'Social science', 1),
(57, 'Economics', 0),
(58, 'History', 0),
(59, 'Journalism', 0),
(60, 'Law & Politics', 0),
(61, 'Linguistics', 0),
(62, 'Philosophy', 0),
(63, 'Religion', 0),
(64, 'Sociology', 0);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `project_id` int(11) NOT NULL,
  `project_title` text NOT NULL,
  `project_category` int(11) NOT NULL,
  `project_location` text NOT NULL,
  `featuring_type` varchar(10) NOT NULL,
  `featuring_id` int(11) NOT NULL,
  `thematic_type` varchar(10) NOT NULL,
  `thematic_id` int(11) NOT NULL,
  `details` text NOT NULL,
  `monetize` varchar(20) NOT NULL,
  `startup_amount` int(11) NOT NULL,
  `about_amount` text NOT NULL,
  `risk_amount` text NOT NULL,
  `privacy` varchar(50) NOT NULL,
  `reward` varchar(50) NOT NULL,
  `per_product_cost` decimal(60,0) NOT NULL,
  `equity_pc` decimal(60,0) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `avr_rating` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`project_id`, `project_title`, `project_category`, `project_location`, `featuring_type`, `featuring_id`, `thematic_type`, `thematic_id`, `details`, `monetize`, `startup_amount`, `about_amount`, `risk_amount`, `privacy`, `reward`, `per_product_cost`, `equity_pc`, `status`, `created_on`, `created_by`, `avr_rating`) VALUES
(1, 'Test Project', 2, 'Kathmandu', 'post', 1, 'descriptio', 1, '<p>All project details here</p>', '24', 2500, 'kjdvd djvb', 'b ljsb dsv lsd', 'public', 'Product', '12', '0', 0, '2015-11-23 17:10:18', 75, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE IF NOT EXISTS `rating` (
  `rate_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `routed_projects`
--

CREATE TABLE IF NOT EXISTS `routed_projects` (
  `router_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `routed_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `routers`
--

CREATE TABLE IF NOT EXISTS `routers` (
  `router_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `routed_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `routers`
--

INSERT INTO `routers` (`router_id`, `user_id`, `routed_by`, `status`, `created_on`) VALUES
(26, 75, 16, 1, '2015-10-02 17:21:36'),
(27, 16, 18, 1, '2015-10-02 22:35:03'),
(28, 18, 16, 1, '2015-10-03 01:57:00'),
(29, 155, 16, 1, '2015-10-03 18:23:37'),
(30, 158, 16, 0, '2015-10-08 20:42:50'),
(31, 156, 16, 0, '2015-10-08 20:43:01'),
(32, 149, 16, 0, '2015-10-08 23:56:35'),
(33, 159, 16, 0, '2015-10-09 20:50:28'),
(34, 161, 16, 1, '2015-10-19 18:21:23'),
(35, 160, 16, 0, '2015-10-19 18:21:31'),
(36, 157, 16, 0, '2015-10-19 18:21:46'),
(37, 153, 16, 0, '2015-10-19 18:22:00'),
(38, 148, 16, 0, '2015-11-01 02:35:17'),
(39, 142, 16, 0, '2015-11-01 02:35:38'),
(40, 102, 16, 0, '2015-11-01 02:36:18'),
(41, 129, 16, 0, '2015-11-01 02:36:32'),
(42, 88, 16, 0, '2015-11-01 02:36:54'),
(43, 163, 16, 0, '2015-11-18 12:38:43');

-- --------------------------------------------------------

--
-- Table structure for table `seed_rating_score`
--

CREATE TABLE IF NOT EXISTS `seed_rating_score` (
  `score_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `feasibility` text NOT NULL,
  `uniqueness` text NOT NULL,
  `growth_quality` text NOT NULL,
  `startup_easeness` text NOT NULL,
  `process_clarity` text NOT NULL,
  `risk_factor` text NOT NULL,
  `time_consumption` text NOT NULL,
  `redundancy_featured` text NOT NULL,
  `impact` text NOT NULL,
  `profile` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `suggestions`
--

CREATE TABLE IF NOT EXISTS `suggestions` (
  `suggestion_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `sent_to` int(11) NOT NULL,
  `sent_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `trend`
--

CREATE TABLE IF NOT EXISTS `trend` (
  `trend_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `h1` float NOT NULL DEFAULT '0',
  `h2` float NOT NULL DEFAULT '0',
  `h3` float NOT NULL DEFAULT '0',
  `h4` float NOT NULL DEFAULT '0',
  `h5` float NOT NULL DEFAULT '0',
  `h6` float NOT NULL DEFAULT '0',
  `h7` float NOT NULL DEFAULT '0',
  `h8` float NOT NULL DEFAULT '0',
  `h9` float NOT NULL DEFAULT '0',
  `h10` float NOT NULL DEFAULT '0',
  `h11` float NOT NULL DEFAULT '0',
  `r1` float NOT NULL,
  `r2` float NOT NULL,
  `r3` float NOT NULL,
  `r4` float NOT NULL,
  `r5` float NOT NULL,
  `r6` float NOT NULL,
  `r7` float NOT NULL,
  `r8` float NOT NULL,
  `r9` float NOT NULL,
  `r10` float NOT NULL,
  `r11` float NOT NULL,
  `h1_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `h2_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `h3_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `h4_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `h5_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `h6_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `h7_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `h8_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `h9_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `h10_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `h11_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `cycle` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `preferred_name` text NOT NULL,
  `display_name` text NOT NULL,
  `keep_preferred_only` int(11) NOT NULL DEFAULT '0',
  `keep_preferred_nickname` int(11) NOT NULL DEFAULT '0',
  `company_name` varchar(50) NOT NULL,
  `location` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `user_type` int(11) NOT NULL,
  `user_level` int(11) NOT NULL DEFAULT '1',
  `birthday` date NOT NULL,
  `gender` int(11) NOT NULL DEFAULT '1',
  `college` text NOT NULL,
  `high_school` text NOT NULL,
  `school` text NOT NULL,
  `position` varchar(100) NOT NULL,
  `hometown` varchar(50) NOT NULL,
  `mailing_address` text NOT NULL,
  `alt_email` varchar(50) NOT NULL,
  `social_network` text NOT NULL,
  `phone` varchar(30) NOT NULL,
  `quotes` text NOT NULL,
  `about_me` text NOT NULL,
  `photo` varchar(50) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` timestamp NULL DEFAULT NULL,
  `password_updated_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `register_type` int(11) NOT NULL DEFAULT '1',
  `verified` int(11) NOT NULL DEFAULT '0',
  `verify_file` text NOT NULL,
  `balance` int(11) NOT NULL DEFAULT '0',
  `confirmed` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=165 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `preferred_name`, `display_name`, `keep_preferred_only`, `keep_preferred_nickname`, `company_name`, `location`, `email`, `password`, `user_type`, `user_level`, `birthday`, `gender`, `college`, `high_school`, `school`, `position`, `hometown`, `mailing_address`, `alt_email`, `social_network`, `phone`, `quotes`, `about_me`, `photo`, `created_on`, `updated_on`, `password_updated_on`, `register_type`, `verified`, `verify_file`, `balance`, `confirmed`) VALUES
(16, 'Krishna', 'Dahal', '', 'Krishna Dahal', 0, 0, 'Rangeenroute', 'New York City, NY', 'krishna.dahal2017@gmail.com', '6743848fb7a16b0eb7ff4626e4844254', 3, 1, '1989-10-27', 1, 'The City College of New York', 'St. Xavier''s College', 'Sun-Rise English School', '', 'Bharatpur, Chitwan', '', '', '', '', '', '', 'okkkkk.png', '2015-03-01 20:06:45', NULL, '2015-03-14 00:31:47', 1, 0, '', 0, 1),
(17, 'utsav', 'karmacharya', '', 'utsav karmacharya', 0, 0, '', '', 'karmacharyautsav@gmail.com', 'fd1a9e0249f2cc5e1e5b7a02d3f42f3d', 3, 1, '1991-01-22', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-01 20:41:19', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(18, 'Pawan', 'Paudel', '', 'Pawan Paudel', 0, 0, 'Algebra.Inc', 'New York ', 'pawanpaudela1@gmail.com', '7a570a3e90f408c15402865e6f8f7ad8', 3, 1, '1991-10-15', 1, '', 'St Xaviers'' College', 'Namuna', 'Chief Financial Officer', 'Gaindakot', '', 'pawanpaudela1@gmail.com', '', '1-425-638-2074', '', '', 'DSC_0205.JPG', '2015-03-01 20:59:12', NULL, '2015-03-28 16:16:48', 1, 0, '', 0, 1),
(19, 'Karmacharya', 'Utsav', '', 'Karmacharya Utsav', 0, 0, '', '', 'karmacharyautsav08@gmail.com', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-01 21:04:32', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(20, 'Sanjeeb', 'Pandey', '', 'Sanjeeb Pandey', 0, 0, '', '', 'sanjeeb_pdy@hotmail.com', 'c68504754a27ecdc72df930baf5fe849', 3, 1, '1991-05-12', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-01 21:39:48', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(21, 'Diwakar', 'Chhetri', '', 'Diwakar Chhetri', 0, 0, '', '', 'diwakarchhetri119@gmail.com', '5d9f3ca5dbbd0791ed2bc0209f280b89', 3, 1, '1986-01-11', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 01:31:23', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(22, 'Suman', 'Regmi', '', 'Suman Regmi', 0, 0, '', '', 'suman_regmi45@yahoo.com', '8718960b612643d981a83e3ae7ebdd0d', 3, 1, '1992-03-14', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 03:27:41', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(23, 'Uttam', 'gurung', '', 'Uttam gurung', 0, 0, '', '', 'uttam9841@gmail.com', 'c508a0eda94561446fb81edc36520541', 3, 1, '1992-03-06', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 04:16:41', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(24, 'ramesh ', 'paudel', '', 'ramesh  paudel', 0, 0, '', '', 'rameshpaudel2331@gmail.com', 'b4ea84a664be5b5a152f3ec710cf0a96', 3, 1, '1991-04-22', 1, '', '', '', '', '', '', '', '', '', '', '', '10841811_524713547667907_6723418013409724617_o.jpg', '2015-03-02 05:00:52', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(25, 'Ganesh', 'Paudel', '', 'Ganesh Paudel', 0, 0, '', '', 'ganeshpaudel58@gmail.com', 'fbab636324f085695a07061a310e1aa8', 3, 1, '1990-12-04', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 05:19:32', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(26, 'Ganesh', 'Paudel', '', 'Ganesh Paudel', 0, 0, '', '', 'gpz_the_jhyap@yahoo.com', '', 1, 1, '1990-12-04', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 05:20:38', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(27, 'rahul', 'rouniyar', '', 'rahul rouniyar', 0, 0, '', '', 'hams_stifler@yahoo.com', '0d8976c120829c5d8fdb39b71815bdf0', 3, 1, '1991-09-01', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 05:23:57', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(28, 'sabin', 'khadka', '', 'sabin khadka', 0, 0, '', '', 'sabinkshetri@gmail.com', '3e2204b6356a12d963e97ab047e3938a', 1, 1, '1991-01-21', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 05:30:06', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(29, 'Amrit', 'Sapkota', '', 'Amrit Sapkota', 0, 0, '', '', 'meetsapkota@gmail.com', '945b529082bbbef5c84a95aa6755c4a5', 3, 1, '1990-12-29', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 05:34:41', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(31, 'pawan', 'chan', '', 'pawan chan', 0, 0, '', '', 'you82me@yahoo.com', 'bc8c9680adb020e1258f186a842849f6', 3, 1, '1990-10-20', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 05:56:46', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(32, 'Pawan', 'Chan', '', 'Pawan Chan', 0, 0, '', '', 'pawan_chan@yahoo.com', 'bc8c9680adb020e1258f186a842849f6', 3, 1, '1990-11-19', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 06:00:52', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(33, 'Sanjay', 'Raut', '', 'Sanjay Raut', 0, 0, '', '', 'sentiraut@gmail.com', '6c3893e9ffc8ba10a1aa53e59428684a', 2, 1, '1990-05-13', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 06:08:36', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(34, 'Sachin ', 'Sah', '', 'Sachin  Sah', 0, 0, '', '', 'sachin.b2dud@gmail.com', 'a0a99cde8d6bb6c6244d8dffa18f69c8', 3, 1, '1993-09-23', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 06:14:09', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(35, 'Amrit', 'Panthi', '', 'Amrit Panthi', 0, 0, '', '', '', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 06:16:41', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(36, 'Laxman', 'Gautam', '', 'Laxman Gautam', 0, 0, '', '', 'lgautam31@yahoo.com', '8f3f6985039f59d394cc74918e2f22c8', 3, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 06:37:52', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(37, 'Laxman', 'Gautam', '', 'Laxman Gautam', 0, 0, '', '', 'ab_ma15@yahoo.com', '8f3f6985039f59d394cc74918e2f22c8', 3, 1, '1991-06-02', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 06:40:11', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(39, 'Suraj', 'bhujel', '', 'Suraj bhujel', 0, 0, '', '', 'surajcafe20@gmail.com', 'b6beea98e43d6961ec17943707fec9b5', 3, 1, '1990-03-19', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 07:47:12', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(41, 'Rajendra', 'Thakurathi', '', 'Rajendra Thakurathi', 0, 0, '', '', 'rajendra.thakurathi@gmail.com', 'c7b8b577453156fdc09f9461e1976914', 3, 1, '1988-09-11', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 08:36:01', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(50, 'prabesh', 'paudel', '', 'prabesh paudel', 0, 0, '', 'bangalore', 'prabeshpaudel51@gmail.com', '934e859eded7b8d772a1c39f271363b7', 3, 1, '1995-09-20', 1, 'amc engineering colg', 'NSC', 'GNEHSS', '', 'narayangarh,nepal', 'prabeshpaudel51@g', 'prabeshpaudel4@gmail.com', '', '', '', '', '7.jpg', '2015-03-02 09:21:29', NULL, '2015-11-10 05:59:45', 1, 0, '', 0, 1),
(51, 'Ivan', 'Svetlichniy', '', 'Ivan Svetlichniy', 0, 0, '', '', 'isvetlichniy@gmail.com', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 12:14:30', NULL, '0000-00-00 00:00:00', 2, 0, '', 50, 0),
(52, 'Nick', 'Miggs', '', 'Nick Miggs', 0, 0, '', '', 'nmigliorino@yahoo.com', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 14:52:28', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(53, 'Sujan', 'Acharya', '', 'Sujan Acharya', 0, 0, '', '', 'sujanacharya123@gmail.com', '05081ecfa728590e3c6f092ea83f25db', 3, 1, '1991-04-16', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 15:05:40', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(54, 'Raghunandan', 'Devkota', '', 'Raghunandan Devkota', 0, 0, '', '', 'raghunand10@yahoo.com', '2c0604a2084e6f14e2ab2f9c77e5b635', 3, 1, '1990-10-20', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 15:16:56', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(55, 'Neal', 'Sapkota', '', 'Neal Sapkota', 0, 0, 'Non-Resident Aliens', '', 'muzicmaniac2015@gmail.com', '92868c3f5b14fa1cd94c593b4084960c', 3, 1, '1991-12-24', 1, 'Loras College', '', '', '', '', '', 'muzicmaniac2015@gmail.com', 'facebook.com/muzicmaniac', '', '', 'I am a passionate lover of music, almost a music nerd. I love traveling new places,meeting new people and am crazy about mountains and waterfalls.', '10959565_962262030451701_7353071162283252916_n.jpg', '2015-03-02 16:23:21', NULL, '0000-00-00 00:00:00', 1, 0, '', 200, 1),
(56, 'Neal', 'Sapkota', '', 'Neal Sapkota', 0, 0, '', '', 'muzicmaniac2015@gmail.com', '92868c3f5b14fa1cd94c593b4084960c', 3, 1, '1991-12-24', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 16:23:21', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(57, 'Test', 'Test', '', 'Test Test', 0, 0, '', '', 'test@getbraintree.com', '6bcdd3040788e917b3ae3a587bd7ceb5', 3, 1, '1970-01-01', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 18:57:22', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(58, 'Pawan', 'Paudel', '', 'Pawan Paudel', 0, 0, '', '', 'pawanpaudel1@hotmail.com', 'e1fac514464ba376a55ed0ca44b7c314', 3, 1, '1996-10-04', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 19:00:27', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(59, 'Servpreet', ' Narula', '', 'Servpreet  Narula', 0, 0, '', '', 'servpreet.narula@gmail.com', '62f863bf1627383152d2d939e9278c32', 3, 1, '1986-01-03', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 19:12:06', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(60, 'NRYN', 'Poudyal', '', 'NRYN Poudyal', 0, 0, '', '', 'poudyalnarayan@gmail.com', 'ebd0f0ddf4980084de66c755479fc125', 3, 1, '1980-12-26', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 19:45:05', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(61, 'Manoj', 'Paudel', '', 'Manoj Paudel', 0, 0, '', '', 'manozep@gmail.com', '64dfaa648c54ca44abc9802adb448b0b', 3, 1, '1990-11-21', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 19:49:07', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(62, 'douglas', 'highfield', '', 'douglas highfield', 0, 0, '', '', '2crowscaw@gmail.com', '9b218d0c084b1a5a928289eeb18f892f', 3, 1, '1951-02-20', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 20:34:26', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(63, 'Prashant', 'Poudel', '', 'Prashant Poudel', 0, 0, '', '', 'prashanta.poudel7@gmail.com', 'e2b61b6df9dc4ebab3ce36a0d7af9019', 3, 1, '1991-04-18', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-02 20:35:27', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(66, 'rishav', 'devkota', '', 'rishav devkota', 0, 0, '', '', 'rishav_devkota2003@yahoo.com', '055b8852eb9052291da1638fca1085da', 3, 1, '1991-08-09', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-03 01:34:53', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(67, 'Reshma', 'Dhakal', '', 'Reshma Dhakal', 0, 0, '', '', 'reshmadhakal@yahoo.com', 'f892e1e46694aab6147a03592f665685', 3, 1, '1991-06-10', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-03 04:29:09', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(68, 'El Princess', 'Eclar', '', 'El Princess Eclar', 0, 0, '', '', 'elprincess.eclar@gmail.com', 'ceb5b6743741aad844368f7251ca3e33', 3, 1, '1989-08-15', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-03 06:56:10', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(69, 'Rishav', 'Devkota', '', 'Rishav Devkota', 0, 0, '', '', 'de.rishav@gmail.com', '055b8852eb9052291da1638fca1085da', 3, 1, '1991-09-08', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-03 07:11:12', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(70, 'Sparsh', 'Dutta', '', 'Sparsh Dutta', 0, 0, '', 'Biratnagar', 'forsignup.mine@gmail.com', '31068e03792aac71022876ef62055719', 1, 1, '1988-09-03', 1, 'SMU', 'Delhi Public School', 'St Joseph''s Sr Sec S', '', 'Biratnagar', 'Sahi Marg, Tintoliya', '', '', '', '', '', '', '2015-03-03 08:32:43', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(71, 'Rupak', 'Dhakal', '', 'Rupak Dhakal', 0, 0, '', '', 'candidlyablaze_rupak007@yahoo.com', 'b6c7dceb357f477d35c26161d2e926c8', 3, 1, '1998-10-10', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-03 12:44:42', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(72, 'Monica', 'Sewpaul', '', 'Monica Sewpaul', 0, 0, '', '', 'monicasewpaul@yahoo.com', 'c6c16f7d8aaab8443ced7d85a3310fbf', 1, 1, '2000-01-01', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-03 15:05:09', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(73, 'Bimal', 'Subedi', '', 'Bimal Subedi', 0, 0, '', '', 'bimal_sach@hotmail.com', '96eb545bd3abe022dae6774f215bac6d', 3, 1, '1992-11-13', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-03 15:37:34', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(74, 'Test', 'Test', '', 'Test Test', 0, 0, '', '', 'test1@getbraintree.com', '0786b16ad6bf6e36aad9eb1f3cd40a6e', 3, 1, '1980-01-01', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-03 17:19:30', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(75, 'Prakash', 'Aryal', '', 'Prakash Aryal', 0, 0, 'nLocate', 'Kathmandu, Nepal', 'aryalprakas@gmail.com', 'aa6009b515122cba4ee71c1b5f5679ce', 1, 1, '0000-00-00', 1, 'Pulchowk Campus', 'St. Xavier''s College', 'Paramount School', 'Developer', '', '', 'aryalprakas@gmail.com', '', '', '', '', 'IMG_2089.jpg', '2015-03-03 17:51:24', NULL, '0000-00-00 00:00:00', 2, 0, '', -20, 0),
(76, 'Lev', 'Vakulin', '', 'Lev Vakulin', 0, 0, '', '', 'lev@vakulin.com', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-03 20:45:22', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(77, 'Vidhya', 'Parameswaran', '', 'Vidhya Parameswaran', 0, 0, '', '', 'vpmwar@bu.edu', '66449b669ff66ea1e498d92792494026', 3, 1, '1991-02-12', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-04 00:45:02', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(78, 'Nimesh', 'Ghimire ', '', 'Nimesh Ghimire ', 0, 0, '', '', 'nimaze10@gmail.com', '26612500a0f5479462e424dfa82444d9', 3, 1, '1997-03-15', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-04 01:50:15', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(79, 'Sandesh', 'Paudyal', '', 'Sandesh Paudyal', 0, 0, '', '', 'sandeshpaudyal88@gmail.com', '2f03365acdbb249587703ce3eaf8f4a8', 3, 1, '1992-06-09', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-04 01:56:28', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(80, 'rajesh', 'rimal', '', 'rajesh rimal', 0, 0, '', '', 'sedaninuturn@yahoo.com', 'b0ebf8a578926209680a371ea8941773', 3, 1, '1989-11-21', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-04 02:00:04', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(81, 'nivesh', 'dugar', '', 'nivesh dugar', 0, 0, '', '', 'niveshdugar@gmail.com', 'a40969853714946c518db7d5a2e9b067', 3, 1, '1990-08-06', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-04 02:02:13', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(82, 'nivesh', 'dugar', '', 'nivesh dugar', 0, 0, '', '', 'niveshdugar@gmail.com', 'a40969853714946c518db7d5a2e9b067', 3, 1, '1990-08-06', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-04 02:02:15', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(83, 'Rohit', 'Murarka', '', 'Rohit Murarka', 0, 0, '', '', 'rohitmurarka.123@gmail.com', '86abba407841e141dd8e252b457c9c53', 3, 1, '1990-03-20', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-04 02:09:02', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(84, 'Raghunandan', 'Devkota', '', 'Raghunandan Devkota', 0, 0, '', '', 'bigdakl10@gmail.com', '2c0604a2084e6f14e2ab2f9c77e5b635', 3, 1, '1990-10-20', 1, '', '', '', '', '', '', '', '', '', '', '', 'CYMERA_20141010_084214.jpg', '2015-03-04 02:11:01', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(85, 'pradip', 'thapamagar', '', 'pradip thapamagar', 0, 0, '', '', 'thapamagarpradip@yahoo.com', 'f9b261483f28dd6e00da1ff9f219beac', 3, 1, '1991-09-23', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-04 02:27:17', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(86, 'Utkarsha', 'Karmacharya', '', 'Utkarsha Karmacharya', 0, 0, '', '', 'utkarshakarma@gmail.com', '65018b9916988a6bf4c21629c1f5a6da', 3, 1, '1991-07-09', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-04 03:52:20', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(87, 'Mausam', 'Shrestha', '', 'Mausam Shrestha', 0, 0, '', '', 'shresthamausam24@gmail.com', '9460dd659dfe48fc90540986cff111bc', 3, 1, '1991-03-21', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-04 03:55:37', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(88, 'Nischal', 'rana', '', 'Nischal rana', 0, 0, '', '', 'mischalrananp@gmail.com', '07b5d1f6a7085d4a2c8838d24e82dd0b', 3, 1, '1988-11-18', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-04 05:48:37', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(89, 'Sweta', 'Rayamajhi', '', 'Sweta Rayamajhi', 0, 0, '', '', 'sweut7@gmail.com', '3ce2e3a9f9f47724bb4396ca38ffeb99', 3, 1, '1992-05-12', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-04 13:26:00', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(90, 'Tester', 'Beta', '', 'Tester Beta', 0, 0, '', '', 'testerbeta12345@outlook.com', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-04 16:19:02', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(91, 'Nitish', 'Shrestha', '', 'Nitish Shrestha', 0, 0, '', '', 'nitish.stha@gmail.com', 'deb7679fc12eb9b25ab4aa856f3ae46c', 3, 1, '1989-12-16', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-04 17:34:03', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(92, 'Ankit', 'Vaidya', '', 'Ankit Vaidya', 0, 0, '', '', 'arsenal4810@live.com', '756b4a3bd03981198b7635c018f49580', 3, 1, '1998-07-24', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-04 17:35:29', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(93, 'Ankit', 'Vaidya', '', 'Ankit Vaidya', 0, 0, '', '', 'our_arsenal@live.com', '756b4a3bd03981198b7635c018f49580', 3, 1, '1998-07-24', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-04 17:45:18', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(94, 'Bibek', 'Shrestha', '', 'Bibek Shrestha', 0, 0, '', '', 'bibekmanshrestha@gmail.com', 'd9cafed5441904b0372fd7ab51c7b949', 3, 1, '1988-06-18', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-05 13:24:38', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(95, 'Bishwash', 'Pokharel', '', 'Bishwash Pokharel', 0, 0, '', '', 'bswasp@hotmail.com', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-05 15:57:20', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(96, 'Pracas', 'Sapkota', '', 'Pracas Sapkota', 0, 0, '', '', 'optimistic.prakash@gmail.com', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-06 01:20:26', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(97, 'aenil', 'thapa', '', 'aenil thapa', 0, 0, '', '', 'aenil2hand@gmail.com', '2ebe5554d0174df3339d80e223a38819', 3, 1, '1987-11-08', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-06 15:23:18', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(98, 'Sunil', 'Poudel', '', 'Sunil Poudel', 0, 0, '', '', 'ghar_home@yahoo.com', '46d41e92c02dabd33dce4b04b4e24b0e', 3, 1, '1993-02-06', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-06 23:34:10', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(99, 'Sharada', 'Paudel', '', 'Sharada Paudel', 0, 0, '', '', 'paudel22@gmail.com', '334aa61df18b2d648a0e65a3a1b24dad', 1, 1, '1989-02-14', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-07 05:09:17', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(100, 'Koshish', 'Koirala', '', 'Koshish Koirala', 0, 0, '', '', 'apar_koirala2000@yahoo.com', '5435cef1e77d0bdd073707be479766d2', 3, 1, '1991-01-01', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-07 07:22:12', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(101, 'anil', 'sigdel', '', 'anil sigdel', 0, 0, '', '', 'anilsigdel45@yahoo.com', 'ec944cf1a73f57b21d6c69d790f6bc50', 3, 1, '1991-05-15', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-07 16:02:11', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(102, 'Pragya Sagar', 'Subedi', '', 'Pragya Sagar Subedi', 0, 0, '', '', 'subedi.pragyasagar@gmail.com', '01cc0bc03d2f5a1e5b1314c96d48a2ea', 3, 1, '1998-01-22', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-07 16:54:44', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(103, 'Ishwari', 'Poudel', '', 'Ishwari Poudel', 0, 0, '', '', 'ishpoudel@gmail.com', '969a114706c576525b17b2759e71537b', 3, 1, '1992-01-19', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-07 18:09:49', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(104, 'Pawan ', 'Paudel', '', 'Pawan  Paudel', 0, 0, '', '', 'pawanbaba123@yahoo.com', 'c1da19c5d68872bed4e9bebc7166a0ab', 1, 1, '1991-10-15', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-07 21:09:56', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(105, 'priyanka', 'chudal', '', 'priyanka chudal', 0, 0, '', '', 'priyankachudal54@gmail.com', '127adab1c8ca606a5d59fad7963ef8ae', 3, 1, '1994-11-22', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-08 03:01:49', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(106, 'AAA', 'BBB', '', 'AAA BBB', 0, 0, '', '', 'aa@bb.com', '78cd8c52d92bc7c4e3808fbdb3434da4', 3, 1, '1978-01-01', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-09 17:31:33', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(107, 'sa', 'asc', '', 'sa asc', 0, 0, '', '', 'aaa@ddde.com', '4b78f0777f2ac652e7673763c70f5cf9', 3, 1, '2000-02-02', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-09 17:51:47', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(108, 'dfwefw', 'fwfw', '', 'dfwefw fwfw', 0, 0, '', '', 'aaa@aaa.com', 'c8d3cb98703f6167a5f3fe1dfe1523d5', 3, 1, '1999-02-02', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-09 18:13:02', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(109, 'fww', 'lmlm', '', 'fww lmlm', 0, 0, '', '', 'aa@dsd.com', 'c8d3cb98703f6167a5f3fe1dfe1523d5', 3, 1, '2001-01-01', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-09 18:15:08', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(110, 'dfvw', 'jkkln', '', 'dfvw jkkln', 0, 0, '', '', 'aaaaa@dsd.com', 'c8d3cb98703f6167a5f3fe1dfe1523d5', 3, 1, '1999-04-05', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-09 18:17:05', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(112, 'Pawan', 'Pau', '', 'Pawan Pau', 0, 0, '', '', 'pawanbaba1234@gmail.com', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-09 20:50:02', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(114, 'prabesh', 'paudel', '', 'prabesh paudel', 0, 0, '', '', 'prabeshpaudel4@gmail.com', '19df773ec7aa4aff9ab7fd17d090ac91', 3, 1, '1995-09-20', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-10 11:06:26', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(116, 'nkdbvkj', 'klsvkln', '', 'nkdbvkj klsvkln', 0, 0, '', '', 'ada@nvksdvs.com', 'c8d3cb98703f6167a5f3fe1dfe1523d5', 3, 1, '2002-01-01', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-11 18:02:40', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(117, 'wvwlknv', 'kflndbslkn', '', 'wvwlknv kflndbslkn', 0, 0, '', '', 'aadasda@dsvsdv.com', '4b78f0777f2ac652e7673763c70f5cf9', 3, 1, '2002-01-01', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-11 18:10:12', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(118, 'hkhihih', 'oihoh', '', 'hkhihih oihoh', 0, 0, '', '', 'adasdasda@fwefwe.com', '4b78f0777f2ac652e7673763c70f5cf9', 3, 1, '1999-02-03', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-11 18:17:24', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(119, 'Krishna', 'Dahal', '', 'Krishna Dahal', 0, 0, '', '', 'dahal004@umn.edu', 'eab7776577ab8f3c7c11f283aacc7fa5', 3, 1, '1997-03-05', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-12 02:58:20', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(120, 'Neelima', 'Manandhar', '', 'Neelima Manandhar', 0, 0, '', '', 'neelimamdr@hotmail.com', 'db3d9b34142ffdb766078578e0050f87', 3, 1, '1987-12-17', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-14 02:47:07', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(121, 'ronald', 'lam', '', 'ronald lam', 0, 0, '', '', 'ronaldlam17@hotmail.com', '793fac2f0f3dffd652c97175b6781f8f', 3, 1, '1984-06-05', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-15 15:05:36', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(122, 'ronald', 'lam', '', 'ronald lam', 0, 0, '', '', 'ronaldlam17@hotmail.com', '793fac2f0f3dffd652c97175b6781f8f', 3, 1, '1984-06-05', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-15 15:30:20', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(123, 'suraxa', 'rmj', '', 'suraxa rmj', 0, 0, '', '', 'sooraxa@gmail.com', 'f5b93ef7c2070fc7b7cbabe1835bc35a', 3, 1, '1991-04-02', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-17 07:52:55', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(124, 'Alexander', 'Shnurkov', '', 'Alexander Shnurkov', 0, 0, '', '', 'arno.lentz@gmail.com', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-19 19:02:04', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(125, 'Ben', 'Moody', '', 'Ben Moody', 0, 0, '', '', 'bentheredonethat2000@gmail.com', '4a5f5d41242459e713e5d06d67dc3abf', 3, 1, '2000-02-09', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-21 19:06:42', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(126, 'Larisha', 'Lamsal', '', 'Larisha Lamsal', 0, 0, '', '', 'larisha.lamsal@yahoo.com', 'e3dab0bc58ac1c33302ca40abea816b0', 3, 1, '1999-12-29', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-22 16:07:48', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(127, 'Bandhu', 'Saar', '', 'Bandhu Saar', 0, 0, '', '', 'bandhusaar@gmail.com', '38937c98b0d87a1863aed3dfd0e0e8ed', 3, 1, '1948-09-23', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-26 07:14:04', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(128, 'Newarni', 'Anuza', '', 'Newarni Anuza', 0, 0, '', '', 'smile_zenisha@yahoo.com', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-03-27 05:35:01', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(129, 'Travis', 'Crego', '', 'Travis Crego', 0, 0, '', '', 'crego011@morris.umn.edu', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-04-06 14:54:21', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(130, 'Krishna', 'Dahal', '', 'Krishna Dahal', 0, 0, '', '', 'krishna_dahal2011@yahoo.com', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-04-07 21:07:30', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(131, 'Sanzuu', 'Kharel', '', 'Sanzuu Kharel', 0, 0, '', '', 'charming_sara@hotmail.com', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-04-11 05:50:04', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(132, 'tanya', 'James', '', 'tanya James', 0, 0, '', '', 'Tanya@mobilefashionave.com', 'c095866db5af0c7f086bee57fcec77bb', 3, 1, '1954-11-27', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-04-17 20:06:12', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(133, 'Michael', 'Nurse', '', 'Michael Nurse', 0, 0, '', '', 'michael.nurse@gmail.com', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-04-17 20:59:17', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(134, 'Rich', 'BERREBBI', '', 'Rich BERREBBI', 0, 0, '', '', 'rich@bdrcompany.com', 'b9e5dd87924255584e34566a930c270c', 3, 1, '1967-01-01', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-04-20 22:12:09', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(135, 'soniya', 'khand', '', 'soniya khand', 0, 0, '', '', 's_universe2002@yahoo.com', '1541e9e243ddf33d57a61a9348f36929', 3, 1, '1991-12-05', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-04-22 03:48:18', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(136, 'Rupesh', 'Shrestha', '', 'Rupesh Shrestha', 0, 0, '', '', 'rshrestha1030@gmail.com', 'c20b05d3589eda5ab13f0652d148e1cc', 3, 1, '1987-10-30', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-04-22 04:28:30', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(137, 'Ramesh', 'sapkota', '', 'Ramesh sapkota', 0, 0, '', '', 'sapkota.ramesh7@gmail.com', '669fac105407af69ad1ffc4744209e65', 3, 1, '1988-04-14', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-04-26 00:15:43', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(138, 'June', 'Owens', '', 'June Owens', 0, 0, '', '', 'juneowens2013@gmail.com', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-05-03 21:38:09', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(139, 'Mark', 'Simon', '', 'Mark Simon', 0, 0, '', '', 'marksimon2013@outlook.com', '6475e676964f8a32fa91191168096eb2', 3, 1, '1980-10-19', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-05-04 05:51:47', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(140, 'Nefarious', 'Arpan', '', 'Nefarious Arpan', 0, 0, '', '', 'nefarious.pthk@gmail.com', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-05-07 00:30:49', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(141, 'Sonam', 'Duseja', '', 'Sonam Duseja', 0, 0, '', '', 'sonam.duseja@gmail.com', '0182ce0bbde209ebad1f25a95c643dbe', 3, 1, '1984-07-18', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-05-08 21:25:13', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(142, 'Chris', 'Campbell', '', 'Chris Campbell', 0, 0, '', '', 'campbell.chri@husky.neu.edu', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-05-10 16:04:14', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(143, 'june', 'owens', '', 'june owens', 0, 0, '', '', 'juneowenscreative@gmail.com', '08e75c2fd61af5039c431dbb88a3051a', 3, 1, '1973-03-30', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-05-10 22:04:46', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(144, 'cool', 'san', '', 'cool san', 0, 0, '', '', 'coolsann80@gmail.com', '179ab8069536b75cdb82deebe483598e', 1, 1, '1981-01-21', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-05-11 16:11:04', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(145, 'andrey', 'sytnik', '', 'andrey sytnik', 0, 0, '', '', 'sytnik.andrey.ua@gmail.com', 'c60c5060428f02943cebe7593109679b', 3, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-06-29 08:13:19', NULL, '0000-00-00 00:00:00', 1, 0, '', 9095, 1),
(146, 'Rabin', 'Ranabhat', '', 'Rabin Ranabhat', 0, 0, '', '', 'rabinrana@gmail.com', 'c9aa3995c332447f61153fd40f405b42', 1, 1, '1989-06-23', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-07-19 15:38:32', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(147, 'Bibek', 'Adhikari', '', 'Bibek Adhikari', 0, 0, '', '', 'bibek.adhikari012@gmail.com', 'ce992dd98a49988367b9a063453502c9', 3, 1, '1991-09-14', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-08-16 02:14:55', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(148, 'Sravan', 'Goli', '', 'Sravan Goli', 0, 0, '', '', 'sravan.goli15@gmail.com', 'df2f51d93711636f91f786908a2aee44', 3, 1, '1990-02-05', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-08-17 15:47:38', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(149, 'Rachana', 'Neupane', '', 'Rachana Neupane', 0, 0, '', '', 'rachana2neupane@yahoo.com', 'd1b391fe9d3b4892b2c90357db878f03', 3, 1, '1993-06-18', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-09-01 21:27:25', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(150, 'dfdf', 'dfdfd', '', 'dfdf dfdfd', 0, 0, '', '', 'night_vison@gmail.com', '79366bb2c8007ca02fdbe9a10073c16c', 3, 1, '1987-03-13', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-09-17 20:56:50', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(151, 'sophie', 'Astin', '', 'sophie Astin', 0, 0, '', '', 'sophie.astin9@gmail.com', '22417d5b989c9be35af384caaf8d1fac', 3, 1, '1979-08-20', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-09-28 16:17:14', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(152, 'Chandra', 'Adhikari', '', 'Chandra Adhikari', 0, 0, '', '', 'chandra.adh07@gmail.com', 'c13a1effb7902250fc7926ff2f9b5f7a', 3, 1, '1997-10-08', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-10-02 04:12:24', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(153, 'Bibek', 'Adhikari', '', 'Bibek Adhikari', 0, 0, '', '', 'cabibekadhikari@gmail.com', 'e3f6d93c584918128c6a33a6e17d52f6', 3, 1, '1991-09-14', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-10-03 01:43:23', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(154, 'Nabeen', 'Khadka', '', 'Nabeen Khadka', 0, 0, '', '', 'nabeen.khadka@gmail.com', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-10-03 12:22:43', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(155, 'alex', 'Blom', '', 'alex Blom', 0, 0, '', '', 'alexanderjblom@gmail.com', '3704a1b0b47d5bbf294ba1931ea008e9', 3, 1, '1956-11-22', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-10-03 17:38:30', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(156, 'Anita', 'Dahal', '', 'Anita Dahal Khadka', 0, 0, '', '', 'anitakhadka66@hotmail.com', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-10-04 21:15:02', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(157, 'Rose', 'Wilson', '', 'Rose Wilson', 0, 0, '', '', 'rose@owithme.com', 'ff98f08d026ebbc71802ace5168f2d4a', 3, 1, '1982-10-28', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-10-05 16:35:21', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(158, 'Shahin', 'hyder', '', 'Shahin hyder', 0, 0, '', '', 'shyder@live.com', '7d341c60997adcb3837708da829a9d8e', 3, 1, '1987-11-20', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-10-05 18:11:20', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0),
(159, 'Nabaraj', 'Poudel', '', 'Nabaraj Poudel', 0, 0, '', '', 'infotechnab@gmail.com', '8a46956b3a23ffcafd20cf7e87bcdc92', 3, 1, '1987-12-26', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-10-09 03:15:20', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(160, 'Suraj', 'Shrestha', '', 'Suraj Shrestha', 0, 0, '', '', 'suraj.sht@hotmail.com', '071b7a3d0d5cefeb5dd4dc088b296a08', 3, 1, '1994-10-02', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-10-09 07:34:34', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(161, 'Bibek ', 'Lamichhane', '', 'Bibek  Lamichhane', 0, 0, '', '', 'bibeklamichhane82@gmail.com', '9b76bd7a888bb97165017f5802871280', 3, 1, '1995-10-12', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-10-11 07:34:50', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 1),
(162, 'Sentiking', '', '', 'Sentiking', 0, 0, '', '', 'sentiking@yahoo.com', '', 1, 1, '0000-00-00', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-11-17 06:58:00', NULL, '0000-00-00 00:00:00', 2, 0, '', 0, 0),
(163, 'Yangbo', 'Du', '', 'Yangbo Du', 0, 0, 'Visionary', 'New York', 'yangbodu@alum.mit.edu', '', 1, 1, '1990-04-06', 1, 'Mass. Inst. of Tech', 'Ill. Math. & Sc. Ac.', '', 'Founding Partner, Connector at Large', 'New York', '', 'yangbodu@alum.mit.edu', 'linkedin.com/in/yangbodu', '+1 309 339 0970', '', '', 'DSC_0045.jpg', '2015-11-17 19:19:32', NULL, '0000-00-00 00:00:00', 2, 0, 'IMG_4136.JPG', 0, 0),
(164, 'ram', 'thapa', '', 'ram thapa', 0, 0, '', '', 'ramhare556@gmail.com', 'eca5b8dabff3760348d9433e59ed938d', 3, 1, '1984-03-11', 1, '', '', '', '', '', '', '', '', '', '', '', '', '2015-11-28 00:02:36', NULL, '0000-00-00 00:00:00', 1, 0, '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `video_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_name` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD UNIQUE KEY `ad_id` (`ad_id`);

--
-- Indexes for table `assigned_developers`
--
ALTER TABLE `assigned_developers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `developers`
--
ALTER TABLE `developers`
  ADD PRIMARY KEY (`developer_id`);

--
-- Indexes for table `featured_descriptions`
--
ALTER TABLE `featured_descriptions`
  ADD PRIMARY KEY (`description_id`);

--
-- Indexes for table `featured_images`
--
ALTER TABLE `featured_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `featured_videos`
--
ALTER TABLE `featured_videos`
  ADD PRIMARY KEY (`video_id`), ADD UNIQUE KEY `video_id` (`video_id`), ADD UNIQUE KEY `project_id` (`project_id`);

--
-- Indexes for table `footnotes`
--
ALTER TABLE `footnotes`
  ADD PRIMARY KEY (`footnote_id`);

--
-- Indexes for table `ideathread_comments`
--
ALTER TABLE `ideathread_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `ideathreads`
--
ALTER TABLE `ideathreads`
  ADD PRIMARY KEY (`ideathread_id`), ADD UNIQUE KEY `ideathread_id` (`ideathread_id`), ADD KEY `ideathread_id_2` (`ideathread_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `interactions`
--
ALTER TABLE `interactions`
  ADD PRIMARY KEY (`interaction_id`);

--
-- Indexes for table `liked_ideas`
--
ALTER TABLE `liked_ideas`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `liked_projects`
--
ALTER TABLE `liked_projects`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notify_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `privacy_settings`
--
ALTER TABLE `privacy_settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `project_categories`
--
ALTER TABLE `project_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `routed_projects`
--
ALTER TABLE `routed_projects`
  ADD PRIMARY KEY (`router_id`);

--
-- Indexes for table `routers`
--
ALTER TABLE `routers`
  ADD PRIMARY KEY (`router_id`);

--
-- Indexes for table `seed_rating_score`
--
ALTER TABLE `seed_rating_score`
  ADD PRIMARY KEY (`score_id`);

--
-- Indexes for table `suggestions`
--
ALTER TABLE `suggestions`
  ADD PRIMARY KEY (`suggestion_id`);

--
-- Indexes for table `trend`
--
ALTER TABLE `trend`
  ADD PRIMARY KEY (`trend_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`video_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `ad_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `assigned_developers`
--
ALTER TABLE `assigned_developers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=240;
--
-- AUTO_INCREMENT for table `developers`
--
ALTER TABLE `developers`
  MODIFY `developer_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `featured_descriptions`
--
ALTER TABLE `featured_descriptions`
  MODIFY `description_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `featured_images`
--
ALTER TABLE `featured_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `featured_videos`
--
ALTER TABLE `featured_videos`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `footnotes`
--
ALTER TABLE `footnotes`
  MODIFY `footnote_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ideathread_comments`
--
ALTER TABLE `ideathread_comments`
  MODIFY `comment_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `ideathreads`
--
ALTER TABLE `ideathreads`
  MODIFY `ideathread_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=109;
--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `interactions`
--
ALTER TABLE `interactions`
  MODIFY `interaction_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `liked_ideas`
--
ALTER TABLE `liked_ideas`
  MODIFY `like_id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `liked_projects`
--
ALTER TABLE `liked_projects`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `notify_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=378;
--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `privacy_settings`
--
ALTER TABLE `privacy_settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_categories`
--
ALTER TABLE `project_categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=65;
--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `project_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `routed_projects`
--
ALTER TABLE `routed_projects`
  MODIFY `router_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `routers`
--
ALTER TABLE `routers`
  MODIFY `router_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `seed_rating_score`
--
ALTER TABLE `seed_rating_score`
  MODIFY `score_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `suggestions`
--
ALTER TABLE `suggestions`
  MODIFY `suggestion_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trend`
--
ALTER TABLE `trend`
  MODIFY `trend_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=165;
--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
