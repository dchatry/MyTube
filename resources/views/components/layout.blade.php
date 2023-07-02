<!DOCTYPE html>
<html class="h-full" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        @vite('resources/js/app.js')


        <title>MyTube.</title>
    </head>
    <body class="h-full">
        <div class="min-h-full">
          <nav class="border-b border-gray-200 bg-white">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
              <div class="flex h-16 justify-between">
                <div class="flex">
                  <div class="flex flex-shrink-0 items-center text-xl font-bold leading-tight tracking-tight text-gray-900">
                    <a href="{{ route('home') }}">MyTube.</a>
                  </div>
                </div>
              </div>
            </div>
          </nav>

          <div class="py-0 sm:py-10">
            <main>
              <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                {{ $slot }}
              </div>
            </main>
          </div>
        </div>
    </body>
</html>
