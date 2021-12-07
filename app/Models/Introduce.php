<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Introduce extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'gioithieu_name', 'gioithieu_status', 'gioithieu_note'
    ];
    protected $primaryKey = 'gioithieu_id';
 	protected $table = 'tbl_gioithieu';
}
