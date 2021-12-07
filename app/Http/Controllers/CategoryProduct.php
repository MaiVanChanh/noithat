<?php
/* quan ly san pham */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session ;

session_start();

class CategoryProduct extends Controller
{
    /* admin */
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
    public function addcategory()
    {
        $this->Kiemtra();
        return view('admin.add_category');
    }
    public function allcategory()
    {
        $this->Kiemtra();
    //$all = DB::table('tbl_category')->get();
    $all = Category::orderBy('category_id','DESC')->paginate(5);
    $hienthi = view('admin.all_category')->with('all_category',$all);
        return view('admin_layout')->with('admin.all_category',$hienthi);

    }
    public function savecategory(Request $request)
    {
        $this->Kiemtra();
        $data = $request->all();
        $category = new Category();
        $category->category_name= $data['category_name'];
        $category->category_desc= $data['category_desc'];
        $category->category_status= $data['category_status'];
        $category->save();
        // $data = array();
        // $data ['category_name'] = $request->category_name;
        // $data ['category_desc'] = $request->category_desc;
        // $data ['category_status'] = $request->category_status;
        // DB::table('tbl_category')->insert($data);
        Session::put('message','Thêm thành công');
        return Redirect::to('add-category');
    }
    public function ancategory($id)
    {
        $this->Kiemtra();
        DB::table('tbl_category')->where('category_id',$id)->update(['category_status'=>1]);
        Session::put('message','Ẩn nội dụng danh mục');
        return Redirect::to('all-category');
    }
    public function hiencategory($id)
    {
        $this->Kiemtra();
        DB::table('tbl_category')->where('category_id',$id)->update(['category_status'=>0]);
        Session::put('message','Hiện thị nội dụng danh mục');
        return Redirect::to('all-category');
    }
    public function editcategory($id)
    {
        $this->Kiemtra();
        //$edit = DB::table('tbl_category')->where('category_id',$id)->get();///control
        ///$edit = Category::find($id);//modle
        $edit = Category::where('category_id',$id)->get();
        $hienthi = view('admin.edit_category')->with('edit_category',$edit);
        return view('admin_layout')->with('admin.edit_category',$hienthi);
    }
    public function updatecategory(Request $request, $id)
    {
        $this->Kiemtra();
        $data = $request->all();
        $category =Category::find($id);
        $category->category_name= $data['category_name'];
        $category->category_desc= $data['category_desc'];
        $category->save();
        // $data = array();
        // $data['category_name'] = $request->category_name;
        // $data['category_desc'] = $request->category_desc;
        // DB::table('tbl_category')->where('category_id',$id)->update($data);
        Session::put('message','Chỉnh sửa thành công');
        return Redirect::to('all-category');
    }
    public function deletecategory($id)
    {
        $this->Kiemtra();
        //DB::table('tbl_category')->where('category_id',$id)->delete();
        $category =Category::find($id);
        $category->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('all-category');
    }
    /* end admin */
    public function show_category($id)
    {
        $cate=DB::table('tbl_category')->where('category_status','0')->orderby('category_id','asc')->get();

        $mate=DB::table('tbl_material')->where('material_status','0')->orderby('material_id','asc')->get();

        $product_id=DB::table('tbl_product')->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')->where('tbl_product.category_id',$id)-> where('product_status','0')->get();
        $product_name=DB::table('tbl_category')->where('tbl_category.category_id',$id)->get();
         return view('pages.category.showdmsp')->with('category',$cate)->with('material',$mate)->with('product_id',$product_id)->with('product_name',$product_name); 
    }
    public function show_material($id,$id1)
    {
       
        $cate=DB::table('tbl_category')->where('category_status','0')->orderby('category_id','desc')->get();

        $mate=DB::table('tbl_material')->where('material_status','0')->orderby('material_id','desc')->get();

        $product_id=DB::table('tbl_product')->join('tbl_material','tbl_product.material_id','=','tbl_material.material_id')->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')->where('tbl_product.material_id',$id)->where('tbl_product.category_id',$id1)-> where('product_status','0')->get();
        $product_name=DB::table('tbl_material','')->where('tbl_material.material_id',$id)->get();
        $product_name1=DB::table('tbl_category','')->where('tbl_category.category_id',$id1)->get();
         return view('pages.category.showdmcl')->with('category',$cate)->with('material',$mate)->with('product_id',$product_id)->with('product_name',$product_name)->with('product_name1',$product_name1);    }
   
}
