<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateApptablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id('season_id');
            $table->timestamp('start_date')->useCurrent();
            $table->timestamp('end_date')->nullable();
        });

        Schema::create('taxes', function (Blueprint $table) {
            $table->id('tax_id');
            $table->unsignedBigInteger('season_id')->nullable();
            $table->foreign('season_id')->references('season_id')->on('seasons')->onUpdate('cascade')->onDelete('set null');
            $table->string('name', 50);
            $table->double('amount');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->timestamp('date')->useCurrent();
        });

        Schema::create('material_expenses', function (Blueprint $table) {
            $table->id('material_expense_id');
            $table->unsignedBigInteger('season_id')->nullable();
            $table->foreign('season_id')->references('season_id')->on('seasons')->onUpdate('cascade')->onDelete('set null');
            $table->string('name', 50);
            $table->double('quantity');
            $table->string('unit', 50)->nullable();
            $table->double('price_per_unit');
            $table->double('cost');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->timestamp('date')->useCurrent();
        });

        Schema::create('laborers', function (Blueprint $table) {
            $table->id('laborer_id');
            $table->string('name', 50);
            $table->string('address', 50);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
        });

        Schema::create('labor_wages', function (Blueprint $table) {
            $table->id('labor_wage_id');
            $table->unsignedBigInteger('season_id')->nullable();
            $table->foreign('season_id')->references('season_id')->on('seasons')->onUpdate('cascade')->onDelete('set null');
            $table->unsignedBigInteger('laborer_id')->nullable();
            $table->foreign('laborer_id')->references('laborer_id')->on('laborers')->onUpdate('cascade')->onDelete('set null');
            $table->string('task', 50)->nullable();
            $table->double('wage');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->timestamp('date')->useCurrent();
        });

        Schema::create('revenues', function (Blueprint $table) {
            $table->id('revenue_id');
            $table->unsignedBigInteger('season_id')->nullable();
            $table->foreign('season_id')->references('season_id')->on('seasons')->onUpdate('cascade')->onDelete('set null');
            $table->double('quantity');
            $table->string('unit', 50)->nullable();
            $table->integer('kilo_per_unit');
            $table->double('price_per_kilo');
            $table->double('total_price');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->timestamp('date')->useCurrent();
        });

        Schema::create('yields', function (Blueprint $table) {
            $table->id('yield_id');
            $table->unsignedBigInteger('season_id')->nullable();
            $table->foreign('season_id')->references('season_id')->on('seasons')->onUpdate('cascade')->onDelete('set null');
            $table->double('quantity');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->timestamp('date')->useCurrent();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seasons');
        Schema::dropIfExists('taxes');
        Schema::dropIfExists('materialExpenses');
        Schema::dropIfExists('laborers');
        Schema::dropIfExists('laborWages');
        Schema::dropIfExists('revenues');
        Schema::dropIfExists('yields');
    }
}
