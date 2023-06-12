<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}



?>

<header class="header">
<a href="../homepage/index.php" class="logo">ShareSupply</a></br>


   <div class="profile">
      <?php
         $select_profile = $conn->prepare("SELECT * FROM `rec` WHERE id = ?");
         $select_profile->execute([$admin_id]);
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
      <p><?= $fetch_profile['name']; ?></p>
      <p><?= $fetch_profile['email']; ?></p>
      <a href="update_profile.php" class="btn">update profile</a>
   <?php $email= $fetch_profile['email'];
   
   ?>
   </div>

   <nav class="navbar">
      <a href="dashboard.php"><i class="fas fa-home"></i> <span>home</span></a>
      <a href="add_posts.php"><i class="fas fa-pen"></i> <span>add posts</span></a>
      <a href="view_posts.php"><i class="fas fa-eye"></i> <span>view posts</span></a>
      <a href="../components/R_logout.php" style="color:var(--red);" onclick="return confirm('logout from the website?');"><i class="fas fa-right-from-bracket"></i><span>logout</span></a>
      <a href="view_posts.php"><i class="fas fa-eye"></i> <span>Payments</span></a>
      <a href="../chat2/php-chat-app-main/chat.php" id="previousLink"><i class="fas fa-eye"></i> <span>Messages</span></a>

<form id="myForm" action="../chat2/php-chat-app-main/index.php" method="POST" style="">
  <input type="hidden" name="username" value="<?php echo $email; ?>">
  <input type="submit" value="Submit">
</form>
<script>
  document.getElementById("previousLink").addEventListener("click", function(event) {
    event.preventDefault(); // Prevent the default link behavior

    var form = document.getElementById("myForm");
    form.submit(); // Submit the form
  });
</script>
   </nav>

   <div class="flex-btn">
      <a href="Rlogin.php" class="option-btn">login</a>
      <a href="register_admin.php" class="option-btn">register</a>
   </div>

</header>

<div id="menu-btn" class="fas fa-bars"></div>