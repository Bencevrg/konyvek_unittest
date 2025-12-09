

<?php $__env->startSection('title', 'Authors'); ?>

<?php $__env->startSection('content'); ?>
    <h1>Add Writer</h1>

    <?php if($errors->any()): ?>
        <div style="color:red;">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('writers.store')); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <fieldset>
            <label for="name">✍️Name</label>
            <input type="text" name="name" id="name" value="<?php echo e(old('name')); ?>">
        </fieldset>

        <fieldset>
            <label for="bio">📝Bio</label>
            <textarea name="bio" id="bio"><?php echo e(old('bio')); ?></textarea>
        </fieldset>

        <fieldset>
            <label for="portrait">📷Portrait</label>
            <input type="file" name="portrait" id="portrait">
        </fieldset>

        <button type="submit">Save</button>
    </form>

    <a href="<?php echo e(route('writers.index')); ?>">Back to list</a>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jenei\Desktop\kitti\könyvek\resources\views/writers/create.blade.php ENDPATH**/ ?>