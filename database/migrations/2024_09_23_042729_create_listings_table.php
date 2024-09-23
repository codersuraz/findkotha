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
        Schema::create('listings', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('title');
            $table->text('description');
            $table->string('address');
            $table->decimal('price', 10, 2);
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->integer('max_guests');
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->boolean('is_available')->default(true);
            $table->json('amenities')->nullable();
            $table->string('property_type');
            $table->integer('size')->comment('Size in square meters');
            $table->time('check_in_time')->nullable();
            $table->time('check_out_time')->nullable();
            $table->boolean('instant_book')->default(false);
            $table->decimal('cleaning_fee', 8, 2)->nullable();
            $table->integer('minimum_stay')->default(1);
            $table->string('cancellation_policy');
            $table->json('house_rules')->nullable();
            $table->foreignUlid('user_id')->constrained()->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
