<x-guest-layout>
    <section class="flex items-center justify-center h-screen">
        <div class="text-center">
            <h1 class="text-6xl font-bold">404</h1>
            <p class="text-xl">{{ $msg }}</p>
            <a class="text-xl" href="{{ route('dashboard') }}">Back to dashboard</a>
        </div>
    </section>
</x-guest-layout>
