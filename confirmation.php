<!-- 
  Assignment 3
  Bhatia, Hitesh
  821439483
 -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;
    charset=iso-8859-1" />
    <title>Confirmation Page</title>
<link rel="stylesheet" type="text/css" href="style.css" />
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


<body data-spy="scroll" data-target="#my-navbar">
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
<?php

 $UPLOAD_DIR = 'userimages';
$fname = $_FILES['image']['name'];

echo <<<ENDBLOCK
        <section class="sub-section black reg-black" >
    <h1>$params[1], thank you for registering.</h1><br/>
    <div class='col-md-12'>
        <div class='col-md-4' style='text-align: right;'>
        <img src="$UPLOAD_DIR/$fname" width='200px' />
        </div>

        <div class='col-md-8'>
         <table class='table table-bordered table-hover'>
        <tr>
            <td>Name</td>
            <td>$params[1] $params[2] $params[3]</td>
        </tr>
        <tr>
            <td>Birthday</td>
            <td>$params[12]</td>
        </tr>
        <tr>
            <td>Address</td>
            <td>$params[4] $params[5]</td>
        </tr>
        <tr>
            <td>City</td>
            <td>$params[6]</td>
        </tr>
        <tr>
            <td>State</td>
            <td>$params[7]</td>
        </tr>
        <tr>
            <td>Zip Code</td>
            <td>$params[8]</td>
        </tr>

        <tr>
            <td>Phone</td>
            <td>$params[9]</td>
        </tr>

        <tr>
            <td>email</td>
            <td>$params[10]</td>
        </tr>

        <tr>
            <td>Gender</td>
            <td>$params[11]</td>
        </tr>
        
        <tr>
            <td>Experience</td>
            <td>$params[14]</td>
        </tr>

        <tr>
            <td>Category</td>
            <td>$params[15]</td>
        </tr>   

        <tr>
            <td>Medical</td>
            <td>$params[13]</td>
        </tr> 

        <tr>
            <td>Photo Name</td>
            <td>$fname</td>
    </table>
        </div>
    </div>

    <h1> Have fun on Race Day!</h1>
    </section>                     
ENDBLOCK;


?>
</div><!--end row-->
    </section>
    </div>
</div>
</body></html>
