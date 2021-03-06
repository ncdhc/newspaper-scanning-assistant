<?php

$batchid = isset($_GET['id']) ? $_GET['id'] : '';
$batchparts = explode("_",$batchid);
$batchname = $batchparts[0];

if($batchid !== '') {

$batchdb = new PDO("sqlite:batches/$batchid.sqlite3");
$batchdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$batchresult = $batchdb->query("SELECT * FROM frames");

$batchfields = $batchdb->query('SELECT * from frames limit 1');
$columns = array_keys($batchfields->fetch(PDO::FETCH_ASSOC));

header("Content-type: text/plain");

$columnrow = implode("\t",$columns);
$tab_output = $columnrow."\n";


foreach ($batchresult as $row) {

    $rowarray = array();
    foreach ($columns as $column) {
        if($column == 'id'){
        $rowarray[] = $batchname."_".str_pad($row[$column], 4, '0', STR_PAD_LEFT);
        } else {
        $rowarray[] = $row[$column];
        }
    }
    
    $rowstring = implode("\t",$rowarray);
    $tab_output .= $rowstring."\n";

}

echo $tab_output;
$batchdb = null;

} else {
    echo "Error loading database.";
}
?>
