<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>聊天</title>
<script type="text/javascript" src="jquery-1.10.1.min.js"></script>
<script>
$(function(){

var chat = {
	init:function(){
		chat.first();
		$('#chat_btn').unbind('click').click(function(){
			chat.send();
		});
		$('#my_chat').keyup(function(){
			if(event.keyCode == 13){
				chat.send();
			}
		});
	},
	first:function(){
		$.getJSON('data.php',{
			action:'first',
			type:'l'
		},function(data){
			console.log(data);
			chat.btn_status._true();
			$('#mwebtime').html(data.time);
			$('#chat textarea').val(data.chat);
			$('#chat textarea').stop(true,true).animate({scrollTop:9999}, 1);
			chat.socket();
		});
	},
	send:function(){
		chat.btn_status._false();
		$.getJSON('send.php',{
			txt:$('#my_chat').val(),
			type:'l'
		},function(data){
			if(data.status==200){
				chat.btn_status._false();
				$('#my_chat').val('');
				setTimeout(function(){
					chat.btn_status._true();
				},2000);
			}
		});
	},
	socket:function(){
		$.getJSON('data.php',{
			action:'while',
			type:'l'
		},function(data){
			console.log(data);
			$('#mwebtime').html(data.time);
			$('#chat textarea').val(data.chat);
			$('#chat textarea').stop(true,true).animate({scrollTop:9999}, 1); 
			chat.socket();
		});
	},
	btn_status:{
		_false:function(){
			$('#chat_btn').html('等待').attr('disabled',true);
		},
		_true:function(){
			$('#chat_btn').html('發言').attr('disabled',false);
		}
	}
}

chat.init();
});

</script>
</head>
 
<body>
<div id="chat">
	<textarea wrap="physical" style="line-height:20px;font-size:12px;height:100px;width:200px;"></textarea>
	<BR />
	<input id="my_chat" type="text" />
	<button id="chat_btn" disabled="disabled">發言</button>
</div>
<div id="mwebtime"></div>
</body>
</html>