<?php

require_once("/home/rconfig/classes/usersession.class.php");
require_once("/home/rconfig/classes/ADLog.class.php");
require_once("/home/rconfig/config/functions.inc.php");

$log = ADLog::getInstance();
if (!$session->logged_in) {
    echo 'Don\'t bother trying to hack me!!!!!<br /> This hack attempt has been logged';
    $log->Warn("Security Issue: Some tried to access this file directly from IP: " . $_SERVER['REMOTE_ADDR'] . " & Username: " . $session->username . " (File: " . $_SERVER['PHP_SELF'] . ")");
    // need to add authentication to this script
    header("Location: " . $config_basedir . "login.php");
} else {

    require_once("../../../classes/db2.class.php");

    $db2 = new db2();
    $log = ADLog::getInstance();

// simple script runtime check 
    $Start = getTime();

    $errors = array();

    if (isset($_GET['searchTerm']) && is_string($_GET['searchTerm']) && !empty($_GET['searchTerm'])) {
        /* validation */
        $searchTerm = '"' . $_GET['searchTerm'] . '"';
        $catId = $_GET['catId'];
        $catCommand = $_GET['catCommand'];
        $nodeId = $_GET['nodeId'];
        $grepNumLineStr = $_GET['numLinesStr'];
        $grepNumLine = $_GET['noLines'];
        $username = $_SESSION['username'];

        // if nodeId was empty set it to blank
        if (empty($nodeId)) {
            $nodeId = '';
        } else {
            $nodeId = '/' . $nodeId . '/';
        }

        $returnArr = array();

        // Get the category Name from the Category selected    
        $db2->query("SELECT categoryName from `categories` WHERE id = :catId");
        $db2->bind(':catId', $catId);
        $resultCat = $db2->resultset();
        $returnArr['category'] = $resultCat[0]['categoryName'];

        // get total file count
        $fileCount = array();
        $subDir = "";
        if (!empty($returnArr['category'])) {
            $subDir = "/" . $returnArr['category'];
        }

        exec("find /home/rconfig/data" . $subDir . $nodeId . " -maxdepth 10 -type f | wc -l", $fileCountArr);
        $returnArr['fileCount'] = $fileCountArr['0'];

        //next find all instances of the search term under the specific cat/dir
        $command = 'find /home/rconfig/data' . $subDir . $nodeId . ' -name ' . $catCommand . ' | xargs grep -il ' . $grepNumLineStr . ' ' . $searchTerm . ' | while read file ; do echo File:"$file"; grep ' . $grepNumLineStr . ' ' . $searchTerm . ' "$file" ; done';
        // echo $command;die();
        exec($command, $searchArr);
