<?php
include('config.php');
logincheck();

$message = [];
$title = "Create category";
$category = new Category;

if(isset($_GET['id'])) {
    $title = "Edit category";
    $category = Category::where('id', '=', $_GET['id'])->first();
}

if (isset($_POST['submit'])) {

    $category->name = $_POST['name'];
    if(isset($_GET['id'])) {
        $message['type'] = "success";
        $message['message'] = "Category saved";
        $category->save();
    } else {
        $exists = Category::where('name', '=', $_POST['name'])->get();

        if(count($exists) > 0) {
            $message['type'] = "error";
            $message['message'] = "Categoryname already exists";
        } else {
            $message['type'] = "success";
            $message['message'] = "Category created";
            $category->save();
            redirect("manage_category.php?id=" . $category->id, 2000);
        }
    }
}

echo $template->view()->make('manage_category')
    ->with('category',  $category)
    ->with('message', $message)
    ->with('title', $title)
    ->render();
