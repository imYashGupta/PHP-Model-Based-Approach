<?php
require_once("model.php");
require_once("post.php");
class User extends Model{
    protected $table = "users";
    protected $coloumn = ["id","name","email","password","created_at","updated_at"];

    public function setpassword($password)
    {
        return password_hash($password,PASSWORD_BCRYPT);
    }

    public function setName($name)
    {
        return ucwords($name);
    }

    public function createdAt($format)
    {   
        return date($format,strtotime($this->created_at));
    }

    public function posts()
    {   
        $posts = Post::get($this->id);
        return $posts;
    }
}