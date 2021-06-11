<?php

//MySQL Data

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'whitelist';

if (isset(getallheaders()["Syn-Fingerprint"])) {
	

$string = $_GET["key"];

$HWID = getallheaders()["Syn-Fingerprint"];

function sha384($text) {
    return hash("sha384", $text);
};

$hashedHWID = sha384(getallheaders()["Syn-Fingerprint"]);

$db = mysqli_connect($host, $username, $password, $database) or die('Not Connected'); 
mysqli_set_charset($db, 'utf8');

$sql = mysqli_query($db,"SELECT * FROM `keys` WHERE `keys`='$string'");
$sql = mysqli_fetch_assoc($sql);
$Checker = $sql['keys'];

$sql2 = mysqli_query($db,"SELECT * FROM `hwid` WHERE hwid='$hashedHWID'");
$sql2 = mysqli_fetch_assoc($sql2);
$Checker2 = $sql2['hwid'];

if  ($Checker != null) {

    $whitelisted = fopen("scripts/whitelisted.lua", "r") or die("Unable to open script!");

    echo fread($whitelisted,filesize("scripts/whitelisted.lua"));

    fclose($whitelisted);

    mysqli_query($db,"DELETE FROM `hwid` WHERE hwid ='$hashedHWID'");
    mysqli_query($db,"DELETE FROM `keys` WHERE `keys` ='$string'"); 
    mysqli_query($db, "INSERT INTO `hwid` (`hwid`) VALUES ('$hashedHWID')"); 

} elseif ($Checker2 != null) {
    $whitelisted = fopen("scripts/whitelisted.lua", "r") or die("Unable to open script!");

    echo fread($whitelisted,filesize("scripts/whitelisted.lua"));

    fclose($whitelisted);
    
} else {
    $notwhitelisted = fopen("scripts/notwhitelisted.lua", "r") or die("Unable to open script!");

    echo fread($notwhitelisted,filesize("scripts/notwhitelisted.lua"));

    fclose($notwhitelisted);
}

} elseif (isset(getallheaders()["Fingerprint"])) { 

    $string = $_GET["key"];

$HWID = getallheaders()["Fingerprint"];

function sha384($text) {
    return hash("sha384", $text);
};

$hashedHWID = sha384(getallheaders()["Fingerprint"]);

$db = mysqli_connect($host, $username, $password, $database) or die('Not Connected'); 
mysqli_set_charset($db, 'utf8');

$sql = mysqli_query($db,"SELECT * FROM `keys` WHERE `keys`='$string'");
$sql = mysqli_fetch_assoc($sql);
$Checker = $sql['keys'];

$sql2 = mysqli_query($db,"SELECT * FROM `hwid` WHERE hwid='$hashedHWID'");
$sql2 = mysqli_fetch_assoc($sql2);
$Checker2 = $sql2['hwid'];

if  ($Checker != null) {

    $whitelisted = fopen("scripts/whitelisted.lua", "r") or die("Unable to open script!");

    echo fread($whitelisted,filesize("scripts/whitelisted.lua"));

    fclose($whitelisted);

    mysqli_query($db,"DELETE FROM `hwid` WHERE hwid ='$hashedHWID'");
    mysqli_query($db,"DELETE FROM `keys` WHERE `keys` ='$string'"); 
    mysqli_query($db, "INSERT INTO `hwid` (`hwid`) VALUES ('$hashedHWID')"); 

} elseif ($Checker2 != null) {
    $whitelisted = fopen("scripts/whitelisted.lua", "r") or die("Unable to open script!");

    echo fread($whitelisted,filesize("scripts/whitelisted.lua"));

    fclose($whitelisted);
    
} else {
    $notwhitelisted = fopen("scripts/notwhitelisted.lua", "r") or die("Unable to open script!");

    echo fread($notwhitelisted,filesize("scripts/notwhitelisted.lua"));

    fclose($notwhitelisted);
}



}

?>
