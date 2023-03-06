@extends('admin.layouts.app')

@section('title', 'Upload de novo arquivo')


@section('content')
    <h1>Cadastro de Novo arquivo</h1>

    <form action="{{ route('posts.store') }}" method="post" enctype="multipart/form-data">
    @include('admin.posts._partials.form')
    </form>

@endsection