<div id="page-main">
    <div class="container">
        <div class="data">
            <?php if(isset($tmp_arr)): ?>
            <?php foreach($tmp_arr as $value): ?>
            <article id="post-<?php echo $value['id'] ?>" class="category-<?php echo $value['post_category'] ?>">
                <h2>
                    <a href="?option=page_view&post=<?php echo $value['id'] ?>">
                        <?php echo $value['post_title'] ?>
                    </a>
                </h2>
                <div class="clearfix">
                    <div class="article-img">
                        <img src="<?php echo $value['post_image'] ?>" alt="<?php echo $value['post_image'] ?>">
                    </div>
                    <div class="article-description">
                        <p>
                            <?php echo $value['post_description'] ?>
                        </p>
                    </div>
                </div>
                <div class="article-info clearfix">
                    <p>
                        <span class="article-more"><a href="?option=page_view&post=<?php echo $value['id'] ?>">Читати більше...</a></span>
                        <span class="article-time"><?php echo date("d.m.Y", strtotime($value['post_date'])) ?></span>
                        <span class="article-author">Автор: <b><?php echo $value['post_author'] ?></b></span>
                        <span class="article-commentary-count"><img src="img/chat.svg" width="10" height="10" alt="chat"> <b><?php echo $value['post_commentary_count'] ?></b></span>
                    </p>
                </div>
            </article>
            <?php endforeach; ?>
            <?php  endif; ?>
        </div>
    </div>
</div>
