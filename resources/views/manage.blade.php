<x-layout>
    <header>
      <div class="mx-auto max-w-7xl py-6 px-4 sm:px-0">
        <h1 class="text-3xl font-bold leading-tight tracking-tight text-gray-900">Manage subscriptions</h1>
      </div>
    </header>
    <x-splade-table :for="$subscriptions" />
</x-layout>
