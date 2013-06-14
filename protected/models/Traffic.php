<?php

/**
 * This is the model class for table "traffic".
 *
 * The followings are the available columns in table 'traffic':
 * @property integer $id
 * @property string $date
 * @property integer $expected
 * @property integer $currentcount
 * @property string $timestamp
 */
class Traffic extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Traffic the static model class
     */
    public static function model($className = __CLASS__)
    {
	return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
	return 'traffic';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('date, expected, currentcount', 'required'),
	    array('expected, currentcount', 'numerical', 'integerOnly' => true),
	    array('timestamp', 'safe'),
	    // The following rule is used by search().
	    // Please remove those attributes that should not be searched.
	    array('id, date, expected, currentcount, timestamp', 'safe', 'on' => 'search'),
	);
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
	return array(
	    'id' => 'ID',
	    'date' => 'Date',
	    'expected' => 'Expected',
	    'currentcount' => 'Currentcount',
	    'timestamp' => 'Timestamp',
	);
    }

    public function beforeValidate()
    {

	$this->date = strtotime($this->date);
	$this->expected = preg_replace("/[^0-9,.]/", "", $this->expected);
	$this->average = preg_replace("/[^0-9,.]/", "", $this->average);

//	    var_dump($this->attributes);
	return parent::beforeValidate();
    }

    public static function getTimestampFromCSV($columns)
    {
	return $columns[4];
    }

}