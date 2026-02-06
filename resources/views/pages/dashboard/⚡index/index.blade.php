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

            <div id="currentYearLineChart"></div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <livewire:apexcharts.pie title="Pelajar Berdasarkan Jenis Kelamin" chartID="studentGenderChart"
            :series="$this->studentCountByGender" :colors="['#01A6EA', '#FFA9D0']" />
        </div>

        <div class="card">
          <livewire:apexcharts.pie title="Pelajar Berdasarkan Jurusan" chartID="studentByMajorChart"
            :series="$this->studentDistributionByMajor" />
        </div>

        <div class="card">
          <livewire:apexcharts.pie title="Total Transaksi Berdasarkan Jenis Kelamin"
            chartID="transactionCountByGenderChart" :series="$this->transactionCountByGender"
            :colors="['#01A6EA', '#FFA9D0']" />
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

    const monthlyStatistics = @json($this->monthlyTransactionSummary);

    const barChartOptions = {
      chart: {
        type: "bar",
        height: 250,
      },
      series: [{
        name: "Total Transaksi",
        data: monthlyStatistics.monthly_counts.map((data) => data.count),
      }, ],
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

    const lineChartOptions = {
      chart: {
        type: "line",
        height: 250,
      },
      series: [{
        name: "Total Transaksi",
        data: monthlyStatistics.monthly_amounts.map((data) => data.total),
      }, ],
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

    Livewire.on("chart-updated", function (res) {
      barChart.updateSeries([{
        data: res.monthly_counts.map((data) => data.count),
      }, ]);

      lineChart.updateSeries([{
        data: res.monthly_amounts.map((data) => data.total),
      }, ]);
    });
  }, {
    once: true,
  },
);
</script>
