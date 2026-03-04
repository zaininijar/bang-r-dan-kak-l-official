<x-user-layout title="Riwayat Penukaran">
    <section class="bg-indigo-50/40">
        <div class="__container py-24 flex flex-col items-start justify-start gap-8">
            <div class="text-2xl font-bold">
                Riwayat Penukaran Poin
            </div>

            <div class="grid md:grid-cols-2 grid-cols-1 gap-4 w-full">
                @foreach ($transactions as $transaction)
                <div class="bg-white p-8 border border-indigo-200 rounded-xl shadow-sm hover:shadow-md transition-shadow">
                    {{-- Progress Transaksi --}}
                    <div class="mb-6">
                        <h4 class="text-sm font-semibold text-indigo-700 mb-3">Progress Transaksi</h4>
                        <div class="flex items-center gap-2">
                            {{-- Step 1: Menunggu --}}
                            <div class="flex items-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center
                                        @if(in_array($transaction->status, ['pending', 'processing', 'completed'])) bg-indigo-600 text-white
                                        @else bg-gray-200 text-gray-500 @endif">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                        </svg>
                                    </div>
                                    <span class="text-xs mt-1 font-medium {{ $transaction->status == 'pending' ? 'text-indigo-600' : 'text-gray-500' }}">Menunggu</span>
                                </div>
                                <div class="w-8 md:w-12 h-0.5 mx-1 {{ in_array($transaction->status, ['processing', 'completed']) ? 'bg-indigo-600' : 'bg-gray-200' }}"></div>
                            </div>
                            {{-- Step 2: Diproses Admin --}}
                            <div class="flex items-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center
                                        @if(in_array($transaction->status, ['processing', 'completed'])) bg-indigo-600 text-white
                                        @else bg-gray-200 text-gray-500 @endif">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <span class="text-xs mt-1 font-medium {{ $transaction->status == 'processing' ? 'text-indigo-600' : ($transaction->status == 'completed' ? 'text-indigo-600' : 'text-gray-500') }}">Diproses</span>
                                </div>
                                <div class="w-8 md:w-12 h-0.5 mx-1 {{ $transaction->status == 'completed' ? 'bg-indigo-600' : 'bg-gray-200' }}"></div>
                            </div>
                            {{-- Step 3: Selesai --}}
                            <div class="flex flex-col items-center">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center
                                    @if($transaction->status == 'completed') bg-green-600 text-white
                                    @else bg-gray-200 text-gray-500 @endif">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <span class="text-xs mt-1 font-medium {{ $transaction->status == 'completed' ? 'text-green-600' : 'text-gray-500' }}">Selesai</span>
                            </div>
                        </div>
                        <div class="mt-2">
                            @if($transaction->status == 'pending')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                <span class="w-2 h-2 bg-amber-500 rounded-full mr-2 animate-pulse"></span>
                                Menunggu diproses admin
                            </span>
                            @elseif($transaction->status == 'processing')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                <span class="w-2 h-2 bg-blue-500 rounded-full mr-2 animate-pulse"></span>
                                Sedang diproses admin
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <svg class="w-3 h-3 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Penukaran selesai
                            </span>
                            @endif
                        </div>
                    </div>

                    <table class="md:text-base text-sm w-full">
                        <tr>
                            <th class="text-left pr-3 py-1">Ditukar ke</th>
                            <td>: {{ $transaction->exchange->exchanged_to }}</td>
                        </tr>
                        <tr>
                            <th class="text-left pr-3 py-1">Type Tukar</th>
                            <td>: {{ $transaction->exchange->exchange_type }}</td>
                        </tr>
                        <tr>
                            <th class="text-left pr-3 py-1">Identitas</th>
                            <td>: <span class="text-indigo-600 bg-indigo-50 p-1 rounded-md">{{ $transaction->account_identity }}</span></td>
                        </tr>
                        <tr>
                            <th class="text-left pr-3 py-1">Tanggal</th>
                            <td>: <span class="text-indigo-600 bg-indigo-50 p-1 rounded-md">{{ $transaction->created_at->format('Y, M d') }}</span></td>
                        </tr>
                    </table>
                </div>
                @endforeach
            </div>

            @if($transactions->isEmpty())
            <div class="w-full text-center py-12 bg-white rounded-xl border border-indigo-200">
                <p class="text-gray-500">Belum ada riwayat penukaran.</p>
                <a href="{{ route('user.penukaran-point.index') }}" class="inline-block mt-4 text-indigo-600 hover:text-indigo-700 font-medium">Tukar poin sekarang</a>
            </div>
            @endif
        </div>
    </section>
</x-user-layout>
