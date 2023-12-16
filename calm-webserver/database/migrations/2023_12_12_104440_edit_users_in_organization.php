<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditUsersInOrganization extends Migration
{
    public function up(): void
    {
        Schema::table('users_in_organizations', function (Blueprint $table) {
            $table->unsignedBigInteger('invitation_id')->nullable();
            $table
                ->foreign('invitation_id')
                ->references('id')
                ->on('invitations')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users_in_organizations', function (Blueprint $table) {
            $table->dropColumn('invitation_id');
        });
    }
}
