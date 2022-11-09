<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotifCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notif_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('category_nm',200);
            $table->string('msg_display',300);
            $table->string('use_yn',1)->default('Y');
            $table->string('note',300)->nullable();
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
        Schema::dropIfExists('notif_categories');
    }
}
