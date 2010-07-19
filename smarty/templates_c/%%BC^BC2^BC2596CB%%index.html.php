<?php /* Smarty version 2.6.26, created on 2010-07-10 14:28:02
         compiled from impc/index.html */ ?>
<!DOCTYPE html>

<html>
	<head>
		<title>iMPC</title>
	    <style type="text/css" media="screen">@import "templates/impc/jqtouch/jqtouch.min.css";</style>
	    <style type="text/css" media="screen">@import "templates/impc/themes/jqt/theme.min.css";</style>
		<style type="text/css">
			#song-info {
				position: absolute;
				width: 100%;
				background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(rgba(20,20,20,0.8)), to(rgba(30,30,30,0.8)));
				border-bottom: 1px solid rgba(0,0,0,0.6);
				top: 35px;
				padding: 5px 0 0;
				text-align: center;
				margin: 10px 0;
			}
			#song-info #artist {
				white-space: nowrap;
			}
			#song-info #title {
				font-size: 1.2em;
				font-weight: bold;
				color: white;
				white-space: nowrap;
			}
			#song-info #album {
				white-space: nowrap;
				padding-bottom: 5px;
				border-bottom: 1px solid rgba(90,90,90,0.8);
			}
			#artwork {
				margin: 0 auto;
				width: 320px;
				height: 320px;
			}
			#artwork img {
				width: 320px;
			}
			#controls {
				position: absolute;
				bottom: 0px;
				width: 100%;
				background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(rgba(60,60,60,0.8)), to(rgba(30,30,30,0.8)));
				border-top: 1px solid rgba(0,0,0,0.6);
				text-align: center;
			}
			#volume {
				border-top: 1px solid rgba(90,90,90,0.8);
			}
			#playback-controls {
				padding-top: 10px;
				padding-bottom: 10px;
			}
			#playback-controls img {
				width: 36px;
				height: 30px;
				margin: 0 21px;
			}
		</style>
	    <script src="lib/js/jquery-1.4.2.min.js" type="application/x-javascript" charset="utf-8"></script>
	    <script src="templates/impc/jqtouch/jqtouch.min.js" type="application/x-javascript" charset="utf-8"></script>
		<script type="text/javascript">
		    $.jQTouch({
		        icon: 'jqtouch.png',
		        statusBar: 'black-translucent',
		        preloadImages: [
		            'themes/jqt/img/chevron_white.png',
		            'themes/jqt/img/bg_row_select.gif',
		            'themes/jqt/img/back_button_clicked.png',
		            'themes/jqt/img/button_clicked.png'
		            ]
		    });
		    
		    function update_info(song_info) {
				$('#artist').text(song_info.artist);
				$('#album').text(song_info.album);
				$('#title').text(song_info.title);
				if (song_info.state == 'play') {
					$('#play-pause img').attr('src', 'images/pause.png');
				}
				else {
					$('#play-pause img').attr('src', 'images/play.png');
				}
		    }
		    
		    function update_playlist(playlist) {
				var playlistLength = playlist.length;
				for (var i = 0, len = playlistLength; i < len; ++i){
					$('#playlist-songs').append('<li><a href="#">'+playlist[i].Title+'</a></li>');
				}
		    }
		    
		    $(function() {
		    	// do our first load.
		    	
		    	// song info
		    	$.getJSON('lib/control.php', function(data) {
		    		update_info(data);
		    	});
		    	
		    	// playlist
		    	$.getJSON('lib/playlist.php', function(data) {
		    		update_playlist(data);
		    	});
		
				$("#play-pause").click(function() {
					$.getJSON('lib/control.php?action=playpause', function(data) {
			    		update_info(data);
					});
				});
		    });
		</script>
	</head>

	<body>
		<div id="home">
			<div class="toolbar">
				<h1>iMPC</h1>
				<a class="button flip" id="infoButton" href="#now-playing">Now Playing</a>
			</div>
            <ul class="rounded">
                <li class="arrow"><a href="#playlist">Playlist</a></li>
			</ul>
			<h2>Browse</h2>
            <ul class="rounded">
                <li class="arrow"><a href="#artists">Artists</a></li>
                <li class="arrow"><a href="#playlists">Playlists</a></li>
                <li class="arrow"><a href="#files">Files</a></li>
            </ul>
            <ul class="rounded">
                <li class="arrow"><a href="#settings">Settings</a></li>
			</ul>
		</div>
		
		<div id="now-playing">
			<div class="toolbar">
				<h1>Now Playing</h1>
				<a class="button flip" href="#home">Menu</a>
			</div>
			<div id="song-info">
				<p id="artist">-</p>
				<p id="title">-</p>
				<p id="album">-</p>
			</div>
			<p id="artwork"><img src="images/default_cover.gif" /></p>
			<div id="controls">
				<div id="volume">
				</div>
				<div id="playback-controls">
					<a id="prev-track"><img src="images/prev.png" /></a>
					<a id="play-pause"><img src="images/play.png" /></a>
					<a id="next-track"><img src="images/next.png" /></a>
				</div>
			</div>
		</div>
		
		<div id="playlist">
			<div class="toolbar">
				<h1>Playlist</h1>
				<a class="back" href="#home">Back</a>
			</div>
			<ul id="playlist-songs" class="plastic">
			</ul>
		</div>
		
		<div id="settings">
			<div class="toolbar">
				<h1>Settings</h1>
				<a class="back" href="#home">Back</a>
			</div>
			<h2>Server</h2>
            <ul class="edit rounded">
                <li><input type="text" name="host" placeholder="Host" id="server-host" /></li>
                <li><input type="text" name="port" placeholder="Port" id="server-port" value="6600" /></li>
			</ul>
		</div>
	</body>
</html>