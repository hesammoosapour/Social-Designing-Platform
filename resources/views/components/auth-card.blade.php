<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
        {{ $logo }}
    </div>

    <div class="w-90  mt-6 px-6 py-4   overflow-hidden sm:rounded-lg">
        {{--     w-full   sm:max-w-md bg-white shadow-md --}}
        {{ $slot }}
    </div>
</div>
