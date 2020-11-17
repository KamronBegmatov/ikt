<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apples', function (Blueprint $table) {
            $table->id();
            $table->string('color');
            $table->dateTime('date_of_falling')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('percentage')->unsigned()->default(0);
            $table->timestamps();
        });
        return redirect('/dashboard');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apples');
    }
}
