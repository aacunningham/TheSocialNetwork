<?php

if (isset($_POST['submit'])) {
    $j = 0; //Variable for indexing uploaded image 

    $target_path = "../uploads/"; 
for ($i = 0; $i < count($_FILES['file']['name']); $i++) {

    $validextensions = array("jpeg", "jpg", "png"); 
    $ext = explode('.', basename($_FILES['file']['name'][$i]));
    $file_extension = end($ext);

    $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];
        $j = $j + 1;      
      
if (($_FILES["file"]["size"][$i] < 200000) 
                && in_array($file_extension, $validextensions)) {
     if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {
                echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';

    echo "<img src='$uploaddir.$file_name' />";
        $config_basedir="http://thesocialnetwork.com/";
    header("Location:".$config_basedir ."index.php?imageName=".$file_name ); exit();
        } else {
                echo $j. ').<span id="error">please try again!.</span><br/><br/>';
            }
        } else {
            echo $j. ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
        }
    }
}
?>