-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 21, 2020 at 07:47 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms4.2.1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `aname` varchar(30) NOT NULL,
  `aheadline` varchar(30) NOT NULL,
  `bio` text NOT NULL,
  `aimage` varchar(50) NOT NULL DEFAULT 'avatar.png',
  `addedby` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `datetime`, `username`, `password`, `aname`, `aheadline`, `bio`, `aimage`, `addedby`) VALUES
(2, 'September-21-2020 07:35:39', 'Anthony', 'e10adc3949ba59abbe56e057f20f883e', 'Anthony', 'Computer Network Architect.', 'Instagram is a notoriously difficult platform on which to write a good bio. Similar to Twitter', '65646572251.jpg', 'Brown'),
(3, 'September-21-2020 07:36:38', 'Harry', 'e10adc3949ba59abbe56e057f20f883e', 'Harry ', 'Network Administrator.', 'As a venture capitalist and an executive at several start-ups, Mark Gallion has different versions of his bio all over the internet', 'Profile-Pic-Demo.png', 'Anthony'),
(4, 'September-21-2020 07:36:56', 'Nathan', 'e10adc3949ba59abbe56e057f20f883e', 'Nathan', 'IT Analyst.', 'Why would he choose humor when he runs Test', 'faceless-businessman-.jpg', 'Anthony'),
(5, 'September-21-2020 07:37:32', 'Richard', 'e10adc3949ba59abbe56e057f20f883e', 'Richard', 'Developer', 'Stage-named DJ Nexus, Jamerson', 'dentalia-demo-deoctor-3-1-750x750.jpg', 'Nathan'),
(6, 'September-21-2020 07:49:37', 'Brown', 'e10adc3949ba59abbe56e057f20f883e', 'Brown', 'Developer', 'this my bio', 'Profile-Pic-Demo.png', 'Nathan'),
(8, 'September-21-2020 07:55:13', 'Amelia', 'e10adc3949ba59abbe56e057f20f883e', 'Amelia', 'Engineer', 'As a venture capitalist and an executive at severa', 'profile-pic.jpg', 'Brown');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(50) CHARACTER SET latin1 NOT NULL,
  `author` varchar(50) CHARACTER SET latin1 NOT NULL,
  `datetime` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `author`, `datetime`) VALUES
(1, 'Technology', 'Brown', 'September-21-2020 07:52:25'),
(2, 'Flutter', 'Anthony', 'September-21-2020 08:14:03'),
(3, 'Java', 'Richard', 'September-21-2020 08:14:35'),
(4, 'Travel', 'Richard', 'September-21-2020 08:14:43'),
(5, 'Developement', 'Brown', 'September-21-2020 08:15:22'),
(6, 'Web Design', 'Amelia', 'September-21-2020 08:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `comment` varchar(500) NOT NULL,
  `approvedby` varchar(50) NOT NULL,
  `status` varchar(3) NOT NULL,
  `post_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `datetime`, `name`, `email`, `comment`, `approvedby`, `status`, `post_id`) VALUES
(1, 'September-21-2020 10:55:23', 'Carolyn', 'Carolyn@gmail.com', 'The 600px range for emails was calculated for Windows Outlook working on a 1024px desktop monitor, 10 years ago. Now devices with screen widths of minimum 800px are flooding the market; so you can build HTML emails with a width of 700px at least, and add background colors to emulate widescreen emails', 'Anthony', 'ON', 1),
(2, 'September-21-2020 10:55:59', 'Elizabeth', 'Elizabeth@gmail.com', 'Nice Post all the best', 'Anthony', 'ON', 1),
(3, 'September-21-2020 10:57:53', 'Gabrielle', 'Gabrielle@gmail.com', 'Very Good post', 'Anthony', 'ON', 14),
(4, 'September-21-2020 10:58:19', 'Carolyn', 'Carolyn@gmail.com', 'Instagram\'s limited bio space requires you to highlight just your most important qualities, and blogging icon Rebecca Bollwitt does so in her own Instagram bio in an excellent way.', 'Anthony', 'ON', 7),
(5, 'September-21-2020 10:58:33', 'Elizabeth', 'Elizabeth@gmail.com', 'Icon Rebecca Bollwitt does so in her own Instagram bio in an excellent way.', 'Anthony', 'ON', 7),
(6, 'September-21-2020 10:59:02', 'Madeleine', 'Madeleine@gmail.com', 'Rebecca\'s brand name is Miss604, and cleverly uses emojis in her Instagram bio to', 'Anthony', 'ON', 16),
(7, 'September-21-2020 10:59:20', 'Madeleine', 'Madeleine@gmail.com', 'Rebecca\'s brand name is Miss604, and cleverly uses emojis in her Instagram bio to', 'Anthony', 'ON', 15),
(8, 'September-21-2020 11:00:15', 'Carolyn', 'Carolyn@gmail.com', 'Hi this is test Comments', 'Anthony', 'ON', 12),
(9, 'September-21-2020 11:01:27', 'Pippa', 'Pippa@gmail.com', 'as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model te', 'Anthony', 'ON', 10),
(10, 'September-21-2020 11:01:41', 'Carolyn', 'Carolyn@gmail.com', ' publishing packages and web page editors now use Lorem Ipsum as their default model te', 'Anthony', 'OFF', 10),
(11, 'September-21-2020 11:02:12', 'Sonia', 'Sonia@gmail.com', 'Take a lesson from Miss604, and show your personal side. Just because you\'re branding yourself as a professional doesn\'t mean you have to take your human being hat off. Often your most personal attributes make for the best professional bio content.', 'Anthony', 'ON', 8),
(12, 'September-21-2020 11:02:22', 'Madeleine', 'Madeleine@gmail.com', 'nice post', 'Anthony', 'ON', 8);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `datetime` varchar(50) NOT NULL,
  `title` varchar(300) NOT NULL,
  `category` varchar(50) NOT NULL,
  `author` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `post` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `datetime`, `title`, `category`, `author`, `image`, `post`) VALUES
(1, 'September-21-2020 08:17:16', 'This is my First Demo post', 'Developement', 'Amelia', 'image_01.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(2, 'September-21-2020 08:18:38', 'This is my second Demo post', 'Travel', 'Richard', 'image_04.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n<br>\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\n<hr>\r\nit has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(3, 'September-21-2020 08:23:05', 'Computer and Information Systems Manager', 'Web Design', 'Brown', 'image_02.jpg', '<h1>Computer and Information</h1>\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,\r\n<hr>\r\n when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,\r\n<h1>Lorem Ipsum is simply dummy text </h1>\r\n<hr>\r\n remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(4, 'September-21-2020 08:23:50', 'Computer and Information Research Scientist.', 'Technology', 'Amelia', 'image_08.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(5, 'September-21-2020 08:24:45', 'Computer Systems Analyst.', 'Web Design', 'Harry', 'image_02.jpg', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n<br>\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n<hr>\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.'),
(6, 'September-21-2020 08:25:38', 'Cloud Software and Network Engineer', 'Developement', 'Harry', 'image_03.jpg', 'Cloud computing engineers define, design, build, and maintain systems and solutions leveraging systems and infrastructure managed by cloud providers such as Amazon Web Services (AWS) and Microsoft Azure.'),
(7, 'September-21-2020 08:28:23', 'Computer Network Specialists', 'Technology', 'Anthony', 'image_06.jpg', 'Computer network specialists and analysts define, design, build, and maintain a variety of data communication networks and systems. They typically have a bachelor’s degree in computer science or a related field. Some also have a master’s degree in business administration (MBA), with a focus on information systems. Computer network architects can earn notably high salaries: the median salary is $109,020.\r\n\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"btn btn-primary\" style=\"border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box; min-width: 100% !important;\" width=\"100%\">\r\n  <tr>\r\n    <td align=\"center\" style=\"font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;\" valign=\"top\">\r\n      <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;\">\r\n        <tr>\r\n          <td style=\"font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;\" valign=\"top\" bgcolor=\"#3498db\" align=\"center\"> <a href=\"\" style=\"display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;\">Take action now</a> </td>\r\n        </tr>\r\n      </table>\r\n    </td>\r\n  </tr>\r\n</table>                           '),
(8, 'September-21-2020 08:37:25', 'Computer Support Specialist', 'Flutter', 'Amelia', 'image_05.jpg', 'Computer support specialists and network administrators help computer users and organizations. Some of these workers support computer networks by testing and evaluating network systems and ensuring that the day-to-day operations work.\r\n<hr>\r\n Others provide customer service by helping people with their computer problems. Some require a bachelor’s degree, while others need an associate degree or post-secondary classes.\r\n<hr>\r\n<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\r\n<html xmlns=\"https://www.w3.org/1999/xhtml\">\r\n<head>\r\n<title>Test Email Sample</title>\r\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />\r\n<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\" />\r\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0 \" />\r\n<style>\r\n<!---Text decoration removed -->\r\n.em_defaultlink a {\r\n	color: inherit !important;\r\n	text-decoration: none !important;\r\n<!---Media Query for desktop layout -->\r\n@media only screen and (min-width:481px) and (max-width:699px) {\r\n.em_main_table {\r\n	width: 100% !important;\r\n}\r\n.em_wrapper {\r\n	width: 100% !important;\r\n}\r\n.em_hide {\r\n	display: none !important;\r\n}\r\n.em_img {\r\n	width: 100% !important;\r\n	height: auto !important;\r\n}\r\n.em_h20 {\r\n	height: 20px !important;\r\n}\r\n.em_padd {\r\n	padding: 20px 10px !important;\r\n}\r\n}\r\n@media screen and (max-width: 480px) {\r\n.em_main_table {\r\n	width: 100% !important;\r\n}\r\n.em_wrapper {\r\n	width: 100% !important;\r\n}\r\n.em_hide {\r\n	display: none !important;\r\n}\r\n.em_img {\r\n	width: 100% !important;\r\n	height: auto !important;\r\n}\r\n.em_h20 {\r\n	height: 20px !important;\r\n}\r\n.em_padd {\r\n	padding: 20px 10px !important;\r\n}\r\n.em_text1 {\r\n	font-size: 16px !important;\r\n	line-height: 24px !important;\r\n}\r\nu + .em_body .em_full_wrap {\r\n	width: 100% !important;\r\n	width: 100vw !important;\r\n}\r\n}\r\n</style>\r\n</head>'),
(9, 'September-21-2020 09:33:28', 'Database Administrator', 'Java', 'Brown', 'image_07.jpg', 'Database administrators help store and organize data or companies and/or customers. They protect the data from unauthorized users. Some work for companies that provide computer design services. Others work for organizations with large database systems, such as educational institutions, financial firms, and more. These jobs are growing at a faster-than-average rate, with an expected 9% growth in jobs between 2018-2028.\r\n\r\nData Center Support Specialist\r\nData Quality Manager\r\nDatabase Administrator\r\nSenior Database Administrator'),
(10, 'September-21-2020 09:33:51', 'Information Technology Analysts', 'Java', 'Brown', 'image_08.jpg', 'IT analysts are responsible for designing and implementing organizational technology for businesses. They create solutions for collecting and analyzing market data, customer input, and client information.\r\n\r\nApplication Support Analyst\r\nSenior System Analyst\r\nSystems Analyst\r\nSystems Designer'),
(11, 'September-21-2020 09:35:04', 'Information Technology Leadership', 'Flutter', 'Richard', 'image_09.jpg', ' Leadership in IT draws from candidates with strong technology backgrounds and superior management skills. They have experience in creating and implementing policies and systems to meet IT objectives, and the ability to budget the time and funds necessary.\r\n<br>\r\n Leadership in IT draws from candidates with strong technology backgrounds and superior management skills. They have experience in creating and implementing policies and systems to meet IT objectives, and the ability to budget the time and funds necessary.\r\n<hr>\r\n Leadership in IT draws from candidates with strong technology backgrounds and superior management skills. They have experience in creating and implementing policies and systems to meet IT objectives, and the ability to budget the time and funds necessary.\r\n<hr>'),
(12, 'September-21-2020 09:35:32', 'Information Security Specialist', 'Java', 'Richard', 'image_10.jpg', ' The increased incidence of security breaches and the associated danger of identity theft has enhanced the importance of protecting data on commercial and governmental sites. Information security analysts help defend an organization’s computer network and computer systems.\r\n\r\nThey plan and carry out a variety of security measures, such as installing and using software, and simulating cyber-attacks to test systems. Information security jobs are expected to grow much faster than average, with an increase of 32% between 2018 and 2028.'),
(13, 'September-21-2020 09:37:06', 'Software/Application Developer', 'Developement', 'Anthony', 'image_01.jpg', 'Software developers design, run, and test various computer programs and applications. Application Developers create new applications and code solutions. They usually have a bachelor’s degree in computer science or a related field. They also have strong programming skills. Software developer jobs are expected to grow by about 21% from 2018-2028. The median salary of a software developer is $105,590.\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" class=\"btn btn-primary\" style=\"border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; box-sizing: border-box; min-width: 100% !important;\" width=\"100%\">\r\n  <tr>\r\n    <td align=\"center\" style=\"font-family: sans-serif; font-size: 14px; vertical-align: top; padding-bottom: 15px;\" valign=\"top\">\r\n      <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;\">\r\n        <tr>\r\n          <td style=\"font-family: sans-serif; font-size: 14px; vertical-align: top; background-color: #3498db; border-radius: 5px; text-align: center;\" valign=\"top\" bgcolor=\"#3498db\" align=\"center\"> <a href=\"\" style=\"display: inline-block; color: #ffffff; background-color: #3498db; border: solid 1px #3498db; border-radius: 5px; box-sizing: border-box; cursor: pointer; text-decoration: none; font-size: 14px; font-weight: bold; margin: 0; padding: 12px 25px; text-transform: capitalize; border-color: #3498db;\">Take action now</a> </td>\r\n        </tr>\r\n      </table>\r\n    </td>\r\n  </tr>\r\n</table>'),
(14, 'September-21-2020 10:51:39', 'Web Developer', 'Web Design', 'Amelia', 'image_11.jpg', ' Web developers design, create, and modify websites. They are responsible for maintaining a user-friendly, stable website that offers the necessary functionality for their client’s needs. Some jobs require a bachelor’s degree, while others need an associate degree, including classes in HTML, JavaScript, or SQL.'),
(15, 'September-21-2020 10:52:18', 'Tips for Job Searching', 'Flutter', 'Richard', 'image_12.jpg', 'If you are searching for positions in IT, it\'s helpful to take a look at a broad list of job titles so that your search can include all of the relevant roles. Browse through this list of IT job titles to see which ones are applicable for your job search.\r\n\r\nMost importantly, make sure that your resume displays the most sought-after industry skills relevant to your expertise.'),
(16, 'September-21-2020 10:53:57', 'Computer Programmer', 'Developement', 'Anthony', 'image_14.jpg', 'Computer programmers create, write, and test code that allows computer programs and applications to function. They typically need to know a variety of computer languages, including Java and C++. They might work for a computer systems design company, or they could work for software publishers or financial companies, among others. Because this work is done on the computer, many');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
