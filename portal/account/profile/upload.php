<?php
$username=$_POST['username'];
$target_dir = "../../../images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 2000000) {
    header("Location: index.php?pictureUpdated=0");
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "png") {
    header("Location: index.php?pictureUpdated=0");
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    header("Location: index.php?pictureUpdated=0");
// if everything is ok, try to upload fil    
} else {
    $target_file="".$username.".png";
    
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$target_file)) {
        header("Location: index.php?pictureUpdated=1");
    } else {
        header("Location: index.php?pictureUpdated=0");
    }
}
?>