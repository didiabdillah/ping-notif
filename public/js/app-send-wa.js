const socket 	= require('socket.io-client')('http://localhost:4040');
var sessionData 	={session:data.session,id_wa:id_wa};
socket.emit('sessionData',sessionData);
var datam_sg  		={number_phone:number_phone,message:message};
socket.emit('sendWa', datam_sg);
