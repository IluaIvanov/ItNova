<?php

namespace App\Service;

use Exception;
use XMLReader;

class RequestData
{
    /**
     * XML document parsing class
     * @var XMLReader $reader
     */

    private $reader;

    /**
     * URL for getting data
     * @var string $urlXMLFile
     */

    private $urlXMLFile = 'http://www.cbr.ru/scripts/XML_daily.asp';

    /**
     * Date of last update
     * @var string $dateUpdate
     */

    protected $dateUpdate;

    /**
     * Array with data from an XML document
     * @var array $valutes
     */

    protected $valutes;

    public function __construct()
    {
        $this->reader = new XMLReader();
        try {
            $this->reader->open($this->urlXMLFile);
        } catch (\Throwable $th) {
            throw new Exception('XML file {' . $this->urlXMLFile . '} not exists!');
        }
        $this->dateUpdate = '';
        $this->valutes = [];
        $this->parseXML();
    }

    private function parseXML()
    {
        $reader = $this->reader;
        $tmpArray = [];

        // Сyclic document reading
        while ($reader->read()) {
            if ($reader->nodeType == XMLReader::ELEMENT) {
                if ($reader->localName == 'ValCurs') {
                    $this->dateUpdate = $reader->getAttribute('Date');
                    continue;
                }
                if ($reader->localName == 'Valute') {
                    $tmpArray[$reader->localName] = $reader->getAttribute('ID');
                    $nameKey = '';
                    while ($reader->read()) {
                        if ($reader->localName == 'Valute') break;
                        if ($reader->nodeType != XMLReader::TEXT) $nameKey = $reader->localName;
                        else {
                            $tmpArray[$nameKey] = $reader->value;
                            $reader->read();
                        }
                    }
                    array_push($this->valutes, $tmpArray);
                    $tmpArray = [];
                }
            }
        }
    }

    public function __get($property)
    {
        return $this->$property;
    }
}
