<?php

namespace App\Repositories;

interface NewsRepositoryInterface
{
    public function find($id);

    public function delete($id);
}
