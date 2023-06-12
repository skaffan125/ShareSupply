<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('R_login.php');
}

if(isset($_POST['publish'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $content = $_POST['content'];
   $content = filter_var($content, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $category = $_POST['Area'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $status = 'deactive';
  

   
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_image = $conn->prepare("SELECT * FROM `posts` WHERE image = ? AND R_id = ?");
   $select_image->execute([$image, $admin_id]);



   $pdf=$_FILES['pdf']['name'];
   $pdf_type=$_FILES['pdf']['type'];
   $pdf_size=$_FILES['pdf']['size'];
   $pdf_tem_loc=$_FILES['pdf']['tmp_name'];
   $pdf_store="../uploaded_pdf/".$pdf;

   move_uploaded_file($pdf_tem_loc,$pdf_store);

   $select_pdf = $conn->prepare("SELECT * FROM `posts` WHERE image = ? AND R_id = ?");
   $select_pdf->execute([$pdf, $admin_id]);




   if(isset($pdf)){
      if($select_pdf->rowCount() > 0 AND $image != ''){
         $message[] = 'pdf name repeated!';
      }elseif($pdf_size > 2000000){
         $message[] = 'pdf size is too large!';
      }else{
         move_uploaded_file($pdf_tem_loc, $pdf_store);
      }
   }else{
      $pdf = '';}

   if(isset($image)){
      if($select_image->rowCount() > 0 AND $image != ''){
         $message[] = 'image name repeated!';
      }elseif($image_size > 2000000){
         $message[] = 'images size is too large!';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);
      }
   }else{
      $image = '';
   }

   if($select_pdf->rowCount() > 0 AND $pdf != ''){
      $message[] = 'please rename your pdf!';
   }
   elseif($select_image->rowCount() > 0 AND $image != ''){
      $message[] = 'please rename your image!';}
      else{
      $insert_post = $conn->prepare("INSERT INTO `posts`(R_id, name, title, content, category, image, status,pdf,email) VALUES(?,?,?,?,?,?,?,?,?)");
      $insert_post->execute([$admin_id, $name, $title, $content, $category, $image, $status,$pdf,$email]);
      $message[] = 'post published!';
   }
   
}

if(isset($_POST['draft'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $title = $_POST['title'];
   $title = filter_var($title, FILTER_SANITIZE_STRING);
   $content = $_POST['content'];
   $content = filter_var($content, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $category = $_POST['Area'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $status = 'deactive';
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   
   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = '../uploaded_img/'.$image;

   $select_image = $conn->prepare("SELECT * FROM `posts` WHERE image = ? AND R_id = ?");
   $select_image->execute([$image, $admin_id]); 

   $pdf=$_FILES['pdf']['name'];
   $pdf_type=$_FILES['pdf']['type'];
   $pdf_size=$_FILES['pdf']['size'];
   $pdf_tem_loc=$_FILES['pdf']['tmp_name'];
   $pdf_store="../uploaded_pdf/".$pdf;

   move_uploaded_file($pdf_tem_loc,$pdf_store);

   $select_pdf = $conn->prepare("SELECT * FROM `posts` WHERE image = ? AND R_id = ?");
   $select_pdf->execute([$pdf, $admin_id]);




   if(isset($pdf)){
      if($select_pdf->rowCount() > 0 AND $image != ''){
         $message[] = 'pdf name repeated!';
      }elseif($pdf_size > 2000000){
         $message[] = 'pdf size is too large!';
      }else{
         move_uploaded_file($pdf_tem_loc, $pdf_store);
      }
   }else{
      $pdf = '';}

   if(isset($image)){
      if($select_image->rowCount() > 0 AND $image != ''){
         $message[] = 'image name repeated!';
      }elseif($image_size > 2000000){
         $message[] = 'images size is too large!';
      }else{
         move_uploaded_file($image_tmp_name, $image_folder);
      }
   }else{
      $image = '';
   }

   if($select_pdf->rowCount() > 0 AND $pdf != ''){
      $message[] = 'please rename your pdf!';
   }
   elseif($select_image->rowCount() > 0 AND $image != ''){
      $message[] = 'please rename your image!';}
      else{
      $insert_post = $conn->prepare("INSERT INTO `posts`(R_id, name, title, content, category, image, status,pdf) VALUES(?,?,?,?,?,?,?,?)");
      $insert_post->execute([$admin_id, $name, $title, $content, $category, $image, $status,$pdf]);
      $message[] = 'post Saved!';
   }
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>posts</title>

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">


   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>


<?php include '../components/R_header.php' ?>

<section class="post-editor">

   <h1 class="heading">add new post</h1>

   <form action="" method="post" enctype="multipart/form-data">
<!-- HIdden Input takes the NAME from the database,Session was admin_id so taking name from rec TAble and sending through HTML-->
      <input type="hidden" name="name" value="<?= $fetch_profile['name']; ?>">
      <input type="hidden" name="email" value="<?= $fetch_profile['email']; ?>">
      <p>post title <span>*</span></p>
      <input type="text" name="title" maxlength="100" required placeholder="add post title" class="box">
      <p>post content <span>*</span></p>
      <textarea name="content" class="box" required maxlength="10000" placeholder="write your content..." cols="30" rows="10"></textarea>
      <p>post Area <span>*</span></p>
      <select name="Area" class="box" required>
         <option value="" selected disabled>-- select Area* </option>
         <option value="Dhaka">Dhaka</option>
         <option value="Sylhet">Sylhet</option>
         <option value="Ctg">Ctg</option>
         <option value="Barisal">Barisal</option>
         <option value="Cumilla">Cumilla</option>
         <option value="Rangpur">Rangpur</option>
         <option value="Dinajpur">Dinajpur</option>
         <option value="Bandarban">Bandarban</option>
         <option value="Khagrachari">Khagrachari</option>
         <option value="Khulna">Khulna</option>
        
</Select>

<php>


</select>
      <p>post category <span>*</span></p>
      <select name="category" class="box" required>
         <option value="" selected disabled>-- select category* </option>
         <option value="Individual">Individual</option>
         <option value="Institutional">Institutional</option>
         <option value="Educational">Educational</option>
         <option value="Treatment">Treatment</option>
  
      </select>
      <p>post image</p>
      <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png, image/webp">
     

      <label for="">Choose Your PDF File</label><br>
      <p>PDF</p>
      <input type="file" name="pdf" class="box" accept="pdf/pdf">
        <label for="">Choose Your PDF File</label><br>
       

        <div class="flex-btn">
         <input type="submit" value="publish post" name="publish" class="btn">
         <input type="submit" value="save draft" name="draft" class="option-btn">
      </div>
      
   </form>

</section>

<script src="../js/admin_script.js"></script>

</body>
</html>