<span class="badge w-100 rounded-pill py-2 {{ $model->is_paid === 1 ? 'bg-success' : 'bg-danger' }}"
    data-bs-toggle="tooltip" data-bs-placement="top" title="{{ paid_status($model->is_paid) }}">
    <i class="bi bi-{{ $model->is_paid === 1 ? 'check-square' : 'exclamation-square' }}"></i>
</span>