<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // Thêm cột user_id
            $table->foreign('user_id')->references('id')->on('users'); // Tạo ràng buộc khóa ngoại
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Xóa ràng buộc khóa ngoại
            $table->dropColumn('user_id'); // Xóa cột user_id
        });
    }
}
