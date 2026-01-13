<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('comments', function (Blueprint $table) {
      $table->id();
      $table->string('name')->nullable();
      $table->string('email')->nullable();
      $table->string('subject')->nullable();
      $table->text('commentBody')->nullable();
      $table->bigInteger('blog_id')->unsigned()->nullable();
      $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
      $table->bigInteger('user_id')->unsigned()->nullable();
      $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('comments');
  }
};
