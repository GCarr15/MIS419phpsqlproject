<?php
	//turn into a log in session to the user
    session_start(); //load the $_SESSION from the folder into an array
    echo $_SESSION['username'];
	
	// This form is called in the userverification.php and validates the fields (email and password) that comes from 
    //userverification.php and verifie and does the Database Lookup in the datatable  -->
   
    // Error messages (email and password)
    $emailEmptyErr = "";
    $passwordEmptyErr = "";
    $emailErr = "";
    $passwordErr = "";

    // define variables and set to empty values. These variables will receive the value of the variables in the $_POST array.
    $email = $password = "";        

    //!isset($_SESSION['useremail']) checks if the user does not have a session variable set 
    if (isset($_POST["submit"])) { //The isset() function checks if the “submit” button was clicked, indicating that the form was submitted
        // Set form variables
       
        $email          = checkInput($_POST["email"]);
        $password       = checkInput($_POST["password"]);
       
        // create a flag variable to determine whether to insert into DB at end of data validation
        $okayToLookupinDB= TRUE; //this variable will be a variable of control and only when the variable are properly validate 
        //it will be OK to Insert into our database 
        // NAME VALIDATION


        // EMAIL VALIDATION
        if(empty($email)){
            $emailEmptyErr = '<div class="error">
                Email can not be left blank. This field is required.
            </div>';
            $okayToLookupinDB = FALSE;

        } // E-mail format validation
        else if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)){
            $emailErr = '<div class="error">
                    Email format is not valid.
            </div>';
            $okayToLookupinDB = FALSE;
        } else {
            //echo $email . '<br>';
        }

        // PASSWORD VALIDATION
         if(empty($password)){
            $passwordEmptyErr = '<div class="error">
                    You need to insert a password. This field is required.
            </div>';
            $okayToLookupinDB = FALSE;
         }} else {
            //echo $password . '<br>';
        }

        
        if($okayToLookupinDB){
            // save the info to the DB
            require_once("dbcreds.php");
           
            # process an SQL to LOOKUP IN THE DATATABLE
            try {
                # prepare the SQL shortcut!

                $userSQL = $userDBH->prepare("SELECT userName, userEmail, userPassword from users WHERE userEmail = :uemail");
                # bind some data values into the named parameters in the prepared statement
                $userSQL->bindParam(':uemail', $email);

                # setting the fetch mode
                $userSQL->setFetchMode(PDO::FETCH_ASSOC);

                # submit the SQL statement to MySQL for processing
                $userSQL->execute();

                while ($row = $userSQL->fetch()) {
                    if (password_verify($password, $row["userPassword"])) {
                        //echo 'Password is valid!<br>';
                        //echo "Congratulations " . checkinput($row["userName"]) . "<br>";
						 //let's record this user's details into our Session array $_SESSION array for future pages (subsequent) processing
                        $_SESSION['username']=$row["userName"];
                        $_SESSION['useremail']=$email;
                        return; // Exit the function or script once a match is found
                    }
                }
                // If no match is found, this part will be executed
                echo "<h2>Sorry, no match found.</h2><br>";
              }
              catch(PDOException $e) {
                  echo "There has been an issue (#35) with the database connection.  Please see your administrator"; // $e->getMessage();
              }
        

    }
    //you can find this function and explanation here: https://www.w3schools.com/PHP/php_form_validation.asp 
    function checkInput($input) {
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        return $input;
    }    
?>