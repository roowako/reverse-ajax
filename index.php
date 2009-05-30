<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Reverse Ajax Sample</title>
		<script src="jquery-1.3.2.min.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript" charset="utf-8">
			Comet = {
				connect: function() {
					return $.ajax({
						url: 'bind.php',
						type: 'POST',
						success: function(evt, request) {
							$("#destiny-area").prepend(evt + "<br />");
						},
						complete: function() {
							Comet.connect();
						}
					});
				},
				
				send: function(text) {
					$.post("create.php", {text: text});
				}
			}
			
			$(document).ready(function() {
				$("#sender-button").click(function() {
					var content = $("#source-area").val();
					$("#source-area").val('');
					
					Comet.send(content);
				})
				
				$("#source-area").keyup(function(evt) {
					if (evt.keyCode == 13) {
						var content = $("#source-area").val();
						$("#source-area").val('');
						
						Comet.send(content);
					}
				});
				
				Comet.connect();
			});
		</script>
	</head>
	<body>
		<textarea style="width:200px;height:120px" id="source-area"></textarea><br />
		<button type="button" id="sender-button">Send</button><br />
		<div id="destiny-area"></div>
	</body>
</html>