@if($errors->any())
<div class="alert alert-danger alert-dismissible show fade">
	{{ $errors->first() }}
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
