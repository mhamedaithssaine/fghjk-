<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Dev.to</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Categories -->
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-fw fa-folder"></i>
            <span>Categories</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Categories
    </div>

    <!-- Nav Item - Categories -->
    <?php
    require '../vendor/autoload.php';
    use App\Models\Category;

    $category = new Category();
    $usedCategories = $category->getUsedCategories();

    foreach ($usedCategories as $category): ?>
        <li class="nav-item">
            <a class="nav-link" href="category.php?id=<?php echo $category['id']; ?>">
                <i class="fas fa-fw fa-wrench"></i>
                <span><?php echo htmlspecialchars($category['name']); ?></span>
            </a>
        </li>
    <?php endforeach; ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
