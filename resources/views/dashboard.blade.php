<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            Dashboard {{ ucfirst(auth()->user()->role) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    @switch(auth()->user()->role)
                        @case('admin')
                            @include('dashboard.admin')
                        @break

                        @case('petugas')
                            @include('dashboard.petugas')
                        @break

                        @case('kepala')
                            @include('dashboard.kepala')
                        @break

                        @default
                            {{-- pengirim --}}
                            @include('dashboard.user')
                    @endswitch

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
