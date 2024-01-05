<div>
	<div class="card-header">
		<h4>{{ $chartTitle }}</h4>
	</div>
	<div class="card-body">
		<div id="{{ $chartID }}"></div>
	</div>
</div>

@push('scripts')
<script>
	$(function() {
  const chartID = "#{{ $chartID }}";
  const url = "{{ $url }}";
  const formData = @json($formData);

  $.ajax({
    url: url,
    data: formData,
    success: function(res) {
      const options = {
        series: [{
          name: "{{ $seriesTitle }}",
          data: Object.values(res.data),
        }, ],
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
          categories: Object.keys(res.data),
        },
      };

      new ApexCharts(document.querySelector(chartID), options).render();
    },
  });
});
</script>
@endpush
