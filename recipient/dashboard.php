<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:Rlogin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Recipient Site</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/R_header.php' ?>



   <section class="dashboard">

<h1 class="heading">RECIPIENT SITE</h1>

<div class="box-container">

<div class="box">
   <h3>welcome!</h3>
   <p><?= $fetch_profile['name']; ?></p>
   <a href="update_profile.php" class="btn">update profile</a>
</div>

<div class="box">
   <?php
      $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE R_id = ?");
      $select_posts->execute([$admin_id]);
      $numbers_of_posts = $select_posts->rowCount();
   ?>
   <h3><?= $numbers_of_posts; ?></h3>
   <p>posts added</p>
   <a href="add_posts.php" class="btn">add new post</a>
</div>

<div class="box">
   <?php
      $select_active_posts = $conn->prepare("SELECT * FROM `posts` WHERE R_id = ? AND status = ?");
      $select_active_posts->execute([$admin_id, 'active']);
      $numbers_of_active_posts = $select_active_posts->rowCount();
   ?>
   <h3><?= $numbers_of_active_posts; ?></h3>
   <p>active posts</p>
   <a href="view_posts.php" class="btn">see posts</a>
</div>

<div class="box">
   <?php
      $select_deactive_posts = $conn->prepare("SELECT * FROM `posts` WHERE R_id = ? AND status = ?");
      $select_deactive_posts->execute([$admin_id, 'deactive']);
      $numbers_of_deactive_posts = $select_deactive_posts->rowCount();
   ?>
   <h3><?= $numbers_of_deactive_posts; ?></h3>
   <p>deactive posts</p>
   <a href="view_posts.php" class="btn">see posts</a>
</div>



<div class="box">
   <?php
      $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE R_id = ?");
      $select_comments->execute([$admin_id]);
      $select_comments->execute();
      $numbers_of_comments = $select_comments->rowCount();
   ?>
   <h3><?= $numbers_of_comments; ?></h3>
   <p>comments added</p>
   <a href="comments.php" class="btn">see comments</a>
</div>

<div class="box">
   <?php
      $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE R_id = ?");
      $select_likes->execute([$admin_id]);
      $select_likes->execute();
      $numbers_of_likes = $select_likes->rowCount();
   ?>
   <h3><?= $numbers_of_likes; ?></h3>
   <p>total likes</p>
   <a href="view_posts.php" class="btn">see posts</a>
</div>


<div class="box">
   <h3> Messages!</h3>
   <p><?= $fetch_profile['email']; ?></p>
   <a href="../chat2/php-chat-app-main/chat.php" class="btn">See</a>
</div>


</section>




<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>

</body>
</html>