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
	$(function () {
		const chartID = "#{{ $chartID }}";
		const series = @json($series);
		const categories = @json($categories);

		const options = {
			series: [
				{
					name: "{{ $seriesTitle }}",
					data: series,
				},
			],
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
				categories: categories,
			},
		};

		new ApexCharts(document.querySelector(chartID), options).render();
	});
</script>
@endpush
