<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditMachineForeignKeys extends Migration
{
    public function up(): void
    {
        Schema::table('machines', function (Blueprint $table) {
            $table->dropForeign(['laundry']);
            $table->renameColumn('laundry', 'laundry_id');
            $table
                ->foreign('laundry_id')
                ->references('id')
                ->on('laundries')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('machines', function (Blueprint $table) {
            $table->dropForeign(['laundry_id']);
            $table->renameColumn('laundry_id', 'laundry');
            $table
                ->foreign('laundry')
                ->references('id')
                ->on('laundries')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }
}
