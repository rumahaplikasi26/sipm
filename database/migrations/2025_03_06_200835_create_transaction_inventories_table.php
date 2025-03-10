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
        Schema::create('transaction_inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inventory_id')->constrained()->cascadeOnDelete();
            $table->foreignId('supervisor_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('employee_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->foreignId('group_id')->nullable()->constrained('groups')->nullOnDelete();
            $table->integer('quantity')->default(1);
            $table->boolean('is_group')->default(false);
            $table->enum('condition', ['good', 'bad', 'broken'])->default('good');

            $table->dateTime('borrow_date')->nullable();
            $table->dateTime('return_date')->nullable();

            $table->text('description')->nullable();

            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_inventories');
    }
};
