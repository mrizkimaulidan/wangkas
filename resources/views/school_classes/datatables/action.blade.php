<td class="text-bold-500">
	<div class="btn-group gap gap-2 mb-3" role="group">
		<button type="button" class="btn btn-primary btn-sm show-modal" data-id="{{ $model->id }}" data-bs-toggle="modal"
			data-bs-target="#showModal">
			<i class="bi bi-search"></i>
		</button>
		<button type="button" class="btn btn-success btn-sm update-modal" data-id="{{ $model->id }}" data-bs-toggle="modal"
			data-bs-target="#updateModal">
			<i class="bi bi-pencil-square"></i>
		</button>
		<button type="button" class="btn btn-danger btn-sm delete" data-id="{{ $model->id }}">
			<i class="bi bi-trash-fill"></i>
		</button>
	</div>
</td>
