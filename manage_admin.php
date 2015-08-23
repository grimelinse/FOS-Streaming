<?php
include('config.php');
logincheck();
/**
 * Created by Tyfix 2015
 */
$message = [];
$title = "Create admin";
$admin = new Admin;

if(isset($_GET['id'])) {
    $title = "Edit admin";
    $admin = Admin::where('id', '=', $_GET['id'])->first();
}

if (isset($_POST['submit'])) {

    $admin->username = $_POST['username'];
    if($_POST['password'] != "") {
        $admin->password = md5($_POST['password']);
    }
    if(isset($_GET['id'])) {
        $message['type'] = "success";
        $message['message'] = "admin edited";
        $admin->save();
    } else {
        $exists = Admin::where('username', '=', $_POST['username'])->get();

        if(count($exists) > 0) {
            $message['type'] = "error";
            $message['message'] = "admin name already exists";
        } else {
            $message['type'] = "success";
            $message['message'] = "admin Created";
            $admin->save();
            redirect("manage_admin.php?id=" . $admin->id, 2000);
        }
    }
}

echo $template->view()->make('manage_admin')
    ->with('admin',  $admin)
    ->with('message', $message)
    ->with('title', $title)
    ->render();
?>