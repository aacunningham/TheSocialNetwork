<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../Layout/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../Layout/style.css">
    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700' rel='stylesheet' type='text/css'>
    <script src="../Layout/js/jquery-1.11.1.min.js"></script>
    <script src="../Layout/js/bootstrap.min.js"></script>
    <script src="../Layout/js/typeahead.bundle.min.js"></script>
<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    require_once "../config/config.php";
    require_once "../assets/functions.php";
    require_once "../user/user.php";
    require_once "../post/post.php";
    require_once "../blog/blog.php";
    require_once "../folder/folder.php";
    require_once "../category/category.php";
    require_once "../profile/module.php";
    require_once "../school/school.php";
    require_once "../work/work.php";

    $user = new user ();
    $post = new post ();
    $blog = new blog ();
    $folder = new folder ();
    $category = new category ();
    $module = new module ();
    $school = new school ();
    $work = new work ();

    if (!$user->loggedIn() and $_SERVER['PHP_SELF'] != "/user/login.php" 
    	and $_SERVER['PHP_SELF'] != "/user/new.php" 
    	and $_SERVER['PHP_SELF'] != "/tsn_security/forgot_password.php"
		and $_SERVER['PHP_SELF'] != "/tsn_security/password_challenge.php"
		and $_SERVER['PHP_SELF'] != "/user/change_password.php") { ?>
        <script type="text/javascript">
            redirect ("../user/login.php");
        </script>
    <?php }

    function nav_bar () { ?>

    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="../profile/home.php" target="_self">The Social Network</a>
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
<?php if (!empty ($_SESSION['uid'])) { ?>
                <ul class="nav navbar-nav">
                    <form action="../user/friends.php" method="POST" class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input name="search" class="form-control" id="navbar-search-input" type="text" placeholder="Search Users" autocomplete="off"></input>
                            <div id="nav-suggestions" >aoeu</div>
                        	<button class="btn btn-default no-margin" name="submit" id="navbar-btn-search" type="submit" value="submit">Search</button>
                        </div>
                    </form>
                </ul>
                <script>
			    	$(document).ready(function(){
			    		var res_count = 0;   
			    		$("#navbar-search-input").keyup(function(){
			    			// Because assets/functions.php has some javascript in it
			    			// We can't directly expect back a JSON element and need to parseout
			    			// that bit of code then parse the remaining string as JSON
				    		$.ajax({	//TODO - add some debounce to this action to save bandwidth
					            type : 'POST',
				    			url : '../user/search_res.php',
					            dataType: 'text',
					            data: {
					                search : $("#navbar-search-input").val()
					            },
					            success:function (response) {
					                dispNames = [];
					                res_count = 0;
					                var data_raw = response.split("/script>\r\n")[1];	//get JSON string
					                var data = JSON.parse(data_raw);
					                
					                //console log for debugging
					                if( data['search_result1'] !== undefined ){
					                	console.log(data['search_result1']);
					                	res_count += 1;
					                }
					                if( data['search_result2'] !== undefined ){
					                	console.log(data['search_result2']);
					                	res_count += 1;
					                }
					                
					                //show the suggestions bar
					                console.log("res_count: " + res_count);
					                if( res_count >= 1) {
					                	$("#nav-suggestions").css('visibility', 'visible');
					                	//build suggestions bar list
					                	var suggest_out = data['search_result1']['fname'] + " " + data['search_result1']['lname'];
					                	if( res_count >= 2) {
					                		suggest_out = suggest_out + "<br>" + data['search_result2']['fname'] + " " + data['search_result2']['lname'];
					                	}
					                	$("#nav-suggestions").html(suggest_out);
					                } else {
										$("#nav-suggestions").css('visibility', 'hidden');					                		
					                }
				            	},
				            	error:function(){
				            		$("#navbar-btn-search").html( 'nope' );
				            	}  
				       		});	//ajax
			    		});//keyup
			    	});	//document ready
    			</script>
<?php } ?>
                <ul class="nav navbar-nav navbar-right">
<?php if (!empty ($_SESSION['uid'])) { ?>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">Go to... <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="../profile/profile.php">Your Profile</a></li>
                            <li><a href="../profile/home.php">Home</a></li>
                            <li><a href="../post/interface.php">Posts</a></li>
                            <li><a href="../blog/interface.php">Blogs</a></li>
                            <li><a href="../folder/interface.php">Folders</a></li>
                            <li><a href="../category/interface.php">Categories</a></li>
                            <li><a href="../school/interface.php">Schools</a></li>
                            <li><a href="../work/interface.php">Work</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><?php

    if (!empty ($_SESSION['uid'])) {$user = new user (); echo $user->fname.' '.$user->lname;} else {echo "User";}

                        ?><span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="../user/edit.php">Edit Profile</a></li>
                            <li><a href="../user/logout.php">Logout</a></li>
                        </ul>
                    </li>
<?php } else { ?>
                    <form action="../user/login.php" method="POST" class="navbar-form navbar-right" role="form">
                        <div class="form-group">
                            <input type="email" name="email" class="form-control" placeholder="Email">
                        </div>
                        <div class="form-group" style="position:relative">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                            <a href="../tsn_security/forgot_password.php" class="form-helper" data-toggle="tooltip" data-placement="bottom" title="Forgot password?">?</a>
                        </div>
                        <button class="btn btn-success no-margin" type="submit" name="submit" value="submit" style="margin-right:5px !important">Login</button>
                    </form>
                    <script>
                        $(function () {
                            $('[data-toggle="tooltip"]').tooltip()
                        })
                    </script>
<?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php } ?> 
    <div class="container">
