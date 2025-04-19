<!doctype html>
<!-- This form allows the user to insert the values in a html form  -->
<!--The css used in this form is from https://github.com/romanrts/registration_form -->


<html>
<head>
  <meta charset="utf-8">
  <title>Register User Form</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css"> 

</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Register Users Form</h2>
    
    <!-- Contact form -->
    <form action="" method="post" novalidate>
      <div class="form-group row">
        <label class="col-sm-4 col-form-label">Name</label>
        <div class="col-sm-8">
          <input type="text" name="name" class="form-control" value="">

         

        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-4 col-form-label">Email</label>
        <div class="col-sm-8">
          <input type="email" name="email" class="form-control" value="">

          

        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-4 col-form-label">Password</label>
        <div class="col-sm-8">
          <input type="password" name="password" class="form-control" value="">
         
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-4 col-form-label">Date of Birth</label>
        <div class="col-sm-8">
          <input type="dateofbirth" name="dateofbirth" class="form-control" value="">

         
        </div>
      </div>

      <div class="form-group row">
        <label class="col-sm-4 col-form-label">Education</label>
        <div class="col-sm-8">
          <select id="education" name="education" class="form-control">
            <option selected="" disabled>...</option>
            <option value="Graduation">Graduation</option>
            <option value="Post Graduation">Post Graduation</option>
          </select>

        </div>
      </div>

      <fieldset class="form-group">
        <div class="row">
          <legend class="col-form-label col-sm-4 pt-0">Gender</legend>
          <div class="col-sm-8">
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="male" name="gender" value="Male" class="custom-control-input">
              <label class="custom-control-label" for="male">Male</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
              <input type="radio" id="female" name="gender" value="Female" class="custom-control-input">
              <label class="custom-control-label" for="female">Female</label>
            </div>

           
          </div>
        </div>
      </fieldset>
      
      <div class="form-group row">
        <label class="col-sm-4 col-form-label">Comment</label>
        <div class="col-sm-8">
          <textarea class="form-control" name="comment" id="comment" rows="4"></textarea>
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