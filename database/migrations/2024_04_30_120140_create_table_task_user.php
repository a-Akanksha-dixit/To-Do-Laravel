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
        Schema::create('task_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained(table : 'users', indexName:'id')
            ->name('task_user_user_id_foreign')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('task_id')->constrained(table : 'tasks', indexName:'id')
            ->name('task_user_task_id_foreign')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_task_user');
    }
};
