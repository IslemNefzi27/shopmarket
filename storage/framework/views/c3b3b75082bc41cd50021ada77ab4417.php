<?php $__env->startSection('title', 'Ma liste de souhaits'); ?>
<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-8">
        <i class="fas fa-heart text-red-500 mr-2"></i> Ma liste de souhaits
    </h1>

    <?php if($products->isEmpty()): ?>
        <div class="text-center py-20 bg-white rounded-2xl shadow-sm">
            <i class="fas fa-heart-broken text-6xl text-gray-200 mb-6"></i>
            <h3 class="text-xl font-semibold text-gray-500 mb-2">Votre liste de souhaits est vide</h3>
            <p class="text-gray-400 mb-6">Ajoutez des produits que vous aimez pour les retrouver facilement.</p>
            <a href="<?php echo e(route('products.index')); ?>"
                class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">
                Explorer le catalogue
            </a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-xl shadow-sm overflow-hidden group">
                    <div class="relative h-48 bg-gray-100 overflow-hidden">
                        <?php if($product->image): ?>
                            <img src="<?php echo e(asset('storage/' . $product->image)); ?>"
                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                alt="<?php echo e($product->title); ?>">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <i class="fas fa-image text-5xl"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="p-4">
                        <span class="text-xs text-indigo-500 font-medium"><?php echo e($product->category->name); ?></span>
                        <h3 class="font-semibold text-gray-800 mt-1 mb-2">
                            <a href="<?php echo e(route('products.show', $product)); ?>" class="hover:text-indigo-600">
                                <?php echo e($product->title); ?>

                            </a>
                        </h3>
                        <div class="flex items-center justify-between">
                            <span class="text-xl font-bold text-indigo-600">
                                <?php echo e(number_format($product->price, 2, ',', ' ')); ?> TND
                            </span>
                            <div class="flex gap-2">
                                <?php if(auth()->guard()->check()): ?>
                                    <form action="<?php echo e(route('cart.add', $product)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit"
                                            class="text-xs bg-indigo-600 text-white px-3 py-1.5 rounded-lg hover:bg-indigo-700 transition">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                    </form>
                                    <form action="<?php echo e(route('wishlist.remove', $product)); ?>" method="POST">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit"
                                            class="text-xs bg-red-100 text-red-500 px-3 py-1.5 rounded-lg hover:bg-red-200 transition">
                                            <i class="fas fa-heart-broken"></i>
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="mt-6"><?php echo e($products->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\shopmarket\resources\views/products/wishlist.blade.php ENDPATH**/ ?>