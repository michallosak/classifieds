<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('email')->unique();
            $table->string('email_two')->unique()->nullable();
            $table->string('phone_priv')->nullable();
            $table->string('phone_company')->nullable();
            $table->string('city')->nullable();
            $table->string('post_code')->nullable();
            $table->string('country')->nullable();
            $table->string('street')->nullable();
            $table->string('number_local')->nullable();
            $table->string('number_home')->nullable();
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
        Schema::dropIfExists('contacts');
    }
}
