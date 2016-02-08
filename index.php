<!DOCTYPE html>  
<html>
	<head>
		<meta charset="utf-8">
		<meta name="description" content="Анонимная интернет-песочница ICDID. Мысли, идеи, высказывания">
		<meta name="keywords" content="Система, публикации, ICDID, песочница, посты, не даю, пишу, интернет">
		<title>ICDID | Пишу - не даю</title>
		<script type="text/javascript" src="./jscripts/jQuery.js"></script>
		<script type="text/javascript" src="./jscripts/jQuery.DateFormat.js"></script>
		<script type="text/javascript" src="markitup/jquery.markitup.js"></script>
		<script type="text/javascript" src="markitup/sets/default/set.js"></script>
		<link rel="stylesheet" type="text/css" href="images/style.css" />
		<link rel="stylesheet" type="text/css" href="markitup/skins/markitup/style.css" />
		<link rel="stylesheet" type="text/css" href="markitup/sets/default/style.css" />
		<script type="text/javascript">
			var _gaq = _gaq || [];
			_gaq.push(['_setAccount', 'UA-24786294-3']);
			_gaq.push(['_trackPageview']);
			(function() {
				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
				ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
			})();
		</script>
	</head>
	<script>
		function HtmlEncode(val){
			return $("<div/>").text(val).html();
		}
		
		function showContent() {
			$.ajax({  
				url: "./scripts/posts.php",  
				cache: false,
				success: function(code){ 
					$("#wall").html(code);
				}
			});
		}
		
		function postInputFocusOut() {
			$("#post_input").attr("value", "Пиши тут...");
			$("#post_input").css({"color": "#999"});
			$("#name").attr("value", "Твой ник...");
		}
		$(document).ready(function () {
			$('#post_input').markItUp(mySettings);
				$("#name").focusin(function () {
					if ($("#name").attr("value") == "Твой ник...")
					{
						$("#name").attr("value", "");
					}
				});

				$("#name").focusout(function () {
					if ($("#name").attr("value") == "")
					{
						$("#name").attr("value", "Твой ник...");
					}
				});

				$("#post_input").focusin(function () {
					if ($("#post_input").attr("value") == "Пиши тут...")
					{
						$("#post_input").attr("value", "");
						$("#post_input").css({"color": "black"});
					}
				});

				$("#post_input").focusout(function () {

					if ($("#post_input").attr("value") == "")
					{
						postInputFocusOut();
					}
					else {
						$("#post_input").css({"color": "black"});
					}
				}); 
			showContent();
			//setInterval('showContent()', 1000);
			var pid = 0;
			$("#sendBtn").click(function() {
				var text = $("#post_input").val(); //HtmlEncode($("#post_input").val());
				var name = HtmlEncode($("#name").val());
				if (text.length <= 20) {
					alert('Ээй, публикация должна иметь хоть какой-то нормальный текст, а не банальный твит, ибо нехуй!');
				}
				else {
				if (name.length >= 10) {
					alert('Ээй, твой ник должен быть не более 10 символов, ибо нехуй!');
			
				} else {
				if (name == "Твой ник...") {
					name = "Anonymous";
					}
				//alert(text);
				var date = new Date();
				var dateTime = $.format.date(date, "dd-MM-yyyy hh:mm:ss");
				var post = '<div id = "post_'+pid+'" style = "opacity: 0; width: 800px; min-height: 70px; font-size: 12px; overflow: hidden;"><div style = "width: 800px; height: 8px; border: 1px dashed #999; border-style: dashed none none none;"></div><div style = "float: left; width: 120px; height: 70px; font-size: 15px; text-align: left; font-weight: bold; color: #4A0FF"><div style = "width: 120px; height: 20px; color: #4A00FF">&nbsp;'+name+'</div><div style = "width: 120px; height: 20px; font-weight: normal; color: #666; font-size: 10px;">&nbsp;'+dateTime+'</div></div><div style = "float: left; width: 5px; height: 70px; border: 1px solid #999; border-style: none solid none none;"></div><div style = "float: left; width: 15px; height: 70px;"></div><div style = "float: left; text-align: left; width: 650px; min-height: 70px;">'+text+'</div></div><div style = "width: 800px; height: 8px; border: 1px dashed #999; border-style: none none dashed none;"></div><div style = "width: 800px"><div style = "float: right; width: 675px; height: 5px;"></div></div><div style = "width: 800px"><div style = "float: right; width: 675px; height: 20px;"><textarea onclick = "alert('+"'В разработке...'"+')" style = "line-height: normal; font-family: tahoma, arial, verdana, sans-serif, Lucida Sans; font-size: 11px; border: 1px solid #999; width: 400px; height: 18px; color: #999; resize: none">Комментировать...</textarea></div></div><div style = "width: 800px"><div style = "float: right; width: 675px; height: 8px;"></div></div>';
				$("#wall").before(post);
				$("#post_"+pid).animate({"opacity": "1"});
				$.ajax({  
						url: "./scripts/sendPost.php?text="+text+"&author="+name,  
						cache: false 
					});
				pid++;
			}
			}
			});
		});
	</script>
	<body style = "padding: 0; margin: 0; font-family: tahoma, arial, verdana, sans-serif, Lucida Sans; font-size: 11px; background-attachment:fixed; background-color: black; background-image: url(./images/background.jpg); background-repeat: no-repeat; background-position: top;">
		<center>
			<div style = "width: 800px; overflow: auto; background-color: white; background-image: url(./images/workspace.png); box-shadow: 0px 0px 5px black; border: 1px solid #333">
			<div style = "width: 800px; height: 100px; line-height: 100px; background: url(./images/header.jpg); color: white; text-shadow: 0px 0px 3px black; font-family: Arial; font-size: 30px;">I.C.D.I.D. | Пишу - не даю</div>
			<div style = "width: 800px; height: 20px;"></div>
			<div style = "width: 800px; height: 22px;">
				<input type = "text" value = "Твой ник..." id = "name" style = "font-family: tahoma, arial, verdana, sans-serif, Lucida Sans; font-size: 11px; width: 798px; height: 20px; color: #999; border: 1px solid #999; resize: none; border-style: solid none solid none"></textarea>
			</div>
			<div style = "width: 800px; height: 1px;"></div>
			<div style = "width: 800px;">
				<textarea id = "post_input" style = "font-family: tahoma, arial, verdana, sans-serif, Lucida Sans; font-size: 11px; color: #999; border: 1px solid #999; resize: none; border-style: solid none solid none">Пиши тут...</textarea>
			</div>
			<div style = "width: 800px; height: 20px;"></div>
			<div style = "width: 800px; height: 32px;">
				<button id = "sendBtn" style = "width: 800px; height: 30px; cursor: pointer; background: black; color: white; border: 1px solid black;">Отправить</button><br>
			</div>
			<div style = "width: 800px; height: 20px;"></div>
			<div id = "wall"></div>
			</div>
        </center>
	</body>
</html>
