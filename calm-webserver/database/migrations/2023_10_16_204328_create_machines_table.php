<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMachinesTable extends Migration
{
    public function up(): void
    {
        Schema::create('machines', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description');
            $table->unsignedBigInteger('laundry');
            $table->enum('type', ['wash', 'dry']);

            $table
                ->foreign('laundry')
                ->references('id')
                ->on('laundries')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('machines');
    }
}
