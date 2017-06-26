
<?php  
	session_start();
	require 'config.php';
	//template taken from http://www.htmlgoodies.com/beyond/php/article.php/3877766/Web-Developer-How-To-Upload-Images-Using-PHP.htm
	// first let's set some variables
	// make a note of the current working directory, relative to root.
	$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
	$directory_self = str_replace('//', '/', $directory_self);

	// make a note of the directory that will recieve the uploaded files
	$uploadsDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . 'uploads/';

	// make a note of the location of the upload form in case we need it
	$uploadForm = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self ;
	$domain     = $_SERVER['HTTP_HOST'];
	$parameters   = $_SERVER['QUERY_STRING'];
	$uploadSuccess ='http://' . $_SERVER['HTTP_HOST'] . $directory_self ;
	
	if(isset($_GET['month'])){
	$uploadSuccess ='http://' . $_SERVER['HTTP_HOST'] . $directory_self.'?'.$parameters ;
	$uploadForm = 'http://' . $_SERVER['HTTP_HOST'] . $directory_self . '?'.$parameters;
	}
	// name of the fieldname used for the file in the HTML form
	$fieldname = 'file';
	// possible PHP upload errors
	$errors = array(1 => 'php.ini max file size exceeded', 
					2 => 'html form max file size exceeded', 
					3 => 'file upload was only partial', 
					4 => 'no file was attached');
	// check for standard uploading errors
	($_FILES[$fieldname]['error'] == 0)
		or error($errors[$_FILES[$fieldname]['error']], $uploadForm);

	// validation... since this is an image upload script we 
	// should run a check to make sure the upload is an image
	@getimagesize($_FILES[$fieldname]['tmp_name'])
		or error('only image uploads are allowed', $uploadForm);
	
	// make a unique filename for the uploaded file and check it is 
	// not taken... if it is keep trying until we find a vacant one
	$now = time();
	while(file_exists($uploadFilename = $uploadsDirectory.$now.'-'.$_FILES[$fieldname]['name']))
	{
		$now++;
	}
	$displayName  = explode('/', $uploadFilename);
	$displayName= end($displayName);
	$displayName="uploads/".$displayName;
	$user=$_SESSION['email'];
	
	$stmt = $con->prepare("UPDATE codep_mentors SET image_path=? WHERE email=?");
	$thisPath = $path.$image_name?: '';
	$id=6;
	$stmt->bind_param('ss', $displayName, $user);
	if( $stmt->execute()){
		$stmt->close();
	}
	else {
					
		echo "Error updating image";
	}
	header("Refresh: 1; url=index.php");
	
	// now let's move the file to its final and allocate it with the new filename
	@move_uploaded_file($_FILES[$fieldname]['tmp_name'], $uploadFilename)
		or error('receiving directory insuffiecient permission', $uploadForm);
	// If you got this far, everything has worked and the file has been successfully saved.
	// We are now going to redirect the client to the success page.
	header('Location: ' . $uploadSuccess);
	// make an error handler which will be used if the upload fails
	function error($error, $location, $seconds = 2)
	{
		header("Refresh: $seconds; URL=\"$location\"");
		echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"'."\n".
		'"http://www.w3.org/TR/html4/strict.dtd">'."\n\n".
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
	} // end error handler

?>