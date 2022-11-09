<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBirthdateToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username',200)->nullable();
            $table->string('birthdate',10)->nullable();
            $table->string('profession',100)->nullable();
            $table->string('interest',300)->nullable();
            $table->string('motto',300)->nullable();
            $table->string('photo',300)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('birthdate');
            $table->dropColumn('profession');
            $table->dropColumn('interest');
            $table->dropColumn('motto');
            $table->dropColumn('photo');
        });
    }
}
