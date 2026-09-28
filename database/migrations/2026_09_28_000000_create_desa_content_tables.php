<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id(); $table->string('title'); $table->string('slug')->unique(); $table->text('description'); $table->string('icon')->nullable(); $table->unsignedInteger('sort_order')->default(0); $table->boolean('published')->default(true); $table->timestamps();
        });
        Schema::create('posts', function (Blueprint $table) {
            $table->id(); $table->string('type')->default('news'); $table->string('title'); $table->string('slug')->unique(); $table->string('excerpt')->nullable(); $table->longText('body')->nullable(); $table->string('image')->nullable(); $table->date('published_at')->nullable(); $table->boolean('published')->default(false); $table->timestamps();
        });
        Schema::create('gallery_items', function (Blueprint $table) {
            $table->id(); $table->string('title'); $table->string('image'); $table->string('category')->nullable(); $table->boolean('published')->default(true); $table->timestamps();
        });
        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id(); $table->string('name', 120); $table->string('email', 160)->nullable(); $table->text('message'); $table->boolean('read')->default(false); $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_messages'); Schema::dropIfExists('gallery_items'); Schema::dropIfExists('posts'); Schema::dropIfExists('services');
    }
};
