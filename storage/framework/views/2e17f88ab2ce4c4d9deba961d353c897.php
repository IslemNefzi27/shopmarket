<?php $__env->startSection('title', 'Catalogue'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Catalogue Produits</h1>
            <p class="text-gray-500 text-sm mt-1"><?php echo e($products->total()); ?> produit(s) trouvé(s)</p>
        </div>
        <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(route('products.create')); ?>"
                class="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                <i class="fas fa-plus"></i> Ajouter un produit
            </a>
        <?php endif; ?>
    </div>

    <div class="flex flex-col lg:flex-row gap-8">
        
        <aside class="lg:w-64 flex-shrink-0">
            <form action="<?php echo e(route('products.index')); ?>" method="GET" id="filterForm">
                <div class="bg-white rounded-xl shadow-sm p-5 space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Recherche</label>
                        <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                            placeholder="Mot-clé..."
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Catégorie</label>
                        <div class="space-y-2">
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <label class="flex items-center justify-between cursor-pointer">
                                    <div class="flex items-center gap-2">
                                        <input type="radio" name="category" value="<?php echo e($category->id); ?>"
                                            <?php echo e(request('category') == $category->id ? 'checked' : ''); ?>

                                            class="text-indigo-600" onchange="this.form.submit()">
                                        <span class="text-sm text-gray-700"><?php echo e($category->name); ?></span>
                                    </div>
                                </label>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 rounded-lg text-sm font-medium hover:bg-indigo-700 transition">
                        Appliquer
                    </button>
                </div>
            </form>
        </aside>

        
        <div class="flex-1">
            <?php if($products->isEmpty()): ?>
                <div class="text-center py-16 bg-white rounded-xl shadow-sm">
                    <i class="fas fa-box-open text-5xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-semibold text-gray-500">Aucun produit trouvé</h3>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow group">
                            <div class="relative overflow-hidden bg-gray-100 h-48">
                                <?php if($product->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>" alt="<?php echo e($product->title); ?>" class="w-full h-full object-cover">
                                <?php endif; ?>
                                
                                
                                <div class="absolute top-2 left-2">
                                    <span class="bg-white/90 text-indigo-600 text-xs px-2 py-1 rounded-full font-medium">
                                        <?php echo e($product->category->name ?? 'Général'); ?>

                                    </span>
                                </div>

                                
                                <?php if(auth()->guard()->check()): ?>
                                    <div class="absolute top-2 right-2">
                                        <form action="<?php echo e(route('wishlist.add', $product->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="bg-white p-2 rounded-full shadow-sm text-gray-400 hover:text-red-500 transition">
                                                <i class="fas fa-heart"></i>
                                            </button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 text-sm mb-1 line-clamp-2">
                                    <a href="<?php echo e(route('products.show', $product)); ?>" class="hover:text-indigo-600"><?php echo e($product->title); ?></a>
                                </h3>
                                <div class="flex items-center justify-between mt-3">
                                    <span class="text-xl font-bold text-indigo-600"><?php echo e(number_format($product->price, 2)); ?> TND</span>
                                </div>
                                <p class="text-xs text-gray-400 mt-2 mb-4">
                                    Par <span class="text-indigo-500"><?php echo e($product->user->name ?? 'Vendeur'); ?></span>
                                    · Stock : <?php echo e($product->stock); ?>

                                </p>

                                <?php if(auth()->guard()->check()): ?>
                                    <div class="space-y-2">
                                        <form action="<?php echo e(route('cart.add', $product->id)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" 
                                                class="w-full flex items-center justify-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition text-xs font-medium">
                                                <i class="fas fa-shopping-cart"></i> Ajouter au panier
                                            </button>
                                        </form>
                                    </div>
                                <?php else: ?>
                                    <a href="<?php echo e(route('login')); ?>" 
                                        class="block text-center w-full bg-gray-100 text-gray-600 px-4 py-2 rounded-lg text-xs font-medium">
                                        Connectez-vous pour acheter
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="mt-8"><?php echo e($products->links()); ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\shopmarket\resources\views/products/index.blade.php ENDPATH**/ ?>