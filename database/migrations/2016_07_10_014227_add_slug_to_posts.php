<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSlugToPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        Schema::('posts', function($table){
            $table->string('slug')->unique()->after('body');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){

        Schema::table('posts', function($table){
            $table->dropColumn('slugs');

        });
    }
}
