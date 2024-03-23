<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyToCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['id_news']); // Xóa ràng buộc khóa ngoại cũ
            $table->foreign('id_news')
                ->references('id')
                ->on('news')
                ->onDelete('cascade'); // Thêm tùy chọn onDelete('cascade')
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropForeign(['id_news']); // Xóa ràng buộc khóa ngoại
            $table->dropColumn('id_news'); // Xóa cột id_news
        });
    }
}
