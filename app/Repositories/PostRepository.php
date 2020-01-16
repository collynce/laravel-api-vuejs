<?php
namespace App\Repositories;
use App\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
class PostRepository implements PostInterface
{
    public function get($id)
    {
        return Posts::findOrFail($id);
    }
    public function all()
    {
            return Posts::with(['user', 'category'])->paginate(6);
    }
    public function delete($id)
    {
        $post = Posts::findOrFail($id);
        $post->delete();
    }
    public function change($id)
    {
        return Posts::findOrFail($id);
    }
    public function newPost(Request $request)
    {
        return Posts::create($request->all());
    }
    public function newUpdate(Request $request, $id)
    {
        $post = Posts::findOrFail($id);
        $post-> update($request->all());
    }
    public function fetchCategory($value)
    {
        return Posts::FetchCategory('ss')->get();
    }
}
