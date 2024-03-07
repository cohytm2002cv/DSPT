<?php

namespace App\Repositories;

use App\Models\News;

class NewRepository implements NewsRepositoryInterface
{
    public function find($id)
    {
        return News::find($id);
    }

    public function delete($id)
    {
        return News::destroy($id);
    }
}
