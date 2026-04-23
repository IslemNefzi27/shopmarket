<?php $__env->startSection('title', 'Mes commandes'); ?>
<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-8">
        <i class="fas fa-receipt text-indigo-600 mr-2"></i> Mes Commandes
    </h1>

    <?php if($orders->isEmpty()): ?>
        <div class="text-center py-20 bg-white rounded-2xl shadow-sm">
            <i class="fas fa-receipt text-6xl text-gray-200 mb-6"></i>
            <h3 class="text-xl font-semibold text-gray-500 mb-2">Aucune commande</h3>
            <p class="text-gray-400 mb-6">Vous n'avez pas encore passé de commande.</p>
            <a href="<?php echo e(route('products.index')); ?>"
                class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">
                Découvrir les produits
            </a>
        </div>
    <?php else: ?>
        <div class="space-y-4">
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div>
                            <div class="flex items-center gap-3 mb-1">
                                <span class="font-bold text-gray-800">Commande #<?php echo e($order->id); ?></span>
                                <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold <?php echo e($order->status_badge['class']); ?>">
                                    <?php echo e($order->status_badge['label']); ?>

                                </span>
                            </div>
                            <p class="text-sm text-gray-400">
                                <?php echo e($order->created_at->format('d/m/Y à H:i')); ?>

                                · <?php echo e($order->items->count()); ?> article(s)
                            </p>
                        </div>

                        <div class="flex items-center gap-4">
                            <span class="text-xl font-bold text-indigo-600">
                                <?php echo e(number_format($order->total_amount, 2, ',', ' ')); ?> TND
                            </span>
                            <a href="<?php echo e(route('orders.show', $order)); ?>"
                                class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm hover:bg-gray-200 transition">
                                Voir le détail
                            </a>
                        </div>
                    </div>

                    
                    <div class="px-5 pb-4 flex gap-2 overflow-x-auto">
                        <?php $__currentLoopData = $order->items->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gray-100 overflow-hidden">
                                <?php if($item->product && $item->product->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $item->product->image)); ?>"
                                        class="w-full h-full object-cover" alt="">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <i class="fas fa-box text-sm"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php if($order->items->count() > 5): ?>
                            <div class="flex-shrink-0 w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center text-gray-400 text-xs font-semibold">
                                +<?php echo e($order->items->count() - 5); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-6"><?php echo e($orders->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\shopmarket\resources\views/orders/index.blade.php ENDPATH**/ ?>