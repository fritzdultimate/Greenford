<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserAccountDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_account_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('account_number');
            $table->unsignedDecimal('total_balance')->default(0.00);
            $table->unsignedDecimal('savings')->default(0.00);
            $table->unsignedDecimal('expenses')->default(0.00);
            $table->unsignedDecimal('account_balance')->default(0.00);
            $table->unsignedDecimal('total_bills')->default(0.00);
            $table->unsignedDecimal('total_incoming')->default(0.00);
            $table->unsignedDecimal('total_outgoing')->default(0.00);
            $table->unsignedDecimal('total_sent_out')->default(0.00);
            $table->unsignedDecimal('total_received')->default(0.00);
            $table->enum('kyc_level', ['tier 1', 'tier 2', 'tier 3'])->default('tier 1');
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
        Schema::dropIfExists('user_account_data');
    }
}
