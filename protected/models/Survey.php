<?php

/**
 * This is the model class for table "survey".
 *
 * The followings are the available columns in table 'survey':
 * @property integer $id
 * @property string $timestamp
 * @property integer $success
 * @property integer $recommend
 * @property integer $interest
 * @property integer $users
 * @property integer $gender
 * @property integer $date_of_birth
 * @property string $website
 */
class Survey extends CActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Survey the static model class
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
	return 'survey';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
	    array('timestamp', 'required'),
	    array('success, recommend, interest, users, gender, date_of_birth', 'numerical', 'integerOnly' => true),
	    array('website', 'length', 'max' => 64),
	    // The following rule is used by search().
	    // Please remove those attributes that should not be searched.
	    array('id, timestamp, success, recommend, interest, users, gender, date_of_birth, website', 'safe', 'on' => 'search'),
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
	    'timestamp' => 'Timestamp',
	    'success' => 'Success',
	    'recommend' => 'Recommend',
	    'interest' => 'Interest',
	    'users' => 'Users',
	    'gender' => 'Gender',
	    'date_of_birth' => 'Date Of Birth',
	    'website' => 'Website',
	);
    }

    public function beforeValidate()
    {

	$this->timestamp = strtotime(str_replace('klo', '', $this->timestamp));

	return parent::beforeValidate();
    }

    public static function getTimestampFromCSV($columns)
    {
	return strtotime(str_replace('klo', '', $columns[0]));
    }

    public function toArray()
    {
	return array(
	    'timestamp' => intval($this->timestamp),
	    'success' => intval($this->success),
	    'recommend' => intval($this->recommend),
	    'interest' => intval($this->interest),
	    'users' => intval($this->users),
	    'gender' => intval($this->gender),
	    'dateOfBirth' => intval($this->date_of_birth),
	    'website' => $this->website,
	);
    }
    
    public static function getAllWebsites() {
	$sql = 'SELECT DISTINCT website FROM survey';
        $command = Yii::app()->db->createCommand($sql);
        $websites = $command->queryAll();
	$rval = array();
	foreach($websites as $website) {
	    $rval[$website['website']] = $website['website'];
	}
	return $rval;
    }

}