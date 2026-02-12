<!doctype html>
<html>
<body style="font-family: Arial, sans-serif; line-height:1.6;">

  <h2 style="margin:0 0 8px;">{{ $subjectText }}</h2>

  <p style="margin:0 0 16px;">{{ $bodyText }}</p>

  <div style="border:1px solid #e5e7eb; border-radius:10px; padding:14px; background:#f9fafb;">
      <p style="margin:0;"><strong>Task:</strong> {{ $task->title }}</p>
      <p style="margin:6px 0 0;"><strong>Status:</strong> {{ $task->status }}</p>
      <p style="margin:6px 0 0;"><strong>Due date:</strong> {{ $task->due_date ?? '-' }}</p>
      <p style="margin:6px 0 0;"><strong>Priority:</strong> {{ $task->priority ?? '-' }}</p>
      <p style="margin:6px 0 0;"><strong>Category:</strong> {{ $task->category ?? '-' }}</p>
  </div>

  <p style="margin-top:16px;">
      Open TaskFlow to view and update this task.
  </p>

  <p style="color:#6b7280; font-size:12px; margin-top:20px;">
      — TaskFlow
  </p>

</body>
</html>
