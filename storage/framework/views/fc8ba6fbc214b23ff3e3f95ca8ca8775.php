<?php $__env->startSection('title', 'Mes produits'); ?>
<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-2xl font-bold text-gray-900">
            <i class="fas fa-box text-indigo-600 mr-2"></i> Mes Produits
        </h1>
        <a href="<?php echo e(route('products.create')); ?>"
            class="inline-flex items-center gap-2 bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
            <i class="fas fa-plus"></i> Ajouter un produit
        </a>
    </div>

    <?php if($products->isEmpty()): ?>
        <div class="text-center py-20 bg-white rounded-2xl shadow-sm">
            <i class="fas fa-box-open text-6xl text-gray-200 mb-6"></i>
            <h3 class="text-xl font-semibold text-gray-500 mb-2">Vous n'avez pas encore de produits</h3>
            <p class="text-gray-400 mb-6">Commencez à vendre en ajoutant votre premier produit.</p>
            <a href="<?php echo e(route('products.create')); ?>"
                class="bg-indigo-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">
                <i class="fas fa-plus mr-1"></i> Ajouter un produit
            </a>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-6 py-3">Produit</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-4 py-3">Catégorie</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-4 py-3">Prix</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-4 py-3">Stock</th>
                        <th class="text-left text-xs font-semibold text-gray-500 uppercase tracking-wide px-4 py-3">Statut</th>
                        <th class="text-right text-xs font-semibold text-gray-500 uppercase tracking-wide px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden flex-shrink-0">
                                        <?php if($product->image): ?>
                                            <img src="<?php echo e(asset('storage/' . $product->image)); ?>"
                                                class="w-full h-full object-cover" alt="<?php echo e($product->title); ?>">
                                        <?php else: ?>
                                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                                <i class="fas fa-image"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <a href="<?php echo e(route('products.show', $product)); ?>"
                                            class="font-semibold text-gray-800 hover:text-indigo-600 text-sm block">
                                            <?php echo e(Str::limit($product->title, 40)); ?>

                                        </a>
                                        <p class="text-xs text-gray-400"><?php echo e($product->created_at->format('d/m/Y')); ?></p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 text-sm text-gray-600"><?php echo e($product->category->name); ?></td>
                            <td class="px-4 py-4 text-sm font-bold text-indigo-600">
                                <?php echo e(number_format($product->price, 2, ',', ' ')); ?> TND
                            </td>
                            <td class="px-4 py-4 text-sm <?php echo e($product->stock === 0 ? 'text-red-500 font-semibold' : 'text-gray-600'); ?>">
                                <?php echo e($product->stock); ?>

                            </td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    <?php echo e($product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600'); ?>">
                                    <?php echo e($product->is_active ? 'Actif' : 'Inactif'); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="<?php echo e(route('products.edit', $product)); ?>"
                                        class="text-blue-500 hover:text-blue-700 text-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('products.destroy', $product)); ?>" method="POST"
                                        onsubmit="return confirm('Supprimer ce produit définitivement ?')">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-400 hover:text-red-600 text-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4"><?php echo e($products->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\shopmarket\resources\views/products/my-products.blade.php ENDPATH**/ ?>