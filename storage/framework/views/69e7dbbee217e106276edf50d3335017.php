<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Facture #<?php echo e($order->id); ?> - 3roubi Zone</title>
    <style>
        /* CSS mrigel lel PDF (DomPDF yefhem ghir el tables w les styles basic) */
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; color: #333; font-size: 14px; line-height: 1.5; }
        .header-table { width: 100%; border-bottom: 3px solid #dc2626; padding-bottom: 20px; margin-bottom: 30px; }
        .logo { height: 70px; width: 70px; border-radius: 50%; }
        .site-name { font-size: 24px; font-weight: bold; color: #333; margin-left: 10px; }
        .invoice-title { text-align: right; color: #dc2626; font-size: 32px; font-weight: bold; text-transform: uppercase; margin: 0; }
        .invoice-details { text-align: right; margin-top: 5px; color: #666; }
        
        .info-table { width: 100%; margin-bottom: 30px; }
        .info-box { width: 48%; vertical-align: top; }
        .info-box h4 { color: #dc2626; border-bottom: 1px solid #e5e7eb; padding-bottom: 5px; margin-bottom: 10px; font-size: 16px; }
        
        .products-table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        .products-table th { background-color: #dc2626; color: white; padding: 12px; text-align: left; }
        .products-table td { border-bottom: 1px solid #e5e7eb; padding: 12px; }
        .products-table tr:nth-child(even) { background-color: #f9fafb; }
        
        .totals-table { width: 100%; margin-top: 20px; }
        .totals-table td { padding: 8px; }
        .total-row { font-size: 20px; font-weight: bold; color: #dc2626; }
        
        .footer { text-align: center; color: #9ca3af; font-size: 12px; margin-top: 50px; border-top: 1px solid #e5e7eb; padding-top: 20px; }
    </style>
</head>
<body>

    <!-- Header mte3 el Facture -->
    <table class="header-table">
        <tr>
            <td style="vertical-align: middle;">
                <img src="https://i.pinimg.com/736x/ae/2d/db/ae2ddb41289492c17f9851b0833588f7.jpg" class="logo" alt="Logo">
                <span class="site-name">3roubi Zone</span>
            </td>
            <td style="vertical-align: middle;">
                <h1 class="invoice-title">Facture</h1>
                <div class="invoice-details">
                    <strong>N° :</strong> #<?php echo e($order->id); ?><br>
                    <strong>Date :</strong> <?php echo e($order->created_at->format('d/m/Y')); ?>

                </div>
            </td>
        </tr>
    </table>

    <!-- Info Client w Commande -->
    <table class="info-table">
        <tr>
            <td class="info-box">
                <h4>Facturé à :</h4>
                <strong><?php echo e($order->user->name); ?></strong><br>
                <?php echo e($order->user->email); ?><br>
                <?php echo e($order->shipping_address); ?>

            </td>
            <td class="info-box">
                <h4>Détails de la commande :</h4>
                <strong>Méthode de paiement :</strong> <?php echo e(strtoupper($order->payment_method)); ?><br>
                <strong>Statut :</strong> <?php echo e(strtoupper($order->status)); ?>

            </td>
        </tr>
    </table>

    <!-- Table mte3 les produits -->
    <table class="products-table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix Unitaire</th>
                <th>Qté</th>
                <th style="text-align: right;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>
                        <strong><?php echo e($item->product->name ?? 'Produit supprimé'); ?></strong><br>
                        <small style="color: #666;"><?php echo e($item->product->short_description ?? ''); ?></small>
                    </td>
                    <td><?php echo e(number_format($item->unit_price, 2)); ?> €</td>
                    <td><?php echo e($item->quantity); ?></td>
                    <td style="text-align: right;"><?php echo e(number_format($item->unit_price * $item->quantity, 2)); ?> €</td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <!-- Total -->
    <table class="totals-table">
        <tr>
            <td style="width: 70%;"></td>
            <td style="width: 30%;">
                <table width="100%">
                    <tr>
                        <td style="color: #666;">Sous-total :</td>
                        <td style="text-align: right;"><?php echo e(number_format($order->total, 2)); ?> €</td>
                    </tr>
                    <tr>
                        <td style="color: #666;">Livraison :</td>
                        <td style="text-align: right;">Offerte</td>
                    </tr>
                    <tr style="border-top: 2px solid #e5e7eb;">
                        <td class="total-row">Total à payer :</td>
                        <td class="total-row" style="text-align: right;"><?php echo e(number_format($order->total, 2)); ?> €</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <!-- Footer -->
    <div class="footer">
        Merci pour votre confiance !<br>
        <strong>3roubi Zone</strong> - Le goût authentique de la Tunisie<br>
        www.3roubi-zone.tn
    </div>

</body>
</html><?php /**PATH C:\Users\thinkpad\3roubi-zone\resources\views/order/invoice.blade.php ENDPATH**/ ?>