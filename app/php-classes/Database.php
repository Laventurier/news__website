<?php 
class Database{
    
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
		public function news_sql_execution($news_query){
			$result = $this->data_b->exec($news_query);
			return $result;
		}
    public function news_sql_query($news_query){
        $result = $this->data_b->query($news_query);
        return $result;
    }
}

?>
