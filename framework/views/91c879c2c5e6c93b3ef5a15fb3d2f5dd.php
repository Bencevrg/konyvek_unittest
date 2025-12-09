

<?php $__env->startSection('content'); ?>

<form action="<?php echo e(route('books.update', $books->id)); ?>" method = "post">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PATCH'); ?>
    <fieldset>
    <label for="author_id">Author</label>
    <select name="author_id" id="author_id" required>
        <?php $__currentLoopData = $writers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $writer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($writer->id); ?>" 
                <?php echo e(old('author_id', $books->author_id) == $writer->id ? 'selected' : ''); ?>>
                <?php echo e($writer->name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</fieldset>
    <fieldset>
        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?php echo e(old('title', $books->title)); ?>">
    </fieldset>
    <fieldset>
            <label for="price">Price</label>
            <input type="number" name="price" id="price" required value="<?php echo e(old('price', $books->price)); ?>">
    </fieldset>
    <fieldset>
        <label for="genre">🎭 Genre</label>
        <input type="text" name="genre" id="genre" value="<?php echo e(old('genre', $books->genre)); ?>">
    </fieldset>
    <fieldset>
        <label for="iban">🏦 IBAN</label>
        <input type="text" name="iban" id="iban" value="<?php echo e(old('iban', $books->iban)); ?>">
    </fieldset>
    <fieldset>
        <label for="description">📝 Description</label>
        <textarea name="description" id="description" rows="4"><?php echo e(old('description', $books->description)); ?>></textarea>
    </fieldset>
    <fieldset>
        <label for="image">📷 Cover image</label>
        <input type="file" name="image" id="image" accept="image/*" value="<?php echo e(old('image', $books->imagePath)); ?>">
    </fieldset>
    <button type="submit">Save</button>
</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jenei\Desktop\kitti\könyvek\resources\views/books/edit.blade.php ENDPATH**/ ?>