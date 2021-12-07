@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
    Danh sách sản phẩm
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
            <th>Tên sản phẩm</th>
            <th>Hình sản phẩm</th>
            <th>Thư viện ảnh</th>
            <th>Giá bán</th>
            <th>Danh mục</th>
            <th>Chất liệu</th>
            <th>Hiển thị</th>
            <th></th>
        </tr>
    </thead>
    @php 
          $i = 0;
          @endphp
    <tbody>
    @foreach($all_product as $key => $pro)
    @php 
            $i++;
    @endphp
        <tr>
            <td><i>{{$i}}</i></label></td>
            <td>{{$pro->product_name}}</td>
            <td><img src="public/upload/product/{{$pro->product_image}}" height="100" width="100"></td>
            <td><a href="{{url('/add-gallery/'.$pro->product_id)}}">Thêm thư viện ảnh</a></td>
            <td>{{$pro->product_price}}</td>
            <td>{{$pro->material_name}}</td>
            <td>{{$pro->category_name}}</td>
            <td><span class="text-ellipsis">
              <?php
              if($pro->product_status==0){
              ?>
             <a href="{{URL::to('/an-product/'.$pro->product_id)}}"><span class="fa-thumb-styling fa fa-eye text-success text-active"></span></a>
              <?php
              }
              else
              {
                ?>
                <a href="{{URL::to('/hien-product/'.$pro->product_id)}}"><span class="fa-thumb-styling fa fa-eye-slash "></span></a>
              <?php
              }
              ?>

            </span></td>
            <td>
              <a  href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                <a onclick="return confirm('Bạn có chắc muốn xóa không ?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
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