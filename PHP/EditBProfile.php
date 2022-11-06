<?php
session_start();
Define("host","localhost");
Define("Username", "root");
Define("Password", "");
Define("db", "Jalees");
$connection = mysqli_connect(host,Username,Password,db);
if(!$connection)
    die("could not coonect to database");
$babysitter = $_SESSION['babysitterID']; 
if(isset($_POST['save'])){
    
    $Fname = test_input($_POST['firstName']);
    $Lname = test_input($_POST['lastName']);
    $Email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $userID = $_POST['userID'];
    $age = $_POST['age'];
    $PhoneNo = $_POST['phone'];
    $gender = $_POST['Gender'];
    $city = $_POST['city'];
    $bio = test_input($_POST['bio']);
    $profilePhoto = $_POST['profile-img']; 

}
    $firstNameError = $lastNameError = $emailError = $emailTaken = $phoneError = $passwordError = $idError = $ageError = $bioError = $allErrors = "";

    if (!preg_match("/^[a-zA-Z]{1,30}$/",$Fname)){ 
        $firstNameError = "\u{25CF} First name should be between 1-30 letters, and should not contain special characters or digits.<br>";
        $allErrors = $allErrors . $firstNameError;
    }

    if (!preg_match("/^[a-zA-Z]{1,30}$/",$Lname)){ 
        $lastNameError = "\u{25CF} Last name should be between 1-30 letters, and should not contain special characters or digits.<br>";
        $allErrors = $allErrors . $lastNameError;
    }

    $emailExists1 = "SELECT * FROM Babysitters WHERE ID != '$babysitter' AND email='$Email'  ";
    $emailQuery1 = mysqli_query($connection, $emailExists1);

    $emailExists2 = "SELECT * FROM parents WHERE email='$Email' ";
    $emailQuery2 = mysqli_query($connection, $emailExists2);

    if(mysqli_num_rows($emailQuery1) > 0 || mysqli_num_rows($emailQuery2) > 0)
    {
        $emailTaken = "\u{25CF} Email already exists! <br>";
        $allErrors = $allErrors . $emailTaken;
    }


    if (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,5}$/ix" , $Email)) {
        $emailError = "\u{25CF} Invalid Email Address!<br>";
        $allErrors = $allErrors . $emailError;
    }


    if ((strlen($password)<8) || !preg_match("/[!”#\$\%\&\'\(\)\*\+,-\.\/:;<=>\?@\[\]\^_\{\|\}~`]{1,}/", $password) ){ 
        $passwordError = "\u{25CF} Password should be at least 8 characters and should contain at least one special character.<br>";
        $allErrors = $allErrors . $passwordError;
    }

    
    if (!preg_match("/^[0-9]{10}$/",$userID) ){
        $idError = "\u{25CF} ID should consist of 10 digits only.<br>";
        $allErrors = $allErrors . $idError;
    }
    

    if ($age < 18){ 
        $ageError = "\u{25CF} Age should be greater than or equal to 18.<br>";
        $allErrors = $allErrors . $ageError;
    }

    if ($age > 100){ 
        $ageError = "\u{25CF} Age should be less than or equal to 100.<br>";
        $allErrors = $allErrors . $ageError;
    }

    if (!preg_match("/^05+[0-9]{8}$/",$PhoneNo)){ 
        $phoneError = "\u{25CF} Invalid Phone! Phone number must be in the format 05XXXXXXXX.<br>";
        $allErrors = $allErrors . $phoneError;
    }

    if (!preg_match("/^[0-9a-zA-Z!”#\$\%\&\'\(\)\*\+,-\.\/:;<=>\?@\[\]\^_\{\|\}~`\n\r ]{25,}$/",$bio)){ 
        $bioError = "\u{25CF} Bio should contain at least 25 characters.<br>";
        $allErrors = $allErrors . $bioError;
    }



    if (strlen($allErrors) > 0 || !empty($allErrors)){
        mysqli_close($connection);
        header("Location: ../EditBabysitterProfile.php?error=$allErrors");  
    }



    else {

        if ($profilePhoto  == null){
            $query = "UPDATE Babysitters SET firstName = '$Fname', lastName = '$Lname', userID = '$userID', gender = '$gender' , email = '$Email',pass = '$password', phone = '$PhoneNo', city = '$city', bio = '$bio' , age ='$age' WHERE ID = '$babysitter' ";   
            $result = mysqli_query($connection, $query);
            mysqli_close($connection);
            header("Location: ../viewProfileBabysitter.php?success=1");
        }

        else{
            $query = "UPDATE Babysitters SET firstName = '$Fname', lastName = '$Lname', userID = '$userID', gender = '$gender' , email = '$Email', photo ='$profilePhoto',pass = '$password', phone = '$PhoneNo', city = '$city', bio = '$bio' , age ='$age' WHERE ID = '$babysitter' ";       
            $result = mysqli_query($connection, $query);

            mysqli_close($connection);
            header("Location: ../viewProfileBabysitter.php?success=1");
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }   
?>
