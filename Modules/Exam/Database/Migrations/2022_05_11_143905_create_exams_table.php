<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('exam_type', 20);
            $table->string('chapter')->nullable();
            $table->string('title');
            $table->float('mark_per_question', 3,2);
            $table->float('negative_mark', 3,2);
            $table->integer('time');
            $table->date('start_date')->nullable();
            $table->time('start_time')->nullable();
            $table->date('result_date')->nullable();
            $table->time('result_time')->nullable();
            $table->text('note')->nullable();
            $table->string('type')->default('Free')->comment('Free,Premium');
            $table->float('price', 11, 2)->nullable();
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
        Schema::dropIfExists('exams');
    }
};
