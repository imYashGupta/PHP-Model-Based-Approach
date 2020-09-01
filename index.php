<?php
require_once("./autoload.php");

    // to insert user

   /*  $user = new User();
    $user->name = "John Doe";
    $user->email = "hello@JohnDoe.com";
    $user->password =  "password"; 
    $user->save();

    // to insert the post 
    $post = new Post();
    $post->title = "Some post title";
    $post->body = "example post body";
    $post->user_id = $user->id;
    $post->save();
 */

    //to fetch user model
    $users = User::get();

?>
<table border="1" width="50%" align="center" style="text-align: center;">
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Email</td>
        <td>Created</td>
        <td>posts</td>
    </tr>   
    <?php foreach($users as $user){ ?>
    <tr>
        <td>#<?= $user->id ?></td>
        <td><?= $user->name ?></td>
        <td><?= $user->email ?></td>
        <td><?= $user->createdAt("d M,Y") ?></td>
        <td><?= count($user->posts()) ?></td>
    </tr>
    <?php if(count($user->posts()) > 0){ ?>
    <tr>
        <td colspan="5">
            <table border="1"  width="75%" align="center" style="text-align: center;">
                <tr>
                    <td>#id</td>
                    <td>Title</td>
                    <td>body</td>
                    <td>Created</td>
                </tr>
                <?php foreach($user->posts() as $post){ ?>
                <tr>
                    <td><?= $post->id ?></td>
                    <td><?= $post->title ?></td>
                    <td><?= $post->body ?></td>
                    <td><?= $post->created_at ?></td>
                     
                </tr>
                <?php  } ?>
            </table>
        </td>
    </tr>
    <?php } ?>
    <?php } ?>
</table>

 