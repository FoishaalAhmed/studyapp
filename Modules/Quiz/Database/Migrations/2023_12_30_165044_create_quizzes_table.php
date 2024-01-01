<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('restrict');
            $table->string('title', 255);
            $table->string('type', 10)->index('quizzes_type_idx')->default('Free')->comment('Free, Premium');
            $table->float('price', 11, 2);
            $table->string('status')->index('quizzes_status_idx')->default('In Review')->comment('Published, In Review');
            $table->bigInteger('user_id')->index('quizzes_user_id_idx');
            $table->string('photo')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('quizzes');
    }
};
