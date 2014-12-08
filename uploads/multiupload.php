<!DOCTYPE html>
<html>
<?php 
    require_once "../Layout/header.php";
    include "upload.php";
?>
    <head>
        <title>Photo Uploads</title>
        </head>
<body>
<?php nav_bar(); ?>
       <div id="maindiv"> 

            <div id="formdiv">
                <h2>Image Upload</h2>
                <div class="rounded container-fluid" id="post">
                
                    <p>Use Jpeg,Png,Jpg format ONLY. Image Size Should Be Less Than 2000KB.</p>
                <form enctype="multipart/form-data" action="" method="post">
                    <div id="uploadButton">
                        <button type="button" class="btn btn-primary upload" id="add_more">Add More Files</button>
                        <button type="submit" name="submit" id="upload" class="upload btn btn-primary">Upload File</button>
                    </div>
                    <div id="filediv"><input name="file[]" type="file" id="file"></div>
                </form>
                <br id="test">
                <br/>
                <br/>
                </div>
            </div>
        </div>
        <!-------Including jQuery from google------>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="script.js"></script>
    </body>
</html>