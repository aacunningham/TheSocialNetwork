<!DOCTYPE html>
<?php 
    require_once "../Layout/header.php";
?>
<html>
    <head>
		<title>Photo Uploads</title>
		<!-------Including jQuery from google------>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="script.js"></script>
		
		<!-------Including CSS File------>
        <link rel="stylesheet" type="text/css" href="style.css">
<body>
        <div id="maindiv">

            <div id="formdiv">
                <h2>Image Upload</h2>
                <form enctype="multipart/form-data" action="" method="post">
                    Use Jpeg,Png,Jpg format ONLY. Image Size Should Be Less Than 2000KB.
                    <hr/>

                    <div id="filediv" style="display: inline;"><input name="file[]" type="file" id="file"/></div>
                    <br id="test">
                    <input type="button" id="add_more" class="upload" value="Add More Files"/>
                    <input type="submit" value="Upload File" name="submit" id="upload" class="upload"/>
                </form>
                <br/>
                <br/>
                <?php include "upload.php"; ?>
            </div>
        </div>
    </body>
</html>