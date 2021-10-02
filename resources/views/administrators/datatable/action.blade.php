<div class="btn-group" role="group">
    @if (auth()->id() === $model->id)
    <div class="mx-1">
        <button type="button" data-id="{{ $model->id }}" class="btn btn-primary btn-sm administrator-detail"
            data-bs-toggle="modal" data-bs-target="#showAdministratorModal">
            <i class="bi bi-search"></i>
        </button>
    </div>

    <div class="mx-1">
        <button type="button" data-id="{{ $model->id }}" class="btn btn-success btn-sm administrator-edit"
            data-bs-toggle="modal" data-bs-target="#editAdministratorModal">
            <i class="bi bi-pencil-square"></i>
        </button>
    </div>
    @endif
</div>