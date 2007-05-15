
	song_length = {$song_length};
	song_position = {$song_position};
	
	mpd_state = '{$mpd_state}';
		
	{literal}
	
	function update_progress() {
	
		progressbar = document.getElementById('progressbar');
		
		new_margin = Math.round(200 - ((song_position / song_length) * 200));
		
		new_margin_string = new_margin + 'px';
		
		progressbar.style.marginRight = new_margin_string;
		
		//alert(progressbar.style.marginRight + ' - ' + new_margin_string);
		
		if (song_position < song_length) {
			song_position = song_position + 1;
		}
		
	}
	
	if (mpd_state == 'play') {
		update_int = setInterval('update_progress()', 1000);
	}
	
	{/literal}
