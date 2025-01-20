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
        Schema::create('farm_jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_owner_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->enum('job_type', ['Farm Manager', 'Laborer']);
            $table->text('description');
            $table->text('requirements');
            $table->text('responsibilities');
            $table->decimal('salary_from', 10, 2);
            $table->decimal('salary_to', 10, 2);
            $table->enum('salary_type', ['Per Hour', 'Per Day', 'Per Month']);
            $table->integer('vacancies')->default(1);
            $table->string('employment_type'); // Full-time, Part-time, Contract, etc.
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('location');
            $table->text('benefits')->nullable();
            $table->enum('status', ['Draft', 'Published', 'Closed'])->default('Draft');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('farm_job_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_job_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('cover_letter')->nullable();
            $table->string('resume_path');
            $table->enum('status', ['Pending', 'Shortlisted', 'Interviewed', 'Offered', 'Hired', 'Rejected'])
                  ->default('Pending');
            $table->text('notes')->nullable();
            $table->timestamp('interview_date')->nullable();
            $table->decimal('offered_salary', 10, 2)->nullable();
            $table->enum('offered_salary_type', ['Per Hour', 'Per Day', 'Per Month'])->nullable();
            $table->timestamp('hiring_date')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('farm_job_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('farm_job_id')->constrained()->onDelete('cascade');
            $table->string('skill_name');
            $table->enum('skill_level', ['Beginner', 'Intermediate', 'Advanced'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farm_job_skills');
        Schema::dropIfExists('farm_job_applications');
        Schema::dropIfExists('farm_jobs');
    }
};
