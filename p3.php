<?php
//  Assignment 3
//  Bhatia, Hitesh
//  821439483

$msg = "";
function validate_data($params){
    
    if(empty($params[1])){
        $msg .= "Please enter your first name<br />";
    } elseif(!preg_match("/^[a-zA-Z0-9' ]*$/",$params[1])){
        $msg .= "Only letters,numbers and white space allowed for first name<br />";
    }

    if(strlen($params[3]) == 0 || empty($params[3])){
        $msg .= "Please enter your last name<br /";
    } elseif(!preg_match("/^[a-zA-Z0-9' ]*$/",$params[3])){
        $msg .= "Only letters,numbers and white space allowed for last name<br />";
    }

    $birthDate = explode("/", $params[12]);
                  //get age from date or birthdate
                  $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
                    ? ((date("Y") - $birthDate[2]) - 1)
                    : (date("Y") - $birthDate[2]));
    if($age < 8 || $age > 95) {
        $msg .="Sorry only for runners age 8-95, you are $age<br/>";
    }
    elseif(!validateDate($params[12]))
    {
         $msg .="Date is not valid<br/>";
    }

    if(empty($params[4])){
        $msg .= "Please enter your address<br /";
    } 
    
    if(empty($params[6])){
        $msg .= "Please enter your City<br /";
    } elseif(!preg_match("/^[a-zA-Z ]*$/",$params[6])){
        $msg .= "Only letters and white space allowed for city<br />";
    }
    if(empty($params[7])){
        $msg .= "Please enter your State<br /";
    }

    if(empty($params[8])){
        $msg .= "Please enter your zipcode<br /";
    } elseif(!preg_match("/^[0-9]*$/",$params[8])){
        $msg .= "Only numbers allowed for zipcode<br />";
    } elseif(strlen($params[8]) != 5 ){
        $msg .= "Enter in 5 digits for zipcode<br />";
    }

    if(empty($params[9])){
        $msg .= "Please enter your phone area code<br /";
    } elseif(!preg_match("/^[0-9]*$/",$params[9])){
        $msg .= "Only numbers allowed for phone area code<br />";
    } elseif(strlen($params[9]) != 10  ){
        $msg .= "Enter in 3 digits for phone area code<br />";
    }

    if(empty($params[10])){
        $msg .= "Please enter your email<br /";
    } elseif(!filter_var($params[10], FILTER_VALIDATE_EMAIL)){
        $msg .= "Invalid email format";
    }

    if(empty($params[11])){
        $msg .= "Please choose your gender<br /";
    }

    if(empty($params[14])){
        $msg .= "Please choose your experience level<br /";
    }

    if(empty($params[15])){
        $msg .= "Please choose your category<br /";
    }

    if(empty($_FILES['image']['name'])){
        $msg .= "Please upload a photo<br /";
    }

    if(isset($_FILES['image'])){
$UPLOAD_DIR = 'userimages/';
    $COMPUTER_DIR = '/home/jadrn008/public_html/proj3/userimages/';
    $fname = $_FILES['image']['name'];// . date('Y-m-d H:i:s');

    if(file_exists("$UPLOAD_DIR".$fname))  {
        $msg .="Error, the file $fname already exists on the server";
        //echo "<b>Error, the file $fname already exists on the server</b><br />\n";
        }
    elseif($_FILES['image']['error'] > 0) {
        $err = $_FILES['image']['error'];
        $msg .=$err;    
       // echo "Error Code: $err ";
    if($err == 1)
        echo "The file was too big to upload, the limit is 2MB<br />";
        } 
    elseif(exif_imagetype($_FILES['image']['tmp_name']) != IMAGETYPE_JPEG) {
        $msg .="ERROR, not a jpg file<br />";   
        //echo "ERROR, not a jpg file<br />";   
        }
## file is valid, copy from /tmp to your directory.        
    else { 
        move_uploaded_file($_FILES['image']['tmp_name'], "$UPLOAD_DIR".$fname);
    } 
        // echo "Success";
      }else{
        $msg .=$errors;
         //print_r($errors);
         //exit;
      }
      if(check_duplicate())
      {
        $msg .="Email Id already registered..";

      }

    if($msg){
        write_form_error_page($msg);
        exit;
    }
}
//referenced form http://php.net/manual/en/function.checkdate.php
function validateDate($date, $format = 'm/d/Y')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

function check_duplicate()
{
    $server = 'opatija.sdsu.edu:3306';
$user = 'jadrn008';
$password = 'seat';
$database = 'jadrn008';
if(!($db = mysqli_connect($server,$user,$password,$database)))
    echo "ERROR in connection ".mysqli_error($db);
$email =$_POST[email];
$sql = "select * from person where email='$email';";
mysqli_query($db, $sql);
$how_many = mysqli_affected_rows($db);
mysqli_close($db);
if($how_many > 0)
    return true;
else if($how_many == 0)
    return false;
else
    return true;
}

/*
function validate_data($params) {
    $msg = "";
    #if(strlen($params[0]) == 0)
     #   $msg .= "Please enter the runner's image<br />";  
    if(strlen($params[1]) == 0)
        $msg .= "Please enter the runner's first name<br />"; 
    if(strlen($params[3]) == 0)
        $msg .= "Please enter the runner's last name<br />";                        
    if(strlen($params[4]) == 0)
        $msg .= "Please enter runner's address<br />";    
    if(strlen($params[6]) == 0)
        $msg .= "Please enter city<br />";    
    if(strlen($params[7]) == 0)
        $msg .= "Please enter state<br />";  
     if(strlen($params[8]) == 0)
        $msg .= "Please enter the zip code<br />";
    elseif(!is_numeric($params[8])) 
        $msg .= "Zip code may contain only numeric digits<br />";
    if(strlen($params[9]) == 0)
        $msg .= "Please enter primary phone number<br />";
    elseif(!is_numeric($params[9])) 
        $msg .= "Phone number may contain only numeric digits<br />";
    #validate phone number logic may come

    if(strlen($params[10]) == 0)
        $msg .= "Please enter email<br />";
    elseif(!filter_var($params[10], FILTER_VALIDATE_EMAIL))
        $msg .= "Your email appears to be invalid<br/>";        

    if(strlen($params[11]) == 0)
        $msg .= "Please select gender<br />";  
    if(strlen($params[12]) == 0)
        $msg .= "Please select date of birth<br />"; 
    #else logic for birthday will come

    if(strlen($params[14]) == 0)
        $msg .= "Please select experience level<br />"; 
    if(strlen($params[15]) == 0)
        $msg .= "Please select category<br />";                      

    if($msg) {
        write_form_error_page($msg);
        exit;
        }
    }
    */
  
function write_form_error_page($msg) {
    //write_header();
    //echo "<h2>Sorry, an error occurred<br />",
    //$msg,"</h2>";
    write_form($msg);
   //write_footer();
    }  
    
function write_form($msg) {
    print <<<ENDBLOCK
    <div class="page-header" id="contact">
                <h2>Registeration Form</h2>
        </div>
        <div class="row">
            <div class="col-lg-4">
            </div>
            <div class="col-lg-8">
        <form action="process_request.php" class="form-horizontal" enctype="multipart/form-data" method="post" id="myForm">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Runner's Image</label>
                        <div class="col-lg-5">
                            <input type="file" class="form-control" id="image" name="image" placeholder="Enter your name"  accept="image/x-png,image/gif,image/jpeg" required>
                            <div class="error" id="proper_image"></div>
                        </div>
                    </div><!--end form-group-->
                    <div class="form-group">
                        <label for="fname" class="col-lg-3 control-label">First Name</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" id="fname" name="fname" value="$_POST[fname]" placeholder="Enter your name" required>
                            <div class="error" id="fname_space"></div>
                        </div>
                    </div><!--end form-group-->
                    <div class="form-group">
                        <label for="mname" class="col-lg-3 control-label">Middle Name</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" id="mname" name="mname" value="$_POST[mname]"  placeholder="Enter your name" >
                        </div>
                    </div><!--end form-group-->
                    <div class="form-group">
                        <label for="lname" class="col-lg-3 control-label">Last Name</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" id="lname" name="lname" value="$_POST[lname]" placeholder="Enter your name" required="required">
                            <div class="error" id="lname_space"></div>
                        </div>
                    </div><!--end form-group-->
                    <div class="form-group">
                        <label for="address1" class="col-lg-3 control-label">Address 1</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" id="address1" name="address1" value="$_POST[address1]" placeholder="Enter your adress" required="required">
                            <div class="error" id="address1_space"></div>
                        </div>
                    </div><!--end form-group-->
                    <div class="form-group">
                        <label for="address2" class="col-lg-3 control-label">Address 2</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" id="address2" name="address2" value="$_POST[address2]" placeholder="Enter your address">
                        </div>
                    </div><!--end form-group-->
                    <div class="form-group">
                        <label for="city" class="col-lg-3 control-label">City</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" id="city" name="city" value="$_POST[city]" placeholder="Enter your city" required>
                            <div class="error" id="city_space"></div>

                        </div>
                    </div><!--end form-group-->
ENDBLOCK;

$state_values = array("Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","District Of Columbia","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Carolina","North Dakota","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming");

$state_codes = array("AL","AK","AZ","AR","CA","CO","CT","DE","DC","FL","GA","HI","ID","IL","IN","IA","KS","KY","LA","ME","MD","MA","MI","MN","MS","MO","MT","NE","NV","NH","NJ","NM","NY","NC","ND","OH","OK","OR","PA","RI","SC","SD","TN","TX","UT","VT","VA","WA","WV","WI","WY");

$state_len=count($state_values);

            echo "<div class='form-group'>";
            echo "<label for='state' class='col-lg-3 control-label'>State</label>";
            echo "<div class='col-lg-5'>";
            echo "<select name='state' id='state' required class='form-control'>";
            echo "<option value=''>Select State</option>";
            /*foreach($gender_choice_value as $item) {
                echo "<input type='radio' id='gender' required name='gender' value='$item'";
                if($item == $_POST['gender'])
                    echo " checked='checked'";
                echo ">$item";
                }*/
                for($i=0;$i<$state_len;$i++) {
                echo "<option value='$state_codes[$i]'";
                if($state_codes[$i] == $_POST['state'])
                    echo "selected";
                echo ">$state_values[$i]</option>";
                }
                echo "</div>";
            echo "</div>";

    print <<<ENDBLOCK
                        <div class="form-group">
                        <label for="zipcode" class="col-lg-3 control-label">Zip Code</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" id="zipcode" name="zip" value="$_POST[zip]" placeholder="Enter your zipcode"  maxlength="5" minlength="5"  required>

                        </div>
                    </div><!--end form-group-->
                    <div class="form-group">
                        <label for="phone" class="col-lg-3 control-label">Primary Phone</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" id="phone" name="phone" value="$_POST[phone]" placeholder="Enter your phone (XXX-XXX-XXXX)" maxlength="10" minlength="10" required>
                            <div class="error" id="wrong_phone"></div>

                        </div>
                    </div><!--end form-group-->
                    <div class="form-group">
                        <label for="email_id" class="col-lg-3 control-label">Email Address</label>
                        <div class="col-lg-5">
                            <input type="email" class="form-control" id="email_id" name="email" value="$_POST[email]" placeholder="Enter your email ID" required>
                            <div class="error" id="wrong_email"></div>
                            <div class="error" id="dup_email"></div>

                        </div>
                    </div><!--end form-group--> 
                    
ENDBLOCK;
//
$gender_choice = array("Male","Female","Other");
$gender_choice_value = array("M","F","O");

            echo "<div class='form-group'>";
            echo "<label for='gender' class='col-lg-3 control-label'>Gender</label>";
            echo "<div class='col-lg-5'>";
            /*foreach($gender_choice_value as $item) {
                echo "<input type='radio' id='gender' required name='gender' value='$item'";
                if($item == $_POST['gender'])
                    echo " checked='checked'";
                echo ">$item";
                }*/
                for($i=0;$i<count($gender_choice_value);$i++) {
                echo "<input type='radio' id='gender' required name='gender' value='$gender_choice_value[$i]'";
                if($gender_choice_value[$i] == $_POST['gender'])
                    echo " checked='checked'";
                echo ">$gender_choice[$i]";
                }
                echo "</div>";
            echo "</div>";

    print <<<ENDBLOCK
    <div class="form-group">
                        <label for="DOB" class="col-lg-3 control-label">Date Of Birth</label>
                        <div class="col-lg-5">
                            <input type="text" class="form-control" id="DOB" name="dob" placeholder="MM/DD/YYYY" value="$_POST[dob]" required>
                            <div class="error" id="wrong_DOB" ></div>

                        </div>
                    </div><!--end form-group-->
                    <div class="form-group">
                        <label for="med" class="col-lg-3 control-label">Medical Conditions</label>
                        <div class="col-lg-5">
                            <textarea class="form-control" id="med" name="medical" placeholder="Enter data" value="$_POST[medical]"></textarea> 
                        </div>
                    </div><!--end form-group-->
                    
ENDBLOCK;

$experience_choice = array("Novice","Experienced","Expert");

            echo "<div class='form-group'>";
            echo "<label for='experiance' class='col-lg-3 control-label'>Experience Level</label>";
            echo "<div class='col-lg-5'>";
            foreach($experience_choice as $item) {
                echo "<input type='radio'  id='experiance' name ='experience' value='$item' required";
                if($item == $_POST['experience'])
                    echo " checked='checked'";
                echo ">$item";
                }
                echo "</div>";
            echo "</div>";

$category_choice = array("Teen","Adult","Senior");

            echo "<div class='form-group'>";
            echo "<label for='gender' class='col-lg-3 control-label'>Category</label>";
            echo "<div class='col-lg-5'>";
            foreach($category_choice as $item) {
                echo "<input type='radio' id='category' required name='category' value='$item'";
                if($item == $_POST['category'])
                    echo " checked='checked'";
                echo ">$item";
                }
                echo "</div>";
            echo "</div>";

    print <<<ENDBLOCK
                <div class="form-group">
                    <div class="col-lg-5 col-lg-offset-2">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    </div>
                </form>  
ENDBLOCK;


  print <<<ENDBLOCK
                </div>
        </div><!--end row-->
ENDBLOCK;
echo "<h4 class='errorData'>$msg</h4>";
    }

function process_parameters($params) {
    global $bad_chars;
    $params = array();
    $params[] = trim(str_replace($bad_chars, "",$_FILES["image"]["name"]));
    $params[] = trim(str_replace($bad_chars, "",$_POST['fname']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['mname']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['lname']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['address1']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['address2']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['city']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['state']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['zip']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['phone']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['email']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['gender']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['dob']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['medical']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['experience']));
    $params[] = trim(str_replace($bad_chars, "",$_POST['category']));
    return $params;
    }
    
function store_data_in_db($params) {
    # get a database connection
    $db = get_db_handle();  ## method in helpers.php
    ##############################################################
    $sql = "SELECT * FROM person WHERE ".
    "fname='$params[1]' AND ".
    "mname='$params[2]' AND ".
    "lname='$params[3]' AND ".
    "address1 = '$params[4]' AND ".
    "address2 = '$params[5]' AND ".
    "city = '$params[6]' AND ".
    "state = '$params[7]' AND ".
    "zip = '$params[8]' AND ".
    "phone = '$params[9]' AND ".
    "email = '$params[10]' AND ".
    "dob = '$params[11]' AND ".
    "medical = '$params[12]' AND ".
    "experience = '$params[13]' AND ".
    "category = '$params[14]';";

##echo "The SQL statement is ",$sql;    
    $result = mysqli_query($db, $sql);
    if(mysqli_num_rows($result) > 0) {
        write_form_error_page('This record appears to be a duplicate');
        exit;
        }
/*
if(isset($_FILES['image'])){

$UPLOAD_DIR = 'userimages/';
    $COMPUTER_DIR = '/home/jadrn008/public_html/proj3/userimages/';
    $fname = $_FILES['image']['name'];// . date('Y-m-d H:i:s');

    if(file_exists("$UPLOAD_DIR".$fname))  {
        echo "<b>Error, the file $fname already exists on the server</b><br />\n";
        }
    elseif($_FILES['image']['error'] > 0) {
        $err = $_FILES['image']['error']; 
        $msg .=$err;   
        echo "Error Code: $err ";
    if($err == 1)
        echo "The file was too big to upload, the limit is 2MB<br />";
        } 
    elseif(exif_imagetype($_FILES['image']['tmp_name']) != IMAGETYPE_JPEG) {
        echo "ERROR, not a jpg file<br />";   
        }
## file is valid, copy from /tmp to your directory.        
    else { 
        move_uploaded_file($_FILES['image']['tmp_name'], "$UPLOAD_DIR".$fname);
*/
        $fname = $_FILES['image']['name'];
        $sql = "INSERT INTO person(fname,mname,lname,address1,address2,city,state,zip,phone,email,gender,dob,medical,experience,category,runner_image) ".
    "VALUES('$params[1]','$params[2]','$params[3]','$params[4]','$params[5]','$params[6]','$params[7]','$params[8]','$params[9]','$params[10]','$params[11]','$params[12]','$params[13]','$params[14]','$params[15]','" . $fname ."');";

    ## Note: gender is not pushed in db ,'$params[11]'
##echo "The SQL statement is ",$sql;    
    mysqli_query($db,$sql);
    $how_many = mysqli_affected_rows($db);
    //echo("There were $how_many rows affected");
    close_connector($db);
    /*} 
        // echo "Success";
      }else{
         print_r($errors);
         exit;
      }
      */
   }
?>   