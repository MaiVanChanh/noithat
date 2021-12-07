@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê users
    </div>
   
    <div class="table-responsive">
                      <?php

use Illuminate\Support\Facades\Session ;

$message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light"  id="table_id">
        <thead>
          <tr>
            <th >Stt</th>
            <th>Tên user</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Password</th>
            <th>Admin</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        @php 
          $i = 0;
          @endphp
    <tbody>
    @foreach($admin as $key => $user)
    @php 
            $i++;
    @endphp
    <tr>
            <td><i>{{$i}}</i></label></td>
            <td>{{ $user->admin_name }}</td>
            <td>{{ $user->admin_email }} 
            <td>{{ $user->admin_phone }}</td>
            <td>
            <span class="text-ellipsis">
              <?php
              if( $user->admin_note==0){
              ?>
             <a ><span class="fa-thumb-styling  text-success text-active">Quản Lý</span></a>
              <?php
              }
              else
              {
                ?>
               
                <a onclick="return confirm('Bạn có chắc muốn đặt lại mật khẩu không ?')" href="{{URL::to('/edit-mkadmin/'.$user->admin_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa ">Đặt lại mật khẩu</i></a>
              <?php
              }
              ?>

            </span>
            </td>
            <td><span class="text-ellipsis">
              <?php
              if( $user->admin_note==0){
              ?>
             <a ><span class="fa-thumb-styling  text-success text-active">full</span></a>
              <?php
              }
              else
              {
                ?>
                <a href=""><span class="fa-thumb-styling  "> not full</span></a>
              <?php
              }
              ?>

            </span></td>
            <td><span class="text-ellipsis">
              <?php
              if( $user->admin_note==0){
              ?>
             <a><span class="fa-thumb-styling  text-success text-active">full</span></a>
              <?php
              }
              else
              {
                ?>
             
            
                <a onclick="return confirm('Bạn có chắc muốn xóa không ?')" href="{{URL::to('/delete-admin/'.$user->admin_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
              <?php
              }
              ?>

            </span></td>
            
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection