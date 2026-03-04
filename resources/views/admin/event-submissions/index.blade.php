<x-app-layout>
    <div class="__container">
        <div class="py-4 md:py-7">
            @if (session('success'))
            <div class="bg-green-100 text-green-500 px-6 py-4 mb-4 shadow-sm rounded-md">
                {{ session('success') }}
            </div>
            @endif
            <div class="rounded-lg md:px-8 md:py-4 p-3 bg-indigo-50 border border-indigo-500 shadow-lg">
                <h1 class="text-base md:text-xl font-bold text-indigo-600">Submission Event</h1>
                <p class="text-sm text-gray-600 mt-1">Review dan setujui/tolak screenshot yang dikirim member</p>
            </div>
        </div>
        <div class="bg-white py-4 md:py-7 px-4 md:px-8 rounded-lg border border-indigo-500 shadow-lg">
            <div class="space-y-6">
                @foreach ($submissions as $submission)
                <div class="border border-indigo-100 rounded-lg p-6 flex flex-col md:flex-row gap-6">
                    <div class="flex-shrink-0">
                        <img src="{{ Storage::url($submission->screenshot_path) }}" alt="Screenshot"
                            class="max-w-full md:max-w-xs rounded-lg border object-contain bg-gray-50">
                    </div>
                    <div class="flex-grow">
                        <h3 class="font-bold text-lg text-indigo-700">{{ $submission->event->title }}</h3>
                        <p class="text-sm text-gray-600 mt-1">Member: <span class="font-medium">{{ $submission->user->username }}</span></p>
                        <p class="text-sm text-gray-600">Dikirim: {{ $submission->created_at->format('d M Y H:i') }}</p>
                        <div class="mt-3">
                            <span class="px-2 py-1 text-xs rounded-full
                                @if($submission->status == 'pending') bg-amber-100 text-amber-800
                                @elseif($submission->status == 'approved') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800 @endif">
                                {{ ucfirst($submission->status) }}
                            </span>
                        </div>
                        @if($submission->admin_notes)
                        <p class="mt-2 text-sm text-gray-600">Catatan: {{ $submission->admin_notes }}</p>
                        @endif
                        @if($submission->status == 'pending')
                        <div class="mt-4 flex gap-3 flex-wrap">
                            <form action="{{ route('admin.event-submissions.approve', $submission) }}" method="post" class="inline">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 text-sm font-medium">
                                    Setujui (+{{ $submission->event->point_reward }} poin)
                                </button>
                            </form>
                            <div x-data="{ open: false }" class="inline">
                                <button type="button" @click="open = !open"
                                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-medium">
                                    Tolak
                                </button>
                                <form x-show="open" x-cloak action="{{ route('admin.event-submissions.reject', $submission) }}" method="post"
                                    class="mt-2 p-3 bg-gray-50 rounded-lg inline-block">
                                    @csrf
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Alasan penolakan (opsional)</label>
                                    <input type="text" name="admin_notes"
                                        class="w-full rounded border-gray-300 text-sm mb-2"
                                        placeholder="Contoh: Screenshot tidak sesuai">
                                    <div class="flex gap-2">
                                        <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded text-sm">Konfirmasi Tolak</button>
                                        <button type="button" @click="open = false" class="px-3 py-1 border rounded text-sm">Batal</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @if($submissions->isEmpty())
            <p class="text-center py-12 text-gray-500">Belum ada submission event.</p>
            @endif
        </div>
    </div>
</x-app-layout>
