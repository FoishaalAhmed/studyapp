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
        Schema::create('model_tests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('user_id');
            $table->string('title');
            $table->year('year')->nullable();
            $table->integer('time');
            $table->string('type', 10)->default('Premium')->comment('Free,Premium')->index('model_tests_type_idx');
            $table->float('price', 11, 2)->nullable();
            $table->string('draft', 3)->default('Yes')->comment('Yes,No')->index('model_tests_draft_idx');
            $table->string('photo')->nullable();
            $table->text('description')->nullable();
            $table->string('status', 10)->default('In Review')->comment('In Review,Published')->index('model_tests_status_idx');
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
        Schema::dropIfExists('model_tests');
    }
};
