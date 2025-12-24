<?php $__env->startSection('content'); ?>
<div class="container h-100 d-flex flex-column justify-content-center align-items-center">
    <div class="card border-0 shadow-lg rounded-4 p-5 text-center" style="width: 400px; background-color: #F8F6F2;">
        <div class="mb-4">
            <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width:100px; height:100px; font-size: 3rem;">
                <i class="bi bi-person-fill"></i>
            </div>
        </div>
        
        <h3 class="fw-bold mb-1"><?php echo e(Auth::user()->name); ?></h3>
        <p class="text-muted mb-4"><?php echo e(Auth::user()->email); ?></p>
        
        <div class="d-grid gap-2">
            <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button class="btn btn-dark w-100 py-2 rounded-pill fw-bold">Logout</button>
            </form>
            <form action="<?php echo e(route('profile.destroy')); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete your account?')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button class="btn btn-outline-danger w-100 py-2 rounded-pill fw-bold border-2">Delete Account</button>
            </form>
            <a href="<?php echo e(route('cashier.dashboard')); ?>" class="btn btn-outline-secondary w-100 py-2 rounded-pill fw-bold">Back to POS</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/lian/Documents/Kasir Resto/tubes-kasir-resto/resources/views/cashier/profile.blade.php ENDPATH**/ ?>