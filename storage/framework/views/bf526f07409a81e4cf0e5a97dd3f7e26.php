<?php $__env->startSection('content'); ?>
<div class="row h-100">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
             <div class="d-flex align-items-center gap-3">
                <a href="<?php echo e(route('cashier.dashboard')); ?>" class="btn btn-outline-dark rounded-circle"><i class="bi bi-arrow-left"></i></a>
                <h2 class="fw-bold m-0">Order History</h2>
             </div>
        </div>

        <div class="card border-0 shadow-sm rounded-4 p-4">
            <table class="table table-hover align-middle">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Type/Table</th>
                        <th>Items</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>#<?php echo e($order->id); ?></td>
                        <td><?php echo e($order->created_at->format('d M Y, H:i')); ?></td>
                        <td><?php echo e($order->customer_name); ?></td>
                        <td>
                            <?php if($order->order_type == 'dine_in'): ?>
                                <span class="badge bg-primary">Dine In</span> <br> <small class="text-muted">Table <?php echo e($order->table_number); ?></small>
                            <?php else: ?>
                                <span class="badge bg-warning text-dark">Take Away</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <ul class="list-unstyled mb-0">
                                <?php $__currentLoopData = $order->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="small text-muted"><?php echo e($item->product->name); ?> x<?php echo e($item->quantity); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </td>
                        <td class="fw-bold">Rp<?php echo e(number_format($order->total_amount, 0, ',', '.')); ?></td>
                        <td><span class="badge bg-success">Paid</span></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <?php if($orders->isEmpty()): ?>
                <div class="text-center py-5 text-muted">No history found.</div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/lian/Documents/Kasir Resto/tubes-kasir-resto/resources/views/cashier/history.blade.php ENDPATH**/ ?>