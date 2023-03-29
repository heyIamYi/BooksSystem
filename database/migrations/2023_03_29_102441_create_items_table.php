<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            $table->char('name', 20)->comment('書名');
            $table->string('image')->comment('書本圖片');
            $table->longtext('description')->comment('書本描述');
            $table->longtext('introduction')->comment('書本簡介');
            $table->integer('quantity')->comment('數量');
            $table->integer('price')->nullable()->comment('價格');
            $table->integer('user_id')->comment('上架者id');

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
        Schema::dropIfExists('items');
    }
};
