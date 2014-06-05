<?php

$pagenumber = isset($_POST['pagenumber']) ? filter_input(INPUT_POST, 'pagenumber', FILTER_SANITIZE_SPECIAL_CHARS) : '';
$date = isset($_POST['issuedate']) ? filter_input(INPUT_POST, 'issuedate', FILTER_SANITIZE_SPECIAL_CHARS) : '';
$volume = isset($_POST['issuevolume']) ? filter_input(INPUT_POST, 'issuevolume', FILTER_SANITIZE_SPECIAL_CHARS) : '';
$issue = isset($_POST['issuenum']) ? filter_input(INPUT_POST, 'issuenum', FILTER_SANITIZE_SPECIAL_CHARS) : '';
$edition = isset($_POST['issueedition']) ? filter_input(INPUT_POST, 'issueedition', FILTER_SANITIZE_SPECIAL_CHARS) : '';
$flag = isset($_POST['scanflag']) ? filter_input(INPUT_POST, 'scanflag', FILTER_SANITIZE_SPECIAL_CHARS) : '';
$note = isset($_POST['scannote']) ? filter_input(INPUT_POST, 'scannote', FILTER_SANITIZE_SPECIAL_CHARS) : '';
$id = isset($_POST['batchid']) ? filter_input(INPUT_POST, 'batchid', FILTER_SANITIZE_SPECIAL_CHARS) : '';

$batchdb = new PDO("sqlite:batches/$id.sqlite3");
$batchdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$addrow = "INSERT INTO frames (pagenumber, date, volume, issue, edition, flag, note) VALUES ('$pagenumber', '$date', '$volume', '$issue', '$edition', '$flag', '$note')";
$stmt = $batchdb->prepare($addrow);
$stmt->execute();
$batchdb = null; //close db

header('Location: scan.php?id='.$id);

?>