<script>
	$(function () {
		const table = $("#table").DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('api.v1.datatables.administrators.index') }}",
			columns: [
				{ data: "DT_RowIndex", name: "DT_RowIndex" },
				{ data: "name", name: "name" },
				{ data: "email", name: "email" },
				{ data: "created_at", name: "created_at" },
				{ data: "action", name: "action" },
			],
		});

		$("#createModal form").submit(function (e) {
			e.preventDefault();

			const formData = {
				name: $("#createModal form #name").val(),
				email: $("#createModal form #email").val(),
				password: $("#createModal form #password").val(),
				password_confirmation: $(
					"#createModal form #password_confirmation"
				).val(),
			};

			$.ajax({
				url: "{{ route('api.v1.datatables.administrators.store') }}",
				method: "POST",
				header: {
					"Content-Type": "application/json",
				},
				data: formData,
				success: (res) => {
					table.ajax.reload();
					$("#createModal").modal("hide");

					Swal.fire({
						icon: "success",
						title: "Data administrator berhasil ditambahkan!",
						toast: true,
						position: "top-end",
						showConfirmButton: false,
						timer: 3000,
						timerProgressBar: true,
						didOpen: (toast) => {
							toast.addEventListener("mouseenter", Swal.stopTimer);
							toast.addEventListener("mouseleave", Swal.resumeTimer);
						},
					});
				},
				error: (err) => {
					Swal.fire({
						icon: "warning",
						title: "Perhatian!",
						text: err.responseJSON.message,
					});
				},
			});
		});

		$("#table").on("click", ".show-modal", function () {
			const id = $(this).data("id");
			let url =
				"{{ route('api.v1.datatables.administrators.show', ':paramID') }}".replace(
					":paramID",
					id
				);

			$.ajax({
				url: url,
				method: "GET",
				header: {
					"Content-Type": "application/json",
				},
				success: (res) => {
					$("#showModal form #name").val(res.data.name);
					$("#showModal form #email").val(res.data.email);
					$("#showModal form #created_at").val(res.data.created_at);
				},
				error: (err) => {
					alert("error occured, check console");
					console.log(err);
				},
			});
		});

		$(".modal").on("hidden.bs.modal", function () {
			$(this).find("form :input").val("");
		});

		$(".modal").on("shown.bs.modal", function () {
			$(this).find("input:first").focus();
		});
	});
</script>
