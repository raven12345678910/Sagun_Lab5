<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
$lab_users = $lab_users ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Users Management</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

:root {
    --bg: #060817;
    --bg-soft: #0a0d20;
    --card: rgba(13, 17, 42, .86);
    --card-2: rgba(18, 22, 54, .72);
    --border: rgba(119, 100, 255, .20);
    --border-soft: rgba(255,255,255,.07);
    --text: #f6f5ff;
    --muted: #9296bd;
    --purple: #8b5cf6;
    --purple-2: #6d4aff;
    --blue: #2563eb;
    --cyan: #22d3ee;
    --green: #19d3a2;
    --danger: #f43f5e;
}

* {
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}

body {
    margin: 0;
    min-height: 100vh;
    font-family: 'Inter', Arial, sans-serif;
    color: var(--text);
    background:
        radial-gradient(circle at 8% 5%, rgba(111, 70, 255, .20), transparent 28%),
        radial-gradient(circle at 90% 8%, rgba(37, 99, 235, .16), transparent 28%),
        radial-gradient(circle at 50% 100%, rgba(139, 92, 246, .10), transparent 35%),
        var(--bg);
}

body::before {
    content: "";
    position: fixed;
    inset: 0;
    pointer-events: none;
    background-image:
        linear-gradient(rgba(255,255,255,.018) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,.018) 1px, transparent 1px);
    background-size: 42px 42px;
    mask-image: linear-gradient(to bottom, black, transparent 90%);
}

/* MAIN */
.wrap {
    width: min(1420px, calc(100% - 60px));
    margin: 0 auto;
    padding: 52px 0 70px;
}

/* HEADER */
.welcome {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    gap: 30px;
    margin-bottom: 34px;
}

.welcome-left {
    display: flex;
    align-items: center;
    gap: 22px;
}

.welcome-icon {
    width: 72px;
    height: 72px;
    flex: 0 0 72px;
    display: grid;
    place-items: center;
    border: 1px solid rgba(139,92,246,.48);
    border-radius: 20px;
    background: linear-gradient(145deg, rgba(139,92,246,.40), rgba(59,130,246,.16));
    box-shadow: 0 18px 45px rgba(91,65,220,.22);
}

.welcome-icon svg {
    width: 34px;
    height: 34px;
    stroke: #ddd6fe;
}

.welcome h1 {
    margin: 0;
    font-size: clamp(32px, 4vw, 48px);
    line-height: 1.05;
    letter-spacing: -1.8px;
    font-weight: 800;
}

.welcome h1 span {
    background: linear-gradient(90deg, #a78bfa, #6366f1, #67e8f9);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
}

.welcome p {
    margin: 10px 0 0;
    color: var(--muted);
    font-size: 14px;
}

/* STAT CARDS */
.stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    width: min(650px, 100%);
}

.stat-card {
    min-height: 92px;
    padding: 17px 18px;
    display: flex;
    align-items: center;
    gap: 14px;
    border: 1px solid var(--border);
    border-radius: 17px;
    background: linear-gradient(145deg, rgba(18,23,58,.86), rgba(9,12,29,.82));
    box-shadow: 0 18px 45px rgba(0,0,0,.20);
}

.stat-icon {
    width: 43px;
    height: 43px;
    flex: 0 0 43px;
    display: grid;
    place-items: center;
    border-radius: 13px;
    background: rgba(139,92,246,.19);
    color: #c4b5fd;
}

.stat-card:nth-child(2) .stat-icon {
    background: rgba(16,185,129,.15);
    color: #5eead4;
}

.stat-card:nth-child(3) .stat-icon {
    background: rgba(37,99,235,.18);
    color: #67e8f9;
}

.stat-icon svg {
    width: 21px;
    height: 21px;
}

.stat-label {
    color: #777da9;
    font-size: 11px;
    font-weight: 700;
    margin-bottom: 5px;
}

.stat-value {
    font-size: 22px;
    font-weight: 800;
}

/* PANEL */
.panel {
    overflow: hidden;
    border: 1px solid var(--border);
    border-radius: 22px;
    background:
        linear-gradient(145deg, rgba(16,20,48,.93), rgba(7,10,27,.94));
    box-shadow:
        0 30px 90px rgba(0,0,0,.38),
        inset 0 1px 0 rgba(255,255,255,.035);
}

/* TOOLBAR */
.panel-head {
    padding: 23px 27px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-bottom: 1px solid var(--border-soft);
}

.panel-title-wrap {
    display: flex;
    align-items: center;
    gap: 12px;
}

.badge {
    padding: 7px 11px;
    border-radius: 8px;
    color: #fff;
    background: linear-gradient(135deg, #8b5cf6, #6366f1);
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .09em;
}

.panel-title {
    font-size: 16px;
    font-weight: 700;
}

.toolbar {
    padding: 20px 27px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 18px;
    border-bottom: 1px solid var(--border-soft);
}

.search-box {
    width: min(520px, 100%);
    position: relative;
}

.search-box svg {
    position: absolute;
    left: 16px;
    top: 50%;
    width: 18px;
    height: 18px;
    transform: translateY(-50%);
    stroke: #8585af;
    pointer-events: none;
}

.search-box input {
    width: 100%;
    height: 48px;
    padding: 0 17px 0 47px;
    outline: none;
    border: 1px solid rgba(111,92,255,.22);
    border-radius: 12px;
    background: rgba(5,8,24,.72);
    color: #fff;
    font: 500 13px 'Inter', sans-serif;
    transition: .25s ease;
}

.search-box input::placeholder {
    color: #6f7295;
}

.search-box input:focus {
    border-color: rgba(139,92,246,.75);
    box-shadow: 0 0 0 4px rgba(139,92,246,.10);
}

.toolbar-right {
    display: flex;
    align-items: center;
    gap: 12px;
}

.filter-btn,
.add-btn {
    height: 46px;
    border-radius: 11px;
    padding: 0 17px;
    display: inline-flex;
    align-items: center;
    gap: 9px;
    font: 700 12px 'Inter', sans-serif;
}

.filter-btn {
    color: #b9bbd7;
    background: rgba(255,255,255,.035);
    border: 1px solid rgba(255,255,255,.08);
}

.add-btn {
    color: white;
    background: linear-gradient(135deg, #8b5cf6, #6d4aff);
    border: 0;
    box-shadow: 0 12px 30px rgba(109,74,255,.25);
}

.add-btn svg,
.filter-btn svg {
    width: 16px;
    height: 16px;
}

/* TABLE */
.table-scroll {
    width: 100%;
    overflow-x: auto;
}

#userTable {
    width: 100%;
    min-width: 920px;
    border-collapse: collapse;
    table-layout: fixed;
}

#userTable th {
    padding: 17px 25px;
    color: #777da8;
    background: rgba(40,47,105,.20);
    border-bottom: 1px solid rgba(255,255,255,.07);
    font-size: 10px;
    font-weight: 800;
    letter-spacing: .10em;
    text-transform: uppercase;
    text-align: left;
}

#userTable th:nth-child(1) { width: 8%; text-align: center; }
#userTable th:nth-child(2) { width: 21%; }
#userTable th:nth-child(3) { width: 18%; }
#userTable th:nth-child(4) { width: 31%; }
#userTable th:nth-child(5) { width: 22%; }

#userTable td {
    padding: 17px 25px;
    color: #aeb1cf;
    border-bottom: 1px solid rgba(255,255,255,.055);
    font-size: 13px;
    vertical-align: middle;
}

#userTable tbody tr {
    transition: background .22s ease, transform .22s ease;
}

#userTable tbody tr:hover {
    background: linear-gradient(90deg, rgba(139,92,246,.08), rgba(37,99,235,.025));
}

#userTable tbody tr:last-child td {
    border-bottom: 0;
}

/* ID */
#userTable td.id {
    text-align: center;
    color: #c4b5fd;
    font-weight: 800;
}

#userTable td.id::first-letter {
    background: #2b216e;
}

#userTable td.id {
    position: relative;
}

#userTable td.id::after {
    content: "";
    display: block;
    width: 30px;
    height: 30px;
    margin: -30px auto 0;
    border-radius: 9px;
    background: rgba(99,102,241,.15);
    border: 1px solid rgba(139,92,246,.13);
    position: relative;
    z-index: -1;
}

/* USER NAME */
#userTable td:nth-child(2),
#userTable td:nth-child(3) {
    color: #eef0ff;
    font-weight: 700;
}

#userTable td.email {
    color: #a78bfa;
    font-weight: 500;
}

#userTable td.username {
    color: #b7b9dc;
    font-weight: 600;
}

/* SEARCH HIGHLIGHT */
mark {
    padding: 2px 3px;
    border-radius: 4px;
    color: #fff;
    background: rgba(139,92,246,.42);
}

/* EMPTY */
.no-results {
    display: none;
    padding: 42px 20px;
    text-align: center;
    color: #8589aa;
    font-size: 13px;
}

/* FOOTER */
.panel-footer {
    padding: 17px 27px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border-top: 1px solid var(--border-soft);
    color: #74799e;
    font-size: 12px;
}

.status-dot {
    display: inline-block;
    width: 7px;
    height: 7px;
    margin-right: 7px;
    border-radius: 50%;
    background: #19d3a2;
    box-shadow: 0 0 12px rgba(25,211,162,.65);
}

/* RESPONSIVE */
@media (max-width: 1050px) {
    .welcome {
        align-items: flex-start;
        flex-direction: column;
    }

    .stats {
        width: 100%;
    }
}

@media (max-width: 720px) {
    .wrap {
        width: min(94%, 1420px);
        padding-top: 30px;
    }

    .welcome-left {
        align-items: flex-start;
    }

    .welcome-icon {
        width: 58px;
        height: 58px;
        flex-basis: 58px;
        border-radius: 16px;
    }

    .welcome h1 {
        font-size: 31px;
    }

    .stats {
        grid-template-columns: 1fr;
    }

    .toolbar {
        align-items: stretch;
        flex-direction: column;
    }

    .toolbar-right {
        width: 100%;
    }

    .filter-btn,
    .add-btn {
        flex: 1;
        justify-content: center;
    }

    .panel-head,
    .toolbar,
    .panel-footer {
        padding-left: 18px;
        padding-right: 18px;
    }
}
</style>
</head>

<body>

<div class="wrap">

    <!-- PAGE HEADER -->
    <div class="welcome">

        <div class="welcome-left">

            <div class="welcome-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8"
                     stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                    <circle cx="9" cy="7" r="4"/>
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                </svg>
            </div>

            <div>
                <h1>Users <span>Management</span></h1>
                <p>Here you can view and manage all registered users in the system.</p>
            </div>

        </div>

        <!-- STATISTICS -->
        <div class="stats">

            <div class="stat-card">
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                        <circle cx="9" cy="7" r="4"/>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-label">TOTAL USERS</div>
                    <div class="stat-value"><?= count($lab_users) ?></div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 7h-9"/>
                        <path d="M14 17H5"/>
                        <circle cx="17" cy="17" r="3"/>
                        <circle cx="7" cy="7" r="3"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-label">ACTIVE USERS</div>
                    <div class="stat-value"><?= count($lab_users) ?></div>
                </div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M12 8v4l3 2"/>
                    </svg>
                </div>
                <div>
                    <div class="stat-label">ONLINE NOW</div>
                    <div class="stat-value">0</div>
                </div>
            </div>

        </div>
    </div>

    <!-- USERS PANEL -->
    <div class="panel">

        <div class="panel-head">
            <div class="panel-title-wrap">
                <span class="badge">USERS</span>
                <span class="panel-title">Registered Users</span>
            </div>
        </div>

        <!-- SEARCH / FILTER -->
        <div class="toolbar">

            <div class="search-box">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2"
                     stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="7"/>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>

                <input
                    type="text"
                    id="userSearch"
                    placeholder="Search by name, email or username..."
                    autocomplete="off"
                >
            </div>

            <div class="toolbar-right">
                <div class="filter-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 6h16M7 12h10M10 18h4"/>
                    </svg>
                    <span>All Users</span>
                </div>

                <div class="add-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                         stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"/>
                        <line x1="5" y1="12" x2="19" y2="12"/>
                    </svg>
                    <span>Add User</span>
                </div>
            </div>

        </div>

        <!-- TABLE -->
        <div class="table-scroll">
            <table id="userTable">

                <thead>
                    <tr>
                        <th>ID</th>
                        <th>FIRSTNAME</th>
                        <th>LASTNAME</th>
                        <th>EMAIL</th>
                        <th>USERNAME</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($lab_users as $u): ?>
                    <tr>
                        <td class="id"><?= htmlspecialchars($u['id']) ?></td>
                        <td><?= htmlspecialchars($u['firstname']) ?></td>
                        <td><?= htmlspecialchars($u['lastname']) ?></td>
                        <td class="email"><?= htmlspecialchars($u['email']) ?></td>
                        <td class="username"><?= htmlspecialchars($u['username']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>

        <div class="no-results" id="noResults">
            No users match your search.
        </div>

        <div class="panel-footer">
            <div>
                <span class="status-dot"></span>
                <span id="resultCount"><?= count($lab_users) ?> users</span>
            </div>

            <div id="welcomeCount">
                Showing <?= count($lab_users) ?> registered users
            </div>
        </div>

    </div>

</div>

<script>
(function(){
    const input = document.getElementById('userSearch');
    const rows = Array.from(document.querySelectorAll('#userTable tbody tr'));
    const resultCount = document.getElementById('resultCount');
    const noResults = document.getElementById('noResults');
    const total = rows.length;

    function highlight(text, term){
        if(!term) return text;

        const idx = text.toLowerCase().indexOf(term.toLowerCase());

        if(idx === -1) return text;

        return text.slice(0, idx)
            + '<mark>' + text.slice(idx, idx + term.length) + '</mark>'
            + text.slice(idx + term.length);
    }

    input.addEventListener('input', function(){
        const term = this.value.trim();
        let visible = 0;

        rows.forEach(row => {
            const cells = row.querySelectorAll('td');

            const original = Array.from(cells).map(
                c => c.dataset.original || (c.dataset.original = c.textContent)
            );

            const haystack = original.join(' ').toLowerCase();
            const match = haystack.includes(term.toLowerCase());

            row.style.display = match ? '' : 'none';

            if(match) visible++;

            cells.forEach((c, i) => {
                c.innerHTML = highlight(original[i], term);
            });
        });

        resultCount.textContent =
            term ? `${visible} of ${total} users` : `${total} users`;

        noResults.style.display =
            visible === 0 ? 'block' : 'none';
    });
})();
</script>

</body>
</html>
