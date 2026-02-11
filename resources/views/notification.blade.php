<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8 px-4">
        <div class="max-w-3xl mx-auto">
            <div class="flex items-center justify-between mb-5">
                <h1 class="text-2xl font-bold text-gray-900">Notifications</h1>
                <span class="text-sm text-gray-500">{{ $notifications->total() }} total</span>
            </div>

            @if($notifications->count() === 0)
                <div class="bg-white border border-gray-200 rounded-xl p-6 text-gray-600">
                    No notifications yet.
                </div>
            @else
                <div class="bg-white border border-gray-200 rounded-xl overflow-hidden">
                    @foreach($notifications as $n)
                        @php
                            $isUnread = !$n->sent_status;

                            $map = [
                                'task_overdue' => 'Task overdue',
                                'task_completed' => 'Task completed',
                            ];
                            $title = $map[$n->notification_type] ?? 'Notification';
                        @endphp

                        <div id="notif-{{ $n->notification_id }}"
                             class="flex items-start gap-3 px-4 py-4 border-b border-gray-100 hover:bg-gray-50">

                            <div class="mt-2 w-2.5 h-2.5 rounded-full {{ $isUnread ? 'bg-blue-600' : 'bg-gray-300' }}"></div>

                            <div class="flex-1">
                                <div class="flex items-start justify-between gap-4">
                                    <div>
                                        <div class="font-semibold text-gray-900">{{ $title }}</div>
                                        <div class="text-gray-700 mt-1">{{ $n->message }}</div>
                                        <div class="text-sm text-gray-500 mt-2">
                                            {{ $n->created_at->diffForHumans() }}
                                            @if($n->task_id)
                                                • <a href="{{ route('tasks.index') }}" class="text-blue-600 hover:underline">View tasks</a>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <button
                                            class="text-sm px-3 py-1.5 rounded-lg border border-gray-200 hover:bg-white
                                                   {{ $isUnread ? 'text-gray-800' : 'text-gray-400 cursor-not-allowed' }}"
                                            {{ $isUnread ? '' : 'disabled' }}
                                            onclick="markRead({{ $n->notification_id }})">
                                            Mark read
                                        </button>

                                        <button
                                            class="text-sm px-3 py-1.5 rounded-lg bg-red-50 text-red-700 hover:bg-red-100"
                                            onclick="deleteNotif({{ $n->notification_id }})">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>

    <script>
        const csrfToken = "{{ csrf_token() }}";

        async function markRead(id) {
            const res = await fetch(`/notifications/${id}/read`, {
                method: 'PATCH',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
            });

            if (!res.ok) return alert("Failed to mark read.");

            const card = document.getElementById(`notif-${id}`);
            const dot = card?.querySelector('.w-2\\.5.h-2\\.5.rounded-full');
            dot?.classList.remove('bg-blue-600');
            dot?.classList.add('bg-gray-300');
        }

        async function deleteNotif(id) {
            if (!confirm("Delete this notification?")) return;

            const res = await fetch(`/notifications/${id}`, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': csrfToken, 'Accept': 'application/json' }
            });

            if (!res.ok) return alert("Failed to delete.");

            document.getElementById(`notif-${id}`)?.remove();
        }
    </script>
</x-app-layout>
