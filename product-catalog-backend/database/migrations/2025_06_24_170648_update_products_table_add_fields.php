<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('cover_image')->nullable();
            $table->string('summary')->nullable()->change();
            $table->string('author')->nullable();
            $table->renameColumn('description', 'summary');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['cover_image', 'author']);
        });
    }
};
