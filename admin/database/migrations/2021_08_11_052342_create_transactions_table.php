<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('qrcode_owner_id')->nullable();
            $table->integer('qrcode_id');
            $table->string('payment_method')->nullable();
            $table->longText('message')->nullable();
            $table->float('amount', 10, 4);
            $table->string('status')->default('initiated');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('qrcode_owner_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('qrcode_id')
                ->references('id')
                ->on('qr_codes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
