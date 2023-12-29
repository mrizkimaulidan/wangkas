<script>
	$(function () {
		const url = "{{ route('api.v1.cash-transactions.statistics') }}";
		const studentsURL = "{{ route('api.v1.students.statistics') }}";
		let chart = null;

		function initCashTransactionsChart(data) {
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

		function updateCashTransactionsChartSeries(data) {
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

		function initStudentChart(data) {
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
				url: url,
				data: {
					year: new Date().getFullYear(),
				},
				success: function (res) {
					initCashTransactionsChart(res);
				},
			});

			$.ajax({
				url: studentsURL,
				data: {
					by: "gender",
				},
				success: function (res) {
					initStudentChart(res);
				},
			});
		}

		function updateChartByYear() {
			$.ajax({
				url: url,
				data: {
					year: $("#year").val(),
				},
				success: function (res) {
					$("#card-chart-cash-transactions-title").text(
						`Peminjaman Tahun ${$("#year").val()}`
					);

					updateCashTransactionsChartSeries(res);
				},
			});
		}

		// Initialize the charts when the page loads
		initCharts();

		$("#year").keyup(function (e) {
			if (e.keyCode === 13) {
				updateChartByYear();
			}
		});
	});
</script>
