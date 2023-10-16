<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersInOrganizationsTable extends Migration
{
    public function up(): void
    {
        Schema::create('users_in_organizations', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user');
            $table->unsignedBigInteger('organization');

            $table
                ->foreign('user')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table
                ->foreign('organization')
                ->references('id')
                ->on('organizations')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_in_organizations');
    }
}
