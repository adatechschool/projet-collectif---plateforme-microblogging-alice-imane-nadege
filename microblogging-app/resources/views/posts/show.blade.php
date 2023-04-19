@foreach ($posts as $post)
<x-guest-layout>
    Posted on {{ $post->created_at }}
    <h2 class='font-semibold'>
    <a href="{{ route('mypage.another', ['id' => $post->user->id]) }}"> {{$post->user->name}}</a>
  </h2> 
    {{$post->description}}
    @include('../components/likes')
  <img src="{{ $post->img_url }}">
  <form action="{{ route('posts.destroy', $post->id) }}">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
  </form>
</x-guest-layout>
@endforeach
