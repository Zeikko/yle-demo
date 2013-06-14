<?php

class CSVImporter
{

    protected $csv;
    protected $rows;
    protected $url;
    protected $columns;

    public function __construct($url)
    {
	$this->url = $url;
	//TODO Caching
	$this->csv = file_get_contents($this->url);
	$rows = explode("\n", $this->csv);
	$this->rows = array();
	foreach ($rows as $row) {
	    $row = str_getcsv($row);
	    $this->rows[] = $row;
	}
	$this->columns = array_shift($this->rows);
	$this->columns = array_flip($this->columns);
    }

    public function import($class)
    {
	$object = new $class;
	$attributeMap = $object->attributeNames();
	array_shift($attributeMap);

	$transaction = Yii::app()->db->beginTransaction();
	try {
	    $criteria = new CDbCriteria();
	    $criteria->order = 'timestamp DESC';
	    $criteria->limit = 1;
	    $latest = $class::model()->find($criteria);
	    $latestTimestamp = 0;
	    if ($latest)
		$latestTimestamp = $latest->timestamp;


	    foreach ($this->rows as $columns) {
		if ($latestTimestamp <= $class::getTimestampFromCSV($columns)) {
		    if ($latestTimestamp == $class::getTimestampFromCSV($columns))
			$object = $class::model()->findByAttributes(array('timestamp' => $latestTimestamp));
		    else
			$object = new $class;
		    $i = 0;
		    foreach ($columns as $column) {
			$object->$attributeMap[$i] = $column;
			$i++;
		    }
		    $object->save();
		}
	    }
	    $transaction->commit();
	} catch (Exception $e) { // an exception is raised if a query fails
	    $transaction->rollback();
	    throw new Exception($e->getMessage(), $e->getCode());
	}
    }

}
