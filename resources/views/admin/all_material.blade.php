@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
    Danh sách danh mục chất liệu
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
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
            STT
            </th>
            <th>Tên danh mục</th>
            <th>Hình minh họa</th>
            <th>Hiển thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        @php 
          $i = 0;
          @endphp
        <tbody>
          @foreach($all_material as $key => $material)
          @php 
            $i++;
    @endphp
        <tr>
            <td><i>{{$i}}</i></label></td>
            <td>{{$material->material_name}}</td>
            <td><img src="public/upload/material/{{$material->material_image}}" height="100" width="100"></td>
            <td><span class="text-ellipsis">
              <?php
              if($material->material_status==0){
              ?>
             <a href="{{URL::to('/an-material/'.$material->material_id)}}"><span class="fa-thumb-styling fa fa-eye text-success text-active"></span></a>
              <?php
              }
              else
              {
                ?>
                <a href="{{URL::to('/hien-material/'.$material->material_id)}}"><span class="fa-thumb-styling fa fa-eye-slash "></span></a>
              <?php
              }
              ?>

            </span></td>
            
            <td>
              <a  href="{{URL::to('/edit-material/'.$material->material_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                <a onclick="return confirm('Bạn có chắc muốn xóa không ?')" href="{{URL::to('/delete-material/'.$material->material_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
       
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
          {{ $all_material->links() }}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection