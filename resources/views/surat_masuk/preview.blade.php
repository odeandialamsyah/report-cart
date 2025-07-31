<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Preview File Surat Masuk</h2>
    </x-slot>

    <div class="flex justify-center py-6">
        <div class="w-full max-w-3xl rounded bg-white p-4 shadow dark:bg-gray-700">
            <iframe src="{{ $fileUrl }}" width="100%" height="600px" style="border:none;" allowfullscreen
                webkitallowfullscreen></iframe>
            <div class="mt-4 text-center">
                <a href="{{ $fileUrl }}" target="_blank" class="text-blue-600 hover:underline">Download File</a>
            </div>
        </div>
    </div>
</x-app-layout>
