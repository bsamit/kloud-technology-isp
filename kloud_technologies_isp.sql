-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 01, 2025 at 04:25 AM
-- Server version: 10.6.22-MariaDB
-- PHP Version: 8.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kloudcom_isp_demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `bills`
--

CREATE TABLE `bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `purchase_package_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `bill_type` varchar(255) DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `billing_month` date NOT NULL,
  `last_payment_date` date DEFAULT NULL,
  `due_date` date NOT NULL,
  `status` enum('pending','paid','payment_pending','overdue','cancelled') NOT NULL DEFAULT 'pending',
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `message`, `created_at`, `updated_at`) VALUES
(1, 'RobertVap', 'ixutikob077@gmail.com', '83882697921', 'Hæ, ég vildi vita verð þitt.', '2025-02-05 04:56:20', '2025-02-05 04:56:20'),
(2, 'TedVap', 'moqagides18@gmail.com', '81283887339', 'Sveiki, es gribēju zināt savu cenu.', '2025-02-08 16:53:42', '2025-02-08 16:53:42'),
(3, 'RobertVap', 'ixutikob077@gmail.com', '88494599891', 'Прывітанне, я хацеў даведацца Ваш прайс.', '2025-02-09 00:56:36', '2025-02-09 00:56:36'),
(4, 'JohnVap', 'anepivepaz038@gmail.com', '83632119771', 'Γεια σου, ήθελα να μάθω την τιμή σας.', '2025-02-10 18:49:21', '2025-02-10 18:49:21'),
(5, 'MiaVap', 'yawiviseya67@gmail.com', '82263119574', 'Hallo, ek wou jou prys ken.', '2025-02-11 09:45:57', '2025-02-11 09:45:57'),
(6, 'RobertVap', 'ibucezevuda439@gmail.com', '83443924873', 'Hallo, ek wou jou prys ken.', '2025-02-13 23:48:42', '2025-02-13 23:48:42'),
(7, 'OliviaVap', 'ebojajuje04@gmail.com', '85671123325', 'Γεια σου, ήθελα να μάθω την τιμή σας.', '2025-02-14 09:54:50', '2025-02-14 09:54:50'),
(8, 'GeorgeVap', 'ibucezevuda439@gmail.com', '81115567154', 'Kaixo, zure prezioa jakin nahi nuen.', '2025-02-16 09:14:19', '2025-02-16 09:14:19'),
(9, 'TedVap', 'ocopesuq299@gmail.com', '86831726494', 'Hola, volia saber el seu preu.', '2025-02-16 18:28:08', '2025-02-16 18:28:08'),
(10, 'RobertVap', 'aferinohis056@gmail.com', '82961686726', 'Здравейте, исках да знам цената ви.', '2025-02-16 23:03:00', '2025-02-16 23:03:00'),
(11, 'GeorgeVap', 'ocopesuq299@gmail.com', '86721423434', 'Hi, ego volo scire vestri pretium.', '2025-02-17 00:27:19', '2025-02-17 00:27:19'),
(12, 'Max Lammertink', 'max@talosgrowth.nl', '5302362130', 'Hey!\r\n\r\nComing across your LinkedIn company page on linkedin.com/company/kloud-technologies I was surprised about how good your content is and why you don\'t have more followers on the page. Your page should at least grow with 250 - 500 followers per month right? If not, you might currently not be reaching the right audience.\r\n\r\nWith Talos Growth we grow your company page on LinkedIn by liking posts from other companies and individuals that are interested in your business on behalf of your company page.\r\n\r\nThis way, you\'re generating exposure and genuine followers, who are interested in your business. Of course, you define the keywords, location, and other parameters yourself.\r\n\r\nFollowers eventually turn into customers, clients, or even employees. \r\n\r\nWould you like to use our two-week free trial to experience Talos Growth? You can directly signup at https://talosgrowth.com. Since I really see some potential for your page, you can use your personal code ‘kloud-technologies-10’ to get a 10% discount for the first 3 months. \r\n\r\nPlease let me know if you’ve questions or check out https://talosgrowth.com.\r\n\r\nMax', '2025-02-18 14:36:51', '2025-02-18 14:36:51'),
(13, 'Piper Holland', 'nwn.pho.e.nix@googlemail.com', '06025516607', 'We\'ve got a large amount of Bitcoin kept in offline storage , and we happen to be part of a group of investors who were awarded exclusive contracts through the U.S. Government Bitcoin Reserve. Go to this page to follow where regulatory updates are going https://bitcoinreservemonitor.com\r\n\r\nWe\'re looking for claim holders to assist us in operations execute our part of this deal. We\'ve got a restricted quantity Bitcoin bought years ago. . .thus, the claim slots are scarce. Stake sizes are available in 100 USD or 1000 USD. The initial claim is held for a period of ten days , upon completion your payout will be $200 or $2,000 - withdraw anytime you choose and whatever sum you prefer beyond that. You have the option to reinvest that yield each 10-day period for a maximum of 90 days. Take action quickly, as we are waiving any associated fees and taxes while absorbing taxes and charges on our end. Reach out to us to get started.\r\n\r\nNate\r\n+1 (602) 551-6607 Text and WhatsApp\r\n\r\nnathan.unger@sharepoint.us.com\r\n\r\nUnger Cleaning Products | Cleaning Tools for Professionals\r\n\r\nEuropean company now manufacturing solely in the US!', '2025-02-22 18:33:41', '2025-02-22 18:33:41'),
(14, 'Kellye Macintosh', 'check-message-text6083@monkeydigital.co', '8446592204', 'Hello,  \r\n\r\nThis is Mike Macintosh from Monkey Digital,  \r\nI am contacting you regarding a exciting opportunity.  \r\n\r\nHow would you like to show our ads on your site and link back via your personalized tracking link towards high-demand products from our platform?  \r\n\r\nThis way, you make a solid 35% commission, month after month from any purchases that are made from your website.  \r\n\r\nThink about it, all businesses need SEO, so this is a big opportunity.  \r\n\r\nWe already have thousands of affiliates and our payments are processed monthly.  \r\nRecently, we reached $27280 in commissions to our partners.  \r\n\r\nIf you want in, kindly chat with us here:  \r\nhttps://monkeydigital.co/affiliates-whatsapp/  \r\n\r\nOr register today:  \r\nhttps://www.monkeydigital.co/join-our-affiliate-program/  \r\n\r\nCheers,  \r\nMike Macintosh  \r\nMonkey Digital\r\nPhone/whatsapp: +1 (775) 314-7914', '2025-02-24 15:28:27', '2025-02-24 15:28:27'),
(15, 'Felicity Sauncho', 'felicitysauncho02@gmail.com', '8055326261', 'Hi there,\r\n\r\nWe run a YouTube growth service, which increases your number of subscribers both safely and practically.\r\n\r\n- We guarantee to gain you 700-1500+ subscribers per month.\r\n- People subscribe because they are interested in your channel/videos, increasing likes, comments and interaction.\r\n- All actions are made manually by our team. We do not use any \'bots\'.\r\n\r\nThe price is just $60 (USD) per month, and we can start immediately.\r\n\r\nIf you have any questions, let me know, and we can discuss further.\r\n\r\nKind Regards,\r\nFelicity', '2025-03-09 02:27:10', '2025-03-09 02:27:10'),
(16, 'Richard Dupree', 'anna@stafir-platform.com', '267559225', 'Hello,\r\n\r\nCould you please share your offer along with pricing details if available? Seend me message on my Whatsapp +48 509 420 371.  We are very interested and looking forward to your response.\r\n\r\nBest regards', '2025-03-09 10:17:24', '2025-03-09 10:17:24'),
(17, 'Jovita Alston', 'anna@stafir-platform.com', '29670342', 'Hello,\r\n\r\nCould you please share your offer along with pricing details if available? Seend me message on my Whatsapp +48 792 311 834.  We are very interested and looking forward to your response.\r\n\r\nBest regards', '2025-03-18 07:56:39', '2025-03-18 07:56:39'),
(18, 'Charlene Marcum', 'info@digital-x-press.com', '3461801149', 'Greetings,  \r\n\r\nI realize that many find it challenging accepting that SEO requires time and a strategic monthly approach.  \r\n\r\nSadly, very few webmasters have the determination to wait for the gradual yet impactful trends that can completely change their online presence.  \r\n\r\nWith constant search engine updates, a steady, long-term strategy is necessary for securing a high return on investment.  \r\n\r\nIf you believe this as the best strategy, give us a try!  \r\n\r\nDiscover Our Monthly SEO Services  \r\nhttps://www.digital-x-press.com/unbeatable-seo/  \r\n\r\nReach Out on Instant Messaging  \r\nhttps://www.digital-x-press.com/whatsapp-us/  \r\n\r\nWe deliver measurable growth for your marketing budget, and you will appreciate choosing us as your digital agency.  \r\n\r\nBest regards,  \r\nDigital X SEO Experts  \r\nPhone/WhatsApp: +1 (844) 754-1148', '2025-03-29 09:55:28', '2025-03-29 09:55:28'),
(19, 'TedVap', 'aferinohis056@gmail.com', '86922548526', 'Salam, qiymətinizi bilmək istədim.', '2025-03-30 14:08:50', '2025-03-30 14:08:50'),
(20, 'Ellis Hinchcliffe', 'ellis.hinchcliffe@msn.com', '4095484311', 'Hi there,\r\n\r\nI wanted to introduce you to our Viral Quiz AI app that transforms single keywords into hundreds of engaging quiz videos in minutes.\r\n\r\nOur proprietary \"3E Formula\" (Engage, Excite, Explode) creates content that social algorithms love, helping you:\r\n\r\nGenerate massive traffic to your websites and offers.\r\nCreate viral content for YouTube, Instagram, and TikTok\r\nStand out in any niche with unique, addictive quiz videos\r\nIncrease conversions and engagement rates\r\n\r\nThe process is incredibly simple:\r\n\r\n1. Enter a keyword.\r\n2. Select from our professional templates.\r\n3. Customize and publish directly to your social platforms.\r\n\r\nThe price? Just $17.95.\r\n\r\nLearn more: https://furtherinfo.info/viralquiz\r\n\r\nThank you for your time,\r\nEllis', '2025-04-01 05:48:53', '2025-04-01 05:48:53'),
(21, 'Samuel Fagan', 'samuel.fagan@yahoo.com', '7140522117', 'Hi there,\r\n\r\nWe wanted to introduce you to a revolutionary system that helps you create AI-powered tools to generate steady, qualified leads without paid advertising.\r\n\r\nKey benefits:\r\n\r\nCreate AI tools in minutes with simple copy/paste templates \r\nDrive free, targeted traffic to any niche or offer  \r\nBuilt-in call-to-action system to funnel leads to your sales pages \r\nNo coding or technical experience needed\r\n\r\nWe\'re currently offering a special launch price of $17 (regular $97) which includes bonus training on traffic generation and AI monetization.\r\n\r\nFor more details, check out: https://furtherinfo.info/etb\r\n\r\nThanks,\r\nSamuel', '2025-04-01 17:34:24', '2025-04-01 17:34:24'),
(22, 'Amelia Brown', 'ameliabrown5812@gmail.com', '267331530', 'Hi there,\r\n\r\nWe run a YouTube growth service, which increases your number of subscribers both safely and practically.\r\n\r\n- We guarantee to gain you 700-1500+ subscribers per month.\r\n- People subscribe because they are interested in your channel/videos, increasing likes, comments and interaction.\r\n- All actions are made manually by our team. We do not use any \'bots\'.\r\n- Channel Creation: If you haven\'t started your YouTube journey yet, we can create a professional channel for you as part of your initial order.\r\n\r\nThe price is just $60 (USD) per month, and we can start immediately.\r\n\r\nIf you have any questions, let me know, and we can discuss further.\r\n\r\nKind Regards,\r\nAmelia', '2025-04-03 18:11:55', '2025-04-03 18:11:55'),
(23, 'Prestonpoubs', 'prestondjs@gmail.com', '89771457166', 'Hello, \r\n \r\nExclusive promo quality music for DJs https://0daymusic.org \r\nMP3/FLAC, label, music videos. Fans giving you full access to exclusive electronic, rap, rock, trance, dance... music. \r\n \r\n0day team.', '2025-04-06 16:38:51', '2025-04-06 16:38:51'),
(24, 'Joanna Riggs', 'joannariggs94@gmail.com', '9231734031', 'Hi,\r\n\r\nI just visited kloud.com.bd and wondered if you\'d ever thought about having an engaging video to explain what you do?\r\n\r\nOur prices start from just $195.\r\n\r\nLet me know if you\'re interested in seeing samples of our previous work.\r\n\r\nRegards,\r\nJoanna\r\n\r\nUnsubscribe: https://removeme.live/unsubscribe.php?d=kloud.com.bd', '2025-04-17 00:37:43', '2025-04-17 00:37:43'),
(25, 'Ethan Weidner', 'weidner.ethan@msn.com', '3270167276', 'We are currently seeking companies like yours for a potential long-term partnership. Could you kindly share your product offerings along with pricing details? Please  contact me on WhatsApp: +44 758 789 0515', '2025-04-19 17:18:36', '2025-04-19 17:18:36'),
(26, 'Ryan Powell', 'faunce.bart61@gmail.com', '6103542945', 'Dear Business Owner,\r\n\r\nAre you often on the road for business?\r\n\r\nA lot of companies still pay a lot on roaming fees.  \r\nWe offer a modern solution with worldwide eSIM plans — 100% virtual, easy to set up, and up to 85% cheaper.\r\n\r\nGreat for remote teams.\r\n\r\nLearn more: https://e-simworldwide.com\r\n\r\nKind regards,\r\ne-SIM Worldwide', '2025-04-27 21:11:23', '2025-04-27 21:11:23'),
(27, 'CharlieVap', 'yawiviseya67@gmail.com', '81759681279', 'Salam, qiymətinizi bilmək istədim.', '2025-05-21 12:48:32', '2025-05-21 12:48:32'),
(28, 'Yahya Khan', 'lilegod528@betzenn.com', '01600000000', 'Hello, please provide the FTP server link.', '2025-05-23 16:46:42', '2025-05-23 16:46:42'),
(29, 'SimonVap', 'yawiviseya67@gmail.com', '89684745264', 'Hi, ego volo scire vestri pretium.', '2025-06-02 10:10:49', '2025-06-02 10:10:49'),
(30, 'aa', 'job.ovijit@gmail.com', '01973750015', 'test', '2025-06-26 07:53:31', '2025-06-26 07:53:31'),
(31, 'Ovijit Shaha', 'job.ovijit@gmail.com', '01973750015', 'hi', '2025-06-29 10:19:09', '2025-06-29 10:19:09'),
(32, 'Ovijit Shaha', 'job.ovijit@gmail.com', '01973750015', 'test', '2025-06-29 10:19:48', '2025-06-29 10:19:48');

-- --------------------------------------------------------

--
-- Table structure for table `custom_orders`
--

CREATE TABLE `custom_orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `details` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `attachment` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_settings`
--

CREATE TABLE `email_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mail_mailer` varchar(255) NOT NULL DEFAULT 'smtp',
  `mail_host` varchar(255) NOT NULL,
  `mail_port` varchar(255) NOT NULL,
  `mail_username` varchar(255) NOT NULL,
  `mail_password` varchar(255) NOT NULL,
  `mail_encryption` varchar(255) NOT NULL DEFAULT 'tls',
  `mail_from_address` varchar(255) NOT NULL,
  `mail_from_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `uuid` char(36) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `title`, `description`, `status`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 1, '1e48732c-5da0-466e-b4b7-6e59e24a4f90', '2025-06-01 13:05:15', '2025-06-01 13:05:06', '2025-06-01 13:05:15');

-- --------------------------------------------------------

--
-- Table structure for table `helpdesk_categories`
--

CREATE TABLE `helpdesk_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `helpdesk_category_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_02_04_create_solution_categories_table', 1),
(7, '2024_02_04_create_solutions_table', 1),
(8, '2025_01_03_044827_create_permission_tables', 1),
(9, '2025_01_04_062705_create_package_categories_table', 1),
(10, '2025_01_04_082908_create_packages_table', 1),
(11, '2025_01_04_082921_create_package_details_table', 1),
(12, '2025_01_08_203204_create_helpdesk_categories_table', 1),
(13, '2025_01_11_055902_create_tickets_table', 1),
(14, '2025_01_13_035819_create_potential_customers_table', 1),
(15, '2025_01_14_054925_create_faqs_table', 1),
(16, '2025_01_14_182952_create_ticket_replies_table', 1),
(17, '2025_01_15_041149_create_services_table', 1),
(18, '2025_01_15_155958_create_contacts_table', 1),
(19, '2025_01_15_161917_create_custom_orders_table', 1),
(20, '2025_01_19_074306_create_purchase_packages_table', 1),
(21, '2025_01_26_101510_create_bills_table', 1),
(22, '2025_01_26_101511_create_payments_table', 1),
(23, '2025_01_27_061656_create_package_requests_table', 1),
(24, '2025_01_28_121824_create_service_details_table', 1),
(25, '2025_01_30_142020_create_email_settings_table', 1),
(26, '2025_01_31_190635_create_site_settings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_catgory_id` varchar(255) NOT NULL,
  `plan_name` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `speed` varchar(255) DEFAULT NULL,
  `monthly_cost` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `package_catgory_id`, `plan_name`, `title`, `speed`, `monthly_cost`, `status`, `deleted_at`, `created_at`, `updated_at`, `uuid`) VALUES
(3, '1', 'Advanced 20 Mbps', 'Residential 20 Mbps Plan', '20 Mbps', '800', 1, NULL, '2025-03-16 07:19:09', '2025-06-15 08:41:27', '1cf7500f-b6ac-4706-93de-5d0028dcf01d'),
(4, '1', 'Premium 50 Mbps', 'Residential 50 Mbps Plan', '50 Mbps', '2000', 1, NULL, '2025-03-16 07:20:56', '2025-06-15 08:41:43', 'b56956fe-87f0-49fd-8d3d-885ab4ce82fb'),
(5, '2', 'Enterprise Silver', 'Business 100 Mbps Plan', '100 Mbps', '20000', 1, NULL, '2025-03-16 07:26:45', '2025-03-16 07:26:45', '71f3e282-1966-45ec-8851-2db8d1cf8df4'),
(6, '2', 'Enterprise Gold', 'Business 200 Mbps Plan', '200 Mbps', '30000', 1, NULL, '2025-03-16 07:27:40', '2025-03-16 07:27:50', '64404ce3-5cd1-4046-acf5-a4169207c101'),
(7, '2', 'enterprise Platinum', 'Business 500 Mbps Plan', '500 Mbps', '50000', 1, NULL, '2025-03-16 07:30:01', '2025-03-16 07:30:01', 'd39147e6-d777-4a39-b591-f62b419e1e2d'),
(8, '2', 'Enterprise Diamond', 'Business 1 Gbps Plan', '1 GB', '80000', 1, NULL, '2025-03-16 07:30:57', '2025-03-16 07:30:57', '05c4c6da-f8b3-451d-be09-0fd1e55b1366'),
(10, '1', 'Basic 10 Mbps', 'Residential 10 Mbps Plan', '10 Mbps', '500', 1, NULL, '2025-05-24 06:12:20', '2025-05-24 06:12:20', '4363f158-17bc-4aaf-95f4-ac98919311ac');

-- --------------------------------------------------------

--
-- Table structure for table `package_categories`
--

CREATE TABLE `package_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_categories`
--

INSERT INTO `package_categories` (`id`, `name`, `status`, `deleted_at`, `created_at`, `updated_at`, `uuid`) VALUES
(1, 'Residential Packages', 1, NULL, '2025-02-04 09:00:19', '2025-02-04 09:00:19', '72acda8e-828f-45eb-8209-11060b261ff1'),
(2, 'Business Packages', 1, NULL, '2025-02-04 09:00:19', '2025-02-04 09:00:19', '3c856b57-5c18-4cff-ad9f-f622ac0b6584');

-- --------------------------------------------------------

--
-- Table structure for table `package_details`
--

CREATE TABLE `package_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_details`
--

INSERT INTO `package_details` (`id`, `package_id`, `name`, `value`, `deleted_at`, `created_at`, `updated_at`, `uuid`) VALUES
(1, '1', NULL, NULL, '2025-03-16 07:23:05', '2025-03-16 07:17:06', '2025-03-16 07:23:05', '64e9f30a-0a2a-4a03-98a7-73d9798fe75a'),
(2, '2', NULL, NULL, '2025-03-16 07:23:34', '2025-03-16 07:18:31', '2025-03-16 07:23:34', 'a42bb28b-cc6c-4b43-98a9-dc8f62a123cd'),
(3, '3', NULL, NULL, '2025-03-16 07:24:05', '2025-03-16 07:19:09', '2025-03-16 07:24:05', '67cc0218-cefc-4032-9476-281e0db4f616'),
(4, '4', NULL, NULL, '2025-03-16 07:24:23', '2025-03-16 07:20:56', '2025-03-16 07:24:23', '5945f19a-546d-4575-88d9-0bbed32c39ad'),
(5, '1', 'Suitable for basic browsing and video streaming', NULL, '2025-05-20 07:40:30', '2025-03-16 07:23:05', '2025-05-20 07:40:30', '65d2ae63-6e5a-4b83-9ea3-3961a72d4644'),
(6, '2', 'Ideal for families, HD streaming, online classes', NULL, '2025-05-20 07:41:37', '2025-03-16 07:23:34', '2025-05-20 07:41:37', 'aa83392b-aa1a-4514-bc42-42aa5c790c3f'),
(7, '3', 'Fast speeds for HD streaming and remote work', NULL, '2025-05-20 08:05:40', '2025-03-16 07:24:05', '2025-05-20 08:05:40', '3033a3e4-b0f7-4b9f-a2c6-40bf2d473ef6'),
(8, '4', 'Heavy internet use, gaming, and smart home devices', NULL, '2025-06-15 08:41:43', '2025-03-16 07:24:23', '2025-06-15 08:41:43', '2a817392-78cf-4a5b-9f37-2b92aaaaa4b5'),
(9, '5', 'Suitable for data-heavy operations', NULL, NULL, '2025-03-16 07:26:45', '2025-03-16 07:26:45', '90c2bcfe-efa9-4be6-8291-297da110c77e'),
(10, '6', 'Priority support and guaranteed uptime', NULL, '2025-03-16 07:27:50', '2025-03-16 07:27:40', '2025-03-16 07:27:50', '4a20ce16-3894-4b95-8649-d187348727a9'),
(11, '6', 'Priority support and guaranteed uptime', NULL, NULL, '2025-03-16 07:27:50', '2025-03-16 07:27:50', '3b240c1f-24bd-4523-9bdd-d3ff6ca3846d'),
(12, '7', 'Ideal for large organizations with high-speed needs', NULL, NULL, '2025-03-16 07:30:01', '2025-03-16 07:30:01', 'bac4700a-13a4-4b93-aa3d-1ad48f93ab24'),
(13, '8', 'Dedicated connectivity with premium support', NULL, NULL, '2025-03-16 07:30:57', '2025-03-16 07:30:57', '1eebf323-cbd1-4d06-8f1f-f7b36f03e8b4'),
(14, '9', NULL, NULL, '2025-04-20 10:44:56', '2025-04-20 10:44:07', '2025-04-20 10:44:56', '7cc0650c-85bb-47aa-9ffa-bc6f795cd752'),
(15, '9', 'Kloud', NULL, '2025-05-21 05:54:25', '2025-04-20 10:44:56', '2025-05-21 05:54:25', '154a379c-5bb2-4a06-8246-9e897da3e5e9'),
(16, '1', 'Suitable for basic browsing and video streaming', NULL, '2025-05-20 07:41:07', '2025-05-20 07:40:30', '2025-05-20 07:41:07', '34312ad6-0a95-408d-8e55-7ce6ecf36b7b'),
(17, '1', 'Suitable for basic browsing and video streaming', NULL, '2025-05-20 07:41:47', '2025-05-20 07:41:07', '2025-05-20 07:41:47', 'a77349ca-7e5c-4874-96ab-f10fb36f87b0'),
(18, '2', 'Ideal for families, HD streaming, online classes', NULL, NULL, '2025-05-20 07:41:37', '2025-05-20 07:41:37', 'c03aef03-11d2-4b07-b58a-57136029d128'),
(19, '1', 'Suitable for basic browsing and video streaming', NULL, '2025-05-24 06:05:30', '2025-05-20 07:41:47', '2025-05-24 06:05:30', 'eb45f724-a742-4b6a-9d91-63ea083f20e7'),
(20, '3', 'Fast speeds for HD streaming and remote work', NULL, '2025-06-15 08:41:27', '2025-05-20 08:05:40', '2025-06-15 08:41:27', 'b1b94cd1-c992-41cd-9021-a9accf6963db'),
(21, '9', 'Kloud', NULL, '2025-05-24 06:03:04', '2025-05-21 05:54:25', '2025-05-24 06:03:04', '991913af-f813-45bb-bb0b-3f8c03abc556'),
(22, '9', 'Kloud', NULL, '2025-05-24 06:03:31', '2025-05-24 06:03:04', '2025-05-24 06:03:31', '798c8b9f-19f5-49b9-8f62-27f500fc6405'),
(23, '9', 'Kloud', NULL, '2025-05-24 06:04:28', '2025-05-24 06:03:31', '2025-05-24 06:04:28', 'd8208e05-2fed-4453-8a99-5318ef0bcfa7'),
(24, '9', 'Kloud', NULL, '2025-05-24 06:09:12', '2025-05-24 06:04:28', '2025-05-24 06:09:12', '3afa04e9-d73f-4bde-a817-4fae2bf41ce2'),
(25, '1', 'Suitable for basic browsing and video streaming', NULL, NULL, '2025-05-24 06:05:30', '2025-05-24 06:05:30', '9dd39a19-eecb-49f2-aadb-d63871d619c7'),
(26, '9', 'Kloud', NULL, '2025-05-24 06:10:06', '2025-05-24 06:09:12', '2025-05-24 06:10:06', 'ab9cd928-be25-4846-a99e-71bcce5242c1'),
(27, '9', 'Kloud', NULL, NULL, '2025-05-24 06:10:06', '2025-05-24 06:10:06', '927fef6c-0f67-4281-8b8a-e5d7572a6a5e'),
(28, '10', NULL, NULL, NULL, '2025-05-24 06:12:20', '2025-05-24 06:12:20', 'c07fc61e-df6a-4b53-be56-d7b95d934a2d'),
(29, '3', 'Fast speeds for HD streaming and remote work', NULL, NULL, '2025-06-15 08:41:27', '2025-06-15 08:41:27', 'f2914cc6-d9d3-463d-ae4d-d8b2e61dad14'),
(30, '4', 'Heavy internet use, gaming, and smart home devices', NULL, NULL, '2025-06-15 08:41:43', '2025-06-15 08:41:43', '29c156fd-9608-45b1-8ae1-f343e242cc8e');

-- --------------------------------------------------------

--
-- Table structure for table `package_requests`
--

CREATE TABLE `package_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `package_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `payment_status` enum('not_paid','paid') NOT NULL DEFAULT 'not_paid',
  `note` text DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `rejected_at` timestamp NULL DEFAULT NULL,
  `rejection_reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` char(36) NOT NULL,
  `bill_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` enum('cash','bank_transfer','mobile_banking') NOT NULL DEFAULT 'cash',
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_proof` text DEFAULT NULL,
  `note` text DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `approved_by` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `label` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `menu`, `name`, `guard_name`, `label`, `created_at`, `updated_at`) VALUES
(1, 'Potential Customer', 'create_potential_customer', 'web', 'Create Potential Customer', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(2, 'Potential Customer', 'view_potential_customer', 'web', 'view Potential Customer', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(3, 'Potential Customer', 'edit_potential_customer', 'web', 'Edit Potential Customer', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(4, 'Potential Customer', 'delete_potential_customer', 'web', 'Delete Potential Customer', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(5, 'Manage Customer', 'create_manage_customer', 'web', 'Create Manage Customer', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(6, 'Manage Customer', 'view_manage_customer', 'web', 'view Manage Customer', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(7, 'Manage Customer', 'edit_manage_customer', 'web', 'Edit Manage Customer', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(8, 'Manage Customer', 'delete_manage_customer', 'web', 'Delete Manage Customer', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(9, 'Package', 'create_package', 'web', 'Create Package', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(10, 'Package', 'view_package', 'web', 'view Package', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(11, 'Package', 'edit_package', 'web', 'Edit Package', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(12, 'Package', 'delete_package', 'web', 'Delete Package', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(13, 'Staff', 'create_staff', 'web', 'Create Staff', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(14, 'Staff', 'view_staff', 'web', 'view Staff', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(15, 'Staff', 'edit_staff', 'web', 'Edit Staff', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(16, 'Staff', 'delete_staff', 'web', 'Delete Staff', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(17, 'Role', 'create_role', 'web', 'Create Role', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(18, 'Role', 'view_role', 'web', 'view Role', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(19, 'Role', 'edit_role', 'web', 'Edit Role', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(20, 'Role', 'delete_role', 'web', 'Delete Role', '2025-02-04 09:00:19', '2025-02-04 09:00:19');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `potential_customers`
--

CREATE TABLE `potential_customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `otp` varchar(255) DEFAULT NULL,
  `otp_time` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `potential_customers`
--

INSERT INTO `potential_customers` (`id`, `name`, `email`, `mobile`, `address`, `password`, `is_active`, `otp`, `otp_time`, `created_at`, `updated_at`, `uuid`) VALUES
(3, 'a', 'a@email.com', '01500000000', 'dhaka', '12345678', 2, NULL, NULL, '2025-05-07 04:55:10', '2025-05-07 04:55:20', '5248055a-5e35-44af-ae00-9909d6fbfdf2'),
(4, 'Abdilla', 'abfdkufkoyy@gmail.com', '01600000000', 'Dhaka, bangladesh', '59759669', 1, '151207', NULL, '2025-05-26 13:31:43', '2025-05-26 13:31:43', '9cee6488-bb2b-4b5c-ae36-88201a0eda27'),
(6, 'Abdulla Al Nadir', 'abdullaalnadir940@gmail.com', '01613105455', 'Sylhet, 3108,Golapgonj, Sylhet', '01613105455', 2, NULL, NULL, '2025-05-26 17:54:09', '2025-05-26 17:54:37', '4adffa4d-d86c-4b5e-be2d-bd817dd1d3b9'),
(7, 'asdasd', 'vickyolive@e-record.com', '01700000000', 'asdas', 'A102013aa', 1, '961007', NULL, '2025-06-07 11:44:38', '2025-06-07 11:44:38', '13853547-ea1b-4b8a-9df6-6029ea3d185c'),
(15, 'My account is', 'mdniloysongs@gmail.com', '01725659200', 'Rajshahi charghat 6271', '1567915679', 1, '012114', NULL, '2025-06-16 19:09:26', '2025-06-16 19:09:26', '8bac9e04-5f77-4179-a381-b6efe0c8e022'),
(16, 'Apurbo', 'apurbomondol15@gmail.com', '01708069644', '7320', '@12345678', 2, NULL, NULL, '2025-06-21 04:59:14', '2025-06-21 05:00:55', 'dd8bc9a6-34e8-48c7-8f10-70d72a1e355f');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_packages`
--

CREATE TABLE `purchase_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `package_id` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `last_payment_date` date NOT NULL,
  `monthly_fee` decimal(10,2) DEFAULT NULL,
  `setup_fee` decimal(10,2) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `uuid` char(36) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(2, 'Admin', 'web', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(3, 'Staff', 'web', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(4, 'Customer', 'web', '2025-02-04 09:00:19', '2025-02-04 09:00:19'),
(5, 'NOC Admin', 'web', '2025-05-28 06:18:27', '2025-05-28 06:18:27'),
(6, 'Billing Manager', 'web', '2025-06-29 10:24:10', '2025-06-29 10:24:10');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 1),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 1),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 2),
(19, 1),
(19, 2),
(20, 1),
(20, 2);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `uuid` char(36) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `title`, `description`, `image`, `status`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'High-Speed Broadband Internet', 'Reliable and scalable internet connectivity with speeds ranging from 100 Mbps to multiple Gbps for residential and business users.', 'images/uploads/services/1740167842_C59t64JD3c.jpg', 1, '05d2e07f-62c3-455b-9e42-62d890bc0d54', NULL, '2025-02-21 19:57:22', '2025-02-21 19:57:22'),
(2, 'Infrastructure Solutions', 'Kloud Technologies provides enterprise-grade infrastructure solutions to support businesses with scalable and reliable IT environments.\r\n\r\n1. Enterprise Server Solutions: High-performance servers designed for mission-critical applications, virtualization, and data processing.\r\n\r\n2. Enterprise Storage Solutions: Scalable and secure storage systems for structured and unstructured data management.\r\n\r\n3. Power & Cooling Solutions: Optimized energy-efficient solutions for data centers and IT infrastructure.\r\n\r\n4. Data Center Solutions: Advanced data center design, implementation, and management to ensure business continuity.\r\n\r\n5. Virtualization & Cloud Solutions: Enabling businesses to optimize resources and increase efficiency through virtualization and cloud-based solutions.', 'images/uploads/services/1740548732_aadoEWX9wT.jpg', 1, '21e2e592-0305-427c-9c34-7ba83b525dc6', NULL, '2025-02-26 05:45:32', '2025-02-26 05:54:04'),
(3, 'Network Services', 'Kloud Technologies ensures seamless and secure connectivity with a wide range of networking services:\r\n\r\n1. Network Design & Architecture: Custom network solutions to ensure reliability and high performance.\r\n\r\n2. Network Implementation: deployment of networking hardware and software tailored to business needs.\r\n\r\n3. Network Security Solutions: Protecting business networks with firewalls, intrusion detection, and security protocols.\r\n\r\n4. Wireless & Mobility Solutions: Enabling mobility with secure wireless networks for offices and enterprise environments.\r\n\r\n5. Unified Communications: Integration of multiple communication channels such as VoIP, video conferencing, and messaging for enhanced collaboration.', 'images/uploads/services/1740549485_7uC4rHZWx4.jpg', 1, '435fa5a1-e93e-42e9-a896-c149ac1b8f0a', NULL, '2025-02-26 05:58:05', '2025-02-26 05:58:05'),
(4, 'Managed IT Services', 'Kloud Technologies provides end-to-end managed IT services to enhance business efficiency and security.\r\n\r\n1. IT Helpdesk Support: 24/7 assistance to resolve IT issues and ensure smooth operations.\r\n\r\n2. Server & Network Monitoring: Continuous performance monitoring to detect and prevent potential failures.\r\n\r\n3. Remote Infrastructure Management: Remote management of IT infrastructure to optimize performance and cost.\r\n\r\n4. Disaster Recovery & Business Continuity: Implementing backup and recovery plans to ensure business resilience.\r\n\r\n5. IT Consultancy: Offering expert advice on IT strategy, planning, and execution.', 'images/uploads/services/1740549663_ML12JyOAiT.jpg', 1, 'bb5beb47-e2b7-4246-8c1e-87cceae51e57', NULL, '2025-02-26 06:01:03', '2025-02-26 06:01:03'),
(5, 'Security Solutions', 'Kloud Technologies offers advanced security solutions to safeguard businesses from cyber threats:\r\n\r\n1. Cybersecurity Services: Implementation of security frameworks to prevent cyber threats and vulnerabilities.\r\n\r\n2. Data Encryption &amp; Protection: Ensuring sensitive business data is encrypted and protected against unauthorized access.\r\n\r\n3. Endpoint Security Solutions: Securing devices like computers, mobile phones, and servers from cyberattacks.\r\n\r\n4. Firewalls &amp; Intrusion Prevention Systems: Deploying enterprise-grade firewalls to prevent unauthorized access and mitigate risks.\r\n\r\n5. Surveillance Systems: CCTV and video surveillance for physical security.\r\n\r\n6. Biometric Systems: Access control and attendance tracking using biometric authentication.', 'images/uploads/services/1740550079_YWyEoXNZcm.jpg', 1, 'fa08718b-c3e8-4b19-94e1-b0415302c75a', NULL, '2025-02-26 06:07:59', '2025-02-26 06:29:18'),
(6, 'Enterprise Solutions', 'Kloud Technologies provides robust enterprise IT solutions, including:\r\n\r\n1. Data Center Solutions: High-performance, scalable data centers for business operations.\r\n\r\n2. Cloud Computing: Public, private, and hybrid cloud solutions for flexibility and scalability.\r\n\r\n3. Virtualization: Optimizing IT infrastructure with virtualized computing environments.\r\n\r\n4. Enterprise Resource Planning (ERP): Integrated business management software for operations, finance, and HR.\r\n\r\n5. Customer Relationship Management (CRM): Enhancing customer interactions and sales management.', 'images/uploads/services/1740550328_n5bnd4799O.jpg', 1, '402ce715-e5fe-48ad-aae1-80fd1ce14543', NULL, '2025-02-26 06:12:08', '2025-02-26 06:23:00'),
(7, 'Cloud Services', 'With a focus on cloud-first strategies, Kloud Technologies provides secure and scalable cloud services:\r\n\r\n1. Public and Private Cloud Solutions: Cloud computing models tailored to business needs.\r\n\r\n2. Cloud Migration Services: Helping businesses transition to the cloud with minimal disruption.\r\n\r\n3. Cloud Backup and Disaster Recovery: Secure cloud-based data backups to prevent data loss.\r\n\r\n4. Cloud Security: Implementing robust security measures to protect cloud assets.', 'images/uploads/services/1741029252_S2ih60RSHO.png', 1, '9b848eb1-4e07-4425-85fb-86a5356f1a7f', NULL, '2025-02-26 06:13:33', '2025-04-20 10:27:12'),
(8, 'Software Solutions', 'Providing essential software tools for productivity and efficiency:\r\n\r\n1. Business intelligence & analytics: data-driven insights for strategic decision-making.\r\n\r\n2. Custom Software Development: Tailor-made software solutions to meet business needs.\r\n\r\n3. Office Productivity Tools: Microsoft 365, Google Workspace, and similar applications.\r\n\r\n4. Design & Creativity Software: Adobe, Autodesk, and other industry-leading creative tools.', 'images/uploads/services/1740551289_sMClaMUWfg.jpg', 1, '0d7bbaa3-9f9f-4eac-b335-8c28156a0d01', NULL, '2025-02-26 06:28:09', '2025-02-26 06:28:09'),
(9, 'Consumer Electronics & Smart Devices', 'Enhancing digital lifestyles with:\r\n\r\n1. Smart Home Solutions: IoT-based home automation systems.\r\n\r\n2. Smart Devices: Phones, tablets, and wearables.\r\n\r\n3. Audio & Visual Equipment: High-quality projectors, speakers, and home theater systems.', 'images/uploads/services/1740551539_SsvwfH6cT6.jpg', 1, '71a71fe2-b811-4c4b-82e5-eb3379616949', NULL, '2025-02-26 06:32:19', '2025-02-26 06:32:19'),
(10, 'Professional Services', 'Expert IT support and consulting, including:\r\n\r\n1. IT Consultancy: Strategic guidance on IT planning and integration.\r\n\r\n2. Implementation Services: Deployment and integration of IT systems.\r\n\r\n3. Managed Services: Ongoing IT support and infrastructure maintenance.', 'images/uploads/services/1740551658_jZkM0cZnJe.jpg', 1, '2338ec56-729b-4ae0-adb9-b421bbacbf2e', NULL, '2025-02-26 06:34:18', '2025-02-26 06:34:18');

-- --------------------------------------------------------

--
-- Table structure for table `service_details`
--

CREATE TABLE `service_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `uuid` char(36) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_details`
--

INSERT INTO `service_details` (`id`, `service_id`, `title`, `description`, `uuid`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, '7b6aaf64-0d42-4d33-ab9e-1ae029a1f81d', NULL, '2025-02-21 19:57:22', '2025-02-21 19:57:22'),
(2, 2, NULL, NULL, '900a6ec5-1a1d-4bc3-8dc2-bf0be0959910', NULL, '2025-02-26 05:45:32', '2025-02-26 05:45:32'),
(3, 2, NULL, NULL, '7c1421ca-a1c8-42e6-9690-e2ccd35c7159', NULL, '2025-02-26 05:45:32', '2025-02-26 05:54:04'),
(4, 2, NULL, NULL, '7c4e2eb4-da11-4813-9e0d-3f43e32b01b1', NULL, '2025-02-26 05:54:04', '2025-02-26 05:54:04'),
(5, 3, NULL, NULL, '3e43484b-8f3d-411d-ac2f-a38e9bf8879b', NULL, '2025-02-26 05:58:05', '2025-02-26 05:58:05'),
(6, 4, NULL, NULL, 'ca701b57-d806-4e46-8235-3d669f4c609f', NULL, '2025-02-26 06:01:03', '2025-02-26 06:01:03'),
(7, 5, NULL, NULL, '80e4d0bf-f112-4d04-a44a-28c902d6dff3', NULL, '2025-02-26 06:07:59', '2025-02-26 06:29:18'),
(8, 6, NULL, NULL, '6aca936d-cf83-4bfe-8697-ef46d2f6abb4', NULL, '2025-02-26 06:12:08', '2025-02-26 06:23:00'),
(9, 7, NULL, NULL, '2afbd2c1-c999-4a1b-a03b-acc2635ec037', NULL, '2025-02-26 06:13:33', '2025-03-03 19:14:12'),
(10, 8, NULL, NULL, '30cc69f5-85f8-4f96-be60-2ada758b29e8', NULL, '2025-02-26 06:28:09', '2025-02-26 06:28:09'),
(11, 9, NULL, NULL, '0c7e5d50-01e0-4b40-aa98-0c1c63ff157d', NULL, '2025-02-26 06:32:19', '2025-02-26 06:32:19'),
(12, 10, NULL, NULL, 'c018047a-9118-417d-9476-3d70bed18580', NULL, '2025-02-26 06:34:18', '2025-02-26 06:34:18');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `company_main_logo` varchar(255) DEFAULT NULL,
  `company_mini_logo` varchar(255) DEFAULT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `copy_right_text` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `company_name`, `mobile`, `email`, `address`, `company_main_logo`, `company_mini_logo`, `favicon`, `copy_right_text`, `created_at`, `updated_at`) VALUES
(1, 'Nationwide ISP', '+8801710000000', 'email@gmail.com', 'Nationwide ISP, Dhaka, Bangladesh', 'images\\site\\logo.png', NULL, NULL, '© 2025 Nationwide ISP. All Rights Reserved.', '2025-02-04 09:00:19', '2025-02-04 09:00:19');

-- --------------------------------------------------------

--
-- Table structure for table `solutions`
--

CREATE TABLE `solutions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `solution_category_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `solution_categories`
--

CREATE TABLE `solution_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `solution_categories`
--

INSERT INTO `solution_categories` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'High-Speed Broadband Internet', 1, '2025-02-21 19:48:03', '2025-02-21 19:48:03');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `ticket_category_id` int(11) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `details` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `attachment` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ticket_replies`
--

CREATE TABLE `ticket_replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `details` text NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `nid` varchar(255) DEFAULT NULL,
  `salary` double DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `ref_details` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `uuid` char(36) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `mobile`, `role_id`, `gender_id`, `date_of_birth`, `nid`, `salary`, `father_name`, `mother_name`, `address`, `ref_details`, `status`, `email_verified_at`, `password`, `remember_token`, `deleted_at`, `created_at`, `updated_at`, `uuid`) VALUES
(1, 'Amit Saha', 'admin@gmail.com', '01733413080', 1, 1, NULL, '123-456-7890', 10000, 'Super Admin Father Name', 'Super Admin Mother Name', 'Admin Address', NULL, 1, NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Qsp3QDHOUDASjBBbSZrrOiU8L2lUe9wmoZWelbXW0cmAzOtbF6Lvoa5YP0ap', NULL, '2025-02-04 09:00:19', '2025-02-04 09:00:19', '38accfe8-b09f-4a2e-b2d0-91153a6e9170'),
(2, 'MD.MAIDUL AZIM', 'mashfi.azim@gmail.com', '01601820122', 2, 1, '1998-04-10', '5554397132', NULL, 'MD.ANWARUL AZIM', 'Shahin Afroz', 'House-40,Road-11,Sector-13,Uttara,Dhaka-1230', NULL, 1, NULL, '$2y$10$zup9EhDYtzrQD2HFlrUMmeR77gt4WuuePWwP4kGy7VRFg55qcYeh.', NULL, NULL, '2025-04-20 10:50:26', '2025-04-20 10:51:03', '48d33554-7cb0-4095-9dec-de8d6252757f'),
(3, 'Ovijit Shaha', 'job.ovijit@gmail.com', '01973750015', 3, 1, '2025-06-02', '6876106953', NULL, 'qs', NULL, 'The Eastern Transport Agency\r\nC\\O Moklesur Rahman, Navana Eastacy, House-6, Road-12(new), Flate-4C2 Dhanmondi,Dhaka-1207', NULL, 1, NULL, '$2y$10$utRo4lJhsO7H2tdstv2f.e2sDEuAGONkAsx/mH8CIC4DqNar27oAm', NULL, NULL, '2025-06-29 10:21:28', '2025-06-29 10:22:32', '45a9bbbc-7357-4157-a2d2-4f4dba1316b5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bills`
--
ALTER TABLE `bills`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bills_uuid_unique` (`uuid`),
  ADD KEY `bills_user_id_foreign` (`user_id`),
  ADD KEY `bills_package_id_foreign` (`package_id`),
  ADD KEY `bills_purchase_package_id_foreign` (`purchase_package_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_orders`
--
ALTER TABLE `custom_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_settings`
--
ALTER TABLE `email_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faqs_uuid_unique` (`uuid`);

--
-- Indexes for table `helpdesk_categories`
--
ALTER TABLE `helpdesk_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `packages_uuid_unique` (`uuid`);

--
-- Indexes for table `package_categories`
--
ALTER TABLE `package_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `package_categories_uuid_unique` (`uuid`);

--
-- Indexes for table `package_details`
--
ALTER TABLE `package_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `package_details_uuid_unique` (`uuid`);

--
-- Indexes for table `package_requests`
--
ALTER TABLE `package_requests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `package_requests_uuid_unique` (`uuid`),
  ADD KEY `package_requests_user_id_foreign` (`user_id`),
  ADD KEY `package_requests_package_id_foreign` (`package_id`),
  ADD KEY `package_requests_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payments_uuid_unique` (`uuid`),
  ADD KEY `payments_bill_id_foreign` (`bill_id`),
  ADD KEY `payments_user_id_foreign` (`user_id`),
  ADD KEY `payments_approved_by_foreign` (`approved_by`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `potential_customers`
--
ALTER TABLE `potential_customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `potential_customers_uuid_unique` (`uuid`);

--
-- Indexes for table `purchase_packages`
--
ALTER TABLE `purchase_packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `purchase_packages_uuid_unique` (`uuid`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `services_uuid_unique` (`uuid`);

--
-- Indexes for table `service_details`
--
ALTER TABLE `service_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_details_uuid_unique` (`uuid`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solutions`
--
ALTER TABLE `solutions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `solutions_solution_category_id_foreign` (`solution_category_id`);

--
-- Indexes for table `solution_categories`
--
ALTER TABLE `solution_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_uuid_unique` (`uuid`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bills`
--
ALTER TABLE `bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `custom_orders`
--
ALTER TABLE `custom_orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_settings`
--
ALTER TABLE `email_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `helpdesk_categories`
--
ALTER TABLE `helpdesk_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `package_categories`
--
ALTER TABLE `package_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `package_details`
--
ALTER TABLE `package_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `package_requests`
--
ALTER TABLE `package_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `potential_customers`
--
ALTER TABLE `potential_customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `purchase_packages`
--
ALTER TABLE `purchase_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `service_details`
--
ALTER TABLE `service_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `solutions`
--
ALTER TABLE `solutions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `solution_categories`
--
ALTER TABLE `solution_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ticket_replies`
--
ALTER TABLE `ticket_replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bills`
--
ALTER TABLE `bills`
  ADD CONSTRAINT `bills_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bills_purchase_package_id_foreign` FOREIGN KEY (`purchase_package_id`) REFERENCES `purchase_packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bills_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `package_requests`
--
ALTER TABLE `package_requests`
  ADD CONSTRAINT `package_requests_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `package_requests_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`),
  ADD CONSTRAINT `package_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_approved_by_foreign` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `payments_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `solutions`
--
ALTER TABLE `solutions`
  ADD CONSTRAINT `solutions_solution_category_id_foreign` FOREIGN KEY (`solution_category_id`) REFERENCES `solution_categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
