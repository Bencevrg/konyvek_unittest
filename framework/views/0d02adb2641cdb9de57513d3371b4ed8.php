

<?php $__env->startSection('title', 'Books'); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">

    <h1>➕ Add a new book</h1>

    <form action="<?php echo e(route('books.store')); ?>" method="post" enctype="multipart/form-data" class="form-card">
        <?php echo csrf_field(); ?>

        <fieldset>
            <label for="title">📖 Title</label>
            <input type="text" name="title" id="title" required>
        </fieldset>

        <fieldset>
            <label for="author_id">✍️ Author</label>
            <select name="author_id" id="author_id" required>
                <?php $__currentLoopData = $writers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $writer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($writer->id); ?>"><?php echo e($writer->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </fieldset>

        <fieldset>
            <label for="price">💰 Price</label>
            <input type="number" name="price" id="price" required>
        </fieldset>

        <fieldset>
            <label for="genre">🎭 Genre</label>
            <input type="text" name="genre" id="genre">
        </fieldset>

        <fieldset>
            <label for="iban">🏦 ISBN</label>
            <input type="text" name="iban" id="iban">
        </fieldset>

        <fieldset>
            <label for="description">📝 Description</label>
            <textarea name="description" id="description" rows="4"></textarea>
        </fieldset>

        <fieldset>
            <label for="image">📷 Cover photo</label>
            <input type="file" name="image" id="image" accept="image/*">
        </fieldset>

        <button type="submit">Save</button>
    </form>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jenei\Desktop\kitti\könyvek\resources\views/books/create.blade.php ENDPATH**/ ?>