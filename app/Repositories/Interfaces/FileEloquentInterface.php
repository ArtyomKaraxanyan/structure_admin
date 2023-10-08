<?php
namespace App\Repositories\Interfaces;


use Illuminate\Database\Eloquent\Model;

interface FileEloquentInterface{

    /**
     * Get all instances of model
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function fileUpload(array $data);
    public function fileDelete(Model $model,$directory): Model;

}
