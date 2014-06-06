<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	public function up()
	{
	    Schema::create('users', function($t)
	    {
	        $t->increments('id');
	        $t->string('email')->unique();
	        $t->string('password');
	        $t->string('name');
            $t->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $t->timestamp('updated_at');
            $t->softDeletes();
	    });
	}

	public function down()
	{
	    Schema::drop('users');
	}

}
