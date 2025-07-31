<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold dark:bg-slate-200">Tambah Surat Masuk</h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg dark:bg-gray-800">
                <form action="{{ route('surat_masuk.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf
                    <x-input-label for="tanggal" value="Tanggal" />
                    <x-text-input type="date" name="tanggal" class="w-full" required />

                    <x-input-label for="tujuan" value="Tujuan" />
                    <x-text-input name="tujuan" class="w-full" required />

                    <x-input-label for="asal" value="Asal" />
                    <x-text-input name="asal" class="w-full" required />

                    <x-input-label for="nomor" value="Nomor Surat" />
                    <x-text-input name="nomor" class="w-full" required />

                    <x-input-label for="perihal" value="Perihal" />
                    <x-text-input name="perihal" class="w-full" required />

                    <x-input-label for="file" value="Upload File (PDF/DOCX max 5MB)" />
                    <input type="file" name="file" class="w-full rounded border" required />

                    <x-primary-button>Simpan</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
