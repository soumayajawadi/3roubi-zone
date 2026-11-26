

<?php $__env->startSection('title', isset($produit) ? 'Modifier le Produit' : 'Ajouter un Produit'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-8 max-w-3xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">
        <?php echo e(isset($produit) ? 'Modifier le produit : ' . $produit->name : 'Ajouter un nouveau produit'); ?>

    </h1>

    <form action="<?php echo e(isset($produit) ? route('admin.produits.update', $produit) : route('admin.produits.store')); ?>" method="POST" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <?php echo csrf_field(); ?>
        <?php if(isset($produit)): ?>
            <?php echo method_field('PUT'); ?>
        <?php endif; ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Nom -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nom du produit *</label>
                <input type="text" name="name" value="<?php echo e(old('name', $produit->name ?? '')); ?>" required class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Catégorie -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie *</label>
                <select name="category_id" required class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    <option value="">Sélectionnez une catégorie</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat->id); ?>" <?php echo e((old('category_id', $produit->category_id ?? '') == $cat->id) ? 'selected' : ''); ?>>
                            <?php echo e($cat->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Prix -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Prix (€) *</label>
                <input type="number" step="0.01" name="price" value="<?php echo e(old('price', $produit->price ?? '')); ?>" required class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <!-- Stock -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Stock *</label>
                <input type="number" name="stock" value="<?php echo e(old('stock', $produit->stock ?? '')); ?>" required class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                <?php $__errorArgs = ['stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Description courte -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Description courte</label>
            <input type="text" name="short_description" value="<?php echo e(old('short_description', $produit->short_description ?? '')); ?>" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
        </div>

        <!-- Description longue -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">Description complète</label>
            <textarea name="description" rows="4" class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-500 focus:border-orange-500"><?php echo e(old('description', $produit->description ?? '')); ?></textarea>
        </div>

        <!-- Image -->
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Image du produit</label>
            <?php if(isset($produit) && $produit->image): ?>
                <div class="mb-2">
                    <img src="<?php echo e($produit->image); ?>" class="w-24 h-24 object-cover rounded-lg border">
                </div>
            <?php endif; ?>
            <input type="file" name="image" class="w-full border border-gray-300 rounded-lg p-2 text-sm bg-gray-50">
            <p class="text-xs text-gray-500 mt-1">Format accepté : JPG, PNG. Max 2MB.</p>
            <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <span class="text-red-500 text-xs"><?php echo e($message); ?></span> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Boutons -->
        <div class="flex justify-end gap-3 border-t pt-6">
            <a href="<?php echo e(route('admin.produits.index')); ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-6 py-2 rounded-lg font-medium transition">Annuler</a>
            <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-2 rounded-lg font-medium transition shadow-sm">
                <?php echo e(isset($produit) ? 'Enregistrer les modifications' : 'Créer le produit'); ?>

            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\thinkpad\3roubi-zone\resources\views/admin/produits/form.blade.php ENDPATH**/ ?>