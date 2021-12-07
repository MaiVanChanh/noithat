<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Material;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session ;
session_start();
class MaterialProduct extends Controller
{
    public function Kiemtra()
    {
        $admin_id = Session::get('admin_id');
        if($admin_id)
        {
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add()
    {
        $this->Kiemtra();
        return view('admin.add_material');
    }
    public function all()
    {
        $this->Kiemtra();
    //$all = DB::table('tbl_material')->get();
    $all = Material::orderBy('material_id','DESC')->paginate(4);
    $view = view('admin.all_material')->with('all_material',$all);
        return view('admin_layout')->with('admin.all_material',$view);
    }
    public function save(Request $request)
    {
        $this->Kiemtra();
        // $data = array();
        // $data ['material_name'] = $request->material_name;
        // $data ['material_desc'] = $request->material_desc;
        // $data ['material_status'] = $request->material_status;
        $data = $request->all();
        $matrrial = new Material();
        $matrrial->material_name= $data['material_name'];
        $matrrial->material_desc= $data['material_desc'];
        $matrrial->material_status= $data['material_status'];
        
        $get_image =$request-> file('material_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image =  current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/material',$new_image);
            $matrrial['material_image']=$new_image;
            $matrrial->save();
            Session::put('message','Thêm thành công');
            return Redirect::to('add-material');
        }
        Session::put('message','Thêm thất bại');
        return Redirect::to('all-material');
    }
    public function an($id)
    {
        $this->Kiemtra();
        DB::table('tbl_material')->where('material_id',$id)->update(['material_status'=>1]);
        Session::put('message','Ẩn nội dụng danh mục');
        return Redirect::to('all-material');
    }
    public function hien($id)
    {
        $this->Kiemtra();
        DB::table('tbl_material')->where('material_id',$id)->update(['material_status'=>0]);
        Session::put('message','Hiện thị nội dụng danh mục');
        return Redirect::to('all-material');
    }
    public function edit($id)
    {
        $this->Kiemtra();
       // $edit = DB::table('tbl_material')->where('material_id',$id)->get();
       $edit = Material::where('material_id',$id)->get();
        $hienthi = view('admin.edit_material')->with('edit_material',$edit);
        return view('admin_layout')->with('admin.edit_material',$hienthi);
    }
    public function update(Request $request, $id)
    {
        $this->Kiemtra();
        // $data = array();
        // $data ['material_name'] = $request->material_name;
        // $data ['material_desc'] = $request->material_desc;
        $data = $request->all();
        $matrrial =Material::find($id);
        $matrrial->material_name= $data['material_name'];
        $matrrial->material_desc= $data['material_desc'];
        
       
        $get_image =$request-> file('material_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image =  current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/material',$new_image);
            $matrrial['material_image']=$new_image;
            
        }
        $matrrial->update();
        Session::put('message','Chỉnh sửa thành công');
        return Redirect::to('all-material');
    }
    public function delete($id)
    {
        $this->Kiemtra();
        //DB::table('tbl_material')->where('material_id',$id)->delete();
        Material::where('material_id',$id)->delete();
        Session::put('message','Xóa thành thành công');
        return Redirect::to('all-material');
    }
}
