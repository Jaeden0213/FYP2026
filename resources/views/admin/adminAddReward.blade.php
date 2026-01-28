<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-xl mx-auto bg-white shadow rounded p-6">

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Add Reward</h1>

                <a href="{{ route('admin.rewards.index') }}"
                   class="text-sm text-gray-600 hover:underline">
                    Back
                </a>
            </div>

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.rewards.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Name --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="e.g., Starbucks RM10 Voucher" required>
                </div>

                {{-- Brand --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                    <input type="text" name="brand" value="{{ old('brand') }}"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="e.g., Starbucks" required>
                </div>

                {{-- Points --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Points Cost</label>
                    <input type="number" name="points_cost" value="{{ old('points_cost') }}"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="e.g., 100" min="1" required>
                </div>

                {{-- Stock --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Stock <span class="text-gray-500">(leave blank for Unlimited)</span>
                    </label>
                    <input type="number" name="stock" value="{{ old('stock') }}"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                           placeholder="e.g., 10" min="0">
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description (optional)</label>
                    <textarea name="description" rows="3"
                              class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                              placeholder="Short description...">{{ old('description') }}</textarea>
                </div>

                {{-- Image Upload --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Reward Image
                    </label>
                    <input type="file" name="image"
                        accept="image/*"
                        class="w-full border rounded px-3 py-2">
                    <div id="preview" class="mt-2 hidden">
                        <img id="previewImg"
                            class="w-32 h-32 object-cover rounded border">
                    </div>
                </div>

                {{-- Active --}}
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                           class="rounded border-gray-300"
                           {{ old('is_active', true) ? 'checked' : '' }}>
                    <label for="is_active" class="text-sm text-gray-700">Set as Active</label>
                </div>

                {{-- Actions --}}
                <div class="flex gap-3 pt-2">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 rounded-md font-semibold text-sm
                                   !bg-green-600 !text-white hover:!bg-green-700 shadow">
                        Save Reward
                    </button>

                    <a href="{{ route('admin.rewards.index') }}"
                       class="inline-flex items-center px-4 py-2 rounded-md font-semibold text-sm
                              bg-gray-100 text-gray-700 hover:bg-gray-200">
                        Cancel
                    </a>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>

<script>
document.querySelector('input[name="image"]').addEventListener('change', function (e) {
    const file = e.target.files[0];
    if (!file) return;

    const preview = document.getElementById('preview');
    const img = document.getElementById('previewImg');

    img.src = URL.createObjectURL(file);
    preview.classList.remove('hidden');
});
</script>