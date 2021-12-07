@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading" style="width: 40%; margin-left:30% ; border-radius: 10px;">
    THÔNG TIN QUẢN TRỊ VIÊN 
    </div>
    <div class="row w3-res-tb" style="width: 60%; margin-left:20% ; ">
    <table class="table table-striped b-t b-light">
        <thead>
          <tr >
          <th >Thông tin cá nhân</th>
            <th style="text-align: center;">Ảnh đại diện </th>
          </tr>
        </thead>
        <tbody>
          @foreach($edit_admin as $key => $cate)
          <form role="form" action="{{URL::to('/update-admin/'.$cate->admin_id)}}" method="post" enctype="multipart/form-data">
          <tr>
          {{csrf_field()}}
            <td colspan="1"> 
            <label for="exampleInputEmail1">Tên Admin</label>
                                    <input type="text" minlength="2" maxlength="10" name="admin_name" class="form-control input-sm m-bot15" value="{{$cate->admin_name}}"  required>
            <label for="exampleInputEmail1">Năm Sinh</label>
                                    <input type="date" name="admin_ns" class="form-control input-sm m-bot15" value="{{$cate->admin_ns}}"  required>
           <label for="exampleInputPassword1">Giới tính :</label>
                                    <select name= "admin_gt" class="form-control input-sm m-bot15">
                                   <?php
                                        if($cate->admin_gt==0){
                                            echo ' 
                                            <option value="0">Nữ</option>
                                            <option value="1">Nam</option>
                                            <option value="2">Khác</option>';
                                        }
                                        elseif($cate->admin_gt==1 ){
                                            echo ' <option value="1">Nam</option>
                                            <option value="0">Nữ</option>
                                            <option value="2">Khác</option>';
                                        }
                                        else{
                                            echo '
                                            <option value="2">Khác</option>
                                            <option value="1">Nam</option>
                                            <option value="0">Nữ</option>';
                                        }
                                     ?>
                                    
                                    </select>
            <label for="exampleInputEmail1">Điện thoại</label>
                                    <input type="tel" name="admin_phone" class="form-control input-sm m-bot15" pattern="[0-9]{10}" value="{{$cate->admin_phone}}"  required>
            <label for="exampleInputEmail1">Địa chỉ mail</label>
                                    <input type="email" name="admin_email" class="form-control input-sm m-bot15" value="{{$cate->admin_email}}"  required>
            </td>
            <td style="text-align: center;" colspan="1">
            <label for="exampleInputEmail1">Image</label>
                                    <input type="file" name="admin_image" class="form-control" id="exampleInputEmail1"  >
                                    <img src="{{URL::to('public/backend/images/'.$cate->admin_image)}}" height="200" width="150">
          </tr>
          <div>
          <td colspan="2"> 
            <label for="exampleInputEmail1">Địa chỉ </label>
                                    <input type="text" name="admin_dc" class="form-control input-sm m-bot15" value="{{$cate->admin_dc}}"  required>
            <label for="exampleInputEmail1">Nơi Làm việc  </label>
                                    <input type="text"  name="admin_noilv" class="form-control input-sm m-bot15" value="{{$cate->admin_noilv}}"  required>
         </td>
          </div>
          <thead>
          <tr >
          <th style="text-align: right ; "><button type="submit" name="update" class="btn btn-info"> Cập nhật </button></th>
          </tr>
        </thead>

          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection