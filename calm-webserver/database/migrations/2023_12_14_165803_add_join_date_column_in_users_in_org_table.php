<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJoinDateColumnInUsersInOrgTable extends Migration
{
    public function up(): void
    {
        Schema::table('users_in_organizations', function (Blueprint $table) {
            $table->dateTime('joined_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users_in_organizations', function (Blueprint $table) {
            $table->dropColumn('joined_at');
        });
    }
}
