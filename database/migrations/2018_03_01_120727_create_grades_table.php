<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGradesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grades', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('class_id')->default(0)->nullable();
            $table->integer('section_id')->default(0)->nullable();
            $table->integer('subject_id')->default(0)->nullable();
            $table->integer('student_id')->default(0)->nullable();
            $table->decimal('first_grading')->default(0)->nullable();
            $table->decimal('second_grading')->default(0)->nullable();
            $table->decimal('third_grading')->default(0)->nullable();
            $table->decimal('fourth_grading')->default(0)->nullable();
            $table->decimal('average')->default(0)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grades');
    }
}
