<div>
  <div class="card-header">
    <h4>{{ $title }}</h4>
  </div>

  <div class="card-body">
    <div id="{{ $chartID }}"></div>
  </div>
</div>

<script>
  document.addEventListener(
  "livewire:navigated",
  () => {
    const id = "#{{ $chartID }}"
    const series = @json($series);
    const colors = @json($colors)

    var options = {
      series: Object.values(series),
      chart: {
        type: "donut",
        height: "auto",
        width: "100%",
      },
      labels: Object.keys(series),
      plotOptions: {
        pie: {
          donut: {
            size: "30%",
          },
          offsetX: 0,
          offsetY: 0,
        },
      },
      legend: {
        position: "bottom",
        horizontalAlign: "center",
      },
      responsive: [
        {
          breakpoint: 480,
          options: {
            chart: {
              height: 300,
            },
            plotOptions: {
              pie: {
                donut: {
                  size: "40%",
                },
              },
            },
            legend: {
              position: "bottom",
              fontSize: "10px",
              itemMargin: {
                horizontal: 5,
                vertical: 3,
              },
            },
          },
        },
      ],
    };

    @isset($colors)
      options.colors = colors;
    @endisset

    var chart = new ApexCharts(document.querySelector(id), options);
    chart.render();
  },
  { once: true },
);
</script>
