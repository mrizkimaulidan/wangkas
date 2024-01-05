<script>
	$(function () {
		const cashTransactionStatisticURL =
			"{{ route('api.v1.cash-transactions.statistics') }}";
		const studentStatisticURL = "{{ route('api.v1.students.statistics') }}";
		const schoolMajorStatisticURL =
			"{{ route('api.v1.school-majors.statistics') }}";
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

		function initStudentChartGender(data) {
			const options = {
				series: Object.values(data.data),
				labels: Object.keys(data.data).map((genderName) => {
					return genderName === "male" ? "Laki-laki" : "Perempuan";
				}),
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
				options
			).render();
		}

		function initSchoolMajorChartStudentsCount(data) {
			const options = {
				series: data.data.map((schoolMajor) => schoolMajor.students_count),
				labels: data.data.map(
					(schoolMajor) => `${schoolMajor.name} (${schoolMajor.abbreviation})`
				),
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
				document.querySelector("#chart-school-major-students-count"),
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
					height: 300,
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
					year: new Date().getFullYear(),
				},
				success: function (res) {
					initCashTransactionsChartByYear(res);
				},
			});

			$.ajax({
				url: cashTransactionStatisticURL,
				data: {
					amount: new Date().getFullYear(),
				},
				success: function (res) {
					initCashTransactionsChartAmountByYear(res);
				},
			});

			$.ajax({
				url: studentStatisticURL,
				data: {
					by: "gender",
				},
				success: function (res) {
					initStudentChartGender(res);
				},
			});

			$.ajax({
				url: schoolMajorStatisticURL,
				data: {
					filter: "students_count",
				},
				success: function (res) {
					initSchoolMajorChartStudentsCount(res);
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
