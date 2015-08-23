<?php
include('config.php');
logincheck();
/**
 * Created by Tyfix 2015
 */
$message = [];

if(isset($_GET['delete'])) {
    $category = Category::find($_GET['delete']);
    $category->delete();

    $message['type'] = "success";
    $message['message'] = "Category deleted";
}

$categories = Category::all();

echo $template->view()->make('categories')->with('categories',  $categories)->with('message', $message)->render();
?>