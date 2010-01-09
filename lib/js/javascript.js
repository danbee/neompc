	song_length = {$song_length};
	song_position = {$song_position};
	
	song_min = {$initialmin};
	song_sec = {$initialsec};
	
	progressbar_width = {$progressbar_width};
	
	mpd_state = '{$mpd_state}';
		
	{literal}
	
	update_int = null;
	
	function format_time(number) {
		if (number < 10) {
			return '0' + number.toString();
		}
		else {
			return number.toString();
		}
	}
	
	function update_progress() {
	
		//set the interval if it hasn't been set already.
		if (update_int == null) {
			update_int = setInterval('update_progress()', 1000);
		}

		if (song_position < song_length) {
			song_position = song_position + 1;
			song_sec = song_sec + 1;
			if (song_sec >= 60) {
				song_sec = 0;
				song_min = song_min + 1
			}
		}
		
		progressbar = document.getElementById('progressbar');
		
		new_margin = Math.round(progressbar_width - ((song_position / song_length) * progressbar_width));
		
		new_margin_string = new_margin + 'px';
		
		progressbar.style.marginRight = new_margin_string;
		document.getElementById('min').innerHTML = format_time(song_min);
		document.getElementById('sec').innerHTML = format_time(song_sec);
		
		//alert(progressbar.style.marginRight + ' - ' + new_margin_string);
		
	}
	
	if (mpd_state == 'play') {
		//start off with a shorter interval. this should make the whole thing a little more accurate.
		setTimeout('update_progress()', 750);
	}
	
{/literal}
