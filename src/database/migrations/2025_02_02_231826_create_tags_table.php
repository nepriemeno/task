<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->unique(['product_id', 'title']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
