<x-app-layout>
    <style>
        /* ✅ Same CSS fix so button text always shows */
        .save-btn {
            background-color: #16a34a;
            color: white !important;
            padding: 10px 18px;
            border-radius: 6px;
            font-weight: 600;
            border: none;
            cursor: pointer;
        }
        .save-btn:hover { background-color: #15803d; }
        .save-btn:disabled {
            background-color: #9ca3af;
            cursor: not-allowed;
        }
    </style>

    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-xl mx-auto bg-white shadow rounded p-6">

            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Edit Reward</h1>

                <a href="{{ route('admin.rewards.index') }}"
                   class="text-sm text-gray-600 hover:underline">
                    Back
                </a>
            </div>

            {{-- ✅ AJAX success/errors --}}
            <div id="ajaxSuccess" class="hidden mb-4 p-4 bg-green-100 text-green-700 rounded"></div>

            <div id="ajaxErrors" class="hidden mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul id="ajaxErrorsList" class="list-disc pl-5"></ul>
            </div>

            {{-- ✅ Edit form --}}
            <form id="editRewardForm"
                  method="POST"
                  action="{{ route('admin.rewards.update', $item->id) }}"
                  enctype="multipart/form-data"
                  class="space-y-4">
                @csrf
                @method('PUT') {{-- Laravel uses this to treat POST as PUT --}}

                {{-- Name --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name', $item->name) }}"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                           required>
                </div>

                {{-- Brand --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Brand</label>
                    <input type="text" name="brand" value="{{ old('brand', $item->brand) }}"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                           required>
                </div>

                {{-- Points --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Points Cost</label>
                    <input type="number" name="points_cost" value="{{ old('points_cost', $item->points_cost) }}"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                           min="1" required>
                </div>

                {{-- Stock --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Stock <span class="text-gray-500">(leave blank for Unlimited)</span>
                    </label>
                    <input type="number" name="stock" value="{{ old('stock', $item->stock) }}"
                           class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500"
                           min="0">
                </div>

                {{-- Description --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description (optional)</label>
                    <textarea name="description" rows="3"
                              class="w-full border rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-green-500">{{ old('description', $item->description) }}</textarea>
                </div>

                {{-- Image --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Reward Image</label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full border rounded px-3 py-2">

                    {{-- Show current image (if exists) --}}
                    @if($item->image_path)
                        <div class="mt-2">
                            <p class="text-sm text-gray-600 mb-1">Current image:</p>
                            <img src="{{ asset('storage/'.$item->image_path) }}"
                                 class="w-32 h-32 object-cover rounded border">
                        </div>
                    @endif

                    {{-- Preview new selected image --}}
                    <div id="preview" class="mt-2 hidden">
                        <p class="text-sm text-gray-600 mb-1">New preview:</p>
                        <img id="previewImg" class="w-32 h-32 object-cover rounded border">
                    </div>
                </div>

                {{-- Active --}}
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                           class="rounded border-gray-300"
                           {{ old('is_active', $item->is_active) ? 'checked' : '' }}>
                    <label for="is_active" class="text-sm text-gray-700">Set as Active</label>
                </div>

                {{-- Actions --}}
                <div class="flex gap-3 pt-2">
                    <button id="saveBtn" type="submit" class="save-btn">
                        Update Reward
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    // 1) Grab elements
    const form = document.getElementById('editRewardForm');
    const saveBtn = document.getElementById('saveBtn');

    const successBox = document.getElementById('ajaxSuccess');
    const errorBox = document.getElementById('ajaxErrors');
    const errorList = document.getElementById('ajaxErrorsList');

    const imageInput = document.querySelector('input[name="image"]');
    const preview = document.getElementById('preview');
    const previewImg = document.getElementById('previewImg');

    // 2) Preview selected new image
    if (imageInput) {
        imageInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file) return;

            previewImg.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
        });
    }

    // 3) Intercept submit and send AJAX
    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        // reset UI
        successBox.classList.add('hidden');
        errorBox.classList.add('hidden');
        errorList.innerHTML = '';

        // disable button while saving
        saveBtn.disabled = true;
        saveBtn.textContent = 'Updating...';

        const formData = new FormData(form);

        try {
            const res = await fetch(form.action, {
                method: 'POST', // still POST, Laravel will read @method('PUT')
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                },
                body: formData
            });

            // validation errors
            if (res.status === 422) {
                const data = await res.json();
                Object.values(data.errors).flat().forEach((msg) => {
                    const li = document.createElement('li');
                    li.textContent = msg;
                    errorList.appendChild(li);
                });
                errorBox.classList.remove('hidden');
                return;
            }

            if (!res.ok) {
                const li = document.createElement('li');
                li.textContent = 'Something went wrong. Please try again.';
                errorList.appendChild(li);
                errorBox.classList.remove('hidden');
                return;
            }

            const data = await res.json();

            successBox.textContent = data.message || 'Reward updated!';
            successBox.classList.remove('hidden');

            // redirect back to rewards list
            window.location.href = data.redirect;

        } catch (err) {
            const li = document.createElement('li');
            li.textContent = 'Network error. Please check your connection.';
            errorList.appendChild(li);
            errorBox.classList.remove('hidden');
        } finally {
            saveBtn.disabled = false;
            saveBtn.textContent = 'Update Reward';
        }
    });

});
</script>
@endpush
