<?php $__env->startSection('content'); ?>
<div class="d-flex flex-column align-items-center justify-content-center h-100">
    <div class="card border-0 rounded-4 shadow-sm p-5 text-center" style="width: 400px; background-color: #EAE5D9;">
         <div class="mb-4">
             <div class="bg-dark rounded-circle text-white d-flex align-items-center justify-content-center mx-auto" style="width:100px;height:100px;">
                <i class="bi bi-person-fill display-3"></i>
             </div>
         </div>
         
         <h3 class="fw-bold m-0"><?php echo e(Auth::user()->name); ?></h3>
         <p class="text-muted mb-4"><?php echo e(Auth::user()->role === 'admin' ? 'Administrator' : 'Manager'); ?></p>
         
         <div class="d-grid gap-2">
             <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button class="btn btn-dark w-100 py-2 rounded-pill fw-bold">Logout</button>
             </form>
             
             <form action="<?php echo e(route('profile.destroy')); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button class="btn btn-outline-danger w-100 py-2 rounded-pill fw-bold border-2">Delete Account</button>
             </form>
         </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp 5\htdocs\kuliah\semester3\TUBES PAW\tubes-kasir-resto\resources\views/manager/profile.blade.php ENDPATH**/ ?>