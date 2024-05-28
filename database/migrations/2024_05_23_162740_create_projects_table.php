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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->text('description');
            $table->string('client', 255);
            $table->date('kickOffDate');
            $table->date('targetDate');
            $table->integer('budget');
            $table->bigInteger('creator_id')->nullable();
            $table->bigInteger('last_editor_id')->nullable();
            $table->bigInteger('organization_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
