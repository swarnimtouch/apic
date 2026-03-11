@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', '⚡ Dashboard')

@push('styles')
    <style>
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 24px;
            position: relative;
            overflow: hidden;
            transition: transform .2s, border-color .2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            border-color: var(--accent);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
        }

        .stat-card.blue::before  { background: linear-gradient(90deg, #00d4ff, #7c3aed); }
        .stat-card.green::before { background: linear-gradient(90deg, #00e5a0, #00d4ff); }
        .stat-card.orange::before{ background: linear-gradient(90deg, #ff6b35, #ff4d6d); }
        .stat-card.purple::before{ background: linear-gradient(90deg, #7c3aed, #ec4899); }

        .stat-icon {
            font-size: 28px;
            margin-bottom: 14px;
        }

        .stat-value {
            font-family: 'Syne', sans-serif;
            font-size: 36px;
            font-weight: 800;
            line-height: 1;
            margin-bottom: 6px;
        }

        .stat-card.blue  .stat-value { color: #00d4ff; }
        .stat-card.green .stat-value { color: #00e5a0; }
        .stat-card.orange .stat-value{ color: #ff6b35; }
        .stat-card.purple .stat-value { color: #a78bfa; }

        .stat-label {
            font-size: 13px;
            color: var(--muted);
            font-weight: 500;
        }

        .stat-glow {
            position: absolute;
            bottom: -20px;
            right: -20px;
            width: 80px; height: 80px;
            border-radius: 50%;
            filter: blur(30px);
            opacity: .2;
        }

        .stat-card.blue   .stat-glow { background: #00d4ff; }
        .stat-card.green  .stat-glow { background: #00e5a0; }
        .stat-card.orange .stat-glow { background: #ff6b35; }
        .stat-card.purple .stat-glow { background: #7c3aed; }

        /* Recent doctors */
        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .section-title {
            font-family: 'Syne', sans-serif;
            font-size: 17px;
            font-weight: 700;
        }

        .view-all {
            font-size: 12px;
            color: var(--accent);
            text-decoration: none;
            font-weight: 600;
            letter-spacing: .03em;
        }

        .table-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            padding: 14px 20px;
            background: var(--surface2);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--muted);
            text-align: left;
        }

        tbody tr {
            border-top: 1px solid var(--border);
            transition: background .15s;
        }

        tbody tr:hover { background: var(--surface2); }

        tbody td {
            padding: 14px 20px;
            font-size: 14px;
        }

        .doc-avatar {
            width: 34px; height: 34px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 13px;
            color: #fff;
            margin-right: 10px;
            flex-shrink: 0;
            vertical-align: middle;
        }

        .badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .badge-blue {
            background: rgba(0,212,255,.1);
            color: var(--accent);
            border: 1px solid rgba(0,212,255,.2);
        }

        .empty-state {
            text-align: center;
            padding: 48px;
            color: var(--muted);
        }

        .empty-state .empty-icon { font-size: 40px; margin-bottom: 12px; }
        .empty-state p { font-size: 14px; }

        :root {
            --surface2: #1a2438;
        }

        /* ── DASHBOARD RESPONSIVE ── */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
                margin-bottom: 20px;
            }
            .stat-card { padding: 18px 14px; }
            .stat-icon { font-size: 22px; margin-bottom: 10px; }
            .stat-value { font-size: 28px; }
            .stat-label { font-size: 12px; }

            .table-card { border-radius: 12px; }
            thead th, tbody td { padding: 10px 12px; font-size: 13px; }
            .doc-avatar { width: 28px; height: 28px; font-size: 11px; margin-right: 6px; }
        }

        @media (max-width: 480px) {
            .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
            .stat-card { padding: 14px 12px; }
            .stat-value { font-size: 24px; }

            /* Hide less critical columns on tiny screens */
            thead th:nth-child(3),
            thead th:nth-child(5),
            tbody td:nth-child(3),
            tbody td:nth-child(5) { display: none; }

            .section-header { flex-wrap: wrap; gap: 6px; }
        }

        /* Scrollable table on small screens */
        .table-scroll { overflow-x: auto; -webkit-overflow-scrolling: touch; }
    </style>
@endpush

@section('content')

    <div class="stats-grid">
        <div class="stat-card blue">
            <div class="stat-glow"></div>
            <div class="stat-icon">👨‍⚕️</div>
            <div class="stat-value">{{ $totalDoctors }}</div>
            <div class="stat-label">Total Doctors</div>
        </div>
        <div class="stat-card green">
            <div class="stat-glow"></div>
            <div class="stat-icon">🏙️</div>
            <div class="stat-value">{{ $citiesCount }}</div>
            <div class="stat-label">Cities Covered</div>
        </div>
        <div class="stat-card orange">
            <div class="stat-glow"></div>
            <div class="stat-icon">🩺</div>
            <div class="stat-value">{{ $specialities }}</div>
            <div class="stat-label">Specialities</div>
        </div>
        <div class="stat-card purple">
            <div class="stat-glow"></div>
            <div class="stat-icon">🏥</div>
            <div class="stat-value">{{ $totalDoctors > 0 ? round($totalDoctors / max($citiesCount,1), 1) : 0 }}</div>
            <div class="stat-label">Avg per City</div>
        </div>
    </div>
@endsection
