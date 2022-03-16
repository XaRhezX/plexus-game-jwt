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
        Schema::create('rest_api_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('method');
            $table->json('request');
            $table->string('endpoint');
            $table->string('useragent');
            $table->json('header');
            $table->ipAddress();
            $table->foreignUuid('user_id')->nullable()->constrained();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rest_api_logs');
    }
};
