@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
    Danh sách danh mục sản phẩm
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
            <th>Hiển thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        @php 
          $i = 0;
          @endphp
        <tbody>
          @foreach($all_category as $key => $cate_pro)
          @php 
            $i++;
    @endphp
        <tr>
            <td><i>{{$i}}</i></label></td>
            <td>{{$cate_pro->category_name}}</td>
            <td><span class="text-ellipsis">
              <?php
              if($cate_pro->category_status==0){
              ?>
             <a href="{{URL::to('/an-category/'.$cate_pro->category_id)}}"><span class="fa-thumb-styling fa fa-eye text-success text-active"></span></a>
              <?php
              }
              else
              {
                ?>
                <a href="{{URL::to('/hien-category/'.$cate_pro->category_id)}}"><span class="fa-thumb-styling fa fa-eye-slash "></span></a>
              <?php
              }
              ?>

            </span></td>
            
            <td>
              <a  href="{{URL::to('/edit-category/'.$cate_pro->category_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                <a onclick="return confirm('Bạn có chắc muốn xóa không ?')" href="{{URL::to('/delete-category/'.$cate_pro->category_id)}}" class="active styling-edit" ui-toggle-class="">
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
          {{ $all_category->links() }}
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
@endsection