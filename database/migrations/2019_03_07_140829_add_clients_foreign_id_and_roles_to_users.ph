<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClientsForeignIdAndRolesToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('company');
            $table->UnsignedInteger('clients_id');
            $table->foreign('clients_id')->references('id')->on('clients');
            $table->string('roles')->default('user');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            if (Schema::hasColumn('clients_id')) {
                $table->dropColumn('clients_id');
            }
            if (Schema::hasColumn('roles')) {
                $table->dropColumn('roles');
            }
        });
    }
}
