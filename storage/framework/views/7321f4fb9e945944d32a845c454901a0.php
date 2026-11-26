

<?php $__env->startSection('title', 'Promotions - 3roubi Zone'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5 mb-5">

    <div class="text-center mb-5">
        <h1 class="fw-bold display-4 d-flex justify-content-center align-items-center gap-3" 
            style="color: #dc2626; text-shadow: 0 0 20px rgba(220, 38, 38, 0.6), 2px 2px 5px rgba(0,0,0,0.2);">
            <span style="font-size: 4rem; line-height: 1;">🔥</span> Nos Promotions
        </h1>
        <p class="fs-5 text-muted fw-bold mt-2">Profitez de nos offres exclusives pour goûter à la Tunisie !</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
           
            <div class="card border-0 rounded-4 text-center p-5 position-relative overflow-hidden" 
                 style="background-image: url('https://i.pinimg.com/736x/c2/cb/8c/c2cb8c5f7c963efa07285bc3a4a0fe14.jpg'); background-size: cover; background-position: center; min-height: 450px; display: flex; justify-content: center; box-shadow: 0 0 40px rgba(220, 38, 38, 0.5); border: 2px solid #dc2626;">
                
              
                <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.65);"></div>

                <div class="position-relative z-index-2 text-white">
                    <h2 class="fw-bold mb-4" style="text-shadow: 0 0 15px rgba(220, 38, 38, 0.8);">Offre Spéciale !</h2>
                    <p class="fs-4 mb-4">Utilisez le code promo ci-dessous lors de votre commande :</p>
                    
                   
                    <div class="d-inline-block bg-white text-danger fw-bold fs-2 px-5 py-3 rounded-3 shadow-lg mb-4" 
                         style="letter-spacing: 3px; border: 2px dashed #dc2626;">
                        TUNISIA10
                    </div>
                    
                    <p class="fs-5 mb-5 fw-bold">Et bénéficiez de <span class="text-warning">10 € de réduction</span> sur votre panier.</p>
                    
                    
                    <a href="<?php echo e(route('shop')); ?>" class="btn btn-danger btn-lg fw-bold rounded-pill px-5 py-3 shadow" 
                       style="border: 2px solid white; box-shadow: 0 0 20px rgba(220, 38, 38, 0.8);">
                        🛒 Découvrir la boutique
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\thinkpad\3roubi-zone\resources\views/promotions.blade.php ENDPATH**/ ?>