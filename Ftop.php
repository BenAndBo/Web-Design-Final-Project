<?php
$phpSelf = htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES, "UTF-8");
$path_parts = pathinfo($phpSelf);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Shred VT</title>
        
        <meta charset="UTF-8">
        <meta name="Author" content="Ben Wasser and Bo Warren">
        <meta name="Description" content="news, statistics, and images of vermont skiing and snowboarding">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="Final.css" type="text/css" media="screen">
              
        
  <?php
  $debug = false;
          if(isset($_GET["debug"])) {
              $debug = true;
          }
          
 
//%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%          
          
          $domain = "//";
          
          $server = htmlentities($_SERVER['SERVER_NAME'], ENT_QUOTES, 'UTF-8');
          
          $domain .= $server;
          
          
            if ($debug) {
                print '<p>php Self: ' . $phpSelf;
                print '<p>Path Parts<pre>';
                print_r($path_parts);
                print '</pre></p>';
            }
        
        print  PHP_EOL . '<!-- include libraries -->' . PHP_EOL;
 
        require_once('lib/security.php');
        
        if ($path_parts['filename'] == "vote") {
            print PHP_EOL . '<!-- include form libraries -->' . PHP_EOL;
            include 'lib/validation-functions.php';
            include 'lib/mail-message.php';
        }
        
        print  PHP_EOL . '<!-- finished including libraries -->' . PHP_EOL;
?>

    </head>
    <!-- ################ body section ######################### -->

    <?php
    print '<body id="' . $path_parts['filename'] . '">';
    include 'Fheader.php';
    include 'Fnav.php';
    if ($debug) {
        print '<p>DEBUG MODE IS ON</p>';
    }
   
    ?>
