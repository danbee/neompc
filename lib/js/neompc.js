progressbar_width = {:$progressbar_width:};
template = '{:$template:}';
volume_min = {:$volume_min:};
volume_max = {:$volume_max:};
vol_orientation = '{:$volume_orientation:}'
page = '{:$page:}';
vol_offset = 0;

String.prototype.pad = function(l, s){
	return (l -= this.length) > 0 ? (s = new Array(Math.ceil(l / s.length) + 1).join(s)).substr(0, s.length) + this + s.substr(0, l - s.length) : this;
};

function seconds_to_time(seconds) {
	time = Math.floor(seconds / 60).toFixed().pad(2, "0") + ":" + (seconds % 60).toFixed().pad(2, "0");
	return time;
}

function volume_to_pos(volume) {
	pos = Math.round(volume_min + ((volume / 100) * (volume_max - volume_min)));
	return pos;
}

function pos_to_volume(pos) {
	volume = Math.round(((pos - volume_min) / (volume_max - volume_min)) * 100);
	return volume;
}

function ajax_control(action, value) {
	// this function will fire an AJAX call with the appropriate action.
	// or it will simply fire an AJAX call to get the current status.

	$.getJSON('control.php', {action: action, value: value},
		function(data){
			// this is where we update the page.
			if (data != null) {
				if (data.state == 'play') {
					$('#playpause_button').addClass('pause');
				}
				else {
					$('#playpause_button').removeClass('pause');
				}
				$('#pos').text((data.track_no > -1 ? data.track_no+'.' : ''));
				$('#artist').text(data.artist || '');
				$('#album').text(data.album || '');
				$('#title').text(data.title || '');
				$('#cover').attr('src', (data.coverimage ? data.coverimage : 'templates/'+template+'/images/default_cover.png'));
				$('#current').text((data.position > -1 ? seconds_to_time(data.position) : '--:--'));
				if (data.repeat == 1) {
					$('#repeat_button').addClass('selected');
				}
				else {
					$('#repeat_button').removeClass('selected');
				}
				if ($('#volume_slider').attr('rel') != '1') {
					$('#volume_slider').css((vol_orientation == 'h' ? 'left' : 'top'), volume_to_pos(data.volume)+'px');
				}
				update_progress(data.position, data.length);
			}
	});
}

function update_progress(song_position, song_length) {

	//set the interval if it hasn't been set already.
	//if (update_int == null) {
	//	update_int = setInterval('update_progress()', 1000);
	//}
	
	if (song_position > -1) {
		new_margin = Math.round(progressbar_width - ((song_position / song_length) * progressbar_width));
		
		new_margin_string = new_margin + 'px';
		
		$('#progressbar').css('marginRight', new_margin_string);
		
	}
	else {
		$('#progressbar').css('marginRight', '100%');
	}

}

function hide_volume() {
	$('#volume_container').hide();
	$('#volume_button').css('visibility', 'visible');
	$('#volume_button').blur();
}

function show_volume() {
	$('#volume_container').show();
	$('#volume_button').css('visibility', 'hidden');
}

$(document).ready(function(){
	
	$('.control_button').click(function(event){
		ajax_control(this.rel);
		this.blur();
		return false;
	});
	
	$('#volume_button').click(function(event){
		show_volume();
		return false;
	});
	
	$('#volume_hide').click(function(event){
		hide_volume();
		return false;
	});
	
	$('#volume_slider').draggable({
		axis: (vol_orientation == 'h' ? 'x' : 'y'),
		containment: $('#slider_container'),
		start: function() {
			this.rel = '1';
			vol_int = setInterval('ajax_control(\'volume\', new_volume);', 100);
			if (typeof(hide_vol) != 'undefined') {
				clearTimeout(hide_vol);
			}
		},
		drag: function() {
			new_volume = pos_to_volume(parseInt($('#volume_slider').css((vol_orientation == 'h' ? 'left' : 'top'))));
			//ajax_control('volume', new_volume);
		},
		stop: function() {
			clearInterval(vol_int);
			ajax_control('volume', new_volume);
			hide_vol = setTimeout('hide_volume(); $(\'#volume_slider\').attr(\'rel\', \'\');', 2000);
		}
	});
	
	$('#removeall').click(function() {
		return confirm('Are you sure you want to clear the whole playlist?');
	});

	$('#shuffle').click(function() {
		return confirm('Are you sure you want shuffle the playlist?');
	});

	if (page = 'control') {
		ajax_control();
		ajax_int = setInterval('ajax_control()', 1000);
	}
	
});
