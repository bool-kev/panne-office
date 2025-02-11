@props([
    'key'=>'success',
    'type'=>$key,
    'time'=>5000
])

@session($key)

<div class="alert alert-{{ $type }} alert-dismissible" role="alert" id="alert-{{ $key }}" >
	<i data-feather="alert-circle"></i>
	{{ session($key) }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close"></button>
</div>  
<script>
    setTimeout(() => {
        document.querySelector("#alert-{{ $key }}").remove();
    }, {{ $time }});
</script> 

@endsession