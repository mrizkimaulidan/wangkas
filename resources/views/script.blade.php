<script>
	$(function () {
		const cashTransactionStatisticURL =
			"{{ route('api.v1.cash-transactions.statistics') }}";
		let cashTransactionBarChart = null;
		let cashTransactionLineChart = null;

		$.ajax({
			url: cashTransactionStatisticURL,
			data: {
				type: "counts",
				by: new Date().getFullYear(),
			},
			success: function (res) {
				const options = {
					chart: {
						type: "bar",
						height: 250,
					},
					series: [
						{
							name: "Total Transaksi",
							data: [
								res.data.jan,
								res.data.feb,
								res.data.mar,
								res.data.apr,
								res.data.mei,
								res.data.jun,
								res.data.jul,
								res.data.agu,
								res.data.sep,
								res.data.okt,
								res.data.nov,
								res.data.des,
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

				cashTransactionBarChart = new ApexCharts(
					document.querySelector("#cash-transaction-chart-bar-by-year"),
					options
				);
				cashTransactionBarChart.render();
			},
		});

		$.ajax({
			url: cashTransactionStatisticURL,
			data: {
				type: "amounts",
				by: new Date().getFullYear(),
			},
			success: function (res) {
				const options = {
					series: [
						{
							name: "Jumlah Pembayaran",
							data: Object.values(res.data),
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

				cashTransactionLineChart = new ApexCharts(
					document.querySelector("#cash-transaction-chart-line-by-year"),
					options
				);
				cashTransactionLineChart.render();
			},
		});

		function updateBarChart() {
			$.ajax({
				url: cashTransactionStatisticURL,
				data: {
					type: "counts",
					by: $("#year").val(),
				},
				success: function (res) {
					if (cashTransactionBarChart) {
						cashTransactionBarChart.updateSeries([
							{
								data: [
									res.data.jan,
									res.data.feb,
									res.data.mar,
									res.data.apr,
									res.data.mei,
									res.data.jun,
									res.data.jul,
									res.data.agu,
									res.data.sep,
									res.data.okt,
									res.data.nov,
									res.data.des,
								],
							},
						]);
					}
				},
			});
		}

		function updateLineChart() {
			$.ajax({
				url: cashTransactionStatisticURL,
				data: {
					type: "amounts",
					by: $("#year").val(),
				},
				success: function (res) {
					if (cashTransactionLineChart) {
						cashTransactionLineChart.updateSeries([
							{
								data: [
									res.data.jan,
									res.data.feb,
									res.data.mar,
									res.data.apr,
									res.data.mei,
									res.data.jun,
									res.data.jul,
									res.data.agu,
									res.data.sep,
									res.data.okt,
									res.data.nov,
									res.data.des,
								],
							},
						]);
					}
				},
			});
		}

		$("#year").keyup(function (e) {
			if(!$('#year').val().trim()) return;

			if (e.keyCode === 13) {
				updateBarChart();
				updateLineChart();
			}
		});
	});
</script>
