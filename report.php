<!-- 
  Assignment 3
  Bhatia, Hitesh
  821439483
 -->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Runner Report</title>
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
<?php
if(isset($_POST['submit']))
{
    $pass = $_POST['name'];

$valid = false;

$raw = file_get_contents('password.dat');
//echo $pass;
$data = explode(" ",$raw);
foreach($data as $item) {
	
    $pair = explode('=',$item);
    if(crypt($pass,$pair[1]) === $pair[1]) 
    {
            $valid = true;    
            break;        
    }
    }  #end foreach
    
if($valid)
{

$server = 'opatija.sdsu.edu:3306';
$user = 'jadrn008';
$password = 'seat';
$database = 'jadrn008';
    $COMPUTER_DIR = 'userimages/';
$counter=0;
$today = new DateTime();
if(!($db = mysqli_connect($server,$user,$password,$database)))
    echo "ERROR in connection ".mysqli_error($db);
else {
    $sql = "select fname, lname,dob,experience,runner_image from person where category='Teen' order by lname;"; 
    $sql2 = "select fname, lname,dob,experience,runner_image from person where category='Adult' order by lname;";    
    $sql3 = "select fname, lname,dob,experience,runner_image from person where category='Senior' order by lname;";    //concat(fname,concat(" ",lname)),

    //concat(fname,concat(" ",lname)),
       //concat(fname,concat(" ",lname)),
    $result = mysqli_query($db, $sql);
    if(!result)
        echo "ERROR in query".mysqli_error($db);
    echo "<table  class=\"table table-hover table-bordered\">\n";
    echo "<tr><th class=\"table_heading\" colspan=\"5\">1. Teen Runners</th></tr>\n";  
    echo
   "<tr><th>First Name</th><th>Last Name</th><th>Age</th><th>Experience Level</th><th>Runner's Image</th></tr>";

    while($row=mysqli_fetch_row($result)) {
        echo "<tr>";
        foreach(array_slice($row,0) as $item) 
        {
            if (strpos($item, '.jpg') !== false ||strpos($item, '.png') !== false||strpos($item, '.jpeg') !== false||strpos($item, '.bmp') !== false||strpos($item, '.JPG') !== false) {
            echo "<td><img src=\"$COMPUTER_DIR/$item\""." width='200px' /></td>";
            }
            else
            {
                if($counter===2)
                {
                  //explode the date to get month, day and year
                  $birthDate = explode("/", $item);
                  //get age from date or birthdate
                  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                    ? ((date("Y") - $birthDate[2]) - 1)
                    : (date("Y") - $birthDate[2]));

                    echo "<td>$age</td>";
                    //echo "<td>$diff</td>";
                }
                else
                echo "<td>$item</td>";
            }
            $counter=$counter+1;
        }
        $counter=0;
        echo "</tr>\n";          
        }

$result = mysqli_query($db, $sql2);
echo "<tr><th class=\"table_heading\" colspan=\"5\">2. Adult Runners</th></tr>\n";    
while($row=mysqli_fetch_row($result)) {
        echo "<tr>";
        foreach(array_slice($row,0) as $item) 
        {
            if (strpos($item, '.jpg') !== false ||strpos($item, '.png') !== false||strpos($item, '.jpeg') !== false||strpos($item, '.bmp') !== false||strpos($item, '.JPG') !== false) {
            echo "<td><img src=\"$COMPUTER_DIR/$item\""." width='200px' /></td>";
            }
            else
            {
                if($counter===2)
                {
                  //explode the date to get month, day and year
                  $birthDate = explode("/", $item);
                  //get age from date or birthdate
                  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                    ? ((date("Y") - $birthDate[2]) - 1)
                    : (date("Y") - $birthDate[2]));

                    echo "<td>$age</td>";
                    //echo "<td>$diff</td>";
                }
                else
                echo "<td>$item</td>";
            }
            $counter=$counter+1;
        }
        $counter=0;
        echo "</tr>\n";          
        }

        $result = mysqli_query($db, $sql3);
echo "<tr><th class=\"table_heading\" colspan=\"5\">3. Senior Runners</th></tr>\n";  
while($row=mysqli_fetch_row($result)) {
        echo "<tr>";
        foreach(array_slice($row,0) as $item) 
        {
            if (strpos($item, '.jpg') !== false ||strpos($item, '.png') !== false||strpos($item, '.jpeg') !== false||strpos($item, '.bmp') !== false||strpos($item, '.JPG') !== false) {
            echo "<td><img src=\"$COMPUTER_DIR/$item\""." width='200px' /></td>";
            }
            else
            {
                if($counter===2)
                {
                  //explode the date to get month, day and year
                  $birthDate = explode("/", $item);
                  //get age from date or birthdate
                  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                    ? ((date("Y") - $birthDate[2]) - 1)
                    : (date("Y") - $birthDate[2]));

                    echo "<td>$age</td>";
                    //echo "<td>$diff</td>";
                }
                else
                echo "<td>$item</td>";
            }
            $counter=$counter+1;
        }
        $counter=0;
        echo "</tr>\n";          
        }

    mysqli_close($db);
    }
    echo "</table>";
}	
else
{
	?>
	<h1>Login to view runner's report</h1>
            <div class="col-lg-6">
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<div class="form-group">
   					<div class="col-md-6">
   			<label class="control-label  pull-right">Enter Password</label>
   		</div>
		<div class="col-md-6">
   			<input class="form form-control" type="password" name="name"><br>
   		</div>
   	</div>
   	<div class="form-group">
		<div class="col-lg-6 pull-right">
      <input type="reset" name="Clear" class="btn btn-primary" value="Clear" />
			<input class="btn btn-primary" type="submit" name="submit" value="Login"><br>
		</div>
	</div>
   					
				</form>
				<?php
    echo "<h3>Login Unsuccessful.</h3>";   
}
}
else
{
	?>
	<h1>Login to view runner's report</h1>
            <div class="col-lg-6">
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<div class="form-group">
		<div class="col-md-6">
   			<label class="control-label pull-right">Enter Password</label>
   		</div>
		<div class="col-md-6">
   			<input class="form form-control" type="password" name="name"><br>
   		</div>
   		
</div>
   					<div class="form-group">
		<div class="col-lg-6 pull-right">
			<input type="reset" name="Clear" class="btn btn-primary" value="Clear" />
			<input class="btn btn-primary" type="submit" name="submit" value="Login"><br>
		</div>
	</div>
				</form>
				<?php
}
                    
?>   
            </div>
        </div><!--end row-->
    </section>
    </div>
</div>
</body>
</html>
  