<!--Like gestion with ternary operators for the route and the color of the button -->

<div class="px-6 py-4 text-sm border-b border-gray-200 ">
    <form action="{{ $post->liked() ? route('unlike.post', $post->id) : route('like.post', $post->id) }}" method="post">
        @csrf
        <button
            class="{{ $post->liked() ? 'text-red-600' : 'text-lightgrey'  }} px-4 py-2">
            ♥{{ $post->likeCount }}
        </button>
    </form>
</div>
