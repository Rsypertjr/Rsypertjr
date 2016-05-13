<?php

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
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->integer('activeCampaignListId');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('extraDetail1')->nullable();
            $table->string('extraDetail2')->nullable();
            $table->string('extraDetail3')->nullable();
            $table->string('extraDetail4')->nullable();
            $table->string('extraDetail5')->nullable();
            $table->integer('exDet1NoteId')->nullable();
            $table->integer('exDet2NoteId')->nullable();
            $table->integer('exDet3NoteId')->nullable();
            $table->integer('exDet4NoteId')->nullable();
			$table->integer('noExtraDetails');
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
        Schema::drop('users');
    }
}
