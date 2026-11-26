

<?php $__env->startSection('title', 'Boutique - 3roubi Zone'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">

    <h1 class="fw-bold mb-4 border-bottom pb-3">Notre Boutique</h1>

    <!-- Filtres & Recherche -->
    <div class="bg-white p-4 rounded shadow-sm mb-5 d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
        <form action="<?php echo e(route('shop')); ?>" method="GET" class="d-flex w-100 w-md-50 gap-2">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Rechercher un produit..." class="form-control">
            <button type="submit" class="btn btn-danger">Chercher</button>
        </form>

        <div class="d-flex gap-2 overflow-auto w-100 w-md-auto pb-2 pb-md-0">
            <a href="<?php echo e(route('shop')); ?>" class="btn <?php echo e(!request('category') ? 'btn-danger' : 'btn-outline-secondary'); ?> rounded-pill px-3 text-nowrap">Tout</a>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('shop', ['category' => $cat->slug])); ?>" class="btn <?php echo e(request('category') == $cat->slug ? 'btn-danger' : 'btn-outline-secondary'); ?> rounded-pill px-3 text-nowrap">
                    <?php echo e($cat->name); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- Grille des produits -->
    <?php if($products->isEmpty()): ?>
        <div class="text-center py-5 bg-white rounded shadow-sm">
            <h4 class="text-muted">Aucun produit trouvé.</h4>
        </div>
    <?php else: ?>
        <div class="row g-4 mb-5">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <div class="card-produit h-100 d-flex flex-column" style="background: #fff; border: 1px solid #e5e7eb; border-radius: 15px; overflow: hidden; transition: all 0.4s ease-in-out; box-shadow: 0 2px 10px rgba(0,0,0,0.05);" onmouseover="this.style.boxShadow='0 0 25px 5px rgba(220, 38, 38, 0.6)'; this.style.borderColor='#dc2626'; this.style.transform='translateY(-8px)';" onmouseout="this.style.boxShadow='0 2px 10px rgba(0,0,0,0.05)'; this.style.borderColor='#e5e7eb'; this.style.transform='translateY(0)';">
                        <!-- Image -->
                        <div class="bg-light position-relative d-flex align-items-center justify-content-center" style="height: 200px;">
                            <?php if($product->image_src): ?>
                                <img src="<?php echo e($product->image_src); ?>" class="w-100 h-100" style="object-fit: cover;" alt="<?php echo e($product->name); ?>">
                            <?php else: ?>
                                <span class="text-muted fst-italic">Pas d'image</span>
                            <?php endif; ?>

                            <?php if($product->stock <= 0): ?>
                                <span class="position-absolute top-0 end-0 m-2 badge bg-danger">Rupture</span>
                            <?php endif; ?>
                        </div>

                        <!-- Infos -->
                        <div class="p-3 d-flex flex-column flex-grow-1">
                            <span class="text-muted small mb-1"><?php echo e($product->category->name ?? 'Catégorie'); ?></span>
                            <h5 class="fw-bold text-truncate"><?php echo e($product->name); ?></h5>
                            <p class="text-muted small mb-3" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                <?php echo e($product->short_description); ?>

                            </p>
                            
                            <div class="mt-auto">
                                <p class="text-danger fw-bold fs-5 mb-3"><?php echo e(number_format($product->price, 2)); ?> €</p>
                                <a href="<?php echo e(route('product.show', $product->id)); ?>" class="btn btn-danger w-100 fw-bold">Voir le produit</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-4">
            <?php echo e($products->links('pagination::bootstrap-5')); ?>

        </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\thinkpad\3roubi-zone\resources\views/shop/index.blade.php ENDPATH**/ ?>