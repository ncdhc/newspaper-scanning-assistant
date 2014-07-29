<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Scanning Assistant</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.darkly.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
               <div class="row">
      <h1>Scanning Assistant</h1>
      <hr>
      </div>
<?php
$batchname = isset($_GET['id']) ? $_GET['id'] : '';
if($batchname !== '') {
    if (isset($_GET['sure'])) {
        $batchdbfile = 'batches/' . $batchname . '.sqlite3';
        unlink($batchdbfile); // delete batch db file
        header("Location: ./");
    } else {
        echo "<h2>Are you sure?</h2>";

        echo "<p>You're about to delete <strong>$batchname</strong>.</p>";

        echo "<a href='./' class='btn btn-default'>Cancel</a> ";
        echo "<a href='delete.php?id=$batchname&sure=yes' class='btn btn-danger'>Yes, Delete it</a>";
    }
    
    } else {
    echo "Error loading database.";
}
?>
     
      </div>
    </div>
  </body>
</html>