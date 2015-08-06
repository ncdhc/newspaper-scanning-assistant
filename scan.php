<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Scanning Assistant &middot; Scan Batch</title>

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
        <?php 
        // parse supplied batch id
        $batchid = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
        $batchparts = explode("_",$batchid);
        $batchname = $batchparts[0];
        $batchcreator = $batchparts[1];
        $timestamp = $batchparts[2];
        
        
        $batchdb = new PDO("sqlite:batches/$batchid.sqlite3");
        // Set errormode to exceptions
        $batchdb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $batchcountresult = $batchdb->query("SELECT count(*) from frames");
        $lastrowid = $batchdb->lastInsertId();
        $thisrowid = $lastrowid + 1;
        
        $batchcount = '';
        foreach ($batchcountresult as $batchcountrow) {
            $batchcount = $batchcountrow[0];
        }
        
        $lastrowid = $batchcount;
        $thisrowid = $lastrowid + 1;
        
        if($batchcount>0){
        $lastrowresult = $batchdb->query("SELECT * FROM frames WHERE id = '$lastrowid'");
        }
        
        $batchdb = null;
        
        ?>
        <script type="text/javascript">
            function increment(myInput) {
                // use Mike Samuel's code here
                myInput.value = (+myInput.value + 1) || 1;
            }
            function decrement(myInput) {
                myInput.value = Math.max(1, (myInput.value - 1) || 1);
            }

            function frontPage() {
                document.getElementById('pagenumber').value = '1';
                $('.issuealert').fadeIn(200);
                $('.issuealert').fadeOut(200);
                $('.issuealert').fadeIn(200);
                $('.issuealert').fadeOut(200);
                $('.issuealert').fadeIn(200);
           
            }
            
            
        </script>
        <div class="container-fluid">
            <div class="row">
                <h1>Scanning Assistant</h1>
                <p class="textcenter"><?php echo $batchname;?>_<span class="label label-default" style="font-size: 16px"><?php echo sprintf('%04d', $thisrowid);?></span></p>
                <hr>
            </div>
            <form action="addrow.php" method="post">
               
                <div class="row">

                    <div class="boxed">

                        <div class="form-group">
                            <label for="pagenumber">Page Number</label>

                           
                                <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-info btn-lg" onclick="frontPage();">Front Page</button>
                                            <button type="button" class="btn btn-default btn-lg" onclick="decrement(getElementById('pagenumber'));"><span class="glyphicon glyphicon-minus"></span></button>
                                        </span>
                                        <?php
                                        if($batchcount>0) {
                                            foreach($lastrowresult as $lastrow) {
                                                $pagenumvalue =  $lastrow['pagenumber']+1;
                                                $volumevalue = $lastrow['volume'];
                                                $issuevalue = $lastrow['issue'];
                                                $datevalue = $lastrow['date'];
                                                $editionvalue = $lastrow['edition'];
                                            }
                                            // set value to one more than last row's page number
                                        } else {
                                            $pagenumvalue = '1';
                                            $editionvalue = '1';
                                            $volumevalue = '';
                                            $issuevalue = '';
                                            $datevalue = '';
                                        }
                                        ?>
                                        <input type="text" class="form-control input-lg" id="pagenumber" name="pagenumber" value="<?php echo $pagenumvalue;?>">
                                               <span class="input-group-btn">
                                            <button type="button" class="btn btn-default btn-lg" onclick="increment(getElementById('pagenumber'));"><span class="glyphicon glyphicon-plus"></span></button>
                                            
                                        </span>
                                </div>
                               
                           
             
                        </div>
                        <hr>
                        
                            <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                            <label for="issuedate"><span class="glyphicon glyphicon-exclamation-sign issuealert"></span> Date <span class="small muted">i.e., "YYYY-MM-DD"</span></label>

                            <input type="date" class="form-control issuelevel" name="issuedate" id="issuedate" value="<?php echo $datevalue;?>">
                            </div>
                            </div>
                                <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="issuevolume"><span class="glyphicon glyphicon-exclamation-sign issuealert"></span> Volume </label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" onclick="decrement(getElementById('issuevolume'));"><span class="glyphicon glyphicon-minus"></span></button>
                                        </span>
                                        <input type="text" class="form-control issuelevel" id="issuevolume" name="issuevolume" value="<?php echo $volumevalue;?>">

                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" onclick="increment(getElementById('issuevolume'));"><span class="glyphicon glyphicon-plus"></span></button>
                                        </span>
                                    </div>
                                </div>
                                </div>
                            </div>

                        
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="issueedition"><span class="glyphicon glyphicon-exclamation-sign issuealert"></span> Edition </label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" onclick="decrement(getElementById('issueedition'));"><span class="glyphicon glyphicon-minus"></span></button>
                                        </span>
                                        <input type="text" class="form-control issuelevel" id="issueedition" name="issueedition" value="<?php echo $editionvalue;?>">

                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" onclick="increment(getElementById('issueedition'));"><span class="glyphicon glyphicon-plus"></span></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6">

                                <div class="form-group">

                                    <label for="issuenum"><span class="glyphicon glyphicon-exclamation-sign issuealert"></span> Issue </label>

                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" onclick="decrement(getElementById('issuenum'));"><span class="glyphicon glyphicon-minus"></span></button>
                                        </span>
                                        <input type="text" class="form-control issuelevel" id="issuenum" name="issuenum" value="<?php echo $issuevalue;?>">
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-default" onclick="increment(getElementById('issuenum'));"><span class="glyphicon glyphicon-plus"></span></button>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
    
                
                        <div class="input-group" style="margin-top: 10px;">
                            <span class="input-group-addon">
                                <label>
                                    <input type="checkbox" id="scanflag" name="scanflag">
                                    Flag for review
                                </label>
                            </span>
                            <input type="text" id="scannote" name="scannote" class="form-control" placeholder="Optional Note">
                        </div>
                        <hr>
                    </div>
                </div>
                 <div class="row">
                     <input type="hidden" id="batchid" name="batchid" value="<?php echo $batchid;?>">
                    <button type="submit" class="btn btn-warning btn-lg scanbutton"><span class="glyphicon glyphicon-ok"></span> SCAN</button>
                <hr>
                </div>
                <div class="row">
                    <p class="textcenter"><a class="pull-left" target="_blank" href="download.php?id=<?php echo $batchid;?>"><span class="glyphicon glyphicon-check"></span> Check Progress</a><a class="pull-right" href="."><span class="glyphicon glyphicon-log-out"></span> Quit</a></p>
                </div>



            </form>
        </div>
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>

    </body>
</html>