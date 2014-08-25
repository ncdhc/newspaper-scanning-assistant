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
      <h1>Scanning Assistant</h1>
      <hr>
      </div>
      <div class="row">
          <div class="boxed">

              <h2>Start a New Batch</h2>
              <?php if(isset($_GET['error']) && ($_GET['error']=='yes')) {
                  echo "<p class='textcenter text-danger'>Required information is missing. Please try again.</p>";
              } ?>
              <form action="create.php" method="post" id="startbatch">
                  <div class="form-group">
                      <label for="batchname">Batch Name <span class="small muted">i.e., "raefordreel2"</span></label>
                    <input type="text" class="form-control batchinput" id="batchname" name="batchname" placeholder="Enter Batch Name">
                  </div>
                  <div class="form-group">
                    <label for="batchcreator">Batch Creator <span class="small muted">i.e., "lisa"</span></label>
                    <input type="text" class="form-control batchinput" id="batchcreator" name="batchcreator" placeholder="Enter Batch Creator">
                  </div>
                  <button id="startbutton" type="submit" class="btn btn-primary">Start</button>
              </form>
          </div>
          <hr>
      </div>
       
        <div class="row">
            <div class="boxed">
                <h2>Existing Batches</h2>
                <div class="table-responsive">
                <table class="table table-striped">
                    
                    <?php
                    $batchdir = 'batches';
                    $batchfiles = scandir($batchdir);

                    ?>
                    <thead>
                        <tr><th>Name</th><th>Creator</th><th>Scan Method</th><th>Create Date</th><th></th></tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($batchfiles as $batchfile) {
                            if(stristr($batchfile,'.sqlite3')) {
                            $batchid = str_replace('.sqlite3','',$batchfile);
                            $batchparts = explode("_",$batchid);
                            $batchname = $batchparts[0];
                            $batchcreator = $batchparts[1];
                            $timestamp = substr($batchparts[2],0,4).'-'.substr($batchparts[2],4,2).'-'.substr($batchparts[2],6,5).':'.substr($batchparts[2],11,2).':'.substr($batchparts[2],13,2);
                            
                            echo "<tr><td>$batchname</td><td>$batchcreator</td><td>".date('l, F j, Y \a\t g:ia',strtotime($timestamp))."</td><td><a class='btn btn-primary btn-sm' href='download.php?id=$batchid'><span class='glyphicon glyphicon-save'></span></a></td><td><a class='muted pull-right' href='delete.php?id=$batchid'><span class='glyphicon glyphicon-remove'></span></a></td></tr>";
                        
                            }
                        } 
                        ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $('.batchinput').keyup(function() {
            $('.error-keyup').remove();
            $('#startbutton').removeAttr('disabled');
            var inputVal = $(this).val();
            var characterReg = /^[a-zA-Z0-9]+$/;
            if (!characterReg.test(inputVal)) {
                $('#startbatch').before('<p class="text-danger error-keyup"><span class="glyphicon glyphicon-exclamation-sign"></span> No spaces or special characters allowed.</p>');
                $('#startbutton').attr('disabled','disabled');
            }
        });
    </script>
  </body>
</html>