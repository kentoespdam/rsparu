<html>
    <head>
	  <title>IO Chat</title>
	  <!--<link href="//localhost/iochat/asset/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>-->
	  <script src="//localhost/rsparu/asset/bower_components/jquery/dist/jquery.min.js" type="text/javascript"></script>
	  <script src="//localhost/rsparu/asset/websocket/node_modules/socket.io-client/dist/socket.io.js" type="text/javascript"></script>
	  <style>
		body{
		    margin-top: 30px;
		}

		#messageArea{
		    display: none;
		}
	  </style>
    </head>
    <body>
	  <form id="messageForm">
		<input id="message">
		<br>
		<button id="sumbit-btn">SEND</button>
	  </form>
    </body>
    <script>
	  $(function () {
		var socket = io('//11.11.11.1:3000');
		var $messageForm = $('#messageForm');
		var $message = $('#message');

		$messageForm.submit(function (e) {
		    e.preventDefault();
		    console.log('submited');
		    socket.emit('panggil', $message.val());
		    $message.val('');
		});
	  });
    </script>
</html>