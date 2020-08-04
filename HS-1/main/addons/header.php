<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home Security Surveillance</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/home.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel = "stylesheet" href = 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<link  href = "css/security.css" rel = "stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    
$(document).ready(function(){
    $("#camera_p").hide();
  $("#camera").mouseenter(function(){
    $("#camera_p").show(); 
  });
    $("#camera").mouseleave(function(){
    $("#camera_p").hide().fade(2000); 
  });
    
    
    $("#lock_p").hide();
  $("#lock").mouseenter(function(){
    $("#lock_p").show();
  });
    $("#lock").mouseleave(function(){
    $("#lock_p").hide().fade(2000); 
  });
    
    $("#motion_p").hide();
  $("#motion").mouseenter(function(){
    $("#motion_p").show();
  });
    $("#motion").mouseleave(function(){
    $("#motion_p").hide().fade(2000); 
  });
    });
    
    
</script>

<link href="css/notif.css" rel="stylesheet">

</head>

<body>