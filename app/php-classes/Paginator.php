<?php
class Paginator {
    
    public $total_rows;
    public $items_per_page;
    public $current_page;
    public $start;
    public $limit;
    
    /*function __construct($total_rows,$items_per_page,$current_page){
        $this->total_rows = $total_rows;
        $this->items_per_page = $items_per_page;
        $this->current_page = $current_page;
        $data = $this->get_paging_info($this->total_rows,$this->items_per_page,$this->current_page);
    }*/
    
    public function get_paging_info($tot_rows,$pp,$curr_page)
    {
        $pages = ceil($tot_rows / $pp);

        $data = array();
        $data['si']        = ($curr_page * $pp) - $pp;
        $data['pages']     = $pages;                  
        $data['curr_page'] = $curr_page;               

        return $data;

    }
    
    public function build_pagination($start, $limit, $table_name,$get_name='id'){
        
        $this->limit = $limit;
        
        if(isset($_GET[$get_name])){
            $id = $_GET[$get_name];
            $start = ($id-1) * $this->limit;
            $this->start = $start;
        }
        
        $page_db_connector = new admin_page;
        
        $result = $page_db_connector->news_sql_query('SELECT * FROM '.$table_name.' LIMIT '.$this->start.', '.$this->limit); 
        echo '<div class="paginatorWrapper">';
        echo '<div class="paginator_content">';
            echo '<table>';
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>post name</th>";
                echo "<th>publish date</th>";
                echo "<th>author</th>";
                echo "<th>comments</th>";
                echo "<th>Editing</th>";
                echo "<th>Removing</th>";
                echo "</tr>";
            while($rows=$result->fetch(PDO::FETCH_ASSOC)){
                echo "<tr>";
                echo "<td>".$rows['id']."</td>";
                echo "<td>".$rows['post_title']."</td>";
                echo "<td>".date_format(date_create($rows['post_date']),'d.m.Y')."</td>";
                echo "<td>".$rows['post_author']."</td>";
                echo "<td> <span class='count_comm'>".$rows['post_commentary_count']."</span></td>";
                echo "<td><a href='?side=posts&id=".$_GET['id']."&edit=".$rows['id']."'>Ред.</a></td>";
                echo "<td><a href='?side=posts&id=".$_GET['id']."&del=".$rows['id']."'>Вид.</a></td>";
                echo "</tr>";
            }
            echo '</table>'; 
        echo '</div>';
        
        $result_count = $page_db_connector->news_sql_query('SELECT * FROM '.$table_name);
        
        $rowk=$result_count->rowCount();
        $total=ceil($rowk/$limit);
        echo '<div class="paginator">';
        if($id>1)
        {
        echo "<a href='?side=posts&".$get_name."=".($id-1)."' class='button prev'>&lt;</a>";
        }else{
            echo "<li class='disable left'>&lt;</li>";
        }
        if($id!=$total)
        {
        echo "<a href='?side=posts&".$get_name."=".($id+1)."' class='button next'>&gt;</a>";
        }
        else{
        echo "<li class='disable right'>&gt;</li>";
        }

        echo "<ul class='pagination'>";
            for($i=1;$i<=$total;$i++)
            {
                if($i==$id) { echo "<li class='current'>".$i."</li>"; }

                else { 
                    echo "<li><a href='?side=posts&".$get_name."=".$i."'>".$i."</a></li>"; 
                }
            }
        echo "</ul>";
        echo '</div>';
        echo '</div>';
        }
}



?>
