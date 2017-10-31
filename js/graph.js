$(function () {
	var data=null;
	$.ajax({
		url : 'dataGraph.php',
		success : function (donnees) {
			data = $.parseJSON(donnees);
			console.log(data);
			champs = data[0].stack;

			Highcharts.chart('container', {

				chart: {
					type: 'column'
				},

				title: {
					text: 'Histogramme'
				},

				xAxis: {
					categories: champs
				},

				yAxis: {
					allowDecimals: false,
					min: 0,
					title: {
						text: "Nombre d'etudiants"
					}
				},

				tooltip: {
					formatter: function () {
						return '<b>' + this.x + '</b><br/>' +
							this.series.name + ': ' + this.y + '<br/>' +
							'Total: ' + this.point.stackTotal;
					}
				},

				plotOptions: {
					column: {
						stacking: 'normal'
					}
				},
				series : data
			});
		}
	});

	$.ajax({
		url: 'dataCircGraph.php',
		success: function (donnees) {
			data = $.parseJSON(donnees);
			console.log(data);
			console.log([{
				name: 'Etudiants',
				colorByPoint: true,
				data:
					[{
						name: 'Microsoft Internet Explorer',
						y: 56.33
					}, {
						name: 'Chrome',
						y: 24.03
					}, {
						name: 'Firefox',
						y: 10.38
					}, {
						name: 'Safari',
						y: 4.77
					}, {
						name: 'Opera',
						y: 0.91
					}, {
						name: 'Proprietary or Undetectable',
						y: 0.2
					}]
			}]);

			Highcharts.chart('container1', {
				chart: {
					plotBackgroundColor: null,
					plotBorderWidth: null,
					plotShadow: false,
					type: 'pie'
				},
				title: {
					text: 'Diagramme circulaire'
				},
				tooltip: {
					pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
				},
				plotOptions: {
					pie: {
						allowPointSelect: true,
						cursor: 'pointer',
						dataLabels: {
							enabled: true,
							format: '<b>{point.name}</b>: {point.percentage:.1f} %',
							style: {
								color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
							}
						}
					}
				},
				series: data
			});
		}}
	);
});