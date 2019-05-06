<?php
//env file
 <Files .env>
        Order allow,deny
        Deny from all
    </Files>

//cron set in cpanel
wget -O /dev/null http://192.249.121.94/~mobile/smart_que_demo/api/notify_queue_start

zip -r fomos.zip fomos*
//paygate url 
http://docs.paygate.co.za/?php#integration-options-2

/*jquery first  latter caipitilize to keyup */
$('input').keyup(function() {
    var str = $(this).val();
    if($(this).attr('name') != 'Email'){
        str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toUpperCase();
        });
         $(this).val(str);
    }
});
/**/
/*document load jquery syntax*/
	 $('body').on('click','.alredy_added',function(){
		 
	 });
/**/
/* data attribute get value*/
	var bid = $(this).attr('bid');
/**/
/*allow only two after point*/
$('#Facilityfees,#Anesthfees,#bundleprice').keyup(function () { 
        var $th = $(this); 
        $th.val($th.val().replace(/(\.[\d]{2})./g,'$1')); 
        
    });
/**/
/*quantity validation allow only 0-10 value*/
    $('.qty').keyup(function(e){       
        var $th = $(this); 
        $th.val($th.val().replace(/[^0-9\.]/g,'')); 
          if ($(this).val() > 10){
              var xStr = $th.val().substring(0, $th.val().length - 1);
            $(this).val(xStr);
           
          }
    });
/**/
// codeinator demo
https://www.phptpoint.com/codeigniter-application-architecture/

/*form submit ajax call with validation*/
  $(document).ready(function() {
	$( "#myform" ).validate({
	  rules: {		
		SpecialtyID: {
		  required: true,
		},
		procedure_name: {
		  required: true,	 
		},
		price: {
		  required: true,
		  number: true,
		  dollarsscents: true

		},
		device_implant: {
		  required: true,
		},
		
	  },
	  submitHandler: function(form) {
        $.ajax({
            url: 'check-facilityspecialty-ajax.php',
            type: 'POST',
           // data: $(form).serialize(),
            success: function(response) {
                //alert(response);
                if(response==1){
                    $("#error_dis").show();
                }
            }            
        });
    }
	});
  });
/**/
/*replace with blank only number allow no char allow*/

$('#mobile').keyup(function () { 
	var $th = $(this); 
	$th.val($th.val().replace(/[^0-9]/g, function (str) { return ''; })); 
});
/**/

/* allow only alphabet*/
$( ".txtOnly" ).keypress(function(e) {
	var key = e.keyCode;
	if (key >= 48 && key <= 57) {
		e.preventDefault();
	}
});
//or
<input name="lorem" onkeyup="this.value=this.value.replace(/[^a-z]/g,'');">
/* end allow only alphabet*/
/**/
/*jquery reset form*/
	$("#frm")[0].reset();
/**/
/*disable buton*/
	$('#excel_download').prop('disabled', true).css('background-color','darkgrey');
	$('#excel_download').prop('disabled', false).css('background-color','#F1C40F');
//before send
beforeSend: function() {
				},
//set time output
setTimeout(function() {
			$('#success_payment_done').show();
			$('html, body').animate({scrollTop: 0}, 1000);
		}, 3000 );	
/**/	
/**/
depends: function(){
                                    return $('#BundledID').val() != '';
                                },
/**/
//jquery validation depend other field value
file: {
	required: true,
	extension: function (element) {
		
			if ($("#type").val() == 'android') {
				return "apk";
			}
			else{
				return "ipa";
			}
		
	},                                

},
//jquery redirect another page
window.location.href = "http://stackoverflow.com";

//jquery msg display based on other field value
message : {
	extension: function (element) {

		if ($("#type").val() == 'android') {
			return "Please upload only apk file.";
		}
		else {
			return "Please upload only ipa file.";
		}

	},
}
/*laravel custome validation*/
'id' => [
                'required',
                Rule::exists('users')->where(function ($query) use($input) {
                    $query->where('role','Restaurant');
                })],
/*jquery validation other field is required */
Expiration: {
	required: function(element){
			return $("#certificate_file").val()!="";
		}
	}
	$rules = array(
            'name' => 'required|max:200',            
            'email' => ['required|email',Rule::exists('users', 'email')
                    ->where(function ($query) {
                    $query->whereNull('deleted_at');
                })],
            
            'password' => 'required|confirmed|min:8',
            'phone' => 'required|min:10|max:13',
            'address' => 'required',
            'user_dept' => 'required',
            'web_access' => 'required',
            'mobile_access' => 'required'
        );
		
		
		 $attribute => [
                Rule::exists($tableName, $columnName)
                    ->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ]
		
		return [
    'email' => Rule::unique('users', 'email')->ignore($user->email)->whereNull('deleted_at')->orWhereNotNull('deleted_at')
	
	'email'     => 'Required|email|unique:users,email,deleted_at,NULL'
]

'email' => [
    'required',
    Rule::unique('users')->ignore($user->id),
    ],
			
//numeric
  rules: {
    field: {
      required: true,
      number: true
    }
  }
 /**/
 

			
 /*string search value*/

if(strstr($queality["SavedValue"],"$,%")){
	$SavedValue=$queality["SavedValue"];
}else{
	$SavedValue=$queality["SavedValue"].'%';
}
//remove value
$string = str_replace(' ', '-', $string);
/**/
/*city state*/
$city =isset($DoctorInfo['City'])?$DoctorInfo['City']:"";
        $state =(isset($DoctorInfo['State']) && $DoctorInfo['State']!="")?', '.$DoctorInfo['State']:"";
/**/
//check file upload or not in php
if(!file_exists($_FILES['myfile']['tmp_name']) || !is_uploaded_file($_FILES['myfile']['tmp_name'])) {
    echo 'No upload';
}
/**/
 /* jquery ajax call syntax*/ 
 
  $('body').on('click','#FilterApply',function(){
	var GeoProximity = $("#GeoProximity").val();
	var Distance = $("#Distance").val();
	var BundleCost = $("#BundleCost").val();
	var SurgeryNeeded = $('input[name=SurgeryNeeded]:checked').val();
	var ProcedureID = $('#ProcedureID').val();
	$.ajax({
		url: "opinions-filter-data.php",
		type: "POST",
		data: {
			ProcedureID: ProcedureID,
			GeoProximity: GeoProximity,
			Distance:Distance,
			BundleCost:BundleCost,
			SurgeryNeeded:SurgeryNeeded
		},
		success: function(data) {	 
		//	alert(data);
		    $("#filterDiv").hide();
            $(".bodyscreen").show();
			$(".bodyscreen").html(data);
		}
	});
});
/**/

/*laravel image upload*/
	$file = $request->file('image');
	if (isset($file) && !empty($file)) 
	{
		$input['image'] = time() . "_" . $file->getClientOriginalName();
		$destinationPath = base_path('upload/member/');
		$file->move($destinationPath, $input['image']);						
	}	
/**/
/*jquery radio button select function*/
	$('input[type=radio][name=SurgeryNeeded]').change(function() {
    if (this.value == 1) {      
       
        $("#slider-range-cost").slider("value", $("#slider-range-cost").slider("option", "min") );
        $( "#BundleCostLabel" ).html( "$" + 0 );
        $( "#BundleCost" ).val(0);
    }
 });
/**/
/*pnotify*/
$("body").on('click', '.delsing', function (event) {
        var t = $(this);
        var id = t.attr("id");
        (new PNotify({title: 'Confirmation Needed', text: 'Are you sure?', icon: 'glyphicon glyphicon-question-sign', hide: false, confirm: {confirm: true}, buttons: {closer: false, sticker: false}, history: {history: false}})).get().on('pnotify.confirm', function () {
            $.ajax({'method': 'delete', 'url': '{{url("client")}}/' + id, 'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'}, 'success': function (data) {
                    if (data.status == 200) {
                        t.parents("tr").fadeOut(function () {
                            $(this).remove();
                            new PNotify({title: 'Success!', text: data.msg, type: 'success', delay: 2000});
                        });
                        $("#example2").DataTable().ajax.reload(null, false);
                    } else {
                        new PNotify({title: 'Oh No!', text: data.msg, type: 'error', delay: 2000});
                    }
                }, "error": function () {
                    PNotify.removeAll();
                    new PNotify({title: 'Oh No!', text: 'Something went wrong.', type: 'error', delay: 2000});
                }});
        }).on('pnotify.cancel', function () {
        });
    });
/*pnotify end*/
/*on change*/
$(document).on('change', 'input', function() {
  
});
/**/
/*logout after some time in surgiconnect admin */

	session_start();
	$time = time();
	$timeout_duration = 3600;
	
	if (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
	   // session_unset();
		unset($_SESSION['LAST_ACTIVITY']); 
		session_destroy();
	   $AdminInfo=false;
	}
	if ($AdminInfo == false) { // redirect to login
	   header('Cache-Control: max-age=0');
	   header('Location: admin-login.php');
	}
	$_SESSION['LAST_ACTIVITY']=time();
	
/*check is session_start()  or not */

	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
/* */ 
/*jquery decimel fixed 2 value*/
amount = parseFloat(amount).toFixed(2);	
/**/

/*laravel update time duplication check*/
'name' => 'required|unique:menus,name'.$id,

//
$arr = array("status"=>400,"msg"=>"Please select facility.","data"=>[]);
echo json_encode($arr);
var json = $.parseJSON(response);
/*google captcha */
	//using php
		1. https://console.developers.google.com/apis/dashboard => create selcret key  & sitekey
		2. <script src='https://www.google.com/recaptcha/api.js'></script> //js include
		3.  <div class="g-recaptcha" data-sitekey="6Ld6k10UAAAAABviXtaWgJ3i4efPESBLVtua2PMV" style="transform:scale(0.77);-webkit-transform:scale(0.88);transform-origin:0 0;-webkit-transform-origin:0 0;"></div> //before submit button
		4. pass parameter to ajax data-sitekey //g-recaptcha-response
		5. 	//submit file
			$recaptchaResponse = $_POST['g-recaptcha-response'];
			$secretKey = "6Ld6k10UAAAAAArEUGG1rOceYQ_Hp_HrsIhmEpuB"; //
			$request = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptchaResponse}");

			if( !strstr($request, "true") ) {
				$ErrorMsg= "Please select captcha.";
			} 
/*google captcha */	
/*page load to default event show hide*/
	$("body").click(function(e){
	if(!$(e.target).closest('.popup').length){
        
    	popupCV.classList.remove("show");
        popup.classList.remove("show");
        popupBio.classList.remove("show");
	}
});
/*tr remove*/
 $('.tr_'+FacilityID).remove();
  $(this).parents('tr').fadeOut();
/**/
//count query 
SELECT COUNT(*) FROM fooTable;
/**/
/*generate random api key */
 http://www.unit-conversion.info/texttools/random-string-generator/
/**/ 

// nappend new row jquery
	var row='<tr><td><select name="status" id="status" class="form-control" required ><option value="">Select Attribute</option>@foreach($attributes as $attribute)<option value="{{$attribute->name}}">{{$attribute->name}}</option>@endforeach</select></td><td><input id="atribute_text" type="text" class="form-control" name="atribute_text" value="" placeholder="Enter Value" required></td><td><button href="#" type="button" id="deleteAtribute" class="btn btn-danger" >X</button></td></tr>';
        
        $("#attributeTable tbody").append(row);
		
// delete row jquery
	$(document).on('click', '.deleteAttribute', function() {
	   $(this).closest('tr').remove();
	});
/**/

	
//////////////////////////////////////////////// laravel //////////////////////////////////////////////////////

/* send mail to signup sucessfully */
	$mailarr['username'] = $member->first_name . ' ' . $member->last_name;
	Mail::send('email.signup', $mailarr, function($message) use($member) {
		$message->to($member->email, $member->firstname)
				->subject('Account created successfully');
	});
/*  */
/*jquery check array value exists or not*/
var isAvailable = gatway_ids.indexOf(gateway_id);
if(isAvailable == -1){
	gatway_ids.push(gateway_id);
}else{
	alert("Already Gateway placed!!");
	return false;
}
/**/
/*delete array value key */
$input = $request->except(['_token','_method','id_for_update'])
/**/

///Flow Step Of Laravel Project

	php artisan make:migration create_our_service_to_body_parts_table --create=our_service_body_parts
	php artisan make:migration create_products_table --create=products

	php artisan make:migration add_amount_to_members

	1. create database : laravel(dbname)
	2. run command : php artisan make:auth
	3. create table throught command : php artisan make:migration create_images_table
	4. open database/migration : xyz_users.php and add field of reuired in this table
	5. run command to create database table automatic : php artisan migrate
	6. run command to create new field in table : php artisan make:migration add_image_to_users
	7. run command to create database table automatic to add new field : php artisan migrate

	//Command:
	composer create-project --prefer-dist laravel/laravel AccountBook "5.5.*"
		
	create new project 		: composer create-project laravel/laravel cronjob
		
	create new model 		: php artisan make:model Member(tablename is MyModel)

	create new controller 	: php artisan make:controller CustomerController --resource-- model=Product(tablename is MyModel)

	clear route : php artisan route:clear

	clear cache : php artisan cache:clear

	php artisan route:list

	php artisan view:clear
	php artisan config:cache
	php artisan route:cache
	php artisan cache:clear 
	
	set http_proxy= 
	set https_proxy=
/**/
//image validation in laravel 

'picture' => 'image|mimes:jpg,png',

//use contants variable
Config::get('constants.ADMIN_TITLE');

//Create Table Of Migration File
	
	Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->text('password');
			$table->rememberToken();
            $table->timestamps();
        });
		
/**/
//local time zone set in database file
date_default_timezone_set('Asia/Kolkata');
//default null remove mysql

		ALTER TABLE users ALTER COLUMN longitude DROP DEFAULT,		
		ALTER TABLE users ALTER COLUMN longitude SET DEFAULT '0';
/**/

// random pass generator 
	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
	$password = substr( str_shuffle( $chars ), 0, 8 );
/**/
/* join in query*/
"SELECT a.ProcedureID,a.`ProcedureName`,CONCAT(pt.FirstName, ' ', pt.LastName)  as PatientName,a.Status  FROM `Procedures` a LEFT JOIN Patients pt ON pt.PatientID = a.`PatientID` WHERE a.PatientID IN (SELECT PatientID FROM Patients WHERE `Email` NOT LIKE '%mailinator%')"

"select up.*,p.name, p.id as pid FROM `users_projects` as up LEFT JOIN projects as p ON p.id IN(up.project_id) ";
select up.*,p.*, p.id as pid FROM `users_projects` as up LEFT JOIN projects as p ON p.id IN(up.project_id)
/**/
//password validation
if(preg_match('/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[$@$!%*#?&])(?=.*[A-Z]).*$/',$_POST['NewPassword']) === 0){
     $error_msg="Password must contain at least one number, one special letter and both uppercase and lowercase letters";
}
/**/
/*laravel LIKE query*/
"SELECT DoctorID,FirstName,LastName,Email,Specialty,Status FROM `Doctors` WHERE  `Email` LIKE '%mailinator%'"

/*laravel not like query*/
"SELECT FacilityID,FacilityName, CONCAT(`City`, ' ', `State`, ' ', `CountryCode`) as Location,Status  FROM `Facilities` WHERE `Email` NOT LIKE 'mailinator'"

//jquery validation to not allow blank space
{
required: true,
normalizer: function (value) { // for blanck space
	return $.trim(value);
},
},
//datatable reload jquery
var table = $('#employee_grid').DataTable();
table.ajax.reload( null, false );
//trim jquery value
	var msg=$('#sendmsg').val();
    $('#sendmsg').val(msg.trim());
	
//drop column 
	Schema::table('articles', function($table) {
             $table->dropColumn('comment_count');
             $table->dropColumn('view_count');
          });
//tiny int 
$table->boolean('is_user_admin')->default(false);  

///Delete Cascade
	$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

//Add Field Set Value As Default 
	$table->string('role')->default('user');
	
//check browser type
	$.browser.chrome
	
//string replacement
	str_replace(".", "", $string);
	
//plus minites
	date("Y-m-d H:i:s",strtotime("+60 minutes"));
	
//add country code if not added
 $len = strlen($num);
    if ($len === 11) {
        if ($num[0] === "0") {
            return "+91" . substr($num, 1);
        } else {
            return $num;
        }
    } else if ($len === 10) {
        return "+91" . $num;
    } else {
        return false;
    }
//datatable  page length total record display
$('#example').dataTable( {
  "pageLength": 50
} );

// laravel enum datatype set
	$table->enum('who_see_location',['everyone', 'friends'])->after('fb_id')->default('friends');
	
// laravel validation required 
	'poll_id'=>"required|exists:poll,id"
	$rules["email"] = 'required|email|unique:members';
	
	//jquery whie space not allowed afer email
	$('#email').keypress(function( e ) {
    if(e.which === 32) 
        return false;
});
?>
<?php 
//scrollup
if(isset($_GET['m']))
{
    echo "<script>

$(document).ready(function () {
    $('html, body').animate({
        scrollTop: $('#chatbox').offset().top
    }, 'slow');
});
</script>";

   
}

/*check-doctor-ajax.php check condition of specialy and already added or not*/

if ($invite_doctors_count ==0 ) {
        if($count_procedure_doctor==0){
           
            if($BundledSpecialtyID==$doctorSpecialtyID){
                $arr = array("status"=>true,"msg"=>"sucess.","data"=>[]);
                  
            }else{
                $arr = array("status"=>false,"msg"=>"Doctor Specialty not match, please add another doctor email.","data"=>[]);
               
            }
        }else{
             $arr = array("status"=>false,"msg"=>"Surgeon already added, Please enter anoher one.","data"=>[]);
           
        }
       
    } 
    else {
         $arr = array("status"=>false,"msg"=>"Surgeon already added, Please enter anoher one.","data"=>[]);
       
    }
	
/**/


$('.product_qty').each(function () { qty = parseInt($(this).val()); sumQty += qty; }); $("#finalTotal").val(sum); $("#finalQty").val('' + sumQty);



/*potrider*/

 //item review             
            $db->join('users', 'users.id = item_review.user_id','LEFT');
            $db->where("item_review.status",'Approve');
            $db->where("item_id", $data['id']);
            $item_reviews = $db->get('item_review');
         
            $item_review_data=$item_review_array =array();
            if(!empty($item_reviews)){
                foreach($item_reviews as $item_review){
                    $item_review_data['rate_star'] = $item_review['rate_star'];
                    $item_review_data['description'] = $item_review['description'];
                    $item_review_data['user_id'] = $item_review['user_id'];
                    $item_review_data['user_name'] = $item_review['fname'].' '.$item_review['fname'];
                    $item_review_data['user_image'] = $item_review['image'];                 
                     $item_review_array[] = $item_review_data;
                }
                
            }
            $data['item_review'] = $item_review_array;
/**/
 /****************************************surgiconnect******************************/

if doctor assign one other all not choose


$getAllBidsDoctors = $db->RunQuery("SELECT DoctorID from Procedure_Doctors WHERE SentTo ='Doctor' AND ProcedureID='.$ProcedureID.' AND Status!='Selected'");
        if(mysql_num_rows($getAllBidsDoctors)>0){
            while ($AllBidsDoctors = mysql_fetch_assoc($getAllBidsDoctors)) {
                $ProcedureInfo11 = $db->UpdateRows('Procedure_Doctors',array('Status'=>'Assigned Not Chosen','BidPlaced'=>'0','SelectdedDate'=>date('Y-m-d')), array('SentTo'=>'Doctor','ProcedureID'=>$ProcedureID,'DoctorID' => $AllBidsDoctors['DoctorID']));
            }
        }
 /****************************************surgiconnect******************************/

                
?>

        
        
        
        
        
        
		