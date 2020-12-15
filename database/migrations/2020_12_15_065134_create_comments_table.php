<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->longText('comment');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // foreignkey for user table

            $table->string('commentable_type'); // Eloquent Polymorphic
            $table->integer('commentable_id');  // Eloquent Polymorphic

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
        Schema::dropIfExists('comments');
    }
}
