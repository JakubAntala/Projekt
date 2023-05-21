<?php


class Database {



    private string $hostname = "localhost";
    private int $port = 3306;
    private string $username = "root";
    private string $password = "";
    private string $dbName = "grill";

    private $connection;



    public function __construct(string $host = "", int $port = 3306, string $user = "", string $pass = "", string $dbName = "")
    {
        if(!empty($host)) {
            $this->hostname = $host;
        }

        if(!empty($port)) {
            $this->port = $port;
        }

        if(!empty($user)) {
            $this->username = $user;
        }

        if(!empty($pass)) {
            $this->password = $pass;
        }

        if(!empty($dbName)) {
            $this->dbName = $dbName;
        }

        try {

            $this->connection = new PDO("mysql:charset=utf8;host=".$this->hostname.";dbname=".$this->dbName.";port=".$this->port, $this->username, $this->password);
        } catch (\Exception $exception) {
            echo $exception->getMessage();

        }
    }

    public function getFromDatabase(): array {
        $menu = [];

        try {
            $sql = "SELECT * FROM blog";
            $query = $this->connection->query($sql);
            $menuItems = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($menuItems as $menuItem) {

                $menu[$menuItem['id']] = [
                    'id' => $menuItem['id'],
                    'title' => $menuItem['title'],
                    'date' => $menuItem['date'],
                    'text' => $menuItem['text'],
                    'image' => $menuItem['image']
                ];
            }

        } catch (\Exception $exception) {

            echo $exception ;
        }


        return $menu;
    }
    public function printBlogPosts($menu)
    {

        foreach ($menu as $value) {

            echo '<div class="col-md-4 col-sm-6">
            <div class="blog-post">
                <div class="blog-thumb">
            <img src="images/'.$value['image'].'" alt="" />
                    </div>
                    <div class="blog-content">
                        <div class="content-show">
                            <h4><a href="single-post.html">'.$value['title'].'</a></h4>
                            <span>'.$value['date'].'</span>
                        </div>
                        <div class="content-hide">
                            <p>'.$value['text'].'</p>
                    </div>
                </div>
            </div>
        </div>
                    ';

        }

    }

    public function insertPost(string $title, string $date, string $text, string $image): bool
    {
        $insert = false;
        $sql = "INSERT INTO blog(title, date, text, image) VALUE('".$title."', '".$date."', '".$text."', '".$image."') ";
        try {
            $statement = $this->connection->prepare($sql);
            $insert = $statement->execute();


        } catch (\Exception $exception) {
            echo "Nepodarilo sa vložiť hodnoty." . $exception->getMessage();
        }

        return $insert;
    }

    public function deletePost(string $id): bool
    {
        $delete = false;
        $sql = "DELETE FROM blog WHERE id = ".$id;

        try {
            $statement = $this->connection->prepare($sql);
            $delete = $statement->execute();
        } catch (\Exception $exception) {
            echo "Nepodarilo sa odstrániť hodnoty.";
        }

        return $delete;
    }
    public function updateMenuItem(int $id,string $title, string $date, string $text, string $image): bool
    {
        try {
            $sql = "UPDATE blog SET title = :title, date = :date, text = :text, image = :image WHERE id = :id";
            $statement = $this->connection->prepare($sql);
            $statement->bindValue('title', $title);
            $statement->bindValue('date', $date);
            $statement->bindValue('text', $text);
            $statement->bindValue('image', $image);
            $statement->bindValue('id',$id);
            $update = $statement->execute();

        } catch (\Exception $exception) {
            $update = false;
        }

        return $update;

    }

    public function getBlogItem(int $id): array
    {
        try {
            $sql = "SELECT * FROM blog WHERE id = " . $id;
            $query = $this->connection->query($sql);
            $data = $query->fetch(PDO::FETCH_ASSOC);

            return $data;
        } catch (\Exception $exception) {
            return [];
        }
    }
}
?>

