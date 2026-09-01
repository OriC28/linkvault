<?php

namespace App\Repositories;

use App\Repositories\Contracts\RepositoryInterface;
use App\Models\Bookmark;
use App\Models\User;

class BookmarkRepository implements RepositoryInterface
{
    protected Bookmark $model;

    public function __construct(Bookmark $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, int $id)
    {
        $boorkmark = $this->model->findOrFail($id);
        $boorkmark->update($data);
        return $boorkmark;
    }

    public function delete(int $id)
    {
        $bookmark = $this->model->findOrFail($id);
        $bookmark->delete();
    }

    public function createForUser(User $user, array $data)
    {
        return $user->bookmarks()->create($data);
    }

    public function getFilteredAndPaginated(array $filters, int $perPage=5)
    {
        return Bookmark::with('tags')->filter($filters)
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }
}
