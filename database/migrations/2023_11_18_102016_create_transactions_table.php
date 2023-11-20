<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->unsignedBigInteger('account_id');
            $table->enum('transaction_type', ['deposit', 'withdrawal', 'transfer']);
            $table->enum('transaction_mode', ['credit', 'debit']);
            $table->decimal('amount', 15, 2);
            $table->decimal('balance', 15, 2);
            $table->timestamp('transaction_date')->useCurrent();
            $table->text('description')->nullable();
            $table->string('reference_number')->nullable();
            $table->timestamps();

            // Foreign key relationship
            $table->foreign('account_id')->references('id')->on('users');
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
};
