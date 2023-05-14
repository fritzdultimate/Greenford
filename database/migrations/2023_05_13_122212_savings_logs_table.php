<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SavingsLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('savings_id');
            $table->decimal('amount');
            $table->string('transaction_id');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();

            $table->foreign('savings_id')->references('id')->on('savings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('savings_logs');
    }
}
