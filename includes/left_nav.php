<div class="left-navigation">
    <ul>
        <li class="profile-item <?php if (CURRENT_PAGE == 'profile') echo 'active'; ?>"><a
                href="profile.php">Profile</a></li>
        <li class="project-item <?php if (CURRENT_PAGE == 'project') echo 'active'; ?>"><a
                href="project.php">Project</a></li>
        <li class="router-item-nav <?php if (CURRENT_PAGE == 'connection') echo 'active'; ?>"><a href="connection.php">Router</a>
        </li>
        <li class="finance-item <?php if (CURRENT_PAGE == 'account_management') echo 'active'; ?>"><a
                href="account_management.php">Finance</a></li>
        <li class="store-item <?php if (CURRENT_PAGE == 'store') echo 'active'; ?>"><a href="store.php">Store</a></li>
        <li class="settings-item <?php if (CURRENT_PAGE == 'account') echo 'active'; ?>"><a
                href="account.php">Settings</a></li>
        <li class="investor-item"><a href="investor.php">Investors</a></li>
        <li class="blog-item"><a href="blog_posts.php">Blog</a></li>
    </ul>
</div> <!-- left-navigation -->