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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id();
            $table->string('client'); // Nome ou identificação do cliente
            $table->dateTime('budget_datetime'); // Data e hora do orçamento
            $table->string('seller'); // Nome do vendedor
            $table->text('description'); // Descrição do orçamento
            $table->decimal('estimated_value', 10, 2); // Valor orçado
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
        Schema::dropIfExists('budgets');
    }
};
