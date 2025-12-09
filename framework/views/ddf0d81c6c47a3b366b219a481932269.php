

<?php $__env->startSection('title', 'Authors'); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <h1>Writers</h1>

    <a href="<?php echo e(route('writers.create')); ?>" class="add-btn">Add New Author</a>

    <?php if(session('success')): ?>
        <p class="alert success"><?php echo e(session('success')); ?></p>
    <?php endif; ?>

    <div class="writer-list">
        <?php $__currentLoopData = $writers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $writer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="writer-card">
                <?php if($writer->portrait_path): ?>
                    <img src="<?php echo e(asset('storage/' . $writer->portrait_path)); ?>" 
                        alt="<?php echo e($writer->name); ?>" 
                        class="writer-image">
                <?php else: ?>
                    <div class="writer-placeholder">No image</div>
                <?php endif; ?>

                <div class="writer-details">
                    <h3><?php echo e($writer->name); ?></h3>
                    <p class="bio"><?php echo e($writer->bio); ?></p>
                </div>
            </div>
            <div class="book-actions">
                        <a href="<?php echo e(route('writers.edit', $writer->id)); ?>" class="edit-btn">Edit</a>
                <form action="<?php echo e(route('writers.destroy', $writer->id)); ?>" method="POST" style="display:inline;">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this author?')">Delete</button>
                </form>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jenei\Desktop\kitti\könyvek\resources\views/writers/index.blade.php ENDPATH**/ ?>