<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <title>Set New Password</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <div class="container mt-5">

    <h2 class="text-center mb-4">Set New Password?</h2>

    <!-- Form validation script -->

    
    <?php
    $uuvalue = $_GET['uu'];
    ?>
   

    <!-- Contact form -->
    <form action="storenewpassword.php" method="post" novalidate>
      <div class="form-group row">
        <label class="col-sm-4 col-form-label">Enter your new password:</label>
        <div class="col-sm-8">
          <input type="password" name="newpassword" class="form-control">

          <input type="hidden" name="uutolookup" value="<?php echo $uuvalue; ?>">
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-12 mt-3">
          <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button><br><br>
        </div>
      </div>
    </form>
  </div>
</body>

</html>