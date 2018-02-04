<?php
/* 
  Assignment 3
  Bhatia, Hitesh
  821439483
 */
    $UPLOAD_DIR = 'userimages/';
    $COMPUTER_DIR = '/home/jadrn008/public_html/userimages/';
    $fname = $_FILES['image']['name'];
    $message = "";

        if(file_exists("$UPLOAD_DIR".$fname))  {
         $message .= "<b>Error, the file $fname already exists on the server</b><br />\n";
        }
    elseif($_FILES['image']['error'] > 0) {
        $err = $_FILES['image']['error'];    
        $message .= "Error Code: $err ";
    if($err == 1)
         $message .= "The file was too big to upload, the limit is 2MB<br />";
        } 
    elseif(exif_imagetype($_FILES['image']['tmp_name']) != IMAGETYPE_JPEG) {
         $message .= "ERROR, not a jpg file<br />";   
        }   
             
    else {
       // move_uploaded_file($_FILES['image']['tmp_name'], "$UPLOAD_DIR".$fname);
        $message = "Success! Your file has been uploaded to the server</br >\n";
    }         
    echo $message;
?>  