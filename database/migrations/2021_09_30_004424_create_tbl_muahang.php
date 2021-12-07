<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblMuahang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_muahang', function (Blueprint $table) {
        
            $table->Increments('muahang_id');
            $table->string('muahang_name');
            $table->integer('customer_id');
            $table->string('muahang_email');
            $table->string('muahang_diachi');
            $table->string('muahang_phone');
            $table->text('muahang_note');
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
        Schema::dropIfExists('tbl_muahang');
    }
}
