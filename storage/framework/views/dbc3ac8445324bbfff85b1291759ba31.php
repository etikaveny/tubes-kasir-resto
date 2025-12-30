<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Product</h2>
    <a href="<?php echo e(route('manager.products.index')); ?>" class="btn btn-outline-secondary">Back</a>
</div>

<div class="card p-4" style="max-width: 800px; margin: 0 auto;">
    <form action="<?php echo e(route('manager.products.update', $product)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo e($product->name); ?>" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select" required>
                    <option value="">Select Category</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>" <?php echo e($product->category_id == $category->id ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Price (Rp)</label>
                <input type="number" name="price" class="form-control" value="<?php echo e($product->price); ?>" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" value="<?php echo e($product->stock); ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control">
                <?php if($product->image): ?>
                    <div class="mt-2 text-muted small">Current: <?php echo e(basename($product->image)); ?></div>
                <?php endif; ?>
            </div>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="is_available" value="1" <?php echo e($product->is_available ? 'checked' : ''); ?> id="availCheck">
            <label class="form-check-label" for="availCheck">
                Available for ordering
            </label>
        </div>

        <button type="submit" class="btn btn-primary w-100">Update Product</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp 5\htdocs\kuliah\semester3\TUBES PAW\tubes-kasir-resto\resources\views/manager/products/edit.blade.php ENDPATH**/ ?>