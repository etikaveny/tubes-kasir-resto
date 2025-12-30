<?php $__env->startSection('content'); ?>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Menu Management</h2>
        <div class="d-flex gap-2">
            <form action="<?php echo e(route('manager.products.index')); ?>" method="GET" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Search menu..."
                    value="<?php echo e(request('search')); ?>">
                <button type="submit" class="btn btn-outline-secondary"><i class="bi bi-search"></i></button>
            </form>
            <?php if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager'): ?>
                <a href="<?php echo e(route('manager.products.create')); ?>" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add New
                    Product</a>
            <?php endif; ?>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <div class="card p-4">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <?php if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager'): ?>
                        <th>Actions</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <?php if($product->image): ?>
                                <img src="<?php echo e(asset('storage/' . $product->image)); ?>" width="50" height="50"
                                    class="rounded object-fit-cover">
                            <?php else: ?>
                                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                    style="width:50px;height:50px;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="fw-bold"><?php echo e($product->name); ?></td>
                        <td><span class="badge bg-secondary"><?php echo e($product->category->name ?? 'Uncategorized'); ?></span></td>
                        <td>Rp<?php echo e(number_format($product->price, 0, ',', '.')); ?></td>
                        <td><?php echo e($product->stock); ?></td>
                        <td>
                            <?php if($product->is_available): ?>
                                <span class="badge bg-success">Available</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Unavailable</span>
                            <?php endif; ?>
                        </td>
                        <?php if(auth()->user()->role === 'admin' || auth()->user()->role === 'manager'): ?>
                            <td>
                                <a href="<?php echo e(route('manager.products.edit', $product)); ?>" class="btn btn-sm btn-outline-dark"><i
                                        class="bi bi-pencil"></i></a>
                                <form action="<?php echo e(route('manager.products.destroy', $product)); ?>" method="POST" class="d-inline"
                                    onsubmit="return confirm('Delete this product?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php if($products->isEmpty()): ?>
            <div class="text-center py-5 text-muted">No products found. Add one to get started.</div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp 5\htdocs\kuliah\semester3\TUBES PAW\tubes-kasir-resto\resources\views/manager/products/index.blade.php ENDPATH**/ ?>