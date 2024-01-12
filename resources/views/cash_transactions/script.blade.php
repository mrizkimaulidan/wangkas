<script>
	$(function () {
		$("#createModal #student_id").select2({
			placeholder: "Pilih..",
			theme: "bootstrap-5",
			allowClear: true,
		});

		const table = $("#table").DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('api.v1.datatables.cash-transactions.index') }}",
			columns: [
				{ data: "DT_RowIndex", name: "DT_RowIndex" },
				{ data: "student.name", name: "student_id" },
				{ data: "amount", name: "amount" },
				{ data: "date_paid_formatted", name: "date_paid" },
				{ data: "created_by.name", name: "created_by" },
				{ data: "action", name: "action" },
			],
		});

		$("#createModal form").submit(function (e) {
			e.preventDefault();

			const formData = {
				student_id: $("#createModal form #student_id").val(),
				amount: $("#createModal form #amount").val(),
				date_paid: $("#createModal form #date_paid").val(),
				transaction_note: $("#createModal form #transaction_note").val(),
			};

			$.ajax({
				url: "{{ route('api.v1.datatables.cash-transactions.store') }}",
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
						title: "Data transaksi kas berhasil ditambahkan!",
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
				"{{ route('api.v1.datatables.cash-transactions.show', ':paramID') }}".replace(
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
					$("#showModal form #student_identification_number").val(res.data.student.student_identification_number);
					$("#showModal form #student_id").val(res.data.student.name);
					$("#showModal form #school_class_id").val(res.data.student.school_class.name);
					$("#showModal form #school_major_id").val(res.data.student.school_major.name);
					$("#showModal form #phone_number").val(res.data.student.phone_number);
					$("#showModal form #created_by").val(res.data.created_by.name);
					$("#showModal form #amount").val(res.data.amount_formatted);
					$("#showModal form #date_paid").val(res.data.date_paid_formatted);
					$("#showModal form #transaction_note").val(res.data.transaction_note);
				},
				error: (err) => {
					alert("error occured, check console");
					console.log(err);
				},
			});
		});

		$("#table").on("click", ".update-modal", function () {
			const id = $(this).data("id");
			let url =
				"{{ route('api.v1.datatables.cash-transactions.show', ':paramID') }}".replace(
					":paramID",
					id
				);
			let updateURL =
				"{{ route('api.v1.datatables.cash-transactions.update', ':paramID') }}".replace(
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
					$("#updateModal form #student_id").val(res.data.student.id);
					$("#updateModal form #amount").val(res.data.amount);
					$("#updateModal form #date_paid").val(res.data.date_paid);
					$("#updateModal form #transaction_note").val(
						res.data.transaction_note
					);
					$("#updateModal form").attr("action", updateURL);
				},
				error: (err) => {
					alert("error occured, check console");
					console.log(err);
				},
			});
		});

		$("#updateModal form").submit(function (e) {
			e.preventDefault();

			const formData = {
				student_id: $("#updateModal form #student_id").val(),
				amount: $("#updateModal form #amount").val(),
				date_paid: $("#updateModal form #date_paid").val(),
				transaction_note: $("#updateModal form #transaction_note").val(),
			};

			const updateURL = $("#updateModal form").attr("action");

			$.ajax({
				url: updateURL,
				method: "PUT",
				header: {
					"Content-Type": "application/json",
				},
				data: formData,
				success: (res) => {
					table.ajax.reload();
					$("#updateModal").modal("hide");

					Swal.fire({
						icon: "success",
						title: "Data kas berhasil diubah!",
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

		$("#table").on("click", ".delete", function (e) {
			e.preventDefault();

			Swal.fire({
				title: "Hapus?",
				text: "Data tersebut akan dihapus!",
				icon: "warning",
				showCancelButton: true,
				reverseButtons: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				cancelButtonText: "Tidak",
				confirmButtonText: "Ya!",
			}).then((result) => {
				if (result.isConfirmed) {
					const id = $(this).data("id");
					const url =
						"{{ route('api.v1.datatables.cash-transactions.destroy', ':paramID') }}".replace(
							":paramID",
							id
						);

					$.ajax({
						url: url,
						method: "DELETE",
						success: (res) => {
							Swal.fire({
								icon: "success",
								title: "Data berhasil dihapus!",
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

							table.ajax.reload();
						},
					});
				}
			});
		});
	});
</script>
