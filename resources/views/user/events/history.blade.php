<x-user-layout title="Riwayat Event">
    <section class="bg-indigo-50/40">
        <div class="__container py-24">
            <h1 class="text-2xl font-bold text-indigo-700 mb-8">Riwayat Submission Event</h1>

            <div class="space-y-4">
                @foreach ($submissions as $submission)
                <div class="bg-white rounded-xl border border-indigo-200 p-6 shadow-sm flex flex-col md:flex-row gap-6">
                    <div class="flex-shrink-0">
                        <img src="{{ Storage::url($submission->screenshot_path) }}" alt="Screenshot"
                            class="max-w-full md:max-w-[200px] rounded-lg border object-contain bg-gray-50">
                    </div>
                    <div class="flex-grow">
                        <h2 class="font-bold text-lg text-indigo-700">{{ $submission->event->title }}</h2>
                        <p class="text-sm text-gray-600 mt-1">Dikirim: {{ $submission->created_at->format('d M Y H:i') }}</p>
                        <div class="mt-3">
                            @if($submission->status == 'pending')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-amber-100 text-amber-800">
                                <span class="w-2 h-2 bg-amber-500 rounded-full mr-2 animate-pulse"></span>
                                Menunggu persetujuan admin
                            </span>
                            @elseif($submission->status == 'approved')
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                Disetujui (+{{ $submission->event->point_reward }} poin)
                            </span>
                            @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                Ditolak
                            </span>
                            @if($submission->admin_notes)
                            <p class="text-sm text-gray-600 mt-2">Alasan: {{ $submission->admin_notes }}</p>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($submissions->isEmpty())
            <div class="text-center py-16 bg-white rounded-xl border border-indigo-200">
                <p class="text-gray-500">Belum ada riwayat submission event.</p>
                <a href="{{ route('user.events.index') }}" class="inline-block mt-4 text-indigo-600 hover:text-indigo-700 font-medium">Lihat event aktif</a>
            </div>
            @endif
        </div>
    </section>
</x-user-layout>
