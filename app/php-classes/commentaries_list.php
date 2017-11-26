<div class="cleafix commentary-form">
    <h2>Коментувати</h2>
    <form action="" method="post">
        <p>
            <?php if(isset($_SESSION['author_error'])): ?>
            <span><?php echo $_SESSION['author_error']; ?></span>
            <?php unset($_SESSION['author_error']); endif; ?>
            <input type="text" name="author" placeholder="Ім'я" value="<?php echo $_POST[" author "]; ?>">

        </p>
        <p>
            <?php if(isset($_SESSION['email_error'])): ?>
            <span><?php echo $_SESSION['email_error']; ?></span>
            <?php unset($_SESSION['email_error']); endif; ?>
            <input type="text" name="email" placeholder="Email" value="<?php echo $_POST[" email "]; ?>">

        </p>
        <p>
            <?php if(isset($_SESSION['commentary_error'])): ?>
            <span><?php echo $_SESSION['commentary_error']; ?></span>
            <?php unset($_SESSION['commentary_error']); endif; ?>
            <textarea name="comment" placeholder="Прокоментувати" value="<?php echo $_POST[" comment "]; ?>"></textarea>

        </p>
        <p>
            <input type="submit" name="submit_comm" value="Прокоментувати">
        </p>
    </form>
    <?php  if(isset($post_comments)):?>
    <div class="commentary-list">
        <?php  foreach($post_comments as $key => $val): ?>
        <div class="user_comm">
            <div class="comm-item">
                <div class="user_img">
                    <img src="img/user.svg" alt="user">
                </div>
                <div class="user_descr">
                    <p>
                        <?php echo $val['comm_text']; ?>
                    </p>
                    <div class="user_author">
                        <div class="au_name">
                            <?php echo $val['comm_author']; ?>
                        </div>
                        <div class="au_date">
                            <?php echo $val['time_']; ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
