<header class="bg-white shadow-sm px-4 py-3 d-flex justify-content-between align-items-center sticky-top">
    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-outline-secondary btn-sm d-lg-none" id="toggleSidebar">
            <i class="bi bi-list fs-5"></i>
        </button>
        <h5 class="mb-0 fw-bold text-dark">@yield('page-title', 'Dashboard')</h5>
    </div>

    <div class="d-flex align-items-center gap-2">
        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-3 py-2">
            <i class="bi bi-shield-lock-fill me-1"></i> {{ Auth::user()->nama }}
        </span>
    </div>
</header>