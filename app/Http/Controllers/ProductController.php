<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Models\Gallery;
use App\Models\Comment;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session ;

session_start();

class ProductController extends Controller
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
    public function reply_comment(Request $request){
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_parent_comment = $data['comment_id'];
        $comment->comment_status = 0;
        $comment->comment_name = 'HiếuStore';
        $comment->save();

    }
    public function allow_comment(Request $request){
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }
    public function list_comment(){
        $comment = Comment::with('product')->where('comment_parent_comment','=',0)->orderBy('comment_id','DESC')->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
        return view('admin.comment.list_comment')->with(compact('comment','comment_rep'));
    }
    public function send_comment(Request $request){
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment = $comment_content;
        $comment->comment_name = $comment_name;
        $comment->comment_product_id = $product_id;
        $comment->comment_status = 1;
        $comment->comment_parent_comment = 0;
        $comment->save();
    }
    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id',$product_id)->where('comment_parent_comment','=',0)->where('comment_status',0)->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
        $output = '';
        foreach($comment as $key => $comm){
            $output.= ' 
            <div class="row style_comment">

                                        <div class="col-md-2">
                                            <img width="100%" src="'.url('public/backend/images/customer.png').'" class="img img-responsive img-thumbnail">
                                        </div>
                                        <div class="col-md-2">
                                        <p style="color:green; text-align:left">@'.$comm->comment_name.'</p>
                                        </div>
                                        <div class="col-md-6">
                                        <p style=" text-align:left">'.$comm->comment.'</p>
                                        </div>
                                        <div class="col-md-2">
                                        <p style="color:#000;">'.$comm->comment_date.'</p>
                                        </div>
                                       
                                    </div><p></p>
                                    ';

                                    foreach($comment_rep as $key => $rep_comment)  {
                                        if($rep_comment->comment_parent_comment==$comm->comment_id)  {
                                     $output.= ' <div class="row style_comment" style="margin:5px 40px;background: aquamarine;">

                                        <div class="col-md-2">
                                            <img width="80%" src="'.url('public/backend/images/admin.png').'" class="img img-responsive img-thumbnail">
                                        </div>
                                        <div class="col-md-5">
                                            <p style="color:blue;">@Admin</p>
                                        </div>
                                        <div class="col-md-5">
                                       
                                        <p style="color:#000;">'.$rep_comment->comment.'</p>
                                        <p></p>
                                        </div>
                                    </div><p></p>';
                                        }
                                    }
        }
        echo $output;

    }
    public function add()
    {
        $this->Kiemtra();
        
        $cate=DB::table('tbl_category')->orderby('category_id','desc')->get();
        $mate=DB::table('tbl_material')->orderby('material_id','desc')->get();
        return view('admin.add_product')->with('cate',$cate)->with('mate',$mate);

    }
    public function all()
    {
        $this->Kiemtra();
        $all = DB::table('tbl_product')
        ->join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')
        ->join('tbl_material','tbl_material.material_id','=','tbl_product.material_id')
        ->orderby('tbl_product.product_id','desc')->get();    

        $hienthi = view('admin.all_product')->with('all_product',$all);
        return view('admin_layout')->with('admin.all_product',$hienthi);
    }
    public function save(Request $request)
    {
        $this->Kiemtra();
        $data = array();
        $data ['product_name'] = $request->product_name;
        $data ['product_price'] = $request->product_price;
        $data ['product_desc'] = $request->product_desc;
        $data ['product_content'] = $request->product_content;
        $data ['category_id'] = $request->cate;
        $data ['material_id'] = $request->mate;
        $data ['product_status'] = $request->product_status;
        $get_image =$request-> file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image =  current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image']=$new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm thành công , bạn cần thêm hình ảnh cho sản phẩm ở chỉnh sửa');
            return Redirect::to('all-product');
        }
    
        Session::put('message','Thêm thất bại');
        return Redirect::to('all-product');
    }
    public function anproduct ($id)
    {
        $this->Kiemtra();
        DB::table('tbl_product')->where('product_id',$id)->update(['product_status'=>1]);
        Session::put('message','Ẩn nội dụng danh mục');
        return Redirect::to('all-product');
    }
    public function hienproduct($id)
    {
        $this->Kiemtra();
        DB::table('tbl_product')->where('product_id',$id)->update(['product_status'=>0]);
        Session::put('message','Hiện thị nội dụng danh mục');
        return Redirect::to('all-product');
    }
    public function editproduct($id)
    {
        $this->Kiemtra();
        
        $cate=DB::table('tbl_category')->orderby('category_id','desc')->get();
        $mate=DB::table('tbl_material')->orderby('material_id','desc')->get();

        $edit = DB::table('tbl_product')->where('product_id',$id)->get();

        $hienthi = view('admin.edit_product')->with('edit_product',$edit)->with('cate',$cate)->with('mate',$mate);
        return view('admin_layout')->with('admin.edit_product',$hienthi);
    }
    public function update(Request $request, $id)
    {
        $this->Kiemtra();
        $data = array();
        $data ['product_name'] = $request->product_name;
        $data ['product_price'] = $request->product_price;
        $data ['product_desc'] = $request->product_desc;
        $data ['product_content'] = $request->product_content;
        $data ['category_id'] = $request->cate;
        $data ['material_id'] = $request->mate;
        $data ['product_status'] = $request->product_status;
        $get_image =$request-> file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image =  current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image']=$new_image;
            DB::table('tbl_product')-> where('product_id',$id)->update($data);
            Session::put('message','Chỉnh sửa thành công');
            return Redirect::to('all-product');
        }
        
        DB::table('tbl_product')->where('product_id',$id)->update($data);
        Session::put('message','Chỉnh sửa thành công');
        return Redirect::to('all-product');
    }
    public function deleteproduct($id)
    {
        $this->Kiemtra();
        DB::table('tbl_product')->where('product_id',$id)->delete();
        Session::put('message','Xóa thành công');
        return Redirect::to('all-product');
    }
    public function chitietproduct($id,Request $request){
        $cate=DB::table('tbl_category')-> where('category_status','0')->orderby('category_id','desc')->get();
        $mate=DB::table('tbl_material')-> where('material_status','0')->orderby('material_id','desc')->get();
        $chitiet = DB::table('tbl_product')
        ->join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')
        ->join('tbl_material','tbl_material.material_id','=','tbl_product.material_id')
        ->where('tbl_product.product_id',$id)->get();

       foreach($chitiet as $key => $value)
       {
        $category_id = $value->category_id;
        $product_id = $value->product_id;
        
       }
       $gallery = Gallery::where('product_id',$product_id)->get();
       $lienquan = DB::table('tbl_product')
        ->join('tbl_category','tbl_category.category_id','=','tbl_product.category_id')
        ->join('tbl_material','tbl_material.material_id','=','tbl_product.material_id')
        ->where('tbl_category.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$id])->paginate(6);

        return view('pages.category.chitietproduct')->with('category',$cate)->with('material',$mate)->with('chitiet',$chitiet)->with('lienquan1',$lienquan)->with('gallery',$gallery);
    }
}
