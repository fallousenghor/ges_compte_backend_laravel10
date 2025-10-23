<?php

namespace App\Repositories;

use App\Models\Compte;
use App\Repositories\Interfaces\CompteRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CompteRepository implements CompteRepositoryInterface
{
    protected $model;

    public function __construct(Compte $model)
    {
        $this->model = $model;
    }

    public function getAll()
    {
        return $this->model->with('titulaire')->latest()->get();
    }

    public function findById($id)
    {
        return $this->model->with('titulaire')->findOrFail($id);
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
            $compte = $this->findById($id);
            $compte->update($data);
            return $compte;
        });
    }

    public function delete($id)
    {
        return DB::transaction(function () use ($id) {
            $compte = $this->findById($id);
            return $compte->delete();
        });
    }

    public function getByType($type)
    {
        return $this->model->with('titulaire')
            ->where('type', $type)
            ->latest()
            ->get();
    }

    public function getByStatus($status)
    {
        return $this->model->with('titulaire')
            ->where('statut', $status)
            ->latest()
            ->get();
    }



    public function search($query)
    {
        return $this->model->with('titulaire')
            ->where('numero', 'ILIKE', "%{$query}%")
            ->orWhereHas('titulaire', function ($q) use ($query) {
                $q->where('nom', 'ILIKE', "%{$query}%")
                  ->orWhere('prenom', 'ILIKE', "%{$query}%");
            })
            ->get();
    }


}
