<?php $__env->startSection('title', 'Commande #' . $order->id); ?>
<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Commande #<?php echo e($order->id); ?></h1>
            <p class="text-gray-400 text-sm mt-1">Passée le <?php echo e($order->created_at->format('d/m/Y à H:i')); ?></p>
        </div>
        <a href="<?php echo e(route('orders.index')); ?>" class="text-sm text-indigo-600 hover:underline">
            <i class="fas fa-arrow-left"></i> Mes commandes
        </a>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm p-5 mb-5">
        <div class="flex items-center justify-between mb-4">
            <h2 class="font-bold text-gray-800">Statut</h2>
            <span class="px-3 py-1 rounded-full text-sm font-semibold <?php echo e($order->status_badge['class']); ?>">
                <?php echo e($order->status_badge['label']); ?>

            </span>
        </div>

        <?php if($order->status === 'pending'): ?>
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 text-sm text-yellow-700 flex items-center gap-2">
                <i class="fas fa-clock"></i>
                <span>Votre commande est en attente de traitement.</span>
            </div>
            <form action="<?php echo e(route('orders.cancel', $order)); ?>" method="POST" class="mt-3"
                onsubmit="return confirm('Annuler cette commande ?')">
                <?php echo csrf_field(); ?>
                <button type="submit" class="text-sm text-red-500 hover:text-red-700 flex items-center gap-1">
                    <i class="fas fa-times-circle"></i> Annuler la commande
                </button>
            </form>
        <?php elseif($order->status === 'validated'): ?>
            <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-sm text-green-700 flex items-center gap-2">
                <i class="fas fa-check-circle"></i>
                <span>Votre commande a été validée et est en cours de préparation.</span>
            </div>
        <?php elseif($order->status === 'cancelled'): ?>
            <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-sm text-red-700 flex items-center gap-2">
                <i class="fas fa-times-circle"></i>
                <span>Cette commande a été annulée.</span>
            </div>
        <?php endif; ?>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm p-5 mb-5">
        <h2 class="font-bold text-gray-800 mb-4">Articles commandés</h2>
        <div class="space-y-4">
            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex items-center gap-4 pb-4 border-b border-gray-50 last:border-0 last:pb-0">
                    <div class="w-16 h-16 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                        <?php if($item->product && $item->product->image): ?>
                            <img src="<?php echo e(asset('storage/' . $item->product->image)); ?>"
                                class="w-full h-full object-cover" alt="<?php echo e($item->product->title); ?>">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                <i class="fas fa-box text-xl"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="flex-1">
                        <?php if($item->product): ?>
                            <a href="<?php echo e(route('products.show', $item->product)); ?>"
                                class="font-semibold text-gray-800 hover:text-indigo-600">
                                <?php echo e($item->product->title); ?>

                            </a>
                        <?php else: ?>
                            <span class="font-semibold text-gray-400 italic">Produit supprimé</span>
                        <?php endif; ?>
                        <p class="text-sm text-gray-400"><?php echo e(number_format($item->unit_price, 2, ',', ' ')); ?> TND × <?php echo e($item->quantity); ?></p>
                    </div>
                    <div class="font-bold text-gray-900">
                        <?php echo e(number_format($item->subtotal, 2, ',', ' ')); ?> TND
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="border-t pt-4 mt-4 space-y-2 text-sm">
            <div class="flex justify-between text-gray-500">
                <span>Livraison</span>
                <span class="text-green-600">Gratuite</span>
            </div>
            <div class="flex justify-between text-gray-900 font-bold text-lg">
                <span>Total</span>
                <span class="text-indigo-600"><?php echo e(number_format($order->total_amount, 2, ',', ' ')); ?> TND</span>
            </div>
        </div>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm p-5">
        <h2 class="font-bold text-gray-800 mb-3">Informations de livraison</h2>
        <div class="text-sm text-gray-600 space-y-2">
            <div>
                <span class="font-medium text-gray-700">Adresse :</span>
                <p class="mt-0.5 text-gray-500"><?php echo e($order->shipping_address); ?></p>
            </div>
            <?php if($order->notes): ?>
                <div>
                    <span class="font-medium text-gray-700">Notes :</span>
                    <p class="mt-0.5 text-gray-500"><?php echo e($order->notes); ?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\shopmarket\resources\views/orders/show.blade.php ENDPATH**/ ?>