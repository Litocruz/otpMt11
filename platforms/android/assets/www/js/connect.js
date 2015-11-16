function connect(e) 
{ 
	var term= {button:e}; 
	$.ajax({ 
		url:'http://192.168.1.79/reply.php', 
		type:'POST', 
		data:term, 
		dataType:'json', 
		error:function(jqXHR,text_status,strError){ 
		alert("no connection");}, 
		timeout:60000, 
		success:function(data){ 
			$("#result").html(""); 
			for(var i in data){ 
				$("#result").append("<li>"+data[i]+"</li>"); 
			} 
		} 
	});
} 
