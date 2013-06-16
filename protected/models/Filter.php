<?php

class Filter extends CModel
{

    public $dateRange;
    public $from;
    public $to;
    public $website;
    public $gender;

    public function attributeNames()
    {
	return array(
	    'dateRange',
	);
    }

    public function attributeLabels()
    {
	return array(
	    'dateRange' => 'Aikaväli',
	    'website' => 'Sivusto',
	    'gender' => 'Sukupuoli',
	);
    }

}