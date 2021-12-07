@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                        Thêm Giới Thiệu
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
                                <form role="form" action="{{URL::to('/save-gioithieu')}}" method="post" enctype="multipart/form-data">
                                 {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên phần giới thiệu</label>
                                    <input type="text"  minlength="6" name="gioithieu_name" class="form-control" id="exampleInputEmail1" placeholder="Tên phần giới thiệu" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung giới thiệu</label>
                                     <textarea class="form-control" name="gioithieu_status" id="ckeditor1" placeholder="Nội dung giới thiệu"></textarea>
                                </div>
                                <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name= "gioithieu_note" class="form-control input-sm m-bot15">
                                        <option value="0">Hiện Nội Dung</option>
                                        <option value="1">Ẩn Nội Dung</option>
                                       
                                    </select>
                                </div>
                    
                                <button type="submit" name="gioithieu_add" class="btn btn-info"> Thêm </button>
                            </form>
                            </div>

                        </div>
                    </section>
@endsection