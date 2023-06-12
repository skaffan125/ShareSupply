




<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['use_id'])){
   $user_id = $_SESSION['use_id'];
}else{
   $user_id = '';
};

include 'components/like_post.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.5.0/css/bootstrap.min.css">
   <link rel="stylesheet" href="1.css/style.css">

   <!-- Bootstrap JS (Optional, if needed) -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.5.0/js/bootstrap.min.js"></script>



</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="home-grid">

   <div class="box-container">
  
      <div class="box">
      <div class="background-image"></div>
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
               $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
               $count_user_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
               $count_user_comments->execute([$user_id]);
               $total_user_comments = $count_user_comments->rowCount();
               $count_user_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
               $count_user_likes->execute([$user_id]);
               $total_user_likes = $count_user_likes->rowCount();

         ?>
         <p> welcome <span><?= $fetch_profile['name']; ?></span></p>
         <p>total comments : <span><?= $total_user_comments; ?></span></p>
         <p>posts liked : <span><?= $total_user_likes; ?></span></p>
         <a href="update.php" class="btn">update profile</a>
         <a href="components/user_logout.php" class="btn">Logout</a>
         <div class="flex-btn"><a href="user_likes.php" class="option-btn">likes</a>
     
<form id="myForm" action="../chat2/php-chat-app-main/index.php" method="POST" style="" class="btn">Messages
  <input type="hidden" name="username" value="<?php echo $email; ?>">
  <input type="submit" value="See">
</form>
<script>
  document.getElementById("previousLink").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default link behavior

    var form = document.getElementById("myForm");
    form.submit(); // Submit the form
  });
</script>
            <a href="user_comments.php" class="option-btn">comments</a>
            </br>
            
            
         </div>
         <?php
            }else{
         ?>
            <p class="name">login or register!</p>
            <div class="flex-btn">
               <a href="login.php" class="option-btn">login</a>
               <a href="register.php" class="option-btn">register</a>
            </div> 
         <?php
          }
         ?>
      </div>

      <div class="box">
         <p>Donation Criteria</p>
         <div class="flex-box">
            <a href="category.php?category=Insividual" class="links">Individual</a>
            <a href="category.php?category=Education" class="links">Education</a>
            <a href="category.php?category=Orphanage" class="links">Orphanage</a>
            <a href="category.php?category=Old Home" class="links">Old Home</a>

            <a href="all_category.php" class="btn">view all</a>
         </div>
      </div>

      <div class="box">
         <p>Requests</p>
         <div class="flex-box">
         <?php
            $select_authors = $conn->prepare("SELECT DISTINCT name FROM `rec` LIMIT 10");
            $select_authors->execute();
            if($select_authors->rowCount() > 0){
               while($fetch_authors = $select_authors->fetch(PDO::FETCH_ASSOC)){ 
         ?>
            <a href="author_posts.php?author=<?= $fetch_authors['name']; ?>" class="links"><?= $fetch_authors['name']; ?></a>
            <?php
            }
         }else{
            echo '<p class="empty">no posts added yet!</p>';
         }
         ?>  
         <a href="authors.php" class="btn">view all</a>
         </div>
      </div>

   </div>
   <section class="posts-container">
   <h1 class="heading">Latest Posts</h1>

   <div class="container">
      <div class="row">
         <?php
            $select_posts = $conn->prepare("SELECT * FROM `posts` WHERE status = ? LIMIT 10");
            $select_posts->execute(['active']);
            if($select_posts->rowCount() > 0){
               while($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)){
                  $post_id = $fetch_posts['id'];
                  $count_post_comments = $conn->prepare("SELECT * FROM `comments` WHERE post_id = ?");
                  $count_post_comments->execute([$post_id]);
                  $total_post_comments = $count_post_comments->rowCount(); 
                  $count_post_likes = $conn->prepare("SELECT * FROM `likes` WHERE post_id = ?");
                  $count_post_likes->execute([$post_id]);
                  $total_post_likes = $count_post_likes->rowCount();
                  $confirm_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ? AND post_id = ?");
                  $confirm_likes->execute([$user_id, $post_id]);
         ?>
         <div class="col-lg-6">
            <div class="post-card">
               <div class="post-header">
                  <img src="User.png" alt="User" class="profile-img">
                  <div>
                     <h5><a href="author_posts.php?author=<?= $fetch_posts['name']; ?>"><?= $fetch_posts['name']; ?></a></h5>
                     <span class="hour"><?= $fetch_posts['date']; ?></span>
                  </div>
               </div>
               <div class="post-content">
                  <h2 class="message"><?= $fetch_posts['title']; ?></h2>
                  <div class="message"><?= $fetch_posts['content']; ?></div>
                  <a href="view_post.php?post_id=<?= $post_id; ?>" class="inline-btn">Read More</a>
                  <a href="view_pdf.php?pdf_id=<?= $fetch_posts['pdf'];?>" class="inline-btn">View PDF</a>
               </div>
               <div class="imgBg">
                  <img src="../uploaded_img/<?= $fetch_posts['image']; ?>" alt="Post Image" class="coverFull">
               </div>
               <div class="post-actions">
                  <button type="submit" name="like_post">
                     <i class="fas fa-heart" style="<?php if($confirm_likes->rowCount() > 0){ echo 'color:var(--red);'; } ?>;"></i>
                     <span>(<?= $total_post_likes; ?>)</span>
                  </button>
                  <div class="like">
                     <a href="view_post.php?post_id=<?= $post_id; ?>">
                        <i class="fas fa-comment"></i>
                        <span>(<?= $total_post_comments; ?>)</span>
                     </a>
                  </div>
               </div>
               <div class="addComments">
                 
                  <input type="text" class="text" placeholder="Write a comment...">
               </div>
            </div>
         </div>
         <?php
               }
            } else {
               echo '<p class="empty">No posts added yet!</p>';
            }
         ?>
      </div>
   </div>

   <div class="more-btn" style="text-align: center; margin-top: 1rem;">
      <a href="posts.php" class="inline-btn">View All Posts</a>
   </div>
</section>


      
<style>
   .posts-container {
      padding: 20px;
   }
 
   .posts-container .heading {
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
   }

   .post-card {
      border: 1px solid #ddd;
      background-color: #fff;
      padding: 20px;
      width: 50%;
      margin-bottom: 20px;
      position:center;
      box-shadow: 0 0 20px 10px rgba(9, 2, 2, 0.5);
   }

   .post-card .post-header {
      display: flex;
      align-items: center;
   }

   .post-card .post-header .profile-img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-right: 10px;
   }

   .post-card .post-header h5 {
      font-size: 16px;
      margin-bottom: 5px;
   }

   .post-card .post-header .hour {
      color: #888;
   }

   .post-card .post-content {
      margin-top: 10px;
   }

   .post-card .post-content .message {
      margin-bottom: 15px;
   }

   .post-card .post-content .inline-btn {
      margin-right: 10px;
   }

   .post-card .imgBg .coverFull {
      width: 100%;
   }

   .post-card .post-actions {
      display: flex;
      align-items: center;
      margin-top: 10px;
   }

   .post-card .post-actions button {
      margin-right: 10px;
   }

   .post-card .post-actions .like a {
      color: #888;
   }

   .post-card .post-actions .like i {
      margin-right: 5px;
   }

   .post-card .addComments {
      display: flex;
      align-items: center;
      margin-top: 10px;
   }

   .post-card .addComments .userimg {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      margin-right: 10px;
   }

   .post-card .addComments .text {
      width: 100%;
      border: 1px solid #ddd;
      padding: 10px;
   }

   .more-btn {
      margin-top: 1rem;
      text-align: center;
   }

   .more-btn .inline-btn {
      padding: 10px 20px;
      background-color: #007bff;
      color: #fff;
      border-radius: 5px;
      text-decoration: none;
   }
</style>














<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>