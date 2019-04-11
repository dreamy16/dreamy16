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

    ===========================================================================================================

     public function statusChange(Request $request) {

        $id = $request->id;
        $type = $request->type;
        $data = Category::find($id);
        if ($data) {
            $data->status = $type;
            $data->save();

            $arr = array("status" => 200, "message" => "Status updated successfully.", "data" => []);
        } else {
            $arr = array("status" => 400, "message" => "Category not found.", "data" => []);
        }

        return \Response::json($arr);
    }

     /*status change notification*/
    $(document).on('click', '.status', function () {
        var t = $(this);
        var id = t.attr("id");
        var type = t.attr("data-type");
        swal({
            title: "Are you sure?",
            text: "You want to  "+type+" this user!",
            type: "warning",
            timer: 3000,
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, change it!",
            cancelButtonText: "No, cancel !",
            closeOnConfirm: true,
            closeOnCancel: true,
            showLoaderOnConfirm: true,
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "post",
                    url: '{{url("user/statuschange")}}',
                    data: {
                        id: id,
                        type: type,
                    },
                    'headers': {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (data) {
                        if (data.status == 400) {
                            swal("Error", data.message, "error");
                        } else {
                            $("label").css({'color': '#3f4047'});
                            swal("", data.message, "success");
                        }
                        unload();
                        $("#example2").DataTable().ajax.reload(null, false);



                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        swal("Server Timeout!", "Please try again", "warning");
                    },
                    // timeout: 3000,
                });
            } else
            {

                swal();
            }
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
