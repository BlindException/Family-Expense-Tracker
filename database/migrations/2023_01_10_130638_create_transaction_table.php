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
            $table->string('title');
            $table->string('details')->nullable();
            $table->decimal('amount');
            $table->dateTime('paid_at');
            $table->foreignId('transaction_type_id')->references('id')->on('transaction_types');
            $table->foreignId('transaction_category_id')->references('id')->on('transaction_categories');
            $table->foreignId('creator_id')->references('id')->on('users');
            $table->integer('owner_id');
            $table->string('owner_type');
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
        Schema::dropIfExists('transaction');
    }
};
