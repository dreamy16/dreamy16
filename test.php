
Route::post('user/getall','UserController@getall');
Route::get('user/mail','UserController@mail');
Route::resource('user','UserController');


======================================================================================================

public function index()
    {
        $hobbies = Hobby::all();
        $companies = Company::all();
        $user = User::with(['hobbies','company'])->whereHas('hobbies',function ($q) {
            $q->where('name','Chess');
        })->withCount('hobbies')->get();
        return View::make('user.index',['data'=>$user,'companies'=>$companies,'hobbies'=>$hobbies]);
    }
    
    public function mail() {
        /*Send email*/
        \Mail::send('emails.test', ["data"=>['email'=>"PS"]], function ($message){
            $message->from('us@example.com', 'Laravel');
            $message->to("dijexu@muimail.com")->subject('test email');
        });
        /*Send email*/
    }

        public function getall() {
        $r = $this->request->all();
        $form_data = json_decode($r["form"]);
        $user = User::with('company','hobbies')->withCount('hobbies');
        if(count($form_data) > 0) {
            foreach ($form_data as $data) :
                if(!empty($data->value)) {
                    if($data->name == 'company_id') {
                        $user->where($data->name,$data->value);
                    }
                    if($data->name == 'hobby_id') {
                        $user->whereHas('hobbies',function ($q) use ($data) {
                            $q->where($data->name,$data->value);
                        });
                    }
                }
            endforeach;
        }
        
        return Datatables::of($user->get())
                ->addColumn('name',function ($q) {
                    $html = "<span class='label'>".$q->firstname." ".$q->lastname."</span>";
                    $html .= "<div class='text'><input type='text' name='firstname' value='".$q->firstname." ".$q->lastname."'></div>";
                    return $html;
                })
                ->addColumn('email',function ($q) {
                    return $q->email;
                })
                ->addColumn('company',function ($q) {
                    return $q->company->name;
                })
                ->addColumn('hobbies',function ($q) {
                    $names = $q->hobbies()->get()->pluck('name')->toArray();
                    return implode(",",$names);
                })
                ->addColumn('image',function ($q) {
                    return '<img src="'.asset('images/'.$q->image).'" height="60" width="60">';
                })
                ->addColumn('action',function ($q) {
                    //return '<a href="user/'.$q->id.'/edit" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><a class="delsing cpforall" id="'.$q->id.'" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>';
                    $html = '<div class="normal"><a class="edit_btn" title="Edit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><a class="delsing cpforall" id="'.$q->id.'" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a></div>';
                    $html .= '<div class="while_edit"><a class="save_btn" title="Save"><i class="fa fa-save" aria-hidden="true"></i></a><a class="cancel_edit" title="Cancel"><i class="fa fa-close" aria-hidden="true"></i></a></div>';
                    return $html;
                })
                ->addIndexColumn()
                ->rawColumns(['image','action','name'])
                ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $hobbies = Hobby::all();
        $companies = Company::all();
        return View::make('user.add_update',['hobbies'=>$hobbies,'companies'=>$companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('hobbies')->find($id);
        $hobbies = Hobby::all();
        $companies = Company::all();
        return View::make('user.add_update',['data'=>$user,'hobbies'=>$hobbies,'companies'=>$companies]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->request->add(['id_for_update' => $id]); //send id into store function
        return $this->store($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
}
============================================================================================================

<form id="frm" method="post" action="@if(!isset($data)) {{route('user.store')}} @else {{route('user.update',['id'=>$data->id])}} @endif" enctype="multipart/form-data">
            <div class="error">
                
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div>
                <input type="text" placeholder="Firstname" name="firstname" @if(isset($data)) value="{{$data->firstname}}" @else value="{{old('firstname')}}" @endif>
            </div>
            <div>
                <input type="text" placeholder="Lastname" name="lastname" @if(isset($data)) value="{{$data->lastname}}" @endif>
            </div>
            <div>
                <input type="text" placeholder="Email" name="email" @if(isset($data)) value="{{$data->email}}" @endif>
            </div>
            <div>
                <input type="password" placeholder="Passsword" name="password">
            </div>
            <div>
                Company :
                
                <select name="company_id">
                    <option value="">Select Company</option>
                    @foreach($companies as $comp)
                        <option value="{{$comp->id}}" @if(isset($data) && $data->company_id == $comp->id) selected="selected" @endif>{{$comp->name}}</option>
                    @endforeach
                </select>
            </div>
            @php
            $hobbies_arr = old('hobbies') ? old('hobbies') : [];
            if(isset($data)) :
                $hobbies_arr = $data->hobbies()->get()->pluck('id')->toArray();
            endif;
            @endphp
            <div>
                Hobbies : 
                
                @foreach($hobbies as $hobby)
                    <input type="checkbox" name="hobbies[]" @if(in_array($hobby->id,$hobbies_arr)) checked="checked" @endif value="{{$hobby->id}}"> {{$hobby->name}}
                @endforeach
            </div>
            <div>
                <input type="file" name="image" >
            </div>
            <div>
                @if(!isset($data))
<!--                <input type="submit" name="add" value="Add">-->
                <input class="submit" type="button" name="add" value="Add">
                @else
                <input type="hidden" name="_method" value="PUT">
<!--                <input type="submit" name="update" value="Update">-->
                <input class="submit" type="button" name="update" value="Update">
                @endif
            </div>
        </form>
        <script>
            $(".submit").click(function () {
                var val = $("#frm").validate({
                    rules: {
                        firstname : {
                            required: true
                        },
                        lastname : {
                            required: true
                        },
                        email : {
                            required: true,
                            email : true
                        },
                        password : {
                            required: true
                        },
                        company_id : {
                            required: true
                        },
                        image : {
                            accept: "image/*"
                        }
                    },
                    messages : {
                        image : {
                            accept : "Please upload valid image file."
                        }
                    }
                });
                if(val.form() != false) {
                    var fdata = new FormData($("#frm")[0]);
                    $.ajax({
                       "method":"post",
                       "url":"{{url('user')}}",
                       "data": fdata,
                       headers: {
                            'X_CSRF_TOKEN': '{{ csrf_token() }}',
                        },
                       contentType: false,
                       processData: false,
                       "success":function (data) {
                           if(data.status == 400) {

                               $(".error").css({"color":"red",'display':'block'}).html(data.msg).fadeOut("slow");
                           } else {
                               $(".error").css({"color":"green",'display':'block'}).html(data.msg);
                               setTimeout(function () {
                                   location.href = "{{url('user')}}";
                               },5000);

                           }
                       },
                       "error":function () {
                           alert("Something went wrong.");
                       }
                    });
                } else {
                    return false;
                }
            });
        </script>
@endsection

=============================================================================================================

/*user*/
public function hobbies() {
        return $this->belongsToMany('App\Hobby','user_hobby','userid','hobby_id')->withTimestamps();
    }
    public function company() {
        
        return $this->belongsTo('App\Company');
    }

/*hobby*/
 public function users() {
        return $this->belongsToMany('App\User','user_hobby','hobby_id','userid')->withTimestamps();
    }

/*company*/

public function users() {
        return $this->hasMany('App\User','company_id','id');
    }


