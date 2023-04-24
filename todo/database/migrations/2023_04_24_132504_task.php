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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id(); // 主キー
            $table->unsignedBigInteger('user_id'); // 外部キーとなるカラム
            $table->string('title');
            $table->text('description');
            $table->string('category');
            $table->integer('priority');
            $table->date('due_date');
            $table->boolean('completed');
            $table->timestamps();

            // 外部キー制約を追加
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
