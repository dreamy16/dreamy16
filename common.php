<html>
<?php
//job running command : cd pub/projectname
nohup php artisan queue:work,
php artisan queue:work

//git bash
1. git init
2. git add -A
3. git remote add origin "provided bit bucket link"
git remote add origin "https://kaushik-mota-mt@bitbucket.org/manekdilip/fomos-backend.git"
git remote add origin "https://kaushik-mota-mt@bitbucket.org/manekdilip/foody-backend.git"
git remote add origin "https://kaushik-mota-mt@bitbucket.org/manekdilip/release-cloud-backend.git"
4. git commit -m "commit 15-march-19"
5. git push "https://kaushik-mota-mt@bitbucket.org/manekdilip/fomos-backend.git"
git push "https://kaushik-mota-mt@bitbucket.org/manekdilip/release-cloud-backend.git"
6.-> enter password


//allready 
1.git add -A
2.git commit -m "latestcodeupload 15-march-2019"
3.git push "https://kaushik-mota-mt@bitbucket.org/manekdilip/fomos-backend.git"
4.enter password : manektech@112018


//login via git base
ssh mobile@192.249.121.94
ssh ec2-user@13.52.141.72
pToM!j%c1t

cd public_html
cd voice-quickstart-server-php
php -S 192.249.121.94:3000

//gatro live
ssh admin_e_t_back@89.110.148.89
!0Hjgm08

//create zip
zip -r gastro_22.zip gastro *
zip -r fomos.zip fomos*
//18-03

inizio2.vshosting.cz

test_frent.inizio.cz

stK5KsT4HkFN+hrZ

//null replace string
//09-04-2019
function replace_null_with_empty_string($array) {
foreach ($array as $key => $value) 
{
	if(is_array($value))
		$array[$key] = replace_null_with_empty_string($value);
	else {
		if (is_null($value))
			$array[$key] = "";
	}
}
return $array;
}

//delete all file from root folder
$rootPath = "public_html/mobile/projects/test_project11/android/1.0" //inside apk files also delete the 1.0 folder
$rootPath = __DIR__ . "/projects/" . strtolower(str_replace(" ", "_", $projectname))."/".$proj_type."/".$bundle_id;
			if (file_exists($rootPath)) {
				$objects = new RecursiveIteratorIterator(
						new RecursiveDirectoryIterator($rootPath), RecursiveIteratorIterator::SELF_FIRST);
				$directories = array();
				$i = 0;
				foreach ($objects as $name => $object) {
					if (is_file($name)) {
						unlink($name);
					} elseif (is_dir($name)) {
						$directories[$i++] = $name;
					}
				}
				arsort($directories);
				foreach ($directories as $name) {
					rmdir($name);
				}
			}
			rmdir($rootPath);
->with(['reviews' => function($q) {
					$q->select('restaurant_id', DB::raw('sum(rating) AS new_rating'))
					->groupBy('restaurant_id');
				}] ) 
				

dial link demo : https://hotexamples.com/examples/twilio/Twiml/dial/php-twiml-dial-method-examples.html
https://support.twilio.com/hc/en-us/articles/223135027-Configuring-phone-numbers-to-receive-calls-or-SMS-messages

test1234 : 16d7a4fca7442dda3ad93c9a726597e4
		
chown -R ec2-user:{folder/file use} {folder name}
chown -R ec2-user:root /etc/httpd
//
sudo yum remove httpd* php*
//composer create-project laravel/laravel fomos  "5.5.*" --prefer-dist

//find lat long
$address = "4th Floor, Timber Point, Beside Kotak Mahindra Bank, Near Prahaladnagar Garden, Prahaladnagar Road, Ahmedabad, Gujarat 380015";
	 $formattedAddr = str_replace(' ','+',$address);
	//Send request and receive json data by address
	$geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddr.'&sensor=false&key='); 
	$output = json_decode($geocodeFromAddr);
	//Get latitude and longitute from json data
	$data['latitude']  = $output->results[0]->geometry->location->lat; 
	$data['longitude'] = $output->results[0]->geometry->location->lng;
	print_r($data);exit;
	//centos
	- mysql --version
	- php -v
	
//php & apache install in centos
- https://linuxize.com/post/how-to-install-and-secure-phpmyadmin-with-apache-on-centos-7/
	- https://support.rackspace.com/how-to/centos-6-apache-and-php-install/
	//remove apache
	-sudo yum remove httpd* php*
	
	//php install
	 - sudo yum install php php-mysql php-devel php-gd php-pecl-memcache php-pspell php-snmp php-xmlrpc php-xml 
	
	//mysql
	 - 
	
	
// php & apach install aws
https://stackoverflow.com/questions/34873685/how-to-install-php-7-on-ec2-t2-micro-instance-running-amazon-linux-distro
//db user : mysql_secure_installation
//php file extension get
$extension = pathinfo($_FILES['Signature']['name'], PATHINFO_EXTENSION);
//laravel relation empty to remove key field
public function friend() {
	return $this->hasOne('App\Friend', 'friend_request_id', 'id')->withDefault(function ($instance) {
				return new \stdClass;
			});
}
//laravel relation empty array pass
public function post_images() {
	return $this->hasOne('App\PostImage', 'post_id', 'id')->withDefault(function () {
		return new PostImage();
	});
}
//proxy urldecode 192.168.0.75:808

//cron set in cpanel
wget -O /dev/null http://192.249.121.94/~mobile/smart_que_demo/api/notify_queue_start

//socket forever start command
nohup forever start server.js
//socket start
node server.js
//reids
redis-cli monitor

//thirld one salary get
SELECT *
   FROM one one1
   WHERE ( 3 ) = (
		   SELECT COUNT( one2.salary )
		   FROM one one2
		   WHERE one2.salary >= one1.salary
		)
		
		composer require yajra/laravel-datatables-oracle:"~8.0"


//surgiprice 17-04-2019
- facility surgipricee => cases from surgeon => if Anesth Fee  and facility Fee is null and doctor status is Selected in this case display this bid information
- bundled id procedure-incomplete-list api ma apel che

$where .= ' AND split.FeeAnesth IS NULL AND split.FeeFacility IS NULL AND pro_doc.Status <> "Selected"';



$QuestionDetail = DB::table('question_masters AS QM')
			->selectRaw('QM.id,QM.question_name,QOM.id as option_id,QOM.name as option_name')
			->join('question_option_masters as QOM', function($join)
			{
				$join->on('QOM.question_id', '=', 'QM.id')
						->where('QOM.is_delete','=',0);
			})
			->where('QM.is_delete' , '=',0)
			->get();

	$QuestionDetail = $QuestionDetail->toArray(); 
	

	$result = array();
	foreach ($QuestionDetail as $key => $element) {
		$result_data[$element->id]['id'] = $element->id;
		$result_data[$element->id]['question_name']  = $element->question_name;
		$results['option_id'] = $element->option_id;
		$results['option_name'] = $element->option_name;
		
		$result_data[$element->id]['options'][] = $results;
	}
	
	$result_data = array_values($result_data);
	$result['status'] = 200;
	$result['messge'] = "success";
	$result['data'] =  $result_data;
   
	return response()->json($result, $this->successStatus);
	
//lat long query radius in km
$radius = $input['radius'];
$dist = "( 6371 * acos( cos( radians({$userLat}) ) * cos( radians( `lattitude` ) ) * cos( radians( `longitude` ) - radians({$userLng}) ) + sin( radians({$userLat}) ) * sin( radians( `lattitude` ) ) ) ) AS distance";
$user = Message::with('user')->select("*")->selectRaw($dist)->having("distance", "<=", $radius)->get();

$radius = $input['radius']; 
$dist = "( 6371 * acos( cos( radians({$userLat}) ) * cos( radians( `lattitude` ) ) * cos( radians( `longitude` ) - radians({$userLng}) ) + sin( radians({$userLat}) ) * sin( radians( `lattitude` ) ) ) ) AS distance";
$user = Message::with('user')->select("*")->selectRaw($dist)->having("distance", "<=", $radius)->get();

//laravel query print
$query = DB::getQueryLog(); 
print_r($query); exit;
				
//follow-unfollow
https://medium.com/innohub/create-user-following-system-with-laravel-5-4-5fc47828fb39

// codeinator demo
https://www.phptpoint.com/codeigniter-application-architecture/

//passport use in api
https://medium.com/techcompose/create-rest-api-in-laravel-with-authentication-using-passport-133a1678a876
//join query 
SELECT t1.id, t1.email, t2.userid, t2.trialstartdate, t2.trialenddate
FROM tbluser AS t1
LEFT JOIN tblpurchase AS t2 ON t1.id = t2.userid
WHERE t1.email =  'jimdoggin@hotmail.com'

CASE WHEN City IS NULL THEN Country ELSE City END

CASE  WHEN u.image ='' THEN '' ELSE CONCAT("'.USER_UPLOAD_URL.'",u.`image`) END as image_url,


//laravel like query
if (isset($input['searchkey']) && $input['searchkey'] != "") {
				$post->Where('address', 'like', '%' . $input['searchkey'] . '%');
				$post->Where('address_title', 'like', '%' . $input['searchkey'] . '%');
				$post->Where('description', 'like', '%' . $input['searchkey'] . '%');
			}
			
//json array example
[{"metricsID":"89","value":"2"},{"metricsID":"90","value":"2"},{"metricsID":"91","value":"2"}]

//php json
$arr = array("status" => 200, "msg" => "Project delete successfully.", "result" => []);
echo json_encode($arr);

/* Flow Step Of Laravel Project */

php artisan make:migration create_our_service_to_body_parts_table --create = our_service_body_parts
php artisan make:migration create_users_table --create = users

1. create database : laravel(dbname)
2. run command : php artisan make:auth
3. create table throught command : php artisan make:migration create_users_table
4. open database/migration : xyz_users.php and add field of reuired in this table
5. run command to create database table automatic : php artisan migrate
6. run command to create new field in table : php artisan make:migration add_role_to_users
7. run command to create database table automatic to add new field : php artisan migrate

//Command:
composer create-project --prefer-dist laravel/laravel nutone "5.5.*"

create new project : composer create-project laravel/laravel cronjob

create new model : php artisan make:model Blog(tablename is MyModel)

create new controller : php artisan make:controller BlogController --resource--model = Product(tablename is MyModel)

clear route : php artisan route:clear

clear cache : php artisan cache:clear

php artisan route:list

php artisan view:clear
php artisan config:cache
php artisan route:cache
php artisan cache:clear

//config cache route
Route::get('config_cache', function() {
$exitCode = Artisan::call('config:cache');
return 'Config Clear';
});

/**/
addColumn('action', function ($q) {
			return '<a href="poster/' . $q->id . '"  class="btn btn-sm btn-primary" title="Edit"><i class="fa fa-eye" aria-hidden="true"></i></a> <button  class="delsing  btn btn-sm btn-primary" id="' . $q->id . '" title="Delete" ><i class="fa fa-trash" aria-hidden="true"></i></button>';
		})
		
//Create Table Of Migration File

Schema::create('users', function (Blueprint $table) {
	$table->increments('id');
	$table->string('name');
	$table->string('email');
	$table->text('password');
	$table->decimal('price', 5, 2);
	$table->integer('technologies_id')->unsigned();
	$table->foreign('technologies_id')->references('id')->on('technologies')->onDelete('cascade');
	$table->enum('status', ['Active', 'Inactive', 'Delete'])->default('Active');
	$table->string('status')->default('1');
	$table->string('status')->nullable();
	$table->rememberToken();
	$table->timestamps();
	$table->boolean('is_user_admin')->default(false);
});

//doctrine install
https://laraveldoctrine.org/docs/current/orm/installation
//Create New Field Of Migration File

Schema::table('users', function($table) {
	$table->string('status')->after('password');
});
/* end flow */

//send mail

/* send mail to signup sucessfully */
$mailarr['username'] = $member->first_name . ' ' . $member->last_name;
Mail::send('email.signup', $mailarr, function($message) use($member) {
	$message->to($member->email, $member->firstname)
			->subject('Account created successfully');
});
MAIL_DRIVER = smtp
MAIL_HOST = smtp.gmail.com
MAIL_PORT = 465
MAIL_USERNAME = testineed@gmail.com
MAIL_PASSWORD = manek@tech
MAIL_ENCRYPTION = ssl
/* send mail to signup sucessfully */


->with(['message_likes' => function($query) use ($user_id) {
										$query->selectRaw('count(*) AS msg_like_count');
										$query->where('type', 'like');
										$query->where('user_id', $user_id);
									}])

//
$data = DB::table('users as a')->leftjoin('friends as b','a.id','b.user_id')->where([['a.status','active'],['b.friend_request_id',$userid],['a.user_type','normal'],['a.id','<>',$input['user_id']]])
			  ->whereIn('a.id', $friend_ids)->select('a.*','a.id as user_id','b.id as id')->get(); */
			  
//left join laravel
Message::leftJoin('user_likes', function($q) {
  $q->on('user_messages.id', '=', 'user_likes.msg_id');
  $q->on('user_messages.user_id', '=', 'user_likes.user_id');
})->
/*multiple record insert*/	
$items = $input["items"];
$extra = json_decode($items, true);
$extra_item_data = $item_data = [];
foreach ($extra as $item) {
	if (!empty($item)) {
		$item_data[] = ['item_id' => $item['item_id']];
		$extra_items = $item["extra_item"];
		foreach ($extra_items as $extra_item) {
			$extra_item_data[] = ['item_id' => $item['item_id'], 'extra_item_id' => $extra_item['extra_item_id'], 'qty' => $extra_item['qty']];
		}
	}
}
//
$rules = array(
		'import' => 'required',
		'ext' => 'in:csv,xls',
		'column_len' => 'min:9',
		'excel_column_len' => 'min:10',
	);
//fb image upload
$image = (isset($input['image'])) ? trim($input['image']) : "";
if ($image) {
	$imgname = 'users/' . time() . rand(1, 50) . '.jpg'; //this name store in table
	\Storage::disk('public')->put($imgname, file_get_contents($image));
	$noimage = url('/public/storage/' . $imgname);
	list($width, $height) = getimagesize($noimage);
}
					
// validation if not empty value
 'display_order'=>'nullable | integer |min:0',
//order model 
public function order_items() {
	return $this->hasMany('App\OrderItem','order_id', 'id');
}
public function order_extra_items() {
	return $this->hasMany('App\OrderExtraItem','order_id', 'id');
}
//extra order item model
public function order() {
	return $this->belongsTo('App\Order','order_id','id');
}
//order item model
public function order() {
	return $this->belongsTo('App\Order','order_id','id');
}
/* check char exist in string or not*/
$haystack = "foo bar baz";
$needle   = "bar";

if( strpos( $haystack, $needle ) !== false) {
	echo "\"bar\" exists in the haystack variable";
}
/*end check*/
/*multiple record insert*/

		
		  //add order item
		  $items = json_decode($input["items"], true);
		  if (count($items) > 0) {
		  foreach ($items as $item) :
		  if (isset($item) && $item != "") {
		  $qty = isset($item['qty']) ? $item['qty'] : 0;
		  $orderItem = OrderItem::create([
		  'order_id' => $order_id,
		  'item_id' => $item['item_id'],
		  'qty' => $qty,
		  ]);
		  $order_item_id = $orderItem->id;

		  //extra item added
		  $extra_items = json_decode($item["extra_item"], true);
		  foreach ($extra_items as $extra_item) :
		  if (isset($extra_item) && $extra_item != "") {
		  $orderItem = OrderExtraItem::create([
		  'order_id' => $order_id,
		  'item_id' => $item['item_id'],
		  'extra_item_id' => $extra_item['extra_item_id'],
		  'qty' => $extra_item['qty'],
		  ]);
		  }
		  endforeach;
		  }
		  endforeach; 

//image upload       
$file = $request->file('image');
if (isset($file) && !empty($file)) {
	$input['image'] = time() . "_" . $file->getClientOriginalName();
	$destinationPath = base_path('upload/member/');
	$file->move($destinationPath, $input['image']);
}

//apikey generate : http://www.unit-conversion.info/texttools/random-string-generator/
//delete array value key laravel
$input = $request->except(['_token', '_method', 'id_for_update'])

//php migratiom alter table
php artisan make:migration add_votes_to_users_table --table=users

//laravel version project
composer create-project laravel/laravel blog  "5.4.*" --prefer-dist

//random pass generator
$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
$password = substr(str_shuffle($chars), 0, 8);

//with relationship function
$loan = Loan::with(array('borrower' => function($q) {
				$q->select('id', 'name', 'surname', 'created_at');
			}))->where('expire_time', '>=', $date)->where('status', 'Pending');
			
//drop column 
Schema::table('articles', function($table) {
$table->dropColumn('comment_count');
$table->dropColumn('view_count');
});

//check is session_start()  or not */

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

//laravel update time duplication check*/
'name' => 'required|unique:menus,name,'.$id,

//return redirect back
<a href = "{{URL::previous()}}" class = "btn btn-warning">Back</a>

//laravel custome validation
'id' => [
'required',
Rule::exists('users')->where(function ($query) use($input) {
	$query->where('role','Restaurant');
})],
//laravel validation	
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
	
//where null
email' => Rule::unique('users', 'email')->ignore($user->email)->whereNull('deleted_at)->orWhereNotNull('deleted_at')

email     => 'Required|email|unique:users,email,deleted_at,NULL'

//Add Field Set Value As Default 
$table->string('role')->default('user'); 

//replace string
str_replace(".", "", $string);

//
ALTER TABLE restaurants CONVERT TO CHARACTER SET utf8 COLLATE utf8mb4_unicode_ci;
ALTER TABLE restaurants CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
//string search value
if(strstr($queality["SavedValue"],"$,%")){
$SavedValue=$queality["SavedValue"];
}else{
$SavedValue=$queality["SavedValue"].'%';
}
//use contants variable
Config::get('constants.ADMIN_TITLE');

//today get 
use Carbon\Carbon;
$today_posts = Post::where('status' , 'Active')->whereDate('created_at',Carbon::today())->count();

//remove value
$string = str_replace(' ', '-', $string);

//check file upload or not in php
if(!file_exists($_FILES['myfile']['tmp_name']) || !is_uploaded_file($_FILES['myfile']['tmp_name'])) {
echo 'No upload';
}

//not in where condition
$data = AskForProm::with('users')->where(['student_id' => $userid])->NotIn('status', [1, 2])->get();

//or where condition
$data = AskForProm::with('users')->where(['student_id' => $userid])->Where('status', '!=', '1')->orWhere('status', '!=', '2')->get();

//get random value from given array
$ratting = array(1, 3, 5, 7, 10);
$k = array_rand($ratting);
return $ratting[$k];

//where row query
$data->whereRaw("UNIX_TIMESTAMP(appointment_date)>='".$start_date."' AND UNIX_TIMESTAMP(appointment_date)<='".$end_date."'");
$data->whereRaw("expire_time<='".$date."' AND status='Pending");

//pluck query
$user_ids = \DB::table('users')->whereIn('users.id', $userdata)->where('users.school_id', $user->school_id)->where(function($q) {
$q->where('is_approve', '!=', 1);
$q->orWhere('ticket_approve', '!=', 1);
})->pluck('users.id');

//one row updated
User::whereIn('id', explode(",", $ids))->update(['status' => $types]);

//Return View File 
$users = User::paginate(3);
return view('admin.user.userlist', compact('users')); //(admin.user.userlist=>is blade file path)

//plus minites
date("Y-m-d H:i:s", strtotime("+60 minutes"))

//Return Redirect Using Route
return redirect('admin/users')

//Return Redirect Using Route with sucess Msg	
return redirect('admin/users')->with('success', 'User has been updated');

//check phone number with code
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

//Get Last Inserted Id from Table 
$id = DB::table('users')->insertGetId(
['email' => 'ajay.agrahari09@gmail.com', 'name' => 'Ajay Gupta']
);
Or
$id = User::insertGetId(['email' => 'sonal@gmail.com', 'name' => 'sonal']);
//Get user id to any detail 
$old_image = Product::where('id', $id)->first()->image;

//required  validation
'poll_id' => "required|exists:poll,id"
$rules["email"] = 'required|email|unique:members';

//multiple image upload
if ($gallery = $request->file('images')) {
foreach ($gallery as $gal) {
$name = time() . '.' . $gal->getClientOriginalName();
$destinationPath1 = public_path('storage/user_gallery');
$gal->move($destinationPath1, $name);

$images = Image::create([
'images' => $name,
]);

$user->images()->attach($images);
}
}

//follower
$user = User::find(1);
$user->followers()->attach(1);
$user->followers()->detach(1);
$followers = $user->followers;
$followings = $user->followings;
$data = User::with('followers')->first();

//add new object to array
if(!empty($ticket_data))
{
$ticket_data = json_decode(json_encode($ticket_data), 1);
foreach ($ticket_data as $key => $datas) {

$TicketStudentCount = TicketStudent::where('ticket_id', $datas['ticket_id'])->count();
$TicketMemberCount = TicketMember::where('ticket_id', $datas['ticket_id'])->count();
$member_count = $TicketStudentCount+$TicketMemberCount;
$ticket_data[$key]['member_count'] = $member_count;
}
}
//time calculate
SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(call_time))) FROM user_calls
$call_time = DB::select("SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(call_time))) as total_time FROM user_calls");
//count 
$ticket_member_count = TicketMember::where(['ticket_id' => $ticket_id])->count();
$student_count = TicketStudent::where(['ticket_id' => $ticket_id])->count();
$member_count = $ticket_member_count+$student_count;

//join query laravel
$userdata = \DB::table('users')
->join('teacher_details', 'teacher_details.user_id', 'users.id')
->leftjoin('student_details', 'teacher_details.class', 'student_details.class_of')
->where(['users.school_id' => $user->school_id])
->pluck('student_details.user_id');

$ticket_data = \DB::table('swag_bags')->where('user_id', $user_id)
->join('swag_bag_student', 'swag_bag_student.swag_bag_id', 'swag_bags.id')
->select(['swag_bags.id as swag_bags', 'swag_bags.*', 'swag_bag_student.*'])
->get();

//Multiple file validation
images.*'=>'required|image|mimes:jpeg, png, jpg, gif|max:2048';
'godown_name.*' => 'required',

// write msg
<span class="error_msg">{{$errors->first('godown_name.*')}}</span>
//validation time set old value in multiple value(Array) 
value="{{old('godown_name.0')}}"

//image delete code
if(file_exists(base_path('upload/poll/'.$image_name))) {
unlink(base_path('upload/poll/'.$image_name));
}

//encode decode id
$user_task_id = base64_encode($user_task_id);
$user_task_id = base64_decode($user_task_id);

//check for ajax and method from request
if ($this->request->ajax())
if ($this->request->isMethod('post'))

//if condition for checking auth
@if(Auth::check() && Auth::user()->role == "admin")
@endif

//Add google captcha in core php
<script src='https://www.google.com/recaptcha/api.js'></script>
//designing div 
<div class="g-recaptcha" data-sitekey="6LfhRVwUAAAAAIAKdoNA9ledVF0kBPmh-DJ7WIcv"></div>
//key
SITEKEY = 6LfhRVwUAAAAAIAKdoNA9ledVF0kBPmh-DJ7WIcv
SECRKEY = 6LfhRVwUAAAAAMPuumfbJsLDGFbFFDxZSycsHGUk
//php code
if( isset($_POST['contact_submit']) && !empty($_POST['contact_submit'] ) ){

	$userIP = $_SERVER["REMOTE_ADDR"];
	$recaptchaResponse = $_POST['g-recaptcha-response'];
	$secretKey = "6Lf-ARwUAAAAAHGjZwTkJr0px04zj0qQW-Wdw4oH";
	$request = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secretKey}&response={$recaptchaResponse}&remoteip={$userIP}");
	if( !strstr($request, "true") ) {
	header("Location: ".$navUrl."contact-us?sent=2");
	} else {
	}
}
//get current month start date
dd( date('Y-m-01'));

//put value in session in blade file
Session::put('some key','some value');

//get session value in controller
$data = Session::get('some key');

//Add ckediter in blade file
<textarea id="description" class="form-control ckeditor" name="description" placeholder="Enter description"></textarea>
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>

//File validation
<input type="file" multiple class="form-control" name="path[]" accept="jpeg,jpg,png" id="path" />

//Date and time zone format
date_default_timezone_set('Asia/Calcutta');
$date = date("Y/m/d h:i:sa");

//How to get current route name in Laravel
return \Route::currentRouteName();

//How to get current route name in Laravel
return \Route::currentRouteName();

//How to get current route action in Laravel
return \Route::getCurrentRoute()->getActionName();

//mobile number validation with max 10 digits using html
<input type="number" onKeyPress="if(this.value.length==10) return false;" />

//check in empty array in input request
$units = $request->input('unit_name', []);

//whereIn condition
$ids = $request->ids;
$delete_user = User::whereIn('id', explode(",", $ids));

//Pass session value with redirect page
return redirect()->back()->with('send_mail', 'invoice send'); 

//If condition with session value
@if (Session::has('send_mail'))@endif

//surgi patient login
Test@1234 : 94cf4cc744baa626a3e32064d79e091c

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

sonal.ramdatti
192.168.0.3
sonal162

/**********************       mysql               *************************/

//like not null
SELECT * FROM `users` WHERE `email` LIKE '%mailinator%' AND `fb_id` IS NOT NULL

//count query 
SELECT COUNT(*) FROM fooTable;

//default null remove  mysql query
ALTER TABLE users ALTER COLUMN longitude DROP DEFAULT,
ALTER TABLE users ALTER COLUMN longitude SET DEFAULT '0';

//alter innodb table
ALTER TABLE parent_table ENGINE = InnoDB;

//join query
SELECT c.*, u.firstname, u.lastname, g.name as group_name, p1.alert_type, p1.latitude, p1.longitude, p1.battery, p1.rssi, p1.date, p1.time, p1.mac_address, p1.distance, p1.staff_id as staffuseid FROM tag c LEFT JOIN tag_location p1 ON p1.tag_id = c.id AND p1.id = ( SELECT MAX(id) FROM tag_location tl WHERE tl.tag_id = c.id ) LEFT JOIN users u on u.id = p1.staff_id LEFT JOIN groups g on g.id = c.group_name WHERE 1

/**********************       mysql               *************************/
///array convert
que:-
array:6 [â–¼
0 => array:5 [â–¶]
1 => array:5 [â–¶]
2 => array:5 [â–¶]
3 => array:5 [â–¶]
4 => array:5 [â–¶]
5 => array:5 [â–¶]
]

logic :- function make_my_content($db_array)
{
$return_array = array();
foreach($db_array as $key => $value){
if(array_key_exists($value['key'], $return_array)){
if(is_array($return_array[$value['key']])){
$return_array[$value['key']][] = $value['value'];
}else{
$temp = $return_array[$value['key']];
$return_array[$value['key']] = array();
$return_array[$value['key']][] = $temp;
$return_array[$value['key']][] = $value['value'];
}
}else{
$return_array[$value['key']] = $value['value'];
}
}
return $return_array;
}
output : array:6 [â–¼
"title" => "COSTECTOMY"
"phone" => "+123 4567 891 555"
"detail" => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient  â–¶"
"email" => "help@costectomy.com"
"address" => "2538 Cambridge Drive Glendale, AZ 85301"
"image" => "http://192.168.0.138:8000/upload/cms/contact_usbanner.jpg"
]

//
$('.custom-timepicker').timepicker({
	use24hours: true,
	timeFormat:'H:i:s',
	ampm: true,
	defaultTime: ''
});

//emergency_call twillio call details
//final details
ACCOUNT_SID = ACa7d543ded8d963a5481208fb199cf8e5
api_key_secret : NvfqSjYnwgUIBiAZ92IoloP3ZJQ9yIaQ
app_sid = SK9365d1881b3f1ccdf1535249aae42600
API_KEY = voicecall
Url = http://192.249.121.94/~mobile/emergency_call/api/v1/call
?>
</html>
<script>
//jquery json 
var data = JSON.parse(result);

//reset form
$("#frm")[0].reset();

//reset dropdown menu 
$('select').prop('selectedIndex', 0);

//trim jquery 
var msg = $('#sendmsg').val();
$('#sendmsg').val(msg.trim());

//set to decimal point if not exist
$('input#price').on('blur', function () {
	var price = $(this).val();
	$('#prices').val($(this).val());
	if (price != '') {

		const value = this.value.replace(/,/g, '');
		this.value = parseFloat(value).toLocaleString('en-US', {
			style: 'decimal',
			maximumFractionDigits: 2,
			minimumFractionDigits: 2
		});
		$('#myform').valid(); //form validate callback
	}

});

//check browser type
$.browser.chrome

//attribute value get
var post_id = $(this).attr("data-id");

//url juery
'url':'{{url("user")}}/'+id,

//append new row jquery
var row = '<tr><td><select name="status" id="status" class="form-control" required ><option value="">Select Attribute</option>@foreach($attributes as $attribute)<option value="{{$attribute->name}}">{{$attribute->name}}</option>@endforeach</select></td><td><input id="atribute_text" type="text" class="form-control" name="atribute_text" value="Enter Value" required></td><td><button href="#" type="button" id="deleteAtribute" class="btn btn-danger" >X</button></td></tr>';

$("#attributeTable tbody").append(row);

//append new row jquery


//delete row jquery
$(document).on('click', '.deleteAttribute', function() {
$(this).closest('tr').remove();
});

//disable true/false
$(t).prop('disabled', true);
$(t).prop('disabled', false)

//disable buton
$('#excel_download').prop('disabled', true).css('background-color', 'darkgrey');
$('#excel_download').prop('disabled', false).css('background-color', '#F1C40F');

//before send
beforeSend: function() {
},

//set time output
setTimeout(function() {
$('#success_payment_done').show();
$('html, body').animate({scrollTop: 0}, 1000);
}, 3000 );

//hover function
$(".position_text").hover(function(){
var position = $(this).position();
console.log(position.top - $(window).scrollTop());

//alert($(window).scrollTop());
if ($(window).scrollTop() < 114){
$('.position_text').tooltip();
}
}, function(){
$(".position_text").tooltip({ placement: 'bottom' });
});

//Remove inline style using jquery 
$('this').removeAttr("style");

//required if other field empty in jquery validation
MobilePhoneCode: {
	required: function (element) {
		return $("#MobilePhone").val() != "";
	}
}

//url validation

uploaded_file :{
				 required: true,
				  extension: "jpg|jpeg|png|PNG|JPG|JPEG",
				  url: true,
				
			},
			
//first latter capital of sentance  
$('.firstltr').keyup(function(e) {
	$(this).val($(this).val().slice(0, 1).toUpperCase() + $(this).val().slice(1));
});

//desc and asc datatable remove
bSort: false, //add this in datatable script

//datepicker set
$('#datepicker').datepicker({
format: 'yyyy-mm-dd',
autoclose: true
})

//Disable future dates after today in Jquery Ui Datepicker
$(function() {
$( "#datepicker" ).datepicker({  maxDate: new Date() });
});

//Enable between start to end date using j query : http://jsfiddle.net/X82aC/544/

//Jquery has class declaration
$('div:has(strong)');

//
var loanVal = [];
i = 0;
$('.loan').each(function()
{       
	loanVal[i++] = $(this).val();
	//I should store id in an array
});

//jquery first  latter caipitilize to keyup 
$('input').keyup(function() {
var str = $(this).val();
if($(this).attr('name') != 'Email'){
	str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
		return letter.toUpperCase();
	});
	 $(this).val(str);
}
});

//document load jquery syntax
$('body').on('click','.alredy_added',function(){

});

//allow only two after point
$('#Facilityfees,#Anesthfees,#bundleprice').keyup(function () { 
	var $th = $(this); 
	$th.val($th.val().replace(/(\.[\d]{2})./g,'$1')); 
	
});
//quantity validation allow only 0-10 value
$('.qty').keyup(function(e){       
var $th = $(this); 
$th.val($th.val().replace(/[^0-9\.]/g,'')); 
  if ($(this).val() > 10){
	  var xStr = $th.val().substring(0, $th.val().length - 1);
	$(this).val(xStr);
   
  }
});	

//form submit ajax call with validation
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

//replace with blank only number allow no char allow
$('#mobile').keyup(function () { 
var $th = $(this); 
$th.val($th.val().replace(/[^0-9]/g, function (str) { return ''; })); 
});

// allow only alphabet
$( ".txtOnly" ).keypress(function(e) {
var key = e.keyCode;
if (key >= 48 && key <= 57) {
	e.preventDefault();
}
});

//jquery validation depend other field valu
depends: function(){
return $('#BundledID').val() != '';
}

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

//jquery validation other field is required 
Expiration: {
required: function(element){
		return $("#certificate_file").val()!="";
	}
}

//jquery ajax call syntax 

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

//jquery radio button select function*/
$('input[type=radio][name=SurgeryNeeded]').change(function() {
if (this.value == 1) {      
   
	$("#slider-range-cost").slider("value", $("#slider-range-cost").slider("option", "min") );
	$( "#BundleCostLabel" ).html( "$" + 0 );
	$( "#BundleCost" ).val(0);
}
});

//pnotify*/
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

//on change*/
$(document).on('change', 'input', function() {

});

//jquery decimel fixed 2 value*/
amount = parseFloat(amount).toFixed(2);	

//tr remove
$('.tr_'+FacilityID).remove();
$(this).parents('tr').fadeOut();

//page load to default event show hide*/
$("body").click(function(e){
if(!$(e.target).closest('.popup').length){
	
	popupCV.classList.remove("show");
	popup.classList.remove("show");
	popupBio.classList.remove("show");
}
});

/*jquery check array value exists or not*/
var isAvailable = gatway_ids.indexOf(gateway_id);
if(isAvailable == -1){
gatway_ids.push(gateway_id);
}else{
alert("Already Gateway placed!!");
return false;
}

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

//json array 
<?php
$arr =  array("status"=>400,"msg"=>"Please select facility.","data"=>[]);
echo json_encode($arr);
?>
var json = $.parseJSON(response);
CKEDITOR.replace( 'easy_navigation_feature_section_content' );
</script>