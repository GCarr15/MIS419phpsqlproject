<!doctype html>
<!-- This form allows the user to insert the values in a html form  -->
<!--The css used in this form is from //https://github.com/romanrts/registration_form -->
<html>
<head>
  <meta charset="utf-8">
  <title>Register Form in PHP</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css"> 
</head>

<body>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Users Verification Form</h2>
    
    <!-- Form validation script -->
    <?php include('verify_user.php'); ?>

    <?php
    ?>

    <!-- Contact form -->
  
    <form action="" method="post" novalidate>
      
      <div class="form-group row" >
        <label class="col-sm-4 col-form-label">Email</label>
        <div class="col-sm-8">
          <input type="email" name="email" class="form-control" value="<?php echo $email; ?>">
          <!-- Error -->
          <?php echo $emailEmptyErr; ?>
          <?php echo $emailErr; ?>

        </div>
      </div>

      <div class="form-group row" >
        <label class="col-sm-4 col-form-label">Password</label>
        <div class="col-sm-8">
          <input type="password" name="password" class="form-control" value="">
          <!-- Error -->
          <?php echo $passwordEmptyErr; ?>
        </div>
      </div>
        <div class="form-group row">
            <div class="col-sm-12 mt-3">
                <button type="submit" name="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
        </div>
    </form>
  </div>
</body>

</html>