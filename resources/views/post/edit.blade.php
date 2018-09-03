@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <form action="{{ route('post.update', $post->id) }}" method="post" id="formdashboard">
                    @csrf
                    @method('PUT')
                    <input type="text" name="title" placeholder="title" value="{{ $post->title }}">
                    <input type="text" name="body" placeholder="body" value="{{ $post->body }}">
                    <button type="submit" id="ajaxSubmit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
jQuery(document).ready(function(){
    $('#formdashboard').on('submit',function(e){
        e.preventDefault();
        var _form = $(this).serialize();
        // console.log(_form);
        $.post("{{ route('post.update', $post->id) }}",_form, function(data){
            console.log(data);
        });
        // $.post( "{{ route('post.store') }}", function( data ) {
            
        // });
    });
});
</script>
@endpush