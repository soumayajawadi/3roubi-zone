

<?php $__env->startSection('title', 'Mes Favoris - 3roubi Zone'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h1 class="fw-bold mb-4 text-danger">❤️ Mes Favoris</h1>

    <?php if($products->isEmpty()): ?>
        <div class="bg-white p-5 rounded shadow-sm text-center">
            <h4 class="text-muted mb-4">Vous n'avez pas encore de produits favoris.</h4>
            <a href="<?php echo e(route('shop')); ?>" class="btn btn-danger rounded-pill px-4">Découvrir la boutique</a>
        </div>
    <?php else: ?>
        <div class="row g-4">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card-produit h-100">
                        <div style="height: 200px; background: #f3f4f6; display: flex; align-items: center; justify-content: center;">
                            <?php if($product->image_url): ?>
                                <img src="<?php echo e($product->image_url); ?>" class="w-100 h-100" style="object-fit: cover;">
                            <?php endif; ?>
                        </div>
                        <div class="p-3">
                            <h5 class="fw-bold text-dark text-truncate"><?php echo e($product->name); ?></h5>
                            <p class="text-danger fw-bold fs-5"><?php echo e(number_format($product->price, 2)); ?> €</p>
                            <div class="d-flex gap-2 mt-3">
                                <a href="<?php echo e(route('product.show', $product->id)); ?>" class="btn btn-sm btn-outline-dark w-100">Voir</a>
                                <form action="<?php echo e(route('wishlist.remove', $product)); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger">✕</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\thinkpad\3roubi-zone\resources\views/wishlist/index.blade.php ENDPATH**/ ?>