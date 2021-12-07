<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblSanpham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_sanpham', function (Blueprint $table) {
            _token: "{{ csrf_token() }}";
            $table->increments('sanpham_id');
            $table->integer('danhmuc_id');
            $table->integer('chatlieu_id');
            $table->text('sanpham_desc');
            $table->text('sanpham_content');
            $table->string('sanpham_price');
            $table->string('sanpham_image');
            $table->integer('sanpham_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_sanpham');
    }
}
