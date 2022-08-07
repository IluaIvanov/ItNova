<?php

namespace App\Service\Setting;

class WorkFile
{
    private $settingPath;

    public function __construct()
    {
        $this->settingPath = storage_path().'setting.json';
    }

    protected function saveFile($data)
    {
        $result = file_put_contents($this->settingPath, json_encode($data));
        return $result ? true : false;
    }

    protected function getFileData()
    {
        if(file_exists($this->settingPath)) return json_decode(file_get_contents($this->settingPath), true);
        else return [];
    }
}
