
const socket 	= require('socket.io-client')(REDIS_HOST+':'+REDIS_PORT);
const Form_Data = new FormData();
Form_Data.append('_token',csrf_token);
Form_Data.append('id_wa', id_wa);
fetch(url_page+'/get-session', { method: 'POST',body:Form_Data}).then(res => res.json()).then(data => 
{ 
	var sessionData 	={session:data.session,colection:colection};
	var status_session 	=data.session?true:false;
	var token_api_key 	=data.token;
	socket.emit('sessionData',sessionData);
	var data  			={}; 
	if(token_api_key!=null)
		{
			var no_hp 		 	=$('input[name="number"]').val();
			$('#bar_id_'+colection+' .show_qr .alert').html('<p>Session WA Ready</p><img src="../../images/wa.png"><br><a  class="btn btn-warning btn-sm hps_session" href="#" data-hps_session="'+no_hp+'" >Hapus</a>');
			$('#bar_id_'+colection+' .show_qr .loading').hide();
		}
	socket.on('qr', (dat) => {
		$('#bar_id_'+dat.colection+' .show_qr .loading').hide();
		$('#bar_id_'+dat.colection+' .show_qr canvas').remove();
		

		var data_qr 	=dat.qr;
		window.qr 		=data_qr;
		var no_hp 		=$('input[name="number"]').val();
		// if(no_hp.length>=12)
		// {
			
				$('#bar_id_'+dat.colection+' .show_qr .alert').empty();
				$('#bar_id_'+dat.colection+' .show_qr').qrcode({
				render 		: 'canvas',
				text	 	: data_qr
				}); 
		// }
		// else
		// {
		// 	$('#bar_id_'+dat.colection+' .show_qr .alert').html('<p>Nomor WA belum anda masukkan</p><img src="../../images/wa.png">');
		
		// }
	});
	// $('body').delegate('input[name="number"]','keyup',function(e)
	// {
	// 	e.preventDefault();
	// 	$('#bar_id_'+colection+' .show_qr .loading').show();
	// 	$('#bar_id_'+colection+' .show_qr .alert').empty();
	// 	$('#bar_id_'+colection+' .show_qr canvas').remove();
	// 	var no_hp 		=$(this).val();
	// 	if(no_hp.length>=12)
	// 	{
	// 		if(window.qr!=undefined)
	// 		{
	// 			$('#bar_id_'+colection+' .show_qr .loading').fadeOut();
	// 			$('#bar_id_'+colection+' .show_qr .alert').empty();
	// 			$('#bar_id_'+colection+' .show_qr').qrcode({
	// 			render 		: 'canvas',
	// 			text	 	: window.qr
	// 			});
	// 		}	 		
	// 	}
	// });

	socket.on('ready', (ready) => {
			if(ready)
			{
				var tokenkey=token_api_key==""?'':token_api_key;
				$('#bar_id_'+ready.colection+' .show_qr canvas').remove();
				$('#bar_id_'+ready.colection+' .show_qr .loading').hide();
				$('#bar_id_'+ready.colection+' .show_qr .alert').html('<p>Session WA Ready</p><img src="../../images/wa.png">');
			 	$('#note_'+ready.colection).html('API KEY ANDA :<div class="apikey">'+tokenkey+'<i class="mdi mdi-content-copy"></i></div>');
						

			}
	});

	socket.on('session', (sess) => {
		var no_hp 		 	=$('input[name="number"]').val();
		if(no_hp==undefined||no_hp=="")
		{
			return
		}
		var id_wa_post 		=id_wa?id_wa:'';
		var poin_save 		={session:sess.session,no_hp:no_hp};
		const Form_Data 	=JSON.stringify(poin_save);
	
		if(colection==sess.colection&&status_session!=true)
		{
				
				$('#bar_id_'+colection+' .show_qr .loading').show();
				fetch(url_page+'/save-session-whatsapp', { method: 'POST',body:Form_Data})
				.then(res => res.json())
				.then(rejson => 
				{ 
					  location.href=url_page+'/whatsapp/detail/'+no_hp;
				});
			
		}
	}); 

	socket.on('authfailure', (auth) => 
	{
		var no_hp 		 	=$('input[name="number"]').val();
		if(colection==auth.colection)
		{
			//$('#bar_id_'+auth.colection+' .show_qr .loading').fadeOut();
			$('#bar_id_'+auth.colection+' .show_qr .alert').html('<p>Session WA Telah Berahir</p><img src="../../images/wa.png"><p>silahkan Hapus terlebih dahulu data WA ini <br><a  class="btn btn-warning  btn-sm  hps_session" href="#" data-hps_session="'+no_hp+'" >Hapus</a></p>');
		
		}
		
	});



	$('body').delegate('.hps_session','click',function(e)
	{
		e.preventDefault();
		$('#bar_id_'+colection+' .show_qr .loading').fadeOut();
		var no_hp_hps=$(this).data('hps_session');
		const Form_Data         = new FormData();
        Form_Data.append('_token',csrf_token);
        Form_Data.append('no_hp_hps',no_hp_hps);
		fetch(url_page+'/hapus-sesi', { method: 'POST',body:Form_Data})
		.then(res => res.json())
		.then(rejson => 
		{ 
			 location.reload();
		});

	});



});


