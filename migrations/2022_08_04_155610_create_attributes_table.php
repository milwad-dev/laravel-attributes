<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('laravel-attributes.tables.name', 'attributes'), function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('value');
            $table->morphs('attributable');
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
        Schema::dropIfExists(config('laravel-attributes.tables.name', 'attributes'));
    }
};
