<?php
include 'Ftop.php';

// Open a CSV file
$debug = false;
if(isset($_GET["debug"])){
     $debug = true; 
}

$myFolder = '';

$myFileName = 'resorts';

$fileExt = '.csv';

$filename = $myFolder . $myFileName . $fileExt;

if ($debug) print '<p>filename is ' . $filename;

$file=fopen($filename, "r");

if($debug){
    if($file){
       print '<p>File Opened Succesful.</p>';
    }else{
       print '<p>File Open Failed.</p>';
     }
} 

if($file){
    if($debug) print '<p>Begin reading data into an array.</p>';

    // read the header row, copy the line for each header row
    // you have.
    $headers[] = fgetcsv($file);

    if($debug) {
         print '<p>Finished reading headers.</p>';
         print '<p>My header array</p><pre>';
         print_r($headers);
         print '</pre>';
     }

     // read all the data
     while(!feof($file)){
         $resortDetails[] = fgetcsv($file);
     }

     if($debug) {
         print '<p>Finished reading data. File closed.</p>';
         print '<p>My data array<p><pre> ';
         print_r($resortDetails);
         print '</pre></p>';
     }
}

fclose($file);

?>

        <h2>Resorts</h2>
        <table id="resortsTable">
            <tr>
                <th>Resort</th>
                <th>Number of Trails</th>
                <th>Miles of Trail</th>
                <th>Skiable Acres</th>
                <th>Lifts</th>
                <th>Summit</th>
                <th>Vertical</th>
                <th>Terrain Parks</th>
            </tr>
<?php

$lastResort="";

foreach($resortDetails as $resortDetail) {
    if ($lastResort != $resortDetail[0]) {
        print '<tr>';
        print '<td>';
        print $resortDetail[0];
        print '</td>';
        print '<td>';
        print $resortDetail[1];
        print '</td>';
        print '<td>';
        print $resortDetail[2];
        print '</td>';
        print '<td>';
        print $resortDetail[3];
        print '</td>';
        print '<td>';
        print $resortDetail[4];
        print '</td>';
        print '<td>';
        print $resortDetail[5];
        print '</td>';
        print '<td>';
        print $resortDetail[6];
        print '</td>';
        print '<td>';
        print $resortDetail[7];
        print '</td>';
        print '</tr>';
        $lastResort = $resortDetail[0];
    }
}
?>
        </table>

    </body>
</html>
