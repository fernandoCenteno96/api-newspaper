<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->Increments('id');
            $table->string('title');
            $table->text('content');
            $table->string('image');

            
            $table->unsignedInteger('users_id'); 
            $table->foreign('users_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');

            $table->unsignedInteger('categorys_id');
            $table->foreign('categorys_id')->references('id')->on('categorys')->onDelete('restrict')->onUpdate('restrict');

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
        Schema::dropIfExists('posts');
    }
}
