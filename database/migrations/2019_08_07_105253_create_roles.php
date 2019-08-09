<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key_id')->unique()->default(null);
            $table->boolean('admin')->default(true);
            $table->boolean('user')->default(false);
            $table->boolean('putzfrau')->default(false);
            $table->boolean('hausmeister')->default(false);
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
        Schema::dropIfExists('roles');
    }
}
