composer require yajra/laravel-datatables-oracle

===========================================================================================================================
Schema::create('users', function (Blueprint $table) {
$table->increments('id');
$table->string('name');
$table->string('email');
$table->text('password');
$table->enum('who_see_location', ['everyone', 'friends'])->default('friends');
$table->integer('technologies_id')->unsigned();
$table->foreign('technologies_id')->references('id')->on('technologies')->onDelete('cascade');
$table->string('status')->default('1');
$table->string('status')->nullable();
$table->rememberToken();
$table->timestamps();
$table->boolean('is_user_admin')->default(false);
});


============================================================================
Route::group(['middleware' => ['auth', 'admin']], function() {
      
	    Route::post('user/getall', 'UserController@getall');
	    Route::post('user/statuschange', 'UserController@statusChange');
	    Route::resource('user', 'UserController');

    });

    ==========================================================================
    use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;


    public function store(Request $request) {
        $input = $request->all();
        $rules = array(
            'name' => 'required',
        );

        $msg = "Category Added successfully.";
        if (isset($input["id_for_update"]) && !empty($input["id_for_update"])) {
            $msg = "Category updated successfully.";
            $id = $input["id_for_update"];
            $category = Category::find($id);
            $rules["name"] = 'required|unique:categories,name,' . $id;
        } else {
            $rules["name"] = 'required|unique:categories';
            $category = new Category();
        }
        $validator = Validator::make($input, $rules);

        if ($validator->fails()) {
            $arr = array("status" => 400, "msg" => $validator->errors()->first(), "result" => array());
        } else {

            try {
                if (!empty($category)) {
                    $image = $request->file('image');
                    if ($image != "") {
                        $old_image = $category->image;
                        $filename = base_path('storage/' . $old_image);


                        if (!empty($image)) {
                            if (file_exists($filename) && !empty($old_image)) {
                                unlink(base_path('storage/' . $old_image));
                            }
                            $imagename = userProfileImageUpload($image, "category");
                            $input["image"] = "category/" . $imagename;
                        }
                    }
                    $category->fill($input)->save();
                    $arr = array("status" => 200, "msg" => $msg, "data" => $category->toArray());
                } else {
                    $arr = array("status" => 400, "msg" => "Category not found.", "data" => []);
                }
            } catch (\Exception $ex) {
                if (isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                } else {
                    $msg = $ex->getMessage();
                }
                $arr = array("status" => 400, "msg" => $msg, "data" => []);
            }
        }
        return \Response::json($arr);
    }

    public function update(Request $request, $id) {
        $request->request->add(['id_for_update' => $id]); //send id into store function       
        return $this->store($request);
    }

   //image upload
function userProfileImageUpload($profile_img, $folder = "users") {
    $info = pathinfo($profile_img->getClientOriginalName());
    $ext = $info['extension'];
    $img_name = time() . "-" . rand(11111, 99999) . "." . $ext;
    $path = \Storage::disk('public')->putFileAs(
            $folder, $profile_img, $img_name
    );
    return $img_name;
}
function displayImage($imagename) {
    return url('public/storage') . "/" . $imagename;
}

public function store(Request $request)
    {
        $r = $request->all();
        $rules = array(
            'firstname' => 'required|max:20',
            'lastname' => 'required|max:20',
            'email' => 'required|email|unique:users,email',
            'company_id' => 'required|numeric|exists:company,id',
            'hobbies' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif',
        );
        if(!isset($r["id_for_update"])) {
               $rules["password"] = "required";
        }
        $messages = [
            'firstname.required' => 'Please enter firstname',
            'lastname.required' => 'Please enter lastname',
            'email.required' => 'Please enter email',
            'email.email' => 'Please enter valid email',
            'company_id.required' => 'Please select company',
            'hobbies.required' => 'Please select at least one hobby',
        ];
        $validator = Validator::make($r, $rules,$messages);
        if($validator->fails()) {
            $arr = array("status"=>400,"msg"=>$validator->errors()->first(),"result"=>array());
            //return Redirect::back()->withErrors($validator)->withInput();
        } else {
            begin();
            try {
                if(isset($r["id_for_update"])) {
                    $user = User::find($r["id_for_update"]);
                } else {
                    $user = new User();
                }
                if(isset($r["image"]) && !empty($r["image"])) {
                    $image = $r["image"];
                    $image_name = time()."_".$image->getClientOriginalName();
                    copy($image->getRealPath(), base_path('images/'.$image_name));
                    $r["image"] = $image_name;
                }
                $pass = \Hash::make($r["password"]);
                $r["password"] = $pass;
                $user->fill($r)->save();
                $h = [];
                if(isset($r["hobbies"])) {
                    $h = $r["hobbies"];
                }
                $user->hobbies()->sync($h);
                commit();
                
                /*Send email*/
                /*\Mail::send('emails.test', ["data"=>$r], function ($message) use ($r) {
                    $message->from('us@example.com', 'Laravel');
                    $message->to($r['email'])->subject('test email');
                });*/
                /*Send email*/
                $arr = array("status"=>200,"msg"=>"User created.","result"=>$user->get()->toArray());
                //return Redirect::to('user');
            } catch(\Illuminate\Database\QueryException $ex){ 
                $msg = $ex->getMessage();
                if(isset($ex->errorInfo[2])) {
                    $msg = $ex->errorInfo[2];
                }
                rollback();
                $arr = array("status"=>400,"msg"=>$msg,"result"=>array());
                //return Redirect::back()->withErrors(['error'=>$msg]);
            }  catch (Exception $ex) {
                rollback();
                $arr = array("status"=>400,"msg"=>"error","result"=>array());
                //return "error";
            }
        }
        return \Response::json($arr);
        
    }
    ==============================================================================================================
    public function getall() {
        $input = $this->request->all();
        $data = User::where('role', 'user')->orderby('id', 'desc');

        return Datatables::of($data->get())
                        ->addColumn('name', function ($q) {
                            return $q->name;
                        })
                        ->addColumn('display_name', function ($q) {
                            return $q->display_name;
                        })
//                        ->addColumn('image', function ($q) {
//                            $path = displayImage($q->image);
//                            return '<img src="'.$path.'" class="img-square" alt="User Image" />';
//                        })
                        ->addColumn('email', function ($q) {
                            return $q->email;
                        })
                        ->addColumn('phone', function ($q) {
                            return $q->phone;
                        })
                        ->addColumn('status', function ($q) {
                            return $q->status;
                        })
                        ->addColumn('action', function ($q) {
                            if ($q->status == 'Active') {
                                $btn = '<a  class="status btn btn-warning" title="Status change" data-type="Inactive" id="' . $q->id . '"  style="color:#fff;">Inactive</a>';
                            } else {
                                $btn = '<a  class="status btn btn-success" title="Status change" data-type="Active" id="' . $q->id . '" style="color:#fff;">Active</a>';
                            }
//                            <a  href="user/' . $q->id . '"  title="View" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"  "></i></a> 
                            return '<a  href="user/' . $q->id . '"  title="View" class="btn btn-primary btn-sm"><i class="fa fa-eye" aria-hidden="true"  "></i></a> ' . $btn;
                        })
                        ->addIndexColumn()
                        ->rawColumns(['action'])
                        ->make(true);
    }
    <script>
    $(function () {
        $('#example2').DataTable({
            bSort: false,
            processing: true,
            serverSide: true,
            ajax: {
                'url': "{{url('user/getall')}}",
                'type': 'POST',
                'headers': {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [
                {data: 'DT_RowIndex', width: "10%"},
                {data: 'name'},
                {data: 'display_name'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'status'},
                {data: 'action'}
            ]
        });
    });
</script>
    ===========================================================================================================

     public function destroy($id)
    {
        $user = User::find($id);
        if($user) {
            $path = $user->image;
            $user->delete();
            if(!empty($path)) {
                if(file_exists(base_path('images/'.$path))) {
                    unlink(base_path('images/'.$path));
                }
            }
            $arr = array("status"=>200,"msg"=>"User deleted.","data"=>[]);
        } else {
            $arr = array("status"=>400,"msg"=>"No user found.","data"=>[]);
        }
        return \Response::json($arr);
    }

     /*delete notification*/
<a class="delsing cpforall" id="'.$q->id.'" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
   <script>
	   $("body").on('click','.delsing',function () {
                var t = $(this);
                var id = t.attr("id");
                $.ajax({
                    'method':'delete',
                    'url':'{{url("user")}}/'+id,
//                    'data' : $("#formid").serialize();
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    'success' : function (data) {
                        alert(data.msg);
                        if(data.status == 200) {
                            //$("#example2").DataTable().ajax.reload();
                            t.parents("tr").fadeOut(function () {
                                $(this).remove();
                            });
                        }
                    },
                    'error' : function () {
                        alert("Error");
                    },
                });
            });
</script> 
==================================================================================================================

<input type="hidden" name="_token" value="{{ csrf_token() }}">
    @isset($data)
    <input type="hidden" name="_method" value="PUT">
    @endisset


$(document).ready(function () {

    $('body').on("click", "#btn", function (e) {
        e.preventDefault();
        var val = $("#frm").validate({
            rules: {
                name: {
                    required: true,
                    maxlength: 50
                },
                image: {
                    required: true,
                    extension: "jpg|jpeg|png|PNG|JPG|JPEG",
                },
            }
        });
        if (val.form() != false) {
            var url = "@isset($data){{url('category/'.$data->id)}}@endisset @empty($data){{url('category')}}@endempty".trim();
            var action = "@isset($data){{'PUT'}}@endisset @empty($data){{'POST'}}@endempty".trim();
            var fdata = new FormData($("#frm")[0]);
            load();
            $.ajax({
                url: url,
                type: 'POST',
                data: fdata,
                headers: {
                    'X_CSRF_TOKEN': '{{ csrf_token() }}',
                },
                processData: false,
                contentType: false,
                success: function (data, textStatus, jqXHR) {
                    if (data.status == 400) {
                        swal("", data.msg, "error");
                    } else {
                        $("label").css({'color': '#3f4047'});
                        swal("", data.msg, "success");
                        setTimeout(function () {
                            window.location = "{{ Route('category.index') }}";
                        }, 2000);
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("Something went wrong. Please try again.");
                    unload();
                }
            });
        } else {
            return false;
        }
    });
});
