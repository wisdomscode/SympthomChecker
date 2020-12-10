 <?php
   session_start();
   $db_connect = mysqli_connect('localhost', 'root', '', 'symptomchecker');
   //insert patient
   if (isset($_POST['save'])) {

      $patient_no = $_POST['patient_no'];
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $age = $_POST['age'];
      $gender = $_POST['gender'];
      $address = $_POST['address'];
      $phone = $_POST['phone'];
      $next_of_kin = $_POST['next_of_kin'];
      $nok_phone = $_POST['nok_phone'];

      $query = "INSERT INTO patients(patient_no, first_name, last_name, age, gender, address, phone, next_of_kin, nok_phone) 
      VALUES ('$patient_no', '$first_name','$last_name', '$age','$gender','$address','$phone','$next_of_kin','$nok_phone');";
      
      $result = mysqli_query($db_connect, $query);
      if ($result) {

         // to redirect the user back to index page
         echo "<script>window.open('index.php', '_self')</script>";
      }
      else {
         echo "There was a problem!";
      }

   }
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

   <title>Symptom Checker</title>
</head>
<body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
            <a class="navbar-brand" href="index.php">e86 Medicsys</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                  <a class="nav-link" href="index.php">Patients <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link" href="add_patients.php">Add Patient</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="all_diagnosis.php">View Diagnosis</a>
               </li>

              </ul>
            </div>
         </div>
          </nav>
   
   <div class="container">

         <nav class="navbar navbar-light bg-light">
            <h3>Add Patient </h3>
        </nav><br>
      <form action="" method="post">
            <div class="form-group">
               <label for="pat_num">Patient File Number</label>
               <input type="text" name="patient_no" class="form-control" id="pat_num" >
            </div>
            <div class="form-group">
            <label for="firstName">First Name</label>
            <input type="text" name="first_name" class="form-control" id="firstName" >
            </div>
            <div class="form-group">
               <label for="lastname">Last Name</label>
               <input type="text" name="last_name" class="form-control" id="lastname" >
            </div>
            <div class="form-group">
               <label for="address">Address</label>
               <input type="text" name="address" class="form-control" id="address">
            </div>
            <div class="form-group">
               <label for="phoneNumber">Phone Number</label>
               <input type="number" name="phone" class="form-control" id="phoneNumber" >
            </div>
            <div class=" form-group form-row">
               <div class="col">
                  <label >Age</label>
                  <input type="number" name="age" class="form-control">
               </div>
               <div class="col">
                  <label >Gender</label>
                  <select name="gender" id="" class="form-control">
                     <option value="Male">Male</option>
                     <option value="Female">Female</option>
                  </select>
               </div>
            </div>
            <div class=" form-group form-row">
               <div class="col">
                  <label >Next of Kin Name</label>
                  <input type="text" name="next_of_kin" class="form-control" >
               </div>
               <div class="col">
                  <label >Next of Kin Phone Number</label>
                  <input type="text" name="nok_phone" class="form-control" >
               </div>
            </div>
            <button type="submit" name="save" class="btn btn-primary">Submit</button>
         </form>
         <br><br>


</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>