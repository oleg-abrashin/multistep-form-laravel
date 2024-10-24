<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressAndPaymentToUsersTable extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Address fields
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();

            // Payment information (for Premium users)
            $table->string('credit_card_number')->nullable();
            $table->string('expiration_date')->nullable();
            $table->string('cvv')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'address_line_1', 'address_line_2', 'city', 'postal_code', 'state', 'country',
                'credit_card_number', 'expiration_date', 'cvv'
            ]);
        });
    }
}
