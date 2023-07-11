<x-layout>
    <div class="animate-fade-right animate-once">
        <div class="group block w-full overflow-hidden rounded-none sm:rounded-lg bg-gray-100">
            <video autoplay="" controls class="bg-black m-auto" webkit-playsinline x-webkit-airplay="" poster="{{ $video->thumbnail_file_path }}" title="{{ $video->title }}">
                <source src="{{ $video->video_file_path }}" type="video/mp4">
            </video>
        </div>
        <div class="mx-auto max-w-7xl py-6 px-4 sm:px-0">
            <h1 class="text-3xl font-bold leading-tight tracking-tight text-gray-900">{{ $video->title }}</h1>
            <h1 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 py-2">{{ $video->subscription->title }}</h1>
            <h1 class="text-l leading-tight tracking-tight text-gray-500 py-2">{{ $video->published_at->diffForHumans() }}</h1>
        </div>
        <hr>
        <div class="flex gap-4 py-6 px-4 sm:px-0">
            <a href="https://www.youtube.com/watch?v={{ $video->identifier }}" class="inline-flex items-center gap-x-2 rounded-md bg-red-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.348a1.125 1.125 0 010 1.971l-11.54 6.347a1.125 1.125 0 01-1.667-.985V5.653z" />
                </svg>
              Watch on YouTube
            </a>
            <button x-on:click="navigator.share({
                title: 'web.dev',
                text: 'Check out web.dev.',
                url: 'https://web.dev/',
              })" class="inline-flex items-center gap-x-2 rounded-md bg-gray-200 px-3.5 py-2.5 text-sm font-semibold text-black shadow-sm hover:bg-gray-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-200">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 00-2.25 2.25v9a2.25 2.25 0 002.25 2.25h9a2.25 2.25 0 002.25-2.25v-9a2.25 2.25 0 00-2.25-2.25H15m0-3l-3-3m0 0l-3 3m3-3V15" />
                </svg>
            </button>
        </div>
        <div id="description" class="break-words whitespace-pre-line px-4 sm:px-0 pb-8">
            <x-splade-content :html="(new \App\Library\Linkify())->process($video->description)" />
        </div>
    </div>
</x-layout>
