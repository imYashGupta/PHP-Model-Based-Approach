<?php

require_once("model.php");

class Post extends model{
    protected $table = "posts";
    protected $coloumn = ["id","title","body","user_id","created_at","updated_at"];
}