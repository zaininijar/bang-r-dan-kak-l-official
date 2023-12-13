<x-user-layout title="Riwayat Penukaran">
    <section class="bg-indigo-50/40">
        <div class="__container py-24 flex flex-col items-start justify-start gap-8" x-data="{exchange_type: ''}">
            <div class="text-2xl font-bold">
                Riwayat Penukaran Poin
            </div>

            <div class="grid md:grid-cols-2 grid-cols-1 gap-4 w-full">
                @foreach ($transactions as $transaction)
                <div class="bg-indigo-50 p-8 border border-indigo-500 rounded-lg">
                    <table class="md:text-base text-sm">
                        <tr>
                            <th class="text-left pr-3">Ditukar ke</th>
                            <td>: {{ $transaction->exchange->exchanged_to }}</td>
                        </tr>
                        <tr>
                            <th class="text-left pr-3">Type Tukar</th>
                            <td>: {{ $transaction->exchange->exchange_type }}</td>
                        </tr>
                        <tr>
                            <th class="text-left pr-3">Identitas</th>
                            <td>: <span
                                    class="text-indigo-600 bg-indigo-50 p-1 rounded-md">{{ $transaction->account_identity }}</span>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-left pr-3">Tanggal</th>
                            <td>: <span
                                    class="text-indigo-600 bg-indigo-50 p-1 rounded-md">{{ date('Y, M, d', strtotime($transaction->created_at)) }}</span>
                            </td>
                        </tr>
                    </table>
                </div>
                @endforeach
            </div>

        </div>
    </section>


</x-user-layout>