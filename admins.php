<?php
/**
 * Created by Tyfix 2015
 */
include('config.php');
logincheck();
$message = [];

if(isset($_GET['delete'])) {
    if($_GET['delete'] == 1) {
        $message['type'] = "error";
        $message['message'] = "You cannot remove the main admin account";
    } else {
        $admin = Admin::find($_GET['delete']);
        $admin->delete();

        $message['type'] = "success";
        $message['message'] = "Admin deleted";
    }
}

$admins = Admin::all();

echo $template->view()->make('admins')->with('admins',  $admins)->with('message', $message)->render();
