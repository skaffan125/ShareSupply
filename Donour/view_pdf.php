<?php\// Replace with the actual hidden value you want to use
$fileName = $_POST['pdf_id']; // Assuming the hidden field value contains the file name



include 'components/connect.php';
?>

<!DOCTYPE html>
<head>
<input type="hidden" name="pdf_id" value="<? $hiddenValue ;?>">
</head>
<body>

<iframe src="../uploaded_pdf/<? $fileName; ?>" width="100%" height="6000px"> </iframe>
</body>

</html>