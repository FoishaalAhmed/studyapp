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
        Schema::create('ebooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('child_category_id')->constrained()->onDelete('cascade');
            $table->foreignId('subject_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('thumb');
            $table->string('book');
            $table->float('price', 11, 2)->nullable();
            $table->string('type', 10)->default('Premium')->comment('Free, Premium');
            $table->string('status', 10)->default('In Review')->comment('In Review, Published');
            $table->bigInteger('user_id')->nullable()->index('ebooks_user_id_idx');
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
        Schema::dropIfExists('ebooks');
    }
};
