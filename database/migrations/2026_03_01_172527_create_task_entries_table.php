<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('task_entries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('task_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('entry_date');

            $table->unsignedInteger('actual_value');

            $table->timestamps();

            $table->unique(['task_id', 'entry_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('task_entries');
    }
};
