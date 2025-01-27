-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 27, 2025 at 10:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registration_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogcontact`
--

CREATE TABLE `blogcontact` (
  `name` varchar(400) DEFAULT NULL,
  `contact` varchar(400) DEFAULT NULL,
  `mail` varchar(400) DEFAULT NULL,
  `message` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogcontact`
--

INSERT INTO `blogcontact` (`name`, `contact`, `mail`, `message`) VALUES
('bruce banner', 'N/A', 'fgg@hotmail.com', 'kjdbwc'),
('bruce banner', 'N/A', 'fgg@hotmail.com', 'khbl'),
('user1', 'N/A', 'fgg@hotmail.com', 'ugfg3hroh3'),
('skydev', '876y49448', 'fgg@hotmail.com', 'ybefierif'),
('skydev', '876y49448', 'fgg@hotmail.com', 'ybefierif'),
('skydev', '876y49447', 'fgg@hotmail.com', 'vnejn'),
('skydev', '876y49447', 'fgg@hotmail.com', 'vnejn'),
('skydev', '876y49447', 'fgg@hotmail.com', 'vnejn'),
('skydev', '876y49447', 'fgg@hotmail.com', 'vnejn'),
('skydev', '876y49447', 'fgg@hotmail.com', 'hbeofro'),
('skydev', '876y49447', 'fgg@hotmail.com', 'hbeofro'),
('username1', 'N/A', 'fgg@hotmail.com', 'this is a testing message'),
('Bruce Banner', '98278r', 'jhgebdedb', 'kjuhwjfiperjifj'),
('Jane Doe', '947t430r92u9', 'haywgfd@ygisf', 'hello'),
('Jane Doe', '65872059', 'ers@jhdsygck', 'hello world');

-- --------------------------------------------------------

--
-- Table structure for table `blogcraft`
--

CREATE TABLE `blogcraft` (
  `id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `author_email` varchar(200) DEFAULT NULL,
  `author_name` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogcraft`
--

INSERT INTO `blogcraft` (`id`, `image_path`, `created_at`, `author_email`, `author_name`) VALUES
(10, 'gh@hotm.con_uploadblog/image_678947f780dce2.93809286.png', '2025-01-16 17:55:03', 'gh@hotm.con', 'Geremy Herklane'),
(11, 'nb@gmail.com_uploadblog/image_67894891ded461.64090750.png', '2025-01-16 17:57:37', 'nb@gmail.com', 'Nirobi Kotlin'),
(12, 'nb@gmail.com_uploadblog/image_67894fe73b3ec4.38353541.png', '2025-01-16 18:28:55', 'nb@gmail.com', 'Nirobi Kotlin'),
(18, 'indraditya@keemail.me_uploadblog/image_678badcf488926.04981529.png', '2025-01-18 13:34:07', 'indraditya@keemail.me', 'Geremy Herklane');

-- --------------------------------------------------------

--
-- Table structure for table `blogregister`
--

CREATE TABLE `blogregister` (
  `fullname` varchar(500) DEFAULT NULL,
  `email` varchar(500) DEFAULT NULL,
  `password` varchar(500) DEFAULT NULL,
  `cpassword` varchar(500) DEFAULT NULL,
  `id` int(11) NOT NULL,
  `activation_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blogregister`
--

INSERT INTO `blogregister` (`fullname`, `email`, `password`, `cpassword`, `id`, `activation_token`) VALUES
('Geremy Herklane', 'gh@hotm.con', '$2y$10$GvIGcej1HlIAZBS2Ipav6ONvheLfR/6wvwoRxfBHMEs55SB4/8nIy', '1234', 2, 'activated'),
('Nirobi Kotlin', 'nb@gmail.com', '$2y$10$07.7VdZUJ5YuK15WMNaoteKk5KFa90XXCfZhxy7kMJaPNjNGVQ/0.', '123456', 3, 'activated'),
('David Gale', 'david@gmail.com', '$2y$10$CWIjikrv4Z7C3XVzJYk.i.a0Mv67j.cW1Sblz5h2nl/jqMmAb/Pmy', '567890', 4, NULL),
('havard gomes', 'harvard@hotmail.com', '$2y$10$lK0pkPK4Kq0J6s9zvWiU/uxDzVRlmAlz.1y0YYsuDWX6sCC90ljbC', 'password', 5, NULL),
('Fredrik Wilson', 'fredrik@hotmail.com', '$2y$10$/Vu.eVA3eH/c//bqYposOuMZFcMGdrC6XzTOxOmzkSljoA.DoKGCG', 'carpet12', 6, NULL),
('Indraditya', 'indraditya@keemail.me', '$2y$10$9MTbkuQ5RvTpFDDpA81pl.qaM3Cc.KHIzaeyhX7ADpYT48jkNeFfe', 'zxcvzxcv', 16, 'activated');

-- --------------------------------------------------------

--
-- Table structure for table `blog_likes`
--

CREATE TABLE `blog_likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `liked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blog_likes`
--

INSERT INTO `blog_likes` (`id`, `post_id`, `user_email`, `liked_at`) VALUES
(2, 8, 'nb@gmail.com', '2025-01-16 14:59:20'),
(5, 11, 'nb@gmail.com', '2025-01-16 18:00:44'),
(6, 10, 'nb@gmail.com', '2025-01-16 18:00:52'),
(7, 11, 'gh@hotm.con', '2025-01-16 18:01:29'),
(9, 12, 'nb@gmail.com', '2025-01-16 18:31:04'),
(10, 12, 'gh@hotm.con', '2025-01-16 18:31:26'),
(11, 12, 'indraditya@keemail.me', '2025-01-17 17:21:12');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `author_name`, `content`, `created_at`) VALUES
(3, 27, 'David Gale', 'hello', '2025-01-07 20:22:33'),
(5, 28, 'Nirobi Kotlin', 'hi', '2025-01-07 20:28:32'),
(6, 28, 'qwerty', 'hello', '2025-01-07 20:29:19'),
(10, 28, 'qwerty', 'hello', '2025-01-07 21:27:34'),
(11, 28, 'qwerty', 'Key Points:\\nThe comments (and their styles) are saved to the database, making them persistent.\\nOn page load, comments are fetched from the server and dynamically styled using JavaScript.\\nNo inline styles are necessary; you can rely on predefined CSS classes.', '2025-01-07 21:33:42'),
(12, 28, 'qwerty', 'border-radius: 5px;\\n            padding: 5px;', '2025-01-07 21:35:09'),
(13, 27, 'David Gale', 'hello', '2025-01-07 22:20:58'),
(14, 28, 'David Gale', 'Hmm the comments are arriving', '2025-01-07 22:21:27'),
(17, 27, 'Geremy Herklane', 'Yeah what happened?', '2025-01-08 19:19:17'),
(18, 29, 'havard gomes', 'hello', '2025-01-10 18:49:01'),
(20, 28, 'Geremy Herklane', 'hi', '2025-01-11 10:51:45'),
(21, 28, 'Geremy Herklane', 'okay all', '2025-01-14 04:24:55'),
(23, 12, 'Nirobi Kotlin', 'hkkbljd', '2025-01-14 11:14:52'),
(27, 23, 'Nirobi Kotlin', 'ojeirjfer', '2025-01-16 15:26:37'),
(28, 23, 'Indraditya', 'Hello Nirobi', '2025-01-18 14:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `comments2`
--

CREATE TABLE `comments2` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `content` varchar(755) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments2`
--

INSERT INTO `comments2` (`id`, `post_id`, `author_name`, `content`, `created_at`) VALUES
(1, 12, 'Nirobi Kotlin', 'hello', '2025-01-16 15:25:14'),
(2, 12, 'Nirobi Kotlin', 'kjsndcj', '2025-01-16 15:26:23');

-- --------------------------------------------------------

--
-- Table structure for table `comments3`
--

CREATE TABLE `comments3` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `content` varchar(755) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments3`
--

INSERT INTO `comments3` (`id`, `post_id`, `author_name`, `content`, `created_at`) VALUES
(1, 8, 'Nirobi Kotlin', 'kjdbfhl', '2025-01-16 15:27:40'),
(2, 11, 'Geremy Herklane', 'Nice Code Nirobi', '2025-01-16 18:04:16'),
(3, 11, 'Nirobi Kotlin', 'Thank you buddy', '2025-01-16 18:09:34'),
(4, 18, 'Nirobi Kotlin', 'Why posting White Box??', '2025-01-18 21:59:16');

-- --------------------------------------------------------

--
-- Table structure for table `image_posts`
--

CREATE TABLE `image_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `author_name` varchar(100) NOT NULL,
  `author_email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `image_posts`
--

INSERT INTO `image_posts` (`id`, `title`, `image_path`, `author_name`, `author_email`, `created_at`) VALUES
(1, 'Venom 3', 'uploads/6785618694c12_venom3.png', 'Geremy Herklane', 'gh@hotm.con', '2025-01-13 18:55:02'),
(11, 'The yellow bird', 'uploads/birdsicon.png', 'Geremy Herklane', 'gh@hotm.con', '2025-01-14 04:10:51'),
(12, 'Green Pointer', 'uploads/greenpointer.jpg', 'Nirobi Kotlin', 'nb@gmail.com', '2025-01-14 06:37:33'),
(13, 'Rocket Game Picture', 'uploads/img_678a78d833a276.69760547_rocket-removebg-preview.png', 'Geremy Herklane', 'indraditya@keemail.me', '2025-01-17 15:35:52'),
(14, 'Funny Doll', 'uploads/img_678a9902017e15.20192463_WhatsApp Image 2025-01-12 at 20.20.11.jpeg', 'Geremy Herklane', 'indraditya@keemail.me', '2025-01-17 17:53:06');

-- --------------------------------------------------------

--
-- Table structure for table `mailtable`
--

CREATE TABLE `mailtable` (
  `email` varchar(400) DEFAULT NULL,
  `password` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `picture_likes`
--

CREATE TABLE `picture_likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `liked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `picture_likes`
--

INSERT INTO `picture_likes` (`id`, `post_id`, `user_email`, `liked_at`) VALUES
(1, 12, 'nb@gmail.com', '2025-01-16 15:07:26'),
(2, 11, 'nb@gmail.com', '2025-01-16 15:07:31'),
(5, 1, 'nb@gmail.com', '2025-01-19 10:12:49'),
(6, 13, 'nb@gmail.com', '2025-01-19 10:12:55');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `author_name` varchar(255) NOT NULL,
  `author_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `created_at`, `author_name`, `author_email`) VALUES
(1, 'hi', 'hello', '2024-12-22 09:32:42', '', ''),
(12, 'hello', 'jbdwljcwc', '2025-01-06 19:20:18', '', ''),
(23, 'My First Blog', 'Hello World !', '2025-01-06 20:43:10', 'Nirobi Kotlin', 'nb@gmail.com'),
(27, 'kjhdsc', 'jdjc', '2025-01-07 12:22:16', 'Nirobi Kotlin', 'gh@hotm.con'),
(28, 'Adjust Coordinates During Drawing', 'When resizing a canvas, the issue you\'re facing is that the drawing (pen) may not align with the mouse cursor after resizing. This happens because the canvas is resized, but the drawing coordinates remain relative to the original canvas dimensions, causing the pen\'s position to \"shift.\"\n\nTo fix this, you\'ll need to adjust the drawing coordinates based on the new canvas size when resizing. This means recalculating the correct position based on the scaling of the canvas.\nYou need to ensure that the drawing coordinates (relative to the mouse position) are adjusted when the canvas size is changed. This can be done by recalculating the mouse position based on the current canvas size relative to its original size.\nSolution:\n\nfunction draw(e, ctx) {\n    if (!ctx.drawing) return;\n\n    const rect = e.target.getBoundingClientRect();\n    const scaleX = e.target.width / rect.width; // Scale factor based on canvas size\n    const scaleY = e.target.height / rect.height; // Scale factor based on canvas size\n\n    const x = (e.clientX - rect.left) * scaleX;\n    const y = (e.clientY - rect.top) * scaleY;\n\n    if (drawingMode === \'pen\') {\n        ctx.lineWidth = currentPenSize;\n        ctx.lineCap = \'round\';\n        ctx.strokeStyle = currentPenColor;\n        ctx.lineTo(x, y);\n        ctx.stroke();\n        ctx.beginPath();\n        ctx.moveTo(x, y);\n    } else if (drawingMode === \'eraser\') {\n        ctx.clearRect(x - currentEraserSize / 2, y - currentEraserSize / 2, currentEraserSize, currentEraserSize);\n    }\n}\n', '2025-01-07 15:41:31', 'David Gale', 'david@gmail.com'),
(29, 'hello', 'Change URL without Reload (URL Parameters or Path)\nUse JavaScript\'s history.pushState() or history.replaceState() to modify the browser\'s URL without reloading the page.\n\nExample:\njavascript\nCopy code\n// Change URL without reloading\nconst newURL = window.location.protocol + \"//\" + window.location.host + \"/new-page\";\nwindow.history.pushState({ path: newURL }, \'\', newURL);', '2025-01-10 18:47:05', 'havard gomes', 'incredible@hulk.gamma'),
(30, 'Function that scales a container dynamically based on the viewport height ', 'You can use a combination of JavaScript and CSS to create a function that scales a container (and its child elements) dynamically based on the viewport height (window.innerHeight). By applying a scale transformation, both the container and its contents will scale proportionally.\n\nHere\'s how you can do it:\n\nHTML, CSS, and JavaScript Code\nhtml\nCopy code\n<!DOCTYPE html>\n<html lang=\"en\">\n<head>\n    <meta charset=\"UTF-8\">\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n    <title>Viewport Scaled Container</title>\n    <style>\n        body {\n            margin: 0;\n            overflow: hidden;\n            display: flex;\n            justify-content: center;\n            align-items: center;\n            height: 100vh;\n            background-color: #f4f4f4;\n        }\n\n        .container {\n            width: 400px;\n            height: 300px;\n            background-color: #007bff;\n            color: white;\n            display: flex;\n            justify-content: center;\n            align-items: center;\n            border-radius: 10px;\n            text-align: center;\n            transform-origin: top left; /* Ensures scaling happens from the top-left corner */\n        }\n\n        .content {\n            font-size: 1.5rem;\n            font-family: Arial, sans-serif;\n        }\n    </style>\n</head>\n<body>\n\n<div class=\"container\">\n    <div class=\"content\">\n        Scaled Content\n    </div>\n</div>\n\n<script>\n    function scaleContainer() {\n        const container = document.querySelector(\'.container\');\n        const viewportHeight = window.innerHeight;\n\n        // Base height (e.g., design height for scaling)\n        const baseHeight = 600; // Adjust this to match your design height\n\n        // Calculate the scale factor\n        const scaleFactor = viewportHeight / baseHeight;\n\n        // Apply scaling using CSS transform\n        container.style.transform = `scale(${scaleFactor})`;\n    }\n\n    // Call the function on load and resize\n    window.addEventListener(\'load\', scaleContainer);\n    window.addEventListener(\'resize\', scaleContainer);\n</script>\n\n</body>\n</html>\nHow It Works:\nBase Height:\n\nA baseHeight is defined as the height for which the container was originally designed (e.g., 600px).\nThis is used to calculate the scale factor.\nScale Factor:\n\nThe scale factor is computed as viewportHeight / baseHeight.\nCSS transform Property:\n\nThe transform: scale() property scales the container and its contents proportionally.\nDynamic Adjustment:\n\nThe scaleContainer function is called on window.load and window.resize events to dynamically adjust scaling whenever the viewport size changes.\nBenefits:\nEnsures the entire container and its child elements scale proportionally to fit the viewport height.\nResponsive and works across different screen sizes.\nEasy to integrate into existing designs.\nFeel free to modify the baseHeight and styling as per your requirements! Let me know if you need further enhancements. 😊', '2025-01-17 15:41:59', 'Geremy Herklane', 'indraditya@keemail.me');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `liked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`id`, `post_id`, `user_email`, `liked_at`) VALUES
(74, 28, 'nb@gmail.com', '2025-01-16 15:08:12'),
(75, 27, 'nb@gmail.com', '2025-01-16 15:08:16'),
(76, 23, 'nb@gmail.com', '2025-01-16 18:14:58'),
(77, 23, 'gh@hotm.con', '2025-01-16 18:32:13'),
(78, 23, 'indraditya@keemail.me', '2025-01-18 14:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`) VALUES
(1, 'bruce banner', 'rnjgipj'),
(2, 'skydev', 'dlfm');

-- --------------------------------------------------------

--
-- Table structure for table `webmail`
--

CREATE TABLE `webmail` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `activation_token` varchar(64) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `webmail`
--

INSERT INTO `webmail` (`id`, `email`, `activation_token`, `is_active`) VALUES
(1, 'indraditya@keemail.me', '4b67b34dc05f3a7fc955cd42d1f4c78c', 0),
(2, 'indraditya@keemail.me', '2919444bfaad60a478a32ab910462bac', 0),
(3, 'indraditya@keemail.me', 'd43118525dd213b0acc8936b0753bb5f', 0),
(4, 'indraditya@keemail.me', NULL, 1),
(5, 'indraditya@keemail.me', 'b2e4608a207dc4d580910c70bd9397f0', 0),
(6, '144indra7@gmail.com', NULL, 1),
(7, 'indraditya@keemail.me', '45496fb0361e9165371344c1a86e27c2', 0),
(8, 'indraditya@keemail.me', NULL, 1),
(9, 'indraditya@keemail.me', NULL, 1),
(10, 'indraditya@keemail.me', NULL, 1),
(11, 'indraditya@keemail.me', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogcraft`
--
ALTER TABLE `blogcraft`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogregister`
--
ALTER TABLE `blogregister`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `blog_likes`
--
ALTER TABLE `blog_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `comments2`
--
ALTER TABLE `comments2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments3`
--
ALTER TABLE `comments3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_posts`
--
ALTER TABLE `image_posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `picture_likes`
--
ALTER TABLE `picture_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_id` (`post_id`,`user_email`),
  ADD KEY `user_email` (`user_email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webmail`
--
ALTER TABLE `webmail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogcraft`
--
ALTER TABLE `blogcraft`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `blogregister`
--
ALTER TABLE `blogregister`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `blog_likes`
--
ALTER TABLE `blog_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `comments2`
--
ALTER TABLE `comments2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments3`
--
ALTER TABLE `comments3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `image_posts`
--
ALTER TABLE `image_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `picture_likes`
--
ALTER TABLE `picture_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `webmail`
--
ALTER TABLE `webmail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_likes_ibfk_2` FOREIGN KEY (`user_email`) REFERENCES `blogregister` (`email`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
