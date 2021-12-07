@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                        Chỉnh sửa danh mục sản phẩm
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
                        @foreach($edit_category as $key => $edit)
                            <div class="position-center" style="width: 100%;">
                                <form role="form" action="{{URL::to('/update-category/'.$edit->category_id)}}" method="post">
                                 {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục sản phẩm</label>
                                    <input type="text" minlength="6" value="{{$edit->category_name}}" name="category_name" class="form-control" id="exampleInputEmail1" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung mô tả</label>
                                     <textarea class="form-control" name="category_desc" id="ckeditor" style="height: 200px" >{{$edit->category_desc}}</textarea>
                                </div>
                                <button type="submit" name="update" class="btn btn-info"> Xong </button>
                            </form>
                            </div>
                        @endforeach
                        </div>
                    </section>
@endsection