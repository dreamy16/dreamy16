<?php

use Illuminate\Http\Request;

/*
  |--------------------------------------------------------------------------
  | API Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register API routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | is assigned the "api" middleware group. Enjoy building your API!
  |
 */

Route::prefix('v1')->group(function () {
    Route::post('login', 'API\APIV1Controller@Login');
    Route::post('register', 'API\APIV1Controller@Register');
    Route::post('forgot_password', 'API\APIV1Controller@ForgotPassword');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::get('quetion_list', 'API\APIV1Controller@QuetionList');
        Route::get('get_profile', 'API\APIV1Controller@GetProfile');
        Route::post('update_profile', 'API\APIV1Controller@UpdateProfile');
        Route::post('upload_profile_image', 'API\APIV1Controller@UploadProfilePhoto');
        Route::post('change_password', 'API\APIV1Controller@ChangePassword');
        Route::post('add_user_device', 'API\APIV1Controller@AddUserDevice');
        Route::get('category_list', 'API\APIV1Controller@CategoryList');
        Route::post('save_answers', 'API\APIV1Controller@SaveAnswers');
        Route::post('category_video_list', 'API\APIV1Controller@CategoryVideoList');
        Route::post('add_swing', 'API\APIV1Controller@AddSwing');
        Route::post('logout', 'API\APIV1Controller@Logout');
    });
});

