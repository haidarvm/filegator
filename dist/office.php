<?php
$path = base64_decode($_GET['path']);
$rpath = str_replace("/", '', $path);
$full_path = dirname(__DIR__).'/repository'.$path;
$filename =  basename($path);       
// echo $filename;exit;
header('Content-Disposition: attachement;filename="'.$filename.'"');
header('Content-Transfer-Encoding: binary');
// readfile('/home/haidar/public_html/test/php/filegatorm/repository'.$path);
readfile($full_path);