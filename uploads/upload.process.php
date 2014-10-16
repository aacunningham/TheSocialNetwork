<?php  

// filename: upload.process.php

//THis is to make a note of the current working directory, relative to root.
$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);

// This is to make a note of the directory that will recieve the uploaded files
$uploadsDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . 'uploaded_files/';

// This is  to make a note of the location of the upload form in case we need it
$uploadForm = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.php';

// This is to make a note of the location of the success page
$uploadSuccess = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . 'upload.success.php';

// This is the name of the fieldname used for the file in the HTML form
$fieldname = 'file';

//echo'<pre>';print_r($_FILES);exit;


// Here are some of the possible PHP upload errors
$errors = array(1 => 'php.ini max file size exceeded', 
                2 => 'html form max file size exceeded', 
                3 => 'file upload was only partial', 
                4 => 'no file was attached');

// Here is to check the upload form was actually submitted else print form
isset($_POST['submit'])
	or error('the upload form is neaded', $uploadForm);
	
// Here is kto check if any files were uploaded and if 
// so store the active $_FILES array keys
$active_keys = array();
foreach($_FILES[$fieldname]['name'] as $key => $filename)
{
	if(!empty($filename))
	{
		$active_keys[] = $key;
	}
}

// Here is teh check at least one file was uploaded
count($active_keys)
	or error('No files were uploaded', $uploadForm);
		
// Here is to check for standard uploading errors
foreach($active_keys as $key)
{
	($_FILES[$fieldname]['error'][$key] == 0)
		or error($_FILES[$fieldname]['tmp_name'][$key].': '.$errors[$_FILES[$fieldname]['error'][$key]], $uploadForm);
}
	
// Here is to check that the file we are working on really was an HTTP upload
foreach($active_keys as $key)
{
	@is_uploaded_file($_FILES[$fieldname]['tmp_name'][$key])
		or error($_FILES[$fieldname]['tmp_name'][$key].' not an HTTP upload', $uploadForm);
}
	
// Here lies the validation... since this is an image upload script we 
// check to make sure the upload is an image or not
foreach($active_keys as $key)
{
	@getimagesize($_FILES[$fieldname]['tmp_name'][$key])
		or error($_FILES[$fieldname]['tmp_name'][$key].' not an image', $uploadForm);
}
	
// This is to make a unique filename for the uploaded file and check it is 
// not taken... if it is keep trying until we find a vacant one
foreach($active_keys as $key)
{
	$now = time();
	while(file_exists($uploadFilename[$key] = $uploadsDirectory.$now.'-'.$_FILES[$fieldname]['name'][$key]))
	{
		$now++;
	}
}

// this is to move the file to its final destination and allocate it with the new filename
foreach($active_keys as $key)
{
	@move_uploaded_file($_FILES[$fieldname]['tmp_name'][$key], $uploadFilename[$key])
		or error('receiving directory insuffiecient permission', $uploadForm);
}
	
// This is to redirect the client to the success page.
header('Location: ' . $uploadSuccess);

// this is to make an error handler which will be used if the upload fails
function error($error, $location, $seconds = 5)
{
	header("Refresh: $seconds; URL=\"$location\"");
	echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"'."\n".
	'"http://thesocialnetwork.com">'."\n\n".
	'<html lang="en">'."\n".
	'	<head>'."\n".
	'		<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">'."\n\n".
	'		<link rel="stylesheet" type="text/css" href="stylesheet.css">'."\n\n".
	'	<title>Upload error</title>'."\n\n".
	'	</head>'."\n\n".
	'	<body>'."\n\n".
	'	<div id="Upload">'."\n\n".
	'		<h1>Upload failure</h1>'."\n\n".
	'		<p>An error has occured: '."\n\n".
	'		<span class="red">' . $error . '...</span>'."\n\n".
	'	 	The upload form is reloading</p>'."\n\n".
	'	 </div>'."\n\n".
	'</html>';
	exit;
} // This will be the end error handler

?>