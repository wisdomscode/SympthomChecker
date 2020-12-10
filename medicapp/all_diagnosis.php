
<?php include('process.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

   <title>Symptom Checker</title>
</head>

<body>
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <div class="container">
      <a class="navbar-brand" href="index.php">e86 Medicsys</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
         aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
         <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <a class="nav-link" href="index.php">Patients <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="add_patients.php">Add Patient</a>
            </li>
            <li class="nav-item active">
               <a class="nav-link" href="all_diagnosis.php">View Diagnosis</a>
            </li>

         </ul>
      </div>
      </div>
   </nav>

   <div class="container">

        <nav class="navbar navbar-light bg-light">
            <h3>Diagnosis Result</h3>
        
            <form class="form-inline">
            <label for="#seachInput"><strong>Search</strong>  </label> &nbsp;&nbsp;
            <input class="form-control" type="text" id="searchInput" onkeyup="searchDiagnosis()" placeholder="Type Patient's names..." size="30">
            </form>

        </nav>
               <table class="table table-striped" id="myTable">
                  <thead class="thead-dark">
                     <tr>
                        <th scope="col">Patient No</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Diagnosis Result</th>
                        <th scope="col">Date Conducted</th>
                     </tr>
                  </thead>
                  <tbody>

                  <?php

                     // to fetch the whole diagnosis from the database
                     $query = "SELECT patients.id, patients.patient_no, patients.first_name, patients.last_name, diagnosis.validity, diagnosis.date
                      FROM patients INNER JOIN diagnosis
                      ON patients.id = diagnosis.patient_id Order By diagnosis.date";

                     $result = mysqli_query($db_connect, $query);
                  ?>


                  <?php
                     while ($row = mysqli_fetch_array($result)) {
                  ?>
                     <tr>
                     <th scope="row"><a href="patient_detail.php?patient=<?php echo $row['id']; ?>"><?php echo $row['patient_no']; ?></a></th>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                        <td><strong> <?php echo $row['validity']; ?></strong></td>
                        <td><?php echo $row['date']; ?></td>
                     </tr>
                     <?php } ?>

                  </tbody>
               </table>

   </div>

        <script>
            function searchDiagnosis() {
            // Declare variables
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
                }
            }
            }
        </script>

   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
      </script>
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
      integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
      </script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
      integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
      </script>
</body>
</html>