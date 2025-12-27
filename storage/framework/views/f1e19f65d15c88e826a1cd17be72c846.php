<div class="col-md-3 col-sm-6">
    <div class="card product-card p-2 h-100" 
         data-id="<?php echo e($product->id); ?>" 
         data-name="<?php echo e($product->name); ?>" 
         data-price="<?php echo e($product->price); ?>" 
         data-image="<?php echo e(asset('storage/' . $product->image)); ?>">
        <div class="position-relative">
             <?php if($product->image): ?>
            <img src="<?php echo e(asset('storage/' . $product->image)); ?>" class="card-img-top product-img" alt="<?php echo e($product->name); ?>">
            <?php else: ?>
            <div class="bg-light product-img d-flex align-items-center justify-content-center text-muted">No Image</div>
            <?php endif; ?>
            <?php if(!$product->is_available): ?>
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center bg-dark bg-opacity-50 text-white fw-bold rounded">Unavailable</div>
            <?php endif; ?>
        </div>
        <div class="card-body p-2 text-center">
            <h6 class="fw-bold mb-1"><?php echo e($product->name); ?></h6>
            <div class="text-primary fw-bold">Rp<?php echo e(number_format($product->price, 0, ',', '.')); ?></div>
            <div class="small text-muted"><?php echo e($product->stock); ?> left</div>
        </div>
    </div>
</div>
<?php /**PATH /Users/azkaihza/tubes-kasir-resto/resources/views/cashier/partials/product-card.blade.php ENDPATH**/ ?>