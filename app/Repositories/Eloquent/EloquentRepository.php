<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\EloquentInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;
use Illuminate\Support\Facades\DB;
use App\Repositories\Eloquent\FileRepository;
abstract class EloquentRepository implements EloquentInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @inheritDoc
     */
    public function paginate(): LengthAwarePaginator
    {
        return $this->getModel()->paginate(15);
    }

    /**
     * @inheritDoc
     */
    public function all(): Collection
    {
        return $this->getModel()->all();
    }

    /**
     * @inheritDoc
     */
    public function find($key): ?Model
    {
        return $this->getModel()->find($key);
    }

    /**
     * @inheritDoc
     */
    public function findOrFail(int $id): Model
    {
        return $this->getModel()->findOrFail($id);
    }

  public function findSlug(string $slug): Model
    {
         $model=$this->getModel()->where(['slug'=>$slug])->first();
         if (!$model){
             abort(404);
         }
        return $model;

    }

    /**
     * @inheritDoc
     */
    public function create(array $data): Model
    {
        return $this->getModel()->create($data);
    }

    /**
     * @inheritDoc
     */
    public function make(array $data): Model
    {
        return $this->getModel()->make($data);
    }

    /**
     * @inheritDoc
     */
    public function update(Model $model, array $data): EloquentInterface
    {
        $model->update($data);
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function updateOrCreate(array $attributes, array $values = []): Model
    {
        return $this->getModel()->updateOrCreate($attributes, $values);
    }

    /**
     * @inheritDoc
     */
    public function delete(Model $model):Model
    {

        if (!is_null($model->image)){
            $file=  new  FileRepository;
           $file->fileDelete($model,'category');
        }
        $model->delete();

        return $model;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Builder
     */
    protected function getModel(): Model
    {
        if (! $this->model instanceof Model) {
            throw new InvalidArgumentException('Model must be an instance of Illuminate\Database\Eloquent\Model');
        }

        return $this->model;
    }
}