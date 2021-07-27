@if(request()->session()->get('success'))
<div class="alert alert-success alert-dismissable fade show">
    <i class="bi bi-check-circle"></i> {{ session('success') }}
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(request()->session()->get('warning'))
<div class="alert alert-warning alert-dismissable fade show">
    <i class="bi bi-exclamation-triangle"></i> {{ session('warning') }}
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(count($errors) !== 0)
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Gagal!</strong>
    <ul>
        @foreach($errors->all() as $message)
        <li>{{ $message }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif