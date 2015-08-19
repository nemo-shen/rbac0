<?php 
require_once $_SERVER['CONTEXT_DOCUMENT_ROOT'] . 'rbac/config.php';
checkLogined();

class article extends common{
    
    /**
     * 添加文章
     * @param array $data
     * @throws Exception
     */
    public function addArticle($data) {
        $this->check_permission(__FUNCTION__);
        try {
            if (empty($data)){
                jump('' ,'pages/addArticle.php','',0);
            } else {
                if (empty($data['title'])) throw new Exception('文章标题不能为空');
                if (empty($data['content'])) throw new Exception('文章内容不能为空');
                $data['title'] = addslashesed($data['title']);
                $data['name'] = $data['title'];
                unset($data['title']);
                $data['content'] = addslashesed($data['content']);
                $time = time();
                $data['time'] = $time;
                $mysql = C('mysql');
                if ($mysql->insert('article', $data)) {
                    jump('添加成功', 'pages/articleList.php', true);
                } else {
                    jump('添加失败', 'pages/addArticle.php');
                }
            }
        } catch (Exception $e) {
            jump($e->getMessage(), 'pages/addArticle.php');
        }
    }
    
    /**
     * 显示文章列表
     * @param bool $is_show
     */
    public function articleList ($is_show = false) {
        $this->check_permission(__FUNCTION__);
        if ($is_show === false) {
            jump('','pages/articleList.php','',0);
        } else {
            $mysql = C('mysql');
            return $result = $mysql->fetchAll('id,name,content,time', 'article');
        }
    }
    
    /**
     * 显示指定文章
     * @param int $id
     */
    public function showArtticle ($id) {
        $this->check_permission(__FUNCTION__);
        $mysql = C('mysql');
        return $result = $mysql->fetchOne('id,name,content,time', 'article', "id={$id}");
    }
    
    /**
     * 编辑文章
     * @param int $id
     * @param string $title
     * @param string $content
     * @throws Exception
     */
    public function editArticle ($id, $title, $content) {
        $this->check_permission(__FUNCTION__);
        try {
            if (empty($title)) throw new Exception('文章标题不能为空');
            if (empty($content)) throw new Exception('文章内容不能为空');
            $title = addslashesed($title);
            $content = addslashesed($content);
            $time = time();
            $mysql = C('mysql');
            $data = array(
                'name' => $title,
                'content' => $content,
                'time' => $time
            );
            $where = "id={$id}";
            if ($mysql->update('article', $data, $where)) {
                jump('编辑成功', 'pages/articleList.php', true);
            } else {
                jump('编辑失败', 'pages/addArticle.php');
            }
        } catch (Exception $e) {
            jump($e->getMessage(), 'pages/addArticle.php');
        }
    }
    
    /**
     * 添加文章
     * @param int $id
     * @throws Exception
     */
    public function delArticle ($id) {
        $this->check_permission(__FUNCTION__);
        try {
            if (!is_numeric($id) || empty($id)) throw new Exception('文章删除失败');
            $mysql = C('mysql');
            $where = "id={$id}";
            if ($mysql->delete('article', $where)) {
                jump('删除成功', 'pages/articleList.php', true);
            } else {
                jump('删除失败', 'pages/articleList.php');
            }
        } catch (Exception $e) {
            jump($e->getMessage(), 'pages/articleList.php');
        }
    }
}

?>