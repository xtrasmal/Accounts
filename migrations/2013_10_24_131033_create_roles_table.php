<?php

use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration {

	public function up()
	{
	    Schema::create('roles', function($table)
	    {
	        $table->increments('id');
			$table->string('role');
	    });
	}

	public function down()
	{
	    Schema::drop('roles');
	}

}
