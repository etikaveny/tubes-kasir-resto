<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add New Product</h2>
    <a href="<?php echo e(route('manager.products.index')); ?>" class="btn btn-outline-secondary">Back</a>
</div>

<div class="card p-4" style="max-width: 800px; margin: 0 auto;">
    <form action="<?php echo e(route('manager.products.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        
        <div class="mb-3">
            <label class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Category</label>
                <select name="category_id" class="form-select" required>
                    <option value="">Select Category</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Price (Rp)</label>
                <input type="number" name="price" class="form-control" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Stock</label>
                <input type="number" name="stock" class="form-control" value="100" required>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Image</label>
                <input type="file" name="image" class="form-control">
            </div>
        </div>

        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="is_available" value="1" checked id="availCheck">
            <label class="form-check-label" for="availCheck">
                Available for ordering
            </label>
        </div>

        <button type="submit" class="btn btn-primary w-100">Save Product</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/lian/Documents/Kasir Resto/tubes-kasir-resto/resources/views/manager/products/create.blade.php ENDPATH**/ ?>