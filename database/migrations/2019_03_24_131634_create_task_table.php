<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 100);
            $table->string('instruction', 255);
            $table->string('attachment_url');
            $table->datetime('date_created_at');
            $table->datetime('date_completed_at')->nullable();
            $table->string('status');

            $table->integer('priority');
            $table->integer('id_owner_user');
            $table->string('objectsAnnotate')->nullable();
            $table->boolean('callback_succeded')->default(false);
            $table->boolean('with_label')->default(false);
            $table->integer('min_heigth')->nullable();
            $table->integer('min_width')->nullable();
            $table->string('metadata')->nullable();
            $table->string('label')->nullable();
            $table->boolean('actived')->default(true);
            $table->string('callback_url')->nullable();

            $table->integer('id_project')->unsigned();
            $table->foreign('id_project')->references('id')->on('projects');


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
        Schema::dropIfExists('tasks');
    }
}
