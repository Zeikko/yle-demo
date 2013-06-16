<?php

class SiteController extends Controller
{

    public function actionIndex()
    {
//	Yii::app()->clientScript->registerScriptFile(
//		Yii::app()->assetManager->publish(
//			Yii::getPathOfAlias('application.components') . '/highcharts.js'
//		), CClientScript::POS_HEAD
//	);
	$this->render('index', array(
	));
    }

    public function actionError()
    {
	if ($error = Yii::app()->errorHandler->error) {
	    if (Yii::app()->request->isAjaxRequest)
		echo $error['message'];
	    else
		$this->render('error', $error);
	}
    }

    public function actionTraffic()
    {
	$filter = new Filter();
	$this->render('traffic', array(
	    'filter' => $filter,
	));
    }

    public function actionSurvey()
    {
	$filter = new Filter();
	$this->render('survey', array(
	    'filter' => $filter,
	));
    }

    public function actionWebsite()
    {
	$filter = new Filter();
	$this->render('website', array(
	    'filter' => $filter,
	));
    }

}