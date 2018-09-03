@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                <a href="{{ route('post.create') }}">Create</a>
                    <div class="table-responsive">
                        <table class="table table-border">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(!empty($posts))
                            @foreach($posts as $post)
                                <tr>
                                    <td>{{ $post->title }}</td>
                                    <td>{{ $post->body }}</td>
                                    <td>
                                    <a href="{{ route('post.edit',$post->id) }}" class="btn btn-info">
                                    edit
                                  </a> | 
                                  <form id="delete-from-{{ $post->id }}" action="{{ route('post.destroy',$post->id) }}" method="POST" id="formdashboard">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                  </form>
                                  </td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
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
    @if(count($posts)>0)
    $('#formdashboard').on('submit',function(e){
        e.preventDefault();
        var _form = $(this).serialize();
        // console.log(_form);
        $.post("{{ route('post.destroy', $post->id) }}",_form, function(data){
            document.getElementById('delete-from-'+id).submit();
        });
        // $.post( "{{ route('post.store') }}", function( data ) {
            
        // });
    });
    @endif
});

@endpush