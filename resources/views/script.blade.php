<script>
	$(function () {
    let url = "{{ route('api.v1.cash-transactions.statistics') }}";
    let chart = null;

    function initChart() {
      $.ajax({
        url: url,
        data: {
          year: new Date().getFullYear(),
        },
        success: function (res) {
          let cashTransactionsChartByYear = {
            chart: {
              type: "bar",
              height: 300,
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

          chart = new ApexCharts(
            document.querySelector("#chart-cash-transactions-by-year"),
            cashTransactionsChartByYear
          );
          chart.render();
        },
      });
    }

    function updateChartSeries(data) {
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

    // Initialize the chart when the page loads
    initChart();

    $("#year").keypress(function (e) {
      if (e.keyCode === 13) {
        $.ajax({
          url: url,
          data: {
            year: $("#year").val(),
          },
          success: function (res) {
            $("#card-chart-cash-transactions-title").text(
              `Peminjaman Tahun ${$("#year").val()}`
            );

            updateChartSeries(res);
          },
        });
      }
    });
  });
</script>
