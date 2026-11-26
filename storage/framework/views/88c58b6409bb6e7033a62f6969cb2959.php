<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3roubi Zone - <?php echo $__env->yieldContent('title'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { background-color: #fff9f5; color: #333; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; transition: background-color 0.3s, color 0.3s; }

        /* ───── EL SIDEBAR ───── */
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #ffffff;
            border-right: 1px solid #e5e7eb;
            padding-top: 20px;
            z-index: 1000;
            box-shadow: 2px 0 10px rgba(0,0,0,0.05);
            overflow-y: auto;
        }
        .sidebar .brand {
            display: flex;
            align-items: center;
            justify-content: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 20px;
            text-decoration: none;
        }
        .sidebar .nav-link {
            color: #4b5563;
            padding: 12px 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: 0.3s;
            border-radius: 0 10px 10px 0;
            margin-right: 15px;
        }
        .sidebar .nav-link:hover {
            background-color: #fff1f2;
            color: #dc2626;
        }
        .sidebar .nav-link.active {
            background-color: #dc2626;
            color: white;
            box-shadow: 0 4px 15px rgba(220, 38, 38, 0.3);
        }
        .sidebar .nav-link i { margin-right: 15px; font-size: 1.2rem; }
        .sidebar .nav-section {
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #9ca3af;
            padding: 15px 20px 5px;
        }

        /* ───── EL MAIN CONTENT ───── */
        .main-content {
            margin-left: 250px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ───── EL NAVBAR (fo9) ───── */
        .top-navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            padding: 10px 20px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* ───── BOUTONS A7MAR ───── */
        .btn-danger {
            background-color: #dc2626 !important; border-color: #dc2626 !important; color: white !important; font-weight: bold; border-radius: 10px; box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4); transition: all 0.3s ease;
        }
        .btn-danger:hover { background-color: #b91c1c !important; border-color: #b91c1c !important; box-shadow: 0 6px 20px rgba(220, 38, 38, 0.6); transform: translateY(-2px); }

        .btn-outline-danger { color: #dc2626 !important; border-color: #dc2626 !important; }
        .btn-outline-danger:hover { background-color: #dc2626 !important; color: white !important; }

        /* ───── DROPDOWN LANGUE ───── */
        .dropdown-item.active, .dropdown-item:active { background-color: #dc2626 !important; color: #fff !important; }

        /* ───── DARK MODE ───── */
        body.dark-mode { background-color: #121212; color: #e0e0e0; }
        body.dark-mode .sidebar { background-color: #1e1e1e; border-right: 1px solid #333; }
        body.dark-mode .sidebar .brand { border-bottom: 1px solid #333; }
        body.dark-mode .sidebar .nav-link { color: #b0b0b0; }
        body.dark-mode .sidebar .nav-link:hover { background-color: #2a2a2a; color: #dc2626; }
        body.dark-mode .sidebar .nav-link.active { color: white; }
        body.dark-mode .top-navbar { background-color: #1e1e1e; border-bottom: 1px solid #333; }
        body.dark-mode .card, body.dark-mode .bg-white { background-color: #1e1e1e !important; color: #e0e0e0 !important; border: 1px solid #333 !important; }
        body.dark-mode .text-dark { color: #fff !important; }
        body.dark-mode .text-muted { color: #9e9e9e !important; }
        body.dark-mode .navbar-toggler-icon { filter: invert(1); }
        body.dark-mode .dropdown-menu { background-color: #1e1e1e; border: 1px solid #333; }
        body.dark-mode .dropdown-item { color: #e0e0e0; }
        body.dark-mode .dropdown-item:hover { background-color: #2a2a2a; }

        /* El Footer */
        footer { background-color: #431407; color: #fff; padding: 20px 0; text-align: center; margin-top: auto; }
    </style>
</head>
<body>

<!-- ═══════════ EL SIDEBAR ═══════════ -->
<div class="sidebar">
    <a href="<?php echo e(route('home')); ?>" class="brand">
        <img src="https://i.pinimg.com/736x/ae/2d/db/ae2ddb41289492c17f9851b0833588f7.jpg" alt="Logo" style="height: 40px; width: 40px; border-radius: 50%; margin-right: 10px;">
        <span class="fw-bold text-dark fs-4">3roubi Zone</span>
    </a>
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">
                <i class="bi bi-house-door"></i> <?php echo e(__('Accueil')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(request()->routeIs('shop') ? 'active' : ''); ?>" href="<?php echo e(route('shop')); ?>">
                <i class="bi bi-shop"></i> <?php echo e(__('Boutique')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(request()->routeIs('promotions') ? 'active' : ''); ?>" href="<?php echo e(route('promotions')); ?>">
                <i class="bi bi-tags"></i> <?php echo e(__('Promotions')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(request()->routeIs('histoire') ? 'active' : ''); ?>" href="<?php echo e(route('histoire')); ?>">
                <i class="bi bi-book"></i> <?php echo e(__('Notre Histoire')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(request()->routeIs('about') ? 'active' : ''); ?>" href="<?php echo e(route('about')); ?>">
                <i class="bi bi-info-circle"></i> <?php echo e(__('À Propos')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(request()->routeIs('contact') ? 'active' : ''); ?>" href="<?php echo e(route('contact')); ?>">
                <i class="bi bi-envelope"></i> <?php echo e(__('Contact')); ?>

            </a>
        </li>

        <?php if(auth()->guard()->check()): ?>
        <li class="nav-item">
            <a class="nav-link <?php echo e(request()->routeIs('profile.edit') ? 'active' : ''); ?>" href="<?php echo e(route('profile.edit')); ?>">
                <i class="bi bi-person"></i> <?php echo e(__('Mon Profil')); ?>

            </a>
        </li>

        <?php if(Auth::user()->role === 'admin'): ?>
        <li class="nav-section">Admin</li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(request()->routeIs('admin.produits.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.produits.index')); ?>">
                <i class="bi bi-box-seam"></i> <?php echo e(__('Gérer Produits')); ?>

            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo e(request()->routeIs('admin.orders.*') ? 'active' : ''); ?>" href="<?php echo e(route('admin.orders.index')); ?>">
                <i class="bi bi-receipt"></i> <?php echo e(__('Commandes')); ?>

            </a>
        </li>
        <?php endif; ?>
        <?php endif; ?>
    </ul>
</div>

<!-- ═══════════ EL MAIN CONTENT ═══════════ -->
<div class="main-content">

    <!-- El Navbar (fo9) -->
    <div class="top-navbar">

        <div class="dropdown">
            <button class="btn btn-outline-danger btn-sm dropdown-toggle d-flex align-items-center gap-1"
                    type="button" data-bs-toggle="dropdown"
                    style="height: 38px; padding: 0 12px; border-radius: 10px;">
                🌐 <?php echo e(strtoupper(app()->getLocale())); ?>

            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item <?php echo e(app()->getLocale() == 'fr' ? 'active' : ''); ?>"
                       href="<?php echo e(route('lang.switch', 'fr')); ?>">🇫🇷 Français</a>
                </li>
                <li>
                    <a class="dropdown-item <?php echo e(app()->getLocale() == 'en' ? 'active' : ''); ?>"
                       href="<?php echo e(route('lang.switch', 'en')); ?>">🇬🇧 English</a>
                </li>
            </ul>
        </div>

        <button class="btn btn-danger btn-sm" id="theme-toggle" title="<?php echo e(__('Changer le thème')); ?>" style="height: 38px; padding: 0 15px;">🌙/☀️</button>

        <a href="<?php echo e(route('cart.index')); ?>" class="btn btn-danger btn-sm position-relative d-flex align-items-center" style="height: 38px; padding: 0 15px;">
            🛒
            <?php if(app(\App\Services\Cart::class)->count() > 0): ?>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-white text-danger border" style="font-size: 0.6rem;">
                    <?php echo e(app(\App\Services\Cart::class)->count()); ?>

                </span>
            <?php endif; ?>
        </a>

        <?php if(auth()->guard()->check()): ?>
            <?php if(Auth::user()->role === 'admin'): ?>
                <a href="<?php echo e(route('admin.produits.index')); ?>" class="btn btn-danger btn-sm fw-bold d-flex align-items-center" style="height: 38px; padding: 0 15px;"><?php echo e(__('Produits')); ?></a>
                <a href="<?php echo e(route('admin.orders.index')); ?>" class="btn btn-danger btn-sm fw-bold d-flex align-items-center" style="height: 38px; padding: 0 15px;"><?php echo e(__('Commandes')); ?></a>
            <?php endif; ?>

            <?php
                $unreadMessages = \App\Models\Message::where('receiver_id', Auth::id())->where('is_read', false)->count();
            ?>

            <?php if(Auth::user()->role === 'admin'): ?>
                <a href="<?php echo e(url('admin/chat')); ?>" class="btn btn-danger btn-sm position-relative d-flex align-items-center" style="height: 38px; padding: 0 15px;">
                    💬 <?php echo e(__('Messages')); ?>

                    <?php if($unreadMessages > 0): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-white text-danger border" style="font-size: 0.6rem;"><?php echo e($unreadMessages); ?></span>
                    <?php endif; ?>
                </a>
            <?php else: ?>
                <a href="<?php echo e(url('chat')); ?>" class="btn btn-danger btn-sm position-relative d-flex align-items-center" style="height: 38px; padding: 0 15px;">
                    💬 <?php echo e(__('Chat')); ?>

                    <?php if($unreadMessages > 0): ?>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-white text-danger border" style="font-size: 0.6rem;"><?php echo e($unreadMessages); ?></span>
                    <?php endif; ?>
                </a>
            <?php endif; ?>

            <a href="<?php echo e(route('wishlist.index')); ?>" class="btn btn-danger btn-sm d-flex align-items-center" style="height: 38px; padding: 0 15px;">❤️ <?php echo e(__('Favoris')); ?></a>
            <a href="<?php echo e(route('orders.my')); ?>" class="btn btn-danger btn-sm d-flex align-items-center" style="height: 38px; padding: 0 15px;"><?php echo e(__('Mes Commandes')); ?></a>

            <form method="POST" action="<?php echo e(route('logout')); ?>" class="d-inline">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center" style="height: 38px; padding: 0 15px;"><?php echo e(__('Déconnexion')); ?></button>
            </form>
        <?php else: ?>
            <a href="<?php echo e(route('login')); ?>" class="btn btn-danger btn-sm d-flex align-items-center" style="height: 38px; padding: 0 15px;"><?php echo e(__('Connexion')); ?></a>
            <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-danger btn-sm d-flex align-items-center" style="height: 38px; padding: 0 15px;"><?php echo e(__('S\'inscrire')); ?></a>
        <?php endif; ?>
    </div>

    <!-- El Contenu mte3 les pages -->
    <main class="container py-4 flex-grow-1">
        <?php if(session('success')): ?>
            <div class="alert alert-success" style="background-color: #e6ffed; color: #1e7e34; border-color: #c3e6cb;"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Footer -->
    <footer>
        © <?php echo e(date('Y')); ?> 3roubi Zone — نكهات تونس الأصيلة في كل بيت
    </footer>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;

    const userPrefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    const storedTheme = localStorage.getItem('theme');

    if (storedTheme === 'dark' || (!storedTheme && userPrefersDark)) {
        body.classList.add('dark-mode');
    }

    themeToggle.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        localStorage.setItem('theme', body.classList.contains('dark-mode') ? 'dark' : 'light');
    });
</script>
</body>
</html><?php /**PATH C:\Users\thinkpad\3roubi-zone\resources\views/layouts/app.blade.php ENDPATH**/ ?>