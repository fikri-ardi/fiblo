<x-app-layout>
    <div class="flex flex-column w-80 shadow-lg p-4 rounded-xl mx-auto mt-32">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Eits! Verifikasi E-mail kamu dulu ya. Kami udah kirim link ke E-mail kamu buat verifikasi. Kalo ngga ada E-mailnya, tap tombol
            dibawah ya.') }}
        </div>
        @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Link baru buat verifikasi E-mail udah kami kirim ke E-mail kamu.') }}
        </div>
        @endif
        <form method="POST" action="{{ route('verification.send') }}" class="block">
            @csrf
            <div class="flex items-center justify-between">
                <x-_button>
                    {{ __('Kirim Email Verifikasi Lagi') }}
                </x-_button>

                <a class="text-slate-700 text-base bg-slate-200 px-2 py-1 rounded-xl flex items-center active:bg-slate-300"
                    href="{{ route('home') }}">Nanti</a>
            </div>
        </form>
    </div>
</x-app-layout>