<?php

// app/DatabaseManager.php

namespace App;

use Illuminate\Support\Facades\DB;

class DatabaseManager
{
    private static $instance;

    private function __construct()
    {
        // Khởi tạo cơ sở dữ liệu
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function query($sql, $bindings = [])
    {
        return DB::select($sql, $bindings);
    }

    public function findNewsById($id)
    {
        return DB::table('news')->where('id', $id)->first();
    }
    public function findNewsByGroupId($id)
    {
        return DB::table('news')->where('group_id', $id)->get();
    }
}

?>
