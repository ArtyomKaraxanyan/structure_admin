<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Interfaces\FileEloquentInterface;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use InvalidArgumentException;
abstract class FileEloquentRepository implements FileEloquentInterface
{
    protected $model;

    public function fileUpload(array $data)
    {

        $upload_dir = '/uploads/'.$data['directory'].'/';
        $fileName = $data['image']->hashName();
        $pieces = explode(".", $fileName);
        $fileName = $pieces[0] . '.webp';
        $image = Image::make($data['image']);
        Storage::put('public/' . $upload_dir . 'original/' . $fileName, (string) $image->encode('webp'));
        $image->resize(100,100, function ($constraint) {
            $constraint->aspectRatio();
        });
        Storage::put('public/' . $upload_dir . '100x100/' . $fileName, (string) $image->encode('webp'));
        return $fileName;
    }
    public function fileDelete(Model $model,$directory): Model
    {
        Storage::disk('public')->delete('uploads/'.$directory.'/100x100/'.$model->image);
        Storage::disk('public')->delete('uploads/'.$directory.'/original/'.$model->image);
        $model->image=null;
        $model->update();
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