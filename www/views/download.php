<?php 
if(!isset($_GET['filename'])) {echo "file not found"; return; } $filename = $_GET['filename']; $filepath = dirname(__FILE__)."/download/".$_GET['filename'];
if(!file_exists($filepath)) { echo "file not found ". $filepath; return; } else { header("Content-Type: application/octet-stream"); header("Content-Disposition: attachment; filename=\"$filename\"; filename*=UTF-8''".urlencode($_GET['filename'])); header("Content-Transfer-Encoding: binary"); header("Content-Length: ".(string)filesize($filepath)); header("Cache-Control: cache, must-revalidate"); header("Pragma: no-cache"); header("Expires: 0"); readfile($filepath); } ?>