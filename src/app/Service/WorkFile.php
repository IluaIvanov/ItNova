<?php

namespace App\Service;

class WorkFile
{
    private $settingPath;

    public function __construct($path)
    {
        $this->settingPath = $path;
    }

    public function saveFile($data)
    {
        $result = file_put_contents($this->settingPath, json_encode($data));
        return $result ? true : false;
    }

    public function getFileData()
    {
        if(file_exists($this->settingPath)) return json_decode(file_get_contents($this->settingPath), true);
        else return [];
    }
}
