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
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->text('title')->charset('utf8mb4');
            $table->text('insight')->charset('utf8mb4');
            $table->text('url')->charset('utf8mb4');
            $table->tinyInteger('intensity')->nullable();
            $table->tinyInteger('relevance');
            $table->tinyInteger('likelyhood');
            $table->integer('impact')->nullable();
            $table->foreignId('topic_id')->nullable()->constrained('topics');
            $table->foreignId('sector_id')->nullable()->constrained('sectors');
            $table->foreignId('swot_id')->nullable()->constrained('swot');
            $table->foreignId('pestle_id')->nullable()->constrained('pestle');
            $table->foreignId('source_id')->nullable()->constrained('sources');
            $table->foreignId('region_id')->nullable()->constrained('regions');
            $table->foreignId('country_id')->nullable()->constrained('countries');
            $table->foreignId('city_id')->nullable()->constrained('cities');
            $table->integer('start_year')->nullable();
            $table->integer('end_year');
            $table->timestamp('added');
            $table->timestamp('published');
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
    }
};
