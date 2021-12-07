@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                        Chỉnh sửa giới thiệu
                        </header>
        <?php
            use Illuminate\Support\Facades\Session ;
            $message = Session::get('message');   
            if($message){
            echo '<p type ="text-aline : center;" >'.$message.'</p>';
            Session::put('message',null);
            }
        ?>
                        <div class="panel-body">
       
                            <div class="position-center" style="width: 100%;">
                            @foreach($edit as $key => $gt)
                                <form role="form" action="{{URL::to('/update-gt/'.$gt->gioithieu_id)}}" method="post" enctype="multipart/form-data">
                                 {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên giới thiệu</label>
                                    <input type="text" minlength="6" name="gioithieu_name" class="form-control" id="exampleInputEmail1" value="{{$gt->gioithieu_name}}"  required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung giới thiệu</label>
                                     <textarea class="form-control" name="gioithieu_status" id="ckeditor1" style="height: 200px" >{{$gt->gioithieu_status}}</textarea>
                                </div>
                                <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name= "gioithieu_note" class="form-control input-sm m-bot15">
                                        <option value="0">Hiện Nội Dung</option>
                                        <option value="1">Ẩn Nội Dung</option>
                                       
                                    </select>
                                </div>
                                <button type="submit" name="update" class="btn btn-info"> Xong </button>
                            </form>
                            @endforeach
                            </div>
                        </div>
                    </section>
@endsection