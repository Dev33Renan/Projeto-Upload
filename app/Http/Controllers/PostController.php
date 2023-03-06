<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Http\Requests\StoreUpdatePost;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = File::latest()->paginate(1);

        return view('admin.posts.index', compact('posts'));

    }

    public function create()
    {
        // dd($post);
        return view('admin.posts.create');
    }

    public function store(StoreUpdatePost $request)
    {   
        $data = $request->all();


        if ($request->image->isValid()) {

            $nameFile = Str::of($request->name)->slug('-') . '.' .$request->image->getClientOriginalExtension();
                        
            
            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;

        }

       File::create($data);

       return redirect()
            ->route('posts.index')
            ->with('message', 'Criado com Sucesso');

    }

    public function show($id)
    {
      //    $post = File::where('id', $id)->first();
        if (!$post = File::find($id)) {
            return redirect()->route('posts.index');
        }
       
        return view('admin.posts.show', compact('post'));
       
    }

    public function destroy($id)
    {
        if (!$post = File::find($id)) 
            return redirect()->route('posts.index');

        if (Storage::exists($post->image))
            Storage::delete($post->image);

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('message', 'Deletado com Sucesso');
        
    }

    public function edit($id)
    {
        if (!$post = File::find($id)) {
            return redirect()->back();
        }

        return view('admin.posts.edit', compact('post'));
    }

    public function update(StoreUpdatePost $request, $id)
    {
        if (!$post = File::find($id)) {
            return redirect()->back();
        }

        $data = $request->all();

        if ($request->image && $request->image->isValid()) {
            if (Storage::exists($post->image))
                Storage::delete($post->image);
            
            $nameFile = Str::of($request->name)->slug('-') . '.' .$request->image->getClientOriginalExtension();
                        
            
            $image = $request->image->storeAs('posts', $nameFile);
            $data['image'] = $image;

        }

        $post->update($data);

        return redirect()
            ->route('posts.index')
            ->with('message', 'Editado com Sucesso');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');


        $posts = File::where('name', 'LIKE', "%{$request->search}%")
                        ->orwhere('descricao', 'LIKE', "%{$request->search}%")
                        ->paginate(1);

        return view('admin.posts.index', compact('posts', 'filters'));
        // dd("pesquisando por {$request->search}");
    }

}
