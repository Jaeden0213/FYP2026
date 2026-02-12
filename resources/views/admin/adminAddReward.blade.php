<style>
.save-btn {
    background-color: #16a34a; /* green */
    color: white !important;   /* force white text */
    padding: 10px 18px;
    border-radius: 6px;
    font-weight: 600;
    border: none;
    cursor: pointer;
}

.save-btn:hover {
    background-color: #15803d; /* darker green */
}

.save-btn:disabled {
    background-color: #9ca3af; /* gray when disabled */
    cursor: not-allowed;
}
</style>
<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-xl mx-auto bg-white shadow rounded p-6">

            {{-- Header --}}
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Add Reward</h1>

                <a href="{{ route('admin.rewards.index') }}"
                   class="text-sm text-gray-600 hover:underline">
                    Back
                </a>
            </div>

            {{-- ✅ AJAX Success Message (hidden by default) --}}
            <div id="ajaxSuccess" class="hidden mb-4 p-4 bg-green-100 text-green-700 rounded"></div>

            {{-- ✅ AJAX Error Box (hidden by default) --}}
            <div id="ajaxErrors" class="hidden mb-4 p-4 bg-red-100 text-red-700 rounded">
                <ul id="ajaxErrorsList" class="list-disc pl-5"></ul>
            </div>

            {{-- ✅ Normal Blade Errors (optional fallback) --}}
            @if($errors->any())
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                    <ul class="list-disc pl-5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ✅ IMPORTANT:
                 - give form an id so JS can intercept submit
                 - enctype is required for image upload --}}
            <form id="rewardForm"
                  method="POST"
                  action="{{ route('admin.rewards.store') }}"
                  enctype="multipart/form-data"
                  class="space-y-4">
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
                    <label class="block text-sm font-medium text-gray-700 mb-1">Reward Image</label>
                    <input type="file" name="image" accept="image/*"
                           class="w-full border rounded px-3 py-2">

                    {{-- Image preview container (hidden until user selects file) --}}
                    <div id="preview" class="mt-2 hidden">
                        <img id="previewImg" class="w-32 h-32 object-cover rounded border">
                    </div>
                </div>

                {{-- Active checkbox --}}
                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                           class="rounded border-gray-300"
                           {{ old('is_active', true) ? 'checked' : '' }}>
                    <label for="is_active" class="text-sm text-gray-700">Set as Active</label>
                </div>

                {{-- Buttons --}}
                <button id="saveBtn" type="submit" class="save-btn">
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

{{-- ✅ Push script to layout (layout must have @stack('scripts')) --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {

    // ==============================
    // 1) GET IMPORTANT HTML ELEMENTS
    // ==============================
    const form = document.getElementById('rewardForm');
    const saveBtn = document.getElementById('saveBtn');

    const successBox = document.getElementById('ajaxSuccess');
    const errorBox = document.getElementById('ajaxErrors');
    const errorList = document.getElementById('ajaxErrorsList');

    const imageInput = document.querySelector('input[name="image"]');
    const preview = document.getElementById('preview');
    const previewImg = document.getElementById('previewImg');

    // ==============================
    // 2) IMAGE PREVIEW (optional)
    // ==============================
    if (imageInput) {
        imageInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (!file) return;

            // Create temporary browser URL so user can preview image
            previewImg.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
        });
    }

    // ==============================
    // 3) AJAX SUBMIT
    // ==============================
    form.addEventListener('submit', async (e) => {
        e.preventDefault(); // ✅ stop normal form submit (no refresh)

        // 3.1 Reset message UI
        successBox.classList.add('hidden');
        errorBox.classList.add('hidden');
        errorList.innerHTML = '';

        // 3.2 Disable button to prevent double click spam
        saveBtn.disabled = true;
        saveBtn.textContent = 'Saving...';

        // 3.3 Collect all form data (including image)
        const formData = new FormData(form);

        try {
            // 3.4 Send request to Laravel route using fetch()
            const res = await fetch(form.action, {
                method: 'POST',
                headers: {
                    // Tell Laravel we want JSON responses
                    'Accept': 'application/json',

                    // CSRF token required for Laravel POST security
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value
                },
                body: formData
            });

            // 3.5 Validation errors (Laravel returns 422 with JSON)
            if (res.status === 422) {
                const data = await res.json();

                // data.errors is an object:
                // { name: ["..."], brand: ["..."] }
                Object.values(data.errors).flat().forEach((msg) => {
                    const li = document.createElement('li');
                    li.textContent = msg;
                    errorList.appendChild(li);
                });

                errorBox.classList.remove('hidden');
                return;
            }

            // 3.6 Other server error (500/404 etc)
            if (!res.ok) {
                const li = document.createElement('li');
                li.textContent = 'Something went wrong. Please try again.';
                errorList.appendChild(li);
                errorBox.classList.remove('hidden');
                return;
            }

            // 3.7 Success response
            const data = await res.json();

            successBox.textContent = data.message || 'Reward added successfully!';
            successBox.classList.remove('hidden');

            // Optional: redirect to index page after success
            window.location.href = data.redirect;

        } catch (err) {
            // 3.8 Network error (no internet / server down)
            const li = document.createElement('li');
            li.textContent = 'Network error. Please check your connection.';
            errorList.appendChild(li);
            errorBox.classList.remove('hidden');
        } finally {
            // 3.9 Re-enable button after request finishes
            saveBtn.disabled = false;
            saveBtn.textContent = 'Save Reward';
        }
    });

});
</script>
@endpush
