@extends('layouts.app')

@section('title', 'E-URS | User Dashboard')
@section('page-title', 'User Dashboard')
@section('page-description', 'Manage your Electronic User Requirement Specification requests')

@section('content')

@php
    /*
     | Data dikirim dari controller (opsional, ada nilai default):
     |   $stats          = ['total' => 0, 'review' => 0, 'approved' => 0, 'rejected' => 0];
     |   $recentRequests = koleksi E-URS terbaru milik user (maks. 5)
     */
    $stats = array_merge(
        ['total' => 0, 'review' => 0, 'approved' => 0, 'rejected' => 0],
        $stats ?? []
    );
    $recentRequests = $recentRequests ?? collect();

    $hour     = now()->hour;
    $greeting = $hour < 11 ? 'Good morning' : ($hour < 15 ? 'Good afternoon' : ($hour < 19 ? 'Good evening' : 'Good night'));

    $percent = fn ($v) => $stats['total'] > 0 ? round(($v / $stats['total']) * 100) : 0;

    $cards = [
        ['key' => 'total',     'label' => 'Total Requests', 'desc' => 'All E-URS requests submitted',  'icon' => 'bi-file-earmark-text', 'tone' => 'blue'],
        ['key' => 'review',    'label' => 'Pending Approval', 'desc' => 'Waiting for Head of Department', 'icon' => 'bi-hourglass-split', 'tone' => 'violet'],
        ['key' => 'approved',  'label' => 'Approved',         'desc' => 'Approved and sent to Procurement', 'icon' => 'bi-check-circle',  'tone' => 'green'],
        ['key' => 'rejected',  'label' => 'Rejected',         'desc' => 'Returned to requester',           'icon' => 'bi-x-circle',       'tone' => 'red'],
    ];

    $actions = [
        ['icon' => 'bi-file-earmark-plus', 'title' => 'Create New E-URS',     'text' => 'Submit a new User Requirement Specification for your procurement request.', 'link' => route('user.eurs.create'), 'cta' => 'Start Request'],
        ['icon' => 'bi-folder2-open',      'title' => 'My Requests',          'text' => 'View your submitted E-URS requests and monitor their current status.',      'link' => route('user.eurs.index'),  'cta' => 'View Requests'],
        ['icon' => 'bi-info-circle',       'title' => 'E-URS Guidelines',     'text' => 'Review the information required before submitting an E-URS request.',      'link' => '#',                       'cta' => 'View Guidelines'],
        ['icon' => 'bi-diagram-3',         'title' => 'Procurement Workflow', 'text' => 'Understand how your E-URS request moves through review and procurement.',  'link' => '#',                       'cta' => 'View Workflow'],
    ];

    $steps = [
        ['Create Request', 'Complete the required E-URS information and submit your request.', 'bi-pencil-square'],
        ['EHS Review',     'EHS review is performed when an EHS recommendation is required.',  'bi-shield-check'],
        ['HoD Approval',   'The request is forwarded for Head of Department approval.',        'bi-person-check'],
        ['Procurement',    'Procurement processes the approved E-URS request.',                'bi-cart-check'],
    ];

    /* Nilai `status` sesuai EursController */
    $resolveStatus = function ($r) {
        return match ($r->status) {
            'pending_approval'   => ['Pending Approval',    'violet'],
            'approved'           => ['Approved',            'green'],
            'approved_with_note' => ['Approved with Note',  'green'],
            'rejected'           => ['Rejected',            'red'],
            default              => [ucwords(str_replace('_', ' ', (string) $r->status)) ?: 'Draft', 'amber'],
        };
    };
@endphp

<style>
    .ud {
        --ink: #223d4d;
        --muted: #7a8f9c;
        --line: #e4edf2;
        --brand: #318fc8;
        --brand-dark: #1f6ea3;
        --brand-soft: #eaf7ff;
    }

    .ud-tone-blue   { --t: #2587c8; --t-soft: #eaf7ff; }
    .ud-tone-amber  { --t: #d99622; --t-soft: #fff6e5; }
    .ud-tone-violet { --t: #7965c5; --t-soft: #f1eeff; }
    .ud-tone-green  { --t: #35a76d; --t-soft: #e9f9f0; }
    .ud-tone-red    { --t: #d65353; --t-soft: #fdeeee; }

    /* ---------- HERO ---------- */
    .ud-hero {
        position: relative;
        overflow: hidden;
        border-radius: 24px;
        padding: 34px 36px;
        margin-bottom: 24px;
        color: #fff;
        background: linear-gradient(125deg, #1f6ea3 0%, #318fc8 55%, #5cc0f0 100%);
        box-shadow: 0 14px 34px rgba(49, 143, 200, .28);
    }
    .ud-hero::before,
    .ud-hero::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, .10);
    }
    .ud-hero::before { width: 300px; height: 300px; right: -90px; top: -130px; }
    .ud-hero::after  { width: 160px; height: 160px; right: 150px; bottom: -90px; background: rgba(255, 255, 255, .07); }

    .ud-hero-inner { position: relative; z-index: 2; display: flex; justify-content: space-between; align-items: center; gap: 24px; flex-wrap: wrap; }

    .ud-chip {
        display: inline-flex; align-items: center; gap: 7px;
        background: rgba(255, 255, 255, .18);
        border: 1px solid rgba(255, 255, 255, .28);
        border-radius: 50px;
        padding: 6px 12px;
        font-size: 10px; font-weight: 700; letter-spacing: .7px; text-transform: uppercase;
        margin-bottom: 14px;
    }
    .ud-hero h2 { font-size: 28px; font-weight: 800; margin: 0 0 8px; }
    .ud-hero p  { max-width: 560px; margin: 0 0 22px; font-size: 14px; line-height: 1.7; color: rgba(255, 255, 255, .88); }

    .ud-btn {
        display: inline-flex; align-items: center; gap: 8px;
        border-radius: 12px; padding: 11px 18px;
        font-size: 13px; font-weight: 700; text-decoration: none;
        transition: .2s ease;
    }
    .ud-btn-light { background: #fff; color: var(--brand-dark); box-shadow: 0 8px 18px rgba(0, 0, 0, .12); }
    .ud-btn-light:hover { color: var(--brand-dark); transform: translateY(-2px); }
    .ud-btn-ghost { background: rgba(255, 255, 255, .14); color: #fff; border: 1px solid rgba(255, 255, 255, .35); }
    .ud-btn-ghost:hover { color: #fff; background: rgba(255, 255, 255, .24); }

    .ud-date-box {
        text-align: center;
        background: rgba(255, 255, 255, .16);
        border: 1px solid rgba(255, 255, 255, .28);
        border-radius: 18px;
        padding: 16px 24px;
        min-width: 150px;
    }
    .ud-date-box .day  { font-size: 38px; font-weight: 800; line-height: 1; }
    .ud-date-box .rest { font-size: 12px; margin-top: 6px; opacity: .9; }

    /* ---------- STAT ---------- */
    .ud-stat {
        position: relative; overflow: hidden; height: 100%;
        background: #fff; border: 1px solid var(--line); border-radius: 18px;
        padding: 20px 20px 18px;
        transition: .2s ease;
    }
    .ud-stat::before { content: ""; position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: var(--t); }
    .ud-stat:hover { transform: translateY(-3px); box-shadow: 0 12px 26px rgba(48, 103, 135, .10); }
    .ud-stat-icon {
        width: 44px; height: 44px; border-radius: 13px;
        display: flex; align-items: center; justify-content: center;
        background: var(--t-soft); color: var(--t); font-size: 19px;
        margin-bottom: 16px;
    }
    .ud-stat-label { color: var(--muted); font-size: 12px; font-weight: 600; }
    .ud-stat-value { color: var(--ink); font-size: 30px; font-weight: 800; line-height: 1.2; }
    .ud-stat-desc  { color: #a1afb7; font-size: 11px; margin: 2px 0 12px; }
    .ud-bar { height: 5px; border-radius: 10px; background: var(--t-soft); overflow: hidden; }
    .ud-bar span { display: block; height: 100%; border-radius: 10px; background: var(--t); }

    /* ---------- CARD ---------- */
    .ud-card { background: #fff; border: 1px solid var(--line); border-radius: 18px; overflow: hidden; height: 100%; }
    .ud-card-head { display: flex; justify-content: space-between; align-items: center; padding: 17px 20px; border-bottom: 1px solid #edf2f5; }
    .ud-card-title { margin: 0; font-size: 15px; font-weight: 750; color: var(--ink); }
    .ud-link { color: var(--brand); font-size: 12px; font-weight: 700; text-decoration: none; }
    .ud-link:hover { color: var(--brand-dark); }

    /* ---------- QUICK ACTION ---------- */
    .ud-quick {
        display: flex; gap: 14px; height: 100%;
        background: #fff; border: 1px solid var(--line); border-radius: 17px;
        padding: 18px;
        text-decoration: none;
        transition: .2s ease;
    }
    .ud-quick:hover { border-color: #bfe0f1; box-shadow: 0 10px 22px rgba(48, 103, 135, .08); transform: translateY(-2px); }
    .ud-quick-icon {
        flex-shrink: 0; width: 46px; height: 46px; border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        background: var(--brand-soft); color: #2587c8; font-size: 20px;
        transition: .2s ease;
    }
    .ud-quick:hover .ud-quick-icon { background: var(--brand); color: #fff; }
    .ud-quick-title { color: var(--ink); font-size: 14px; font-weight: 700; margin-bottom: 4px; }
    .ud-quick-text  { color: var(--muted); font-size: 12px; line-height: 1.55; margin: 0 0 8px; }
    .ud-quick-cta   { color: var(--brand); font-size: 12px; font-weight: 700; }
    .ud-quick-cta i { transition: .2s ease; display: inline-block; }
    .ud-quick:hover .ud-quick-cta i { transform: translateX(4px); }

    /* ---------- TABLE ---------- */
    .ud-table { width: 100%; border-collapse: collapse; }
    .ud-table th { padding: 11px 20px; font-size: 10px; font-weight: 700; letter-spacing: .6px; text-transform: uppercase; color: #9aabb6; background: #f8fbfd; text-align: left; }
    .ud-table td { padding: 13px 20px; font-size: 13px; color: #405a69; border-top: 1px solid #f0f4f7; }
    .ud-table tr:hover td { background: #fafdff; }
    .ud-badge {
        display: inline-block; padding: 4px 10px; border-radius: 50px;
        font-size: 11px; font-weight: 700;
        background: var(--t-soft); color: var(--t);
    }

    .ud-empty { text-align: center; padding: 38px 20px; }
    .ud-empty i { font-size: 34px; color: #b8d6e6; }
    .ud-empty h4 { font-size: 14px; font-weight: 700; color: var(--ink); margin: 10px 0 4px; }
    .ud-empty p  { font-size: 12px; color: var(--muted); margin-bottom: 14px; }
    .ud-empty .ud-btn { background: var(--brand); color: #fff; }
    .ud-empty .ud-btn:hover { background: var(--brand-dark); color: #fff; }

    /* ---------- TIMELINE ---------- */
    .ud-steps { padding: 22px 20px 6px; }
    .ud-step { position: relative; display: flex; gap: 14px; padding-bottom: 22px; }
    .ud-step:not(:last-child)::before {
        content: ""; position: absolute; left: 19px; top: 42px; bottom: 2px;
        border-left: 2px dashed #cfe5f1;
    }
    .ud-step-icon {
        position: relative; z-index: 1; flex-shrink: 0;
        width: 40px; height: 40px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        background: var(--brand-soft); color: #2587c8; font-size: 16px;
        border: 3px solid #fff; box-shadow: 0 0 0 1px #cfe5f1;
    }
    .ud-step small { display: block; font-size: 10px; font-weight: 800; letter-spacing: .6px; color: #9fc3d8; }
    .ud-step-title { color: var(--ink); font-size: 13px; font-weight: 700; }
    .ud-step-text  { color: var(--muted); font-size: 11px; line-height: 1.55; margin: 2px 0 0; }

    @media (max-width: 767px) {
        .ud-hero { padding: 26px 22px; }
        .ud-hero h2 { font-size: 22px; }
        .ud-date-box { display: none; }
        .ud-table th:nth-child(3), .ud-table td:nth-child(3) { display: none; }
    }
</style>

<div class="ud">

    {{-- ================= HERO ================= --}}
    <div class="ud-hero">
        <div class="ud-hero-inner">
            <div>
                <div class="ud-chip"><i class="bi bi-stars"></i> E-URS Procurement Portal</div>
                <h2>{{ $greeting }}, {{ Auth::user()->name }}</h2>
                <p>
                    Create and manage your Electronic User Requirement Specification
                    requests through the Taisho procurement workflow.
                </p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('user.eurs.create') }}" class="ud-btn ud-btn-light">
                        <i class="bi bi-plus-circle"></i> Create New E-URS
                    </a>
                    <a href="{{ route('user.eurs.index') }}" class="ud-btn ud-btn-ghost">
                        <i class="bi bi-folder2-open"></i> View My Requests
                    </a>
                </div>
            </div>

            <div class="ud-date-box">
                <div class="day">{{ now()->format('d') }}</div>
                <div class="rest">{{ now()->translatedFormat('F Y') }}<br>{{ now()->translatedFormat('l') }}</div>
            </div>
        </div>
    </div>


    {{-- ================= STATISTICS ================= --}}
    <div class="row g-3 mb-4">
        @foreach($cards as $c)
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="ud-stat ud-tone-{{ $c['tone'] }}">
                    <div class="ud-stat-icon"><i class="bi {{ $c['icon'] }}"></i></div>
                    <div class="ud-stat-label">{{ $c['label'] }}</div>
                    <div class="ud-stat-value">{{ $stats[$c['key']] }}</div>
                    <div class="ud-stat-desc">{{ $c['desc'] }}</div>
                    <div class="ud-bar">
                        <span style="width: {{ $c['key'] === 'total' ? ($stats['total'] > 0 ? 100 : 0) : $percent($stats[$c['key']]) }}%"></span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    {{-- ================= MAIN ================= --}}
    <div class="row g-4">

        {{-- LEFT --}}
        <div class="col-12 col-lg-8 d-flex flex-column gap-4">

            {{-- Quick actions --}}
            <div>
                <h3 class="ud-card-title mb-3">Quick Actions</h3>
                <div class="row g-3">
                    @foreach($actions as $a)
                        <div class="col-12 col-md-6">
                            <a href="{{ $a['link'] }}" class="ud-quick">
                                <div class="ud-quick-icon"><i class="bi {{ $a['icon'] }}"></i></div>
                                <div>
                                    <div class="ud-quick-title">{{ $a['title'] }}</div>
                                    <p class="ud-quick-text">{{ $a['text'] }}</p>
                                    <span class="ud-quick-cta">{{ $a['cta'] }} <i class="bi bi-arrow-right ms-1"></i></span>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Recent requests --}}
            <div class="ud-card">
                <div class="ud-card-head">
                    <h3 class="ud-card-title">Recent Requests</h3>
                    <a href="{{ route('user.eurs.index') }}" class="ud-link">View all</a>
                </div>

                @if($recentRequests->isNotEmpty())
                    <table class="ud-table">
                        <thead>
                            <tr>
                                <th>Request No.</th>
                                <th>Item / Service</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentRequests as $r)
                                @php
                                    [$statusLabel, $statusTone] = $resolveStatus($r);
                                @endphp
                                <tr>
                                    <td><strong>{{ $r->request_number ?? '-' }}</strong></td>
                                    <td>{{ $r->item_service_name ?? $r->requirement ?? '-' }}</td>
                                    <td>{{ optional($r->created_at)->format('d M Y') }}</td>
                                    <td><span class="ud-badge ud-tone-{{ $statusTone }}">{{ $statusLabel }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="ud-empty">
                        <i class="bi bi-inbox"></i>
                        <h4>No requests yet</h4>
                        <p>Your submitted E-URS requests will appear here.</p>
                        <a href="{{ route('user.eurs.create') }}" class="ud-btn">
                            <i class="bi bi-plus-circle"></i> Create your first E-URS
                        </a>
                    </div>
                @endif
            </div>
        </div>


        {{-- RIGHT: PROCESS --}}
        <div class="col-12 col-lg-4">
            <div class="ud-card">
                <div class="ud-card-head">
                    <h3 class="ud-card-title">E-URS Process</h3>
                    <i class="bi bi-diagram-3 text-muted"></i>
                </div>

                <div class="ud-steps">
                    @foreach($steps as $i => $s)
                        <div class="ud-step">
                            <div class="ud-step-icon"><i class="bi {{ $s[2] }}"></i></div>
                            <div>
                                <small>STEP {{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</small>
                                <div class="ud-step-title">{{ $s[0] }}</div>
                                <p class="ud-step-text">{{ $s[1] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>

@endsection