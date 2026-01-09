<div class="form-group">
    <label>Title</label>
    <input type="text" name="title" value="{{ $task->title ?? '' }}" required>
</div>

<div class="form-group">
    <label>Assignee</label>
    <input type="text" name="assignee" value="{{ $task->assignee ?? '' }}">
</div>

<div class="form-group">
    <label>Priority</label>
    <select name="priority" required>
        <option value="low" {{ isset($task) && $task->priority == 'low' ? 'selected' : '' }}>Low</option>
        <option value="medium" {{ isset($task) && $task->priority == 'medium' ? 'selected' : '' }}>Medium</option>
        <option value="high" {{ isset($task) && $task->priority == 'high' ? 'selected' : '' }}>High</option>
    </select>
</div>

<div class="form-group">
    <label>Due Date</label>
    <input type="date" name="due_date" value="{{ $task->due_date ?? '' }}">
</div>

<button type="submit" class="save-btn">Save</button>

