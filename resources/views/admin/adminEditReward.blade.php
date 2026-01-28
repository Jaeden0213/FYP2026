<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8 px-4">
        <div class="max-w-xl mx-auto bg-white shadow rounded p-6">

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold">Edit Reward</h1>
                <a href="{{ route('admin.rewards.index') }}" class="text-sm text-gray-600 hover:underline">Back</a>
            </div>

            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ✅ ADD enctype here --}}
            <form method="POST" action="{{ route('admin.rewards.update', $item->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Name</label>
                    <input name="name" value="{{ old('name', $item->name) }}"
                           class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Brand</label>
                    <input name="brand" value="{{ old('brand', $item->brand) }}"
                           class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Points Cost</label>
                    <input type="number" name="points_cost" min="1"
                           value="{{ old('points_cost', $item->points_cost) }}"
                           class="w-full border rounded px-3 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Stock (leave blank for Unlimited)</label>
                    <input type="number" name="stock" min="0"
                           value="{{ old('stock', $item->stock) }}"
                           class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Description</label>
                    <textarea name="description" class="w-full border rounded px-3 py-2"
                              rows="3">{{ old('description', $item->description) }}</textarea>
                </div>

                {{-- ✅ IMAGE SECTION --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Reward Image</label>

                    @if($item->image_path)
                        <div class="mb-2">
                            <p class="text-sm text-gray-600 mb-1">Current:</p>
                            <img src="{{ asset('storage/' . $item->image_path) }}"
                                 class="w-24 h-24 object-cover rounded border">
                        </div>
                    @endif

                    <input type="file" name="image" accept="image/*"
                           class="w-full border rounded px-3 py-2">
                    <p class="text-xs text-gray-500 mt-1">Leave blank to keep existing image.</p>
                </div>

                <div class="mb-6 flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1"
                           {{ old('is_active', $item->is_active) ? 'checked' : '' }}>
                    <label class="text-sm">Active</label>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 rounded-md font-semibold text-sm
                                   !bg-green-600 !text-white hover:!bg-green-700 shadow">
                        Save Reward
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
