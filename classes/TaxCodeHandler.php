<?php
class TaxCodeHandler extends BaseApp {

    private $csvMapper;

    public function __construct(CsvMapping $mapping) {

        $this->csvMapper = $mapping;

        $cm_mapping = $mapping->getMapping();

        $this->mapping = $cm_mapping[$this->taxCodeMapKey];
    }

    public function getTaxCode($taxCode, $itemDesc) {

        if(empty($taxCode)) {

            foreach($this->mapping as $mapTaxCode=>$mapDescs) {

                foreach($mapDescs as $matchingDesc) {

                    if(strstr($itemDesc,$matchingDesc)) {
                        $taxCode = $mapTaxCode;    
                        break;
                    }
                }
            }
        }

        return $taxCode;
    }

    public function processTaxItem($csvRow) {

        $csvMapper = $this->csvMapper;

        $taxCode = $csvRow[$csvMapper->getTaxCodeCol()];
        $itemDesc = $csvRow[$csvMapper->getItemDescCol()];

        $taxCode = $this->getTaxCode($taxCode,$itemDesc);

        if(!empty($taxCode)) {
 
            $csvRow[$csvMapper->getTaxCodeCol()] = $taxCode;
        }
           
        return $csvRow; 
    }

}
