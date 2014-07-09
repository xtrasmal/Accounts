<?php

use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('accounts', function($t)
        {
            $t->increments('id');
            $t->string('name');
            $t->string('domain_name');
            $t->boolean('confirmed')->default(false);
            $t->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $t->timestamp('updated_at');
            $t->softDeletes();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('accounts');
	}

}
