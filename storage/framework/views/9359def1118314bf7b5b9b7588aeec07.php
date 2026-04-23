<?php $__env->startSection('title', 'Modifier mon profil'); ?>
<?php $__env->startSection('content'); ?>
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="mb-6">
        <a href="<?php echo e(route('profile.show')); ?>" class="text-sm text-indigo-600 hover:underline">
            <i class="fas fa-arrow-left"></i> Mon profil
        </a>
        <h1 class="text-2xl font-bold text-gray-900 mt-2">Modifier mon profil</h1>
    </div>

    <div class="bg-white rounded-2xl shadow-sm p-6">
        <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data" class="space-y-5">
            <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

            
            <div class="flex items-center gap-4 pb-5 border-b">
                <div class="w-16 h-16 rounded-full bg-indigo-100 overflow-hidden flex items-center justify-center text-2xl font-bold text-indigo-600">
                    <?php if($user->avatar): ?>
                        <img src="<?php echo e(asset('storage/' . $user->avatar)); ?>" class="w-full h-full object-cover" alt="<?php echo e($user->name); ?>">
                    <?php else: ?>
                        <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                    <?php endif; ?>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Photo de profil</label>
                    <input type="file" name="avatar" accept="image/*"
                        class="text-sm text-gray-500">
                    <p class="text-xs text-gray-400 mt-0.5">JPG, PNG — Max 1Mo</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nom complet *</label>
                    <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email *</label>
                    <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Téléphone</label>
                <input type="text" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>"
                    placeholder="+33 6 00 00 00 00"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Adresse de livraison</label>
                <textarea name="address" rows="2"
                    placeholder="Votre adresse complète..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 resize-none"><?php echo e(old('address', $user->address)); ?></textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1.5">Bio</label>
                <textarea name="bio" rows="3"
                    placeholder="Quelques mots sur vous..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 resize-none"><?php echo e(old('bio', $user->bio)); ?></textarea>
            </div>

            
            <div class="border-t pt-5">
                <h3 class="font-semibold text-gray-800 mb-4">Changer le mot de passe <span class="text-sm font-normal text-gray-400">(optionnel)</span></h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Mot de passe actuel</label>
                        <input type="password" name="current_password" placeholder="••••••••"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500 <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                        <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nouveau mot de passe</label>
                            <input type="password" name="password" placeholder="••••••••"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Confirmer</label>
                            <input type="password" name="password_confirmation" placeholder="••••••••"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-indigo-500">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="flex-1 bg-indigo-600 text-white py-3 rounded-xl font-semibold hover:bg-indigo-700 transition">
                    <i class="fas fa-save mr-1"></i> Enregistrer
                </button>
                <a href="<?php echo e(route('profile.show')); ?>"
                    class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl hover:bg-gray-50 transition">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\shopmarket\resources\views/profile/edit.blade.php ENDPATH**/ ?>