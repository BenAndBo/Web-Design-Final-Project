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
        
        <link rel="stylesheet" href="final.css" type="text/css" media="screen">
              
        
    </head>
    <body>
        <h1>Shred VT</h1>
        <nav>
            <ol>
                <?php
                print '<li class="';
                if ($path_parts['filename'] == "home") {
                    print ' activePage ';
                }
                print '">';
                print '<a href="home.php">Home</a>';
                print '</li>';
                print '<li class="';
                if ($path_parts['filename'] == "news") {
                    print ' activePage ';
                }
                print '">';
                print '<a href="news.php">News</a>';
                print '</li>';
        
                print '<li class="';
                if ($path_parts['filename'] == "resorts") {
                    print ' activePage ';
                }
                print '">';
                print '<a href="resorts.php">Resorts</a>';
                print '</li>';
        
                print '<li class="';
                if ($path_parts['filename'] == "conditions") {
                    print ' activePage ';
                }
                print '">';
                print '<a href="conditions.php">Conditions</a>';
                print '</li>';
        
                print '<li class="';
                if ($path_parts['filename'] == "media") {
                    print ' activePage ';
                }
                print '">';
                print '<a href="media.php">Media</a>';
                print '</li>';
        
                print '<li class="';
                if ($path_parts['filename'] == "contact") {
                    print ' activePage ';
                }
                print '">';
                print '<a href="contact.php">Contact</a>';
                print '</li>';
        
                ?>
            </ol>
        </nav>
