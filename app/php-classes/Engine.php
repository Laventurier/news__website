<?php
	abstract class Engine{
		
		protected $data_b;
		
		public function __construct(){
			$this->data_b = new PDO('mysql:host='.host.';dbname='.database.';charset=utf8', user, password);
			$this->data_b->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->data_b->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		
			if(!$this->data_b){
				exit('<p>Помилка з\'єднання з базою даних'.mysqli_error().'</p>');
			}
			$this->news_sql_execution('SET NAMES "UTF8"');
		}
		
		public function news_get_header(){
			$table = $this->select_('news_category');
            include('header.php');			        
		}
		
		public function news_get_footer(){
			include('footer.php');
		}
		
		public function news_sql_execution($news_query){
			$result = $this->data_b->exec($news_query);
			return $result;
		}
		
        public function select_($table){
            $sql = 'SELECT * FROM '.$table.' ORDER BY position';
            
            try{
                $result = $this->news_sql_query($sql);
                if($result->rowCount()>0){
                    $tab = array();
                    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $tab['categories'][] = $row;
                    }
                    return $tab;
                }    
            }catch(Exception $error){
                print('<div class="container"><p class="error-msg">'.$error->getMessage().'</p></div>');
            }
        }
        
		public function news_sql_query($news_query){
			$result = $this->data_b->query($news_query);
			return $result;
		}
		
		public function news_get_template(){
			$this->news_get_header();
			$this->news_get_content();
			$this->news_get_footer();
		}
		public function get_news($table, $order, $limit = 30 , $offset = 0){
            try{
                $sql = "SELECT * FROM ".$table." ORDER BY ".$order." desc LIMIT ".$limit." OFFSET ".$offset;
                $result = $this->news_sql_query($sql);
                
                if($result->rowCount()>0){
                    $news_array = array();
                    while($row = $result->fetch(PDO::FETCH_ASSOC)){
                        $news_array['news'][] = $row;
                    }
                    
                    $sql_ = "SELECT COUNT(*) FROM ".$table;
                    $result_ = $this->news_sql_query($sql_)->fetchColumn(); 
                    
                    $news_array['count'] = $result_;
                    
                    return $news_array;
                }
                
            }catch(Exception $error){
                print('<div class="container"><p class="error-msg">'.$error->getMessage().'</p></div>');
            }

            
        }
		abstract function news_get_content();
	}
?>
