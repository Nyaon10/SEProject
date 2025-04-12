<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', 'Customer Portal'); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }
        nav {
            margin-bottom: 20px;
        }
        nav a {
            margin-right: 10px;
        }
        form input, form button {
            display: block;
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
        }
        .logout-btn {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <nav>
        <?php if(session('customer')): ?>
            Welcome, <?php echo e(session('customer')->Nama_Pelanggan); ?> |
            <a href="<?php echo e(route('dashboard')); ?>">Dashboard</a>
            <form action="<?php echo e(route('logout')); ?>" method="POST" style="display:inline">
                <?php echo csrf_field(); ?>
                <button class="logout-btn" type="submit">Logout</button>
            </form>
        <?php elseif(!request()->is('login') && !request()->is('register')): ?>
            <a href="<?php echo e(route('login')); ?>">Login</a>
            <a href="<?php echo e(route('register')); ?>">Register</a>
        <?php endif; ?>
    </nav>

    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
</body>
</html>
<?php /**PATH C:\Users\User\OneDrive\Documents\Uni Notes\ISTTS\Software Engineering Project\resources\views/layouts/app.blade.php ENDPATH**/ ?>