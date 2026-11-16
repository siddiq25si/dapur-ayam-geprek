<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
    body {
        background-color: #f4f6f9;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .sidebar-admin {
        width: 260px;
        min-height: 100vh;
        background: linear-gradient(180deg, #1f2937 0%, #111827 100%);
        color: #f9fafb;
        position: fixed;
        top: 0;
        left: 0;
        z-index: 1030;
        transition: all 0.3s ease;
    }
    .sidebar-admin .nav-link {
        color: #d1d5db;
        border-radius: 0.5rem;
        padding: 0.65rem 1rem;
        margin-bottom: 0.25rem;
        display: flex;
        align-items: center;
        gap: 0.65rem;
        font-weight: 500;
        transition: all 0.2s;
    }
    .sidebar-admin .nav-link:hover {
        background-color: rgba(255, 255, 255, 0.08);
        color: #fff;
    }
    .sidebar-admin .nav-link.active {
        background-color: #dc2626;
        color: #fff;
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.35);
    }
    .main-wrapper {
        margin-left: 260px;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
    }
    @media (max-width: 991.98px) {
        .sidebar-admin {
            left: -260px;
        }
        .sidebar-admin.show {
            left: 0;
        }
        .main-wrapper {
            margin-left: 0;
        }
    }
</style>