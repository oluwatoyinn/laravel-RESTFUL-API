<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AmbassadorGuarantorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('ambassador_guarantors');
        Schema::create('ambassador_guarantors', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->enum('gender',['male','female']);
            $table->string('passport');
            $table->string('age');
            $table->string('phone_number');
            $table->text('occupation');
            $table->text('office_address');
            $table->text('home_address');
            $table->foreignId('ambassador_id');
            $table->foreign('ambassador_id')->references('id')->on('ambassadors');

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
        Schema::dropIfExists('ambassador_guarantors');
    }
}
