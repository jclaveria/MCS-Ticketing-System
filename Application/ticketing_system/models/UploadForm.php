<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;


class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;
    public $task_id;

    public function rules()
    {
        return [
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, doc, docx, xml'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {

            $path = 'uploads/' . $this->task_id . '/';
            if(!is_dir($path)){
              mkdir($path);
            }

			$this->file->saveAs( $path. $this->file->baseName . '.' . $this->file->extension);
            return true;
        } else {
            return false;
        }
    }
}
