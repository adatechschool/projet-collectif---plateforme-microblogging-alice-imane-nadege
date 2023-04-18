@foreach ($posts as $post)
<x-guest-layout>
    Posted on {{ $post->created_at }}
    <h2 class='font-semibold'>
    {{$post->user->name}}
  </h2> 
    {{$post->description}}
    @include('../components/likes')
  <img src="{{ $post->img_url }}">
</x-guest-layout>
@endforeach