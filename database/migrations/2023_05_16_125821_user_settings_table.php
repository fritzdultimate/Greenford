<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->boolean('dark_mode')->default(false);
            $table->boolean('transaction_emails')->default(true);
            $table->boolean('twofac')->default(false);
            $table->boolean('use_pin_for_transaction')->default(false);
            $table->string('front_kyc')->nullable();
            $table->string('back_kyc')->nullable();
            $table->enum('current_kyc_level', ['tier 1', 'tier 2', 'tier 3'])->default('tier 1');
            $table->string('address_proof')->nullable();
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_settings');
    }
}
