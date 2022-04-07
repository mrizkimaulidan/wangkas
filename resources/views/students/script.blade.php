<script>
	$(function () {
		let loadingAlert = $('.modal-body #loading-alert');

		$('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('students.index') }}",
			columns: [
				{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
				{ data: 'student_identification_number', name: 'student_identification_number' },
				{ data: 'name', name: 'name' },
				{ data: 'school_class_id', name: 'school_classes.name' },
				{ data: 'school_major', name: 'school_majors.name' },
				{ data: 'school_year', name: 'school_year' },
				{ data: 'action', name: 'action' },
			]
		});

		$('#datatable').on('click', '.student-detail', function () {
			loadingAlert.show();

			let url = "{{ route('api.student.show', 'id') }}";
			let id = $(this).data('id');

			url = url.replace('id', id);

			$('#showStudentModal input').each(function () {
				$(this).val('Sedang mengambil data..');
			});

			$.ajax({
				url: url,
				headers: {
					'Accept': 'application/json',
					'Content-Type': 'application/json'
				},
				success: function (response) {
					loadingAlert.slideUp();

					$('#showStudentModal #student_identification_number').val(response.data.student_identification_number);
					$('#showStudentModal #name').val(response.data.name);
					$('#showStudentModal #gender').val(response.data.gender);
					$('#showStudentModal #school_class_id').val(response.data.school_classes.name);
					$('#showStudentModal #school_major_id').val(response.data.school_majors.name);
					$('#showStudentModal #email').val(response.data.email);
					$('#showStudentModal #phone_number').val(response.data.phone_number);
					$('#showStudentModal #school_year_start').val(response.data.school_year_start);
					$('#showStudentModal #school_year_end').val(response.data.school_year_end);
				}
			});
		});

		$('#datatable').on('click', '.student-edit', function () {
			loadingAlert.show();

			let id = $(this).data('id');
			let url = "{{ route('api.student.edit', 'id') }}";
			url = url.replace('id', id);

			let formActionURL = "{{ route('students.update', 'id') }}"
			formActionURL = formActionURL.replace('id', id);

			let editStudentModalEveryInput = $('#editStudentModal :input').not('button[type=button], input[name=_token], input[name=_method]')
				.each(function () {
					$(this).not('select').val('Sedang mengambil data..');
					$(this).prop('disabled', true);
				});

			$.ajax({
				url: url,
				headers: {
					'Accept': 'application/json',
				},
				success: function (response) {
					loadingAlert.slideUp();

					editStudentModalEveryInput.prop('disabled', false);

					$('#editStudentModal #edit-student-form').attr('action', formActionURL)

					$('#editStudentModal #student_identification_number').val(response.data.student_identification_number);
					$('#editStudentModal #name').val(response.data.name);
					$('#editStudentModal #gender').val(response.data.gender);
					$('#editStudentModal #school_class_id').val(response.data.school_class_id).select2();
					$('#editStudentModal #school_major_id').val(response.data.school_major_id).select2();
					$('#editStudentModal #email').val(response.data.email);
					$('#editStudentModal #phone_number').val(response.data.phone_number);
					$('#editStudentModal #school_year_start').val(response.data.school_year_start);
					$('#editStudentModal #school_year_end').val(response.data.school_year_end);
				}
			});
		});
	});
</script>
