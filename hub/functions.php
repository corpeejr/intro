<?php include "hub/db.php"; ?>
<?php 
session_start();
ob_start();
function login(){
    global $con;

    if(isset($_POST['loginBtn'])){

        $email =$_POST['email'];
        //$pass =md5($_POST['password']);
        $pass =$_POST['password'];

        //$echo = $email . " " . $pass;

        $sql = "SELECT * FROM users WHERE email = '{$email}' ";

        $user = mysqli_query($con, $sql);

        while($row = mysqli_fetch_assoc($user)){
            $dbEmail = $row['email'];
            $dbPass = $row['password'];
            $dbFullName = $row['fullname'];
            $dbImage = $row['image'];
            $dbRole = $row['role'];
            $dbStatus = $row['status'];


        }

        if(isset($dbEmail)){
            if($dbPass === $pass){
                $_SESSION['fullName'] = $dbFullName;
                $_SESSION['email'] = $dbEmail;
                $_SESSION['image'] = $dbImage;
                $_SESSION['role'] = $dbRole;
                $_SESSION['status'] = $dbStatus;


                echo "<script> window.location = '/practice/admin'</script>";
            }else {

                echo "Password Incorrect";
            }
        }else{
            echo "User Not found";
        }
    }
}



function register(){
    global $con;

    if(isset($_POST['registerBtn'])){

        $fullName =$_POST['fullname'];
        $email =$_POST['email'];
        $image =$_POST['image'];
        $pass =$_POST['password'];
  

        $sql = "SELECT * FROM users WHERE password = '{$pass}' ";

        $user = mysqli_query($con, $sql);

        while($row = mysqli_fetch_assoc($user)){
           
            
            $dbFullName =$row['fullname'];
            $dbEmail =$row['email'];
            $dbImage =$row['image'];
            $dbPass =$row['password'];
         
            
        }

        if(isset($dbEmail)){
            if($dbPass === $pass){
                $_SESSION['fullname'] = $dbFullName;

                $_SESSION['email'] = $dbEmail;
                $_SESSION['image'] = $dbImage;
                $_SESSION['passaword'] = $dbPass;
        


                echo "<script> window.location = '/practice/admin'</script>";
            }else {

                echo "Password Incorrect";
            }
        }else{
            echo "User Not found";
        }
    }
}

?>





