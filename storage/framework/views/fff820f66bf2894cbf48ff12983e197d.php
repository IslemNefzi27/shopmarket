<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'ShopMarket'); ?> — ShopMarket</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        [x-cloak] { display: none !important; }
        .star-filled { color: #f59e0b; }
        .star-empty  { color: #d1d5db; }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-gray-50 min-h-screen flex flex-col">


<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            
            <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-2 font-bold text-xl text-indigo-600">
                <i class="fas fa-store"></i> ShopMarket
            </a>

            
            <div class="hidden md:flex flex-1 max-w-md mx-8">
                <form action="<?php echo e(route('products.index')); ?>" method="GET" class="w-full relative">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                        placeholder="Rechercher un produit..."
                        class="w-full border border-gray-300 rounded-full px-4 py-2 pr-10 text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500">
                    <button type="submit" class="absolute right-3 top-2.5 text-gray-400 hover:text-indigo-600">
                        <i class="fas fa-search text-sm"></i>
                    </button>
                </form>
            </div>

            
            <div class="flex items-center gap-4">
                <?php if(auth()->guard()->check()): ?>
                    
                    <a href="<?php echo e(route('cart.index')); ?>" class="relative text-gray-600 hover:text-indigo-600">
                        <i class="fas fa-shopping-cart text-xl"></i>
                        <?php $cartCount = auth()->user()->cartItems()->sum('quantity') ?>
                        <?php if($cartCount > 0): ?>
                            <span class="absolute -top-2 -right-2 bg-indigo-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                <?php echo e($cartCount); ?>

                            </span>
                        <?php endif; ?>
                    </a>

                    
                    <a href="<?php echo e(route('wishlist.index')); ?>" class="text-gray-600 hover:text-indigo-600 hidden md:block">
                        <i class="fas fa-heart text-xl"></i>
                    </a>

                    
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 text-gray-700 hover:text-indigo-600 focus:outline-none">
                            <?php if(auth()->user()->avatar): ?>
                                <img src="<?php echo e(asset('storage/' . auth()->user()->avatar)); ?>" class="w-8 h-8 rounded-full object-cover" alt="avatar">
                            <?php else: ?>
                                <div class="w-8 h-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-semibold text-sm">
                                    <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                                </div>
                            <?php endif; ?>
                            <span class="hidden md:block text-sm font-medium"><?php echo e(auth()->user()->name); ?></span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        <div x-show="open" @click.away="open = false" x-cloak
                            class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-1 z-50">
                            <a href="<?php echo e(route('profile.show')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">
                                <i class="fas fa-user w-4"></i> Mon profil
                            </a>
                            <a href="<?php echo e(route('products.my')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">
                                <i class="fas fa-box w-4"></i> Mes produits
                            </a>
                            <a href="<?php echo e(route('orders.index')); ?>" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-indigo-50">
                                <i class="fas fa-receipt w-4"></i> Mes commandes
                            </a>
                            <hr class="my-1">
                            <form action="<?php echo e(route('logout')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 w-full text-left">
                                    <i class="fas fa-sign-out-alt w-4"></i> Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="text-gray-700 hover:text-indigo-600 text-sm font-medium">Connexion</a>
                    <a href="<?php echo e(route('register')); ?>"
                        class="bg-indigo-600 text-white px-4 py-2 rounded-full text-sm font-medium hover:bg-indigo-700 transition">
                        Inscription
                    </a>
                <?php endif; ?>
            </div>
        </div>

        
        <div class="md:hidden pb-3">
            <form action="<?php echo e(route('products.index')); ?>" method="GET">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                    placeholder="Rechercher..."
                    class="w-full border border-gray-300 rounded-full px-4 py-2 text-sm focus:outline-none focus:border-indigo-500">
            </form>
        </div>
    </div>
</nav>


<?php if(session('success')): ?>
    <div class="bg-green-50 border-l-4 border-green-500 text-green-800 px-4 py-3 mx-4 mt-4 rounded-lg flex items-center justify-between"
        x-data="{ show: true }" x-show="show">
        <div class="flex items-center gap-2">
            <i class="fas fa-check-circle text-green-500"></i>
            <?php echo e(session('success')); ?>

        </div>
        <button @click="show = false" class="text-green-600 hover:text-green-800"><i class="fas fa-times"></i></button>
    </div>
<?php endif; ?>
<?php if(session('error')): ?>
    <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-4 py-3 mx-4 mt-4 rounded-lg flex items-center justify-between"
        x-data="{ show: true }" x-show="show">
        <div class="flex items-center gap-2">
            <i class="fas fa-exclamation-circle text-red-500"></i>
            <?php echo e(session('error')); ?>

        </div>
        <button @click="show = false" class="text-red-600 hover:text-red-800"><i class="fas fa-times"></i></button>
    </div>
<?php endif; ?>
<?php if($errors->any()): ?>
    <div class="bg-red-50 border-l-4 border-red-500 text-red-800 px-4 py-3 mx-4 mt-4 rounded-lg">
        <div class="flex items-center gap-2 mb-1"><i class="fas fa-exclamation-triangle text-red-500"></i> <strong>Erreurs :</strong></div>
        <ul class="list-disc list-inside text-sm space-y-1">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>


<main class="flex-1">
    <?php echo $__env->yieldContent('content'); ?>
</main>


<footer class="bg-gray-900 text-gray-300 mt-16">
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="font-bold text-white text-lg mb-4">
                    <i class="fas fa-store text-indigo-400"></i> ShopMarket
                </h3>
                <p class="text-sm text-gray-400">La marketplace où tout le monde peut vendre et acheter en toute sécurité.</p>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-3">Navigation</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="<?php echo e(route('home')); ?>" class="hover:text-white">Accueil</a></li>
                    <li><a href="<?php echo e(route('products.index')); ?>" class="hover:text-white">Catalogue</a></li>
                    <?php if(auth()->guard()->check()): ?>
                        <li><a href="<?php echo e(route('products.create')); ?>" class="hover:text-white">Vendre</a></li>
                        <li><a href="<?php echo e(route('orders.index')); ?>" class="hover:text-white">Mes commandes</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-3">Mon compte</h4>
                <ul class="space-y-2 text-sm">
                    <?php if(auth()->guard()->check()): ?>
                        <li><a href="<?php echo e(route('profile.show')); ?>" class="hover:text-white">Profil</a></li>
                        <li><a href="<?php echo e(route('wishlist.index')); ?>" class="hover:text-white">Liste de souhaits</a></li>
                    <?php else: ?>
                        <li><a href="<?php echo e(route('login')); ?>" class="hover:text-white">Connexion</a></li>
                        <li><a href="<?php echo e(route('register')); ?>" class="hover:text-white">Inscription</a></li>
                    <?php endif; ?>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold text-white mb-3">Sécurité</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><i class="fas fa-shield-alt text-green-400 mr-1"></i> Paiements sécurisés</li>
                    <li><i class="fas fa-lock text-green-400 mr-1"></i> Données protégées (CSRF)</li>
                    <li><i class="fas fa-check-circle text-green-400 mr-1"></i> Vendeurs vérifiés</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-8 pt-6 text-center text-sm text-gray-500">
            &copy; <?php echo e(date('Y')); ?> ShopMarket — Projet Laravel DS2 — Programmation Web 2
        </div>
    </div>
</footer>

<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\wamp64\www\shopmarket\resources\views/layouts/app.blade.php ENDPATH**/ ?>