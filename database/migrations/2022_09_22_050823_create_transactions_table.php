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
            $table->string('tracking');
            $table->foreignId('user_id')->constrained()->references('id')->on('users')->onDelete('cascade');
            $table->longText('alamat');
            $table->integer('quantity');
            $table->integer('transaction_total');
            $table->string('bank');
            $table->string('rekening');
            $table->enum('transaction_status',['PENDING','FAILED','SUCCESS']);
            $table->timestamp('read_at')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
