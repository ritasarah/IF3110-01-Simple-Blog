<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="description" content="Deskripsi Blog">
<meta name="author" content="Judul Blog">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary">
<meta name="twitter:site" content="omfgitsasalmon">
<meta name="twitter:title" content="Simple Blog">
<meta name="twitter:description" content="Deskripsi Blog">
<meta name="twitter:creator" content="Simple Blog">
<meta name="twitter:image:src" content="{{! TODO: ADD GRAVATAR URL HERE }}">

<meta property="og:type" content="article">
<meta property="og:title" content="Simple Blog">
<meta property="og:description" content="Deskripsi Blog">
<meta property="og:image" content="{{! TODO: ADD GRAVATAR URL HERE }}">
<meta property="og:site_name" content="Simple Blog">

<link rel="stylesheet" type="text/css" href="assets/css/screen.css" />
<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">

<!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php
$con=mysqli_connect("localhost", "root", "", "dataPost");
$postid = $_GET['postid'];
$result=mysqli_query($con,"SELECT * FROM posts WHERE PID=$postid");
$row = mysqli_fetch_array($result);
$Judul=$row['Judul'];
$Tanggal=$row['Tanggal'];
$Konten=$row['Konten'];

echo "<title>$Judul</title>" 
//onload"=loadComment($postid)";
?>

</head>

<body class="default" onload="getXmlHttpRequest2(); return false">
<div class="wrapper">


<nav class="nav">
    <a style="border:none;" id="logo" href="index.php"><h1>Simple<span>-</span>Blog</h1></a>
    <ul class="nav-primary">
        <li><a href="new_post.html">+ Tambah Post</a></li>
    </ul>
</nav>

<article class="art simple post">
    
    <header class="art-header">
        <div class="art-header-inner" style="margin-top: 0px; opacity: 1;">

<?php	
echo"	<time class=\"art-time\">$Tanggal</time>
            <h2 class=\"art-title\">$Judul</h2>
            <p class=\"art-subtitle\"></p>
        </div>
    </header>

    <div class=\"art-body\">
        <div class=\"art-body-inner\">
            <hr class=\"featured-article\" />
            <p>$Konten</p>"
?>
 
 <hr />
            
            <h2>Komentar</h2>

            <div id="contact-area">
                <form method="post" onsubmit="getXmlHttpRequest(); return false"> 
                    <label for="Nama">Nama:</label>
                    <input type="text" name="Nama" id="Nama">
        
                    <label for="Email">Email:</label>
                    <input type="text" name="Email" id="Email">
                    
                    <label for="Komentar" id="komen">Komentar:</label><br>
                    <textarea name="Komentar" rows="20" cols="20" id="Komentar"></textarea>

                    <input type="submit" name="submit" value="Kirim" class="submit-button">
                </form>
            </div>
            <ul class="art-list-body">
			<div id=komens>
			<!--<?php
			$resultc = mysqli_query($con,"SELECT * FROM komentar WHERE postid =".$postid." order by commentid desc");
			while($rowc = mysqli_fetch_array($resultc)){
				echo '
				<li class="art-list-item">
				<div class="art-list-item-title-and-time">
				<h2 class="art-list-title"><a href="post.php" >'.$rowc['Nama'].'</a></h2>
				<div class="art-list-time">'.$rowc['Tanggal'].'</div>
				</div>
				<p id="komen">'.$rowc['Komentar'].'</p>
				</li>
				';}
			?> -->
			</div> 
            </ul>
        </div>
    </div>

</article>

<footer class="footer">
    <div class="back-to-top"><a href="">Back to top</a></div>
    <!-- <div class="footer-nav"><p></p></div> -->
    <div class="psi">&Psi;</div>
    <aside class="offsite-links">
        Asisten IF3110 /
        <a class="rss-link" href="#rss">RSS</a> /
        <br>
        <a class="twitter-link" href="http://twitter.com/YoGiiSinaga">Yogi</a> /
        <a class="twitter-link" href="http://twitter.com/sonnylazuardi">Sonny</a> /
        <a class="twitter-link" href="http://twitter.com/fathanpranaya">Fathan</a> /
        <br>
        <a class="twitter-link" href="#">Renusa</a> /
        <a class="twitter-link" href="#">Kelvin</a> /
        <a class="twitter-link" href="#">Yanuar</a> /
        
    </aside>
</footer>

</div>

<script type="text/javascript" src="assets/js/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/fittext.js"></script>
<script type="text/javascript" src="assets/js/app.js"></script>
<script type="text/javascript" src="assets/js/respond.min.js"></script>
<script type="text/javascript" src="assets/js/functions.js"></script>
<script type="text/javascript">
function getXmlHttpRequest( ) {
if (validasiEmail(document.getElementById('Email').value)){
var xmlHttpObj;
if (window.XMLHttpRequest) {
	xmlHttpObj = new XMLHttpRequest( );
	} else {
		try {
			xmlHttpObj = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
			try {
				xmlHttpObj = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
				xmlHttpObj = false;
			}
		}
	}

var postid  = <?php echo $postid ; ?> 
var Nama=encodeURIComponent(document.getElementById('Nama').value);
var Email=encodeURIComponent(document.getElementById('Email').value);
var Komentar=encodeURIComponent(document.getElementById('Komentar').value);

xmlHttpObj.open("GET","submit_comment.php?nama="+Nama+"&email="+Email+"&komentar="+Komentar+"&postid="+postid,true);
xmlHttpObj.send(null);
xmlHttpObj.onreadystatechange= function(){
	if(xmlHttpObj.readyState==4 && xmlHttpObj.status==200){
		document.getElementById("komens").innerHTML=xmlHttpObj.responseText;
		alert("submitting");}}
}
		}

function getXmlHttpRequest2( ) {
var xmlHttpObj;
if (window.XMLHttpRequest) {
	xmlHttpObj = new XMLHttpRequest( );
	} else {
		try {
			xmlHttpObj = new ActiveXObject("Msxml2.XMLHTTP");
			} catch (e) {
			try {
				xmlHttpObj = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {
				xmlHttpObj = false;
			}
		}
	}

var postid  = <?php echo $postid ; ?> 

xmlHttpObj.open("GET","view_comment.php?postid="+postid,true);
xmlHttpObj.send(null);
xmlHttpObj.onreadystatechange= function(){
	if(xmlHttpObj.readyState==4 && xmlHttpObj.status==200){
		document.getElementById("komens").innerHTML=xmlHttpObj.responseText;}}
}

</script>
<script type="text/javascript">
  var ga_ua = '{{! TODO: ADD GOOGLE ANALYTICS UA HERE }}';

  (function(g,h,o,s,t,z){g.GoogleAnalyticsObject=s;g[s]||(g[s]=
      function(){(g[s].q=g[s].q||[]).push(arguments)});g[s].s=+new Date;
      t=h.createElement(o);z=h.getElementsByTagName(o)[0];
      t.src='//www.google-analytics.com/analytics.js';
      z.parentNode.insertBefore(t,z)}(window,document,'script','ga'));
      ga('create',ga_ua);ga('send','pageview');
</script>

</body>
</html>