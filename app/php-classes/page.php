<?php
class page extends Engine{
	
	public function news_get_content(){
        if(isset($_GET['page'])){
            $page = $_GET['page'] - 1;
        }else{
            $page = 0;
        }
        $table_data = array(
        'table' => 'news_posts',
        'order_by' => 'post_date',
        'limit' => 30,
        'offset' => $page
        );
        
        $list = $this->get_news($table_data['table'], $table_data['order_by'], $table_data['limit'], $table_data['offset']);
        
        include('template-parts/content.php');
	}
}
?>
