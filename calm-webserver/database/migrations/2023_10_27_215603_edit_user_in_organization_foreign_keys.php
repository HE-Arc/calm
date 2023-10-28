<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EditUserInOrganizationForeignKeys extends Migration
{
    public function up(): void
    {
        Schema::table('users_in_organizations', function (Blueprint $table) {
            $table->dropForeign(['user']);
            $table->renameColumn('user', 'user_id');
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->dropForeign(['organization']);
            $table->renameColumn('organization', 'organization_id');
            $table
                ->foreign('organization_id')
                ->references('id')
                ->on('organizations')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

        });
    }

    public function down(): void
    {
        Schema::table('users_in_organizations', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->renameColumn('user_id', 'user');
            $table
                ->foreign('user')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->dropForeign(['organization_id']);
            $table->renameColumn('organization_id', 'organization');
            $table
                ->foreign('organization')
                ->references('id')
                ->on('organizations')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }
}
