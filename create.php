<?php

include "db.php";

$content = $_POST['text'];

mysql_query("insert into messages values (NULL, '$content', NOW())");

echo @$_COOKIE["message_id"];
