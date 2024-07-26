<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->increments("id");
            $table->string('name');
            $table->date('dob');
            $table->enum('gender', ['male', 'female']);
            $table->string('nationality');
            $table->string('cv');
            $table->integer('status')->default(0);
            $table->integer('coordinator')->default(0);
            $table->date('coordinator_date')->nullable();
            $table->integer('manager')->default(0);
            $table->date('manager_date')->nullable();
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
        Schema::dropIfExists('applicants');
    }
}
