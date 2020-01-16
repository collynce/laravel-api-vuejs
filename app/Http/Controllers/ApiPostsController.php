<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\PostsResource;
use App\Repositories\PostInterface;
use Illuminate\Http\Request;

class ApiPostsController extends Controller
{
    protected $post;

    public function __construct(PostInterface $post)
    {
        $this->post = $post;
    }

    public function index()
    {
        $posts = $this->post->all();
        return PostsResource::collection($posts);
    }


    public function create()
    {
        $category = Category::get()->pluck('category', 'id')->prepend('Select...', '');
        return PostsResource::collection($category);
    }

    public function store(Request $request)
    {
        $post = $this->post->newPost($request);
        return new PostsResource($post);
    }


    public function show($id)
    {
        $post = $this->post->get($id);
        return new PostsResource($post);
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $post = $this->post->newUpdate($request, $id);
        return new PostsResource($post);

    }


    public function destroy($id)
    {
        $post = $this->post->delete($id);
        return new PostsResource($post);
    }
}
