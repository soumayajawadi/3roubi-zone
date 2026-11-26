

<?php $__env->startSection('title', 'Admin - Produits'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
        <h1 class="fw-bold mb-0">🛍️ Produits (Admin)</h1>
        <a href="<?php echo e(route('admin.produits.create')); ?>" class="btn btn-danger fw-bold">+ Créer un produit</a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($products->isEmpty()): ?>
        <div class="alert alert-info">Aucun produit pour le moment.</div>
    <?php else: ?>
        <div class="table-responsive bg-white rounded shadow-sm p-3">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="<?php echo e($product->archived_at ? 'table-secondary' : ''); ?>">
                            <td>#<?php echo e($product->id); ?></td>
                            <td>
                                <?php if($product->image_src): ?>
                                    <img src="<?php echo e($product->image_src); ?>" alt="<?php echo e($product->name); ?>"
                                         style="width:50px;height:50px;object-fit:cover;" class="rounded">
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold"><?php echo e($product->name); ?></td>
                            <td><?php echo e($product->category->name ?? '-'); ?></td>
                            <td class="fw-bold text-danger"><?php echo e(number_format($product->price, 2)); ?> €</td>
                            <td><?php echo e($product->stock); ?></td>
                            <td>
                                <?php if($product->archived_at): ?>
                                    <span class="badge bg-secondary">Archivé</span>
                                <?php else: ?>
                                    <span class="badge bg-success">Actif</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="<?php echo e(route('admin.produits.edit', $product)); ?>"
                                       class="btn btn-sm btn-primary">Modifier</a>

                                    <?php if($product->archived_at): ?>
                                        <form action="<?php echo e(route('admin.produits.unarchive', $product)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <button type="submit" class="btn btn-sm btn-success">Restaurer</button>
                                        </form>
                                    <?php else: ?>
                                        <form action="<?php echo e(route('admin.produits.archive', $product)); ?>" method="POST"
                                              onsubmit="return confirm('Archiver ce produit ?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <button type="submit" class="btn btn-sm btn-warning">Archiver</button>
                                        </form>
                                    <?php endif; ?>

                                    <form action="<?php echo e(route('admin.produits.destroy', $product)); ?>" method="POST"
                                          onsubmit="return confirm('Supprimer définitivement ce produit ?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            <?php echo e($products->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\thinkpad\3roubi-zone\resources\views/admin/produits/index.blade.php ENDPATH**/ ?>