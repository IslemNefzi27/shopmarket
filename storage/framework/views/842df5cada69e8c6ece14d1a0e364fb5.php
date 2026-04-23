<?php $__env->startSection('title', 'Passer la commande'); ?>
<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-8">
        <i class="fas fa-credit-card text-indigo-600 mr-2"></i> Finaliser la commande
    </h1>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        
        <div>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Informations de livraison</h2>
                <form action="<?php echo e(route('orders.store')); ?>" method="POST" class="space-y-4" id="checkoutForm">
                    <?php echo csrf_field(); ?>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Adresse de livraison *</label>
                        <textarea name="shipping_address" rows="3" required
                            placeholder="Numéro, rue, ville, code postal, pays..."
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-indigo-500 resize-none <?php $__errorArgs = ['shipping_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('shipping_address', auth()->user()->address)); ?></textarea>
                        <?php $__errorArgs = ['shipping_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Notes (facultatif)</label>
                        <textarea name="notes" rows="2"
                            placeholder="Instructions spéciales de livraison..."
                            class="w-full border border-gray-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:border-indigo-500 resize-none"><?php echo e(old('notes')); ?></textarea>
                    </div>

                    <div class="bg-indigo-50 rounded-lg p-3 text-xs text-indigo-700">
                        <i class="fas fa-info-circle mr-1"></i>
                        En passant votre commande, vous acceptez nos conditions générales de vente.
                    </div>
                </form>
            </div>
        </div>

        
        <div>
            <div class="bg-white rounded-xl shadow-sm p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-4">Récapitulatif</h2>

                <div class="space-y-3 mb-4 max-h-64 overflow-y-auto">
                    <?php $__currentLoopData = $cartItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center gap-3 py-2 border-b border-gray-50">
                            <div class="w-10 h-10 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                <?php if($item->product->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $item->product->image)); ?>"
                                        class="w-full h-full object-cover" alt="">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center text-gray-300 text-xs">
                                        <i class="fas fa-image"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-800 truncate"><?php echo e($item->product->title); ?></p>
                                <p class="text-xs text-gray-400">Qté : <?php echo e($item->quantity); ?></p>
                            </div>
                            <span class="text-sm font-semibold text-gray-800">
                                <?php echo e(number_format($item->subtotal, 2, ',', ' ')); ?> TND
                            </span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="border-t pt-4 space-y-2 text-sm">
                    <div class="flex justify-between text-gray-500">
                        <span>Sous-total</span>
                        <span><?php echo e(number_format($total, 2, ',', ' ')); ?> TND</span>
                    </div>
                    <div class="flex justify-between text-gray-500">
                        <span>Livraison</span>
                        <span class="text-green-600">Gratuite</span>
                    </div>
                    <div class="flex justify-between text-gray-900 font-bold text-lg border-t pt-2">
                        <span>Total</span>
                        <span class="text-indigo-600"><?php echo e(number_format($total, 2, ',', ' ')); ?> TND</span>
                    </div>
                </div>

                <button type="submit" form="checkoutForm"
                    class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold hover:bg-indigo-700 transition mt-6 flex items-center justify-center gap-2">
                    <i class="fas fa-lock"></i> Confirmer la commande
                </button>

                <a href="<?php echo e(route('cart.index')); ?>"
                    class="block text-center text-sm text-gray-400 hover:text-gray-600 mt-3">
                    <i class="fas fa-arrow-left"></i> Retour au panier
                </a>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\shopmarket\resources\views/orders/checkout.blade.php ENDPATH**/ ?>