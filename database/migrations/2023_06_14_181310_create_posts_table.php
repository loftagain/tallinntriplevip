<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('photo');
            $table->text('visit_description');
            $table->string('author_name')->default('Unknown')->nullable();
            $table->unsignedBigInteger('user_id'); 
            $table->foreign('user_id')->references('id')->on('users'); 
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
