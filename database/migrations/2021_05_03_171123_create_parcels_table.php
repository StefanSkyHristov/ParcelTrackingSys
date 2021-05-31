<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parcels', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('tracking_number')->unique();
            $table->string('sender_name');
            $table->string('recipient_name');
            $table->string('sender_address');
            $table->string('recipient_address');
            $table->string('sender_contact');
            $table->string('recipient_contact');
            $table->integer('delivery_type')->unsigned()->default(0);
            $table->integer('length')->unsigned();
            $table->integer('weight')->unsigned();
            $table->integer('width')->unsigned();
            $table->integer('height')->unsigned();
            $table->integer('price')->unsigned();
            $table->integer('updated_by');
            $table->integer('status')->unsigned()->default(0);
            $table->string('status_description')->default('Submitted for Collection');
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
        Schema::dropIfExists('parcels');
    }
}
