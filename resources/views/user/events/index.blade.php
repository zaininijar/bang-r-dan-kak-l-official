<x-user-layout title="Event">
    <section class="bg-indigo-50/40">
        <div class="__container py-24">
            @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
            @endif
            @if (session('error'))
            <div class="bg-red-100 text-red-700 px-4 py-3 rounded-lg mb-6">
                {{ session('error') }}
            </div>
            @endif

            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold text-indigo-700">Event</h1>
                <a href="{{ route('user.events.history') }}"
                    class="text-indigo-600 hover:text-indigo-800 font-medium text-sm">
                    Riwayat Submission
                </a>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                @foreach ($events as $event)
                <div class="bg-white rounded-xl border border-indigo-200 p-6 shadow-sm hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-4">
                        <h2 class="text-lg font-bold text-indigo-700">{{ $event->title }}</h2>
                        <span class="px-3 py-1 rounded-full text-sm font-medium bg-indigo-100 text-indigo-700">
                            {{ $event->point_reward }} Poin
                        </span>
                    </div>
                    @if($event->description)
                    <p class="text-gray-600 text-sm mb-4">{{ Str::limit($event->description, 120) }}</p>
                    @endif

                    {{-- Countdown --}}
                    <div class="mb-4 p-3 bg-pink-50 rounded-lg border border-pink-200">
                        <p class="text-xs font-medium text-pink-700 mb-1">Sisa waktu event</p>
                        <p class="text-lg font-bold text-pink-800" x-data="countdown('{{ $event->end_at->toIso8601String() }}')" x-init="start()">
                            <span x-text="hours"></span> Jam
                            <span x-text="minutes"></span> Menit
                            <span x-text="seconds"></span> Detik
                        </p>
                    </div>

                    <p class="text-xs text-gray-500 mb-4">
                        Berakhir: {{ $event->end_at->format('d M Y H:i') }}
                    </p>

                    @php $userSubmission = $userSubmissions->get($event->id); @endphp
                    @if($userSubmission)
                        @if($userSubmission->status == 'pending')
                        <div class="flex items-center gap-2 text-amber-600">
                            <span class="w-2 h-2 bg-amber-500 rounded-full animate-pulse"></span>
                            <span class="text-sm font-medium">Menunggu persetujuan admin</span>
                        </div>
                        @elseif($userSubmission->status == 'approved')
                        <div class="flex items-center gap-2 text-green-600">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span class="text-sm font-medium">Event selesai! +{{ $event->point_reward }} poin</span>
                        </div>
                        @else
                        <form action="{{ route('user.events.submit') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                            <div class="space-y-2">
                                <label class="block text-sm font-medium text-gray-700">Upload screenshot</label>
                                <input type="file" name="screenshot" accept="image/*" required
                                    class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                                <button type="submit" class="w-full py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium">
                                    Kirim Screenshot
                                </button>
                            </div>
                        </form>
                        @endif
                    @else
                    <form action="{{ route('user.events.submit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Upload screenshot</label>
                            <input type="file" name="screenshot" accept="image/*" required
                                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <button type="submit" class="w-full py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium">
                                Kirim Screenshot
                            </button>
                        </div>
                    </form>
                    @endif
                </div>
                @endforeach
            </div>

            @if($events->isEmpty())
            <div class="text-center py-16 bg-white rounded-xl border border-indigo-200">
                <p class="text-gray-500">Tidak ada event aktif saat ini.</p>
                <p class="text-sm text-gray-400 mt-2">Cek kembali nanti untuk event baru!</p>
            </div>
            @endif
        </div>
    </section>

    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('countdown', (endDate) => ({
            endDate: new Date(endDate),
            hours: '0',
            minutes: '0',
            seconds: '0',
            interval: null,
            start() {
                const update = () => {
                    const now = new Date();
                    const diff = this.endDate - now;
                    if (diff <= 0) {
                        this.hours = '0';
                        this.minutes = '0';
                        this.seconds = '0';
                        clearInterval(this.interval);
                        return;
                    }
                    const h = Math.floor(diff / 3600000);
                    const m = Math.floor((diff % 3600000) / 60000);
                    const s = Math.floor((diff % 60000) / 1000);
                    this.hours = h;
                    this.minutes = m.toString().padStart(2, '0');
                    this.seconds = s.toString().padStart(2, '0');
                };
                update();
                this.interval = setInterval(update, 1000);
            }
        }));
    });
    </script>
</x-user-layout>
