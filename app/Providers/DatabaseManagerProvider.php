<?php

// app/Providers/DatabaseManagerProvider.php

namespace App\Providers;

use App\DatabaseManager;
use Illuminate\Support\ServiceProvider;

class DatabaseManagerProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('database.manager', function () {
            return DatabaseManager::getInstance();
        });
    }
}

?>
