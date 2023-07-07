<x-layout>
    <header>
      <div class="mx-auto max-w-7xl py-6 px-4 sm:px-0">
        <h1 class="text-3xl font-bold leading-tight tracking-tight text-gray-900">Subscriptions <Link href="{{ route('subscription.manage') }}" class="rounded-full align-middle bg-white px-2.5 py-1 text-xs font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Manage</Link></h1>
      </div>
    </header>
    <ul role="list" class="animate-fade grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8 px-4 sm:px-0">
        @foreach($videos as $video)
            <li class="relative">
                <div class="group aspect-video block w-full overflow-hidden rounded-lg bg-gray-100">
                    <img src="{{ $video->thumbnail_file_path }}" alt="" class="pointer-events-none object-cover group-hover:opacity-75">
                    <Link href="{{ route('video.play', ['video' => $video]) }}" class="absolute inset-0 focus:outline-none">
                        <span class="sr-only">Play {{ $video->title }}</span>
                    </Link>
                </div>
                <p class="pointer-events-none mt-2 block truncate text-sm font-medium text-gray-900">{{ $video->title }}</p>
                <p class="pointer-events-none block text-sm font-medium text-gray-900">{{ $video->subscription->title }}</p>
                <p class="pointer-events-none block text-sm font-medium text-gray-500">{{ $video->published_at->diffForHumans() }}</p>
            </li>
        @endforeach
    </ul>
</x-layout>
