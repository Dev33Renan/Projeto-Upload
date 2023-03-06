@extends('admin.layouts.app')

@section('title', "Editar o Arquivo {$post->name}")

@section('content')
    <h1>Editar arquivo <strong>{{ $post->name }}</strong></h1>

    <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @include('admin.posts._partials.form')
    </form>
@endsection
