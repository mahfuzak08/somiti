<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->enum('user_type', ['User', 'Nominee']);
            $table->enum('address_type', ['Present', 'Permanent', 'Office', 'Business']);
            $table->text('full_address');
            $table->string('division', 40)->nullable();
            $table->string('district', 40)->nullable();
            $table->string('city', 40)->nullable();
            $table->string('zip', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
