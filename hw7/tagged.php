<?php
if (isset($_SERVER['HTTP_IF_NONE_MATCH'])){
$goob = $_SERVER['HTTP_IF_NONE_MATCH'];
}else{
$goob = bin2hex(random_bytes(10));
}
header('Content-Type: image/png');
header('Etag: '.$goob);
header('Cache-control: max-age=0, must-revalidate' );
ob_clean();
readfile('tagged.png');
?>
