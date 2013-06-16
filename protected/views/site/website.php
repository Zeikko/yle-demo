<div class="span6" id="success-web"></div>
<div class="span6" id="interest-web"></div>
<div class="span6" id="recommend-web"></div>
<div class="span6" id="age-web"></div>
<div class="span6" id="gender-web"></div>
<div class="span6" id="age-distribution"></div>
<script type="text/javascript">
    $(function() {
	loadWebsites();
    });

    function loadWebsites() {
	$.ajax({
	    dataType: "json",
	    url: '<?php echo $this->createUrl('api/website') ?>',
	    success: function(data) {
		loadSuccess(data);
		loadInterest(data);
		loadRecommend(data);
		loadAge(data);
		loadGender(data);
		loadAgeDistribution(data);
	    }
	});
    }

    function loadSuccess(data) {
	var series = {name: "Onnistumisprosentti", data: new Array()};
	var categories = new Array();
	$(data).each(function(index, element) {
	    series.data.push(Math.round(element.success * 100 * 100) / 100);
	    categories.push(element.website);
	});
	$('#success-web').highcharts({
	    chart: {
		type: 'column'
	    },
	    title: {
		text: 'Onnistumisprosentti',
	    },
	    xAxis: {
		categories: categories,
		tickmarkPlacement: 'on',
		lineWidth: 0,
		labels: {
		    rotation: -45,
		    align: 'right',
		    style: {
			fontSize: '13px',
			fontFamily: 'Verdana, sans-serif'
		    }
		}
	    },
	    yAxis: {
		gridLineInterpolation: 'polygon',
		lineWidth: 0,
		min: 0,
		max: 100,
		title: ''
	    },
	    tooltip: {
		shared: true,
		pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.2f} %</b><br/>'
	    },
	    legend: {
		enabled: false
	    },
	    credits: {
		enabled: false
	    },
	    series: new Array(series)

	});
    }

    function loadInterest(data) {
	var series = {name: "Kiinnostavuus", data: new Array()};
	var categories = new Array();
	$(data).each(function(index, element) {
	    series.data.push(element.interest);
	    categories.push(element.website);
	});
	$('#interest-web').highcharts({
	    chart: {
		type: 'column'
	    },
	    title: {
		text: 'Kiinnostavuus',
	    },
	    xAxis: {
		categories: categories,
		tickmarkPlacement: 'on',
		lineWidth: 0,
		labels: {
		    rotation: -45,
		    align: 'right',
		    style: {
			fontSize: '13px',
			fontFamily: 'Verdana, sans-serif'
		    }
		}
	    },
	    yAxis: {
		gridLineInterpolation: 'polygon',
		lineWidth: 0,
		min: 0,
		max: 6,
		title: ''
	    },
	    tooltip: {
		shared: true,
		pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.2f}</b><br/>'
	    },
	    legend: {
		enabled: false
	    },
	    credits: {
		enabled: false
	    },
	    series: new Array(series)

	});
    }

    function loadRecommend(data) {
	var series = {name: "Suosittelu", data: new Array()};
	var categories = new Array();
	$(data).each(function(index, element) {
	    series.data.push(element.recommend);
	    categories.push(element.website);
	});
	$('#recommend-web').highcharts({
	    chart: {
		type: 'column'
	    },
	    title: {
		text: 'Suosittelu',
	    },
	    xAxis: {
		categories: categories,
		tickmarkPlacement: 'on',
		lineWidth: 0,
		labels: {
		    rotation: -45,
		    align: 'right',
		    style: {
			fontSize: '13px',
			fontFamily: 'Verdana, sans-serif'
		    }
		}
	    },
	    yAxis: {
		gridLineInterpolation: 'polygon',
		lineWidth: 0,
		min: 0,
		max: 10,
		title: ''
	    },
	    tooltip: {
		shared: true,
		pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.2f}</b><br/>'
	    },
	    legend: {
		enabled: false
	    },
	    credits: {
		enabled: false
	    },
	    series: new Array(series)

	});
    }

    function loadAge(data) {
	var series = {name: "Keski-ikä", data: new Array()};
	var categories = new Array();
	$(data).each(function(index, element) {
	    series.data.push(element.age);
	    categories.push(element.website);
	});
	$('#age-web').highcharts({
	    chart: {
		type: 'column'
	    },
	    title: {
		text: 'Keski-ikä',
	    },
	    xAxis: {
		categories: categories,
		tickmarkPlacement: 'on',
		lineWidth: 0,
		labels: {
		    rotation: -45,
		    align: 'right',
		    style: {
			fontSize: '13px',
			fontFamily: 'Verdana, sans-serif'
		    }
		}
	    },
	    yAxis: {
		gridLineInterpolation: 'polygon',
		lineWidth: 0,
		min: 0,
		title: ''
	    },
	    tooltip: {
		shared: true,
		pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.2f}</b><br/>'
	    },
	    legend: {
		enabled: false
	    },
	    credits: {
		enabled: false
	    },
	    series: new Array(series)

	});
    }

    function loadGender(data) {
	var male = {color: '#000099', name: "Miehet", data: new Array()};
	var female = {color: '#990000', name: "Naiset", data: new Array()};
	var categories = new Array();
	var total = 0;
	$(data).each(function(index, element) {
	    total = element.male + element.female;
	    male.data.push(element.male / total * 100);
	    female.data.push(element.female / total * 100);
	    categories.push(element.website);
	});
	$('#gender-web').highcharts({
	    chart: {
		type: 'column'
	    },
	    plotOptions: {
		column: {
		    stacking: 'percent'
		}
	    },
	    title: {
		text: 'Sukupuoli',
	    },
	    xAxis: {
		categories: categories,
		tickmarkPlacement: 'on',
		lineWidth: 0,
		labels: {
		    rotation: -45,
		    align: 'right',
		    style: {
			fontSize: '13px',
			fontFamily: 'Verdana, sans-serif'
		    }
		}
	    },
	    yAxis: {
		gridLineInterpolation: 'polygon',
		lineWidth: 0,
		min: 0,
		title: ''
	    },
	    tooltip: {
		shared: true,
		pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.2f} %</b><br/>'
	    },
	    credits: {
		enabled: false
	    },
	    series: new Array(male, female)

	});
    }

    function loadAgeDistribution(data) {
	var lessThan20 = {name: "<20", data: new Array()};
	var age20 = {name: "21-30", data: new Array()};
	var age30 = {name: "31-40", data: new Array()};
	var age40 = {name: "41-50", data: new Array()};
	var age50 = {name: "51-60", data: new Array()};
	var age60 = {name: "61-70", data: new Array()};
	var moreThan70 = {name: ">70", data: new Array()};
	var categories = new Array();
	var total = 0;
	$(data).each(function(index, element) {
	    total = element.male + element.female;
	    lessThan20.data.push(element.lessThan20 / total * 100);
	    age20.data.push(element.age20 / total * 100);
	    age30.data.push(element.age30 / total * 100);
	    age40.data.push(element.age40 / total * 100);
	    age50.data.push(element.age50 / total * 100);
	    age60.data.push(element.age60 / total * 100);
	    moreThan70.data.push(element.moreThan70 / total * 100);
	    categories.push(element.website);
	});
	$('#age-distribution').highcharts({
	    chart: {
		type: 'column'
	    },
	    plotOptions: {
		column: {
		    stacking: 'percent'
		}
	    },
	    title: {
		text: 'Ikäjakauma',
	    },
	    xAxis: {
		categories: categories,
		tickmarkPlacement: 'on',
		lineWidth: 0,
		labels: {
		    rotation: -45,
		    align: 'right',
		    style: {
			fontSize: '13px',
			fontFamily: 'Verdana, sans-serif'
		    }
		}
	    },
	    yAxis: {
		gridLineInterpolation: 'polygon',
		lineWidth: 0,
		min: 0,
		title: ''
	    },
	    tooltip: {
		shared: true,
		pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.2f} %</b><br/>'
	    },
	    credits: {
		enabled: false
	    },
	    series: new Array(lessThan20, age20, age30, age40, age50, age60, moreThan70)

	});
    }
</script>