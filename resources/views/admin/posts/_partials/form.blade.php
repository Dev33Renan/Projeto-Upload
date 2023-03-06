    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @csrf
    <input type="file" name="image" id="image">
    <input type="text" name="name" id="name" placeholder="Título" value="{{ $post->name ?? old('name') }}">
    <textarea name="descricao" id="descricao" cols="30" rows="4" placeholder="Conteúdo">{{ $post->descricao ?? old('descricao') }}</textarea>
    <button type="submit">Enviar</button>