<?php $__env->startSection('content'); ?>
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h2 class="fw-bold m-0">Staff Management</h2>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 text-secondary border-0">Name</th>
                            <th class="px-4 py-3 text-secondary border-0">Email</th>
                            <th class="px-4 py-3 text-secondary border-0">Role</th>
                            <th class="px-4 py-3 text-secondary border-0">Joined Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center"
                                            style="width:40px;height:40px;">
                                            <i class="bi bi-person-fill"></i>
                                        </div>
                                        <span class="fw-bold"><?php echo e($user->name); ?></span>
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-secondary"><?php echo e($user->email); ?></td>
                                <td class="px-4 py-3">
                                    <?php if($user->role === 'manager'): ?>
                                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">Manager</span>
                                    <?php else: ?>
                                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">Cashier</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3 text-secondary"><?php echo e($user->created_at->format('d M Y')); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="text-center py-5 text-secondary">
                                    <i class="bi bi-people fs-1 d-block mb-3"></i>
                                    No staff members found.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/azkaihza/tubes-kasir-resto/resources/views/manager/staff/index.blade.php ENDPATH**/ ?>