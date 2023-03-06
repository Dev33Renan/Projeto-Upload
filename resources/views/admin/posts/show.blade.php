@extends('admin.layouts.app')


@section('title', 'Detalhes dos Arquivo')

@section('content')
    <h1>Detalhes da Postagem {{ $post->name }} </h1>

    <ul>
        <li><storng>Titulo: </strong>{{ $post->name }}</li>
        <li><storng>Descrição: </strong>{{ $post->descricao }}</li>
    </ul>

    <form action="{{ route('posts.destroy', $post->id) }}" method="post">
        @csrf
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit"> Deletar {{ $post->name }}</button>
    </form>
@endsection