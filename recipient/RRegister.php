<?php

include '../components/connect.php';

session_start();





if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);
   $password= $_POST['pass'];
   $password = password_hash($password, PASSWORD_DEFAULT);
   $select_admin = $conn->prepare("SELECT * FROM `rec` WHERE email = ?");
   $select_admin->execute([$name]);
   
   if($select_admin->rowCount() > 0){
      $message[] = 'username already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm passowrd not matched!';
      }else{
         $insert_admin = $conn->prepare("INSERT INTO `rec`(name,email, password) VALUES(?,?,?)");
         $insert_admin->execute([$name,$email,$pass]);
         $insert_chat = $conn->prepare("INSERT INTO `c_users`(name,username, password) VALUES(?,?,?)");
         $insert_chat->execute([$name,$email,$password]);
         $message[] = 'new rec registered!';
          header('location:Rlogin.php');
      }
   }

}

?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Registration Form-ShareSupply</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Login Form" />
    <!-- //Meta tag Keywords -->

    <link href="//fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
s
    <!--/Style-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!--//Style-CSS -->

    <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>

</head>

<body>

    <!-- form section start -->
    <section class="w3l-mockup-form">
        <div class="container">
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="main-mockup">
                    <div class="alert-close">
                        <span class="fa fa-close"></span>
                    </div>
                    <div class="w3l_form align-self">
                        <div class="left_grid_info">
                            <img src="images/image2.jpg" alt="">
                        </div>
                    </div>
                    <div class="content-wthree">
                        <h2>Register Now</h2>
                        <p> </p>
                       
                        <form action="" method="post">
                            <input type="text" class="name" name="name" placeholder="Enter Your Name"
                                value="<?php if (isset($_POST['submit'])) {
                                    echo $name;
                                } ?>" required>
                            <input type="email" class="email" name="email" placeholder="Enter Your Email"
                                value="<?php if (isset($_POST['submit'])) {
                                    echo $email;
                                } ?>" required>
                            <input type="pass" class="pass" name="pass" placeholder="Enter Your Password"
                                required>

            
                            <input type="cpass" class="cpass" name="cpass"
                                placeholder="Enter Your Confirm Password" required>
                                
                         

  
  
                            <button name="submit" class="btn" type="submit">Register</button>
     
                        </form>
                        <div class="social-icons">
                            <p>Have an account! <a href="Rlogin.php">Login</a>.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- //form -->
        </div>
    </section>
    <!-- //form section start -->

    <script src="js/jquery.min.js"></script>
    <script>
        $(document).ready(function (c) {
            $('.alert-close').on('click', function (c) {
                $('.main-mockup').fadeOut('slow', function (c) {
                    $('.main-mockup').remove();
                });
            });
        });
    </script>

</body>

</html>