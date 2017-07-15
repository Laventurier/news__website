<?php if(isset($list['news'])): ?>

<div id="page-main">
    <div class="container">
        <?php foreach($list['news'] as $value): ?>
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
<!--
        <?php if(isset($list['count'])): ?>
        <?php $count = ceil($list['count']/$table_data['limit']); ?>
        <div class="pagination-wrapper">
            <ul class="pagination">
              <?php if($page==0): ?>
              <li><img src="img/left-arrow.svg" alt="left_arrow"></li>
              <?php else: ?>
              <li><a href="?page=<?php echo $value = $page;  ?>"><img src="img/left-arrow.svg" alt="left_arrow"></a></li>
              <?php endif; ?>
               
                <?php for($i = 0; $i < $count; $i++): ?>
                <li>
                    <?php if($i == $page): ?>
                    <span><?php echo $i+1 ?></span>
                    <?php else: ?>
                    <a href="?page=<?php echo $i+1 ?>">
                        <?php echo $i+1; ?>
                    </a>
                    <?php endif; ?>
                </li>
                <?php endfor;?>
            <?php  if($page==$list['count'] - 1): ?>
               <li><img src="img/right-arrow.svg" alt="right_arrow"></li>
              <?php else: ?>
               <li><a href="?page=<?php echo $value = $page + 2; ?>"><img src="img/right-arrow.svg" alt="right_arrow"></a></li>
              <?php endif; ?>
               
            </ul>
        </div>
        <?php endif;?>
-->
    </div>
</div>
<?php endif; ?>
