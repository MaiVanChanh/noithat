@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                        Chỉnh sửa chất liệu cho sản phẩm
                        </header>
        <?php
            use Illuminate\Support\Facades\Session ;
            $message = Session::get('message');   
            if($message){
            echo '<p type ="text-aline : center;" >'.$message.'</p>';
            Session::put('message',null);
            }
        ?>
                        <div class="panel-body" >
                        @foreach($edit_material as $key => $edit)
                            <div class="position-center" style="width: 100%;">
                                <form role="form" action="{{URL::to('/update-material/'.$edit->material_id)}}" method="post" enctype="multipart/form-data">
                                 {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên chất liệu sản phẩm</label>
                                    <input type="text" minlength="6" value="{{$edit->material_name}}" name="material_name" class="form-control" id="exampleInputEmail1" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Image</label>
                                    <input type="file" name="material_image" class="form-control" id="exampleInputEmail1" >
                                    <img src="{{URL::to('public/upload/material/'.$edit->material_image)}}" height="100" width="100">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung mô tả</label>
                                     <textarea class="form-control" name="material_desc" id="ckeditor" style="height: 200px" >{{$edit->material_desc}}</textarea>
                                </div>
                                <button type="submit" name="update" class="btn btn-info"> Xong </button>
                            </form>
                            </div>
                        @endforeach
                        </div>
                    </section>
@endsection