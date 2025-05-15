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
    Schema::table('users', function (Blueprint $table) {
        $table->string('first_name')->nullable();
        $table->string('last_name')->nullable();
        $table->string('news_img')->nullable();
        $table->string('profile_img')->nullable();
        $table->string('cover_img')->nullable();
        $table->json('friends')->nullable();
        $table->string('gender')->nullable();
        $table->date('birth_date')->nullable();
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn([
            'first_name',
            'last_name',
            'news_img',
            'profile_img',
            'cover_img',
            'friends',
            'gender',
            'birth_date',
        ]);
    });
}

};
