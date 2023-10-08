<?php
namespace App\Repositories\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface EloquentInterface{

    /**
     * Get all instances of model
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all(): Collection;

    /**
     * Create a new record in the database
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data): Model;

    /**
     * Make a new object of the model
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function make(array $data): Model;

    /**
     * Update record in the database
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param array $data
     * @return \App\Repositories\Interfaces\EloquentInterface
     */
    public function update(Model $model, array $data): EloquentInterface;

    /**
     * Remove a record from the database
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return \App\Repositories\Interfaces\EloquentInterface
     */
    public function delete(Model $model): Model;

    /**
     * Find a record by Primary Key
     *
     * @param mixed $key
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find($key): ?Model;

    /**
     * Show the record with the given id
     *
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrFail(int $id): Model;



    public function findSlug(string $slug): Model;

    /**
     * Get paginated records
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Model[]
     */
    public function paginate(): LengthAwarePaginator;

    /**
     * @param array $attributes
     * @param array $values
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $attributes, array $values = []): Model;



}
