<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDetailsToContactsTable extends Migration
{
    public function up()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
            $table->string('profile_photo_path')->nullable();
        });
    }

    public function down()
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('notes');
            $table->dropColumn('profile_photo_path');
        });
    }
}

