<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuizTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
	 
	
    public function up()
    {
        Schema::create('quiz', function (Blueprint $table) {
			$table->increments('id');
			$table->unsignedInteger('user_id');
			$table->string('name');
			$table->string('duration');
			$table->string('duration_type');
			$table->integer('resumable');
			$table->integer('published');
			
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
        Schema::dropIfExists('quiz');
    }
}
