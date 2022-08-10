<?php

namespace App\Service\Setting;

use App\Models\WorkFile;
use App\Service\RequestData;

class RequestCBR
{
    protected $accessCache;

    public function __construct()
    {
        $this->accessCache = (new WorkFile);
    }

    public function getSetting()
    {
        $currentData = $this->accessCache->getFileData();
        $valutesCB = (new RequestData)->valutes;

        foreach ($valutesCB as $key => $value) {
            if(in_array($value['Valute'], $currentData)) $valutesCB[$key]['request'] = true;
            else $valutesCB[$key]['request'] = false;
        }

        return $valutesCB;
    }

    public function setSetting($data)
    {
        return $this->accessCache->saveFile($data);
    }
}
