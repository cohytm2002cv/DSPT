<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGroupIdToNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id')->nullable(); // Thêm cột group_id, cho phép giá trị null
            $table->foreign('group_id')->references('id')->on('groups'); // Tạo ràng buộc khóa ngoại
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
            $table->dropForeign(['group_id']); // Xóa ràng buộc khóa ngoại
            $table->dropColumn('group_id'); // Xóa cột group_id
        });
    }
}
