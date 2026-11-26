<?php $__env->startSection('title', 'Inscription - 3roubi Zone'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5 mb-5">
    <div class="row justify-content-center align-items-center">
        
        
        <div class="col-md-5">
            <div class="bg-white p-5 rounded-4 border-0" style="box-shadow: 0 20px 40px rgba(220, 38, 38, 0.15);">
                <div class="text-center mb-4">
                    <img src="https://i.pinimg.com/736x/ae/2d/db/ae2ddb41289492c17f9851b0833588f7.jpg" alt="Logo" style="height: 70px; width: 70px; object-fit: contain; border-radius: 50%; filter: drop-shadow(0 4px 8px rgba(220, 38, 38, 0.4));">
                    <h2 class="fw-bold mt-3 text-dark">Créer un compte</h2>
                    <p class="text-muted">Rejoignez-nous pour découvrir nos produits.</p>
                </div>

                <form method="POST" action="<?php echo e(route('register')); ?>">
                    <?php echo csrf_field(); ?>

                  
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold small text-uppercase text-muted">Nom complet</label>
                        <input id="name" type="text" class="form-control form-control-lg bg-light border-0 <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="name" value="<?php echo e(old('name')); ?>" required autocomplete="name" autofocus placeholder="Entrez votre nom">
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                   
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold small text-uppercase text-muted">Email</label>
                        <input id="email" type="email" class="form-control form-control-lg bg-light border-0 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" placeholder="Entrez votre email">
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                  
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold small text-uppercase text-muted">Mot de passe</label>
                        <input id="password" type="password" class="form-control form-control-lg bg-light border-0 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="password" required autocomplete="new-password" placeholder="Entrez votre mot de passe">
                        <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="invalid-feedback" role="alert"><strong><?php echo e($message); ?></strong></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                  
                    <div class="mb-4">
                        <label for="password-confirm" class="form-label fw-bold small text-uppercase text-muted">Confirmer le mot de passe</label>
                        <input id="password-confirm" type="password" class="form-control form-control-lg bg-light border-0" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmez votre mot de passe">
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <a class="small text-decoration-none fw-bold" href="<?php echo e(route('login')); ?>" style="color: #dc2626;">
                            Déjà inscrit ? Se connecter
                        </a>
                    </div>

                    <button type="submit" class="btn btn-lg w-100 fw-bold rounded-pill py-3 text-white" style="background-color: #dc2626; border: none; box-shadow: 0 8px 20px rgba(220, 38, 38, 0.4); transition: all 0.3s;">S'INSCRIRE</button>
                </form>
            </div>
        </div>

        <div class="col-md-7 d-none d-md-block">
            <div class="rounded-4" style="height: 600px; background-image: url('https://i.pinimg.com/736x/ae/2d/db/ae2ddb41289492c17f9851b0833588f7.jpg'); background-size: cover; background-position: center; position: relative; overflow: hidden; box-shadow: 0 20px 50px rgba(220, 38, 38, 0.3);">
                <div style="position: absolute; top:0; left:0; right:0; bottom:0; background: linear-gradient(to bottom, rgba(220, 38, 38, 0.7), rgba(0, 0, 0, 0.7));"></div>
                
                <div class="text-white text-center p-5 d-flex flex-column justify-content-center h-100" style="position: relative; z-index: 2;">
                    <h1 class="display-3 fw-bold mb-3 text-uppercase" style="letter-spacing: 2px; text-shadow: 0 4px 10px rgba(0,0,0,0.5);">3roubi Zone</h1>
                    <p class="fs-4 fw-light">Le goût authentique de la Tunisie, livré chez vous.</p>
                    <p class="fs-5 text-white mt-3" dir="rtl">نكهات تونس الأصيلة في كل بيت</p>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\thinkpad\3roubi-zone\resources\views/auth/register.blade.php ENDPATH**/ ?>