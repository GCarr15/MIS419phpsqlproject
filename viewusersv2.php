<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.bootstrap5.css">
        
        <script defer src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script defer src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
        <script defer src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
        <script defer src="https://cdn.datatables.net/2.2.2/js/dataTables.bootstrap5.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new DataTable('#tableUsers');
            });
        </script>
    </head>
<body>
    <?php
    // This form allows the user to see the information (non-formatted) from the users table
    
    require_once("dbcreds.php");

    echo "About to connect to DB<br>";

    try {
        // Execute SQL SELECT query
        $userSTH = $userDBH->query('SELECT userName, userEmail, userEducation, userGender, userComment FROM users');
        $users = $userSTH->fetchAll(PDO::FETCH_ASSOC);
    ?>
    
    <div class="container mt-4">
        <table id="tableUsers" class="table table-striped" style="width:100%">
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
                <?php foreach ($users as $row) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['userName']); ?></td>
                        <td><?php echo htmlspecialchars($row['userEmail']); ?></td>
                        <td><?php echo htmlspecialchars($row['userEducation']); ?></td>
                        <td><?php echo htmlspecialchars($row['userGender']); ?></td>
                        <td><?php echo htmlspecialchars($row['userComment']); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php
    } catch (PDOException $e) {
        echo "There has been an issue (#35) with the database connection. Please see your administrator.";
        // Uncomment below for debugging (not recommended in production)
        // echo "Error: " . $e->getMessage();
    }
    ?>
</body>
</html>
