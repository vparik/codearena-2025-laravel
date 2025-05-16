@extends('layouts.app')

@section('content')
<div class="bg-white px-6 py-32 lg:px-8">
    <div class="mx-auto max-w-3xl text-base/7 text-gray-700">
      <h1 class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl">{{ $post->title }}</h1>
      <p class="mt-6 text-xl/8">{{ $post->description }}</p>
      <img class="aspect-video rounded-xl bg-gray-50 object-cover mt-10" src="{{ $post->image }}" alt="{{ $post->title }}">
      <div class="mt-16 max-w-2xl">
        <p class="mt-6">{{ $post->body }}</p>
      </div>
      <div class="mt-16 font-bold">
        <a href="">{{ $post->author->name }}</a>
      </div>
   

      <div class="mt-16">
          <form id="comment-form" method="POST" action="{{ route('comment', $post) }}">
              @csrf
              <div class="mb-4">
                  <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                  <input class="border" type="text" name="name" id="name" required>
              </div>

              <div class="mb-4">
                  <label for="body" class="block text-sm font-medium text-gray-700">Comment</label>
                  <textarea  class="border" name="body" id="body" required>
                  </textarea>
              </div>

              <button type="submit"
                      class="border">
                  Submit Comment
              </button>
          </form>
         @if ($comments->isNotEmpty())
          <div class="mt-8">
            <h3 class="text-xl font-semibold mb-4">Comments</h3>
            @foreach ($comments as $comment)
              <div class="mb-4 p-4 border ">
                <p class="font-semibold">{{ $comment->name }}</p>
                <p>{{ $comment->body }}</p>
              </div>
            @endforeach
          </div>
        @endif
      </div>
    </div>
  </div>
@endsection
