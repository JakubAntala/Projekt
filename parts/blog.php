
            <?php
            include_once "database_files/database.php";
            $menu = new Database();
            $data = $menu->getFromDatabase();
            $menu->printBlogPosts($data);
            ?>


