<?php

use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration {

	public function up()
	{
	    Schema::create('groups', function($t)
	    {
	        $t->increments('id');
			$t->string('name');
	    });
	}

	public function down()
	{
	    Schema::drop('groups');
	}

}
