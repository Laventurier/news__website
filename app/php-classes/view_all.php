<div id="page-view">
    <div class="container">
        <div id="post-<?php echo $post_content['id']; ?>">
            <h1 class="category-title">
                <?php echo $post_content['post_title']; ?>
            </h1>
            <div class="post-date">
                <?php echo $post_content['post_date']; ?>
            </div>
            <div class="post-content">
                <?php echo $post_content['post_content']; ?>
            </div>
            <div class="post-author">
                <?php echo $post_content['post_author']; ?>
            </div>
            <div class="post-img">
                <div class="post-inner-img">
                    <img src="<?php echo $post_content['post_image'];  ?>" alt="<?php echo $post_content['post_title']; ?>">
                </div>
            </div>
        </div>
        <?php  require_once('commentaries_list.php'); ?>
    </div>
</div>
