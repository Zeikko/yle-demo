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
		loadTraffic();
		}'
    ),
));

echo $form->hiddenField($filter, 'from', array('name' => 'from'));
echo $form->hiddenField($filter, 'to', array('name' => 'to'));

$this->endWidget();
?>
<div id="daily-traffic"></div>
<script type="text/javascript">
    $(function() {
	loadTraffic();
    });

    function loadTraffic() {
	$.ajax({
	    dataType: "json",
	    url: '<?php echo $this->createUrl('api/traffic') ?>',
	    data: $('#filterForm').serialize(),
	    success: function(data) {
		loadTrafficLine(data);
	    }
	});
    }

    function loadTrafficLine(data) {
	var current = {name: "Kävijät", data: new Array()};
	var expected = {type: "area", name: "Edellisen 10 vastaavan viikonpäivän keskiarvo", data: new Array()};
	$(data).each(function(index, element) {
	    current.data.push(new Array(element.timestamp * 1000, element.currentCount));
	    expected.data.push(new Array(element.timestamp * 1000, element.expected));
	});
	var series = new Array(expected, current);

	// Create the chart
	$('#daily-traffic').highcharts({
	    chart: {
		type: 'line',
	    },
	    title: {
		text: 'Kävijät'
	    },
	    xAxis: {
		type: 'datetime'
	    },
	    credits: {
		enabled: false
	    },
	    yAxis: {
		min: 0,
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