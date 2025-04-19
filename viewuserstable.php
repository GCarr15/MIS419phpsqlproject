<?php
//turn into a log in session to the user
session_start(); //load the $_SESSION from the folder into an array
echo $_SESSION['username'];
//echo "<a href='http://mis419schoolproject.com/projectfolder/logout.php'>Click here to Logout</a>"; 
?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.bootstrap5.css">
        
        <script
            src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"></script>

        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script defer src="https://cdn.datatables.net/2.1.3/js/dataTables.js"></script>
        <script defer src="https://cdn.datatables.net/2.1.3/js/dataTables.bootstrap5.js"></script>
        
        <script type="text/javascript">
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script>
    </head>

<body>

<?php
    //This form allows the user to see the information (DataTables.net) from the users table
    // use the user credentials to access the DB
    require_once("dbcreds.php");
    # get connected to the DB
    # process an SQL SELECT
    try {

            # values in the select statement. 
            $userSTH = $userDBH->query('SELECT userName, userEmail, userEducation, userGender, userComment from users');
            
            # setting the fetch mode 
            $userSTH->setFetchMode(PDO::FETCH_ASSOC);
            ?>
            
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Education</th>
                        <th>Gender</th>
                        <th>Comment</th>
                    </tr>
                </thead>
                <tbody>  
            <?php
            while($row = $userSTH->fetch()) {
                    echo "<tr>";
                    echo "<td>" . $row['userName']       . "</td>";
                    echo "<td>" . $row['userEmail']      . "</td>";
                    echo "<td>" . $row['userEducation']  . "</td>";
                    echo "<td>" . $row['userGender']     . "</td>";
                    echo "<td>" . $row['userComment']    . "</td>";
                    echo "</tr>";
            } ?>
            </tbody>
            </table>
            <?php
            }
            catch(PDOException $e) {
                echo "There has been an issue (#35) with the database connection.  Please see your administrator"; // $e->getMessage();
        }
    ?>
</body>
</html> 