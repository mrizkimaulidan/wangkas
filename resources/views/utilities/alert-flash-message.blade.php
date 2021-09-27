@if(session('success'))
<div class="alert alert-success alert-dismissable fade show">
    <i class="bi bi-check-circle"></i> {{ session('success') }}
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if(session('warning'))
<div class="alert alert-warning alert-dismissable fade show">
    <i class="bi bi-exclamation-triangle"></i> {{ session('warning') }}
    <button type="button" class="btn-close float-end" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-octagon"></i>
    <strong>Gagal!</strong>
    <ul>
        <div class="row">
            @foreach($errors->all() as $message)
            <div class="col-md-6">
                <li>{{ $message }}</li>
            </div>
            @endforeach
        </div>
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif