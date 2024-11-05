<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pegawai') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('pegawai.index') }}" class="btn btn-secondary mb-3">{{ __('Kembali') }}</a>
            <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-warning mb-3">{{ __('Edit') }}</a>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p><strong>{{ __('NIP:') }}</strong> {{ $pegawai->nip }}</p>
                    <p><strong>{{ __('Nama:') }}</strong> {{ $pegawai->nama }}</p>
                    <p><strong>{{ __('Dokumen:') }}</strong></p>
                    <ul>
                        @foreach(['sk_cpns', 'sk_pns', 'kk', 'akte', 'ktp', 'ijazah_sd', 'ijazah_smp', 'ijazah_sma', 'ijazah_kuliah'] as $dokumen)
                            @if($pegawai->$dokumen)
                                <li>{{ ucfirst(str_replace('_', ' ', $dokumen)) }}: <a href="{{ asset('storage/pegawai_files' . $pegawai->$dokumen) }}" target="_blank">{{ __('Lihat') }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
