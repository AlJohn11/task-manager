<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap');

        * { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --ink:      #1e1b4b;
            --indigo:   #4f46e5;
            --indigo-d: #4338ca;
            --amber:    #f59e0b;
            --emerald:  #10b981;
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
            display: grid;
            grid-template-rows: 60px 1fr;
        }

        .header {
            background: linear-gradient(120deg, var(--ink), var(--indigo-d));
            padding: 0 32px;
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

        .header-right { display: flex; align-items: center; gap: 14px; }

        .header-date { font-size: 12px; color: #b7b4e6; }

        .btn-new {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: var(--amber);
            color: var(--ink);
            padding: 9px 17px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 800;
            text-decoration: none;
            font-family: inherit;
            box-shadow: 0 4px 12px rgba(245,158,11,0.3);
            transition: transform 0.1s;
        }
        .btn-new:hover { transform: translateY(-1px); }

        .body {
            display: grid;
            grid-template-columns: 224px 1fr;
            min-height: 0;
        }

        .panel {
            background: #ffffff;
            padding: 28px 16px;
            border-right: 1px solid var(--border);
        }

        .panel-label {
            font-size: 10px;
            font-weight: 800;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
            padding: 0 4px;
        }

        .stat-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 8px;
            background: #f6f5fb;
            border: 1px solid var(--border);
        }

        .stat-item-left {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 13px;
            color: var(--ink);
            font-weight: 600;
        }

        .stat-item-left i { color: var(--indigo); }

        .stat-num { font-size: 18px; font-weight: 800; color: var(--ink); }

        .panel-sep { height: 1px; background: var(--border); margin: 20px 4px; }

        .panel-note { font-size: 11.5px; color: var(--muted); line-height: 1.7; padding: 0 4px; }

        .main { padding: 32px; overflow-y: auto; }

        .main-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 22px;
        }

        .main-top h1 { font-size: 21px; font-weight: 800; color: var(--ink); letter-spacing: -0.3px; }

        .total-chip {
            background: #eeecf9;
            color: var(--indigo);
            font-size: 12px;
            font-weight: 700;
            padding: 5px 13px;
            border-radius: 20px;
            border: 1px solid #ddd9f5;
        }

        .alert-bar {
            background: #ecfdf5;
            border-left: 4px solid var(--emerald);
            color: #065f46;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
        }

        .table-wrap {
            background: var(--card);
            border-radius: 16px;
            border: 1px solid var(--border);
            overflow: hidden;
            box-shadow: 0 8px 28px rgba(30,27,75,0.05);
        }

        table { width: 100%; border-collapse: collapse; }

        thead { background: #f6f5fb; }

        th {
            padding: 13px 18px;
            text-align: left;
            font-size: 11px;
            font-weight: 800;
            color: var(--indigo);
            text-transform: uppercase;
            letter-spacing: 0.6px;
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 15px 18px;
            font-size: 13.5px;
            border-bottom: 1px solid #f6f5fb;
            vertical-align: middle;
        }

        tr:last-child td { border-bottom: none; }
        tr:hover td { background: #fafaff; }

        tr.row-pending   td:first-child { border-left: 3px solid var(--amber); }
        tr.row-completed td:first-child { border-left: 3px solid var(--emerald); }

        .t-name { font-weight: 700; color: var(--ink); }
        .t-desc { font-size: 12px; color: var(--muted); margin-top: 2px; }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 11px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .badge-pending   { background: #fff4de; color: #92640a; }
        .badge-completed { background: #d1fae5; color: #065f46; }

        .badge-dot { width: 6px; height: 6px; border-radius: 50%; }
        .badge-pending   .badge-dot { background: var(--amber); }
        .badge-completed .badge-dot { background: var(--emerald); }

        .acts { display: flex; gap: 6px; }

        .abtn {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 13px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 700;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-family: inherit;
            transition: opacity 0.15s;
        }
        .abtn:hover { opacity: 0.8; }

        .abtn-edit { background: #eeecf9; color: var(--indigo); }
        .abtn-done { background: #d1fae5; color: #065f46; }
        .abtn-undo { background: #fff4de; color: #92640a; }
        .abtn-del  { background: #fde8e8; color: #b91c1c; }

        .empty { text-align: center; padding: 64px 24px; }

        .empty-box {
            width: 56px; height: 56px;
            background: #eeecf9;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            color: var(--indigo);
        }

        .empty h3 { font-size: 15px; font-weight: 800; color: var(--ink); margin-bottom: 5px; }
        .empty p  { font-size: 13px; color: var(--muted); }
    </style>
</head>
<body>

<header class="header">
    <div class="header-left">
        <div class="logo"><i data-lucide="check-square" style="width:18px;height:18px;"></i></div>
        <span class="app-name">Task Manager</span>
    </div>
    <div class="header-right">
        <span class="header-date">{{ now()->format('M d, Y') }}</span>
        <a href="{{ route('tasks.create') }}" class="btn-new">
            <i data-lucide="plus" style="width:14px;height:14px;"></i>
            New Task
        </a>
    </div>
</header>

<div class="body">
    <aside class="panel">
        <div class="panel-label">Overview</div>
        <div class="stat-item">
            <div class="stat-item-left">
                <i data-lucide="list" style="width:14px;height:14px;"></i>
                All Tasks
            </div>
            <span class="stat-num">{{ $counts['total'] }}</span>
        </div>
        <div class="stat-item">
            <div class="stat-item-left">
                <i data-lucide="clock" style="width:14px;height:14px;"></i>
                Pending
            </div>
            <span class="stat-num">{{ $counts['pending'] }}</span>
        </div>
        <div class="stat-item">
            <div class="stat-item-left">
                <i data-lucide="check-circle" style="width:14px;height:14px;"></i>
                Done
            </div>
            <span class="stat-num">{{ $counts['completed'] }}</span>
        </div>
        <div class="panel-sep"></div>
        <div class="panel-note">
            Amber border = Pending<br><br>
            Green border = Completed
        </div>
    </aside>

    <main class="main">
        <div class="main-top">
            <h1>All Tasks</h1>
            <span class="total-chip">{{ $counts['total'] }} {{ $counts['total'] === 1 ? 'task' : 'tasks' }}</span>
        </div>

        @if(session('alert'))
        <div class="alert-bar">
            <i data-lucide="check-circle-2" style="width:15px;height:15px;flex-shrink:0;"></i>
            {{ session('alert') }}
        </div>
        @endif

        <div class="table-wrap">
            @if($records->isEmpty())
            <div class="empty">
                <div class="empty-box"><i data-lucide="inbox" style="width:26px;height:26px;"></i></div>
                <h3>No tasks found</h3>
                <p>Click <strong>New Task</strong> to add your first task.</p>
            </div>
            @else
            <table>
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($records as $record)
                    <tr class="row-{{ strtolower($record->status) }}">
                        <td>
                            <div class="t-name">{{ $record->task_name }}</div>
                            @if($record->description)
                            <div class="t-desc">{{ $record->description }}</div>
                            @endif
                        </td>
                        <td style="font-size:13px;color:var(--muted);">
                            {{ $record->due_date ? $record->due_date->format('M d, Y') : '—' }}
                        </td>
                        <td>
                            <span class="badge {{ $record->isCompleted() ? 'badge-completed' : 'badge-pending' }}">
                                <span class="badge-dot"></span>
                                {{ $record->status }}
                            </span>
                        </td>
                        <td>
                            <div class="acts">
                                <a href="{{ route('tasks.edit', $record) }}" class="abtn abtn-edit">
                                    <i data-lucide="pencil" style="width:11px;height:11px;"></i>
                                    Edit
                                </a>
                                <form action="{{ route('tasks.updateStatus', $record) }}" method="POST" style="display:inline">
                                    @csrf @method('PATCH')
                                    @if($record->isPending())
                                    <button type="submit" class="abtn abtn-done">
                                        <i data-lucide="check" style="width:11px;height:11px;"></i>
                                        Complete
                                    </button>
                                    @else
                                    <button type="submit" class="abtn abtn-undo">
                                        <i data-lucide="rotate-ccw" style="width:11px;height:11px;"></i>
                                        Reopen
                                    </button>
                                    @endif
                                </form>
                                <form action="{{ route('tasks.destroy', $record) }}" method="POST" style="display:inline" onsubmit="return confirm('Are you sure you want to delete this task?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="abtn abtn-del">
                                        <i data-lucide="trash-2" style="width:11px;height:11px;"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </main>
</div>

<script>lucide.createIcons();</script>
</body>
</html>