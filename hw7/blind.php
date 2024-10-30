<?php

require_once("db.php");

$mysqli = new mysqli(HOSTNAME, DBUSER, DBPASS, DBNAME);

// check connection
if ($mysqli->connect_error) {
    die($mysqli->connect_error);
}

//$mysqli->query("DROP TABLE IF EXISTS logs");
//$sql = "CREATE TABLE IF NOT EXISTS logs (id INT NOT NULL AUTO_INCREMENT, ip VARCHAR(15), agent VARCHAR(255), ts timestamp, PRIMARY key (id))";
//$mysqli->query($sql);
$addr = $mysqli->real_escape_string($_SERVER['REMOTE_ADDR']);
$addr = str_replace('%','\%', $addr);
$addr = str_replace('_','\_', $addr);

$ua = $mysqli->real_escape_string($_SERVER['HTTP_USER_AGENT']);
$ua = str_replace('%','\%', $ua);
$ua = str_replace('_','\_', $ua);

$mysqli->query("INSERT INTO logs (ip, agent, ts) VALUES ('$addr', '$ua', NOW())");

?>

