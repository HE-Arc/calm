<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditReservationForeignKeys extends Migration
{
    public function up(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['user']);
            $table->renameColumn('user', 'user_id');
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->dropForeign(['machine']);
            $table->renameColumn('machine', 'machine_id');
            $table
                ->foreign('machine_id')
                ->references('id')
                ->on('machines')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->renameColumn('user_id', 'user');
            $table
                ->foreign('user')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->dropForeign(['machine_id']);
            $table->renameColumn('machine_id', 'machine');
            $table
                ->foreign('machine')
                ->references('id')
                ->on('machines')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }
}
