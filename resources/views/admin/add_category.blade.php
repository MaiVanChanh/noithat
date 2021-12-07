@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                        Thêm danh mục sản phẩm
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
                                <form role="form" action="{{URL::to('/save-category')}}" method="post">
                                 {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục sản phẩm</label>
                                    <input type="text" minlength="6" name="category_name" class="form-control" placeholder="Tên danh mục sản phẩm" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung mô tả</label>
                                     <textarea class="form-control" name="category_desc" id="ckeditor" placeholder="Nội dung mô tả" style="height: 200px"></textarea>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name= "category_status" class="form-control input-sm m-bot15">
                                        <option value="0">Hiện Nội Dung</option>
                                        <option value="1">Ẩn Nội Dung</option>
                                       
                                    </select>
                                </div>
                    
                                <button type="submit" name="category_add" class="btn btn-info"> Thêm </button>
                            </form>
                            </div>

                        </div>
                    </section>
@endsection