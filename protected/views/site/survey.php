<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'filterForm',
    'type' => 'horizontal',
    'htmlOptions' => array('class' => 'well'),
	));

echo $form->dateRangeRow($filter, 'dateRange', array(
    'prepend' => '<i class="icon-calendar"></i>',
    'options' => array(
	'language' => 'fi',
	'format' => 'dd.MM.yyyy',
	'callback' => 'js:function(start, end){
		$("#from").val(start.getTime() / 1000);
		$("#to").val(end.getTime() / 1000);
		loadSurvey();
		}'
    ),
));

echo $form->dropDownListRow($filter, 'website', array_merge(array(0 => 'Kaikki'), Survey::getAllWebsites()), array(
    'name' => 'website',
    'onchange' => 'loadSurvey();',
));

echo $form->dropDownListRow($filter, 'gender', array('' => 'Kaikki', 0 => 'Nainen', 1 => 'Mies'), array(
    'name' => 'gender',
    'onchange' => 'loadSurvey();',
));
?>
<div class = "control-group ">
    <label class = "control-label" for = "Filter_website">Ikä</label>
    <div class = "controls">
	<?php
	$this->widget('zii.widgets.jui.CJuiSlider', array(
	    'id' => 'slider',
	    'options' => array(
		'min' => 0,
		'max' => 100,
		'range' => true,
		'values' => array(0, 100),
		'change' => new CJavaScriptExpression("function(event, ui) {
		    $('#ageMin').val(ui.values[0]);
		    $('#ageMax').val(ui.values[1]);
		    loadSurvey();
		    }"),
		'slide' => new CJavaScriptExpression("function(event, ui) {
		var delay = function() {
		    var handleIndex = $(ui.handle).data('uiSliderHandleIndex');
		    var label = handleIndex == 0 ? '#min' : '#max';
		    $(label).html(ui.value).position({
			my: 'center top',
			at: 'center bottom',
			of: ui.handle,
			offset: '0, 10'
		    });
		};

        // wait for the ui.handle to set its position
        setTimeout(delay, 5);
    }"),
	    ),
	));
	?>
	<div id="min"></div>
	<div id="max"></div>
    </div>

</div>
<?php
echo $form->hiddenField($filter, 'from', array('name' => 'from'));
echo $form->hiddenField($filter, 'to', array('name' => 'to'));
echo $form->hiddenField($filter, 'from', array('name' => 'ageMin'));
echo $form->hiddenField($filter, 'to', array('name' => 'ageMax'));

$this->endWidget();

$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'compareFilterForm',
    'type' => 'horizontal',
    'htmlOptions' => array('class' => 'well'),
	));

echo $form->dateRangeRow($filter, 'dateRange', array(
    'prepend' => '<i class="icon-calendar"></i>',
    'options' => array(
	'language' => 'fi',
	'format' => 'dd.MM.yyyy',
	'callback' => 'js:function(start, end){
		$("#compareFrom").val(start.getTime() / 1000);
		$("#compareTo").val(end.getTime() / 1000);
		loadSurvey();
		}'
    ),
));

echo $form->dropDownListRow($filter, 'website', array_merge(array(0 => 'Kaikki'), Survey::getAllWebsites()), array(
    'name' => 'website',
    'onchange' => 'loadSurvey();',
));

echo $form->dropDownListRow($filter, 'gender', array('' => 'Kaikki', 0 => 'Nainen', 1 => 'Mies'), array(
    'name' => 'gender',
    'onchange' => 'loadSurvey();',
));
?>
<div class = "control-group ">
    <label class = "control-label" for = "Filter_website">Ikä	</label>
    <div class = "controls">
	<?php
	$this->widget('zii.widgets.jui.CJuiSlider', array(
	    'id' => 'slider2',
	    'options' => array(
		'min' => 0,
		'max' => 100,
		'range' => true,
		'values' => array(0, 100),
		'change' => new CJavaScriptExpression("function(event, ui) {
		    $('#compareAgeMin').val(ui.values[0]);
		    $('#compareAgeMax').val(ui.values[1]);
		    loadSurvey();
		    }"),
		'slide' => new CJavaScriptExpression("function(event, ui) {
		var delay = function() {
		    var handleIndex = $(ui.handle).data('uiSliderHandleIndex');
		    var label = handleIndex == 0 ? '#min2' : '#max2';
		    $(label).html(ui.value).position({
			my: 'center top',
			at: 'center bottom',
			of: ui.handle,
			offset: '0, 10'
		    });
		};

        // wait for the ui.handle to set its position
        setTimeout(delay, 5);
    }"),
	    ),
	));
	?>
	<div id="min2"></div>
	<div id="max2"></div>
    </div>

</div>
<?php
echo $form->hiddenField($filter, 'from', array('id' => 'compareFrom', 'name' => 'from'));
echo $form->hiddenField($filter, 'to', array('id' => 'compareTo', 'name' => 'to'));
echo $form->hiddenField($filter, 'from', array('id' => 'compareAgeMin', 'name' => 'ageMin'));
echo $form->hiddenField($filter, 'to', array('id' => 'compareAgeMax','name' => 'ageMax'));

$this->endWidget();
?>
<div id="daily-success"></div>
<div id="daily-interest"></div>
<div id="daily-recommend"></div>
<script type="text/javascript">
    $(function() {
	loadSurvey();
    });

    var counter = 0;
    var data1;
    var data2;
    function loadSurvey() {
	counter = 0;
	$.ajax({
	    dataType: "json",
	    url: '<?php echo $this->createUrl('api/surveydaily') ?>',
	    data: $('#filterForm').serialize(),
	    success: function(data) {
		counter++;
		data1 = data;
		load();
	    }
	});

	$.ajax({
	    dataType: "json",
	    url: '<?php echo $this->createUrl('api/surveydaily') ?>',
	    data: $('#compareFilterForm').serialize(),
	    success: function(data) {
		counter++;
		data2 = data;
		load();
	    }
	});
    }

    function load() {
	if (counter == 2) {
	    loadSuccessLine();
	    loadRecommendLine();
	    loadInterestLine();
	}
    }

    function loadSuccessLine() {
	var serie = {name: "Valinta", data: new Array()};
	$(data1).each(function(index, element) {
	    serie.data.push(new Array(element.timestamp * 1000, element.success));
	});

	var serie2 = {name: "Vertailu", data: new Array()};
	$(data2).each(function(index, element) {
	    serie2.data.push(new Array(element.timestamp * 1000, element.success));
	});
	var series = new Array(serie, serie2);

	// Create the chart
	$('#daily-success').highcharts({
	    chart: {
		type: 'line',
	    },
	    title: {
		text: 'Onnistumisprosentti'
	    },
	    xAxis: {
		type: 'datetime'
	    },
	    credits: {
		enabled: false
	    },
	    yAxis: {
		min: 0,
		max: 1,
		title: ''
	    },
	    plotOptions: {
		line: {
		    marker: {
			enabled: false
		    }
		},
		area: {
		    fillColor: {
			linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
			stops: [
			    [0, Highcharts.getOptions().colors[0]],
			    [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
			]
		    },
		    lineWidth: 1,
		    marker: {
			enabled: false
		    },
		    shadow: false,
		    states: {
			hover: {
			    lineWidth: 1
			}
		    },
		    threshold: null
		}
	    },
	    'series': series
	});
    }

    function loadRecommendLine() {
	var serie = {name: "Valinta", data: new Array()};
	$(data1).each(function(index, element) {
	    serie.data.push(new Array(element.timestamp * 1000, element.recommend));
	});

	var serie2 = {name: "Vertailu", data: new Array()};
	$(data2).each(function(index, element) {
	    serie2.data.push(new Array(element.timestamp * 1000, element.recommend));
	});
	var series = new Array(serie, serie2);

	// Create the chart
	$('#daily-recommend').highcharts({
	    chart: {
		type: 'line',
	    },
	    title: {
		text: 'Suosittelu'
	    },
	    xAxis: {
		type: 'datetime'
	    },
	    credits: {
		enabled: false
	    },
	    yAxis: {
		min: 0,
		max: 10,
		title: ''
	    },
	    plotOptions: {
		line: {
		    marker: {
			enabled: false
		    }
		},
		area: {
		    fillColor: {
			linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
			stops: [
			    [0, Highcharts.getOptions().colors[0]],
			    [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
			]
		    },
		    lineWidth: 1,
		    marker: {
			enabled: false
		    },
		    shadow: false,
		    states: {
			hover: {
			    lineWidth: 1
			}
		    },
		    threshold: null
		}
	    },
	    'series': series
	});
    }

    function loadInterestLine() {
	var serie = {name: "Valinta", data: new Array()};
	$(data1).each(function(index, element) {
	    serie.data.push(new Array(element.timestamp * 1000, element.interest));
	});

	var serie2 = {name: "Vertailu", data: new Array()};
	$(data2).each(function(index, element) {
	    serie2.data.push(new Array(element.timestamp * 1000, element.interest));
	});
	var series = new Array(serie, serie2);

	// Create the chart
	$('#daily-interest').highcharts({
	    chart: {
		type: 'line',
	    },
	    title: {
		text: 'Kiinnostavuus'
	    },
	    xAxis: {
		type: 'datetime'
	    },
	    credits: {
		enabled: false
	    },
	    yAxis: {
		min: 0,
		max: 6,
		title: ''
	    },
	    plotOptions: {
		line: {
		    marker: {
			enabled: false
		    }
		},
		area: {
		    fillColor: {
			linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
			stops: [
			    [0, Highcharts.getOptions().colors[0]],
			    [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
			]
		    },
		    lineWidth: 1,
		    marker: {
			enabled: false
		    },
		    shadow: false,
		    states: {
			hover: {
			    lineWidth: 1
			}
		    },
		    threshold: null
		}
	    },
	    'series': series
	});
    }
</script>