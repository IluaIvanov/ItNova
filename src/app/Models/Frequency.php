<?php

namespace App\Models;

use App\Service\WorkFile;

class Frequency
{
    protected $workFile;

    public function __construct()
    {
        $this->workFile = (new WorkFile(storage_path().'/frequency.json'));
    }

    public function set($frequency)
    {
        $this->workFile->saveFile(['frequency' => $frequency]);
    }

    public function get()
    {
        $frequency = $this->workFile->getFileData();
        if (isset($frequency['frequency'])) return $frequency['frequency'];
        return 0;
    }
}
