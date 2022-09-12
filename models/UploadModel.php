<?php
class UploadModel
{
    public $file, $field, $errors = [];
    public $size, $tmp, $ext;
    public $maxSize = 2000000;
    public $allowedFileTypes = ['jpg', 'png', 'jpeg', 'gif'];
    public $required = true;

    public function __construct($field)
    {
        $this->field = $field;
        $this->checkInitialError();
        $this->file = $_FILES[$field];
        $this->size = $this->file['size'];
        $this->tmp = $this->file['tmp_name'];
        $this->ext = pathinfo($this->file['name'], PATHINFO_EXTENSION);
    }

    public function validate()
    {
        $this->errors = [];
        if (empty($this->tmp) && $this->required) {
            $this->errors[$this->field] = "File is required";
        }
        //check size
        if (!empty($this->tmp) && $this->size > $this->maxSize) {
            $this->errors[$this->field] = "Exceeded file size limit of " . $this->maxSize;
        }

        //check if allowed type
        $target_dir = "assets/uploads/avatars/";
        $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

        if (!empty($this->tmp) && empty($this->errors)) {

            if (!in_array($imageFileType, $this->allowedFileTypes)) {
                $this->errors[$this->field] = "Not an allowed file type. Must be " . implode(', ', $this->allowedFileTypes);
            }
        }

        return $this->errors;
    }

    public function upload($fileName)
    {
        move_uploaded_file($this->tmp, $fileName);
    }

    private function checkInitialError()
    {
        if (!isset($_FILES[$this->field]) || is_array($_FILES[$this->field]['error'])) {
            throw new \RuntimeException("Something is wrong with the file");
        }
    }
}
