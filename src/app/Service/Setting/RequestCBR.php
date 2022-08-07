<?php

namespace App\Service\Setting;

use App\Service\RequestData;

class RequestCBR extends WorkFile
{
    public function getSetting()
    {
        $currentData = $this->getFileData();
        $valutesCB = (new RequestData)->valutes;

        foreach ($valutesCB as $key => $value) {
            if(in_array($value['Valute'], $currentData)) $valutesCB[$key]['request'] = true;
            else $valutesCB[$key]['request'] = false;
        }

        return $valutesCB;
    }

    public function setSetting($data)
    {
        return $this->saveFile($data);
    }
}
