

<?php $__env->startSection('content'); ?>
    <h1>Edit Writer</h1>

    <form action="<?php echo e(route('writers.update', $writers->id)); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PATCH'); ?>

        <fieldset>
            <label for="name">✍️ Name</label>
            <input type="text" name="name" id="name" 
                   value="<?php echo e(old('name', $writers->name)); ?>" required>
        </fieldset>

        <fieldset>
            <label for="bio">📝 Biography</label>
            <textarea name="bio" id="bio" rows="4"><?php echo e(old('bio', $writers->bio)); ?></textarea>
        </fieldset>

        <fieldset>
            <label for="portrait">📷 Portrait</label>
            <input type="file" name="portrait" id="portrait" accept="image/*">
            
            <?php if($writers->portrait_path): ?>
                <div>
                    <p>Current portrait:</p>
                    <img src="<?php echo e(asset('storage/' . $writers->portrait_path)); ?>" 
                         alt="<?php echo e($writers->name); ?>" 
                         style="width:120px; height:auto;">
                </div>
            <?php endif; ?>
        </fieldset>

        <button type="submit">Save</button>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jenei\Desktop\kitti\könyvek\resources\views/writers/edit.blade.php ENDPATH**/ ?>