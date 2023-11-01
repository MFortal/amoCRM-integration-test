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
        Schema::create('token_apis', function (Blueprint $table) {
            $table->id();

            $table->string('client_id', 255);
            $table->string('base_domain', 48);

            $table->string('access_token', 2048)->unique();
            $table->string('refresh_token', 2048)->unique();
            $table->integer('resource_owner_id')->nullable();
            $table->jsonb('values');
            $table->timestamp('expires', $precision = 0);

            $table->unique(['client_id', 'base_domain']);

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
        Schema::dropIfExists('token_apis');
    }
};
