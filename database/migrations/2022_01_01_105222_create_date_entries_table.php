<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('date_entries', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedInteger('user_id');
            $table->boolean('populated')->default(false);
            $table->text('description')->default('');
            $table->text('highlight')->default('');
            $table->text('movies')->default('');
            $table->text('shows')->default('');
            $table->text('games')->default('');
            $table->text('books')->default('');
            $table->boolean('exercises')->default(false);
            $table->boolean('walked')->default(false);
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
        Schema::dropIfExists('date_entries');
    }
}
