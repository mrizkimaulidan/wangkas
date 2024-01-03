<script>
	$(function () {
		const cashTransactionStatisticURL = "{{ route('api.v1.cash-transactions.statistics') }}";
		const studentStatisticURL = "{{ route('api.v1.students.statistics') }}";
		let chart = null;

		function initCashTransactionsChartByYear(data) {
			const cashTransactionsChartByYear = {
				chart: {
					type: "bar",
					height: 300,
				},
				series: [
					{
						name: "Total Transaksi",
						data: [
							data.data.jan,
							data.data.feb,
							data.data.mar,
							data.data.apr,
							data.data.may,
							data.data.jun,
							data.data.jul,
							data.data.aug,
							data.data.sep,
							data.data.oct,
							data.data.nov,
							data.data.dec,
						],
					},
				],
				colors: ["#435ebe"],
				xaxis: {
					categories: [
						"Jan",
						"Feb",
						"Mar",
						"Apr",
						"Mei",
						"Jun",
						"Jul",
						"Agu",
						"Sep",
						"Okt",
						"Nov",
						"Des",
					],
				},
			};

			chart = new ApexCharts(
				document.querySelector("#chart-cash-transactions-by-year"),
				cashTransactionsChartByYear
			);
			chart.render();
		}

		function initCashTransactionsChartPerYear(data) {
			const years = Object.keys(data.data);
			const yearValues = Object.values(data.data);

			const cashTransactionChartPerYear = {
				series: [
					{
						name: "Total Transaksi",
						data: yearValues,
					},
				],
				chart: {
					height: 350,
					type: "line",
					zoom: {
						enabled: false,
					},
				},
				dataLabels: {
					enabled: false,
				},
				stroke: {
					curve: "straight",
				},
				grid: {
					row: {
						colors: ["#f3f3f3", "transparent"],
						opacity: 0.5,
					},
				},
				xaxis: {
					categories: years,
				},
			};

			new ApexCharts(
				document.querySelector("#chart-cash-transactions-per-year"),
				cashTransactionChartPerYear
			).render();
		}

		function updateCashTransactionsChartByYear(data) {
			if (chart) {
				chart.updateSeries([
					{
						data: [
							data.data.jan,
							data.data.feb,
							data.data.mar,
							data.data.apr,
							data.data.may,
							data.data.jun,
							data.data.jul,
							data.data.aug,
							data.data.sep,
							data.data.oct,
							data.data.nov,
							data.data.dec,
						],
					},
				]);
			}
		}

		function initStudentGenderChart(data) {
			const studentChartPieGender = {
				series: [data.data.male, data.data.female],
				labels: ["Laki-laki", "Perempuan"],
				colors: ["#57CAEB", "#FF7976"],
				chart: {
					type: "donut",
					width: "100%",
					height: "350px",
				},
				legend: {
					position: "bottom",
				},
				plotOptions: {
					pie: {
						donut: {
							size: "30%",
						},
					},
				},
			};

			new ApexCharts(
				document.querySelector("#chart-students-gender"),
				studentChartPieGender
			).render();
		}

		function initCharts() {
			$.ajax({
				url: cashTransactionStatisticURL,
				data: {
					year: new Date().getFullYear(),
				},
				success: function (res) {
					initCashTransactionsChartByYear(res);
				},
			});

			$.ajax({
				url: studentStatisticURL,
				data: {
					by: "gender",
				},
				success: function (res) {
					initStudentGenderChart(res);
				},
			});

			$.ajax({
				url: cashTransactionStatisticURL,
				data: {
					year: "per_year",
				},
				success: function (res) {
					initCashTransactionsChartPerYear(res);
				},
			});
		}

		function updateCashTransactionsChartByYear() {
			$.ajax({
				url: url,
				data: {
					year: $("#year").val(),
				},
				success: function (res) {
					$("#card-chart-cash-transactions-title").text(
						`Transaksi Tahun ${$("#year").val()}`
					);

					updateCashTransactionsChartByYear(res);
				},
			});
		}

		// Initialize the charts when the page loads
		initCharts();

		$("#year").keyup(function (e) {
			if (e.keyCode === 13) {
				updateCashTransactionsChartByYear();
			}
		});
	});
</script>
