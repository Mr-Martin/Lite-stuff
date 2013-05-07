<?php
//Connection
$db_hostname = 'martin-163804.mysql.binero.se';
$db_database = '163804-martin';
$db_username = '163804_fu41156';
$db_password = 'nhy6mju7';

// Connect
$dbConn = mysqli_connect($db_hostname, $db_username, $db_password, $db_database);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$sql = "CREATE TABLE IF NOT EXISTS `comment` (
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `username` varchar(50) NOT NULL,
  `posted` datetime NOT NULL,
  `threadID` int(11) NOT NULL,
  PRIMARY KEY (`commentID`),
  KEY `postID` (`threadID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9";
mysqli_query($dbConn, $sql);


$sql = "INSERT INTO `comment` (`commentID`, `title`, `content`, `username`, `posted`, `threadID`) VALUES
(2, 'Testar g&ouml;ra en till kommentar', '<p>Denna g&aring;ngen med mer text...&nbsp;Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.</p>\r\n<p>Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>', 'Martin', '2012-10-24 18:57:05', 31),
(3, 'D&aring; l&auml;gger vi in en kommentar h&auml;r', '<p>Denna g&aring;ngen med mer text... Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra.Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi.</p>\r\n<p>Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus&nbsp;<img title='Wink' src='tinymce/jscripts/tiny_mce/plugins/emotions/img/smiley-wink.gif' alt='Wink' border='0' /></p>', 'Martin', '2012-10-24 19:24:16', 32),
(5, 'testar', '<p>testar</p>', 'Martin', '2012-10-24 21:08:03', 31),
(6, 'Coolt Janne', '<p>H&auml;ftigt inl&auml;gg Janne! Jag visste inte att du kunde s&aring;nt spr&aring;k?!&nbsp;<img title='Tongue Out' src='tinymce/jscripts/tiny_mce/plugins/emotions/img/smiley-tongue-out.gif' alt='Tongue Out' border='0' /></p>', 'Martin', '2012-10-24 21:10:52', 32),
(7, 'N&auml; just det!', '<p>Haha, just det! S&aring; kan det ju va!</p>', 'Martin', '2012-10-24 21:12:11', 32),
(8, 'Jag skriver en kommentar...', '<p>Hej hej! H&auml;r &auml;r en kommentar!</p>', 'Martin', '2012-10-24 21:13:02', 29)";
mysqli_query($dbConn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `gallery` (
  `galleryID` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(100) NOT NULL,
  PRIMARY KEY (`galleryID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=326" ;
mysqli_query($dbConn, $sql);

$sql = "INSERT INTO `gallery` (`galleryID`, `filename`) VALUES
(284, 'Baravara_startsida.jpg'),
(285, 'Baravara_undersida.jpg'),
(286, 'Allers_startsida_mork.jpg'),
(288, 'Allers_undersida_om-tidning.jpg'),
(290, 'BNI-Startsida.jpg'),
(292, 'Empiruterum.jpg'),
(293, 'Empiruterum_Markering.jpg'),
(294, 'Dryckestorget.jpg'),
(295, 'Entre.jpg'),
(296, 'Exxit_reg.jpg'),
(297, 'Bo-Ohlsson.jpg'),
(298, 'Exxit_startsida.jpg'),
(299, 'Exxit_undersida.jpg'),
(300, 'Flowerteam-Dropdown.jpg'),
(301, 'Flowerteam-Undersida.jpg'),
(302, 'Flowerteam-Startsida.jpg'),
(303, 'Gobeelabs.jpg'),
(304, 'Forsta-Steget.jpg'),
(305, 'Forsta-Steget_2.jpg'),
(306, 'Hagabadet.jpg'),
(307, 'Inredningsgalleriet_Hem.jpg'),
(308, 'Jonsters-Charity-Budsida.jpg'),
(309, 'Inredningsgalleriet_Butiken.jpg'),
(310, 'Jonsters-Charity-Undersida.jpg'),
(311, 'Jonsters-Charity-Startsida.jpg'),
(312, 'Kennethsdack_startsida.jpg'),
(313, 'Motion-Mail-Startsida.jpg'),
(314, 'Kondektor.jpg'),
(315, 'Kennethsdack_undersida.jpg'),
(316, 'Kundpartner.jpg'),
(317, 'Mobilis-Startsida.jpg'),
(318, 'Mobilis-Undersida.jpg'),
(319, 'Motion-Mail-Undersida.jpg'),
(320, 'Navark_sokresultat.jpg'),
(321, 'Navark_startsida.jpg'),
(322, 'Nowa.jpg'),
(323, 'SvFE-Startsida.jpg'),
(324, 'Navark_undersida.jpg'),
(325, 'Vala-Centrum.jpg')";
mysqli_query($dbConn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `mainmenu` (
  `menuID` int(11) NOT NULL AUTO_INCREMENT,
  `menuname` varchar(50) CHARACTER SET utf8 NOT NULL,
  `linkname` varchar(50) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`menuID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ";
mysqli_query($dbConn, $sql);

$sql = "INSERT INTO `mainmenu` (`menuID`, `menuname`, `linkname`) VALUES
(1, 'Start', 'index.php'),
(2, 'Portfolio', 'portfolio.php'),
(3, 'Forum', 'forum.php')'";
mysqli_query($dbConn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `posts` (
  `postID` int(11) NOT NULL AUTO_INCREMENT,
  `threadID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `posted` datetime NOT NULL,
  `title` varchar(512) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`postID`),
  KEY `threadID` (`threadID`,`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ";
mysqli_query($dbConn, $sql);

$sql = "INSERT INTO `posts` (`postID`, `threadID`, `userID`, `posted`, `title`, `content`) VALUES
(12, 29, 6, '2012-10-23 13:28:35', 'Ett l&aring;ngt inl&auml;gg med mycket text...', '<p><strong>Pellentesque habitant</strong> morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi.</p>\r\n<p>Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>'),
(13, 30, 6, '2012-10-23 13:29:43', 'H&auml;r har vi &auml;nnu ett inl&auml;gg som &auml;r l&aring;ngt!', '<p><strong>Pellentesque habitant</strong> morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi.</p>\r\n<p>Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>'),
(14, 31, 6, '2012-10-23 13:30:25', '&Auml;nnu ett inl&auml;gg, denna g&aring;ngen med mycket text i rubriken!', '<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est.</p>\r\n<p>Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi.&nbsp;<img title='Sealed' src='tinymce/jscripts/tiny_mce/plugins/emotions/img/smiley-sealed.gif' alt='Sealed' border='0' /></p>'),
(15, 32, 7, '2012-10-23 14:18:20', 'Ett inl&auml;gg fr&aring;n en annan anv&auml;ndare!', '<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>'),
(16, 33, 7, '2012-10-23 14:18:32', '&Auml;nnu ett fr&aring;n en annan anv&auml;ndare...', '<p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>')";
mysqli_query($dbConn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `threads` (
  `threadID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `title` varchar(512) NOT NULL,
  `posted` datetime NOT NULL,
  PRIMARY KEY (`threadID`),
  KEY `userID` (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ";
mysqli_query($dbConn, $sql);

$sql = "INSERT INTO `threads` (`threadID`, `userID`, `title`, `posted`) VALUES
(29, 6, 'Ett l&aring;ngt inl&auml;gg med mycket text...', '2012-10-23 13:28:35'),
(30, 6, 'H&auml;r har vi &auml;nnu ett inl&auml;gg som &auml;r l&aring;ngt!', '2012-10-23 13:29:43'),
(31, 6, '&Auml;nnu ett inl&auml;gg, denna g&aring;ngen med mycket text i rubriken!', '2012-10-23 13:30:25'),
(32, 7, 'Ett inl&auml;gg fr&aring;n en annan anv&auml;ndare!', '2012-10-23 14:18:20'),
(33, 7, '&Auml;nnu ett fr&aring;n en annan anv&auml;ndare...', '2012-10-23 14:18:32')";
mysqli_query($dbConn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` char(128) NOT NULL,
  `email` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL,
  `account_key` varchar(100) NOT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ";
mysqli_query($dbConn, $sql);

$sql = "INSERT INTO `users` (`userID`, `firstname`, `lastname`, `username`, `password`, `email`, `level`, `account_key`) VALUES
(6, 'Martin', 'Nilsson', 'Martin', '8206953cb6363b0771db5aee8f68a453d4ec018006786d088b7615ed03ff0dcfd4cefcc68e988f879b241808b8aaec31d6bed4c4ce187d5abb252172afd33cbf', 'mune2000@msn.com', 'Admin', '7f49f81ee7b331198a4fc717c076b896'),
(7, 'Janne', 'Svensson', 'Janne', 'fd2a10a4df71858165923862c3e4ce60a50c9ffefff25dab42315b0b646dbc38ab8bbbcb98b461365774e677479865777c1965a3c06371cf144e568479789b56', 'janne@test.se', 'Member', '47150ef3a5613fd90bd679b8382ca2e3')";
mysqli_query($dbConn, $sql);
?>