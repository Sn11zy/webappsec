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

$stmt = $mysqli->prepare("INSERT INTO logs (ip, agent, ts) VALUES (?, ?, NOW())");
$stmt -> bind_param("ss", $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']);
$stmt -> execute();

?>
