<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION['parentID'])){
  if(isset($_SESSION['babysitterID']))
  header("Location: babysitterHome.php?error=1");
  else
  header("Location: index.php?error=1");
}

error_reporting(E_ERROR | E_WARNING | E_PARSE);
Define("host","localhost");
Define("Username", "root");
Define("Password", "");
Define("db", "Jalees");
$connection = mysqli_connect(host, Username, Password, db);
if(!$connection)
die();

$id = $_GET['id'];
$query = "SELECT kidsNames,kidsAges,serviceType,startDate,endDate,startTime,endTime FROM jobRequests WHERE ID = ".$id.";"; 
$result = mysqli_query($connection, $query);
if(mysqli_num_rows($result)> 0){
while($row = mysqli_fetch_array($result)){
$kidsNames = $row['kidsNames'];
$kidsAges = $row['kidsAges'];
$type = $row['serviceType'];
$startDate = $row['startDate'];
$endDate = $row['endDate'];
$startTime = $row['startTime'];
$endTime = $row['endTime'];
}}

$connection -> close();

?>


<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel ="stylesheet" href="css/request.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  <!-- including time picker  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <link rel="stylesheet" href="dist/timepicker.min.css">
  <script src="jquery-3.6.1.min.js"></script>
   <script src="javaScript/Validations.js"></script> 
  <title>Jalees</title></head>

<body>
      <!-- expand يعني اختفاء البار متى ما صغرت الشاشه -->
      <div class="navbar navbar-expand-lg navbar-light text-light " style="background-color: rgb(227, 217, 175);">
        <div class="container-fluid">
          <!-- making the brand name as a heading -->
          <a class="navbar-brand mb-0 h1" href="parentHome.php"><img src="css/images/logo.png" style="width: 35%;" alt="Logo"></a>
              <!--عرض زر عند تصغير الشاشه ومنها يتم عرض عناصر البار -->
              <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#cNav" aria-controls="cNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>


            <!-- justify-content-end to make left allignment -->
          <div class="collapse navbar-collapse" id="cNav">
              <!-- list of itms in the navbar -->
              <ul class="navbar-nav" style="margin-left: -200px;">
                <li class="nav-item"><a href="parentHome.php" class="nav-link ">Home</a></li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">My Bookings</a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="currentBookings.php">Current Bookings</a></li>
                      <li><a class="dropdown-item" href="previousBookings.php">Previous Bookings</a></li>
                    </ul>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">My Profile</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="viewProfileParent.php">View Profile</a></li>
                      <li><a class="dropdown-item" href="EditParentProfile.php">Manage Profile</a></li>
                      <li><a class="dropdown-item" href="php/signout.php">Log Out</a></li>
                    </ul>
                  </li>
                <li class="nav-item " ><a href="mailto:Jalees@gmail.com" class="nav-link ">Ask Us</a></li>
            </ul>
          </div>
        </div>
        </div>

         <div class="vh-100" id="form" style="margin-top: 3%;"> > 
      <div class="container h-100">
            <div class="card text-black" style="border-radius: 25px;">
              <div class="card-body p-md-5">

                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Edit a Job Request</p>

                    <!-- the user wrong inputs -->
                    <p  role='alert' id="errorMessage" class ="alert alert-danger" style="display: none;  text-align: center;"></p>

                    <!-- the start of the form -->
                    <form class="mx-1 mx-md-4" action="PHP/updateRequest.php" method="post" id="editRequestForm">
                      <!-- the start of the 1st row -->
                      <div class="container text-center">
                      <div class="row align-items-start">

                          <div class="col">
                      <div class="d-flex align-items-center mb-4">
                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <input type="hidden" name ="id" value="<?php echo $id?>">
                          <label class="form-label"><strong>Kid/s names*</strong></label>
                          <input type="text" class="form-control" id ="names" name ="kidsNames"value="<?php echo $kidsNames?>" minlength="2" required>
                          <span style="text-align: left; color: orange ;">* please separate multiple names using a comma</span>
                        </div>
                      </div>
                    </div>

                    <div class="col">
                      <div class="d-flex align-items-center mb-4">
                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <label class="form-label"> <strong> Kid/s ages*</strong></label>
                          <input type="text" class="form-control" id="ages" name = "kidsAges" value="<?php echo $kidsAges?>" min="0" max="17" required>
                          <span style="text-align: left; color: orange ;">* please separate multiple ages respectively to the names using a comma </span>

                        </div>
                      </div>
                    </div>
                  <!-- the end of the 1st row -->
                  </div>

                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">

                        <label class="form-label" for = "service" ><strong>Type of service</strong></label>
                              <select class="form-select" id = "service" name="serviceType" value="<?php echo $type?>" required>
                              <option value="Infant Babysitting">Infant Babysitting</option>
                                <option value="In-room Babysitting">In-room Babysitting</option>
                                <option value="Night Babysitting">Night Babysitting</option>
                                <option value="After school Babysitting">After school Babysitting</option>
                                <option value="Help with homeworks">help with homeworks</option>
                                <option value="Tutoring">Tutoring</option>
                                <option value="Cooking meals">Cooking meals</option>
                                <option value="Others">Others</option>
                                </select>
                        </div>
                      </div>

                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                        <div class="form-outline flex-fill mb-0">
                          <!-- date picker -->
                          <script>
                          datepickr = new Date().toISOString().split("T")[0];
                          datepickr1 = new Date().toISOString().split("T")[0];
                          </script>

                    <div class="container text-center">
                      <div class="row align-items-start">
                        <div class="col">
                          <label class="form-label" for="flatpickr"> <strong>Start Day </strong></label><br>
                          <input id="datepickr" type="date"  class="form-control" name="startDay" value="<?php echo $startDate?>"
                           min="<?php echo date('Y-m-d', strtotime('+1 days')); ?>" required><br>
                        </div>
                        <div class="col">
                        <label class="form-label" for="flatpickr1"> <strong>End Day </strong></label><br>
                        <input id="datepickr1" type="date" class="form-control" name="endDay" value="<?php echo $endDate?>"
                         min="<?php echo date('Y-m-d', strtotime('+1 days')); ?>" required><br>

                      </div>
                      </div>

                      <div class="container text-center">
                      <div class="row align-items-start">
                        <div class="col">
                       <!-- time picker -->
                       <label for="appt"> <strong> start time:</strong></label><br>
                       <input type="text" id="appt" name="startTime" class="form-control" value="<?php echo $startTime?>"><br>
                      </div>
                      <div class="col">
                       <label for="appt1"> <strong> end time:</strong></label><br>
                       <input type="text" id="appt1" name="endTime" class="form-control" value="<?php echo $endTime?>">
                       </div>
                       </div>
                    
                     
                     
                      <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                        <button  name="confirmChanges" class="btn btn-outline-secondary btn-lg" type="submit" >Confirm Changes</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div> 

    <script>
    $('#editRequestForm').submit(function(e){
              $('#errorMessage').html("");
              $('#errorMessage').css('display', 'none');
              $('#success_alert').html("");
              $('#success_alert').css('display', 'none');
              $('#editRequestForm').removeAttr('target')
              
            
              var thereIsError = false;
              
              if(!commaSeparatedName($('#names').val())){
                document.getElementById('errorMessage').innerHTML += '&#9679; kid name should be at least 2 letters, and should not contain spaces, special characters or digits <br> except for a comma when you need to seperate multiple names.<br>'; 
                thereIsError = true;
              }

              if(!commaSeparatedAge($('#ages').val())){
                document.getElementById('errorMessage').innerHTML += '&#9679; kid age should be less than or equal to 17 and <br> please separate multiple ages respectively to the names using a comma.<br>'; 
                thereIsError = true;
              }
              
              if((thereIsError === true)){
                e.preventDefault();
                $('#editRequestForm').attr('target','my_iframe');
                $('#errorMessage').css('display', 'block');
              }
              else{
                    $('#success_alert').html('Service Added Successfully');
                    $('#success_alert').css('display', 'block');
                  }
            
            
            })

        </script>
       


    <p class="footer" style="margin-top: 30%;">Jalees &copy; <a href="mailto:Jalees@gmail.com">Contact Us</a></p>
    <script src="dist/timepicker.min.js"></script>


</body>





</html>