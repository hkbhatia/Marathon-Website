<!DOCTYPE html>
<!-- 
  Assignment 3
  Bhatia, Hitesh
  821439483
 -->
<html>
<head>
    <meta charset="utf-8">
    <title>Authentication</title>
    <link rel="stylesheet" href="report.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

 <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body  data-spy="scroll" data-target="#my-navbar">
        <nav class="navbar navbar-inverse navbar-fixed-top" id="my-navbar">
    <div class="container">
        <div class="navbar-header">
            <a href="index.html" class="navbar-brand">SDSU Marathon</a>
        </div><!--navbar header-->
         
    </div><!--navbar container-->
    </nav><!--end navbar -->


  <div class="container">
  <div class="panel panel-body">
    <section>
        <div class="row">
            <div class="col-lg-12">
<?php

include('helpers.php');
include('p3.php');

check_post_only();
$params = process_parameters();
validate_data($params);
store_data_in_db($params);

include('confirmation.php');
?>   
</div>
</div>
</section>
</div>
</div>
</body>
</html> 