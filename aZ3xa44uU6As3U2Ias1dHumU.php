<!DOCTYPE html>
<html>
	<head>
		<title>SITI KHODIJAH SAJOETI</title>
	</head>
	<style type="text/css">
		td, th {
			max-width: 315px;
			overflow: hidden;
		}
		.wrapper {
			overflow: auto;
			border: 1px solid;
			font-family: arial;
			min-width: 700px;
			width: fit-content;
			margin: auto;
		}
		tbody {
			border: 10px solid #000
		}
		section {
			margin: 5px;
		}
		h1 {
			margin: 10px 0px 10px 0px;
			text-align: center;
		}
		nav {
			text-align: center;
			border: 1px solid;padding: 5px
		}
		.kanan {
			float: right;width: 198px;
			border: 1px solid;
		} .kiri {
			float: left;width:72%;border: 1px solid;width:565px;
		} article {
			margin: 5px;
		} footer {
			border: 1px solid;
			padding: 5px; text-align: center;
			clear: both;
		} a {
			color: blue;text-decoration: none;cursor: pointer;
		} a:hover {
			text-decoration: underline;
		}
	</style>
	<body>
		<div class="wrapper">
			<section>
				<header>
					<h1>SITI KHODIJAH SAJOETI</h1>
					<nav>
						Portal Yayasan Siti Khodijah Sajoeti
					</nav>
				</header>
				<aside class="kanan">
					<article>
						<?php include "kanan.php" ?>
					</article>
				</aside>
				<aside class="kiri">
					<article>
						<?php include "kiri.php" ?>
					</article>
				</aside>
				<footer>Copyright &copy 2016 Yayasan Siti Khodijah Sajoeti</footer>
			</section>
		</div>
		<script type="text/javascript">
			try{document.getElementsByTagName("form")[0].setAttribute("autocomplete","off");}catch(e){}
		</script>
	</body>
</html>