<!--Typecho一键同步Unsplash作者摄影作品-->
<?php 
// 主题设置中填写Unsplash API Key
$accessKey = $this->options->Unsplash_API;
if (isset($_GET['sync']) && $_GET['sync'] == '1' && $accessKey) {
    // 主题设置中填写需要同步的Unsplash用户名
    $username = $this->options->Unsplash_User;
    // 分页请求
    $page = 1;
    // 每页请求的作品数量
    $perPage = 30; 
    $allPhotos = [];
    $hasMorePhotos = true;
    while ($hasMorePhotos) {
        // Unsplash请求接口
        $url = "https://api.unsplash.com/users/$username/photos?client_id=$accessKey&per_page=$perPage&page=$page";
        $response = @file_get_contents($url);
        if ($response === FALSE) {
            echo '请求超时，请仔细检查您的配置参数是否准确，当然，这也可能是短时间内同步太多次导致的，建议稍等片刻、清除浏览器缓存后再试。';
            break;
        }else{
            $photos = json_decode($response, true);
            if ($photos === null || empty($photos)) {
                $hasMorePhotos = false;
            } else {
                $allPhotos = array_merge($allPhotos, $photos);
                $page++;
            }
        }
    }
    if (empty($allPhotos)) {
        echo '暂未检测到需要同步的照片。';
    }else{
        // 主题设置中填写同步后自动发布文章的所属分类（即，相册mid）
        $categoryId = $this->options->Unsplash_Cat; 
        // 自动同步作品默认由站长发布
        $authorId = 1; 
        $updated = [];
        $added = [];
        $latest = true;
        // 自动发布到Typecho后台
        foreach ($allPhotos as $photo) {
            $title = $photo['description'] ?: '图片';// 作品未填写描述时的默认标题
            $imageId = $photo['id'];
            $imageUrl = $photo['urls']['full'];
            $thumbnailUrl = $photo['urls']['thumb']; // 获取缩略图 URL
            $authorName = isset($photo['user']['name']) ? $photo['user']['name'] : 'Unknown'; // 获取作者昵称
            // 自定义字段
            $fields = [
                'photo' => $imageUrl,// Unsplash原图地址
                'thumb' => $thumbnailUrl, // 缩略图地址
                'Unsplash_ID' => $imageId, // 添加图片ID字段
                'author' => $authorName, // 添加作者昵称字段
            ];
            // 文章内容默认为空
            $content = '';
            // 检查是否已存在相同图片ID且未被删除的文章
            $query = $this->db->select()->from('table.contents')
                        ->join('table.fields', 'table.contents.cid = table.fields.cid')
                        ->where('table.fields.name = ?', 'Unsplash_ID')
                        ->where('table.fields.str_value = ?', $imageId)
                        ->where('table.contents.status = ?', 'publish');
            $existingPost = $this->db->fetchRow($query);
            if ($existingPost) {
                // 检查并更新标题、作者昵称和作者用户名 ID
                $updateFields = [];
                if ($existingPost['title'] !== $title) {
                    $updateFields['title'] = $title;
                    $latest = false;
                }
                // 更新自定义字段
                foreach ($fields as $name => $value) {
                    $existingField = $this->db->fetchRow($this->db->select()->from('table.fields')
                        ->where('cid = ?', $existingPost['cid'])
                        ->where('name = ?', $name));
                    if ($existingField['str_value'] !== $value) {
                        $this->db->query($this->db->update('table.fields')->rows([
                            'str_value' => $value
                        ])->where('cid = ?', $existingPost['cid'])->where('name = ?', $name));
                        $latest = false;
                    }
                }
                if (!empty($updateFields)) {
                    $this->db->query($this->db->update('table.contents')->rows(array_merge($updateFields, [
                        'modified' => time()
                    ]))->where('cid = ?', $existingPost['cid']));
                    $updated[] = '【'.$title.'】';
                }
            } else {
                // 插入新文章数据
                $this->db->query($this->db->insert('table.contents')->rows([
                    'title' => $title,
                    'text' => $content,
                    'authorId' => $authorId,
                    'type' => 'post',
                    'status' => 'publish',
                    'created' => time(),
                    'modified' => time(),
                    'allowComment' => 1,
                    'allowPing' => 1,
                    'allowFeed' => 1
                ]));
                // 获取插入文章的ID
                $postId = $this->db->fetchRow($this->db->select('MAX(cid) AS cid')->from('table.contents'))['cid'];
                // 更新 slug 字段为文章的 cid
                $this->db->query($this->db->update('table.contents')->rows([
                    'slug' => $postId
                ])->where('cid = ?', $postId));
                // 插入自定义字段
                foreach ($fields as $name => $value) {
                    $this->db->query($this->db->insert('table.fields')->rows([
                        'cid' => $postId,
                        'name' => $name,
                        'type' => 'str',
                        'str_value' => $value
                    ]));
                }
                // 将文章关联到指定分类
                $this->db->query($this->db->insert('table.relationships')->rows([
                    'cid' => $postId,
                    'mid' => $categoryId
                ]));
                // 更新分类的计数器
                $this->db->query('UPDATE ' . $this->db->getPrefix() . 'metas SET count = count + 1 WHERE mid = ' . $categoryId);
                $added[] = '【'.$title.'】';
                $latest = false;
            }
        }
        if ($latest) {
            echo '当前摄影作品已同步到最新。';
        } else {
            $messages = [];
            if (!empty($updated)) {
                $messages[] = implode('', $updated) . ' 等作品信息已更新。<br>';
            }
            if (!empty($added)) {
                $messages[] = implode('', $added) . ' 等作品已成功同步。';
            }
            if (empty($messages)) {
                $messages[] = '当前摄影作品已同步到最新。';
            } else {
                $messages[] = '当前，所有摄影作品已是最新。';
            }
            echo implode('', $messages);
        }
    }
    exit;
}

if (isset($_GET['refresh']) && $_GET['refresh'] == '1' && $accessKey) {
    // 生成新的相册内容
    ob_start();
    ?>
    <?php while($this->next()): ?>
    <div class="photo <?php if(!isMobile()){ ?>image-shadow blur<?php } ?>">
        <a data-fancybox="gallery" data-caption="<?php $this->title();?>&nbsp;&nbsp;&nbsp;&nbsp;<?php $this->date('M d, Y'); ?>&nbsp;&nbsp;&nbsp;&nbsp;©&nbsp;<?php if($this->fields->author){ $this->fields->author();}else{$this->author();}?>"  href="<?php $this->fields->photo();?>">
            <img src="<?php $this->fields->thumb();?>" />
        </a>
    </div>
    <?php endwhile; ?>
    <?php
    $newPhotos = ob_get_clean();
    echo $newPhotos;
    exit;
}