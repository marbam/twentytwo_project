<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLearningsAndDrinkFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('date_entries', function (Blueprint $table) {
            $table->text('learnings')->after('books');
            $table->boolean('alcohol')->default(false)->after('walked');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('date_entries', function (Blueprint $table) {
            $table->dropColumn('learnings');
            $table->dropColumn('alcohol');
        });
    }
}
