<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModeOfStudysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mode_of_studys', function (Blueprint $table) {
            $table->engine ='InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->float('timing_factor')->unsigned();
            $table->softDeletes();
            $table->timestamps();
        }); 

        // Add Student and Enrolment Status to Student Record
        Schema::table('student_records', function($table) {
            $table->integer('mode_of_study_id')->unsigned()->index();
            $table->foreign('mode_of_study_id')->references('id')->on('mode_of_studys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_records', function (Blueprint $table) {
            $table->dropForeign('student_records_mode_of_study_id_foreign');
            $table->dropColumn('mode_of_study_id');
        });
        Schema::drop('mode_of_studys');
    }
}
