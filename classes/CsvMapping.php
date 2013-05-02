<?php

class CsvMapping extends BaseApp {


    public function __construct($map_name) {

       $mapping = $this->getMapping();

       $this->mapping = $mapping[$map_name];

       $this->tch = new TaxCodeHandler($this);
    }

    public function getMapping() { 

        return $this->mapping;
    }

    public function getTaxCodeHandler() {

        return $this->tch; 
    }

    public function getTaxCodeCol() {

        return $this->mapping[$this->taxCodeColKey];
    }

    public function getItemDescCol() {

        return $this->mapping[$this->itemDescColKey];
    }
}
