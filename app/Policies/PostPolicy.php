<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id
            || in_array($user->role, ['admin', 'editor']);
    }

    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id
            || in_array($user->role, ['admin', 'editor']);
    }
}