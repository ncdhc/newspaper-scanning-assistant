<?php

$name = isset($_POST['batchname']) ? filter_input(INPUT_POST, 'batchname', FILTER_SANITIZE_STRING) : '';
$creator = isset($_POST['batchcreator']) ? filter_input(INPUT_POST, 'batchcreator', FILTER_SANITIZE_STRING) : '';
$method = isset($_POST['scanmethod']) ? filter_input(INPUT_POST, 'scanmethod', FILTER_SANITIZE_STRING) : '';
$timestamp = date('Ymd\THis');

if($name == '' || $creator== '' || $method == '') {
    header('Location: index.php?error=yes');
} else {
  $filenamestring = $name."_".$creator."_".$method."_".$timestamp;
  // create sqlite file
  
    $batchdb = new PDO("sqlite:batches/$filenamestring.sqlite3");
    $batchdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $batchdb->exec("CREATE TABLE IF NOT EXISTS frames (id INTEGER PRIMARY KEY, pagenumber TEXT, date TEXT, volume TEXT, issue TEXT, edition TEXT, flag TEXT, note TEXT)");
    $batchdb = null;
  
  // send to scan.php
   header( 'Location: scan.php?id='.$filenamestring ) ;
}

?>