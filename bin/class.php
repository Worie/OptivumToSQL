<?php

/*
* OptivumToSQL - parser planów lekcji Vulcan Optivum
* * Autor Wojciech Połowniak
* * https://github.com/Worie/OptivumToSQL
*/


require_once "config.php";

function getDay($num){
	switch($num){
		case 0: $v='Poniedziałek'; break;
		case 1: $v='Wtorek'; break;
		case 2: $v='Środa'; break;
		case 3: $v='Czwartek'; break;
		case 4: $v='Piątek'; break;
	}
	return $v;
}

function db_check(){
include "config.php";
$con = mysql_connect($database_host, $database_user, $database_pass);
mysql_query("SET NAMES UTF8",$con);
if(!mysql_select_db($database,$con)){return false;}else{return $con;}
}


// Check if tables are already created in MySQL Database
// If not, create them

function table_check($con){
if(!mysql_query('SELECT * FROM otsql_plan LIMIT 1',$con)){

if(mysql_query('CREATE TABLE otsql_plan (
lekcja INTEGER,
przedmiot VARCHAR(30),
nauczyciel VARCHAR(30),
sala VARCHAR(10),
klasa VARCHAR(5),
dzien VARCHAR(15)
);',$con)){
echo "Utworzono tabele<br/>";}else{echo "SQL error<br/>";mysql_error();}
}

}



function parseToSql($dir){

	$row= array();

	
	
	if(strpos($dir,'index.html')>-1){$dir = str_replace('index.html','',$dir);}
	
	$list = file_get_contents($dir.'lista.html');
	$a = strpos($list,'<ul>');
	$b = strpos($list,'</ul>');
	$sub = substr($list,$a,$b-$a);
	$first_for_limit =substr_count($sub,'target')+1;
	
	
	for($z=0;$z<$first_for_limit;$z++){

	$content = file_get_contents($dir.'plany/o'.($z+1).'.html');

					
		$var = '<title>';
		$a = strpos($content,$var);
		$b = strpos($content,'</title>',$a+strlen($var));
		
		$klasa = substr($content,$a+strlen($var),$b-$a-strlen($var));
		$klasa=$klasa[strlen($klasa)-2].$klasa[strlen($klasa)-1];

		$var = "tek</th>";
		
		$a = strpos($content,$var,0);
		$a = strpos($content,'</tr>',$a);
		//echo $content;
		//echo $a;
		$b = strpos($content,'</table>',$a);
//echo $a.":".$b;
		
		$sub = substr($content,$a+5,$b-$a);
	//echo $sub;	
		$start = 0;
		for($i=0;$i<10;$i++){
		
			$a=strpos($sub,'</tr>',$start);
			$minisub = substr($sub,$start,$a+strlen('</tr>')-$start);
			$start = $a+strlen('</tr>');
			
		
			
			// found a number
			$q = strpos($minisub,'nr">');
			$w = strpos($minisub,'<',$q);
			$nr = substr($minisub,$q+4,$w-$q-4);
			
			$start1 = 0;
			for($j=0;$j<5;$j++){
				$q = strpos($minisub,'l">',$start1); // 6
				$w = strpos($minisub,'</td',$q+3); //
							$start1=$w+5;


				// Cały wiersz
				$v = substr($minisub,$q+3,$w-$q-3);
				if($v=='&nbsp;'){continue;}
				
				// Wyciągnij przedmiot
				$q = strpos($v,'p">');
				$w = strpos($v,'<',$q+3);
				$przedmiot = substr($v,$q+3,$w-$q-3);
							
				// Wyciągnij nauczyciela
							
				$q = strpos($v,'n">');
				$w = strpos($v,'<',$q+3);
				$nauczyciel = substr($v,$q+3,$w-$q-3);
							
				// Wyciągnij salę
				
				$q = strpos($v,'s">');
				$w = strpos($v,'<',$q+3);
				$sala = substr($v,$q+3,$w-$q-3);
				

				$record = array();
				$record['nr']=$nr;
				$record['przedmiot']=$przedmiot;
				$record['nauczyciel']=$nauczyciel;
				$record['sala']=$sala;
				$record['klasa']=$klasa;
				$record['dzien']=getDay($j);

				$row[]= $record;
				
			}
		}
			
	}
	
	return $row;
		
}
function exportToMySQL($row,$con){

mysql_query("DELETE FROM otsql_plan WHERE 1=1",$con);

	for($i=0;$i<count($row);$i++){
		mysql_query("INSERT INTO otsql_plan VALUES ('".$row[$i]['nr']."','".$row[$i]['przedmiot']."','".$row[$i]['nauczyciel']."','".$row[$i]['sala']."','".$row[$i]['klasa']."','".$row[$i]['dzien']."')",$con);
		
		//echo "INSERT INTO otsql_plan VALUES ('".$row[$i]['nr']."','".$row[$i]['przedmiot']."','".$row[$i]['nauczyciel']."','".$row[$i]['sala']."','".$row[$i]['klasa']."','".$row[$i]['dzien']."')<br/><br/>";
	}

	mysql_query("DELETE FROM otsql_plan WHERE przedmiot IS NULL OR przedmiot LIKE ''",$con);

	echo "<div class='blue' style='padding-top:100px;'>Wyeksportowano do SQL</div><br/><a href='index.php'>Powrót</a>";


}

?>
