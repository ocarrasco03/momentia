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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('description');
            $table->enum('event_type', ['xv', 'wedding']);
            $table->timestamp('starts_at');
            $table->timestamp('ends_at');
            $table->timestamp('expires_at')->index()->nullable();
            $table->string('location');
            $table->longText('address');
            $table->enum('status', ['draft', 'quoted', 'qualified', 'contracted', 'active', 'expired', 'cancelled', 'ended'])->default('active');
            $table->string('created_by');
            $table->string('updated_by');
            $table->timestamps();
        });

        Schema::create('event_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->enum('role', ['owner', 'coordinator', 'admin', 'designer', 'user', 'staff'])->default('owner');
            $table->timestamps();

            $table->unique(['event_id', 'user_id']);

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::create('event_status_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained();
            $table->enum('from_status', ['draft', 'quoted', 'qualified', 'contracted', 'active', 'expired', 'cancelled', 'ended'])->nullable();
            $table->enum('to_status', ['draft', 'quoted', 'qualified', 'contracted', 'active', 'expired', 'cancelled', 'ended']);
            $table->longText('reason')->nullable();
            $table->string('updated_by');

            $table->timestamps();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
        Schema::dropIfExists('event_user');
    }
};
