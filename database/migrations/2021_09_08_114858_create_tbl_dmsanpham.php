<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblDmsanpham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_dmsanpham', function (Blueprint $table) {
            _token: "{{ csrf_token() }}";
            $table->increments('dmsanpham_id');
            $table->string('dmsanpham_name');
            $table->text('dmsanpham_desc');
            $table->integer('dmsanpham_status');
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
        Schema::dropIfExists('tbl_dmsanpham');
    }
}
