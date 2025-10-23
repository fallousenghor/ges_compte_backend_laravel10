<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->latest()->get();
    }

    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            return $this->model->create($data);
        });
    }

    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $user = $this->findById($id);
            $user->update($data);
            return $user;
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $user = $this->findById($id);
            return $user->delete();
        });
    }

    public function search($query)
    {
        return $this->model
            ->where('prenom', 'ILIKE', "%{$query}%")
            ->orWhere('nom', 'ILIKE', "%{$query}%")
            ->orWhere('email', 'ILIKE', "%{$query}%")
            ->orWhere('telephone', 'ILIKE', "%{$query}%")
            ->get();
    }


}
