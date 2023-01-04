<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOldCountersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('old_counters', function (Blueprint $table) {
            $table->id();
            $table->json('completedacs')->nullable();
            $table->json('restartacs')->nullable();
            $table->json('launchedacs')->nullable();
            $table->json('duplicateacs')->nullable();
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('old_counters');
    }
}
