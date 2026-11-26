

<?php $__env->startSection('title', 'Admin - Messages'); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid mt-4 mb-5">
    <h1 class="fw-bold mb-4">💬 Gestion des Messages</h1>
    
    <div class="row shadow-sm rounded-4 overflow-hidden" style="height: 600px; background: #fff;">
        <!-- Sidebar mte3 les clients -->
        <div class="col-md-4 border-end p-0 bg-light d-flex flex-column h-100">
            <div class="p-3 bg-white border-bottom">
                <h5 class="mb-0 fw-bold text-dark">Clients</h5>
            </div>
            <div class="list-group list-group-flush overflow-auto flex-grow-1">
                <?php $__empty_1 = true; $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a href="<?php echo e(url('admin/chat/' . $client->id)); ?>" class="list-group-item list-group-item-action border-0 py-3 d-flex align-items-center <?php echo e($selectedClient && $selectedClient->id == $client->id ? 'bg-danger text-white' : ''); ?>">
                        <div class="bg-white text-danger rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold shadow-sm" style="width: 40px; height: 40px;">
                            <?php echo e(strtoupper(substr($client->name, 0, 1))); ?>

                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold"><?php echo e($client->name); ?></h6>
                            <small class="<?php echo e($selectedClient && $selectedClient->id == $client->id ? 'text-white-50' : 'text-muted'); ?>"><?php echo e($client->email); ?></small>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="p-4 text-center text-muted">Aucun client.</div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Blasa mte3 el chat -->
        <div class="col-md-8 d-flex flex-column p-0 h-100">
            <?php if($selectedClient): ?>
                <!-- Header mte3 el chat -->
                <div class="p-3 bg-white border-bottom d-flex align-items-center">
                    <div class="bg-danger text-white rounded-circle d-flex align-items-center justify-content-center me-3 fw-bold shadow-sm" style="width: 45px; height: 45px;">
                        <?php echo e(strtoupper(substr($selectedClient->name, 0, 1))); ?>

                    </div>
                    <div>
                        <h5 class="mb-0 fw-bold"><?php echo e($selectedClient->name); ?></h5>
                        <small class="text-success fw-bold">🟢 En ligne</small>
                    </div>
                </div>

                <!-- HNA EL FIX: Blasa mte3 les messages m3a Scroll -->
                <div class="flex-grow-1 p-4 overflow-auto" style="background-color: #f4f7f6; background-image: url('https://www.transparenttextures.com/patterns/cubes.png');" id="chat-box-admin">
                    <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($msg->sender_id == auth()->id()): ?>
                            <div class="d-flex justify-content-end mb-3">
                                <div class="bg-dark text-white p-3 rounded-3 shadow-sm" style="max-width: 75%; border-bottom-right-radius: 0 !important;">
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

                <!-- Formulaire mte3 l'envoi -->
                <div class="p-3 bg-white border-top">
                    <form action="<?php echo e(route('chat.send')); ?>" method="POST" class="d-flex gap-2 align-items-center">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="receiver_id" value="<?php echo e($selectedClient->id); ?>">
                        <input type="text" name="content" class="form-control form-control-lg bg-light border-0" placeholder="Répondre au client..." required autocomplete="off" style="border-radius: 20px;">
                        <button type="submit" class="btn btn-dark btn-lg rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            ➤
                        </button>
                    </form>
                </div>
            <?php else: ?>
                <div class="d-flex flex-column justify-content-center align-items-center h-100 bg-light text-muted">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" fill="currentColor" class="bi bi-chat-dots mb-3" viewBox="0 0 16 16">
                      <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                      <path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/>
                    </svg>
                    <h4>Sélectionnez un client</h4>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    // Auto scroll l'el ekher message
    let chatBox = document.getElementById('chat-box-admin');
    if(chatBox) chatBox.scrollTop = chatBox.scrollHeight;
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\thinkpad\3roubi-zone\resources\views/chat/admin.blade.php ENDPATH**/ ?>