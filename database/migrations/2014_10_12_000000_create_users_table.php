<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('is_admin')->default(false);
            $table->string('password');
            $table->string('visible_password');
            $table->rememberToken();
            $table->string('dob');
            $table->string('father_name');
            $table->enum('marital_status', ['single', 'married', 'divorced', 'widow', 'widower'])->default('single');
            $table->string('nationality');
            $table->string('monthly_income');
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('city');
            $table->string('zip_code');
            $table->string('mobile_number');
            $table->enum('account_type', ["savings account", "current account", "bussiness account", "joint account"])->default("savings account");
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('mother_maiden_name');
            $table->string('spouse_name');
            $table->string('occupation');
            $table->string('source_of_income');
            $table->string('state');
            $table->string('country');
            $table->boolean('suspended')->default(false);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('is_twenty_four_hours')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
