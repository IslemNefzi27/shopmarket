<?php $__env->startSection('title', 'Inscription'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-indigo-50 to-purple-50 px-4 py-12">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="<?php echo e(route('home')); ?>" class="text-3xl font-bold text-indigo-600">
                <i class="fas fa-store"></i> ShopMarket
            </a>
            <h2 class="text-2xl font-bold text-gray-800 mt-4">Créer un compte</h2>
            <p class="text-gray-500 text-sm mt-1">Rejoignez notre marketplace</p>
        </div>

        <div class="bg-white rounded-2xl shadow-lg p-8">
            <form action="<?php echo e(route('register')); ?>" method="POST" class="space-y-5">
                <?php echo csrf_field(); ?>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nom complet</label>
                    <div class="relative">
                        <i class="fas fa-user absolute left-3 top-3 text-gray-400 text-sm"></i>
                        <input type="text" name="name" value="<?php echo e(old('name')); ?>" required
                            placeholder="Votre nom"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    </div>
                    <?php $__errorArgs = ['name'];
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
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Adresse email</label>
                    <div class="relative">
                        <i class="fas fa-envelope absolute left-3 top-3 text-gray-400 text-sm"></i>
                        <input type="email" name="email" value="<?php echo e(old('email')); ?>" required
                            placeholder="vous@exemple.com"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    </div>
                    <?php $__errorArgs = ['email'];
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
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Mot de passe</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-3 text-gray-400 text-sm"></i>
                        <input type="password" name="password" required
                            placeholder="Au moins 8 caractères"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                    </div>
                    <?php $__errorArgs = ['password'];
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
                    <label class="block text-sm font-semibold text-gray-700 mb-1.5">Confirmer le mot de passe</label>
                    <div class="relative">
                        <i class="fas fa-lock absolute left-3 top-3 text-gray-400 text-sm"></i>
                        <input type="password" name="password_confirmation" required
                            placeholder="Confirmez votre mot de passe"
                            class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:border-indigo-500">
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-indigo-600 text-white py-3 rounded-lg font-semibold hover:bg-indigo-700 transition mt-2">
                    Créer mon compte
                </button>
            </form>

            <p class="text-center text-sm text-gray-500 mt-6">
                Déjà un compte ?
                <a href="<?php echo e(route('login')); ?>" class="text-indigo-600 font-semibold hover:underline">Se connecter</a>
            </p>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\wamp64\www\shopmarket\resources\views/auth/register.blade.php ENDPATH**/ ?>