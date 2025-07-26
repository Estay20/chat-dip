<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    private $fieldName;
    private $file;
    private $model;
    private $filename;

    public function __construct($fieldName, $file, $model)
    {
        $this->fieldName = $fieldName;
        $this->file = $file;
        $this->model = $model;
    }

    // Проверка наличия файла и установка имени
    private function checkFile()
    {
        $fieldName = $this->fieldName;
        if ($this->file) {
            $this->filename = md5(uniqid()).'.'.$this->file->getClientOriginalExtension();
        } elseif ($this->model && $this->model->$fieldName) {
            $this->filename = $this->model->$fieldName;
        } else {
            $this->filename = null;
        }
    }

    // Сохранение изображения
    public function saveImage()
    {
        $this->checkFile();

        if ($this->file) {
            // Сохраняем новый файл в папку public/images
            Storage::putFileAs('public/images', $this->file, $this->filename);

            // Если у модели уже есть изображение, удаляем его
            $this->destroyImage();
        }

        return $this->filename;
    }

    // Удаление изображения
    public function destroyImage()
    {
        $fieldName = $this->fieldName;

        // Проверяем, есть ли у модели изображение, и если оно существует, удаляем его
        if ($this->model && $this->model->$fieldName && Storage::exists('public/images/'.$this->model->$fieldName)) {
            Storage::delete('public/images/'.$this->model->$fieldName);
        }
    }
}
