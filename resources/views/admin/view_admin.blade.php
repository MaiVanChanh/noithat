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
        <?php
            use Illuminate\Support\Facades\Session ;
            $message = Session::get('message');   
            if($message){
            echo '<p type ="text-aline : center;" >'.$message.'</p>';
            Session::put('message',null);
            }
        ?>
          <tr >
          <th >Thông tin cá nhân</th>
            <th style="text-align: center;">Ảnh đại diện </th>
          </tr>
        </thead>
        <tbody>
          @foreach($view_admin as $key => $cate)
        
            <td> <b>Tên Admin :</b> {{$cate->admin_name}}<br><br><b>Năm Sinh :</b> {{$cate->admin_ns}}<br><br><b>Giới tính :</b>
            <span class="text-ellipsis">
            <?php
                                        if($cate->admin_gt==0){
                                            echo ' 
                                           Nữ';
                                        }
                                        elseif($cate->admin_gt==1 ){
                                            echo 'Nam';
                                        }
                                        else{
                                            echo '
                                            Khác';
                                        }
                                     ?>
            </span>
              <br>
              <br><b>Điện thoại :</b>  {{$cate->admin_phone}}<br><br><b>Gmail : </b>{{$cate->admin_email}}</td>
            <td style="text-align: center;"><img src="public/backend/images/{{$cate->admin_image}}" height="200" width="150"></td>
        
          <tr>
          <td> <b>Địa chỉ :</b><br>{{$cate->admin_dc}}<br><br><b>Nơi làm việc :</b><br> {{$cate->admin_noilv}}</td>
          </tr>
          <thead>
          <tr >
          <th style="text-align: right ; "  ><button><a  href="{{URL::to('/edit-admin/'.$cate->admin_id)}}" class="button1">Chỉnh sửa</a></button></th>
          </tr>
        </thead>
     
    </footer>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection