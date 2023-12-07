<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table(config('laravel-attributes.tables.name', 'attributes'), function(Blueprint $table) {
            $table->renameColumn('attributable', 'attributable_type');
            $this->index(['attributable_type', 'attributable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table(config('laravel-attributes.tables.name', 'attributes'), function(Blueprint $table) {
            $table->renameColumn('attributable_type', 'attributable');
            $this->index(['attributable_type', 'attributable_id']);
        });
    }
};
