<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">

            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Add Achievement</h1>
                <p class="text-sm text-gray-500 mt-1">Create a new achievement and choose only the tiers you want.</p>
            </div>

            <div id="ajaxErrors" class="hidden mb-4 p-4 bg-red-100 text-red-700 rounded"></div>
            <div id="ajaxSuccess" class="hidden mb-4 p-4 bg-green-100 text-green-700 rounded"></div>

            <form id="achievementForm" action="{{ route('admin.achievements.store') }}" method="POST" class="bg-white shadow rounded p-6 space-y-6">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Code</label>
                    <input type="text" name="code" value="{{ old('code') }}"
                           class="w-full border rounded px-3 py-2"
                           placeholder="study_master" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full border rounded px-3 py-2"
                           placeholder="Study Master" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description <span class="text-gray-400">(optional)</span></label>
                    <textarea name="description" class="w-full border rounded px-3 py-2" rows="3"
                              placeholder="Stay consistent with study tasks to unlock rewards.">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Metric Key</label>
                    <select name="metric_key" class="w-full border rounded px-3 py-2" required>
                        <option value="">-- Select Metric --</option>
                        <option value="tasks_completed_total" {{ old('metric_key') == 'tasks_completed_total' ? 'selected' : '' }}>Tasks Completed Total</option>
                        <option value="tasks_completed_study" {{ old('metric_key') == 'tasks_completed_study' ? 'selected' : '' }}>Tasks Completed Study</option>
                        <option value="tasks_completed_chores" {{ old('metric_key') == 'tasks_completed_chores' ? 'selected' : '' }}>Tasks Completed Chores</option>
                        <option value="tasks_completed_assignment" {{ old('metric_key') == 'tasks_completed_assignment' ? 'selected' : '' }}>Tasks Completed Assignment</option>
                        <option value="tasks_completed_exercise" {{ old('metric_key') == 'tasks_completed_exercise' ? 'selected' : '' }}>Tasks Completed Exercise</option>
                    </select>
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label class="text-sm text-gray-700">Active</label>
                </div>

                <hr>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Select Tiers</label>
                    <div class="flex flex-wrap gap-6">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" id="bronze_check" checked onchange="toggleTier('bronze')">
                            <span class="text-amber-700 font-medium">Bronze</span>
                        </label>

                        <label class="flex items-center gap-2">
                            <input type="checkbox" id="silver_check" checked onchange="toggleTier('silver')">
                            <span class="text-gray-700 font-medium">Silver</span>
                        </label>

                        <label class="flex items-center gap-2">
                            <input type="checkbox" id="gold_check" checked onchange="toggleTier('gold')">
                            <span class="text-yellow-700 font-medium">Gold</span>
                        </label>
                    </div>
                </div>

                <div id="bronze-tier" class="tier-block">
                    <h2 class="text-lg font-semibold text-amber-700 mb-3">Bronze Tier</h2>
                    <input type="hidden" name="tiers[0][tier]" value="bronze" class="tier-hidden">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="number" name="tiers[0][target_value]" value="{{ old('tiers.0.target_value') }}"
                               class="border rounded px-3 py-2 tier-input" placeholder="Target">
                        <input type="number" name="tiers[0][reward_points]" value="{{ old('tiers.0.reward_points') }}"
                               class="border rounded px-3 py-2 tier-input" placeholder="Reward Points">
                        <input type="text" name="tiers[0][reward_title]" value="{{ old('tiers.0.reward_title') }}"
                               class="border rounded px-3 py-2 tier-input" placeholder="Reward Title (optional)">
                    </div>
                </div>

                <div id="silver-tier" class="tier-block">
                    <h2 class="text-lg font-semibold text-gray-700 mb-3">Silver Tier</h2>
                    <input type="hidden" name="tiers[1][tier]" value="silver" class="tier-hidden">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="number" name="tiers[1][target_value]" value="{{ old('tiers.1.target_value') }}"
                               class="border rounded px-3 py-2 tier-input" placeholder="Target">
                        <input type="number" name="tiers[1][reward_points]" value="{{ old('tiers.1.reward_points') }}"
                               class="border rounded px-3 py-2 tier-input" placeholder="Reward Points">
                        <input type="text" name="tiers[1][reward_title]" value="{{ old('tiers.1.reward_title') }}"
                               class="border rounded px-3 py-2 tier-input" placeholder="Reward Title (optional)">
                    </div>
                </div>

                <div id="gold-tier" class="tier-block">
                    <h2 class="text-lg font-semibold text-yellow-700 mb-3">Gold Tier</h2>
                    <input type="hidden" name="tiers[2][tier]" value="gold" class="tier-hidden">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <input type="number" name="tiers[2][target_value]" value="{{ old('tiers.2.target_value') }}"
                               class="border rounded px-3 py-2 tier-input" placeholder="Target">
                        <input type="number" name="tiers[2][reward_points]" value="{{ old('tiers.2.reward_points') }}"
                               class="border rounded px-3 py-2 tier-input" placeholder="Reward Points">
                        <input type="text" name="tiers[2][reward_title]" value="{{ old('tiers.2.reward_title') }}"
                               class="border rounded px-3 py-2 tier-input" placeholder="Reward Title (optional)">
                    </div>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('admin.achievements.index') }}"
                       class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
                        Cancel
                    </a>

                    <button type="submit" id="saveAchievementBtn"
                            class="px-5 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        Save Achievement
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleTier(tier) {
            const checkbox = document.getElementById(tier + '_check');
            const block = document.getElementById(tier + '-tier');
            const inputs = block.querySelectorAll('.tier-input, .tier-hidden');

            if (checkbox.checked) {
                block.style.display = 'block';
                inputs.forEach(input => input.disabled = false);
            } else {
                block.style.display = 'none';
                inputs.forEach(input => input.disabled = true);
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            toggleTier('bronze');
            toggleTier('silver');
            toggleTier('gold');

            const form = document.getElementById('achievementForm');
            const errorBox = document.getElementById('ajaxErrors');
            const successBox = document.getElementById('ajaxSuccess');
            const submitBtn = document.getElementById('saveAchievementBtn');

            form.addEventListener('submit', async function (e) {
                e.preventDefault();

                errorBox.classList.add('hidden');
                successBox.classList.add('hidden');
                errorBox.innerHTML = '';
                successBox.innerHTML = '';

                const originalText = submitBtn.innerText;
                submitBtn.disabled = true;
                submitBtn.innerText = 'Saving...';

                try {
                    const formData = new FormData(form);

                    const response = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        if (data.errors) {
                            let html = '<ul class="list-disc pl-5">';
                            Object.values(data.errors).forEach(messages => {
                                messages.forEach(message => {
                                    html += `<li>${message}</li>`;
                                });
                            });
                            html += '</ul>';
                            errorBox.innerHTML = html;
                        } else {
                            errorBox.innerHTML = 'Something went wrong.';
                        }

                        errorBox.classList.remove('hidden');
                        submitBtn.disabled = false;
                        submitBtn.innerText = originalText;
                        return;
                    }

                    successBox.innerHTML = data.message ?? 'Achievement created successfully!';
                    successBox.classList.remove('hidden');

                    setTimeout(() => {
                        window.location.href = data.redirect;
                    }, 800);

                } catch (error) {
                    errorBox.innerHTML = 'Unexpected error occurred.';
                    errorBox.classList.remove('hidden');
                    submitBtn.disabled = false;
                    submitBtn.innerText = originalText;
                }
            });
        });
    </script>
</x-app-layout>