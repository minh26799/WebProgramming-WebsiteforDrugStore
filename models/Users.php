<?php
class Users
{
    private $Username;
    private $Password;
    private $FirstName;
    private $LastName;
    private $uuid;
    private $connection;
    private $encodedPassword;
    private $newEncodedPassword;

    public function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function createConnection($ServerName, $Username, $Password, $dbname)
    {
        $this->connection = new mysqli($ServerName, $Username, $Password, $dbname);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function __construct()
    {
        $this->Username = "";
        $this->Password = "";
        $this->FirstName = "";
        $this->LastName = "";
        $this->uuid = "";
    }

    public function login($post_method)
    {
        $this->Username = $this->validate($post_method['username']);
        $this->Password = $this->validate($post_method['password']);
        $this->encodedPassword = md5($this->Password);
        $sql = "SELECT * FROM users WHERE username = '$this->Username' AND password = '$this->encodedPassword'";
        $result = $this->connection->query($sql);
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['username'];
            $_SESSION['firstname'] = $row['firstname'];
            $_SESSION['lastname'] = $row['lastname'];
            $_SESSION['id'] = $row['uid'];
            $_SESSION['role'] = $row['role'];
            //! Must be changed to the correct path
            // $url = "../index.php/home"; // url to redirect to homepage 
            // header("Location: $url");
            // exit();
            $_SESSION['fullname'] = $row['firstname'] . " " . $row['lastname'];
            $_SESSION['phone'] = $row['phone'];
            return true;
        } else {
            $url = "../index.php/login?error=Incorrect Username or Password";
            header("Location: $url");
            exit();
            return false;
        }
    }
    public function register($post_method)
    {
        $this->Username = $this->validate($post_method['username']);
        $this->Password = $this->validate($post_method['password']);
        $this->FirstName = $post_method['firstname'];
        $this->LastName = $post_method['lastname'];
        $this->Phone = $post_method['phone'];
        $this->uuid = uniqid('users_');
        $this->encodedPassword = md5($this->Password);
        $sql = "SELECT * FROM users WHERE username = '$this->Username'";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) // The username already exists
        {
            $url = "../index.php/register?error=Username already exists";
            header("Location: $url");
            exit();
            return false;
        } else {
            $sql2 = "INSERT INTO users 
            VALUES ('$this->uuid','$this->Username', '$this->encodedPassword', '$this->FirstName' ,'$this->LastName', '$this->Phone', 'user')";
            $result2 = mysqli_query($this->connection, $sql2);
            if ($result2) //Successfully added the user
            {
                //! Must be changed to the correct path
                $url = "../index.php/register?success=Registration Successful";
                header("Location: $url");
                exit();
                return true;
            } else // Failed added a user
            {
                //! Must be changed to the correct path
                $url = "../index.php/register?error=Registration Failed";
                header("Location: $url");
                exit();
                return false;
            }
        }
    }
    public function editProfile($post_method)
    {
        $this->Username = $this->validate($post_method['username']);
        $this->Password = $this->validate($post_method['password']);
        $this->newPassword = $this->validate($post_method['password2']);
        $this->FirstName = $post_method['firstname'];
        $this->LastName = $post_method['lastname'];
        $this->Phone = $post_method['phone'];
        $this->newEncodedPassword = md5($this->newPassword);
        $this->encodedPassword = md5($this->Password);
        $sql = "SELECT * FROM users WHERE username = '$this->Username' AND password ='$this->encodedPassword'";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result) > 0) // The username already exists
        {
            $sql2 =
                "UPDATE users
            SET password = '$this->newEncodedPassword',firstname = '$this->FirstName',lastname ='$this->LastName',phone = '$this->Phone'
            WHERE username = '$this->Username' AND password ='$this->encodedPassword';
            ";
            $result = $this->connection->query($sql2);
            if ($result) {
                $sql3 = "SELECT * FROM users WHERE username = '$this->Username' AND password ='$this->newEncodedPassword'";
                $result = $this->connection->query($sql3);
                if ($result) {
                    $row = $result->fetch_assoc();
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['firstname'] = $row['firstname'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['fullname'] = $row['firstname'] . " " . $row['lastname'];
                    $_SESSION['phone'] = $row['phone'];
                    $_SESSION['id'] = $row['uid'];
                    $url = "../index.php/editProfile?success=Edition Successful";
                    header("Location: $url");
                    exit();
                    return true;
                }
            }
        } else {
            //! Must be changed to the correct path
            $url = "../index.php/editProfile?error=  Edition Failed";
            header("Location: $url");
            exit();
            return false;
        }
    }
};
