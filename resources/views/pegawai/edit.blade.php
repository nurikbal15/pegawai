<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <x-input-label for="nama" :value="__('Nama')" />
                    <x-text-input id="nama" class="block mt-1 w-full" type="text" name="nama" value="{{ $pegawai->nama }}" required />
                </div>

                @foreach(['sk_cpns', 'sk_pns', 'kk', 'akte', 'ktp', 'ijazah_sd', 'ijazah_smp', 'ijazah_sma', 'ijazah_kuliah'] as $dokumen)
                    <div class="mb-3">
                        <x-input-label for="{{ $dokumen }}" :value="__(ucfirst(str_replace('_', ' ', $dokumen)))" />
                        <input type="file" id="{{ $dokumen }}" name="{{ $dokumen }}" class="block mt-1 w-full">
                        @if($pegawai->$dokumen)
                            <p><small>{{ __('File saat ini:') }} <a href="{{ asset('storage/' . $pegawai->$dokumen) }}" target="_blank">{{ __('Lihat') }}</a></small></p>
                        @endif
                    </div>
                @endforeach

                <x-primary-button class="mt-3">{{ __('Update') }}</x-primary-button>
            </form>
        </div>
    </div>
</x-app-layout>
