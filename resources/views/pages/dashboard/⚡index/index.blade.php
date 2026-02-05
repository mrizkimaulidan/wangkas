<div>
  <section class="row">
    <div class="col-md-3">
      <livewire:statistic-status label="Pelajar" value="{{ $this->studentCount }}" icon="bi-backpack" color="primary" />
    </div>
    <div class="col-md-3">
      <livewire:statistic-status label="Kelas" value="{{ $this->schoolClassCount }}" icon="bi-bookmark" color="info" />
    </div>
    <div class="col-md-3">
      <livewire:statistic-status label="Jurusan" value="{{ $this->schoolMajorCount }}" icon="bi-briefcase"
        color="warning" />
    </div>
    <div class="col-md-3">
      <livewire:statistic-status label="Pengguna" value="{{ $this->userCount }}" icon="bi-person-badge"
        color="danger" />
    </div>
  </section>

  <main>
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h4>Total Transaksi Tahun Ini</h4>
          </div>
          <div class="card-body">
            <div class="mb-3">
              <label for="year" class="form-label">Isi Tahun:</label>
              <input wire:model="year" wire:keyup.enter="updateChart" type="number" class="form-control"
                placeholder="Masukan tahun...">
              <small class="text-muted">Tekan tombol 'Enter' untuk menampilkan grafik berdasarkan tahun yang
                diinginkan.</small>
            </div>
            <div id="currentYearBarChart"></div>
          </div>
          <div id="currentYearLineChart"></div>
        </div>
      </div>
    </div>
  </main>
</div>

<script>
  document.addEventListener(
  "livewire:navigated",
  () => {
    const barChartID = "#currentYearBarChart";
    const lineChartID = "#currentYearLineChart";

    const categories = [
      "Jan",
      "Feb",
      "Mar",
      "Apr",
      "Mei",
      "Jun",
      "Jul",
      "Agu",
      "Sept",
      "Okt",
      "Nov",
      "Des",
    ];
    const barChartSeries = @json($monthlyTransactionSummary['count']);

    const barChartOptions = {
      chart: {
        type: "bar",
        height: 250,
      },
      series: [
        {
          name: "Total Transaksi",
          data: [
            barChartSeries["jan"],
            barChartSeries["feb"],
            barChartSeries["mar"],
            barChartSeries["apr"],
            barChartSeries["mei"],
            barChartSeries["jun"],
            barChartSeries["jul"],
            barChartSeries["agu"],
            barChartSeries["sep"],
            barChartSeries["okt"],
            barChartSeries["nov"],
            barChartSeries["des"],
          ],
        },
      ],
      colors: ["#435ebe"],
      xaxis: {
        categories: categories,
      },
    };

    barChart = new ApexCharts(
      document.querySelector(barChartID),
      barChartOptions,
    );

    barChart.render();

    const lineChartSeries = @json($this->monthlyTransactionSummary['amount']);

    const lineChartOptions = {
      chart: {
        type: "line",
        height: 250,
      },
      series: [
        {
          name: "Total Transaksi",
          data: [
            lineChartSeries["jan"],
            lineChartSeries["feb"],
            lineChartSeries["mar"],
            lineChartSeries["apr"],
            lineChartSeries["mei"],
            lineChartSeries["jun"],
            lineChartSeries["jul"],
            lineChartSeries["agu"],
            lineChartSeries["sep"],
            lineChartSeries["okt"],
            lineChartSeries["nov"],
            lineChartSeries["des"],
          ],
        },
      ],
      colors: ["#435ebe"],
      xaxis: {
        categories: categories,
      },
    };

    lineChart = new ApexCharts(
      document.querySelector(lineChartID),
      lineChartOptions,
    );

    lineChart.render();

    Livewire.on("chart-updated", function (e) {
      barChart.updateSeries([
        {
          data: [
            e.count.jan,
            e.count.feb,
            e.count.mar,
            e.count.apr,
            e.count.mei,
            e.count.jun,
            e.count.jul,
            e.count.agu,
            e.count.sep,
            e.count.okt,
            e.count.nov,
            e.count.des,
          ],
        },
      ]);

      lineChart.updateSeries([
        {
          data: [
            e.amount.jan,
            e.amount.feb,
            e.amount.mar,
            e.amount.apr,
            e.amount.mei,
            e.amount.jun,
            e.amount.jul,
            e.amount.agu,
            e.amount.sep,
            e.amount.okt,
            e.amount.nov,
            e.amount.des,
          ],
        },
      ]);
    });
  },
  {
    once: true,
  },
);
</script>
