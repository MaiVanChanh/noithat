<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Gallery;
use App\Models\Comment;
use App\Models\Introduce;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session ;

session_start();
class IntroduceController extends Controller
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
    public function add_gioithieu(){
        $this-> Kiemtra();
        return view('admin.gioithieu.add_gioithieu');
    }
    public function save_gioithieu(Request $request){
        $data = $request->all();
        $gioithieu = new Introduce();
        $gioithieu->gioithieu_name = $data['gioithieu_name'];
        $gioithieu->gioithieu_status = $data['gioithieu_status'];
        $gioithieu->gioithieu_note = $data['gioithieu_note'];
        $gioithieu->save();
        
        Session::put('message','Thêm giới thiệu thành công');
        return Redirect::to('add-gioithieu');
    }
    public function all_gioithieu(){
        $this-> Kiemtra();

        $gioithieu = Introduce::orderBy('gioithieu_id','DESC')->paginate(5);

    	return view('admin.gioithieu.all_gioithieu')->with(compact('gioithieu'));
    }
    public function delete_gt($id){
        $this-> Kiemtra();
        DB::table('tbl_gioithieu')->where('gioithieu_id',$id)->delete();
        Session::put('message','Xóa sản phẩm thành công');
        return Redirect::to('all-gioithieu');
    }
    public function an_gt ($id)
    {
        $this->Kiemtra();
        DB::table('tbl_gioithieu')->where('gioithieu_id',$id)->update(['gioithieu_note'=>1]);
        Session::put('message','Ẩn nội dụng danh mục');
        return Redirect::to('all-gioithieu');
    }
    public function hien_gt($id)
    {
        $this->Kiemtra();
        DB::table('tbl_gioithieu')->where('gioithieu_id',$id)->update(['gioithieu_note'=>0]);
        Session::put('message','Hiện thị nội dụng danh mục');
        return Redirect::to('all-gioithieu');
    }
    public function edit_gt($id)
    {
        $this->Kiemtra();
        
        
        $edit = DB::table('tbl_gioithieu')->where('gioithieu_id',$id)->get();

        return view('admin.gioithieu.edit_gioithieu')->with(compact('edit'));
    }
    public function update_gt(Request $request,$id){
        $this->Kiemtra();
       $data = array();
     
       $data['gioithieu_name'] = $request->gioithieu_name;
       $data['gioithieu_status'] = $request->gioithieu_status;
       $data['gioithieu_note'] = $request->gioithieu_note;
        DB::table('tbl_gioithieu')->where('gioithieu_id',$id)->update($data);
    Session::put('message','Cập nhật giới thiệu thành công');
        return Redirect::to('all-gioithieu');
      
   }
   public function gioi_thieu( Request $request){
   
    $cate=DB::table('tbl_category')-> where('category_status','0')->orderby('category_id','desc')->get();
    $mate=DB::table('tbl_material')-> where('material_status','0')->orderby('material_id','desc')->get();
    $all=DB::table('tbl_gioithieu')->orderby('gioithieu_id','desc')-> where('gioithieu_note','0')->paginate(12);
    return view('pages.gioithieu')->with('category',$cate)->with('material',$mate)->with('product1',$all);
    
}
public function show_gioithieu( $id){
   
    $cate=DB::table('tbl_category')-> where('category_status','0')->orderby('category_id','desc')->get();
    $mate=DB::table('tbl_material')-> where('material_status','0')->orderby('material_id','desc')->get();
    $all=DB::table('tbl_gioithieu')-> where('gioithieu_id',$id)->get();
    return view('pages.ctgioithieu')->with('category',$cate)->with('material',$mate)->with('product2',$all);
  
}
}
