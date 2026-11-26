

<?php $__env->startSection('title', 'Mes Commandes - 3roubi Zone'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <h1 class="fw-bold mb-4 border-bottom pb-3">Mes Commandes</h1>

    <?php if($orders->isEmpty()): ?>
        <div class="bg-white p-5 rounded shadow-sm text-center">
            <h4 class="text-muted mb-4">Vous n'avez pas encore passé de commande.</h4>
            <a href="<?php echo e(route('shop')); ?>" class="btn btn-danger rounded-pill px-4">Découvrir la boutique</a>
        </div>
    <?php else: ?>
        <div class="row">
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 mb-4">
                    <div class="card shadow-sm border-0">
                        
                        <!-- Header mte3 el commande -->
                        <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                            <div>
                                <strong>Commande #<?php echo e($order->id); ?></strong> 
                                <span class="text-muted ms-3"><?php echo e($order->created_at->format('d/m/Y H:i')); ?></span>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <?php if($order->status == 'pending'): ?>
                                    <span class="badge bg-warning text-dark">En attente</span>
                                <?php elseif($order->status == 'confirmed'): ?>
                                    <span class="badge bg-info text-dark">Confirmée</span>
                                <?php elseif($order->status == 'shipped'): ?>
                                    <span class="badge bg-primary">Expédiée</span>
                                <?php elseif($order->status == 'delivered'): ?>
                                    <span class="badge bg-success">Livrée</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Annulée</span>
                                <?php endif; ?>
                                
                                <!-- Bouton Annuler (Ken mazelt En attente wala Confirmée) -->
                                <?php if(in_array($order->status, ['pending', 'confirmed'])): ?>
                                    <form action="<?php echo e(route('orders.cancel', $order)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Êtes-vous sûr de vouloir annuler cette commande ?');">Annuler</button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Body mte3 el commande -->
                        <div class="card-body">
                            <table class="table table-borderless align-middle mb-0">
                                <tbody>
                                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td style="width: 70px;">
                                                <?php if($item->product && $item->product->image_src): ?>
                                                    <img src="<?php echo e($item->product->image_src); ?>" alt="<?php echo e($item->product->name); ?>" class="rounded" style="width: 60px; height: 60px; object-fit: cover;">
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <h6 class="mb-0 fw-bold"><?php echo e($item->product->name ?? 'Produit supprimé'); ?></h6>
                                                <small class="text-muted">Quantité : <?php echo e($item->quantity); ?></small>
                                            </td>
                                            <td class="text-end fw-bold">
                                                <?php echo e(number_format($item->unit_price * $item->quantity, 2)); ?> €
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                                <tfoot>
                                    <tr class="border-top">
                                        <td colspan="2" class="text-end fw-bold fs-5">Total :</td>
                                        <td class="text-end fw-bold text-danger fs-5"><?php echo e(number_format($order->total, 2)); ?> €</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Blasa mte3 el Livraison -->
                        <?php if($order->delivery): ?>
                            <div class="card-footer bg-info bg-opacity-10 border-top border-info">
                                <h6 class="fw-bold text-info mb-2">🚚 Suivi de livraison</h6>
                                <p class="mb-1"><strong>Numéro de suivi :</strong> <?php echo e($order->delivery->tracking_number); ?></p>
                                <p class="mb-0"><strong>Statut :</strong> <span class="badge bg-info text-dark"><?php echo e($order->delivery->status); ?></span></p>
                            </div>
                        <?php else: ?>
                            <div class="card-footer bg-light border-top">
                                <p class="mb-0 text-muted small">Aucune information de livraison disponible pour le moment.</p>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\thinkpad\3roubi-zone\resources\views/order/my.blade.php ENDPATH**/ ?>