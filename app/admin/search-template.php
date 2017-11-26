<?php $i=0; while($rows = $search_res->fetch(PDO::FETCH_ASSOC)): ?>
<?php $search_array['search_query'][] = $rows; ?>
<div class="search-item">
    <div class="search-item-title">
        <a href="?side=posts&edit=<?php echo $search_array['search_query'][$i]['id']; ?>">
            <?php echo $search_array['search_query'][$i]['post_title']; ?>
        </a>
    </div>
    <div class="search-item-descr">
        <p>
            <?php echo $search_array['search_query'][$i]['post_description']; ?>
        </p>
    </div>
</div>
<?php $i++; endwhile;?>
