<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bkash_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('amount');
            $table->string('createTime');
            $table->string('currency');
            $table->string('customerMsisdn');
            $table->string('intent');
            $table->string('merchantInvoiceNumber');
            $table->string('paymentID');
            $table->string('transactionStatus');
            $table->string('trxID');
            $table->string('updateTime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bkash_transactions');
    }
};
