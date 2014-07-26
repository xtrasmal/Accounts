<?php

use Illuminate\Database\Migrations\Migration;

class CreateTenantUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tenant_user', function($table)
		{
            $table->increments('id');
            $table->string('tenant_id', 36);
            $table->string('user_id', 36);

            $table->foreign('tenant_id')->references('id')->on('tenants')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('tenant_user');
	}

}
