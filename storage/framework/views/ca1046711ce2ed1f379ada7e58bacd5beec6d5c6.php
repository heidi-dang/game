<!DOCTYPE html>
<html>
<head>
    <title><?php echo e($game->title); ?></title>
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui">
      <style>
         body,
         html {
         position: fixed;
         } 
      </style>
   </head>

<body style="margin:0px;background-color:black;overflow:hidden">

    <script src="/games/GryphonsGoldDX/js/lib/pixi.min.js"></script>
    <script src="/games/GryphonsGoldDX/js/lib/createjs.min.js"></script>

    <script src="/games/GryphonsGoldDX/js/classes/GameButton.js" type="text/javascript"></script>
    <script src="/games/GryphonsGoldDX/js/classes/GameBack.js" type="text/javascript"></script>
    <script src="/games/GryphonsGoldDX/js/classes/GameUI.js" type="text/javascript"></script>
    <script src="/games/GryphonsGoldDX/js/classes/GameView.js" type="text/javascript"></script>
    <script src="/games/GryphonsGoldDX/js/classes/GameReels.js" type="text/javascript"></script>
    <script src="/games/GryphonsGoldDX/js/classes/GameLines.js" type="text/javascript"></script>
    <script src="/games/GryphonsGoldDX/js/classes/GameCounters.js" type="text/javascript"></script>
    <script src="/games/GryphonsGoldDX/js/classes/GameRules.js" type="text/javascript"></script>
	
	
	<?php if($slot->slotGamble): ?>
		<script src="/games/GryphonsGoldDX/js/classes/GameGamble.js" type="text/javascript"></script>
	<?php endif; ?>
	
	<?php if($slot->slotBonus): ?>
		<script src="/games/GryphonsGoldDX/js/classes/GameBonus.js" type="text/javascript"></script>
	<?php endif; ?>
	
    <script src="/games/GryphonsGoldDX/js/classes/GameMessages.js" type="text/javascript"></script>
    <script src="/games/GryphonsGoldDX/js/core.js" type="text/javascript"></script>
    <script src="/games/GryphonsGoldDX/js/utils.js" type="text/javascript"></script>
    <script src="/games/GryphonsGoldDX/js/loader.js" type="text/javascript"></script>

    <script src="/games/GryphonsGoldDX/js/classes/Sounds.js" type="text/javascript"></script>


    <script>
        var isFontLoaded = false;

    if( !sessionStorage.getItem('sessionId') ){
        sessionStorage.setItem('sessionId', parseInt(Math.random() * 1000000));
    }

        window.WebFontConfig = {
            google: {
                families: ['Verdana Regular', 'Verdana Bold', 'Arial Regular', 'Arial Bold', 'Georgia Regular', 'Georgia Bold']
            },
            active: function() {
                isFontLoaded = true;
                InitializeGame();
            }
        };

        (function() {
            var wf = document.createElement('script');
            wf.src = '/games/GryphonsGoldDX/js/lib/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'false';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);

        })();
    </script>
</body>

</html>
<body>
    <style>
	.audio {
	background: rgba(0, 0, 0, 0.5);
    border: 1px solid white;
    border-radius: 5px;
    right: 4px;
    top: 4px;
    width: 70px;
    height: 25px;
    position: fixed;
    z-index: 1000;
    text-align: center;
    font-size: 22px;
    color: white;
    font-family: sans-serif;
	text-decoration: none;
    padding-top: 0px;
    cursor: pointer;
	z-index:-9999;
	}
	
	</style>

<div><a class="audio">
<audio controls="controls" onloadeddata="var audioPlayer = this; setTimeout(function() { audioPlayer.play(); }, 1200)" >
  <source  src="/games/AgeOfPrivateersGT/source/LOADER/preloader_sound.mp3" onloadeddata="var audioPlayer = this; setTimeout(function() { audioPlayer.play(); }, 8000)">
</audio>
</body>
</html><?php /**PATH C:\OSPanelCH\domains\vlt.mycasinoch.com\resources\views/frontend/games/list/GryphonsGoldDX.blade.php ENDPATH**/ ?>