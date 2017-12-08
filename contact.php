<?php
include 'Ftop.php';

//
// Section: 1 initialize variables
// Section: 1a
if ($debug) {
    print '<p>Post Array:</p><pre>';
    print_r($_POST);
    print '</pre>';
}

//
// SECTION: 1b Security
//
// define security variable to be used in SECTION 2a.
$thisURL = $domain . $phpSelf;

// SECTION: 1c form variables
//
// Initialize variables one for each form element
// in the order they appear on the form

$firstName = "";

$email = "";

$vote = "";

$comment = "";

$visited = "";

//
// SECTION: 1d form error flags
//
// Initialize Error Flags one for each form element we validate
// in the order they appear in section 1c.
$firstNameERROR = false;

$emailERROR = false;

$voteERROR = false;

$commentERROR = false;

$visitedERROR = false;

//
// SECTION: 1e misc variables
//
$errorMsg = array();

$dataRecord = array();

$mailed = false;
 
 
// SECTION: 2 Process for when the form is submitted
if (isset($_POST["btnSubmit"])) {
    
    //
    // Section: 2A Security
    //
    if (!securityCheck($thisURL)) {
        $msg = '<p>Sorry, you cannot access this page. ';
        $msg.= 'Security breach detected and reported.</p>';
        die($msg);
    }

    //
    // Section: 2b sanitize data
    //
    $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $firstName;
    
    $email = filter_var($_POST["txtEmail"], FILTER_SANITIZE_EMAIL);
    $dataRecord[] = $email;  
    
    $vote = htmlentities($_POST["txtVote"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $vote;
    
    $comment = htmlentities($_POST["txtComment"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $comment; 
    
    $visited = htmlentities($_POST["txtVisited"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $visited;

    //
    // Section: 2c validation
    //
    if ($firstName == "") {
        $errorMsg[] = "<p class='mistake'>Please enter your first name.</p>";
        $firstNameERROR = true;
    } elseif (!verifyAlphaNum($firstName)) {
        $errorMsg[] = "<p class='mistake'>Your first name appears to have extra characters.</p>";
        $firstNameERROR = true;
    }
    
    if ($email == "") {
        $errorMsg[] = '<p class="mistake">Please enter your email address.</p>';
        $emailERROR = true;
    } elseif (!verifyEmail($email)) {
        $errorMsg[] = '<p class="mistake">Your email address appears to be incorrect.</p>';
        $emailERROR = true;
    }
    
    if ($vote == "") {
        $errorMsg[] = '<p class="mistake">Please cast your vote for your favorite VT resort.</p>';
        $voteERROR = true;
    }
    
    if ($comment == "") {
        $errorMsg[] = '<p class="mistake">Please comment on your favorite resort.</p>';
        $commentERROR = true;
    }
    
    if ($visited == "") {
        $errorMsg[] = '<p class="mistake">Please fill out atleast one of the checkboxes.</p>';
        $visitedERROR = true;
    }
    
    //
    // Section: 2d Proccess Form - Passed Validation
    //
    if (!$errorMsg) {
        if ($debug)
            print '<p>Form is valid</p>';
    
    //
    // Section: 2e Save Data
    //
        $myFolder = '';
        
        $myFileName = 'vote';
        
        $fileExt = '.csv';
        
        $filename = $myFolder . $myFileName . $fileExt;
        
        if ($debug) print PHP_EOL . '<p>filename is ' . $filename . '</p>';
        $file = fopen($filename, 'a');
        
        fputcsv($file, $dataRecord);
        
        fclose($file);
        
    //
    // Section: 2f Create Message
    //
        $message = "<p>Thank you for voting, " . $firstName . "! We appreciate your input!</p><p>Your favorite VT resort is " . $vote . "</p><p>Because...<br>" . $comment . "</p>";
    
    //
    // Section: 2g Mail to user
    //
        $to = $email;
        $cc = '';
        $bcc = '';
        
        $from = 'ShredVT <robert.warren-iii@uvm.edu>';
        
        $subject = 'Thank You for Voting on ShredVT!';
        
        $mailed = sendMail($to, $cc, $bcc, $from, $subject, $message);
        
    } // end form is valid
    
} // ENDS IF FORM SUBMITTED
?>

        <article>

        <?php
        //
        // Section: 3a
        //
        if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { // closing of if marked with: end body submit
            
            print '<h2>Vote!</h2>';
            
            print '<article id="messageArticle">';
            
            print $message;
            
            print '<p>Your response has ';
        
            if (!$mailed) {
                print "not ";
            }
        
            print 'been sent to:</p>';
            print '<p>' . $email . '</p>';
        
        } else {
            print '<h2>Vote!</h2>';
        
            //
            // Section: 3b error messages
            //
            if ($errorMsg) {
                print '<div id="errors">' . PHP_EOL; 
                print '<ul>' . PHP_EOL;

                foreach ($errorMsg as $err) {
                    print '<li>' . $err . '</li>' . PHP_EOL;
                }
            
                print '</ul>' . PHP_EOL;
                print '</div>' . PHP_EOL;
            }
        ?>
        <form action="<?php print $phpSelf; ?>" method="post">
            <fieldset>
                <legend>Contact Information</legend>
                <p>
                    <label for="txtFirstName">First Name</label> 
                    <br>
                        <input autofocus
                                <?php if ($firstNameERROR) print 'class="mistake"'; ?>
                                id="txtFirstName"
                                maxlength="45"
                                name="txtFirstName"
                                onfocus="this.select()"
                                placeholder="Enter your first name"
                                tabindex="100"
                                type="text"
                                value="<?php print $firstName; ?>"                    
                        >
                </p>
                <p>
                    <label for="txtEmail">Email</label>
                    <br>
                    <input
                        <?php if ($emailERROR) print 'class="mistake"'; ?>
                        id="txtEmail"
                        maxlength="45"
                        name="txtEmail"
                        onfocus="this.select()"
                        placeholder="Enter your email address"
                        tabindex="120"
                        type="text"
                        value="<?php print $email; ?>"
                    >
                </p>
            </fieldset>
            <fieldset>
                <legend>Please, vote for your favorite resort and comment why you love it!</legend>
                <label for="txtVote"></label>
            <?php
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
            
            $lastResort = "";
            
            foreach($resortDetails as $resortDetail) {
                if ($lastResort != $resortDetail[0]) {
                    print '<input type="radio" name="txtVote" value="' . $resortDetail[0] . '"/>';
                    print $resortDetail[0];
                    print '<br>';
                    $lastResort = $resortDetail[0];
                }
            }
            ?>
            </fieldset>
            <fieldset>
                <legend>Thank you for voting! Please comment on your favorite resort!</legend>
                <label for="txtComment"></label>
                <textarea name="txtComment" cols="50" rows="6"></textarea>
            </fieldset>
            <fieldset>
                <legend>Please check all the places you have been to give us more insight!</legend>
                <label for="txtVisited"></label>
            <?php
          
            $lastResort = "";
            
            foreach($resortDetails as $resortDetail) {
                if ($lastResort != $resortDetail[0]) {
                    print '<input type="checkbox" name="txtVisited" value="' . $resortDetail[0] . '"/>';
                    print $resortDetail[0];
                    print '<br>';
                    $lastResort = $resortDetail[0];
                }
            }
            ?>
                <input type="checkbox" name="txtVisited" value="never">I have never been to any of these
            </fieldset>
            <fieldset>
                <input name="btnSubmit" type="submit" value="Submit">
            </fieldset>
        </form>
        <?php
        }
        ?>
        </article>
<?php
include 'Ffooter.php';
?>
    </body>
</html>
