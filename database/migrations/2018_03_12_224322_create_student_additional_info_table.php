<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAdditionalInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_additional_information', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('student_id')->default(0)->nullable();            

            $table->enum('gender',['male','female'])->nullable();
            $table->string('birthdate')->nullable();
            $table->integer('age_of_first_friday_june')->nullable();
            $table->string('mother_tounge')->nullable();
            $table->string('ip')->nullable();
            $table->string('religion')->nullable();

            //address
            $table->text('house_street')->nullable();
            $table->text('barangay')->nullable();
            $table->text('municipality')->nullable();
            $table->text('province')->nullable();

            //parents
            $table->text('fathers_name')->nullable();
            $table->text('mothers_name')->nullable();

            //guardian
            $table->text('guardian_name')->nullable();
            $table->text('relationship')->nullable();

            //remarks
            $table->text('remarks')->nullable();

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
        Schema::dropIfExists('student_additional_information');
    }
}
