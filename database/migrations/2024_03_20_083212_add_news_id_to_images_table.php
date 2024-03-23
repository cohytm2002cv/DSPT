<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewsIdToImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->unsignedBigInteger('news_id'); // Thêm cột news_id
            $table->foreign('news_id')->references('id')->on('news'); // Tạo ràng buộc khóa ngoại
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['news_id']); // Xóa ràng buộc khóa ngoại
            $table->dropColumn('news_id'); // Xóa cột news_id
        });
    }
}
