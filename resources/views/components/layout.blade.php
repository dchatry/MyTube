<div class="min-h-full">
  <nav class="border-b border-gray-200 bg-white fixed w-full z-10">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 justify-between">
        <div class="flex">
          <div class="flex flex-shrink-0 items-center text-xl font-bold leading-tight tracking-tight text-gray-900">
            <Link href="{{ route('home') }}">MyTube.</Link>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <div class="py-16 sm:py-24">
    <main>
      <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        {{ $slot }}
      </div>
    </main>
  </div>
</div>
