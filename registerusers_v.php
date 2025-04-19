<?php
    // This form is called in the registerusers.php and validates the fields that comes from registerusers.php
    // and insert in the database  -->
   
    // Error messages
    $nameEmptyErr = "";
    $emailEmptyErr = "";
    $passwordEmptyErr = "";
    $educationEmptyErr = "";
    $genderEmptyErr = "";
    $commentEmptyErr = ""; 
    $dateofbirthEmptyErr = "";
    $nameErr = "";
    $emailErr = "";
    $dateofbirthErr = "";
    $passwordErr = "";

    // define variables and set to empty values. These variables will receive the value of the variables in the $_POST array.
    $name = $email = $gender = $comment = $password = $education = $dateofbirth = "";        

    var_dump($_POST); //printing the $_POST Associative Array (key, value)
    //isset variable The isset() function checks whether a variable is set, which means that it has to be declared and is not NULL.
    //This function returns true if the variable exists and is not NULL, otherwise it returns false.
    //check the variable description here https://www.w3schools.com/PHP/func_var_isset.asp 
    if(isset($_POST["submit"])) { //The isset() function checks if the “submit” button was clicked, indicating that the form was submitted
        // Set form variables
        $name           = checkInput($_POST["name"]);
        $email          = checkInput($_POST["email"]);
        $password       = checkInput($_POST["password"]);
        $education      = checkInput($_POST["education"]);
        $gender         = checkInput($_POST["gender"]);
        $comment        = checkInput($_POST["comment"]);
        $dateofbirth    = checkInput($_POST["dateofbirth"]);

        // create a flag variable to determine whether to insert into DB at end of data validation
        $okayToSaveInDB = TRUE; //this variable will be a variable of control and only when the variable are properly validate 
        //it will be OK to Insert into our database 
        // NAME VALIDATION
        if(empty($name)){ //The empty() function checks whether a variable is empty or not. 
            $nameEmptyErr = '<div class="error">
                Name can not be left blank. This field is required.
            </div>';
            $okayToSaveInDB = FALSE;
        } // Allow letters and white space 
        else if(!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = '<div class="error">
                Only letters and white space allowed.
            </div>';
            $okayToSaveInDB = FALSE;
        } else {
           // echo $name . '<br>';
        }

        // EMAIL VALIDATION
        if(empty($email)){
            $emailEmptyErr = '<div class="error">
                Email can not be left blank. This field is required.
            </div>';
            $okayToSaveInDB = FALSE;

        } // E-mail format validation
        else if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)){
            $emailErr = '<div class="error">
                    Email format is not valid.
            </div>';
            $okayToSaveInDB = FALSE;
        } else {
            //echo $email . '<br>';
        }

        // PASSWORD VALIDATION
         if(empty($password)){
            $passwordEmptyErr = '<div class="error">
                    You need to insert a password. This field is required.
            </div>';
            $okayToSaveInDB = FALSE;
         }} else {
            //echo $password . '<br>';
        }

        // EDUCATION VALIDATION
        if(empty($education)){
            $educationEmptyErr = '<div class="error">
                Select the Education. This field is required.
            </div>';
            $okayToSaveInDB = FALSE;
        } else {
            //echo $education . '<br>';
        }

        // GENDER VALIDATION
        if(empty($gender)){
            $genderEmptyErr = '<div class="error">
                Select your gender. This field is required.
            </div>';
            $okayToSaveInDB = FALSE;
        } else {
            //echo $gender . '<br>';
        }

        // TEXT-AREA VALIDATION
        if(empty($comment)){
            $commentEmptyErr = '<div class="error">
                Add a commment. This field is required.
            </div>';
            $okayToSaveInDB = FALSE;
        } else {
            //echo $comment . '<br>';
        }

        // DATE OF BIRTH VALIDATION
        if(empty($dateofbirth)){
            $dateofbirthEmptyErr = '<div class="error">
                Date of birth can not be left blank.
            </div>';
            $okayToSaveInDB = FALSE;

        } // Date of birth format validation
        else if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$dateofbirth)){
            $dateofbirthErr = '<div class="error">
                    Date of birth format is not valid.
            </div>';
            $okayToSaveInDB = FALSE;
        } else {
            //echo $dateofbirth . '<br>';
        }
        
        if($okayToSaveInDB){
            // save the info to the DB
            require_once("dbcreds.php");
           
            # process an SQL INSERT
            try {
                # prepare the SQL shortcut!

                # prepare the SQL shortcut!
                $userSQL = $userDBH->prepare("INSERT INTO users (userName, userEmail, userPassword, userEducation, userGender, userComment, userDOB) value 
                   (:uname, :uemail, :upassword, :ueducation, :ugender, :ucomment, :udate)");

                # bind some data values into the named parameters in the prepared statement
                $userSQL->bindParam(':uname', $name);
                $userSQL->bindParam(':uemail', $email);

                $hashpassword = password_hash($password, PASSWORD_DEFAULT);

                $userSQL->bindParam(':upassword', $hashpassword);
                $userSQL->bindParam(':ueducation', $education);
                $userSQL->bindParam(':ugender', $gender);
                $userSQL->bindParam(':ucomment', $comment);
                $userSQL->bindParam(':udate', $dateofbirth);

                # submit the SQL statement to MySQL for processing
                $userSQL->execute();
               
              }
              catch(PDOException $e) {
                  echo "There has been an issue (#33) with your database.  Please see your administrator"; // $e->getMessage();
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