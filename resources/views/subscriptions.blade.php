<x-layout>
    <header>
      <div class="mx-auto max-w-7xl py-6 px-4 sm:px-0">
        <h1 class="text-3xl font-bold leading-tight tracking-tight text-gray-900">Subscriptions</h1>
      </div>
    </header>
    <ul role="list" class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8 px-4 sm:px-0">
        @foreach($videos as $video)
            <li class="relative">
                <div class="group aspect-h-9 aspect-w-16 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                    <img src="{{ $video->thumbnail_file_path }}" alt="" class="pointer-events-none object-cover group-hover:opacity-75">
                    <a href="{{ route('video.play', ['video' => $video]) }}" class="absolute inset-0 focus:outline-none">
                        <span class="sr-only">Play {{ $video->title }}</span>
                    </a>
                </div>
                <p class="pointer-events-none mt-2 block truncate text-sm font-medium text-gray-900">{{ $video->title }}</p>
                <p class="pointer-events-none block text-sm font-medium text-gray-900">{{ $video->subscription->title }}</p>
                <p class="pointer-events-none block text-sm font-medium text-gray-500">{{ $video->published_at->diffForHumans() }}</p>
            </li>
        @endforeach
    </ul>
</x-layout>
