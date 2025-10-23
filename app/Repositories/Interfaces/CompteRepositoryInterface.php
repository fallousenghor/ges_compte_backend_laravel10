<?php

namespace App\Repositories\Interfaces;

interface CompteRepositoryInterface
{

    public function getAll();


    public function findById($id);


    public function create(array $data);


    public function update($id, array $data);


    public function delete($id);


    public function getByType($type);


    public function getByStatus($status);



    public function search($query);

}
