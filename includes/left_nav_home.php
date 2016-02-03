<div class="left-navigation home">
    <ul>
        <li class="profile-item"><a href="profile.php">Profile</a></li>
        <li class="project-item"><a href="project.php">Project</a></li>
        <li class="router-item-nav"><a href="connection.php">Router</a></li>
        <li class="investor-item"><a href="investor.php">Investors</a></li>
        <li class="finance-item"><a href="account_management.php">Finance</a></li>
        <li class="store-item"><a href="store.php">Store</a></li>
        <li class="blog-item"><a href="blog.php">MyRoute</a></li>
        <li class="settings-item"><a href="account.php">Settings</a></li>
        <?php $usrtype=userRole($_SESSION['uid']);
        if($usrtype=='Admin'){
           echo'<li class="admin-item"><a href="admin.php">'.'Admin'.'</a></li>';
         }?>
    </ul>
</div> <!-- left-navigation -->
