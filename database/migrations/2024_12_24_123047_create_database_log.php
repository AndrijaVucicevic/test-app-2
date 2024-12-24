<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::connection('database_log')->hasTable('logs')) {
            return;
        }

        Schema::connection('database_log')->create('logs', static function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('message');
            $table->jsonb('context')->nullable();
            $table->string('level')->index();
            $table->string('level_name');
            $table->string('channel')->index();
            $table->dateTime('date');
            $table->jsonb('extra')->nullable();
            $table->longText('formatted');
            $table->longText('exception')->nullable();
            $table->text('url')->nullable();
            $table->longText('payload')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('user_email')->nullable();
            $table->string('remote_address')->nullable();
            $table->string('user_agent')->nullable();
        });
    }

    public function down(): void
    {
        Schema::connection('database_log')->dropIfExists('logs');
    }
};
