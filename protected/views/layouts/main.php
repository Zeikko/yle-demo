<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="utf-8">
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/app.css" media="screen, projection" />
    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>-->
	<script src="http://code.highcharts.com/highcharts.js"></script>
	<script src="http://code.highcharts.com/highcharts-more.js"></script>
	<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    </head>
    <body>
	<?php
	$items = array(
	    array('label' => 'Tänään', 'url' => array('/site/index')),
	    array('label' => 'Kävijät', 'url' => array('/site/traffic')),
	    array('label' => 'Käyttäjäkysely', 'url' => array('/site/survey')),
	    array('label' => 'Sivustot', 'url' => array('/site/website')),
	);
	$this->widget('bootstrap.widgets.TbNavbar', array(
	    'brand' => 'Yle.fi',
	    'items' => array(
		array(
		    'class' => 'bootstrap.widgets.TbMenu',
		    'items' => $items,
		)
	    )
	));
	?>
        <div class="container top-container">
	    <?php
	    $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
		'links' => $this->breadcrumbs,
	    ));
	    ?>
            <div class="row">
		<?php echo $content; ?>
            </div>
        </div>
    </body>
</html>