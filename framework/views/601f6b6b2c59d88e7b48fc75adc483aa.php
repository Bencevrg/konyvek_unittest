<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'Könyvtár'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>

<header>
    <h1>📚 Könyvtár</h1>
    <nav>
        <a href="<?php echo e(route('books.index')); ?>">Books</a>
        <a href="<?php echo e(route('writers.index')); ?>">Authors</a>
    </nav>
</header>

<main>
    <?php echo $__env->yieldContent('content'); ?>
</main>

</body>
</html>
<?php /**PATH C:\Users\jenei\Desktop\kitti\könyvek\resources\views/layouts/app.blade.php ENDPATH**/ ?>