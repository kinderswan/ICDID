<?php
$text = $_REQUEST['text'];
$author = $_REQUEST['author'];
mysql_connect('localhost', 'hleb', 'applehouse');
mysql_select_db('beltatpvh_md01');
mysql_query("INSERT INTO posts VALUES (null, '$text', '$author', NOW())");
?>
