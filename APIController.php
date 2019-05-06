<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers,
    Illuminate\Support\Facades\Auth;
use App\Notifications\MailResetPasswordToken;
use Validator;
use DB,
    Config,
    Hash,
    Mail,
    Carbon\Carbon;
use App\User,
    App\QuestionOption,
    App\UserDevice,
    App\Category,
    App\Video,
    App\QuetionAnswer,
    App\Question;

class APIV1Controller extends Controller {

    public $successStatus = 200;

    public function Register(Request $request) {
        $input = $request->all();
        $validator = Validator::make($input, [
                    'firstname' => 'required',
                    'email' => 'required|email|unique:users',
                    'password' => 'required',
        ]);
        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "data" => (object) []);
        } else {
            try {
                $input['password'] = bcrypt($input['password']);
                $user = User::create($input);
                // $user['token'] = $user->createToken('gimmy')->accessToken;
                $arr = array("status" => 200, "msg" => "Register successfully.", "data" => replace_null_with_empty_string($user));
            } catch (Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "msg" => $msg, "data" => (object) []);
            }
        }
        return response($arr);
    }

    public function Login(Request $request) {
        $input = $request->all();
        $validator = Validator::make($input, [
                    'email' => 'required|email',
                    'password' => 'required',
        ]);
        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "data" => (object) []);
        } else {
            try {
                if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
                    $user = Auth::user();
                    $user['token'] = $user->createToken('gimmy')->accessToken;

                    $arr = array("status" => $this->successStatus, "msg" => "Login successfully", "data" => replace_null_with_empty_string($user->toArray()));
                } else {
                    $arr = array("status" => 400, "msg" => "User Unauthorised", "data" => (object) []);
                }
            } catch (Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "msg" => $msg, "data" => (object) []);
            }
        }
        return response($arr);
    }

    public function QuetionList(Request $request) {

        $question_list = Question::with('options')->get();
        if (!empty($question_list)) {
            $arr = array("status" => $this->successStatus, "msg" => "List get successfully", "data" => replace_null_with_empty_string($question_list->toArray()));
        } else {
            $arr = array("status" => 400, "msg" => "Question not found.", "data" => (object) []);
        }
        return response($arr);
    }

    //get profile
    public function GetProfile(Request $request) {
        $input = $request->all();
        $user = auth()->user();
        try {
            $user = User::find($user->id);
            if ($user) {
                $arr = array("status" => $this->successStatus, "msg" => "profile get successfully", "data" => replace_null_with_empty_string($user->toArray()));
            } else {
                $arr = array("status" => 400, "msg" => "User Unauthorised", "data" => (object) []);
            }
        } catch (Exception $ex) {
            if (isset($ex->errorInfo[2])) {
                $msg = $ex->errorInfo[2];
            } else {
                $msg = $ex->getMessage();
            }
            $arr = array("status" => 400, "msg" => $msg, "data" => (object) []);
        }
        return response($arr);
    }

    //update profile
    public function UpdateProfile(Request $request) {
        $input = $request->all();
        $user = auth()->user();
        $validator = Validator::make($input, [
                    'firstname' => "required",
                        //'email' => "required|unique:users,email," . $user_id,
        ]);
        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "data" => (object) []);
        } else {
            try {
                $data = User::find($user->id);
                if ($data) {
                    $data = $user->update($input);
                    $data = User::find($user->id);
                    $arr = array("status" => $this->successStatus, "msg" => "profile update successfully", "data" => replace_null_with_empty_string($data->toArray()));
                } else {
                    $arr = array("status" => 400, "msg" => "User not found.", "data" => (object) []);
                }
            } catch (Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "msg" => $msg, "data" => (object) []);
            }
        }
        return response($arr);
    }

    //upload profile photo
    public function UploadProfilePhoto(Request $request) {
        $input = $request->all();
        $user = auth()->user();
        $user_id = $user->id;
        $validator = Validator::make($input, [
                    'image' => "required",
        ]);
        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "data" => (object) []);
        } else {
            try {
                $data = User::find($user_id);
                if ($data) {
                    $image = (isset($input['image'])) ? trim($input['image']) : "";
                    if ($image != "") {
                        $old_image = $data->image;
                        $filename = public_path('storage/' . $old_image);
                        $profile_img = $request->file('image');
                        if (!empty($profile_img)) {
                            if (file_exists($filename) && !empty($old_image)) {
                                unlink(public_path('storage/' . $old_image));
                            }
                            $imagename = userImageUpload($profile_img, "users");
                            $imageName = "users/" . $imagename;
                        }
                        $data->image = $imageName;
                        $data->save();
                    }
                    $arr = array("status" => $this->successStatus, "msg" => "profile update successfully", "data" => replace_null_with_empty_string($data->toArray()));
                } else {
                    $arr = array("status" => 400, "msg" => "User not found.", "data" => (object) []);
                }
            } catch (Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "msg" => $msg, "data" => (object) []);
            }
        }
        return response($arr);
    }

    //change password
    public function ChangePassword(Request $request) {
        $input = $request->all();
        $user = auth()->user();
        $user_id = $user->id;
        $validator = Validator::make($input, [
                    'current_password' => "required",
                    'new_password' => "required",
        ]);
        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "data" => (object) []);
        } else {
            try {
                $current_password = $input["current_password"];
                $new_password = Hash::make($input["new_password"]);
                $data = User::find($user_id);
                if ($data) {
                    if (Hash::check($current_password, $data->password)) {
                        $data->password = $new_password;
                        $data->save();
                        $arr = array("status" => $this->successStatus, "msg" => "Password change successfully", "data" => replace_null_with_empty_string($data->toArray()));
                    } else {
                        $arr = array("status" => 400, "msg" => "Current Password Not Match.", "data" => (object) []);
                    }
                } else {
                    $arr = array("status" => 400, "msg" => "User not found.", "data" => (object) []);
                }
            } catch (Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "msg" => $msg, "data" => (object) []);
            }
        }
        return response($arr);
    }

    //Add User Device
    public function AddUserDevice(Request $request) {
        $input = $request->all();
        $user = auth()->user();
        $user_id = $user->id;
        $validator = Validator::make($input, [
                    'device_id' => 'required',
                    'device_type' => 'required|in:Android,iOS',
                    'application_type' => 'required|in:Customer,Coatch',
                    'fcm_token' => 'required',
        ]);
        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "data" => (object) []);
        } else {
            try {
                $user = User::where(['id' => $user_id, 'status' => 'Active'])->first();
                if ($user) {
                    $device = UserDevice::where("device_id", $input['device_id'])->first();
                    $reg_data = array(
                        'user_id' => $user_id,
                        'device_id' => $input['device_id'],
                        'device_type' => $input['device_type'],
                        'fcm_token' => $input['fcm_token'],
                        'application_type' => $input['application_type'],
                    );
                    if (empty($device)) {
                        UserDevice::create($reg_data);
                        $msg = "Device token added successfully!";
                    } else {
                        UserDevice::where("device_id", $input['device_id'])->update($reg_data);
                        $msg = "Device token updated successfully!";
                    }
                    $arr = array("status" => 200, "msg" => $msg, "data" => (object) []);
                } else {
                    $arr = array("status" => 400, "msg" => "User Not Found", "data" => (object) []);
                }
            } catch (Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "msg" => $msg, "data" => (object) []);
            }
        }
        return response($arr);
    }

    //Forgot Password
    public function ForgotPassword(Request $request) {
        $input = $request->all();
        $validator = Validator::make($input, [
                    'email' => "required|exists:users,email",
        ]);
        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "data" => (object) []);
        } else {
            try {

                $user = User::where(['email' => $input['email']])->where('status', '!=', 'Delete')->first();
                if ($user) {
                    $remember_token = str_random(60);
                    $user->notify(new MailResetPasswordToken($remember_token));

                    DB::table('password_resets')->where('email', $input['email'])->delete();
                    DB::table('password_resets')->insert([
                        'email' => $input['email'],
                        'token' => Hash::make($remember_token), //change 60 to any length you want
                        'created_at' => Carbon::now()
                    ]);
                    $arr = array("status" => 200, "msg" => "Reset password link send to your email.", "data" => (object) array());
                } else {
                    $arr = array("status" => 400, "msg" => "User Not Found", "data" => (object) []);
                }
            } catch (Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "msg" => $msg, "data" => (object) []);
            }
        }
        return response($arr);
    }

    //Category List
    public function CategoryList(Request $request) {
        $input = $request->all();
        try {
            $data = Category::orderby('id', 'desc')->get();
            if ($data) {
                $arr = array("status" => $this->successStatus, "msg" => "Category list get successfully.", "data" => replace_null_with_empty_string($data->toArray()));
            } else {
                $arr = array("status" => 400, "msg" => "Category not added yet.", "data" => (object) []);
            }
        } catch (Exception $ex) {
            if (isset($ex->errorInfo[2])) {
                $msg = $ex->errorInfo[2];
            } else {
                $msg = $ex->getMessage();
            }
            $arr = array("status" => 400, "msg" => $msg, "data" => (object) []);
        }

        return response($arr);
    }

    //Save questions Answers
    public function SaveAnswers(Request $request) {
        $input = $request->all();
        $user = auth()->user();
        $validator = Validator::make($input, [
                    'answers' => 'required',
        ]);
        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "data" => (object) []);
        } else {
            try {
                $isUser = User::find($user->id);
                if ($isUser) {

                    if (isset($input['answers']) && !empty($input['answers'])) {
                        $answers = json_decode($_POST["answers"], true);
                        foreach ($answers as $key => $value) {
                            $ischeck = QuetionAnswer::where(['user_id' => $user->id, 'question_id' => $value['question_id'], 'option_id' => $value['option_id']])->first();
                            if (empty($ischeck)) {
                                QuetionAnswer::create([
                                    'user_id' => $user->id,
                                    'question_id' => $value['question_id'],
                                    'option_id' => $value['option_id'],
                                ]);
                            }
                        }
                    }
                    $data = Video::with('user')->orderby('id', 'desc')->get();
                    $arr = array("status" => 200, "msg" => "answer submited", "data" => replace_null_with_empty_string($data->toArray()));
                } else {
                    $arr = array("status" => 400, "msg" => "User Not Found", "data" => (object) []);
                }
            } catch (Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "msg" => $msg, "data" => (object) []);
            }
        }
        return response($arr);
    }

    //Category Video List
    public function CategoryVideoList(Request $request) {
        $input = $request->all();
        $user = auth()->user();
        $user_id = $user->id;
        $validator = Validator::make($input, [
                    'category_id' => 'required|exists:categories,id',
        ]);
        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "data" => (object) []);
        } else {
            try {
                $isUser = User::where(['id' => $user_id, 'status' => 'Active'])->first();
                if ($isUser) {
                    $data = Video::with('user')->get();
                    $arr = array("status" => $this->successStatus, "msg" => "Category list get successfully.", "data" => replace_null_with_empty_string($data->toArray()));
                } else {
                    $arr = array("status" => 400, "msg" => "User Not Found", "data" => (object) []);
                }
            } catch (Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "msg" => $msg, "data" => (object) []);
            }
        }
        return response($arr);
    }

    //logout
    public function Logout(Request $request) {
        $input = $request->all();
        $user = auth()->user();
        $user_id = $user->id;
        $rules = array(
            'device_id' => "required",
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "data" => (object) []);
        } else {
            try {
                $user_device = UserDevice::where('user_id', $user_id)->where('device_id', $input['device_id'])->first();
                if ($user_device) {
                    $user_device->delete();
                    $arr = array("status" => 200, "msg" => "Logout success!", "data" => (object) []);
                } else {
                    $arr = array("status" => 400, "msg" => "User not found", "data" => (object) []);
                }
            } catch (\Exception $ex) {

                if (isset($ex->errorInfo[2])) {

                    $msg = $ex->errorInfo[2];
                } else {

                    $msg = $ex->getMessage();
                }

                $arr = array("status" => 400, "msg" => $msg, "data" => (object) []);
            }
        }

        return response($arr);
    }

    //Add Swing
    public function AddSwing(Request $request) {
        $input = $request->all();
        $user = auth()->user();
        $user_id = $user->id;
        $validator = Validator::make($input, [
                    'title' => "required",
        ]);
        $rules = array(           
            'title' => "required",
        );        
        if(empty($request->file('fo_video'))){
            $rules['dtl_video'] = "required";
            $rules['dtl_thumb'] = "required";
        }
        if(empty($request->file('dtl_video'))){
            $rules['fo_video'] = "required";
            $rules['fo_thumb'] = "required";
        }
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "data" => (object) []);
        } else {
            try {
                $data = User::find($user_id);
                if ($data) {
                    $fo_file = $request->file('fo_video');
                    $fo_thumb = $request->file('fo_thumb');
                    if ($fo_file != "") {
                        $prefix = time() . "_" . str_random(6);
                        $filename_save = $prefix . "." . $fo_file->getClientOriginalExtension();
                        $destinationPath = storage_path() . "/app/public/videos/";
                        $vpath = $fo_file->move($destinationPath, $filename_save);
                    }
                    if (!empty($fo_thumb)) {
                        $thumb_imageName = userImageUpload($fo_thumb, "videos",'thumb_');                        
                    }
                    if (!empty($thumb_imageName) && !empty($filename_save)) {
                        $video = Video::create([
                                    'user_id' => $user_id,
                                    'url' => 'videos/' . $filename_save,
                                    'thumb_image' => 'videos/' . $thumb_imageName,
                                    'type' => 'fo',
                                    'upload_by' => 'user',
                        ]);
                    }
                    //dtl video upload
                    $dtl_video = $request->file('dtl_video');
                    $dtl_thumb = $request->file('dtl_thumb');

                    if (!empty($dtl_video)) {
                        $prefix = time() . "_" . str_random(6);
                        $dtl_filename_save = $prefix . "." . $dtl_video->getClientOriginalExtension();
                        $destinationPath = storage_path() . "/app/public/videos/";
                        $vpath = $dtl_video->move($destinationPath, $dtl_filename_save);
                    }
                    if (!empty($dtl_thumb)) {
                        $dtl_thumb_imageName = userImageUpload($dtl_thumb, "videos",'thumb_');                       
                    }

                    if (!empty($dtl_thumb_imageName) && !empty($dtl_filename_save)) {
                        $video = Video::create([
                                    'user_id' => $user_id,
                                    'url' => 'videos/' . $dtl_filename_save,
                                    'thumb_image' => 'videos/' . $dtl_thumb_imageName,
                                    'type' => 'dtl',
                                    'upload_by' => 'user',
                        ]);
                    }
                    $data = Video::where('user_id',$user_id)->get();
                    $arr = array("status" => $this->successStatus, "msg" => "Video added successfully", "data" => replace_null_with_empty_string($data->toArray()));
                } else {
                    $arr = array("status" => 400, "msg" => "User not found.", "data" => (object) []);
                }
            } catch (Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "msg" => $msg, "data" => (object) []);
            }
        }
        return response($arr);
    }

}
