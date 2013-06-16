<div class="span3" id="traffic-gauge"></div>
<div class="span3" id="success-gauge"></div>
<div class="span3" id="interest-gauge"></div>
<div class="span3" id="recommend-gauge"></div>
<script type="text/javascript">
    $(function() {
	loadTraffic();
	loadSurvey();
    });

    function loadTraffic() {
	$.ajax({
	    dataType: "json",
	    url: '<?php echo $this->createUrl('api/traffic') ?>',
	    data: {
		from: '<?php echo strtotime('today') ?>',
	    },
	    success: function(data) {
		loadTrafficGauge(data);
	    }
	});
    }

    function loadSurvey() {
	$.ajax({
	    dataType: "json",
	    url: '<?php echo $this->createUrl('api/survey') ?>',
	    data: {
		from: '<?php echo strtotime('today') ?>',
	    },
	    success: function(data) {
		loadSuccessGauge(data);
		loadInterestGauge(data);
		loadRecommendGauge(data);
	    }
	});
    }

    function loadTrafficGauge(data) {
	// Create the chart
	$('#traffic-gauge').highcharts({
	    chart: {
		type: 'gauge',
		plotBackgroundColor: null,
		plotBackgroundImage: null,
		plotBorderWidth: 0,
		plotShadow: false
	    },
	    credits: {
		enabled: false
	    },
	    title: {
		text: 'Selaintavoitteen toteuma'
	    },
	    pane: {
		startAngle: -150,
		endAngle: 150,
		background: [{
			backgroundColor: {
			    linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
			    stops: [
				[0, '#FFF'],
				[1, '#333']
			    ]
			},
			borderWidth: 0,
			outerRadius: '109%'
		    }, {
			backgroundColor: {
			    linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
			    stops: [
				[0, '#333'],
				[1, '#FFF']
			    ]
			},
			borderWidth: 1,
			outerRadius: '107%'
		    }, {
			// default background
		    }, {
			backgroundColor: '#DDD',
			borderWidth: 0,
			outerRadius: '105%',
			innerRadius: '103%'
		    }]
	    },
	    // the value axis
	    yAxis: {
		min: 0,
		max: 100,
		minorTickInterval: 'auto',
		minorTickWidth: 1,
		minorTickLength: 10,
		minorTickPosition: 'inside',
		minorTickColor: '#666',
		tickPixelInterval: 30,
		tickWidth: 2,
		tickPosition: 'inside',
		tickLength: 10,
		tickColor: '#666',
		labels: {
		    step: 2,
		    rotation: 'auto'
		},
		title: {
		    text: ''
		},
		plotBands: [{
			from: 0,
			to: 70,
			color: '#DF5353' // red

		    }, {
			from: 70,
			to: 90,
			color: '#DDDF0D' // yellow
		    }, {
			from: 90,
			to: 100,
			color: '#55BF3B' // green
		    }]
	    },
	    series: [{
		    name: 'Selaintavoitteen toteuma',
		    data: [Math.round(data[0].currentCount / data[0].expected * 100 * 100) / 100],
		    tooltip: {
			valueSuffix: ' %'
		    }
		}]
	});
    }

    function loadSuccessGauge(data) {
	// Create the chart
	$('#success-gauge').highcharts({
	    chart: {
		type: 'gauge',
		plotBackgroundColor: null,
		plotBackgroundImage: null,
		plotBorderWidth: 0,
		plotShadow: false
	    },
	    credits: {
		enabled: false
	    },
	    title: {
		text: 'Käyntien onnistumisprosentti'
	    },
	    pane: {
		startAngle: -150,
		endAngle: 150,
		background: [{
			backgroundColor: {
			    linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
			    stops: [
				[0, '#FFF'],
				[1, '#333']
			    ]
			},
			borderWidth: 0,
			outerRadius: '109%'
		    }, {
			backgroundColor: {
			    linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
			    stops: [
				[0, '#333'],
				[1, '#FFF']
			    ]
			},
			borderWidth: 1,
			outerRadius: '107%'
		    }, {
			// default background
		    }, {
			backgroundColor: '#DDD',
			borderWidth: 0,
			outerRadius: '105%',
			innerRadius: '103%'
		    }]
	    },
	    // the value axis
	    yAxis: {
		min: 0,
		max: 100,
		minorTickInterval: 'auto',
		minorTickWidth: 1,
		minorTickLength: 10,
		minorTickPosition: 'inside',
		minorTickColor: '#666',
		tickPixelInterval: 30,
		tickWidth: 2,
		tickPosition: 'inside',
		tickLength: 10,
		tickColor: '#666',
		labels: {
		    step: 2,
		    rotation: 'auto'
		},
		title: {
		    text: ''
		},
		plotBands: [{
			from: 0,
			to: 70,
			color: '#DF5353' // red

		    }, {
			from: 70,
			to: 90,
			color: '#DDDF0D' // yellow
		    }, {
			from: 90,
			to: 100,
			color: '#55BF3B' // green
		    }]
	    },
	    series: [{
		    name: 'Käyntien onnistumisprosentti',
		    data: [Math.round(data.total.success * 100 * 100) / 100],
		    tooltip: {
			valueSuffix: ' %'
		    }
		}]
	});
    }

    function loadInterestGauge(data) {
	// Create the chart
	$('#interest-gauge').highcharts({
	    chart: {
		type: 'gauge',
		plotBackgroundColor: null,
		plotBackgroundImage: null,
		plotBorderWidth: 0,
		plotShadow: false
	    },
	    credits: {
		enabled: false
	    },
	    title: {
		text: 'Kiinnostavuus'
	    },
	    pane: {
		startAngle: -150,
		endAngle: 150,
		background: [{
			backgroundColor: {
			    linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
			    stops: [
				[0, '#FFF'],
				[1, '#333']
			    ]
			},
			borderWidth: 0,
			outerRadius: '109%'
		    }, {
			backgroundColor: {
			    linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
			    stops: [
				[0, '#333'],
				[1, '#FFF']
			    ]
			},
			borderWidth: 1,
			outerRadius: '107%'
		    }, {
			// default background
		    }, {
			backgroundColor: '#DDD',
			borderWidth: 0,
			outerRadius: '105%',
			innerRadius: '103%'
		    }]
	    },
	    // the value axis
	    yAxis: {
		min: 0,
		max: 6,
		minorTickInterval: 'auto',
		minorTickWidth: 1,
		minorTickLength: 10,
		minorTickPosition: 'inside',
		minorTickColor: '#666',
		tickPixelInterval: 30,
		tickWidth: 2,
		tickPosition: 'inside',
		tickLength: 10,
		tickColor: '#666',
		labels: {
		    step: 2,
		    rotation: 'auto'
		},
		title: {
		    text: ''
		},
		plotBands: [{
			from: 0,
			to: 3,
			color: '#DF5353' // red

		    }, {
			from: 3,
			to: 5,
			color: '#DDDF0D' // yellow
		    }, {
			from: 5,
			to: 6,
			color: '#55BF3B' // green
		    }]
	    },
	    series: [{
		    name: 'Kiinnostavuus',
		    data: [Math.round(data.total.interest * 100) / 100],
		    tooltip: {
			valueSuffix: ''
		    }
		}]
	});
    }

    function loadRecommendGauge(data) {
	// Create the chart
	$('#recommend-gauge').highcharts({
	    chart: {
		type: 'gauge',
		plotBackgroundColor: null,
		plotBackgroundImage: null,
		plotBorderWidth: 0,
		plotShadow: false
	    },
	    credits: {
		enabled: false
	    },
	    title: {
		text: 'Suosittelu'
	    },
	    pane: {
		startAngle: -150,
		endAngle: 150,
		background: [{
			backgroundColor: {
			    linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
			    stops: [
				[0, '#FFF'],
				[1, '#333']
			    ]
			},
			borderWidth: 0,
			outerRadius: '109%'
		    }, {
			backgroundColor: {
			    linearGradient: {x1: 0, y1: 0, x2: 0, y2: 1},
			    stops: [
				[0, '#333'],
				[1, '#FFF']
			    ]
			},
			borderWidth: 1,
			outerRadius: '107%'
		    }, {
			// default background
		    }, {
			backgroundColor: '#DDD',
			borderWidth: 0,
			outerRadius: '105%',
			innerRadius: '103%'
		    }]
	    },
	    // the value axis
	    yAxis: {
		min: 0,
		max: 10,
		minorTickInterval: 'auto',
		minorTickWidth: 1,
		minorTickLength: 10,
		minorTickPosition: 'inside',
		minorTickColor: '#666',
		tickPixelInterval: 30,
		tickWidth: 2,
		tickPosition: 'inside',
		tickLength: 10,
		tickColor: '#666',
		labels: {
		    step: 2,
		    rotation: 'auto'
		},
		title: {
		    text: ''
		},
		plotBands: [{
			from: 0,
			to: 7,
			color: '#DF5353' // red

		    }, {
			from: 7,
			to: 9,
			color: '#DDDF0D' // yellow
		    }, {
			from: 9,
			to: 10,
			color: '#55BF3B' // green
		    }]
	    },
	    series: [{
		    name: 'Suosittelu',
		    data: [Math.round(data.total.recommend * 100) / 100],
		    tooltip: {
			valueSuffix: ''
		    }
		}]
	});
    }


</script>