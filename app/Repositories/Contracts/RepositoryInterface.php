<?php

namespace App\Repositories\Contracts;

use App\Models\User;

interface RepositoryInterface
{
    public function all();
    public function find(int $id);
    public function create(array $data);
    public function update(array $data, int $id);
    public function delete(int $id);
    public function createForUser(User $user, array $data);
    public function getFilteredAndPaginated(User $user, array $filters, int $perPage = 5);
}
