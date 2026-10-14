<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Task Manager') · Daymark</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Newsreader:opsz,wght@6..72,500;6..72,600&display=swap" rel="stylesheet">
    <style>
        :root { color-scheme: light; --ink: #202c28; --muted: #748078; --paper: #f5f6f1; --line: #e2e6df; --green: #35664f; --green-dark: #254a39; --coral: #bd6249; }
        * { box-sizing: border-box; }
        body { margin: 0; color: var(--ink); background: var(--paper); font: 15px/1.5 'DM Sans', sans-serif; }
        a { color: inherit; text-decoration: none; }
        .topbar { background: #fff; border-bottom: 1px solid var(--line); }
        .topbar-inner, main { width: min(1040px, calc(100% - 40px)); margin: 0 auto; }
        .topbar-inner { min-height: 66px; display: flex; align-items: center; justify-content: space-between; }
        .brand { display: inline-flex; align-items: center; gap: 10px; font-weight: 700; }
        .brand-mark { display: grid; place-items: center; width: 28px; height: 28px; border-radius: 8px; background: var(--green); color: #fff; font: 600 17px 'Newsreader', serif; }
        .brand small { display: block; color: var(--muted); font-size: 11px; font-weight: 500; }
        main { padding: 50px 0 72px; }
        .page-heading { display: flex; justify-content: space-between; align-items: end; gap: 20px; margin-bottom: 25px; }
        h1, h2 { margin: 0; font-family: 'Newsreader', Georgia, serif; font-weight: 500; }
        h1 { font-size: 38px; line-height: 1.1; }
        .subtitle { margin: 8px 0 0; color: var(--muted); }
        .button { display: inline-flex; align-items: center; justify-content: center; min-height: 42px; padding: 0 16px; border: 1px solid transparent; border-radius: 5px; background: var(--green); color: #fff; font: 600 14px 'DM Sans', sans-serif; cursor: pointer; transition: background .15s ease, transform .15s ease; }
        .button:hover { background: var(--green-dark); transform: translateY(-1px); }
        .button.secondary { border-color: var(--line); background: #fff; color: var(--ink); }
        .button.secondary:hover { background: #f7f8f5; }
        .button.danger { border-color: #efd9d2; background: #fff; color: var(--coral); }
        .notice { margin: 0 0 18px; padding: 12px 15px; border: 1px solid #d7e6dc; border-radius: 5px; background: #edf5ef; color: var(--green-dark); }
        .task-list { border-top: 1px solid var(--line); }
        .task-row { display: grid; grid-template-columns: minmax(0, 1fr) auto; gap: 24px; align-items: center; padding: 19px 4px; border-bottom: 1px solid var(--line); }
        .task-title { display: flex; align-items: center; flex-wrap: wrap; gap: 10px; font-weight: 600; }
        .task-description { max-width: 660px; margin: 5px 0 0; color: var(--muted); white-space: pre-line; overflow-wrap: anywhere; }
        .task-meta { display: flex; align-items: center; flex-wrap: wrap; gap: 10px; margin-top: 9px; color: var(--muted); font-size: 12px; }
        .badge { padding: 3px 8px; border-radius: 3px; background: #e9efe9; color: var(--green-dark); font-size: 11px; font-weight: 700; }
        .badge.complete { background: #eceeea; color: #68716b; }
        .task-actions { display: flex; align-items: center; gap: 8px; }
        .task-actions .button { min-height: 35px; padding: 0 11px; font-size: 12px; }
        .inline-form { margin: 0; }
        .empty { padding: 50px 20px; border: 1px dashed #cbd3ca; text-align: center; }
        .empty h2 { font-size: 25px; }
        .empty p { margin: 7px 0 18px; color: var(--muted); }
        .form-shell { max-width: 680px; }
        .form-card { margin-top: 24px; padding: 26px; border: 1px solid var(--line); background: #fff; }
        .field { margin-bottom: 20px; }
        label { display: block; margin-bottom: 7px; font-size: 13px; font-weight: 700; }
        input:not([type="hidden"]), textarea { display: block; width: 100%; padding: 11px 12px; border: 1px solid #cfd6ce; border-radius: 4px; background: #fff; color: var(--ink); font: inherit; }
        textarea { min-height: 125px; resize: vertical; }
        input:focus, textarea:focus { outline: 2px solid #b8d0c0; border-color: var(--green); }
        .hint { margin: 6px 0 0; color: var(--muted); font-size: 12px; }
        .error { margin: 6px 0 0; color: #a43e32; font-size: 12px; }
        .form-actions { display: flex; gap: 9px; padding-top: 2px; }
        @media (max-width: 680px) {
            .topbar-inner, main { width: min(100% - 30px, 1040px); }
            main { padding-top: 34px; }
            .page-heading { align-items: start; }
            h1 { font-size: 32px; }
            .task-row { grid-template-columns: 1fr; gap: 14px; }
            .task-actions { flex-wrap: wrap; }
            .form-card { padding: 19px; }
        }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <a class="brand" href="{{ route('tasks.index') }}">
                <span class="brand-mark">D</span>
                <span>Daymark<small>Personal Task Manager</small></span>
            </a>
        </div>
    </header>
    <main>
        @if (session('success'))
            <div class="notice" role="status">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>