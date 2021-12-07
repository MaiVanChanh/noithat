<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use App\Models\Ship;
use App\Models\Wards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session ;

class DeliveryController extends Controller
{
    public function update_delivery(Request $request){
		$data = $request->all();
		$fee_ship = Ship::find($data['feeship_id']);
		$fee_value = rtrim($data['fee_value'],'.');
		$fee_ship->fee_feeship = $fee_value;
		$fee_ship->save();
	}
	public function select_feeship(){
		$feeship = Ship::orderby('fee_id','DESC')->get();
		$output = '';
		$output .= '<div class="table-responsive">  
			<table class="table table-bordered">
				<thread> 
					<tr>
						<th>Tên thành phố</th>
						<th>Tên quận huyện</th> 
						<th>Tên xã phường</th>
						<th>Phí ship</th>
					</tr>  
				</thread>
				<tbody>
				';

				foreach($feeship as $key => $fee){

				$output.='
					<tr>
						<td>'.$fee->city->name_city.'</td>
						<td>'.$fee->province->name_quanhuyen.'</td>
						<td>'.$fee->wards->name_xaphuong.'</td>
						<td contenteditable data-feeship_id="'.$fee->fee_id.'" class="fee_feeship_edit">'.number_format($fee->fee_feeship,0,',','.').'</td>
					</tr>
					';
				}

				$output.='		
				</tbody>
				</table></div>
				';

				echo $output;

		
	}
	public function insert_delivery(Request $request){
		// $data = $request->all();
		// $fee_ship = new Ship();
		// $fee_ship->fee_matp = $data['city'];
		// $fee_ship->fee_maqh = $data['province'];
		// $fee_ship->fee_xaid = $data['wards'];
		// $fee_ship->fee_feeship = $data['fee_ship'];
		// $fee_ship->save(); $this->Kiemtra();
        $data = $request->all();
        $fee_ship = new Ship();
        $fee_ship->fee_matp = $data['city'];
		$fee_matp = $data['city'];
		$fee_ship->fee_maqh = $data['province'];
		$fee_maqh = $data['province'];
		$fee_ship->fee_xaid = $data['wards'];
		$fee_xaid = $data['wards'];
		$fee_ship->fee_feeship = $data['fee_ship'];
		$result= DB::table('tbl_ship')->where('fee_matp',$fee_matp)->where('fee_maqh',$fee_maqh)->where('fee_xaid',$fee_xaid)->get();

		if($result){
        $reset_count=$result->count();
        if($reset_count>0)
            { 
                
                Session::put('message','Phí vận chuyển đã tồn tại cần vào danh mục để chỉnh sửa');
                return Redirect::to('/delivery');
                }
				else{
					$fee_ship->save();
					Session::put('message', 'Thêm thành công ');
					return Redirect::to('/delivery');
				}
       }
        else{
			
            Session::put('message', 'Thêm thất bại ');
            return Redirect::to('/delivery');
        }


		
	}
    public function delivery(Request $request){

    	$city = City::orderby('matp','ASC')->get();

    	return view('admin.delivery.add_delivery')->with(compact('city'));
    }
    public function select_delivery(Request $request){
    	$data = $request->all();
    	if($data['action']){
    		$output = '';
    		if($data['action']=="city"){
    			$select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
    				$output.='<option>---Chọn quận huyện---</option>';
    			foreach($select_province as $key => $province){
    				$output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
    			}

    		}else{

    			$select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
    			$output.='<option>---Chọn xã phường---</option>';
    			foreach($select_wards as $key => $ward){
    				$output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
    			}
    		}
    		echo $output;
    	}
    	
    }
}

