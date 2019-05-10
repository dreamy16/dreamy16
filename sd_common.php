<?php 
//laravel version project create
	- composer create-project laravel/laravel blog  "5.4.*" --prefer-dist
	
//specified key was to long error issue solve
	- app\Providers : 
		use Illuminate\Support\Facades\Schema;
		public function boot()
		{
			Schema::defaultStringLength(191);
		}
//passport install
	- https://medium.com/techcompose/create-rest-api-in-laravel-with-authentication-using-passport-133a1678a876
	- composer require laravel/passport=~4.0
	
//create controller in specific folder
	- php artisan make:controller API/APIV1Controller
	
//reset password link send in mail
	/*in conroller code*/
	use App\Notifications\MailResetPasswordToken;
	$remember_token = str_random(60);
	$user->notify(new MailResetPasswordToken($remember_token));

	DB::table('password_resets')->where('email', $input['email'])->delete();
	DB::table('password_resets')->insert([
		'email' => $input['email'],
		'token' => Hash::make($remember_token), //change 60 to any length you want
		'created_at' => Carbon::now()
	]);
	/*create folder inside App folder*/
	put file path : App/Notifications/MailResetPasswordToken.php
	//inside this file code
	namespace App\Notifications;
	use Illuminate\Bus\Queueable;
	use Illuminate\Notifications\Notification;
	use Illuminate\Contracts\Queue\ShouldQueue;
	use Illuminate\Notifications\Messages\MailMessage;
	class MailResetPasswordToken extends Notification
	{
		use Queueable;
		protected $token;
		/**
		 * Create a new notification instance.
		 *
		 * @return void
		 */
		public function __construct($token)
		{
			$this->token = $token;
		}
		/**
		 * Get the notification's delivery channels.
		 *
		 * @param  mixed  $notifiable
		 * @return array
		 */
		public function via($notifiable)
		{
			return ['mail'];
		}
		/**
		 * Get the mail representation of the notification.
		 *
		 * @param  mixed  $notifiable
		 * @return \Illuminate\Notifications\Messages\MailMessage
		 */
		public function toMail($notifiable)
		{
			return (new MailMessage)
						->subject("Reset Password Notification")
						->line("You are receiving this email because we received a password reset request for your account.")
						->action('Reset Password', url('password/reset', $this->token))
						->line('If you did not request a password reset, no further action is required.');

		}
		/**
		 * Get the array representation of the notification.
		 *
		 * @param  mixed  $notifiable
		 * @return array
		 */
		public function toArray($notifiable)
		{
			return [
				//
			];
		}
	}
//end reset password link send in mail code
//put this code in auth/ResetPasswordController to when user can reset password to not redirect login
protected function resetPassword($user, $password) {
        Auth::logout();
        Session::flush();
    }
/*end reset password link send in mail*/
/*send notification code*/
	$user = User::find($user_id);
	$title = $user->display_name . ' ' . $type . ' your post idea: ' . $post->description . '.';
	$noti_data["title"] = $title;
	$noti_data["userids"] = array($post->user_id);
	$noti_data["body"] = "";
	$noti_data["extra"] = [];
	send_notification($noti_data);
	function send_notification($arr) {

		$userIds = "";
		if (isset($arr["userids"][0]) && is_array($arr["userids"][0])) {
			$userIds = array_reduce($arr["userids"][0], 'array_merge', array());
		} else if (isset($arr["userids"])) {
			$userIds = $arr["userids"];
		}

		if (!empty($userIds)) {
			$push = new PushNotification('fcm');       
			for ($i = 0; $i < count($userIds); $i++) {
				/** for on last updated token */
				$tokens = UserDevice::where('user_id', $userIds[$i])->select('device_type', 'firebase_token')->orderBy("id", "desc")->first();

				$temp = [];
				if (!empty($tokens)) {
					$temp[$tokens->device_type][] = $tokens->firebase_token;
				}
				/** for last updated token */
				/** for all token */
				if (isset($temp["Android"]) && count($temp["Android"]) > 0) {
					$push->setMessage([
					'notification' => [
						'title'=>$arr["title"],
						'body'=>$arr["body"],
						'sound' => 'default'
					],
					//'data' => $arr["extra"]
					])
					->setApiKey(config('app.fcm_key'))
				   // ->setApiKey("AAAA1ELJHOo:APA91bHczliOM1dUVl_7FhPLNMGmqIc20V4dMOKmsQ3ri5LoZe01GUaXS2So6DGCFWU_I3cqkzgcuYfgkPQRlENE3gysb64nbvZhVQeBTpz28WRPBr4DiNv7gD5Mt_TmdkE6nT1w3Pyl ")
					->setDevicesToken($temp["Android"])
				   // ->setDevicesToken(array("cAhh8fEXwAo:APA91bEsDooMK5hStpSxlY6xhUZ1CVEBK5OjVZ35jjclif1KO-SKbe4UkTJBWa2tNtI8JqdDi2PN3RCtx2NXaPLsqe6wEcYGVL6NrJy7arv5wP8mv-2A6p86rwco2WGk0zRVQ-JUSJGk"))
					->send();
					
					
					$a = $push->getFeedback();
	//               print_r($a);
	//                exit;
				}
			}
		}
	}
	//use for both android and ios
	$arr["title"] = "";
	$arr["body"] = "";
	$ex = [
		'type'=>"Silent"
	];
	$arr["extra"] = $ex;
	$arr[$user_device->device_type][] = $user_device->device_token;
	 send_notification_token($arr);
	function send_notification($arr) {    
    $user_ids = "";
    if(isset($arr["userids"][0]) && is_array($arr["userids"][0])) {
        $user_ids = array_reduce($arr["userids"][0], 'array_merge', array());
    } else if(isset($arr["userids"])) {
        $user_ids = $arr["userids"];
    }
    if(!empty($user_ids)) {
        $find = UserDevice::whereIn('user_id',$user_ids)->select('device_type','device_token')->get();
        $tokens = $find->toArray();
        $temp = [];
        foreach ($tokens as $t) :
            $temp[$t["device_type"]][] = $t["device_token"];
        endforeach;
        
        if(isset($temp["Android"]) && count($temp["Android"]) > 0) {            
            $arr["extra"]["title"]=$arr["title"];
            $arr["extra"]["body"]=$arr["body"];
            
        //    android_push($temp["Android"],$arr["extra"]);
            $push = new PushNotification('fcm');
//            $push->setMessage([
//                'data'=>$arr["extra"]
//            ])
            $push->setMessage([
                'notification' => [
                        'title'=>$arr["title"],
                        'body'=>$arr["body"],
                        'sound' => 'default'
                        ],
                'data' => $arr["extra"]
            ])        
            ->setApiKey(config('app.fcm_key'))
            ->setDevicesToken($temp["Android"])
            ->send();
            $a = $push->getFeedback();            
        } else if(isset($temp["Iphone"]) && count($temp["Iphone"]) > 0) {
            $push = new PushNotification('apn');
            $push->setMessage([
                'aps' => [
                    'alert' => [
                        'title' => $arr["title"],
                        'body' => $arr["body"]
                    ],
                    'sound' => 'default'

                ],
                'extraPayLoad' => $arr["extra"]
            ])
            ->setDevicesToken($temp["Iphone"])
            ->send();
            $a = $push->getFeedback();
        }
    }
}
/*end send notification code*/

/*.htaccess files ritz file code*/
# index.php processes all the files that aren't found

Options +FollowSymLinks
RewriteEngine on

# index.php processes all the files that aren't found
<IfModule mod_rewrite.c>
RewriteCond %{REQUEST_FILENAME}.php -f
RewriteRule !.*\.php$ %{REQUEST_FILENAME}.php [L]
</IfModule>
<Files 403.shtml>
order allow,deny
allow from all
</Files>

/*end htaccess*/
/*.htaccess files bini file code*/
RewriteEngine On
RewriteCond %{HTTP:X-Forwarded-Proto} !https
RewriteCond %{HTTPS} off
RewriteRule .* https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
RewriteCond %{HTTP_HOST} !^www\. [NC]
RewriteRule .* https://www.%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

 RewriteCond %{THE_REQUEST} /([^.]+)\.php [NC]
 RewriteRule ^ /%1 [NC,L,R]
 RewriteCond %{REQUEST_FILENAME}.php -f
 RewriteRule ^ %{REQUEST_URI}.php [NC,L]

 Redirect 301 /index /
 
 RedirectMatch 301 /resource /residential-ev-charger-installation-orange-county
/*end htaccess*/
/*put this code in env file for direct file not access*/
<Files .env> Order allow,deny Deny from all </Files>
/*put this code in env file*/
/*laravel .htaccess file*/
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>
    <Files .env>
       Order allow,deny
       Deny from all
   </Files>
    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Handle Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
/*end laravel .htaccess file*/

/*laravel validation*/
	'customer_id' => "required|exists:users,id",
	'plat' => 'required',
	'ride_type' => 'required|in:shedule,normal',
	'schedule_date' => 'required_if:ride_type,shedule',
	'email' = 'required|email|unique:users';
/*laravel validation*/
/*create job*/
- php artisan make:job NotificationToAllUsers
php artisan make:job SendReminderEmail
/**/
/*slient notification*/
 public static function iOSSlientNotification($data, $devicetoken, $production) {

        foreach ($data as $key => $value) {
            if (is_null($value)) {
                $data[$key] = "";
            }
        }
        //date_default_timezone_set("Europe/London");
        $deviceToken = $devicetoken;
        $createddate = date("Y-m-d H:i:s");

        $ctx = stream_context_create();
        //$production = 0;
        if ($production == 0) {
            $notUrl = 'ssl://gateway.sandbox.push.apple.com:2195';
            stream_context_set_option($ctx, 'ssl', 'local_cert', __DIR__ . '/iOs_Doctor/pushcertDeveloper.pem');
        } else {
            $notUrl = 'ssl://gateway.push.apple.com:2195';
            stream_context_set_option($ctx, 'ssl', 'local_cert', __DIR__ . '/iOs_Doctor/pushcertProdConnect.pem');
        }

        stream_context_set_option($ctx, 'ssl', 'passphrase', self::$passphrase);

        $fp = stream_socket_client($notUrl, $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);

        $body['aps'] = array(
            'alert' => array(
                //  'title'=>'',
                'Notification_Type' => (isset($data['Notification_Type']) && !is_null($data['Notification_Type'])) ? $data['Notification_Type'] : '',
                'is_lifetime_wavier' => (isset($data['is_lifetime_wavier']) && !is_null($data['is_lifetime_wavier'])) ? $data['is_lifetime_wavier'] : '',
            ),
            'badge' => 1,
            'sound' => "",
            'content-available' => 1
        );

        $payload = json_encode($body);
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;
        $result = fwrite($fp, $msg, strlen($msg));
        fclose($fp);      

        if (!$result)
            return false;
        else
            return true;
    }
    public static function androidSlientNotification($data, $reg_id, $production) {
        //date_default_timezone_set("Europe/London");

        $registrationIds = array($reg_id);

        $data['createddate'] = date("Y-m-d H:i:s");

        $fields = array(
            'registration_ids' => $registrationIds,
            'data' => array(
                'title' => 'Test Notification ',
                'message' => (isset($data['message']) && !is_null($data['message'])) ? $data['message'] : '',
                'lifetime_wavier' => (isset($data['lifetime_wavier']) && !is_null($data['lifetime_wavier'])) ? $data['lifetime_wavier'] : '',
                //  'vibrate' => 1,
                'Notification_Type' => 'status_update',
                'sound' => 'default',
                 'type' => "Silent",
            
            // 'largeIcon' => 'large_icon',
            // 'smallIcon' => 'small_icon'
            )
        );
        $headers = array(
            'Authorization: key=' . self::$API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://android.googleapis.com/gcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        curl_close($ch);
       
        if (!$result)
            return false;
        else
            return true;
    }
	/*slient notification*/
	/*multiple selected at edit time*/	
	$coatch_students = array();
	if(!empty($data)){
		$coatch_students = $data->coatch_students->toArray();
	}                                    
	
	if(isset($students) && !empty($students))
	foreach($students as $key =>$value)
	
	 <option value="{{$value->id}}" @if(array_search($value->id, array_column($coatch_students, 'student_id')) !== False) selected="selected" @endif>{{$value->firstname}}</option>
	
	endforeach
	endif
/*multiple selected at edit time*/
?>
