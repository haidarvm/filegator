<?php
$path = base64_decode($_GET['path']);
$rpath = str_replace("/", '', $path);
header('Content-Disposition: attachement;filename="'.$rpath.'"');
header('Content-Transfer-Encoding: binary');
// readfile('/home/haidar/public_html/test/php/filegatorm/repository'.$path);
readfile(dirname(__FILE__).'/../repository'.$path);