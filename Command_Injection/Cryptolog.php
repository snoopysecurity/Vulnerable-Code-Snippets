<?php
include("config.php");
require_once("kontrol.php");
$opt=$_POST['opt'];
$lsid=$_POST['lsid'];
$sharetype=$_POST['lssharetype'];
$remoteaddress=$_POST['lsremoteaddress'];
$sharefolder=$_POST['lssharefolder'];
$user=$_POST['lsuser'];
$pass=$_POST['lspass'];
$domain=$_POST['lsdomain'];
$dbConn = mysql_connect(DB_HOST, DB_USER, DB_PASS);
if (!$dbConn) die ("Out of service");
mysql_select_db(DB_DATABASE, $dbConn) or die ("Out of service");
include("classes/logshares_class.php");
if($opt=='del')
{
  cLogshares::fDeleteFileshareDB($dbConn,$lsid);
}
else if($opt=='add')
{
  cLogshares::fAddFileshareDB($dbConn,$sharetype,$remoteaddress,$sharefolder,$user,$pass,$domain);
}
else if($opt=='check')
{
  echo cLogshares::fTestFileshare("/mnt/logsource_".$lsid."_".$sharetype);
}
else if($opt=='mount')
{
  cLogshares::fMountFileshareOnly($dbConn,$lsid,$sharetype);
  echo cLogshares::fTestFileshare("/mnt/logsource_".$lsid."_".$sharetype);
}

function fTestFileshare($sharefolder)
{
  $output = shell_exec('sudo /opt/cryptolog/scripts/testmountpoint.sh '.$sharefolder);
  return trim($output);
}
?>
