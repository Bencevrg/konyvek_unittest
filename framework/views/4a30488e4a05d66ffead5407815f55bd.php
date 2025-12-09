

<?php $__env->startSection('title', 'Books'); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
    <h1>Books</h1>

    <a href="<?php echo e(route('books.create')); ?>" class="add-btn">Add new book</a>
    <form method="GET" action="<?php echo e(route('books.index')); ?>" style="margin:20px 0;">
        <input type="text" name="search" placeholder="Search books..." 
               value="<?php echo e(request('search')); ?>">
        <button type="submit">Search</button>
    </form>
    
    <form method="GET" action="<?php echo e(route('books.index')); ?>" style="margin:20px 0;">
    <label for="author_id">Filter by Author:</label>
    <select name="author_id" id="author_id" onchange="this.form.submit()">
        <option value="">-- All authors --</option>
        <?php $__currentLoopData = $writers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $writer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($writer->id); ?>" 
                <?php echo e(request('author_id') == $writer->id ? 'selected' : ''); ?>>
                <?php echo e($writer->name); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</form>
<form method="GET" action="<?php echo e(route('books.index')); ?>" style="margin:20px 0;">
    <label for="genre">Filter by Genre:</label>
    <select name="genre" id="genre" onchange="this.form.submit()">
        <option value="">-- All genres --</option>
        <?php $__currentLoopData = $genres; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $genre): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($genre); ?>" 
                <?php echo e(request('genre') == $genre ? 'selected' : ''); ?>>
                <?php echo e($genre); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</form>

    <?php if(session('success')): ?>
        <p class="alert success"><?php echo e(session('success')); ?></p>
    <?php endif; ?>

    <div class="book-list">
        <?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="book-card">
                <?php if($book->image_path): ?>
                    <img src="<?php echo e(asset('storage/' . $book->image_path)); ?>" 
                        alt="<?php echo e($book->title); ?>" 
                        class="book-image">
                <?php else: ?>
                    <div class="book-placeholder">No image</div>
                <?php endif; ?>

                <div class="book-details">
                    <p class="adatok"><strong>Title:</strong> <?php echo e($book->title); ?></p>
                    <p class="adatok"><strong>Author:</strong> <?php echo e($book->writer ? $book->writer->name : 'N/A'); ?></p>
                    <p class="adatok"><strong>Price:</strong> <?php echo e(number_format($book->price, 0, ',', ' ')); ?> Ft</p>
                    <p class="adatok"><strong>Genre:</strong> <?php echo e($book->genre); ?></p>

                                    <div class="book-actions">
                        <a href="<?php echo e(route('books.edit', $book->id)); ?>" class="edit-btn">Edit</a>

                        <form action="<?php echo e(route('books.destroy', $book->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this book?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\jenei\Desktop\kitti\könyvek\resources\views/books/index.blade.php ENDPATH**/ ?>