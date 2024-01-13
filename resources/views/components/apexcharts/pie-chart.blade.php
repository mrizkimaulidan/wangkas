<div>
	<div class="card-header text-center">
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

		const options = {
			series: @json($series),
			labels: @json($labels),
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

		new ApexCharts(document.querySelector(chartID), options).render();
	});
</script>
@endpush
