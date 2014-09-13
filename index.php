
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset='utf-8'">
<meta http-equiv="Content-Language" content="pl">
<link rel="shortcut icon" href="http://www.technikum.sci.edu.pl/plan/images/plan_logo.gif">
<title>OptivumToSQL - Parser planów lekcji </title>
<style>

#top_bar {
	background:rgba(79, 106, 192, 1);
	height:100px;
	color:white;
	font-size:56px;
	margin:0 auto;
	text-align:center;
	width:100%;
}
body {
height:100%;
width:100%;
background:#FAFAFA;
}
input[type=submit]{
background:rgba(70, 106, 192, 1);
color:white;
}
	
	#over {
		width:700px;
		margin: 0 auto;
		outline: 1px solid silver;
		min-height:500px;
		position:relative;
		text-align:center;
		font-family:verdana,sans-serif;
		margin-top:100px;
		background:white;
		outline:1px solid silver;
	}
	
	#bottom {
	bottom:15px;
	right:15px;
	position:absolute;
		padding:0;
	}
	
	#footer {
	bottom:15px;
	left:15px;
	position:absolute;
	padding:0;
	font-size:14px;
	
	}
	.blue {
	color:	rgba(79, 106, 192, 1);
	}
	.red {
	color: #FA5858;
	}
	a.visited {
	color : rgba(79, 106, 192, 1);
	}
	a {
	color: rgba(79, 106, 192, 1);
	}
	a:hover {
	text-decoration:underline;
	}
	</style>
</head>
<body>



<div id='over'>
<div id='top_bar'>
OptivumToSQL
</div>

<?php
require_once "config.php";

require_once "bin/class.php";

$con = db_check();
if($con==false){echo '<span class="red">Błąd połączenia z bazą danych.<br/> Dokonaj poprawy w pliku <u>config.php</u></span>';exit();
}

table_check($con);



if(isSet($_POST['parse'])){
if(!filter_var($_POST['parse'], FILTER_VALIDATE_URL)){
echo "<span class='red'>Błędny URL.</span><br/> Poprawny format: <u>http://serwer/plan/</u> / <u>http://serwer/plan/index.html</u><br/><a href='index.php'>Powrót</a><br/><br/><br/>";
}
if($_POST['pass']==$pass){
exportToMySQL(parseToSql($_POST['parse']),$con);
}else{echo "<span class='red'>Błąd autoryzacji.</span><br/><a href='index.php'>Powrót</a>";}

}else{
?>

<table style='width:350px; margin-top:100px;display:inline-block;'>
<tr><td><form action='index.php' method='POST'>
URL do Planu</td><td><input type='text' name='parse' value="<?php echo $dir;?>" placeholder="http://host/plan/index.html"/></td></tr>
<tr><td>Hasło dostępu</td><td><input type='password' name='pass' /></td>
<tr><td></td><td><input type='submit' value='Exportuj do MySQL'/></td></tr>
</form>

<?php
}





?>

<div id='bottom'>v.0.3 <img src='http://www.technikum.sci.edu.pl/plan/images/plan_logo.gif' alt="Optivum Logo"/></div>
<div id="footer"><a href='https://github.com/Worie/OptivumToSQL'><img src='https://github.global.ssl.fastly.net/images/modules/logos_page/GitHub-Mark.png'style='width:50px;height:50px;' alt='View on GitHub'/></a><a href='README.txt'>readme</a></div>
</div>
</body>
</html>
