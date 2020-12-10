<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<!--
/**
 * ApiMedic.com Sample Avatar, a demo implementation of the ApiMedic.com Symptom Checker by priaid Inc, Switzerland
 * 
 * Copyright (C) 2012 priaid inc, Switzerland
 * 
 * This file is part of The Sample Avatar.
 * 
 * This is free implementation: you can redistribute it and/or modify it under the terms of the
 * GNU General Public License Version 3 as published by the Free Software Foundation.
 * 
 * The ApiMedic.com Sample Avatar is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * 
 * See the GNU General Public License for more details. You should have received a copy of the GNU
 * General Public License along with ApiMedic.com. If not, see <http://www.gnu.org/licenses/>.
 * 
 * Authors: priaid inc, Switzerland
 */
 -->
<head>
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
      integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="symptom_selector/selector.css?v=1">
    <link rel="stylesheet" type="text/css" href="symptom_selector/fontawesome/assets/css/font-awesome.min.css" />
    <script src="libs/jquery-1.12.2.min.js"></script>
    <script src="libs/json2.js"></script><!-- json for ie7 -->
    <script src="libs/jquery.imagemapster.min.js?v=1.1"></script>
    <script src="libs/typeahead.bundle.js"></script>
    
    <script src="symptom_selector/selector.js?v=3.3"></script>

	<?php 

	// session_start(); // this causes some issues with certain servers, try this if it's working with this line or not.
		
	/**
	* For Live API service use the Live API endpoints:
	* Instead of the Sandbox Authservice endpoint "https://sandbox-authservice.priaid.ch/login" you should use the Live Authservice endpoint "https://authservice.priaid.ch/login" 
	* Instead of the Sandbox Healthservice endpoint "https://sandbox-healthservice.priaid.ch" you should use the Live Authservice endpoint "https://healthservice.priaid.ch" 
    */
	
	if ( !isset( $_SESSION['userToken']) || !isset( $_SESSION['tokenExpireTime']) || time() >= $_SESSION['tokenExpireTime'] )
	{
		require 'token_generator.php';
		$tokenGenerator = new TokenGenerator("b4G2Z_GMAIL_COM_AUT","q3WDb8i9JLn4z7BNs","https://authservice.priaid.ch/login");
		$token = $tokenGenerator->loadToken();
		$_SESSION['userToken'] = $token->{'Token'};
		$_SESSION['tokenExpireTime'] = time() + $token->{'ValidThrough'};
	}

	$token = $_SESSION['userToken'];
	?>

	<script type="text/javascript">

		var userToken = <?php echo "'".$token."'" ?>;
		
        $(document).ready(function () {
            $("#symptomSelector").symptomSelector(
            {
                mode: "diagnosis",
                webservice: "https://healthservice.priaid.ch",
                language: "en-gb",
                specUrl: "sample_specialisation_page",
                accessToken: userToken
            });
        });
    </script>

	
</head>
<body>
    <?php include('../process.php'); ?>

    <?php
      // to fetch a particular patient
         if (isset($_GET['patient'])) {
            $id = $_GET['patient'];
            $query = "SELECT * FROM patients WHERE id=$id";
            $result = mysqli_query($db_connect, $query);
            if (count($result)==1) {
               $row = $result->fetch_array();
            }
         };
      ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">   
      <div class="container">
        <a class="navbar-brand" href="../index.php">e86 Medicsys</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item active">
                    <h5 class="nav-link">    Welcome! <?php echo $row['first_name']; ?></h5>
                </li>
            </ul>

        </div>
      </div>
   </nav>
   <br>
            <div class="container">
                <form action="" method="POST">
                    <input type="text" name="patient_id" value="<?php echo $row['id']; ?>" hidden>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-2">
                        <span class="form-check">
                            <input class="form-check-input" type="radio" name="validity" id="exampleRadios1" value="Invalid" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                <h6>Result is Invalid</h6> 
                            </label>
                        </span>
                        </div>
                        <div class="col-md-2">
                        <span class="form-check">
                            <input class="form-check-input" type="radio" name="validity" id="exampleRadios2" value="Valid">
                            <label class="form-check-label" for="exampleRadios2">
                            <h6>Result is Valid</h6> 
                            </label>
                        </span> 
                        </div>
                        <div class="col-md-2">                 
                            <button type="submit" name="save" class="btn btn-info">Save Result</button>
                        </div>
                    </div>  
                </form>
            </div><br>

 <?php
    $db_connect = mysqli_connect('localhost', 'root', '', 'symptomchecker');

    if(isset($_POST['save'])){
        $patientId = $_POST['patient_id'];
        $diagnosis = $_POST['validity'];
        $date = date("Y-m-d H:i:s");

        $query = "INSERT INTO diagnosis(patient_id, validity, date) VALUES ('$patientId', '$diagnosis', '$date')";

        $result = mysqli_query($db_connect, $query);

        if ($result) {

            // to redirect the user back to index page
            echo "<script>window.open('../index.php', '_self')</script>";
         }
     }
  ?>


    <table class="container-table">
        <tr>
            <td valign="middle" colspan="2" class="td-header box-white bordered-box width50"><h4 class="header" id="selectSymptomsTitle"><span class="badge pull-left badge-primary visible-lg margin5R">1</span></h4></td>
            <td valign="middle" class="td-header bordered-box box-white width25"><h4 class="header" id="selectedSymptomsTitle"><span class="badge pull-left badge-primary visible-lg margin5R">2</span></h4></td>
            <td valign="middle" class="td-header bordered-box box-white width25"><h4 class="header" id="possibleDiseasesTitle"><span class="badge pull-left badge-primary visible-lg margin5R">3</span></h4></td>
        </tr>
        <tr>
            <td valign="top" class="selector_container bordered-box box-white width25"><div id="symptomSelector"></div></td>
            <td valign="top" class="selector_container bordered-box box-white width25"><div id="symptomList"></div></td>
            <td valign="top" class="selector_container bordered-box box-white width25"><div id="selectedSymptomList"></div></td>
            <td valign="top" class="selector_container bordered-box box-white width25"><div id="diagnosisList"></div></td>
        </tr>
    </table>
    <div>
        <a target="_blank" href="http://apimedic.com"><img class="logo" alt="ApiMedic by priaid" src="symptom_selector/images/logo.jpg" /></a>
        <span ><a class="priaid-powered" target="_blank" href="http://apimedic.com"> powered by  </a> </span>
    </div>

    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
      integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
      </script> -->
   <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
      integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
      </script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
      integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
      </script>
</body>
</html>
