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
            $table->id();
            $table->longText('message');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // foreignkey for user table

            $table->boolean('active')->default(0);
            $table->text('image')->nullable();

            $table->timestamps();
            $table->softDeletes(); // Recycle Bin with Soft Delete
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
