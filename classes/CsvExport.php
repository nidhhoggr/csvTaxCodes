<?php
class CsvExport extends BaseApp {

    public function __construct($taxRecords) {

        $this->records = $taxRecords;
    }

    public function buildCsv() {

        $csvSettings = $this->getCsvSettings();

        extract($csvSettings);
    
        $c = 0;
 
        foreach((array)$this->records as $record) {
            $val_array = array();
            $key_array = array();
            foreach($record AS $key => $val) {
                    $key_array[] = $key;
                    if(!empty($escape)) {
                        $val = str_replace($enclosure, $escape.$enclosure, $val);
                        $val = str_replace($delimiter, $escape.$delimiter, $val);
                    }
                    $val_array[] = $enclosure.$val.$enclosure;
            }
            if($c == 0) {
                $this->csvstring .= implode($delimiter, $key_array)."\n";
            }
            $this->csvstring .= implode($delimiter, $val_array)."\n";
            $c++;
        }
    }

    public function getCsvString() {

        return $this->csvstring;
    }

    public function createFile($filename) {
        if(empty($this->csvstring)) $this->buildCsv();
        $my_file = $this->getCsvDir() . $filename;
        $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
        fwrite($handle, $this->csvstring);
    }
}
