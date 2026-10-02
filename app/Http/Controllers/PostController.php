<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    public function edit(Post $post)
    {
        Gate::authorize('update', $post);

        return 'Anda diizinkan mengedit post ini.';
    }

    public function destroy(Post $post)
    {
        Gate::authorize('delete', $post);

        $post->delete();

        return 'Post berhasil dihapus.';
    }
}