@extends('admin.layout')

@section('title', 'Doctors')
@section('page-title', '👨‍⚕️ Doctors')

@push('styles')
    <style>
        :root { --surface2: #1a2438; }

        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .count-badge {
            background: rgba(0,212,255,.1);
            color: var(--accent);
            border: 1px solid rgba(0,212,255,.2);
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            font-family: 'Syne', sans-serif;
            white-space: nowrap;
        }

        .search-wrap {
            position: relative;
            width: 260px;
        }

        .search-wrap input {
            width: 100%;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 10px 14px 10px 38px;
            color: var(--text);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            outline: none;
            transition: border-color .2s;
            -webkit-appearance: none;
        }

        .search-wrap input:focus { border-color: var(--accent); }

        .search-wrap::before {
            content: '🔍';
            position: absolute;
            left: 11px; top: 50%;
            transform: translateY(-50%);
            font-size: 13px;
            pointer-events: none;
        }

        /* ── TABLE CARD ── */
        .table-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
        }

        /* Desktop table */
        .table-wrap {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            padding: 13px 18px;
            background: var(--surface2);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: .08em;
            text-transform: uppercase;
            color: var(--muted);
            text-align: left;
            white-space: nowrap;
        }

        tbody tr {
            border-top: 1px solid var(--border);
            transition: background .15s;
        }

        tbody tr:hover { background: var(--surface2); }

        tbody td {
            padding: 13px 18px;
            font-size: 14px;
            vertical-align: middle;
        }

        .doc-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .doc-avatar {
            width: 36px; height: 36px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-weight: 800; font-size: 14px; color: #fff;
            flex-shrink: 0;
            font-family: 'Syne', sans-serif;
        }

        .doc-name  { font-weight: 600; font-size: 14px; }
        .doc-email { font-size: 12px; color: var(--muted); margin-top: 2px; }
        .text-muted { color: var(--muted); }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            white-space: nowrap;
        }

        .badge-blue  { background: rgba(0,212,255,.1);  color: #00d4ff; border: 1px solid rgba(0,212,255,.2); }
        .badge-green { background: rgba(0,229,160,.1);  color: #00e5a0; border: 1px solid rgba(0,229,160,.2); }

        .av-0 { background: linear-gradient(135deg,#00d4ff,#7c3aed); }
        .av-1 { background: linear-gradient(135deg,#00e5a0,#00d4ff); }
        .av-2 { background: linear-gradient(135deg,#ff6b35,#ff4d6d); }
        .av-3 { background: linear-gradient(135deg,#7c3aed,#ec4899); }
        .av-4 { background: linear-gradient(135deg,#fbbf24,#ff6b35); }

        /* pagination */
        /* ── PAGINATION ── */
        .pagination-wrap {
            padding: 14px 18px;
            border-top: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        .pagination-info { font-size: 13px; color: var(--muted); }

        .pagination { display: flex; gap: 4px; list-style: none; flex-wrap: wrap; }

        .pagination li a,
        .pagination li span {
            display: flex; align-items: center; justify-content: center;
            width: 34px; height: 34px; border-radius: 8px;
            font-size: 13px; font-weight: 600; color: var(--muted);
            text-decoration: none; border: 1px solid var(--border); transition: all .2s;
        }

        .pagination li.active span { background: var(--accent); color: #0a0f1e; border-color: var(--accent); }
        .pagination li a:hover     { background: var(--surface2); color: var(--text); }

        /* empty / no-result */
        .empty-state {
            text-align: center; padding: 56px 20px; color: var(--muted);
        }
        .empty-state .empty-icon { font-size: 44px; margin-bottom: 14px; }
        .empty-state h3 { font-family: 'Syne', sans-serif; font-size: 18px; color: var(--text); margin-bottom: 6px; }
        .empty-state p  { font-size: 14px; }

        .search-empty { text-align: center; padding: 40px 20px; }
        .search-empty-icon  { font-size: 36px; margin-bottom: 10px; opacity:.6; }
        .search-empty-title { font-family: 'Syne', sans-serif; font-size: 16px; font-weight: 700; color: var(--text); }

        /* ══════════════════════════════
           MOBILE CARD LAYOUT  ≤ 640px
           ══════════════════════════════ */
        @media (max-width: 640px) {
            .page-header   { flex-direction: column; align-items: stretch; }
            .search-wrap   { width: 100%; }
            .search-wrap input { font-size: 16px; /* prevent iOS zoom */ }

            /* Hide the normal table entirely */
            .table-wrap { display: none; }

            /* Show card list instead */
            .card-list { display: block; padding: 12px; }

            .doc-card {
                background: var(--surface2);
                border: 1px solid var(--border);
                border-radius: 14px;
                padding: 14px;
                margin-bottom: 10px;
                display: none; /* JS controls visibility */
            }

            .doc-card.visible { display: block; }

            .doc-card-top {
                display: flex;
                align-items: center;
                gap: 12px;
                margin-bottom: 12px;
            }

            .doc-card-avatar {
                width: 44px; height: 44px;
                border-radius: 12px;
                display: flex; align-items: center; justify-content: center;
                font-weight: 800; font-size: 18px; color: #fff;
                flex-shrink: 0;
                font-family: 'Syne', sans-serif;
            }

            .doc-card-name  { font-weight: 700; font-size: 15px; }
            .doc-card-email { font-size: 12px; color: var(--muted); margin-top: 2px; }

            .doc-card-fields { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }

            .doc-field { }
            .doc-field-label {
                font-size: 10px;
                font-weight: 700;
                letter-spacing: .07em;
                text-transform: uppercase;
                color: var(--muted);
                margin-bottom: 3px;
            }
            .doc-field-val { font-size: 13px; color: var(--text); }

            .card-no-result {
                display: none;
                text-align: center;
                padding: 36px 20px;
            }
            .card-no-result.show { display: block; }
            .card-no-result-icon  { font-size: 36px; margin-bottom: 8px; opacity:.6; }
            .card-no-result-title { font-family: 'Syne', sans-serif; font-size: 15px; font-weight: 700; color: var(--text); }

            /* pagination on mobile */
            .pagination-wrap {
                flex-direction: column;
                align-items: center;
                padding: 14px 12px;
                gap: 10px;
            }
            .pagination-info { font-size: 12px; text-align: center; }
            .pagination { justify-content: center; }
            .pagination li a,
            .pagination li span { width: 36px; height: 36px; font-size: 14px; }
        }

        /* Desktop: hide card list */
        @media (min-width: 641px) {
            .card-list    { display: none; }
            .card-no-result { display: none; }
        }

        /* Tablet tweak */
        @media (max-width: 900px) and (min-width: 641px) {
            .search-wrap { width: 200px; }
            table { min-width: 600px; }
            thead th, tbody td { padding: 11px 12px; font-size: 13px; }
        }
    </style>
@endpush

@section('content')

    <div class="page-header">
        <span class="count-badge">{{ $doctors->total() }} Doctors</span>
        <div class="search-wrap">
            <input type="text" placeholder="Search doctors..." id="searchInput">
        </div>
    </div>

    <div class="table-card">

        {{-- ── DESKTOP TABLE ── --}}
        <div class="table-wrap">
            @if($doctors->count())
                <table id="doctorsTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Doctor</th>
                        <th>Speciality</th>
                        <th>Hospital</th>
                        <th>City</th>
                        <th>Phone</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($doctors as $i => $doc)
                        @php $av = $i % 5; @endphp
                        <tr data-search="{{ strtolower($doc->name.' '.$doc->email.' '.$doc->speciality.' '.$doc->hospital_name.' '.$doc->city.' '.$doc->phone) }}">
                            <td class="text-muted" style="font-size:13px">{{ $doctors->firstItem() + $i }}</td>
                            <td>
                                <div class="doc-info">
                                    <div class="doc-avatar av-{{ $av }}">{{ strtoupper(substr($doc->name,0,1)) }}</div>
                                    <div>
                                        <div class="doc-name">{{ $doc->name }}</div>
                                        <div class="doc-email">{{ $doc->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td><span class="badge badge-blue">{{ $doc->speciality }}</span></td>
                            <td class="text-muted">{{ $doc->hospital_name }}</td>
                            <td><span class="badge badge-green">{{ $doc->city }}</span></td>
                            <td class="text-muted">{{ $doc->phone }}</td>
                        </tr>
                    @endforeach
                    <tr id="noResultRow" style="display:none;">
                        <td colspan="6">
                            <div class="search-empty">
                                <div class="search-empty-icon">🔍</div>
                                <div class="search-empty-title">No Doctor Found</div>
                            </div>
                        </td>
                    </tr>
                    </tbody>
                </table>
            @else
                <div class="empty-state">
                    <div class="empty-icon">🏥</div>
                    <h3>No Doctors Found</h3>
                    <p>No doctor records have been added yet.</p>
                </div>
            @endif
        </div>

        {{-- ── MOBILE CARD LIST ── --}}
        <div class="card-list" id="cardList">
            @foreach($doctors as $i => $doc)
                @php $av = $i % 5; @endphp
                <div class="doc-card visible"
                     data-search="{{ strtolower($doc->name.' '.$doc->email.' '.$doc->speciality.' '.$doc->hospital_name.' '.$doc->city.' '.$doc->phone) }}">
                    <div class="doc-card-top">
                        <div class="doc-card-avatar av-{{ $av }}">{{ strtoupper(substr($doc->name,0,1)) }}</div>
                        <div>
                            <div class="doc-card-name">{{ $doc->name }}</div>
                            <div class="doc-card-email">{{ $doc->email }}</div>
                        </div>
                    </div>
                    <div class="doc-card-fields">
                        <div class="doc-field">
                            <div class="doc-field-label">Speciality</div>
                            <div class="doc-field-val"><span class="badge badge-blue">{{ $doc->speciality }}</span></div>
                        </div>
                        <div class="doc-field">
                            <div class="doc-field-label">City</div>
                            <div class="doc-field-val"><span class="badge badge-green">{{ $doc->city }}</span></div>
                        </div>
                        <div class="doc-field">
                            <div class="doc-field-label">Hospital</div>
                            <div class="doc-field-val" style="font-size:12px;color:var(--muted)">{{ $doc->hospital_name }}</div>
                        </div>
                        <div class="doc-field">
                            <div class="doc-field-label">Phone</div>
                            <div class="doc-field-val" style="font-size:12px;color:var(--muted)">{{ $doc->phone }}</div>
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="card-no-result" id="cardNoResult">
                <div class="card-no-result-icon">🔍</div>
                <div class="card-no-result-title">No Doctor Found</div>
            </div>
        </div>

        {{-- ── PAGINATION (dono desktop + mobile ke liye) ── --}}
        @if($doctors->hasPages())
            <div class="pagination-wrap" id="paginationWrap">
                <div class="pagination-info">
                    Showing {{ $doctors->firstItem() }}–{{ $doctors->lastItem() }} of {{ $doctors->total() }}
                </div>
                {{ $doctors->links('admin.pagination') }}
            </div>
        @endif

    </div>

@endsection

@push('scripts')
    <script>
        document.getElementById('searchInput').addEventListener('input', function () {
            const val = this.value.toLowerCase().trim();
            const pagination = document.getElementById('paginationWrap');

            // ── Desktop table search ──
            const rows = document.querySelectorAll('#doctorsTable tbody tr[data-search]');
            let tableVisible = 0;
            rows.forEach(row => {
                const match = !val || row.dataset.search.includes(val);
                row.style.display = match ? '' : 'none';
                if (match) tableVisible++;
            });
            const noResult = document.getElementById('noResultRow');
            if (noResult) noResult.style.display = (val && tableVisible === 0) ? '' : 'none';

            // ── Mobile card search ──
            const cards = document.querySelectorAll('#cardList .doc-card');
            let cardVisible = 0;
            cards.forEach(card => {
                const match = !val || card.dataset.search.includes(val);
                card.classList.toggle('visible', match);
                if (match) cardVisible++;
            });
            const cardNoResult = document.getElementById('cardNoResult');
            if (cardNoResult) cardNoResult.classList.toggle('show', val !== '' && cardVisible === 0);

            // ── Pagination: search karte waqt hide, clear hone par wapas show ──
            if (pagination) {
                pagination.style.display = val ? 'none' : '';
            }
        });
    </script>
@endpush
