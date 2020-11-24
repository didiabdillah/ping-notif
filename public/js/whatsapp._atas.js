var express = require('express')();
var fs  	= require('fs');
var pkey 	= fs.readFileSync('C:/xampp/apache/crt/jember.webgis.my.id/server.key');
var pcert 	= fs.readFileSync('C:/xampp/apache/crt/jember.webgis.my.id/server.crt');
var options 	= {
   			key: pkey,
   			cert: pcert
		};
var server  	= require('https').createServer(options),
    io         = require('socket.io')(server),
    logger     = require('winston'),
    port       = 8443;
    const  { Client }           = require('whatsapp-web.js');
// Logger config
logger.remove(logger.transports.Console);
logger.add(logger.transports.Console, { colorize: true, timestamp: true });
logger.info('SocketIO > listening on port ' + port);

io.on('connection', function (socket){
socket.on('action', function (datawa) 
 		{
 				console.log('koneksi');
 				var number_phone 	= datawa.number_phone;
				var message 		= datawa.message;
				var sessionData  	=JSON.parse(datawa.session_wa); 
				var client_2    	= new Client({session:sessionData}); 
				client_2.initialize(); 
				client_2.on('authenticated', (session) => {
					console.log('authenticated');
				});

				client_2.on('ready', () => 
				{
					console.log('ready');
					client_2.sendMessage(number_phone,message);
				});

				client_2.on('auth_failure', msg => 
				{
					console.error('AUTHENTICATION FAILURE');
				});
 		});



  socket.on('sessionData', function (data) 
 		{
 			console.log('conn');

				var 	id_wa 		=data.id_wa;

				var  	sessionData =data.session!==false?{session:data.session}:{};
				console.log(sessionData);
				var   	client_1    = new Client(sessionData);
				//console.log(client_1);
				client_1.initialize(); 
				client_1.on('qr', (qr) =>{
					console.log('qr');
					var dat  	={qr:qr,id_wa:id_wa};
					io.emit('qr', dat);
				});

				io.emit('status', false);
				client_1.on('authenticated', (session) => {
					console.log('authenticated');
					io.emit('session', {session:session,id_wa:id_wa});
					io.emit('status', true);
				});

				client_1.on('ready', () => {
					console.log('ready');
					var ready  	={id_wa:id_wa};
					io.emit('ready', ready);
				});

				// client_1.on('message', message => {
				// 	console.log(message);
				// 	socket.on('sendWa', function (send_Wa) {
				// 		console.log(send_Wa);
				// 		client_1.sendMessage(send_Wa.number_phone,send_Wa.message);
				// 	});
				// });
				socket.on('sendWa', function (send_Wa) {
				  		console.log(send_Wa);
						client_1.sendMessage(send_Wa.number_phone,send_Wa.message);
				 });

				client_1.on('auth_failure', msg => {
				    console.error('AUTHENTICATION FAILURE');
				    io.emit('authfailure', {status:true,id_wa:id_wa});
				});
				client_1.on('disconnection', data => {
				    
				});
		});


});

server.listen(port);
