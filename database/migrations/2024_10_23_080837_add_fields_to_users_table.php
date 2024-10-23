<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if(
            !Schema::hasTable('users') ||
            (Schema::hasColumn('users', 'phone_number') &&
            Schema::hasColumn('users', 'subscription_type'))
        )
        {
            return;
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->after('email');
            $table->enum('subscription_type', ['free', 'premium'])->after('phone_number');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone_number');
            $table->dropColumn('subscription_type');
        });
    }
};
