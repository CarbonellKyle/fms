<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFmsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soil_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('soil_type_name', 50);
            $table->string('description', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('plant_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plant_category_name', 50);
            $table->string('description', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('plant_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plant_type_name', 50);
            $table->string('description', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('plants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plant_name', 50);
            $table->integer('category_id')->unsigned()->nullable();
            $table->foreign('category_id')->references('id')->on('plant_categories')->onUpdate('cascade')->onDelete('set null');
            $table->string('scientific_name', 100)->nullable();
            $table->string('variety', 50)->nullable();
            $table->integer('type_id')->unsigned()->nullable();
            $table->foreign('type_id')->references('id')->on('plant_types')->onUpdate('cascade')->onDelete('set null');
            $table->integer('noOfMonthsHarvestable');
            $table->string('description', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('diseases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('disease_name', 50);
            $table->string('description', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('batches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('plant_id')->unsigned()->nullable();
            $table->foreign('plant_id')->references('id')->on('plants')->onUpdate('cascade')->onDelete('set null');
            $table->datetime('startOfFarm');
            $table->datetime('expectedHarvestPeriodFrom');
            $table->datetime('expectedHarvestPeriodTo');
            $table->integer('quantity');
            $table->string('measurement', 50);
            $table->string('currentStage', 50)->nullable();
            $table->integer('quantityLoss')->default(0);
            $table->integer('price')->default(0);
            $table->string('remarks', 100)->nullable();
            $table->timestamps();
        });

        Schema::create('batch_disease', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('batch_id')->unsigned()->nullable();
            $table->foreign('batch_id')->references('id')->on('batches')->onUpdate('cascade')->onDelete('set null');
            $table->integer('disease_id')->unsigned()->nullable();
            $table->foreign('disease_id')->references('id')->on('diseases')->onUpdate('cascade')->onDelete('set null');
            $table->integer('noOfPlantsAffected');
            $table->string('status', 50);
            $table->timestamps();
        });

        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('batch_id')->unsigned()->nullable();
            $table->foreign('batch_id')->references('id')->on('batches')->onUpdate('cascade')->onDelete('set null');
            $table->string('activity_name', 50);
            $table->timestamps();
        });

        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_name', 50);
            $table->integer('quantityOnHand');
            $table->string('unit', 50);
            $table->timestamps();
        });

        Schema::create('activity_item', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('activity_id')->unsigned()->nullable();
            $table->foreign('activity_id')->references('id')->on('activities')->onUpdate('cascade')->onDelete('set null');
            $table->integer('item_id')->unsigned()->nullable();
            $table->foreign('item_id')->references('id')->on('items')->onUpdate('cascade')->onDelete('set null');
            $table->integer('stockOutItems');
            $table->timestamps();
        });

        Schema::create('activity_laborer', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('activity_id')->unsigned()->nullable();
            $table->foreign('activity_id')->references('id')->on('activities')->onUpdate('cascade')->onDelete('set null');
            $table->unsignedBigInteger('laborer_id')->nullable();
            $table->foreign('laborer_id')->references('laborer_id')->on('laborers')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('soil_types');
        Schema::dropIfExists('plant_categories');
        Schema::dropIfExists('plant_types');
        Schema::dropIfExists('plants');
        Schema::dropIfExists('diseases');
        Schema::dropIfExists('batches');
        Schema::dropIfExists('batch_disease');
        Schema::dropIfExists('daily_activities');
        Schema::dropIfExists('items');
        Schema::dropIfExists('activity_item');
        Schema::dropIfExists('activity_laborer');
    }
}
