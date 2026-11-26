

<?php $__env->startSection('title', 'Chat avec le Support'); ?>

<?php $__env->startSection('content'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
         
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden" style="background: #fff;">
                
               
                <div class="card-header bg-danger text-white d-flex align-items-center p-3 border-0">
                    <div class="bg-white text-danger rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold" style="width: 45px; height: 45px; font-size: 1.2rem;">
                        🛡️
                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold">Support Technique</h5>
                        <small class="text-white-50">En ligne</small>
                    </div>
                </div>

              
                <div class="card-body p-4" style="height: 450px; overflow-y: auto; background-color: #f4f7f6; background-image: url('https://www.transparenttextures.com/patterns/cubes.png');" id="chat-box">
                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($msg->sender_id == auth()->id()): ?>
                           
                            <div class="d-flex justify-content-end mb-3">
                                <div class="bg-danger text-white p-3 rounded-3 shadow-sm" style="max-width: 75%; border-bottom-right-radius: 0 !important;">
                                    <?php echo e($msg->content); ?>

                                    <div class="text-end mt-1" style="font-size: 0.65rem; color: rgba(255,255,255,0.7);">
                                        <?php echo e($msg->created_at->format('H:i')); ?>

                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                           
                            <div class="d-flex justify-content-start mb-3">
                                <div class="bg-white text-dark p-3 rounded-3 shadow-sm border" style="max-width: 75%; border-bottom-left-radius: 0 !important;">
                                    <?php echo e($msg->content); ?>

                                    <div class="text-end mt-1" style="font-size: 0.65rem; color: #6c757d;">
                                        <?php echo e($msg->created_at->format('H:i')); ?>

                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

       
                <div class="card-footer bg-white p-3 border-top-0">
                    <form action="<?php echo e(route('chat.send')); ?>" method="POST" class="d-flex gap-2 align-items-center">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="receiver_id" value="<?php echo e($admin->id); ?>">
                        <input type="text" name="content" class="form-control form-control-lg bg-light border-0" placeholder="Écrivez votre message..." required autocomplete="off" style="border-radius: 20px;">
                        <button type="submit" class="btn btn-danger btn-lg rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            ➤
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto scroll l'el ekher message
    let chatBox = document.getElementById('chat-box');
    if(chatBox) chatBox.scrollTop = chatBox.scrollHeight;
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\thinkpad\3roubi-zone\resources\views/chat/client.blade.php ENDPATH**/ ?>