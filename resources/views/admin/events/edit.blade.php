<x-app-layout>
    <div class="__container py-8">
        <div class="max-w-2xl">
            <h1 class="text-2xl font-bold text-indigo-600 mb-6">Edit Event</h1>
            <form action="{{ route('admin.events.update', $event) }}" method="post"
                class="bg-white p-6 rounded-lg border border-indigo-200 shadow-sm space-y-4">
                @csrf
                @method('put')
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Event</label>
                    <input type="text" name="title" value="{{ old('title', $event->title) }}" required
                        class="w-full rounded-md border-indigo-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                    <textarea name="description" rows="3"
                        class="w-full rounded-md border-indigo-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $event->description) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Poin Reward</label>
                    <input type="number" name="point_reward" value="{{ old('point_reward', $event->point_reward) }}" min="1" required
                        class="w-full rounded-md border-indigo-300 focus:border-indigo-500 focus:ring-indigo-500">
                    @error('point_reward')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mulai</label>
                        <input type="datetime-local" name="start_at"
                            value="{{ old('start_at', $event->start_at->format('Y-m-d\TH:i')) }}" required
                            class="w-full rounded-md border-indigo-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('start_at')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Selesai</label>
                        <input type="datetime-local" name="end_at"
                            value="{{ old('end_at', $event->end_at->format('Y-m-d\TH:i')) }}" required
                            class="w-full rounded-md border-indigo-300 focus:border-indigo-500 focus:ring-indigo-500">
                        @error('end_at')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
                <div>
                    <label class="flex items-center gap-2">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $event->is_active) ? 'checked' : '' }}>
                        <span class="text-sm font-medium text-gray-700">Aktif</span>
                    </label>
                </div>
                <div class="flex gap-4 pt-4">
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Simpan</button>
                    <a href="{{ route('admin.events.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg hover:bg-gray-50">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
