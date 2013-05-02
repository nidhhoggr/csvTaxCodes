<?php

class CsvParser extends BaseApp {
    private $file;
    private $filename;
    private $handle;
    private $columns;

    function __construct($filename = null) {

        if($filename) {
            if(empty($this->handle)){
                $this->setFile($filename);
                $this->setHandle(); 
            }
            $this->setColumns();
        }
    }

    private function setHandle() {
        $this->handle = fopen($this->file, "r");
    }

    private function setColumns() {
        $this->columns = fgetcsv($this->handle);
    }

    public function getColumns() {
        
        if(!$this->columns && $this->handle) {
            $this->setColumns();
        }
        return $this->columns;
    }

    public function setFile($filename) {
        $this->filename = $filename;
        $this->file = $this->getCsvDir() . $filename;
    }

    public function getFile() {
        return $this->file;
    }

    public function getFileName() {
        return $this->filename;
    }


    private function parseNextLine() {

        $csv_settings = $this->getCsvSettings();
  
        if (strnatcmp(phpversion(),'5.3') >= 0) {    
            return fgetcsv($this->handle,1000,stripslashes($csv_settings['delimiter']),stripslashes($csv_settings['enclosure']),$csv_settings['escape']);
        
        } 
        else { 
            return fgetcsv($handle,1000,stripslashes($csv_settings['delimiter']),stripslashes($csv_settings['enclosure']));
        }  
    }

    public function processCsv(CsvMapping $mapping) {

        $cols = $this->getColumns();

        if($cols) {
            while (($data = $this->parseNextLine())!== FALSE) {

                //loop through the columns
                foreach($data as $i=>$d) {

                    $colName = $cols[$i];
                    $parsed[$colName] = $d;
                }

                $tch = $mapping->getTaxCodeHandler();

                $parsed = $tch->processTaxItem($parsed);

                $taxItems[] = $parsed;
            }
        }

        return $taxItems;
    }
}
