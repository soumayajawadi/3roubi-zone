

<?php $__env->startSection('title', $product->name); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="bg-white rounded shadow-sm p-4 p-md-5">
        <div class="row align-items-center">
            
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="min-height: 400px;">
                    <?php if($product->image_src): ?>
                        <img src="<?php echo e($product->image_src); ?>" class="img-fluid rounded" style="max-height: 500px; object-fit: cover;" alt="<?php echo e($product->name); ?>">
                    <?php else: ?>
                        <span class="text-muted fst-italic">Pas d'image</span>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-md-6">
                <span class="badge bg-danger mb-2"><?php echo e($product->category->name ?? 'Produit'); ?></span>
                <h1 class="fw-bold mb-3"><?php echo e($product->name); ?></h1>
                <h3 class="text-danger fw-bold mb-4"><?php echo e(number_format($product->price, 2)); ?> €</h3>
                
                <p class="text-muted mb-4"><?php echo e($product->description ?? $product->short_description); ?></p>

                <div class="mb-4">
                    <span class="fw-bold">Disponibilité : </span>
                    <?php if($product->stock > 0): ?>
                        <span class="text-success fw-bold">En stock (<?php echo e($product->stock); ?>)</span>
                    <?php else: ?>
                        <span class="text-danger fw-bold">Rupture de stock</span>
                    <?php endif; ?>
                </div>

                <?php if($product->stock > 0): ?>
                    <div class="d-flex gap-3">
                        <form method="POST" action="<?php echo e(route('cart.add', $product)); ?>" class="d-flex gap-3 flex-grow-1">
                            <?php echo csrf_field(); ?>
                            <input type="number" name="qty" value="1" min="1" max="<?php echo e($product->stock); ?>" class="form-control text-center" style="width: 80px;">
                            <button type="submit" class="btn btn-danger btn-lg flex-grow-1 fw-bold">🛒 Ajouter au panier</button>
                        </form>

                        <form action="<?php echo e(route('wishlist.add', $product)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="btn btn-outline-danger btn-lg h-100" title="Ajouter aux favoris">❤️</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h3 class="fw-bold border-bottom pb-3 mb-4">⭐ Avis des clients</h3>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="bg-white p-4 rounded shadow-sm border">
                    <h5 class="fw-bold">Donnez votre avis</h5>
                    <form action="<?php echo e(route('review.store', $product)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Note</label>
                            <div class="d-flex gap-2 fs-4 text-warning">
                                <input type="radio" name="rating" value="5" id="5" checked> <label for="5">⭐⭐⭐⭐⭐</label>
                            </div>
                            <div class="d-flex gap-2 fs-4 text-warning">
                                <input type="radio" name="rating" value="4" id="4"> <label for="4">⭐⭐⭐⭐</label>
                            </div>
                            <div class="d-flex gap-2 fs-4 text-warning">
                                <input type="radio" name="rating" value="3" id="3"> <label for="3">⭐⭐⭐</label>
                            </div>
                            <div class="d-flex gap-2 fs-4 text-warning">
                                <input type="radio" name="rating" value="2" id="2"> <label for="2">⭐⭐</label>
                            </div>
                            <div class="d-flex gap-2 fs-4 text-warning">
                                <input type="radio" name="rating" value="1" id="1"> <label for="1">⭐</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Commentaire</label>
                            <textarea name="comment" class="form-control" rows="3" placeholder="Votre expérience..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 fw-bold">Envoyer</button>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <?php $__empty_1 = true; $__currentLoopData = $product->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="bg-white p-3 rounded shadow-sm border mb-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="fw-bold"><?php echo e($review->user->name); ?></h6>
                            <span class="text-warning"><?php echo e(str_repeat('⭐', $review->rating)); ?></span>
                        </div>
                        <small class="text-muted"><?php echo e($review->created_at->format('d/m/Y')); ?></small>
                        <p class="mt-2 mb-0"><?php echo e($review->comment); ?></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="alert alert-info">Aucun avis pour le moment. Soyez le premier !</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\thinkpad\3roubi-zone\resources\views/shop/show.blade.php ENDPATH**/ ?>