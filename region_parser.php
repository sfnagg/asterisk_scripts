<?php

ini_set('memory_limit', '1G');

$config['mysql_host'] = 'localhost';
$config['mysql_user'] = 'username';
$config['mysql_password'] = 'password';
$config['mysql_base'] = 'database';

$mysql = mysqli_connect($config['mysql_host'],$config['mysql_user'],$config['mysql_password']);
mysqli_select_db($mysql, $config['mysql_base']);
mysqli_query($mysql, "SET NAMES 'utf8'");
mysqli_query($mysql, "TRUNCATE TABLE `num`");

$filename=array(
    'DEF-9xx.html',
    'ABC-3xx.html',
    'ABC-4xx.html',
    'ABC-8xx.html'
);

$re='@<tr><td>(\d+)</td><td>(\d+)</td><td>(\d+)</td><td>(\d+)</td><td>(.+)</td><td>(.+)</td></tr>@umx';

foreach ($filename as $fn){
    print($fn."\n");
    $txt = file_get_contents($fn);
    $txt = mb_convert_encoding($txt, 'utf-8', mb_detect_encoding($txt));
    $txt=str_replace("\t",'',$txt);

    preg_match_all($re,$txt,$result,PREG_SET_ORDER);
    foreach ($result as $match){
	$region_last = trim(preg_replace("/.*\|/Uu", "", $match[6]));
	$region_first = trim(preg_replace("/\|(.*)$/Uu", "", $match[6]));
        mysqli_query($mysql, "INSERT INTO `num` VALUES ('". mysqli_real_escape_string($mysql, $match[1])."', '". mysqli_real_escape_string($mysql, $match[2])."', '". mysqli_real_escape_string($mysql, $match[3])."', '". mysqli_real_escape_string($mysql, $match[4])."','". mysqli_real_escape_string($mysql, $match[5])."','". mysqli_real_escape_string($mysql, $match[6])."', '".mysqli_real_escape_string($mysql, $region_last)."', '".mysqli_real_escape_string($mysql, $region_first)."')");
    }
}
mysqli_close($mysql);
?>
