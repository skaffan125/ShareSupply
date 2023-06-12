<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Display PDF</title>
    <style media="screen">
      embed{
        border: 2px solid black;
        margin-top: 30px;
      }
      .div1{
        margin-left: 170px;
      }
    </style>
  </head>
  <body>
    <div class="div1">
      <?php
     
     $get_id = $_GET['post_id'];
  
  /*   $stmt = $conn->prepare("SELECT pdf FROM posts WHERE id=$get_id");
$stmt->execute();

// Retrieve the data as an associative array
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

     $query = "SELECT pdf FROM posts WHERE id=$get_id";
     $result = $conn->query($query);
     
      //$sql="SELECT pdf from posts WHERE id=?";
     // $result = $conn->query($sql);
      while ($info=mysqli_fetch_array($result))
      <embed type="application/pdf" src="uoloaded_img/<?php echo $info['pdf'] ; ?>" width="900" height="500"> {*/

        $query = "SELECT pdf FROM posts WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $get_id);
$stmt = $conn->prepare($query);

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
  header('Content-type: application/pdf');
  echo $row['pdf'];}
 else {
  echo "PDF not found";
}
        ?>
  
    <?php
      

      ?>

    </div>

  </body>
</html>
