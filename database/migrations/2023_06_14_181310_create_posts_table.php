<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


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
            $table->dateTime('submitted_at');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
            $table->integer('votes')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
