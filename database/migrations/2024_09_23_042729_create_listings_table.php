<?php

use App\Http\Enums\ListingStatus;
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
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->decimal('rent', 10, 2)->nullable();
            $table->string('rent_type')->nullable(); // monthly, weekly, daily, negotiable
            $table->boolean('require_deposit')->default(false);
            $table->string('deposit_amount')->nullable(); // amount in nepali rupees

            $table->string('location')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->default('Nepal');
            $table->decimal('latitude', 3, 8)->nullable();
            $table->decimal('longitude', 3, 8)->nullable();
            $table->string('nearest_landmark')->nullable();
            
            $table->string('property_type')->nullable(); // room, flat, house

            $table->string('preferred_tenants')->nullable(); // couple, family, single, student
            $table->string('preferred_tenant_gender')->nullable(); // male, female, both, no preference
            $table->string('preferred_tenant_age')->nullable(); // 18-25, 25-35, 35-45, 45-55, 55-65, no preference
            $table->string('preferred_tenant_occupation')->nullable(); // student, professional, business, no preference
            $table->string('preferred_tenant_religion')->nullable(); // hindu, buddhist, christian, muslim, no preference
            $table->string('preferred_tenant_nationality')->nullable(); // nepali, indian, chinese, no preference

            $table->string('furnishing_type')->nullable(); // unfurnished, furnished, semi-furnished
            $table->string('property_age')->nullable(); // new, old
            $table->string('property_condition')->nullable(); // good, bad, average

            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->integer('max_guests')->nullable();
            
            $table->boolean('is_available')->default(true);
            $table->string('available_from')->nullable(); // can be date, or from one week, from one month, flexible
            
            $table->decimal('cleaning_fee', 8, 2)->nullable();
            $table->decimal('water_bill', 8, 2)->nullable();
            $table->decimal('electricity_rate', 8, 2)->nullable();
            
            $table->string('minimum_stay')->nullable(); // no of days, weeks, months or no minimum stay
            $table->string('min_stay_type')->nullable(); // can be day, week, month
            
            $table->string('cancellation_policy')->nullable();
            $table->json('amenities')->nullable();
            $table->json('house_rules')->nullable();

            $table->string('status')->default(ListingStatus::DRAFT->value); // draft, published, expired, deleted

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
