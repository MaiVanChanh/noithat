<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'admin_email',
        'admin_password',
        'admin_name',
        'admin_phone',
        'admin_note',
        'admin_image',
        'admin_ns',
        'admin_gt',
        'admin_dc',
        'admin_noilv',
    ];
    protected $primaryKey = 'admin_id';
 	protected $table = 'tbl_admin';
}
