<script>
	$(function () {
		const cashTransactionStatisticURL =
			"{{ route('api.v1.cash-transactions.statistics') }}";
		let chart = null;

		function initCashTransactionsChartAmountByYear(data) {
			const options = {
				series: [
					{
						name: "Jumlah Pembayaran",
						data: Object.values(data.data),
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
						colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
						opacity: 0.5,
					},
				},
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

			new ApexCharts(
				document.querySelector("#chart-cash-transactions-amount-by-year"),
				options
			).render();
		}

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
							data.data.mei,
							data.data.jun,
							data.data.jul,
							data.data.agu,
							data.data.sep,
							data.data.okt,
							data.data.nov,
							data.data.des,
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

		function updateCashTransactionsChartSeriesByYear(data) {
			if (chart) {
				chart.updateSeries([
					{
						data: [
							data.data.jan,
							data.data.feb,
							data.data.mar,
							data.data.apr,
							data.data.mei,
							data.data.jun,
							data.data.jul,
							data.data.agu,
							data.data.sep,
							data.data.okt,
							data.data.nov,
							data.data.des,
						],
					},
				]);
			}
		}

		function initCharts() {
			$.ajax({
				url: cashTransactionStatisticURL,
				data: {
					type: "counts",
					by: new Date().getFullYear(),
				},
				success: function (res) {
					initCashTransactionsChartByYear(res);
				},
			});

			$.ajax({
				url: cashTransactionStatisticURL,
				data: {
					type: "amounts",
					by: new Date().getFullYear(),
				},
				success: function (res) {
					initCashTransactionsChartAmountByYear(res);
				},
			});
		}

		function updateCashTransactionsChartByYear() {
			$.ajax({
				url: cashTransactionStatisticURL,
				data: {
					type: "counts",
					by: $("#year").val(),
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
