<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::connection('database_log')->hasTable('audit_logs')) {
            return;
        }

        Schema::connection('database_log')->create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->string('action_type', 300);
            $table->bigInteger('owner');
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('order_id')->nullable();
            $table->bigInteger('import_log_id')->nullable();
            $table->json('meta')->nullable();
            $table->text('meta_html')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('database_log')->dropIfExists('audit_logs');
    }
};
