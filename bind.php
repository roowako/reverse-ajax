<?php

require "db.php";

header("HTTP/1.x 501 Internal Error", true);

$id = @$_COOKIE["message_id"];
if (!$id) $id = 0;

while (mysql_result(mysql_query("select count(*) from messages where id > $id"), 0, 0) < 1) {
	usleep(500000);
}

$query = mysql_query("select * from messages where id > $id order by id");
$data = "";

while ($row = mysql_fetch_assoc($query)) {
	$id = $row["id"];
	$data .= $row["message"] . "<br />";
}

setcookie("message_id", $id);

header("HTTP/1.x 200 OK", true);
echo $data;
