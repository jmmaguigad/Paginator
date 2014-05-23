<?php
/*
 * This script gives a delightful taste of a nice pagination outlook;nicer, more complex, easier and more robust 
 * This is an easy to use script because all methods were within a single class; all you gotta do is to call it... 
 * Usage of the script is discuss below:
 * @Sample use of the script:
 *   $paginate->new Paginate();
 *   $paginate->getSQL( $sql );
 *   $paginate->getPagerName( $pagername );
 *	echo $page->displayUpper();
 *	echo $page->fetchPaginatedData();
 *	echo $page->displayLower(); 
 *The HTML part could be modified by just modifying the fetchPaginatedData method
 * @author JOHN MANUEL M. MAGUIGAD <ljmmaguigad28@gmail.com>
 * @title PDO PAGINATOR CLASS
 * @written May 14, 2014
 */
class Paginate {
	private 
/*
 * use to get instance of the class db
 */
			$_db,  
/*
 * use to get sql string
 */
			$_sql,
/*
 * stands for the pager name
 */
			$_pager,
/*
 * stands for the limit value
 */
			$_limit = 2,
/*
 * stands for the connection
 */
			$_connection,
/*
 * stands for the sql result total
 */
			$_sqlresult,			
/*
 * stands for the offset value
 */
			$_reach = 5;	
/*
 * where it all started;connection
 */			
	public function __construct() {
		try{
			$this->_connection = new PDO('mysql:host=hostname;dbname=dbname','username','password');
		}catch(PDOException $e){
			die($e->getMessage());
		}
	}
/*
 * get the sql and checking if its valid or not	
 */
	public function getSQL($sql) {
        if (mb_strlen($sql)<= 0) {
            throw new Exception('There was a problem in your pager value. It must be a valid sql string.');
        } 
        $this->_sql = $sql;
	}
	private function getSequel() {
		return $this->_sql;
	}		
/*
 * getting the pager name
 */
	public function getPagerName($pager) {
		if (!is_string($pager)) {
			throw new Exception('There was a problem in your pager value. It must be in a string form.');
		}
		$this->_pager = $pager;
	}	
	private function returnPager() {
		return $this->_pager;
	}

    private function getPager() {
         return ( isset ( $_REQUEST["{$this->_pager}"] ) )  
                ? (int) $_REQUEST["{$this->_pager}"]  
                : 0 
        ;  
        
    }	
/*
 * the backups...
 * returning the value of $_limit
 * returning the value of $_offset
 * returning the value of $_reach
 */
	private function getLimit() {
		return $this->_limit;
	}	
	private function getOffset() {
		$current = $this->getCurrentResult();
		$limit = $this->getLimit();
		$offset = (($current - 1)*$limit);
		return (int) $offset;
	}
	private function getReach() {
		return $this->_reach;
	}
	
/*
 * getting the sql with limit and offset
 * process genSQL
 */
	private function genSQL() {
		$limitation = $this->getLimit();
		$offsetting = $this->getOffset();
		
		return $this->_sql. " LIMIT {$limitation} OFFSET {$offsetting}";		
	}
	private function processgenSQL () {
		return $this->_connection->query($this->genSQL());
	}
/*
 * getting the total number of values 
 * fetch with the use of the sql provided
 */ 
	private function getResult() {
		$result = $this->_connection->query(
					strtolower(str_ireplace('*','COUNT(*)',$this->_sql)));
		return $this->_sqlresult = $result;
	}

/*
 * getting the result of the sql processed
*/
	private function getResultProvided() {
		$sql = $this->getResult()->fetchColumn();
		return (int) $sql;
	}

/*
 * to display the information about the pagination and its navigation menu
*/
	public function displayUpper() {
		$totalresult = $this->getResultProvided(); 
		if ($totalresult > 0) {
			$currentpage = $this->getCurrentResult();//current page
			$totalpage = $this->getTotalPage();//total page
			//total result
			echo "<div>Showing the page {$currentpage} of {$totalpage} available pages for {$totalresult} results.</div>";
		}else{
			echo "<div>No records fetched.</div>";
		}
	}
	
	public function displayLower() {
		$totalresult = $this->getResultProvided();
		$currentpage = $this->getCurrentResult();
		$totalpage = $this->getTotalPage();
		$reach = $this->getReach();
		$paginator = $this->returnPager();
		
		if ($totalresult > 0) {
			echo '<div class="paginate">';
			if ($currentpage > 1) {
				$previous = $currentpage - 1;
				echo " <a href='{$_SERVER['PHP_SELF']}?{$paginator}=1'><span>First</span></a> 
					<a href='{$_SERVER['PHP_SELF']}?{$paginator}={$previous}'><span>Previous</span></a> ";
			}
			for ($p = ($currentpage - $reach); $p < (($currentpage + $reach) + 1); $p++) {
				if (($p > 0) && ($p <= $totalpage)) {
					if ($p == $currentpage) {
						echo "[<span>{$p}</span>]";
					} else {
						echo " <a href='{$_SERVER['PHP_SELF']}?{$paginator}={$p}'><span>{$p}</span></a> ";
					}
				}
			}
			if ($currentpage != $totalpage) {
				$nextpage = $currentpage + 1; 
				echo " <a href='{$_SERVER['PHP_SELF']}?{$paginator}={$nextpage}'><span>Next</span></a> 
					<a href='{$_SERVER['PHP_SELF']}?{$paginator}={$totalpage}'><span>Last</span></a> ";
			}
			echo '</div>';	
		}		
	}
	
	private function getCurrentResult() {
		$total = $this->getResultProvided();
		$page = (int) $this->getpager();
		
		if (isset($page)) {
			$currentpage = $page;
		}else{
			$currentpage = 1;
		}
		
		if ($page > $total) {
			$currentpage = $total;
		}
		
		if ($page < 1) {
			$currentpage = 1;
		}
		return $currentpage;
	}
	
	private function getTotalPage() {
		$limit = $this->getLimit();
		$total = $this->getResultProvided();
		$totalpage = ceil($total / $limit);
		return (int) $totalpage;
	}
	
	public function fetchPaginatedData() {
		$totalresult = $this->getResultProvided(); 
		if ($totalresult > 0) {
			$fetch = $this->processgenSQL();
			echo '<table>
					<thead>
					<tr>
						<td>Name</td>
						<td>Username</td>
						<td>Password</td>
					</tr>
					</thead>
					<tbody>';
			foreach ($fetch as $fe) {
				$name = $fe['name'];
				$username = $fe['username'];
				$password = $fe['password'];
				echo "<tr>
						<td>{$name}</td>
						<td>{$username}</td>
						<td>{$password}</td>
					</tr>";
			}
			echo '</tbody></table>';
		}
	}
}