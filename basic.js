// 
// 	Assignment 3
// 	Bhatia, Hitesh
// 	821439483
//  
$(document).ready(function(){
document.getElementById("city").onkeypress = function(event){
	 return alphabetsonly(event);
};

document.getElementById("zipcode").onkeypress = function(event){
	 return numbersonly(event);
};

document.getElementById("phone").onkeypress = function(event){
	 return numbersonly(event);
};

/*
document.getElementById("myForm").onsubmit = function(event){

	 return checkform(event);
};*/
	
$('input[name="fname"]').focus();		

$(':submit').on('click', function(e) {
        e.preventDefault();
        if(checkform(e))
        {
        	var params = "email="+$('#email_id').val();
        	var url = "check_dup.php?"+params;
        	//$.get(url, dup_handler);	
        	$.ajax( {
            url: url,
            type: "get",
            processData: false,
            contentType: false,
            success: function(response) {
	       if(response === "dup")
        $('#dup_email').text("Email id already registered");
    else if(response === "OK") {
    	$('#dup_email').text("");
        //$('form').serialize();
        //$('form').submit();
        send_file();
        }
	    },
            error: function(response) {
              imgStatus = "Sorry, an erro occured";
			  $('#status').text(imgStatus);
				}
            });
        }
        });
});

function dup_handler(response) {
    if(response === "dup")
        $('#dup_email').text("Email id already registered");
    else if(response === "OK") {
    	$('#dup_email').text("");
        //$('form').serialize();
        //$('form').submit();
        send_file();
        }        
    }

function send_file() {    
        var form_data = new FormData($('form')[0]);
         
        form_data.append("image",document.getElementById("image").files[0]);
        var toDisplay = '<img src="http://jadran.sdsu.edu/~jadrn008/proj3/images/busywait.gif" width="30px"/>';               
		$('#pict').show();       
	   $('#pict').html(toDisplay);
	
		$.ajax( {
            url: "file_upload.php",
            type: "post",
            data: form_data,
            processData: false,
            contentType: false,
            success: function(response) {
	       if(response.startsWith("Success")) 
				{
				imgStatus = "OK";
				$('#pict').hide();       
				$('form').serialize();
				$('form').submit();
				}
	       else {
				imgStatus = response;
				$('#status').text(imgStatus);
                }
	    },
            error: function(response) {
              imgStatus = "Sorry, an upload error occurred, 2MB maximum size";
			  $('#status').text(imgStatus);
         
				
				}
            });
        }

function numbersonly(e) {
    var unicode = e.charCode ? e.charCode : e.keyCode
    if (unicode != 8) { //if the key isn't the backspace key (which we should allow)
        if (unicode < 48 || unicode > 57) //if not a number
            return false //disable key press
    }
}

function alphabetsonly(e) {
    var unicode = e.charCode ? e.charCode : e.keyCode
    if (unicode != 8) { //if the key isn't the backspace key (which we should allow)
        if ((unicode < 65 || unicode > 90) && (unicode < 97 || unicode > 122) && unicode!=32) //if not a number
            return false //disable key press
    }
}

function checkTextField(field) {
	if (field.value === " "||field.value === "") {
        return true;
    }
}

function checkform()
{
	var flag=true;
	var email_reg=(/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}/i);
	var form = document.getElementById('myForm');
	var email=document.getElementById("email_id").value;
	var date_of_birth=document.getElementById("DOB").value;
	var n = form.phone.value.indexOf("-");
		if(n===-1)
		{
			if(form.phone.value.length===10)
			{
			document.getElementById("wrong_phone").innerHTML ="";
			}
			else if(form.phone.value.length!==12)
			{
				document.getElementById("wrong_phone").innerHTML ="Phone number is not valid";
				flag=false;
			}
		}
	
	
	if(email_reg.test(email))
	{
		document.getElementById("wrong_email").innerHTML ="";
	}
	else
	{
		document.getElementById("wrong_email").innerHTML ="Email id not valid";
		flag=false;
	}
	if(date_of_birth!=="")
	{
		var dob = new Date(form.DOB.value);
		var ageDifMs = Date.now() - dob.getTime();
    	var ageDate = new Date(ageDifMs); // miliseconds from epoch
    	var age= Math.abs(ageDate.getUTCFullYear() - 1970);
		
		if((age>95||age<8)||(dob>Date.now()))
		{
			flag=false;
			document.getElementById("wrong_DOB").innerHTML ="Runners must be of Age 8 to 95";
		}
		else
		{
			document.getElementById("wrong_DOB").innerHTML ="";
		}
	}
	if(checkTextField(form.fname))
	{
		document.getElementById("fname_space").innerHTML ="Please Enter First Name";
		flag=false;
	}
	else{
		document.getElementById("fname_space").innerHTML ="";

	}
	if(checkTextField(form.lname))
	{
		document.getElementById("lname_space").innerHTML ="Please Enter Last Name";
		flag=false;
	}
	else
	{
		document.getElementById("lname_space").innerHTML ="";

	}
	if(checkTextField(form.address1))
	{
		document.getElementById("address1_space").innerHTML ="Please Enter Address";
		flag=false;
	}
	else
	{
		document.getElementById("address1_space").innerHTML ="";
	}
	if(checkTextField(form.city))
	{
		document.getElementById("city_space").innerHTML ="Please Enter City";
		flag=false;
	}
	else{
		document.getElementById("city_space").innerHTML ="";
	}
        //get the file size and file type from file input field
        var fsize = form.image.files[0].size;

        if(fsize>1048576) //do something if file size more than 1 mb (1048576)
        {
			document.getElementById("proper_image").innerHTML ="Select photo of size less than 1MB";
            flag=false;
        }else{
			document.getElementById("proper_image").innerHTML ="";
        }
       // alert(flag);
	return flag;
}

/*
function formatNumber(field) {
    if (field.value.length == 3||field.value.length == 7) {
        field.value+='-';
    }
}
*/

$(function(){
    $( "#DOB" ).datepicker({ minDate: -35040, maxDate: 0 });
    $( "#DOB" ).datepicker("option", "dateFormat","mm/dd/yy");


    var $jqDate = jQuery('input[name="DOB"]');

//Bind keyup/keydown to the input
$jqDate.bind('keyup','keydown', function(e){
	
  //To accomdate for backspacing, we detect which key was pressed - if backspace, do nothing:
	if(e.which !== 8) {	
		var numChars = $jqDate.val().length;
		if(numChars === 2 || numChars === 5){
			var thisVal = $jqDate.val();
			thisVal += '/';
			$jqDate.val(thisVal);
			}
  		}
	});
});