<?php

class ApiController extends Controller
{

    public function output($output)
    {
	header('Content-Type: application/json');
	echo json_encode($output);
    }

    public function actionTraffic()
    {
	$criteria = new CDbCriteria();
	if (Yii::app()->request->getQuery('from')) {
	    $criteria->addCondition('timestamp >= :from');
	    $criteria->params[':from'] = Yii::app()->request->getQuery('from');
	}
	if (Yii::app()->request->getQuery('to')) {
	    $criteria->addCondition('timestamp <= :to');
	    $criteria->params[':to'] = Yii::app()->request->getQuery('to');
	}

	$trafficModels = Traffic::model()->findAll($criteria);
	$traffics = array();
	foreach ($trafficModels as $trafficModel) {
	    $traffics[] = $trafficModel->toArray();
	}
	$this->output($traffics);
    }

    public function actionSurvey()
    {
	$criteria = new CDbCriteria();
	if (Yii::app()->request->getQuery('from')) {
	    $criteria->addCondition('timestamp >= :from');
	    $criteria->params[':from'] = Yii::app()->request->getQuery('from');
	}
	if (Yii::app()->request->getQuery('to')) {
	    $criteria->addCondition('timestamp <= :to');
	    $criteria->params[':to'] = Yii::app()->request->getQuery('to');
	}

	$surveyModels = Survey::model()->findAll($criteria);
	$surveys = array();
	$total = array(
	    'success' => array(),
	    'recommend' => array(),
	    'interest' => array(),
	    'users' => array(),
	);
	foreach ($surveyModels as $surveyModel) {
	    $surveys[] = $surveyModel->toArray();
	    if ($surveyModel->success !== null)
		$total['success'][] = $surveyModel->success;
	    $total['recommend'][] = $surveyModel->recommend;
	    $total['interest'][] = $surveyModel->interest;
	    $total['users'][] = $surveyModel->users;
	}
	$total['success'] = array_sum($total['success']) / count($total['success']);
	$total['recommend'] = array_sum($total['recommend']) / count($total['recommend']);
	$total['interest'] = array_sum($total['interest']) / count($total['interest']);
	$total['users'] = array_sum($total['users']) / count($total['users']);
	$this->output(array(
	    'surveys' => $surveys,
	    'total' => $total,
	));
    }

    public function actionSurveyDaily()
    {
	$criteria = new CDbCriteria();
	$criteria->order = 'timestamp ASC';
	if (Yii::app()->request->getQuery('from')) {
	    $criteria->addCondition('timestamp >= :from');
	    $criteria->params[':from'] = Yii::app()->request->getQuery('from') + 3 * 3600;
	}
	if (Yii::app()->request->getQuery('to')) {
	    $criteria->addCondition('timestamp <= :to');
	    $criteria->params[':to'] = Yii::app()->request->getQuery('to') + 3 * 3600 + 86400;
	}
	if (Yii::app()->request->getQuery('website')) {
	    $criteria->addCondition('website LIKE :website');
	    $criteria->params[':website'] = Yii::app()->request->getQuery('website');
	}
	if (Yii::app()->request->getQuery('ageMin')) {
	    $year = date('Y') - Yii::app()->request->getQuery('ageMin');
	    $criteria->addCondition('date_of_birth <= :ageMin');
	    $criteria->params[':ageMin'] = $year;
	}
	if (Yii::app()->request->getQuery('ageMax')) {
	    $year = date('Y') - Yii::app()->request->getQuery('ageMax');
	    $criteria->addCondition('date_of_birth >= :ageMax');
	    $criteria->params[':ageMax'] = $year;
	}
	if (strlen(Yii::app()->request->getQuery('gender'))) {
	    $criteria->addCondition('gender >= :gender');
	    $criteria->params[':gender'] = Yii::app()->request->getQuery('gender');
	}

	$surveyModels = Survey::model()->findAll($criteria);
	if (Yii::app()->request->getQuery('from'))
	    $current = Yii::app()->request->getQuery('from') + 3 * 3600;
	else if (isset($surveyModels[0]))
	    $current = strtotime(date('m/d/Y', $surveyModels[0]->timestamp)) + 3 * 3600;
	else
	    $current = strtotime(date('m/d/Y', 1369754348)) + 3 * 3600;
	if (Yii::app()->request->getQuery('to'))
	    $last = Yii::app()->request->getQuery('to');
	else
	    $last = strtotime('today');
	$i = 0;
	$rows = array();
//	var_dump(count($surveyModels));
	while ($current < $last + 86400) {
	    $row = array(
		'success' => array(),
		'recommend' => array(),
		'interest' => array(),
		'users' => array(),
	    );
	    if (isset($surveyModels[$i]))
		while ($surveyModels[$i]->timestamp >= $current && $surveyModels[$i]->timestamp < $current + 86400) {
//		var_dump($surveyModels[$i]->attributes);
		    if ($surveyModels[$i]->success !== null)
			$row['success'][] = $surveyModels[$i]->success;
		    if ($surveyModels[$i]->recommend !== null)
			$row['recommend'][] = $surveyModels[$i]->recommend;
		    if ($surveyModels[$i]->interest !== null)
			$row['interest'][] = $surveyModels[$i]->interest;
		    if ($surveyModels[$i]->users !== null)
			$row['users'][] = $surveyModels[$i]->users;
		    $i++;
		    if (!isset($surveyModels[$i]))
			break;
		}
	    if (count($row['success']))
		$row['success'] = round(array_sum($row['success']) / count($row['success']), 2);
	    else
		$row['success'] = 0;
	    if (count($row['recommend']))
		$row['recommend'] = round(array_sum($row['recommend']) / count($row['recommend']), 2);
	    else
		$row['recommend'] = 0;
	    if (count($row['interest']))
		$row['interest'] = round(array_sum($row['interest']) / count($row['interest']), 2);
	    else
		$row['interest'] = 0;
	    if (count($row['users']))
		$row['users'] = round(array_sum($row['users']) / count($row['users']), 2);
	    else
		$row['users'] = 0;
	    $row['timestamp'] = intval($current);
	    $rows[] = $row;
	    $current += 86400;
	}
	$this->output($rows);
    }

}