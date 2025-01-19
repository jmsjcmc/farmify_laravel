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
        Schema::create('farm_owners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('farm_name');
            $table->string('farm_address');
            $table->string('farm_size');
            $table->string('farm_type');
            $table->string('contact_number');
            $table->text('farm_description')->nullable();
            $table->string('business_permit_number')->unique();
            $table->string('business_permit_image');
            $table->string('valid_id_type');
            $table->string('valid_id_number')->unique();
            $table->string('valid_id_image');
            $table->enum('status', ['Pending', 'Approved', 'Rejected'])->default('Pending');
            $table->text('rejection_reason')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->foreignId('approved_by')->nullable()->constrained('users');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('farm_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_owner_id')->constrained()->onDelete('cascade');
            $table->string('image_path');
            $table->string('caption')->nullable();
            $table->timestamps();
        });

        Schema::create('farm_certifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_owner_id')->constrained()->onDelete('cascade');
            $table->string('certification_type');
            $table->string('certification_number')->unique();
            $table->string('certification_image');
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->timestamps();
        });

        Schema::create('farm_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_owner_id')->constrained()->onDelete('cascade');
            $table->string('product_name');
            $table->string('product_type');
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('unit');
            $table->integer('available_quantity');
            $table->string('product_image')->nullable();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('farm_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_owner_id')->constrained()->onDelete('cascade');
            $table->string('activity_type');
            $table->text('description');
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->boolean('is_recurring')->default(false);
            $table->string('recurrence_pattern')->nullable();
            $table->timestamps();
        });

        Schema::create('farm_facilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_owner_id')->constrained()->onDelete('cascade');
            $table->string('facility_name');
            $table->text('description')->nullable();
            $table->string('facility_type');
            $table->integer('capacity')->nullable();
            $table->string('facility_image')->nullable();
            $table->boolean('is_operational')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm_facilities');
        Schema::dropIfExists('farm_schedules');
        Schema::dropIfExists('farm_products');
        Schema::dropIfExists('farm_certifications');
        Schema::dropIfExists('farm_images');
        Schema::dropIfExists('farm_owners');
    }
};
