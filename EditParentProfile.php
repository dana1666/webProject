<!DOCTYPE html> <!--no errors, navbar done-->
<?php
session_start();
Define("host","localhost");
Define("Username", "root");
Define("Password", "");
Define("db", "Jalees");
$connection = mysqli_connect(host, Username, Password, db);
if(!$connection)
die("could not coonect to database");

else{

$parent = $_SESSION['parentID']; 
$query = "SELECT * FROM parents WHERE parentID= '$parent'";
$result = mysqli_query($connection,$query);

if (!empty($result -> num_rows) && ($result ->num_rows > 0)) {
  while ($row = $result -> fetch_assoc()){
    $Fname = $row['firstName'];
    $Lname = $row['lastName'];
    $email = $row['email'];
    $password = $row['pass'];
    $city = $row['city'];
    $district = $row['district'];
    $street = $row['street'];
    $ProfilePhoto = $row['photo'];
  }//close while 
}
}
$connection -> close();
?> 

<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="css/EditProfile.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>  
    <script src="bootstrap/js/ie-emulation-modes-warning.js"></script>
    <title>Jalees</title>
</head>

<body style=" background-color: #eee">
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
              <li class="nav-item"><a href="parentHome.php" class="nav-link">Home</a></li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">My Bookings</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="currentBookings.php">Current Bookings</a></li>
                    <li><a class="dropdown-item" href="previousBookings.php">Previous Bookings</a></li>
                  </ul>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle active" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">My Profile</a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="viewProfileParent.php">View Profile</a></li>
                    <li><a class="dropdown-item active" href="EditParentProfile.php">Manage Profile</a></li>
                    <li><a class="dropdown-item" href="php/signout.php">Log Out</a></li>
                  </ul>
                </li>
              <li class="nav-item " ><a href="mailto:Jalees:gmail.com" class="nav-link ">Ask Us</a></li>
          </ul>
        </div>
      </div>
      </div>


  <div class="vh-100">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-12 col-xl-11">
          <div class="card text-black" style="border-radius: 25px;">
            <div class="card-body p-md-5">
              <div class="row justify-content-center">
                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
  
                  <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Edit Profile</p>
            
          
                  

                  <form action="PHP/EditParProfile.php" method="post" >

                    <!-- Profile Picture -->
                    <div id="addinPic" class="d-flex flex-column align-self-center mt-4" class="profile">
                      <img  src="<?php echo $ProfilePhoto;?>"  alt="profile pic" name = "profilePhoto" class = profile_image >
                      <br>
                      <p style="font-size:10px; color:rgb(155, 155, 129); text-align: center;" >[Optional profile picture]</p>
                      <br>
                      <input type="file" id="uploadFile" name="profile-img" style="margin-left: 22% ">
                      <label class="align-self-end" for="uploadFile"><i class="bi bi-plus-circle-fill" id="plusS"></i></label>
                      <br>
                    </div>
                            
                    <br>
                    <div id="errorMessage"> 
                      <?php
                        if(isset($_GET['error']))
                          echo "<div class='alert alert-danger' role='alert'> <p>". $_GET['error']."</p></div>";
                      ?>
                    </div> 
                    <br>

                    <div class="form-outline">
                      <label class="form-label" for="First_Name"><strong>First Name</strong></label>
                      <input type="text" name ="firstName" id="First_Name" value="<?php echo $Fname;?>"class="form-control">
                    </div>

                    <div class="form-outline">
                      <label class="form-label" for="Last_Name"><strong>Last Name</strong></label>
                      <input type="text" name ="lastName" id="Last_Name" value="<?php echo $Lname;?>" class="form-control">
                      
                    </div>
                    
                  <div class="form-outline">
                    <label class="form-label" for="Email"><strong>Email</strong></label>
                    <input type="email" name = "email" id="Email" class="form-control" value="<?php echo $email;?>" required>
                    
                  </div>

                  <div class="form-outline">
                    <label class="form-label" for="Password"><strong>Password</strong></label>
                    <input type="password" name = "password" id="Password" class="form-control" value="<?php echo $password;?>" required>
                    <p style="font-size:10px; color:rgb(155, 155, 129);"> •Password should be at least 8 characters</p>
                  </div>


                  <div>

                    <label class="form-label" for="city" ><strong>Select City</strong></label>
                    
                    <select class="form-select" aria-label="Default select example" name ="city" id = "city">
                      <option value="Abha" <?php echo ($city == 'Abha')?"selected":"" ?>>Abha</option>
                      <option value="Abu Arish" <?php echo ($city == 'Abu Arish')?"selected":"" ?>>Abu Arish</option>
                      <option value="Al Baha" <?php echo ($city == 'Al Baha')?"selected":"" ?>>Al Baha</option>
                      <option value="Al Bukayriyah" <?php echo ($city == 'Al Bukayriyah')?"selected":"" ?>>Al Bukayriyah</option>
                      <option value="Al Duwadimi" <?php echo ($city == 'Al Duwadimi')?"selected":"" ?>>Al Duwadimi</option>
                      <option value="Al Kharj" <?php echo ($city == 'Al Kharj')?"selected":"" ?>>Al Kharj</option>
                      <option value="Al Rass" <?php echo ($city == 'Al Rass')?"selected":"" ?>>Al Rass</option>
                      <option value="Al Ula" <?php echo ($city == 'Al Ula')?"selected":"" ?>>Al Ula</option>
                      <option value="Al Khobar" <?php echo ($city == 'Al Khobar')?"selected":"" ?>>Al Khobar</option>
                      <option value="Arar" <?php echo ($city == 'Arar')?"selected":"" ?>>Arar</option>
                      <option value="Bisha" <?php echo ($city == 'Bisha')?"selected":"" ?>>Bisha</option>
                      <option value="Buridah" <?php echo ($city == 'Buridah')?"selected":"" ?>>Buraidah</option>
                      <option value="Dammam" <?php echo ($city == 'Dammam')?"selected":"" ?>>Dammam</option>
                      <option value="Dhahran" <?php echo ($city == 'Dhahran')?"selected":"" ?>>Dhahran</option>
                      <option value="Hafar Al Batin" <?php echo ($city == 'Hafar Al Batin')?"selected":"" ?>>Hafar Al Batin</option>
                      <option value="Hail" <?php echo ($city == 'Hail')?"selected":"" ?>>Hail</option>
                      <option value="Jazan" <?php echo ($city == 'Jazan')?"selected":"" ?>>Jazan</option>
                      <option value="Jeddah" <?php echo ($city == 'Jeddah')?"selected":"" ?>>Jeddah</option>
                      <option value="Jubail" <?php echo ($city == 'Jubail')?"selected":"" ?>>Jubail</option>
                      <option value="Khamis Mushait" <?php echo ($city == 'Khamis Mushait')?"selected":"" ?>>Khamis Mushait</option>
                      <option value="Mecca" <?php echo ($city == 'Mecca')?"selected":"" ?>>Mecca</option>
                      <option value="Medina" <?php echo ($city == 'Medina')?"selected":"" ?>>Medina</option>
                      <option value="Najran" <?php echo ($city == 'Najran')?"selected":"" ?>>Najran</option>
                      <option value="Riyadh" <?php echo ($city == 'Riyadh')?"selected":"" ?>>Riyadh</option>
                      <option value="Rabigh" <?php echo ($city == 'Rabigh')?"selected":"" ?>>Rabigh</option>
                      <option value="Riyadh AlKhabra" <?php echo ($city == 'Riyadh AlKhabra')?"selected":"" ?>>Riyadh AlKhabra</option>
                      <option value="Sakaka" <?php echo ($city == 'Sakaka')?"selected":"" ?>>Sakaka</option>
                      <option value="Shaqra" <?php echo ($city == 'Shaqra')?"selected":"" ?>>Shaqra</option>
                      <option value="Tabuk" <?php echo ($city == 'Tabuk')?"selected":"" ?>>Tabuk</option>
                      <option value="Taif" <?php echo ($city == 'Taif')?"selected":"" ?>>Taif</option>
                      <option value="Unayzah" <?php echo ($city == 'Unayzah')?"selected":"" ?>>Unayzah</option>
                      <option value="Yanbu" <?php echo ($city == 'Yanbu')?"selected":"" ?>>Yanbu</option>
                      <option value="Zulfi" <?php echo ($city == 'Zulfi')?"selected":"" ?>>Zulfi</option>
                    </select>
                    
                 
                </div>

                  

                <div class="form-outline">
                  <label class="form-label" for="district"><strong>District</strong></label>
                  <input type="text" id="district" class="form-control" name ="district" value="<?php echo $district;?>">
                </div>
                
                <div class="form-outline">
                  <label class="form-label" for="street"><strong>Street</strong></label>
                  <input type="text" id="street" class="form-control" name ="street" value="<?php echo $street;?>">
                </div>
                
                <br>

                <input type="submit" name = "save" class="btn btn-outline-secondary btn-lg" value="Save Changes">

                </form>

                <br>
             
  
                </div>
                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
  
                  <img src="css/images/picSign.png"
                    class="img-fluid" alt="Sample image"> <!--undraw.com-->
  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  
    
  </div>

  <p class="footer">Jalees &copy;
    <a href="mailto:Jalees@gmail.com">Contact Us</a>
  </p> 
        
</body>
</html>
