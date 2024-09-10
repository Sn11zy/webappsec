<?php

header('Access-Control-Allow-Origin: *');

header('Access-Control-Allow-Headers: *');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $data = json_decode(file_get_contents('php://input'), true);
  $response = array("weekday" => date('l',(int)$data["timestamp"]));
  echo json_encode($response);


}
