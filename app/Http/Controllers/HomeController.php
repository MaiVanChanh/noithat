<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session ;
session_start();

class HomeController extends Controller
{
    public function index( Request $request){
   
        $cate=DB::table('tbl_category')-> where('category_status','0')->orderby('category_id','desc')->get();
        $mate=DB::table('tbl_material')-> where('material_status','0')->orderby('material_id','desc')->get();
      
        $all=DB::table('tbl_product')-> where('product_status','0')->orderby('product_id','desc')->paginate(12);
        return view('pages.home')->with('category',$cate)->with('material',$mate)->with('product1',$all);
        
    }
   
    
    public function tim_kiem(Request $request){
        
        $keyword = $request->tim_kiem;
        $cate=DB::table('tbl_category')-> where('category_status','0')->orderby('category_id','desc')->get();
        $mate=DB::table('tbl_material')-> where('material_status','0')->orderby('material_id','desc')->get();
        $search = DB::table('tbl_product')-> where('product_name','like','%'.$keyword.'%')->get();
        return view('pages.category.searchproduct')->with('category',$cate)->with('material',$mate)->with('search',$search);
    }
    public function send_mail(){
        //send mail
        $to_name = "Mai Văn Chánh";
        $to_email = "maichanh31@gmail.com";//send to this email
       
     
        $data = array("name"=>"Mail từ tài khoản Khách hàng","body"=>'Mail gửi về vấn về hàng hóa'); //body of mail.blade.php
        FacadesMail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){

            $message->to($to_email)->subject('Test thử gửi mail google');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail

        });
        // return redirect('/')->with('message','');
        //--send mail
    }
}
