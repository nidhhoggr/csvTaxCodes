<?php

class CsvMapping extends BaseApp {


    public function __construct($map_name) {

       $this->mapping = $this->setMapping($map_name);

       $this->tch = new TaxCodeHandler($this);
    }

    public function setMapping($map_name) {

        return yaml_parse_file($this->getMappingDir() . $map_name . '.yml');
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
