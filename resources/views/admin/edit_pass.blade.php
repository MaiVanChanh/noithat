@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading" style="width: 40%; margin-left:30% ; border-radius: 10px;">
    ĐỔI MẬT KHẨU 
    </div>
    <div class="row w3-res-tb" style="width: 60%; margin-left:20% ; ">
    <?php
use Illuminate\Support\Facades\Session ;
$message = Session::get('message');
	if($message){
		echo '<span style="width: 100%;">'.$message.'</span>';
		Session::put('message',null);
	}
	?>
     @foreach($edit_pass as $key => $cate)
   <form action="{{URL::to('/update-pass/'.$cate->admin_id)}}" method="post">
			{{ csrf_field() }}
			<div><center>
      <p>{{$cate->admin_name}}</p>
        <br>
        <p> Nhập mật khẩu cũ</p>
     
      <input type="password" class="ggg1" name="admin_password1" placeholder="Password" required ><br><br>
      <p>Nhập mật khẩu mới</p>
      <input type="password" class="ggg1" name="admin_password2" placeholder="Password" required ><br><br>
      <p> Nhập lại mật khẩu </p>
      <input type="password" class="ggg1" name="admin_password3" placeholder="Password" required ><br><br>
	
			
			<br>
			<br>
				<input type="submit" value="Update" name="login">
			
       
        </center>
			</div>

		</form>
     @endforeach
    </div>
  </div>
</div>
@endsection