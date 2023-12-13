<x-user-layout title="Profile User">
    <section class="bg-indigo-50/40">
        <div class="__container py-24 flex flex-col items-start justify-start gap-8" x-data="{exchange_type: ''}">
            <div class="text-2xl font-bold">
                Profile
            </div>

            <table border="1">
                <tr>
                    <td class="pr-4">Nama Kamu</td>
                    <td class="pl-4"> : <span
                            class="text-indigo-500 bg-indigo-50 p-1 rounded-md text-sm">{{ Auth::user()->name }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="pr-4">No. Absensi</td>
                    <td class="pl-4"> : <span
                            class="text-indigo-500 bg-indigo-50 p-1 rounded-md text-sm">{{ Auth::user()->no_absensi}}</span>
                    </td>
                </tr>
            </table>

            <div class="bg-indigo-50 p-8 w-4/12 text-xl font-bold border border-indigo-500 rounded-lg">
                Poin Anda : <span class="text-indigo-600 bg-indigo-50 p-1 rounded-md">{{ Auth::user()->point }}</span>
            </div>

            <div class="bg-red-100 text-bg-red-500 text-red-500 border p-4">
                Untuk setiap penukaran poin Anda, pastikan Anda memiliki
                setidaknya 25 poin atau lebih di akun Anda.
            </div>
            <a href="{{ route('user.penukaran-point.index') }}" class="px-4 py-3 bg-indigo-600 text-white rounded-lg">
                Tukar Poin Sekarang
            </a>
        </div>
    </section>


</x-user-layout>
