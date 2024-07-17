<header class="header"> 
        <nav class="navbar">
            <a href="index.php">Home</a>
            <a href="guides.php">Guides</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
        </nav>

    <form action="search.php" method="POST" class="search-bar">
        <input type="text" name="keyword" placeholder="Search...">
        <button type="submit"><i class='bx bx-search'></i></button>
    </form>
    
    <?php
        if (isset($_SESSION['user_name'])) {
            echo '
                <nav class="navbar">
                <a href="guide_list.php">Your Guides</a>
                <a href="insert_guide.php">Add Guide</a>
                <a href="#" style="margin-left: 100px;">
                <strong><i>'.$_SESSION['user_name'].'</i></strong>
                </a>
                <a href="logout.php">Logout</a>
            </nav>
            ';
        } elseif (isset($_SESSION['admin_name'])) {
            echo '
                <nav class="navbar">
                <a href="aguide_list.php">Admin Panel</a>
                <a href="admin_guide.php">Your Guides</a>
                <a href="insert_admin_guide.php">Add Guide</a>
                <a href="#" style="margin-left: 100px;">
                        <strong><i>'.$_SESSION['admin_name'].'</i></strong>
                </a>
                <a href="logout.php">Logout</a>
            </nav>
            
            ';
        }else {
            echo '
                <form>
                    <p><a href="login.php" class="register-link">Login</a></p>
                    <p><a href="signup.php" class="register-link">Sign up</a></p>
                </form>
            ';
        } 
        ?>

    </header>