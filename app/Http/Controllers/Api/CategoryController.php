<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class CategoryController extends Controller
{
    public function getRelatedPost($category)
    {
        $post = Post::where('category', $category)->with(['category', 'tags']);

        return response()->json(
            [
                'results' => $post,
                'success' => true
            ]
        );
    }

}