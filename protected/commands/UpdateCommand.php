<?php

class UpdateCommand extends CConsoleCommand
{

    public function run($args)
    {
	$this->updateSurveys();
	$this->updateTraffics();
    }

    protected function updateSurveys()
    {
	$CSVImporter = new CSVImporter(Yii::app()->params['dataSources']['survey']);
	$surveys = $CSVImporter->import('Survey');

	//Find latest saved survey
//	$criteria = new CDbCriteria();
//	$criteria->order = 'timestamp DESC';
//	$criteria->limit = 1;
//	$latestSurvey = Survey::model()->find($criteria);
//	$latestSurveyTimestamp = 0;
//	if($latestSurvey)
//	    $latestSurveyTimestamp = $latestSurvey->timestamp;
//	
//	//Save new surveys
//	foreach($surveys as $survey) {
//	    if(strtotime(str_replace('klo', '', $survey->timestamp)) > $latestSurveyTimestamp) {
//		$surveyModel = new Survey();
//		$surveyModel->attributes = $survey;
//		$surveyModel->save();
//	    }
//	}
    }

    protected function updateTraffics()
    {
	$CSVImporter = new CSVImporter(Yii::app()->params['dataSources']['traffic']);
	$CSVImporter->import('Traffic');
    }

}