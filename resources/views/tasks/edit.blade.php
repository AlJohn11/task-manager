<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task · Task Manager</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --ink:      #1e1b4b;
            --indigo:   #4f46e5;
            --indigo-d: #4338ca;
            --amber:    #f59e0b;
            --bg:       #faf9f7;
            --card:     #ffffff;
            --border:   #e7e5f0;
            --muted:    #6b6a8c;
            --text:     #211f3d;
        }

        body {
            font-family: 'Manrope', sans-serif;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
        }

        .header {
            background: linear-gradient(120deg, var(--ink), var(--indigo-d));
            padding: 0 32px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-left { display: flex; align-items: center; gap: 11px; }

        .logo {
            width: 34px; height: 34px;
            background: var(--amber);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--ink);
        }

        .app-name { font-size: 15px; font-weight: 800; color: #ffffff; letter-spacing: 0.2px; }

        .breadcrumb { display: flex; align-items: center; gap: 7px; font-size: 12.5px; color: #a5a2d6; }
        .breadcrumb a { color: #c7c4ec; text-decoration: none; }
        .breadcrumb a:hover { color: #ffffff; }
        .sep { color: #6d69a8; }

        .page { max-width: 580px; margin: 48px auto; padding: 0 24px; }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 28px;
        }

        .page-title { font-size: 21px; font-weight: 800; color: var(--ink); letter-spacing: -0.3px; }
        .page-sub { font-size: 13.5px; color: var(--muted); margin-top: 4px; }

        .id-tag {
            background: #fff4de;
            border: 1px solid #ffe4b0;
            color: #92640a;
            font-size: 11.5px;
            font-weight: 700;
            padding: 5px 13px;
            border-radius: 20px;
        }

        .form-card {
            background: var(--card);
            border-radius: 18px;
            border: 1px solid var(--border);
            padding: 32px;
            box-shadow: 0 8px 28px rgba(30,27,75,0.06);
        }

        .field { margin-bottom: 22px; }

        label {
            display: block;
            font-size: 12.5px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 8px;
        }

        .req { color: var(--amber); }

        input[type="text"],
        input[type="date"],
        textarea,
        select {
            width: 100%;
            padding: 12px 15px;
            border: 1.5px solid var(--border);
            border-radius: 11px;
            font-size: 13.5px;
            font-family: inherit;
            color: var(--text);
            background: #fbfbfe;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
        }

        input:focus, textarea:focus, select:focus {
            border-color: var(--indigo);
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(79,70,229,0.12);
        }

        textarea { resize: vertical; min-height: 96px; line-height: 1.6; }

        .hint { font-size: 12px; color: var(--muted); margin-top: 6px; }

        .err {
            font-size: 12px;
            color: #dc2626;
            margin-top: 6px;
            display: flex;
            align-items: center;
            gap: 4px;
            font-weight: 600;
        }

        .divider { height: 1px; background: var(--border); margin: 26px 0; }

        .form-btns { display: flex; gap: 10px; }

        .btn-save {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: var(--indigo);
            color: white;
            padding: 13px 20px;
            border-radius: 11px;
            font-size: 14px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            font-family: inherit;
            box-shadow: 0 6px 16px rgba(79,70,229,0.25);
            transition: background 0.15s, transform 0.1s;
        }
        .btn-save:hover { background: var(--indigo-d); transform: translateY(-1px); }

        .btn-cancel {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #ffffff;
            color: var(--ink);
            border: 1.5px solid var(--border);
            padding: 13px 20px;
            border-radius: 11px;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            transition: background 0.15s;
        }
        .btn-cancel:hover { background: #f4f3fb; }
    </style>
</head>
<body>

<header class="header">
    <div class="header-left">
        <div class="logo">
            <i data-lucide="check-square" style="width:18px;height:18px;"></i>
        </div>
        <span class="app-name">Task Manager</span>
    </div>
    <div class="breadcrumb">
        <a href="{{ route('tasks.index') }}">Dashboard</a>
        <span class="sep">/</span>
        <span style="color:white;">Edit Task</span>
    </div>
</header>

<div class="page">
    <div class="page-header">
        <div>
            <div class="page-title">Edit Task</div>
            <div class="page-sub">Update the information for this task.</div>
        </div>
        <span class="id-tag">Task #{{ $task->id }}</span>
    </div>

    <div class="form-card">
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf @method('PUT')
            <div class="field">
                <label>Task Name <span class="req">*</span></label>
                <input type="text" name="task_name" value="{{ old('task_name', $task->task_name) }}">
                @error('task_name')
                <div class="err">
                    <i data-lucide="alert-circle" style="width:12px;height:12px;"></i>
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="field">
                <label>Description</label>
                <textarea name="description">{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="field">
                <label>Due Date</label>
                <input type="date" name="due_date" value="{{ old('due_date', $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">
            </div>

            <div class="field">
                <label>Status</label>
                <select name="status">
                    <option value="Pending" {{ old('status', $task->status) === 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Completed" {{ old('status', $task->status) === 'Completed' ? 'selected' : '' }}>Completed</option>
                </select>
                <div class="hint">You can also toggle status directly from the dashboard.</div>
            </div>

            <div class="divider"></div>

            <div class="form-btns">
                <button type="submit" class="btn-save">
                    <i data-lucide="save" style="width:14px;height:14px;"></i>
                    Save Changes
                </button>
                <a href="{{ route('tasks.index') }}" class="btn-cancel">Discard</a>
            </div>
        </form>
    </div>
</div>

<script>lucide.createIcons();</script>
</body>
</html>