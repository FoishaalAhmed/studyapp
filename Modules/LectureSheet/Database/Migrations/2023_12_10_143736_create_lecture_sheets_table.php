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
        Schema::create('lecture_sheets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->string('chapter');
            $table->string('file');
            $table->string('thumb')->nullable();
            $table->string('type', 10)->default('Free')->comment('Free,Premium');
            $table->float('price', 11, 2)->nullable();
            $table->string('status', 10)->default('In Review')->comment('Published, In Review');
            $table->bigInteger('user_id')->nullable()->index('lecture_sheets_user_id_idx');
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
        Schema::dropIfExists('lecture_sheets');
    }
};
