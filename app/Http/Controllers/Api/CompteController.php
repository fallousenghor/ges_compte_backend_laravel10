<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Compte\StoreCompteRequest;
use App\Http\Requests\Compte\UpdateCompteRequest;
use App\Repositories\Interfaces\CompteRepositoryInterface;
use App\Traits\ApiResponse;

class CompteController extends Controller
{
    use ApiResponse;

    protected $compteRepository;

    public function __construct(CompteRepositoryInterface $compteRepository)
    {
        $this->compteRepository = $compteRepository;
    }

    public function index()
    {
        try {
            $user = auth()->user();

            // If the authenticated user is an admin, return all comptes.
            // If it's a client, return only comptes linked to that user.
            if ($user && isset($user->userable_type) && class_basename($user->userable_type) === 'Admin') {
                $comptes = $this->compteRepository->getAll();
            } else {
                $comptes = $this->compteRepository->getAll()->where('user_id', $user->id);
            }
            $comptes = $comptes->map(function ($compte) {
                $data = $compte->toArray();
                if (isset($compte->titulaire)) {
                    $data['titulaire'] = [
                        'nom' => $compte->titulaire->nom
                    ];
                }
                return $data;
            });
            return $this->successResponse($comptes);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function store(StoreCompteRequest $request)
    {
        try {
            $compte = $this->compteRepository->create($request->validated());
            return $this->createdResponse($compte);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $compte = $this->compteRepository->findById($id);
            return $this->successResponse($compte);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function update(UpdateCompteRequest $request, $id)
    {
        try {
            $compte = $this->compteRepository->update($id, $request->validated());
            return $this->successResponse($compte);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->compteRepository->delete($id);
            return $this->successResponse(null);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function getByType($type)
    {
        try {
            $comptes = $this->compteRepository->getByType($type);
            return $this->successResponse($comptes);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function getByStatus($status)
    {
        try {
            $comptes = $this->compteRepository->getByStatus($status);
            return $this->successResponse($comptes);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function search($query)
    {
        try {
            $comptes = $this->compteRepository->search($query);
            return $this->successResponse($comptes);
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }


}
