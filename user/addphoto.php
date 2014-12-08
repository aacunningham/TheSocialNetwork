<?php
    
    require_once "../Layout/header.php";

?>

    <title>Add Photo</title>
</head>
<body>
    <?php nav_bar(); ?>
    <div class="container">
        <div class="row">
            <div class="col-xs-offset-2 col-xs-8">
                <div class="rounded" style="background-color: #EEE">
                    <h1>Add your profile picture!</h1>
                    <img class="img-thumbnail" height="200" width="200" src="../assets/icons/default.png" alt="Your profile picture" id="profpic" style="margin-top:10px">
                    <form action="aboutyou.php" method="POST" enctype="multipart/form-data" role="form" class="form" style="padding-top: 10px">
                        <input type="file" name="picture" id="picinput" accept="image/jpeg image/png">
                        <div class="row" style="padding-top: 5px">
                            <div class="col-xs-2 col-xs-offset-4">
                                <button style="margin: 0px !important" class="btn btn-success" type="submit" name="sub" value="submit">Continue!</button>
                            </div>
                            <div class="col-xs-2" style="padding-top: 7px">
                                <a href="aboutyou.php">Skip</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>   
    </div>
    <script>

    $("#picinput").change(function(){
        if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#profpic").attr("src", e.target.result);
            }

            reader.readAsDataURL(this.files[0]);
        }
    });
    </script>
</body>
