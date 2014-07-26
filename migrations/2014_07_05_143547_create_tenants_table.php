<?php

use Illuminate\Database\Migrations\Migration;

class CreateTenantsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('tenants', function($t)
        {
            $t->string('id', 36)->primary();
            $t->string('owner_id', 36)->nullable();
            $t->string('domain_name');
            $t->boolean('confirmed')->default(false);
            $t->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $t->timestamp('updated_at');
            $t->softDeletes();
            $t->foreign('owner_id')->references('id')->on('users')->onDelete(DB::raw('set null'));
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('tenants');
	}

}
