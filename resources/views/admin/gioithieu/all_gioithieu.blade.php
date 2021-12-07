@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
    Danh sách giới thiệu
    </div>
    
    <div class="table-responsive">
  <?php
	use Illuminate\Support\Facades\Session ;
	$message = Session::get('message');   
	if($message){
	echo '<p type ="text-aline : center;" >'.$message.'</p>';
	Session::put('message',null);
	}
?>
  <table id="table_id" class="display">
    <thead>
        <tr>
            <th>stt</th>
            <th>Tên giới thiệu</th>
            <th>Thời gian </th>
            <th>Hiển thị</th>
            <th></th>
        </tr>
    </thead>
    @php 
          $i = 0;
          @endphp
    <tbody>
    @foreach($gioithieu as $key => $gt)
    @php 
            $i++;
    @endphp
        <tr>
            <td><i>{{$i}}</i></label></td>
            <td>{{$gt->gioithieu_name}}</td>
            <td>{{$gt->created_at}}</td>
            <td><span class="text-ellipsis">
              <?php
              if($gt->gioithieu_note==0){
              ?>
             <a href="{{URL::to('/an-gt/'.$gt->gioithieu_id)}}"><span class="fa-thumb-styling fa fa-eye text-success text-active"></span></a>
              <?php
              }
              else
              {
                ?>
                <a href="{{URL::to('/hien-gt/'.$gt->gioithieu_id)}}"><span class="fa-thumb-styling fa fa-eye-slash "></span></a>
              <?php
              }
              ?>
            </span></td>
            <td>
              <a  href="{{URL::to('/edit-gt/'.$gt->gioithieu_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                <a onclick="return confirm('Bạn có chắc muốn xóa không ?')" href="{{URL::to('/delete-gt/'.$gt->gioithieu_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
    
</table>
    </div>
  </div>
</div>
@endsection