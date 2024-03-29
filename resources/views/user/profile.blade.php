<x-user-layout title="Profile User">
    <section class="bg-indigo-50/40">
        <div class="__container md:py-24 py-16 flex flex-col items-start justify-start gap-8" x-data="{ exchange_type: '' }">
            <div class="text-2xl font-bold">
                Profile
            </div>

            @if (session('success'))
                <div class="bg-indigo-100 text-bg-red-500 text-indigo-500 border px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 text-bg-red-500 text-red-500 border px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif

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
                            class="text-indigo-500 bg-indigo-50 p-1 rounded-md text-sm">{{ Auth::user()->no_absensi }}</span>
                    </td>
                </tr>
            </table>

            <div
                class="flex flex-wrap items-center md:gap-4 gap-2 border rounded-lg p-4 border-indigo-500 w-full md:w-auto">
                <div>
                    Kamu
                    <span
                        class="{{ $today_attendance == 'Sudah' ? 'text-indigo-600' : 'text-red-600' }} font-bold">{{ $today_attendance }}</span>
                    Absen hari ini klik
                    disini
                </div>
                <form action="{{ route('user.attendance.store') }}" method="POST">
                    @csrf
                    <button
                        class="px-3 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-lg flex gap-2 items-center justify-center">
                        <span>Isi Absen</span>
                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M9 1V3H15V1H17V3H21C21.5523 3 22 3.44772 22 4V20C22 20.5523 21.5523 21 21 21H3C2.44772 21 2 20.5523 2 20V4C2 3.44772 2.44772 3 3 3H7V1H9ZM20 8H4V19H20V8ZM15.0355 10.136L16.4497 11.5503L11.5 16.5L7.96447 12.9645L9.37868 11.5503L11.5 13.6716L15.0355 10.136Z">
                            </path>
                        </svg>
                    </button>
                </form>
            </div>

            <div class="bg-indigo-50 p-4 md:w-4/12  w-full text-xl font-bold border border-indigo-500 rounded-lg">
                Poin Kamu : <span class="text-indigo-600 bg-indigo-50 p-1 rounded-md">{{ Auth::user()->point }}</span>
            </div>

            <div class="bg-red-100 text-bg-red-500 text-red-500 border p-4 rounded md:text-base text-sm">
                Untuk setiap penukaran poin Kamu, pastikan Kamu memiliki
                setidaknya 25 poin atau lebih di akun Kamu.
            </div>
            <a href="{{ route('user.penukaran-point.index') }}"
                class="px-4 py-3 bg-indigo-600 text-white rounded-lg w-full md:w-auto text-center">
                Tukar Poin Sekarang
            </a>
        </div>
    </section>


</x-user-layout>
