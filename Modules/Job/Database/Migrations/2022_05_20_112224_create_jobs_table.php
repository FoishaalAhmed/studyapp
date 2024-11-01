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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_category_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('company')->nullable();
            $table->string('location')->nullable();
            $table->date('end_date');
            $table->text('description')->nullable();
            $table->string('photo')->nullable();
            $table->bigInteger('user_id')->nullable()->index('jobs_user_id_idx');
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
        Schema::dropIfExists('jobs');
    }
};
