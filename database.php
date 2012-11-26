<?php # licence: gpl-signature.txt
$mysqldatabasecreate = '1';
if (empty($sqlconnect)) { require('init.php'); }
if((!empty($uid)) && ($uid == 1) or !empty($firsttime)) {
$result=mysql_list_tables($database);$rcount=mysql_num_rows($result);

unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_favorites'){$sql=1;}++$i;}// bible_favorites
if (!empty($sql)){
    mysql_query('ALTER TABLE bible_favorites ADD uid INT(100) DEFAULT NULL AFTER user;
                ALTER TABLE bible_favorites ADD b varchar(5) DEFAULT NULL AFTER favoriteverse;
                ALTER TABLE bible_favorites ADD c INT(3) DEFAULT NULL AFTER b;
                ALTER TABLE bible_favorites ADD v INT(3) DEFAULT NULL AFTER c;
                ALTER TABLE bible_favorites ADD v2 INT(3) DEFAULT NULL AFTER v;');
    echo 'Database Table bible_favorites Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_favorites(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
favoriteverse VARCHAR(20) DEFAULT NULL,
b varchar(5) DEFAULT NULL,
c INT(3) DEFAULT NULL,
v INT(3) DEFAULT NULL,
v2 INT(3) DEFAULT NULL,
`group` VARCHAR(20),
mode VARCHAR(20),
user VARCHAR(20) DEFAULT NULL,
uid int(100),
datetime TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=MyISAM  CHARACTER SET=utf8 COLLATE=utf8_general_ci;') or die(mysql_error());
 echo 'Database Table bible_favorites <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_notes'){$sql=1;}++$i;}// bible_notes
if (!empty($sql)){
    mysql_query('ALTER TABLE bible_notes ADD uid INT(100) DEFAULT NULL AFTER user;
                ALTER TABLE bible_notes ADD b varchar(5) DEFAULT NULL AFTER verse;
                ALTER TABLE bible_notes ADD c INT(3) DEFAULT NULL AFTER b;
                ALTER TABLE bible_notes ADD v INT(3) DEFAULT NULL AFTER c;
                ALTER TABLE bible_notes ADD v2 INT(3) DEFAULT NULL AFTER v;');
     echo 'Database Table bible_notes Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_notes(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
verse VARCHAR(20) DEFAULT NULL,
b VARCHAR(5) DEFAULT NULL,
c int(3) DEFAULT NULL,
v int(3) DEFAULT NULL,
v2 int(3) DEFAULT NULL,
`group` VARCHAR(20) DEFAULT NULL,
mode VARCHAR(20) DEFAULT NULL,
user VARCHAR(20) DEFAULT NULL,
uid int(100),
datetime TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
note TEXT) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;') or die(mysql_error());
 echo 'Database Table bible_notes <b>Created</b><br>';
}

unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_bookmarks'){$sql=1;}++$i;}// bible_bookmarks
if (!empty($sql)){
     mysql_query('ALTER TABLE bible_bookmarks ADD uid INT(100) DEFAULT NULL AFTER user;
                ALTER TABLE bible_bookmarks ADD b varchar(5) DEFAULT NULL AFTER bookmark;
                ALTER TABLE bible_bookmarks ADD c INT(3) DEFAULT NULL AFTER b;
                ALTER TABLE bible_bookmarks ADD v INT(3) DEFAULT NULL AFTER c;
                ALTER TABLE bible_bookmarks ADD v2 INT(3) DEFAULT NULL AFTER v;');
     echo 'Database Table bible_bookmarks Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_bookmarks(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
bookmark VARCHAR(20) DEFAULT NULL,
b VARCHAR(5) DEFAULT NULL,
c int(3) DEFAULT NULL,
v int(3) DEFAULT NULL,
v2 int(3) DEFAULT NULL,
user VARCHAR(20) DEFAULT NULL,
uid int(100),
datetime TIMESTAMP ON UPDATE CURRENT_TIMESTAMP) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;') or die(mysql_error());
 echo 'Database Table bible_bookmarks <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_xrefs'){$sql=1;}++$i;}// bible_xrefs 
if (!empty($sql)){
    mysql_query('ALTER TABLE bible_xrefs ADD uid INT(100) DEFAULT NULL AFTER user;
                ALTER TABLE bible_xrefs ADD b varchar(5) DEFAULT NULL AFTER verse;
                ALTER TABLE bible_xrefs ADD c INT(3) DEFAULT NULL AFTER b;
                ALTER TABLE bible_xrefs ADD v INT(3) DEFAULT NULL AFTER c;
                ALTER TABLE bible_xrefs ADD v2 INT(3) DEFAULT NULL AFTER v;');
     echo 'Database Table bible_xrefs Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_xrefs(
id INT NOT NULL AUTO_INCREMENT,
PRIMARY KEY(id),
verse VARCHAR(20),
b VARCHAR(5) DEFAULT NULL,
c int(3) DEFAULT NULL,
v int(3) DEFAULT NULL,
v2 int(3) DEFAULT NULL,
xrid int(10),
`group` VARCHAR(20),
mode VARCHAR(3),
user VARCHAR(20) DEFAULT NULL,
uid int(100),
datetime TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
refs TEXT) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;') or die(mysql_error());
 echo 'Database Table bible_xrefs <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_xrefs_list'){$sql=1;}++$i;}// bible_xrefs_list 
if (!empty($sql)){
    mysql_query('ALTER TABLE bible_xrefs_list ENGINE=MyISAM;');
     echo 'Database Table bible_xrefs_list Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_xrefs_list (
  xrid int(10) unsigned NOT NULL AUTO_INCREMENT,
  xrname varchar(70) DEFAULT NULL,
  lang varchar(20) DEFAULT NULL,
  PRIMARY KEY (xrid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;') or die(mysql_error());
mysql_query('INSERT IGNORE INTO bible_xrefs_list SET xrid = 1,xrname = \'User Xrefs\',lang = \'global\';');
 echo 'Database Table bible_xrefs_list <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_sn_list'){$sql=1;}++$i;}// bible_sn_list 
if (!empty($sql)){
     echo 'Database Table bible_sn_list Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_sn_list (
  snid int(10) unsigned NOT NULL AUTO_INCREMENT,
  snname varchar(60) NOT NULL,
  lang varchar(20),
  PRIMARY KEY (snid)
  ) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
 echo 'Database Table bible_sn_list <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_strongnumber'){$sql=1;}++$i;}// bible_strongnumber 
if (!empty($sql)){
    mysql_query('ALTER TABLE bible_strongnumber ADD type int(1) AFTER content;
                ALTER TABLE bible_strongnumber ADD modern varchar(40) AFTER type;
                ALTER TABLE bible_strongnumber ADD ancient varchar(40) AFTER modern;
                ALTER TABLE bible_strongnumber ADD translit varchar(40) AFTER ancient;
                ALTER TABLE bible_strongnumber ADD ahlb varchar(40) AFTER translit;
    ');
     echo 'Database Table bible_strongnumber Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_strongnumber (
  bsnid int(10) unsigned NOT NULL AUTO_INCREMENT,
  snid int(10) unsigned NOT NULL,
  sn varchar(5) NOT NULL,
  content text,
  type int(1),
  modern varchar(40),
  ancient varchar(40),
  translit varchar(40),
  ahlb varchar(40),
  PRIMARY KEY (bsnid),
  KEY idx_ss (snid,sn)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_strongnumber <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_book_name'){$sql=1;}++$i;}// bible_book_name 
if (!empty($sql)) {
     echo 'Database Table bible_book_name Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_book_name (
  bid int(10) unsigned NOT NULL,
  bkid int(10) unsigned NOT NULL,
  book varchar(5) NOT NULL,
  fname varchar(30) NOT NULL,
  sname varchar(12),
  chap int(10) unsigned NOT NULL,
  PRIMARY KEY (bid,bkid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_book_name <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_context'){$sql=1;}++$i;}// bible_context 
if (!empty($sql)) {
     echo 'Database Table bible_context Altered<br>';
     mysql_query('ALTER TABLE bible_context ADD rev int(100) AFTER mode;
     ALTER TABLE bible_context ADD revuid int(100) AFTER rev;
     ALTER TABLE bible_context ADD revdate int(11) AFTER revuid;
     ALTER TABLE bible_context ADD revinfoid int(30) AFTER revdate;
     ');
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_context (
  vsid int(10) NOT NULL AUTO_INCREMENT,
  bid int(10) NOT NULL,
  book varchar(3) NOT NULL,
  chapter int(10) unsigned,
  verse int(10) unsigned NOT NULL,
  linemark varchar(1) DEFAULT NULL,
  mode INT( 1 ) UNSIGNED NULL DEFAULT NULL,
  rev int(100) DEFAULT NULL,
  revuid int(100) DEFAULT NULL,
  revdate int(11) DEFAULT NULL,
  revinfoid int(10) DEFAULT NULL,
  context text NOT NULL,
  PRIMARY KEY (vsid),
  KEY idx_bbc (bid,book,chapter),
  KEY idx_bbclc (bid,book,chapter,linemark,verse),
  KEY idx_vlb (verse,linemark,bid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_context <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_revision_information'){$sql=1;}++$i;}// bible_context 
if (!empty($sql)) {
     echo 'Database Table bible_revision_information Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_revision_information (
  rid int(10) NOT NULL AUTO_INCREMENT,
  bid int(10) NOT NULL,
  rev int(100) DEFAULT NULL,
  revuid int(100) DEFAULT NULL,
  revdate int(11) DEFAULT NULL,
  ip varchar(32) DEFAULT NULL,
  geodata int(20) DEFAULT NULL,
  uid int(20) NOT NULL,
  description TEXT DEFAULT NULL,
  PRIMARY KEY (rid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_revision_information <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_list'){$sql=1;}++$i;} // bible_list 
if (!empty($sql)) {
    mysql_query('ALTER TABLE bible_list ADD uids VARCHAR(100) AFTER bname;
                ALTER TABLE bible_list ADD edituids VARCHAR(100) AFTER uids;
                ALTER TABLE bible_list DROP settings;
                ALTER TABLE bible_list CHANGE bsn bsn VARCHAR( 7 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
                ALTER TABLE bible_list ADD `desc` VARCHAR(200) AFTER serialversion;
                ALTER TABLE bible_list ADD font varchar(30) DEFAULT NULL AFTER `desc`;
                ');
     echo 'Database Table bible_list Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_list (
  bid int(10) unsigned NOT NULL AUTO_INCREMENT,
  bsn varchar(5) NOT NULL,
  bname varchar(40) NOT NULL,
  uids VARCHAR(100),
  edituids VARCHAR(100),
  `global` int(2),
  owner int(40),
  settings VARCHAR(20),
  lang varchar(20) DEFAULT NULL,
  serialversion varchar(10) DEFAULT NULL,
  `desc` VARCHAR(200) DEFAULT NULL,
  font varchar(30) DEFAULT NULL,
  PRIMARY KEY (bid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_list <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='sessions'){$sql=1;}++$i;} // sessions 
if (!empty($sql)) {
     echo 'Database Table sessions Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS sessions (
  uid int(10) unsigned NOT NULL,
  sid varchar(64) NOT NULL,
  hostname varchar(128) NOT NULL,
  timestamp int(11) NOT NULL,
  cache int(11),
  session longtext,
  PRIMARY KEY (sid),
  KEY timestamp (timestamp),
  KEY uid (uid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table sessions <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='users'){$sql=1;}++$i;}// users 
if (!empty($sql)) {
    mysql_query('Alter table users add bible_theme int(40) DEFAULT NULL after theme;');
     echo 'Database Table users Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS users (
  uid int(10) unsigned NOT NULL AUTO_INCREMENT,
  name varchar(60) NOT NULL,
  pass varchar(32) NOT NULL,
  mail varchar(320) DEFAULT NULL,
  mode tinyint(4) DEFAULT NULL,
  sort tinyint(4) DEFAULT NULL,
  threshold tinyint(4) DEFAULT NULL,
  theme varchar(255) DEFAULT NULL,
  bible_theme int(40) DEFAULT NULL,
  signature varchar(255) DEFAULT NULL,
  signature_format smallint(6) DEFAULT NULL,
  created int(11) DEFAULT NULL,
  access int(11) DEFAULT NULL,
  login int(11) DEFAULT NULL,
  status tinyint(4) DEFAULT NULL,
  timezone varchar(8) DEFAULT NULL,
  language varchar(12) DEFAULT NULL,
  picture varchar(255) DEFAULT NULL,
  init varchar(64) DEFAULT NULL,
  data longtext,
  extra_sec varchar(32) DEFAULT NULL,
  timezone_name varchar(50) DEFAULT NULL,
  PRIMARY KEY (uid),
  UNIQUE KEY name (name),
  KEY access (access),
  KEY created (created),
  KEY mail (mail)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table users <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_watchdog'){$sql=1;}++$i;}// bible_watchdog
if (!empty($sql)) {
     echo 'Database Table bible_watchdog Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS `bible_watchdog` (
  wid int(11) NOT NULL AUTO_INCREMENT,
  uid int(11) NOT NULL,
  type varchar(16) DEFAULT NULL,
  message longtext NOT NULL,
  variables longtext,
  severity tinyint(3) unsigned,
  link varchar(255),
  location text,
  referer text,
  hostname varchar(128) NOT NULL,
  timestamp int(11) NOT NULL,
  PRIMARY KEY (wid),
  KEY type (type)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table watchdog <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_visitors'){$sql=1;}++$i;}// bible_visitors 
if (!empty($sql)) {
    mysql_query('ALTER TABLE bible_visitors ADD geodata int(20) AFTER visitors_user_agent;
                ALTER TABLE bible_visitors ADD new int(2) AFTER geodata;
                ALTER TABLE bible_visitors ADD lang varchar(20) AFTER new;');
     echo 'Database Table bible_visitors Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_visitors (
  visitors_id int(11) AUTO_INCREMENT,
  visitors_uid int(11),
  visitors_ip varchar(32) NOT NULL,
  visitors_date_time int(14) NOT NULL,
  visitors_url text NOT NULL,
  visitors_referer text,
  visitors_path varchar(255) NOT NULL,
  visitors_title varchar(255),
  visitors_user_agent text,
  geodata int(20),
  new int(2),
  lang varchar(20),
  PRIMARY KEY (visitors_id)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_visitors <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_user_settings'){$sql=1;}++$i;}// bible_user_settings 
if (!empty($sql)) {
    echo 'Database Table bible_user_settings Altered<br>';
    mysql_query('ALTER TABLE bible_user_settings DROP fontcolor,DROP fontbackground,DROP fontsize,DROP versehighlightcolor,DROP font;
                Alter table bible_user_settings add theme int(11) after settings;
                Alter table bible_user_settings add bibleplan varchar(20) after settings;
                Alter table bible_user_settings add font varchar(30) DEFAULT NULL after settings;
                Alter table bible_user_settings add hebfont varchar(30) DEFAULT NULL after font;');
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_user_settings (
    user_id int(11) NOT NULL,
    lasturl text DEFAULT NULL,
    lastip varchar(32) NOT NULL,
    settings varchar(170) DEFAULT NULL,
    bibleplan varchar(20) DEFAULT NULL,
    font varchar(30) DEFAULT NULL,
    hebfont varchar(30) DEFAULT NULL,
    theme int(11),
  PRIMARY KEY (user_id)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_user_settings <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_settings'){$sql=1;}++$i;}// bible_settings
if (!empty($sql)) {
    mysql_query('ALTER TABLE bible_settings DROP fontcolor,DROP fontbackground,DROP fontsize,DROP versehighlightcolor,DROP font;');
    mysql_query('Alter table bible_settings add theme int(11) after defaultsuper;');
    echo 'Database Table bible_settings Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_settings (
    setting int(40) NOT NULL AUTO_INCREMENT,
    lang varchar(40) DEFAULT NULL,
    strong varchar(30) DEFAULT \'1\',
    bible int(32) DEFAULT \'1\',
    defaultsuper INT(20),
    theme int(11),
  PRIMARY KEY (setting)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_settings <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_themes'){$sql=1;}++$i;} // bible_themes
if (!empty($sql)) {
     $ldisp='input,select,.tme{display:inline-block;background-color:#1E4A56;color:#709FA0;padding-right:3px;border:1px solid;padding-left:3px;}
	  u{font-weight:bold;color:#CFB52B;}hr{border:1px dotted #70AA93;}.go{text-decoration:blink;background:#586041;color:#CFB52B;}';
    mysql_query('Alter table bible_themes add boardcol varchar(10) after scol;
                Alter table bible_themes add divback varchar(10) after boardcol;
                Alter table bible_themes add ufp varchar(10) after divback;
                Alter table bible_themes add tableback varchar(10) after ufp;
                Alter table bible_themes add alfp varchar(10) after tableback;
                Alter table bible_themes add bmcol varchar(10) DEFAULT NULL after alfp;
                Alter table bible_themes add favcol varchar(10) DEFAULT NULL after bmcol;
                Alter table bible_themes add notcol varchar(10) DEFAULT NULL after favcol;
                Alter table bible_themes add xrefcol varchar(10) DEFAULT NULL after notcol;
                Alter table bible_themes add tocol varchar(10) DEFAULT NULL after xrefcol;
                Alter table bible_themes add genfp int(1) DEFAULT NULL after tocol;
                Alter table bible_themes add gen int(1) DEFAULT NULL after genfp;
                ');
     echo 'Database Table bible_themes Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_themes (
    tid int(11) AUTO_INCREMENT,
    theme varchar(20) NOT NULL,
    mode int(2) DEFAULT NULL,
    uid int(11) DEFAULT NULL,
    fontcolor varchar(10) DEFAULT NULL,
    fontbackground varchar(10) DEFAULT \'#F1EBF4\',
    fontsize int(3),
    versehighlightcolor varchar(10) DEFAULT \'347039\',
    font varchar(30) DEFAULT NULL,
    linkcolor varchar(10) DEFAULT NULL,
    visitedlinkcolor varchar(10) DEFAULT NULL,
    activelinkcolor varchar(10) DEFAULT NULL,
    lhover varchar(10) DEFAULT NULL,
    ldisp varchar(20) DEFAULT NULL,
    lback varchar(10) DEFAULT NULL,
    lfweight varchar(10) DEFAULT NULL,
    icol varchar(20) DEFAULT NULL,
    idisp varchar(20) DEFAULT NULL,
    iback varchar(20) DEFAULT NULL,
    ucol varchar(20) DEFAULT NULL,
    hcol varchar(20) DEFAULT NULL,
    gcol varchar(20) DEFAULT NULL,
    gdec varchar(20) DEFAULT NULL,
    gback varchar(20) DEFAULT NULL,
    scol varchar(20) DEFAULT NULL,
    boardcol varchar(10) DEFAULT NULL,
    divback varchar(10) DEFAULT NULL,
    ufp varchar(10) DEFAULT NULL,
    tableback varchar(10) DEFAULT NULL,
    alfp varchar(10) DEFAULT NULL,
    bmcol varchar(10) DEFAULT NULL,
    favcol varchar(10) DEFAULT NULL,
    notcol varchar(10) DEFAULT NULL,
    xrefcol varchar(10) DEFAULT NULL,
    tocol varchar(10) DEFAULT NULL,
    genfp int(1) DEFAULT NULL,
    gen int(1) DEFAULT NULL,
  PRIMARY KEY (tid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');// Alter table bible_themes add icol varchar(10) DEFAULT NULL after lfweight;
mysql_query('INSERT INTO `bible_themes` (`tid`, `theme`, `mode`, `uid`, `fontcolor`, `fontbackground`, `fontsize`, `versehighlightcolor`, `font`, `linkcolor`, `visitedlinkcolor`, `activelinkcolor`, `lhover`, `ldisp`, `lback`, `lfweight`, `icol`, `idisp`, `iback`, `ucol`, `hcol`, `gcol`, `gdec`, `gback`, `scol`) VALUES
(1, \'Default\', 2, 1, \'\', \'#F1EBF4\', 100, \'#347039\', \'\', \'\', \'\', \'\', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, \'Default Dark\', 2, 1, \'\', \'#BCB7BA\', 100, \'#305132\', \'\', \'\', \'\', \'\', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, \'Boxes\', 2, 1, \'#000000\', \'#827E5B\', 105, \'#347039\', \'\', \'#333A20\', \'#FFFFFF\', \'\', \'#C5B356\', \'inline-block\', \'#898964\', \'bold\', \'#000000\', \'inline\', \'#8C7F5C\', \'#3A272F\', \'#333A20\', \'\', \'blink\', \'\', \'#443E25\'),
(4, \'Boxes2\', 2, 1, \'#B2BC8F\', \'#323825\', 0, \'#347039\', \'\', \'#000000\', \'#FFFFFF\', \'\', \'#7A991A\', \'inline\', \'#84A346\', \'\', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, \'Boxes3\', 2, 1, \'#B2BC8F\', \'#272B1D\', 0, \'#347039\', \'\', \'#8DA859\', \'#FFFFFF\', \'\', \'#667A50\', \'inline-block\', \'#586041\', \'bold\', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, \'FirstGreen\', 2, 1, \'#AD9F75\', \'#272B1D\', 0, \'#347039\', \'\', \'#8DA859\', \'#FFFFFF\', \'\', \'#667A50\', \'inline-block\', \'#394224\', \'bold\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', NULL),
(7, \'Boxes\', 0, 0, \'#000000\', \'#898455\', 125, \'#347039\', \'\', \'#373F22\', \'#FFFFFF\', \'\', \'#C5B356\', \'inline-block\', \'#7E8054\', \'bold\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', \'\', NULL);');
echo 'Database Table bible_themes <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_groups'){$sql=1;}++$i;}// bible_groups 
if (!empty($sql)) {
     echo 'Database Table bible_groups Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_groups (
  group_id int(30) NOT NULL AUTO_INCREMENT,
  group_name varchar(255) NOT NULL,
  type VARCHAR(4),
  category INT(30),
  founder varchar(60) NOT NULL,
  group_parent int(30),
  admins text NOT NULL,
  num_users int(99) NOT NULL,
  users text,
  founded int(11) NOT NULL,
  lastactivity int(11) NOT NULL,
  settings varchar(120),
  PRIMARY KEY (group_id)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;'); // `visitors_title` varchar(255) DEFAULT NULL,
echo 'Database Table bible_groups <b>Created</b><br>';
}
/*
$sql=mysql_query('SELECT nid FROM bible_groups'); // bible_quicknotes 
if (!empty($sql)) {
     echo 'Database Table bible_groups Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_groups (
  nid int(255) AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  owner int(11) NOT NULL,
  status int(4) DEFAULT \'1\',
  setting int(4) DEFAULT \'1\',
  created int(11) NOT NULL,
  uids varchar(255),
  admins varchar(255),
  description varchar(150),
  UNIQUE KEY name(name),
  PRIMARY KEY (nid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_groups <b>Created</b><br>';
}
*/
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_nodes'){$sql=1;}++$i;}// bible_nodes 
if (!empty($sql)) {
    mysql_query('ALTER TABLE bible_nodes ADD lastvisitor INT(10) DEFAULT NULL AFTER visitors;
                ALTER TABLE bible_nodes ADD lasteditor INT(3) DEFAULT NULL AFTER settings;
  ALTER TABLE bible_nodes ADD nodeb1 varchar(5) after link;
  ALTER TABLE bible_nodes ADD nodec1 int(4) after nodeb1;
  ALTER TABLE bible_nodes ADD nodev1 int(4) after nodec1;
  ALTER TABLE bible_nodes ADD nodeb2 varchar(5) after nodev1;
  ALTER TABLE bible_nodes ADD nodec2 int(4) after nodeb2;
  ALTER TABLE bible_nodes ADD nodev2 int(4) after nodec2;
  ALTER TABLE bible_nodes ADD nodeb3 varchar(5) after nodev2;
  ALTER TABLE bible_nodes ADD nodec3 int(4) after nodeb3;
  ALTER TABLE bible_nodes ADD nodev3 int(4) after nodec3;
  ALTER TABLE bible_nodes ADD linkavi varchar(100) after link;
  ALTER TABLE bible_nodes ADD linkflv varchar(100) after linkavi;
                ');
     echo 'Database Table bible_nodes Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_nodes (
  nid int(13) unsigned NOT NULL AUTO_INCREMENT,
  vid int(10) DEFAULT NULL,
  type varchar(32) NOT NULL,
  language varchar(12) DEFAULT NULL,
  title varchar(255) NOT NULL,
  category varchar(255) NOT NULL,
  uppercat varchar(255),
  uid int(11) NOT NULL,
  status int(11) DEFAULT \'1\',
  location varchar(90) DEFAULT NULL,
  created int(11) NOT NULL,
  changed int(11) NOT NULL,
  sdate int(11) DEFAULT NULL,
  edate int(11) DEFAULT NULL,
  comment int(13) DEFAULT NULL,
  subnode int(13) DEFAULT NULL,
  promote int(11) DEFAULT NULL,
  moderate int(11) DEFAULT NULL,
  visitors int(100) DEFAULT NULL,
  rating int(5) DEFAULT NULL,
  sticky int(11) DEFAULT NULL,
  tnid int(10) unsigned DEFAULT NULL,
  translate int(11) DEFAULT NULL,
  editgroups int(3) DEFAULT \'3\',
  sendnot int(3) DEFAULT \'1\',
  uids VARCHAR(100),
  settings VARCHAR(20),
  lasteditor INT(3) DEFAULT NULL,
  gmap varchar(255),
  link varchar(255) DEFAULT NULL,
  nodeb1 varchar(5),
  nodec1 int(4),
  nodev1 int(4),
  nodeb2 varchar(5),
  nodec2 int(4),
  nodev2 int(4),
  nodeb3 varchar(5),
  nodec3 int(4),
  nodev3 int(4),
  data TEXT,
  PRIMARY KEY (nid),
  KEY `node_changed` (changed),
  KEY `node_created` (created),
  KEY `node_moderate` (moderate),
  KEY `node_promote_status` (promote,status),
  KEY `node_status_type` (status,type,nid),
  KEY `node_title_type` (title,type(4)),
  KEY node_type (type(4)),
  KEY uid (uid),
  KEY tnid (tnid),
  KEY translate (translate)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_nodes <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_node_types'){$sql=1;}++$i;} // bible_node_types 
if (!empty($sql)) {
     echo 'Database Table bible_node_types Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_node_types (
  name varchar(50) NOT NULL,
  type varchar(200) NOT NULL,
  PRIMARY KEY (name)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;');
echo 'Database Table bible_node_types <b>Created</b><br>';
}
$typelist ='" "fc|Container" "ft|Forum Topic" "ar|Article" "bl|Blogg" "po|Podcast" "li|Link" "no|Note" "gp|Group Page" "dn|Devotion" "cy|Commentary" "ev|Event" "ct|Comment" "ne|News" "do|Documentation" "';
$typelist = explode('" "',$typelist);
foreach ($typelist as $nodetype) {
    $nodetype=explode('|',$nodetype);
    if (!empty($nodetype[0])) { mysql_query('INSERT INTO bible_node_types (name,type) Values (\''.$nodetype[0].'\',\''.$nodetype[1].'\')'); }
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_node_icons'){$sql=1;}++$i;}// bible_node_types 
if (!empty($sql)) {
     echo 'Database Table bible_node_icons Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_node_icons (
  name varchar(50) NOT NULL,
  img blob NOT NULL,
  PRIMARY KEY (name)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;');
echo 'Database Table bible_node_icons <b>Created</b><br>';
}

if (!empty($no_admin)) {
mysql_query('INSERT INTO users (uid, name, pass, mail, mode, sort, threshold, theme, signature, signature_format, created, access, login, status, timezone, language, picture, init, data, timezone_name)
            VALUES (\'1\', \''.$usernameadmin.'\', \''.md5($passwordadmin).'\', \''.$emailadmin.'\', \'0\', \'0\', \'0\', \'\', \'\', \'0\', \'0\', \'0\', \'0\', \'1\', NULL, \'\', \'\', \''.$emailadmin.'\', NULL, \'\');');
$a = session_id();
if(empty($a)) session_start();
mysql_query('INSERT INTO sessions (uid, sid, hostname, timestamp, cache, session)
                    VALUES (\'1\', \''.session_id().'\', \''.$remoteaddr.'\', \''.time().'\',\'\',\'\');');
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_fonts'){$sql=1;}++$i;}// bible_fonts 
if (!empty($sql)) {
     echo 'Database Table bible_fonts Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_fonts (
  name varchar(50) NOT NULL,
  type varchar(20) NOT NULL,
  PRIMARY KEY (name)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
$fontlist = '" "academy engraved let" "algerian" "amaze" "arial" "arial black" "balthazar" "bankgothic lt bt" "bart" "bimini" "comic sans ms" "book antiqua" "bookman old style" "braggadocio" "britannic bold" "brush script mt" "century gothic" "century schoolbook" "chasm" "chicago" "colonna mt" "comic sans ms" "commercialscript bt" "coolsville" "courier" "courier new" "cursive" "dayton" "desdemona" "fantasy" "fixedsys" "flat brush" "footlight mt light" "futurablack bt" "futuralight bt" "garamond" "gaze" "geneva" "georgia" "geotype tt" "helterskelter" "helvetica" "herman" "highlight let" "impact" "jester" "joan" "john handy let" "jokerman let" "kelt" "kids" "kino mt" "la bamba let" "lithograph" "lucida console" "map symbols" "marlett" "matteroffact" "matisse itc" "matura mt script capitals" "mekanik let" "monaco" "monospace" "monotype sorts" "ms linedraw" "new york" "olddreadfulno7 bt" "orange let" "palatino" "playbill" "pump demi bold let" "puppylike" "roland" "sans-serif" "scripts" "scruff let" "serif" "short hand" "signs normal" "simplex" "simpson" "stylus bt" "superfrench" "surfer" "swis721 bt" "swis721 blkoul bt" "symap" "symbol" "tahoma" "technic" "tempus sans itc" "terk" "times" "times new roman" "trebuchet ms" "trendy" "txt" "verdana" "victorian let" "vineta bt" "vivian" "webdings" "wingdings" "western" "westminster" "westwood let" "wide latin" "zapfellipt bt" "Proto-Semitic"';
$fontlist = explode('" "',$fontlist);
foreach ($fontlist as $font) {
    mysql_query('INSERT INTO bible_fonts (name,type) Values (\''.str_replace('"','',$font).'\',\'general\')');
    
}
$fontlist='HiraKakuProN-W3  Courier  Courier-BoldOblique  Courier-Oblique  Courier-Bold  ArialMT  Arial-BoldMT  Arial-BoldItalicMT  Arial-ItalicMT  STHeitiTC-Light  STHeitiTC-Medium  AppleGothic  CourierNewPS-BoldMT  CourierNewPS-ItalicMT  CourierNewPS-BoldItalicMT  CourierNewPSMT  Zapfino  HiraKakuProN-W6  ArialUnicodeMS  STHeitiSC-Medium  STHeitiSC-Light  AmericanTypewriter  AmericanTypewriter-Bold  Helvetica-Oblique  Helvetica-BoldOblique  Helvetica  Helvetica-Bold  MarkerFelt-Thin  HelveticaNeue  HelveticaNeue-Bold  DBLCDTempBlack  Verdana-Bold  Verdana-BoldItalic  Verdana  Verdana-Italic  TimesNewRomanPSMT  TimesNewRomanPS-BoldMT  TimesNewRomanPS-BoldItalicMT  TimesNewRomanPS-ItalicMT  Georgia-Bold  Georgia  Georgia-BoldItalic  Georgia-Italic  STHeitiJ-Medium  STHeitiJ-Light  ArialRoundedMTBold  TrebuchetMS-Italic  TrebuchetMS  Trebuchet-BoldItalic  TrebuchetMS-Bold  STHeitiK-Medium  STHeitiK-Light Proto-Semitic';
$fontlist=explode(' ',$fontlist);
foreach ($fontlist as $font) {
    mysql_query('INSERT INTO bible_fonts (name,type) Values (\''.str_replace('"','',$font).'\',\'iphone\')');
}
echo 'Database Table bible_fonts <b>Created</b><br>';
}


unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_quicknotes'){$sql=1;}++$i;}// bible_quicknotes 
if (!empty($sql)) {
     echo 'Database Table bible_quicknotes Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_quicknotes (
  nid int(255) AUTO_INCREMENT,
  title varchar(100) NOT NULL,
  uid int(11) NOT NULL,
  status int(4) DEFAULT \'1\',
  created int(11) NOT NULL,
  updated int(11) NOT NULL,
  note text NOT NULL,
  PRIMARY KEY (nid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_quicknotes <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_userlisthist'){$sql=1;}++$i;}// bible_userlisthist 
if (!empty($sql)) {
     echo 'Database Table bible_userlisthist Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_userlisthist (
  nid int(255) AUTO_INCREMENT,
  title varchar(100) NOT NULL,
  uid int(11) NOT NULL,
  status int(4) DEFAULT \'1\',
  created int(11) NOT NULL,
  updated int(11) NOT NULL,
  line text NOT NULL,
  PRIMARY KEY (nid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_userlisthist <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_userlists'){$sql=1;}++$i;}// bible_userlists 
if (!empty($sql)) {
     echo 'Database Table bible_userlists Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_userlists (
  nid int(255) AUTO_INCREMENT,
  title varchar(100) NOT NULL,
  uid int(11) NOT NULL,
  status int(4) DEFAULT \'1\',
  created int(11) NOT NULL,
  updated int(11) NOT NULL,
  line text NOT NULL,
  PRIMARY KEY (nid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_userlists <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_headlines'){$sql=1;}++$i;}// bible_headlines
if (!empty($sql)) {
    mysql_query('ALTER TABLE bible_headlines ADD bid int(20) AFTER verse');
    mysql_query('UPDATE bible_headlines SET bid=1 WHERE bid is null');
     echo 'Database Table bible_headlines Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_headlines (
  hid int(80) AUTO_INCREMENT,
  title varchar(80) NOT NULL,
  book varchar(8) NOT NULL,
  chap int(4) NOT NULL,
  verse int(4) NOT NULL,
  bid int(20),
  PRIMARY KEY (hid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_headlines <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_user_list'){$sql=1;}++$i;}
// bible_user_list (this might be used when making features that allows "own translations" to be done)
if (!empty($sql)) {
    mysql_query('ALTER TABLE bible_user_list ADD uids VARCHAR(100) AFTER bname');
    mysql_query('ALTER TABLE bible_user_list DROP settings');
     echo 'Database Table bible_groups Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_user_list (
  bid int(10) unsigned NOT NULL AUTO_INCREMENT,
  bsn varchar(5) NOT NULL,
  bname varchar(40) NOT NULL,
  uids VARCHAR(100),
  `global` INT(3),
  owner INT(40),
  lang varchar(20) DEFAULT NULL,
  serialversion varchar(10) DEFAULT NULL,
  PRIMARY KEY (bid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_user_list <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_user_context'){$sql=1;}++$i;}// bible_user_context 
if (!empty($sql)) {
    mysql_query('ALTER TABLE bible_user_context DROP uids');
    echo 'Database Table bible_user_context Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_user_context (
  vsid int(10) unsigned NOT NULL AUTO_INCREMENT,
  bid int(10) unsigned NOT NULL,
  book varchar(3) NOT NULL,
  chapter int(10) unsigned NOT NULL,
  verse int(10) unsigned NOT NULL,
  linemark varchar(1) DEFAULT NULL,
  context text NOT NULL,
  PRIMARY KEY (vsid),
  KEY idx_bbc (bid,book,chapter),
  KEY idx_bbclc (bid,book,chapter,linemark,verse),
  KEY idx_vlb (verse,linemark,bid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_user_context <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_super_dial_context'){$sql=1;}++$i;}
if (!empty($sql)) {
    mysql_query('ALTER TABLE bible_super_dial_context ADD subcontext VARCHAR(200) DEFAULT NULL after lastyear;
                ALTER TABLE bible_super_dial_context ADD l VARCHAR(200) DEFAULT NULL after subcontext;
                ALTER TABLE bible_super_dial_context ADD l2 VARCHAR(200) DEFAULT NULL after l;
                ALTER TABLE bible_super_dial_context ADD tid int(200) DEFAULT NULL after l2;
                ALTER TABLE bible_super_dial_context ADD mode int(3) DEFAULT NULL after uid;');
     echo 'Database Table bible_super_dial_context Altered<br>';
} else {
//1PE|The Chief Shepherd|The Chief Shepherd|1PE 5:4
mysql_query('CREATE TABLE IF NOT EXISTS bible_super_dial_context (
  pid int(10) NOT NULL AUTO_INCREMENT,
  mid int(10),
  midc int(10),
  uid int(10),
  mode int(3) DEFAULT NULL,
  book varchar(80) NOT NULL,
  type int(3) unsigned NOT NULL,
  date int(11) DEFAULT NULL,
  trioarg int(3),
  title varchar(200),
  context varchar(200),
  verses varchar(200),
  firstyear int(40),
  lastyear int(40),
  subcontext VARCHAR(200) DEFAULT NULL,
  l VARCHAR(200) DEFAULT NULL,
  l2 VARCHAR(200) DEFAULT NULL,
  tid int(200) DEFAULT NULL,
  PRIMARY KEY (pid),
  KEY idx_mbt (mid,book,type)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_super_dial_context <b>Created</b><br>';
}

unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_topic_list'){$sql=1;}++$i;}
if (!empty($sql)) {
    mysql_query('');
     echo 'Database Table bible_topic_list Altered<br>';
} else {
//1PE|The Chief Shepherd|The Chief Shepherd|1PE 5:4
mysql_query('CREATE TABLE IF NOT EXISTS bible_topic_list (
  id int(10) NOT NULL AUTO_INCREMENT,
  tid int(10),
  tcid int(10),
  uid int(10),
  title varchar(200),
  PRIMARY KEY (id),
  KEY idx_ttc (tid,tcid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_topic_list <b>Created</b><br>';
}

unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_topic_link'){$sql=1;}++$i;}
if (!empty($sql)) {
    #mysql_query('');
     echo 'Database Table bible_topic_link Altered<br>';
} else {
//1PE|The Chief Shepherd|The Chief Shepherd|1PE 5:4
mysql_query('CREATE TABLE IF NOT EXISTS bible_topic_link (
  tid int(10) NOT NULL AUTO_INCREMENT,
  mid int(10),
  uid int(10),
  book varchar(80) NOT NULL,
  type int(3) unsigned NOT NULL,
  title varchar(200),
  context VARCHAR(200) DEFAULT NULL,
  subcontext varchar(200),
  mode int(3),
  b varchar(3) NOT NULL,
  c int(10) NOT NULL,
  v int(10),
  v2 int(10),
  PRIMARY KEY (tid),
  KEY idx_bcv (b,c,v)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_topic_link <b>Created</b><br>';
}

unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_mind_topics'){$sql=1;}++$i;}
if (!empty($sql)) {
    #mysql_query('');
     echo 'Database Table bible_mind_topics Altered<br>';
} else {
//1PE|The Chief Shepherd|The Chief Shepherd|1PE 5:4
mysql_query('CREATE TABLE IF NOT EXISTS bible_mind_topics (
  mindid int(10) NOT NULL AUTO_INCREMENT,
  conid int(10),
  tid int(10),
  uid int(10),
  PRIMARY KEY (mindid),
  KEY idx_mct (mindid,conid,tid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_mind_topics <b>Created</b><br>';
}

unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_mind_topics'){$sql=1;}++$i;}
if (!empty($sql)) {
    #mysql_query('');
     echo 'Database Table bible_mindset Altered<br>';
} else {
//1PE|The Chief Shepherd|The Chief Shepherd|1PE 5:4
mysql_query('CREATE TABLE IF NOT EXISTS bible_mindset (
  mid int(10) NOT NULL AUTO_INCREMENT,
  mindid int(10),
  uid int(10),
  title varchar(20),
  mode int(2),
  PRIMARY KEY (mindid),
  KEY idx_mmu (mid,mindid,uid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_mindset <b>Created</b><br>';
}

unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_super_dial'){$sql=1;}++$i;}
if (!empty($sql)) {
     echo 'Database Table bible_super_dial Altered<br>';
} else {
//1PE|The Chief Shepherd|The Chief Shepherd|1PE 5:4
mysql_query('CREATE TABLE IF NOT EXISTS bible_super_dial (
  mid int(10) NOT NULL AUTO_INCREMENT,
  midc int(10) UNSIGNED NULL DEFAULT NULL,
  levels INT(40) NULL DEFAULT NULL,
  uid int(10) NOT NULL,
  `global` INT(1) UNSIGNED NULL DEFAULT NULL,
  shared INT(1) UNSIGNED NULL DEFAULT NULL,
  readwrite INT(1) UNSIGNED NULL DEFAULT NULL,
  title varchar(200) NOT NULL,
  PRIMARY KEY (mid),
  KEY idx_mcu (mid,midc,uid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_super_dial <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_user_recovery'){$sql=1;}++$i;}
if (!empty($sql)) {
     echo 'Database Table bible_groups Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_user_recovery (
  rid int(7) AUTO_INCREMENT,          
  uid int(10) unsigned NOT NULL,
  mail varchar(320) NOT NULL,
  date int(11) DEFAULT NULL,
  auth varchar(55) NOT NULL,
  PRIMARY KEY (rid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_user_recovery <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='geoblocks'){$sql=1;}++$i;}
if (!empty($sql)) {
     echo 'Database Table geoblocks Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS geoblocks(
startIpNum INT(15) UNSIGNED NOT NULL,
endIpNum INT(10) UNSIGNED NOT NULL,
locId INT(15) UNSIGNED NOT NULL);');
 
mysql_query('CREATE TABLE IF NOT EXISTS geolocation(
locId int(10) unsigned NOT NULL,
country char(2) NOT NULL,
region char(2) NOT NULL,
city varchar(50),
postalCode char(5) NOT NULL,
latitude float,
longitude float,
dmaCode integer,
areaCode integer,
PRIMARY KEY (locId))');
mysql_query('ALTER TABLE `geoblocks` ADD INDEX (`startIpNum`);');
mysql_query('ALTER TABLE `geoblocks` ADD INDEX (`endIpNum`);');

echo 'Database Table geo... <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_geoip'){$sql=1;}++$i;}
if (!empty($sql)) {
     echo 'Database Table bible_geoip Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_geoip (
  locId int(10) unsigned NOT NULL,
  IpNum INT(15) UNSIGNED NOT NULL,
  PRIMARY KEY (IpNum)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_geoip <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_psem'){$sql=1;}++$i;}
if (!empty($sql)) {
     echo 'Database Table bible_psem Altered<br>';
} else {#WID, CID, desc id, WORD, UID, M, ALT1, ALT2, ALT3, ALT4, ALT5, ALT6, ALT7, ALT8, ALT9, ALT10
mysql_query('CREATE TABLE IF NOT EXISTS bible_psem (
  wid int(10) AUTO_INCREMENT,
  cid int(4),
  did int(5),
  w int(10),
  uid int(10),
  lang int(6),
  m int(2),
  a int(10),
  b int(10),
  c int(10),
  d int(10),
  e int(10),
  f int(10),
  g int(10),
  h int(10),
  i int(10),
  j int(10),
  PRIMARY KEY (wid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_psem <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_psem_name'){$sql=1;}++$i;}
if (!empty($sql)) {
     echo 'Database Table bible_psem Altered<br>';
} else {#WID, CID, desc id, WORD, UID, M, ALT1, ALT2, ALT3, ALT4, ALT5, ALT6, ALT7, ALT8, ALT9, ALT10
mysql_query('CREATE TABLE IF NOT EXISTS bible_psem_name (
  peid int(10) AUTO_INCREMENT,
  cid int(4),
  name varchar(50),
  ga int(4),
  lang int(6),
  m int(2),
  uid int(10),
  PRIMARY KEY (peid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_psem_name <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_psem_name'){$sql=1;}++$i;}
if (!empty($sql)) {
     echo 'Database Table bible_psew Altered<br>';
} else {#WID, CID, desc id, WORD, UID, M, ALT1, ALT2, ALT3, ALT4, ALT5, ALT6, ALT7, ALT8, ALT9, ALT10
mysql_query('CREATE TABLE IF NOT EXISTS bible_psew (
  wid int(10) AUTO_INCREMENT,
  w varchar(80),
  lang int(6),
  PRIMARY KEY (wid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_psew <b>Created</b><br>';
}

unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_la'){$sql=1;}++$i;}
if (!empty($sql)) {
     echo 'Database Table bible_la Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS `bible_la` (
  lid int(8) AUTO_INCREMENT,
  lc varchar(10),
  la varchar(20),
  PRIMARY KEY (lid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_la <b>Created</b><br>';
$la=explode(',','English|en,German|de,Russian|ru,Japanese|ja,Spanish|es,Chinese|zh,French|fr,Italian|it,Portuguese|pt,Polish|pl,Arabic|ar,Dutch|nl,Turkish|tr,Swedish|sv,Persian|fa,Czech|cs,Romanian|ro,Korean|ko,Greek|grk,Hungarian|hu,Thai|th,Vietnamese|vi,Danish|da,Indonesian|id,Finnish|fi,Norwegian|no,Bulgarian|bg,Slovak|sk,Hebrew|he,Croatian|hr,Lithuanian|lt,Serbian|sr,Catalan|ca,Slovenian|sl,Ukrainian|uk');
sort($la);
 foreach($la as $lat){
     $lat2=explode('|',$lat);
     mysql_query('INSERT INTO `bible_la` (`lid`,`lc`,`la`) values '."('','".$lat2[1]."','".$lat2[0]."');");
 }
      echo'INSERT INTO `bible_la` (`lid`,`lc`,`la`) values '."('','".$lat2[1]."','".$lat2[0]."');".'<br>';
}

# Tri Bible


 

unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_tri_book_name'){$sql=1;}++$i;}// bible_tri_book_name 
if (!empty($sql)) {
     echo 'Database Table bible_tri_book_name Altered<br>';
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_tri_book_name (
  bid2 int(10) unsigned NOT NULL,
  bid int(10) unsigned NOT NULL,
  bkid int(10) unsigned NOT NULL,
  book varchar(3) NOT NULL,
  fname varchar(30) NOT NULL,
  sname varchar(12),
  chap int(10) unsigned NOT NULL,
  PRIMARY KEY (bid2,bkid)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_tri_book_name <b>Created</b><br>';
}
unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_tri_context'){$sql=1;}++$i;}// bible_tri_context 
if (!empty($sql)) {
     echo 'Database Table bible_tri_context Altered<br>';
     #mysql_query('ALTER TABLE bible_tri_context ADD rev int(100) AFTER mode');
     #mysql_query('ALTER TABLE bible_tri_context ADD revuid int(100) AFTER rev');
     #mysql_query('ALTER TABLE bible_tri_context ADD revdate int(11) AFTER revuid');
     #mysql_query('ALTER TABLE bible_tri_context ADD revinfoid int(30) AFTER revdate');
} else {
mysql_query('CREATE TABLE IF NOT EXISTS bible_tri_context (
  vsid int(10) NOT NULL AUTO_INCREMENT,
  bid2 int(10) NOT NULL,
  bid int(10) NOT NULL,
  bk varchar(3) NOT NULL,
  c int(10) unsigned,
  v int(10) unsigned NOT NULL,
  ec int(10) unsigned,
  ev int(10) unsigned,
  lm varchar(1) DEFAULT NULL,
  m INT( 1 ) UNSIGNED NULL DEFAULT NULL,
  rev int(100) DEFAULT NULL,
  revuid int(100) DEFAULT NULL,
  revdate int(11) DEFAULT NULL,
  revinfoid int(10) DEFAULT NULL,
  tx text NOT NULL,
  PRIMARY KEY (vsid),
  KEY idx_bbce (bid2,bk,c,ec),
  KEY idx_bbcve (bid2,bk,c,v,ec,ev)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_tri_context <b>Created</b><br>';
}

unset($sql);$i=0;while($i<$rcount){if(mysql_tablename($result,$i)=='bible_tri_list'){$sql=1;}++$i;} // bible_tri_list 
if (!empty($sql)) {
    #mysql_query('ALTER TABLE bible_list ADD uids VARCHAR(100) AFTER bname');
    #mysql_query('ALTER TABLE bible_list ADD edituids VARCHAR(100) AFTER uids');
    #mysql_query('ALTER TABLE bible_list DROP settings');
    #mysql_query('ALTER TABLE bible_list CHANGE bsn bsn VARCHAR( 7 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL');
    #mysql_query('ALTER TABLE bible_list ADD desc VARCHAR(200) AFTER serialversion');
     echo 'Database Table bible_tri_list Altered<br>';
} else {
# bible_tri_context (bid2, bid, bk, c, v, ec, ev, lm, m, tx)
 # bible_tri_book_name (bid2,bid, bkid, book, fname, sname, chap)
 # bible_tri_list (bsn, bname, lang, serialversion,owner
mysql_query('CREATE TABLE IF NOT EXISTS bible_tri_list (
  bid2 int(10) unsigned NOT NULL AUTO_INCREMENT,
  bid int(10) unsigned,
  bsn varchar(5) NOT NULL,
  bname varchar(40) NOT NULL,
  uids VARCHAR(100),
  edituids VARCHAR(100),
  `global` int(2),
  owner int(40),
  settings VARCHAR(20),
  lang varchar(20) DEFAULT NULL,
  serialversion varchar(10) DEFAULT NULL,
  `desc` VARCHAR(200) DEFAULT NULL,
  PRIMARY KEY (bid2)
) ENGINE=MyISAM CHARACTER SET=utf8 COLLATE=utf8_general_ci;');
echo 'Database Table bible_tri_list <b>Created</b><br>';
}


#
require('inc/benchmark.php');
 } else { 'You must login to create database tables<br>'; }
  mysql_close();
# licence: gpl-signature.txt?>