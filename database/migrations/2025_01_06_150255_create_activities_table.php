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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('title');
            $table->string('slug');

            $table->foreignId('group_id')->constrained('groups')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('position_id')->constrained('positions')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('scope_id')->constrained('scopes')->cascadeOnDelete()->cascadeOnUpdate();

            $table->integer('total_estimate');
            $table->enum('type_estimate', ['hour', 'day', 'week', 'month', 'year'])->nullable();
            $table->date('forecast_date')->nullable();
            $table->date('plan_date')->nullable();
            $table->date('actual_date')->nullable();

            $table->foreignId('supervisor_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate()->comment('Get from users table');
            $table->text('description')->nullable();
            $table->integer('progress')->default(0);

            $table->foreignId('status_id')->constrained('status_activities')->cascadeOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
