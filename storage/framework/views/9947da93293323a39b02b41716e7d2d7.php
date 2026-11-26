

<?php $__env->startSection('title', 'Admin - Commandes'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-4">
    <h1 class="fw-bold mb-4 border-bottom pb-3">📦 Toutes les Commandes (Admin)</h1>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($orders->isEmpty()): ?>
        <div class="alert alert-info">Aucune commande pour le moment.</div>
    <?php else: ?>
        <div class="table-responsive bg-white rounded shadow-sm p-3">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Total</th>
                        <th>Statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td>#<?php echo e($order->id); ?></td>
                            <td>
                                <strong><?php echo e($order->user->name); ?></strong><br>
                                <small class="text-muted"><?php echo e($order->user->email); ?></small>
                            </td>
                            <td><?php echo e($order->created_at->format('d/m/Y H:i')); ?></td>
                            <td class="fw-bold text-danger"><?php echo e(number_format($order->total, 2)); ?> €</td>
                            <td>
                                <form action="<?php echo e(route('admin.orders.status', $order)); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PATCH'); ?>
                                    <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                        <option value="pending" <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>En attente</option>
                                        <option value="confirmed" <?php echo e($order->status == 'confirmed' ? 'selected' : ''); ?>>Confirmée</option>
                                        <option value="shipped" <?php echo e($order->status == 'shipped' ? 'selected' : ''); ?>>Expédiée</option>
                                        <option value="delivered" <?php echo e($order->status == 'delivered' ? 'selected' : ''); ?>>Livrée</option>
                                        <option value="cancelled" <?php echo e($order->status == 'cancelled' ? 'selected' : ''); ?>>Annulée</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#orderModal-<?php echo e($order->id); ?>">Détails</button>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>


<?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="modal fade" id="orderModal-<?php echo e($order->id); ?>" tabindex="-1" aria-labelledby="orderModalLabel-<?php echo e($order->id); ?>" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold" id="orderModalLabel-<?php echo e($order->id); ?>">Commande #<?php echo e($order->id); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-4">
                        <h6 class="fw-bold border-bottom pb-2 mb-3">📄 Détails de la commande</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Client :</strong> <?php echo e($order->user->name); ?></p>
                                <p class="mb-1"><strong>Adresse :</strong> <?php echo e($order->shipping_address); ?></p>
                                <p class="mb-0"><strong>Paiement :</strong> <?php echo e($order->payment_method); ?></p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold">Produits :</h6>
                                <ul class="list-group list-group-flush">
                                    <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-1">
                                            <div>
                                                <?php echo e($item->product->name ?? 'Produit supprimé'); ?>

                                                <span class="text-muted small">(x<?php echo e($item->quantity); ?>)</span>
                                            </div>
                                            <span class="fw-bold text-danger"><?php echo e(number_format($item->unit_price * $item->quantity, 2)); ?> €</span>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 p-3 border rounded border-primary bg-primary bg-opacity-10">
                        <h6 class="fw-bold text-primary mb-3">🚚 Informations de livraison</h6>
                        <form action="<?php echo e(route('admin.delivery.store', $order->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6 mb-2">
                                    <label class="form-label small fw-bold">Numéro de suivi</label>
                                    <input type="text" name="tracking_number" class="form-control form-control-sm" value="<?php echo e($order->delivery->tracking_number ?? ''); ?>" placeholder="Ex: TN123456789" required>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label small fw-bold">Statut</label>
                                    <select name="status" class="form-select form-select-sm">
                                        <option value="En préparation" <?php echo e(($order->delivery->status ?? '') == 'En préparation' ? 'selected' : ''); ?>>En préparation</option>
                                        <option value="Expédiée" <?php echo e(($order->delivery->status ?? '') == 'Expédiée' ? 'selected' : ''); ?>>Expédiée</option>
                                        <option value="Livrée" <?php echo e(($order->delivery->status ?? '') == 'Livrée' ? 'selected' : ''); ?>>Livrée</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm fw-bold mt-2">Enregistrer la livraison</button>
                        </form>
                    </div>
                </div>

                <div class="modal-footer bg-light d-flex justify-content-between">
                    <div>
                        <?php if(in_array($order->status, ['pending', 'confirmed'])): ?>
                            <form action="<?php echo e(route('admin.orders.cancel', $order)); ?>" method="POST" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-outline-danger fw-bold" onclick="return confirm('Annuler cette commande ?');">Annuler la commande</button>
                            </form>
                        <?php endif; ?>
                    </div>

                    <div>
                        <a href="<?php echo e(route('orders.invoice', $order->id)); ?>" class="btn btn-danger fw-bold me-2">📄 Télécharger Facture PDF</a>
                        <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\thinkpad\3roubi-zone\resources\views/admin/orders/index.blade.php ENDPATH**/ ?>