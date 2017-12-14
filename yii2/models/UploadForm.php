<?php
namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */ 
    public $files;

    public function rules()
    {
        return [
            [['files'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, pdf', 'maxFiles' => 100],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->files as $file) {
                $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        }
		else {
            return false;
        }
    } 

}