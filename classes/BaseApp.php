<?php

class BaseApp {

    protected 
        $taxCodeColKey = 'taxCode_col',
        $itemDescColKey = 'itemDesc_col',
        $taxCodeMapKey = 'taxCode_map';

    protected function getCsvDir() {

        return dirname(__FILE__) . '/../csv/';
    }

    protected function getCsvSettings() {

        $csvSettings = array(
            'delimiter'=>',',
            'enclosure'=>'"',
            'escape'=>'\\'
        );

        return $csvSettings;
    }

    protected function getMapping() {

        return array(
            'Checking'=>array(
                'taxCode_col'=>'taxCode',
                'itemDesc_col'=>'item_desc',
                'taxCode_map'=>array(
                    '6850'=>array(
                        'BLU*supraliminalso',
                        'GITHUB.COM'
                    )
                )
            )
        );
    }

    protected function getTestMapping() {

        return array(
            'Checking'=>array(
                'taxCode_col'=>'taxCode',
                'itemDesc_col'=>'item_desc',
                'taxCode_map'=>array(
                    '6850'=>array(
                        'BLU*supraliminalso',
                        'GITHUB.COM'
                    )
                )
            )
        );
    }
}
