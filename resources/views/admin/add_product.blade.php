@extends('admin_layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                        Thêm sản phẩm
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
                                <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                 {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                    <input type="text"  minlength="6" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá sản phẩm</label>
                                    <input type="number" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Giá sản phẩm" required >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Image</label>
                                    <input type="file" name="product_image" class="form-control" id="exampleInputEmail1" required >
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                     <textarea class="form-control" name="product_desc" id="ckeditor" placeholder="Mô tả sản phẩm" style="height: 200px;"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                     <textarea class="form-control" name="product_content" id="ckeditor1" placeholder="Nội dung sản phẩm"></textarea>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                    <select name= "cate" class="form-control input-sm m-bot15">
                                       @foreach($cate as $key => $cate)
                                        <option value={{$cate->category_id}}>{{$cate->category_name}}</option>
                                       @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                <label for="exampleInputPassword1">Chất liệu sản phẩm</label>
                                    <select name= "mate" class="form-control input-sm m-bot15">
                                    @foreach($mate as $key => $mate)
                                        <option value="{{$mate->material_id}}">{{$mate->material_name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                        
                                <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name= "product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Hiện Nội Dung</option>
                                        <option value="1">Ẩn Nội Dung</option>
                                       
                                    </select>
                                </div>
                    
                                <button type="submit" name="product_add" class="btn btn-info"> Thêm </button>
                            </form>
                            </div>

                        </div>
                    </section>
@endsection