<x-app-layout>
    <div class="__container">
        <div class="py-4 md:py-7">
            @if (session('success'))
            <div class="bg-green-100 text-green-500 px-6 py-4 mb-4 shadow-sm rounded-md flex justify-between items-center">
                <span>{{ session('success') }}</span>
            </div>
            @endif
            <div class="flex flex-wrap items-center justify-between rounded-lg md:px-8 md:py-4 p-3 bg-indigo-50 border border-indigo-500 shadow-lg">
                <h1 class="text-base md:text-xl font-bold text-indigo-600">Event</h1>
                <a href="{{ route('admin.events.create') }}"
                    class="px-6 py-3 bg-indigo-700 hover:bg-indigo-600 text-white rounded-lg font-medium">
                    Tambah Event
                </a>
            </div>
        </div>
        <div class="bg-white py-4 md:py-7 px-4 md:px-8 rounded-lg border border-indigo-500 shadow-lg">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-indigo-100 bg-indigo-50 font-bold text-indigo-700">
                            <td class="pl-5 py-3">No</td>
                            <td class="pl-5 py-3">Judul</td>
                            <td class="pl-5 py-3">Poin</td>
                            <td class="pl-5 py-3">Mulai</td>
                            <td class="pl-5 py-3">Selesai</td>
                            <td class="pl-5 py-3">Status</td>
                            <td class="pl-5 py-3">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($events as $key => $event)
                        <tr class="border-b border-gray-100">
                            <td class="pl-5 py-3">#{{ $key + 1 }}</td>
                            <td class="pl-5 py-3 font-medium">{{ $event->title }}</td>
                            <td class="pl-5 py-3">{{ $event->point_reward }} Poin</td>
                            <td class="pl-5 py-3">{{ $event->start_at->format('d M Y') }}</td>
                            <td class="pl-5 py-3">{{ $event->end_at->format('d M Y H:i') }}</td>
                            <td class="pl-5 py-3">
                                @if($event->isExpired())
                                <span class="px-2 py-1 text-xs rounded-full bg-gray-200 text-gray-600">Selesai</span>
                                @elseif($event->isActive())
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">Aktif</span>
                                @else
                                <span class="px-2 py-1 text-xs rounded-full bg-amber-100 text-amber-700">Belum dimulai</span>
                                @endif
                            </td>
                            <td class="pl-5 py-3 flex gap-2">
                                <a href="{{ route('admin.events.edit', $event) }}"
                                    class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Edit</a>
                                <form action="{{ route('admin.events.destroy', $event) }}" method="post" class="inline"
                                    onsubmit="return confirm('Yakin hapus event ini?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if($events->isEmpty())
            <p class="text-center py-8 text-gray-500">Belum ada event.</p>
            @endif
        </div>
    </div>
</x-app-layout>
