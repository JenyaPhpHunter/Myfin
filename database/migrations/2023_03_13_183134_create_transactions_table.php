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
            $table->unsignedBigInteger('users_id');
            $table->decimal('amount', 10, 2);
            $table->string('type');
            $table->timestamp('date');
            $table->unsignedBigInteger('expenses_id');
            $table->unsignedBigInteger('incomes_id');

            $table->foreign('expenses_id')->references('id')->on('expenses');
            $table->foreign('incomes_id')->references('id')->on('incomes');
            $table->foreign('users_id')->references('id')->on('users')->onDelete('cascade');
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
