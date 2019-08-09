<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShelfKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shelfkeys', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('name','16')->unique();
            $table->text('description','255')->nullable();
            $table->smallInteger('shelfspace_id')->unique()->nullable()->default(null);
            $table->string('updated_by')->nullable()->default(null);
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
        Schema::dropIfExists('shelfkeys');
    }
}
