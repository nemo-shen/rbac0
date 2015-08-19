<?php 
require_once 'config.php';
require_once 'class/userAction.class.php';

$action = !empty($_GET['action']) ? $_GET['action'] : 'login';
if ($action == 'login') {
    $username = !empty($_POST['username']) ? $_POST['username'] : '';
    $password = !empty($_POST['password']) ? $_POST['password'] : '';
    if (!empty($_SESSION['uid']) && !empty($_SESSION['username']) && !empty($_SESSION['permission'])) jump('','admin.php','',0);
    if (empty($username) || empty($password)) jump('','login.html','',0);
    $useraction = C('userAction');
    $useraction->login($username, $password);
}

if ($action == 'logout') {
    $user = C('userAction');
    $user->logout();
}


if ($action == 'articleList'){
    $article = C('article');
    $article->articleList();
}


if ($action == 'addArticle'){
    $article = C('article');
    $article->addArticle($_POST);
}

if ($action == 'showArticle') {
    $destnation = "pages/showArticle.php?id={$_GET['id']}";
    jump('',$destnation,'',0);
}

if ($action == 'editArticle') {
    if (!$_GET['id']) jump('文章编辑失败', 'pages/articleList.php');
    if ($_POST) {
        $article = C('article');
        $result = $article->editArticle($_GET['id'], $_POST['title'], $_POST['content']);
    } else{
        $destnation = "pages/editArticle.php?id={$_GET['id']}";
        jump('',$destnation,'',0);
    }
}

if ($action == 'delArticle') {
    $article = C('article');
    $article->delArticle($_GET['id']);
}

if ($action == 'userList') {
    $user = C('userAction');
    $user->userList();
}

if ($action == 'addUser') {
    $user = C('userAction');
    $user->addUser($_POST);
}

if ($action == 'editUser') {
    if (!$_GET['id']) jump('用户编辑失败', 'pages/userList.php');
    if ($_POST) {
        $user = C('userAction');
        $result = $user->editUser($_GET['id'], $_POST);
    } else{
        $destnation = "pages/editUser.php?id={$_GET['id']}";
        jump('',$destnation,'',0);
    }
}

if ($action == 'delUser') {
    $user = C('userAction');
    $user->delUser($_GET['id']);
}

if ($action == 'permissionList') {
    $permission = C('permission');
    $permission->permissionList();
}

if ($action == 'addPermission') {
    $permission = C('permission');
    $permission->addPermission($_POST);
}

if ($action == 'editPermission') {
    if (!$_GET['id']) jump('权限编辑失败', 'pages/permissionList.php');
    if ($_POST) {
        $permission = C('permission');
        $result = $permission->editPermission($_GET['id'], $_POST);
    } else{
        $destnation = "pages/editPermission.php?id={$_GET['id']}";
        jump('',$destnation,'',0);
    }
}

if ($action == 'delPermission') {
    $permission = C('permission');
    $permission->delPermission($_GET['id']);
}

if ($action == 'roleList') {
    $role = C('role');
    $role->roleList();
}



if ($action == 'addRole') {
    $role = C('role');
    $role->addRole($_POST);
}

if ($action == 'editRole') {
    if (!$_GET['id']) jump('角色修改失败', 'pages/roleList.php');
    if ($_POST) {
        $role = C('role');
        $result = $role->editRole($_GET['id'], $_POST);
    } elseif (!empty($_GET['pid']) && !empty($_GET['id'])) {
        $role = C('role');
        $result = $role->editRole($_GET['id'], $_GET['pid']);
    } else{
        $destnation = "pages/editRole.php?id={$_GET['id']}";
        jump('',$destnation,'',0);
    }
}

if ($action == 'delRole') {
    $role = C('role');
    $role->delRole($_GET['id']);
}



?>