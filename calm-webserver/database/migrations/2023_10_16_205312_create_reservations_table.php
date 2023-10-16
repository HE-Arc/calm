<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->timestamp('start');
            $table->timestamp('stop');
            $table->unsignedBigInteger('machine');
            $table->unsignedBigInteger('user');

            $table
                ->foreign('machine')
                ->references('id')
                ->on('machines')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table
                ->foreign('user')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
}
