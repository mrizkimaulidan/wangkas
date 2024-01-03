<script>
	$(function () {
		const cashTransactionStatisticURL =
			"{{ route('api.v1.cash-transactions.statistics') }}";
		const studentStatisticURL = "{{ route('api.v1.students.statistics') }}";
		let chart = null;

		function initCashTransactionsChartByYear(data) {
			const cashTransactionsChartByYear = {
				chart: {
					type: "bar",
					height: 250,
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
					height: 250,
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

		function updateCashTransactionsChartSeriesByYear(data) {
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
				url: cashTransactionStatisticURL,
				data: {
					year: $("#year").val(),
				},
				success: function (res) {
					$("#card-chart-cash-transactions-title").text(
						`Transaksi Tahun ${$("#year").val()}`
					);

					updateCashTransactionsChartSeriesByYear(res);
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
