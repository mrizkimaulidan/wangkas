<div class="btn-group" role="group">
    <div class="mx-1">
        <form action="{{ route('students.restore.history', $model->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success btn-sm restore-button">
                <i class="bi bi-arrow-bar-left"></i>
            </button>
        </form>
    </div>

    <div class="mx-1">
        <form action="{{ route('students.destroy.history', $model->id) }}" method="POST">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm delete-permanent-button">
                <i class="bi bi-trash-fill"></i>
            </button>
        </form>
    </div>
</div>