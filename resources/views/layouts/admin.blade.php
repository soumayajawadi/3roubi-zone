<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - 3roubi Zone</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        
        /* El Sidebar */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #1e1e2d; /* K7al 8ame9 */
            color: #b0b0b0;
            padding-top: 20px;
            z-index: 1000;
            transition: all 0.3s;
        }
        .sidebar .brand {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #2a2a3b;
            margin-bottom: 20px;
            display: block;
            text-decoration: none;
        }
        .sidebar .brand:hover { color: #dc2626; }
        .sidebar .nav-link {
            color: #b0b0b0;
            padding: 12px 20px;
            font-weight: 500;
            transition: all 0.2s;
            display: flex;
            align-items: center;
        }
        .sidebar .nav-link:hover {
            background-color: #2a2a3b;
            color: white;
            border-left: 4px solid #dc2626;
        }
        .sidebar .nav-link.active {
            background-color: #dc2626;
            color: white;
            border-radius: 0 10px 10px 0;
            margin-right: 10px;
        }
        .sidebar .nav-link i { margin-right: 15px; font-size: 1.1rem; }

        /* El Contenu */
        .main-content {
            margin-left: 250px;
            padding: 30px;
            background-color: #f4f7f6;
            min-height: 100vh;
        }

        /* El Cartes mte3 les stats */
        .stat-card {
            border-radius: 15px;
            border: none;
            padding: 20px;
            color: white;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        .stat-card.red { background: linear-gradient(135deg, #dc2626, #991b1b); }
        .stat-card.blue { background: linear-gradient(135deg, #2563eb, #1e40af); }
        .stat-card.orange { background: linear-gradient(135deg, #f59e0b, #b45309); }
        .stat-card.green { background: linear-gradient(135deg, #10b981, #047857); }
        
        /* El Tableaux w les box */
        .content-card {
            background: white;
            border-radius: 15px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.02);
            padding: 20px;
            margin-bottom: 20px;
        }
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

<!-- El Sidebar -->
<div class="sidebar">
    <a href="{{ route('admin.dashboard') }}" class="brand">
        <img src="https://i.pinimg.com/736x/ae/2d/db/ae2ddb41289492c17f9851b0833588f7.jpg" alt="Logo" style="height: 30px; border-radius: 50%; margin-right: 5px;">
        3roubi Zone
    </a>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.orders.index') ? 'active' : '' }}" href="{{ route('admin.orders.index') }}">
                <i class="bi bi-box-seam"></i> Commandes
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.produits.index') ? 'active' : '' }}" href="{{ route('admin.produits.index') }}">
                <i class="bi bi-tags"></i> Produits
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                <i class="bi bi-grid"></i> Catégories
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.chat') ? 'active' : '' }}" href="{{ url('admin/chat') }}">
                <i class="bi bi-chat-dots"></i> Messages
            </a>
        </li>
        <li class="nav-item mt-3">
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="nav-link border-0 bg-transparent">
                    <i class="bi bi-box-arrow-right"></i> Déconnexion
                </button>
            </form>
        </li>
    </ul>
</div>

<!-- El Contenu -->
<div class="main-content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>