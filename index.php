<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="js/jquery-1.9.1.js"></script>
        <link rel="stylesheet"
        type="text/css" href="style/style.css" />
        <title>ASC - Alpha</title>
<script>
$(document).ready(function(){
    
    $('#xml').bind('input propertychange', function() {
        var xmlScript = $('#xml').val();
        var entities = [];
        entities = xmlScript.split();
        
        for(var i = 0; i < entities.length; i++) {
            
            //Remove double-spaces and script
            entities[i] = entities[i].replace(/\s{2,}/, ' ');
            entities[i] = entities[i].replace(/<script>/,'');
            entities[i] = entities[i].replace(/<\/script>/,'');
            entities[i] = entities[i].replace(/<onload>/,'');
            entities[i] = entities[i].replace(/<\/onload>/,'');
            
            //comments
            if(entities[i].match(/<!--[\s\S]*?/g)){
                entities[i] = entities[i].replace(/<!--[\s\S]*?/,"#");
            }
            //<preload>    
            if(entities[i].match(/<preload>/g)){
                entities[i] = entities[i].replace(/<preload>/, "!$PRELOAD");
            }
            //</preload>
            if(entities[i].match(/<\/preload>/g)) {
               entities[i] = entities[i].replace(/<\/preload>/, "!$PRELOAD"); 
            }
            //Scene-syntax, example:
            //<scene action="set" value="cliff" />
            if(entities[i].match(/<(scene)[^>](action="(.*?)["]) (value="(.*?)["]) \/>/g)){
                entities[i] = entities[i].replace(/<(scene)[^>](action="(.*?)["]) (value="(.*?)["]) \/>/, "@$1 $3 $5");
            }
            //Audio-syntax, example:
            //<audio toggle="volume" value="50" />
            if(entities[i].match(/<(audio)[^>](toggle="(.*?)["]) (value="(.*?)["]) \/>/g)){
                entities[i] = entities[i].replace(/<(audio)[^>](toggle="(.*?)["]) (value="(.*?)["]) \/>/, "@$1 $3 set $5");
            }
            //Audio-syntax, example:
            //<audio action="play" file="farewell.ogg" options="loop" />
            if(entities[i].match(/<(audio)[^>](action="(.*?)["]) (file="(.*?)["]) (options="(.*?)["]) \/>/g)){
                entities[i] = entities[i].replace(/<(audio)[^>](action="(.*?)["]) (file="(.*?)["]) (options="(.*?)["]) \/[>]/, "@$1 $3 $5 $7");
            }
            ////Audio-syntax, example:
            //<audio action="load" file="farewell.ogg" />
            if(entities[i].match(/<(audio)[^>](action="(.*?)["]) (value="(.*?)["]) \/>/g)){
                entities[i] = entities[i].replace(/<(audio)[^>](action="(.*?)["]) (value="(.*?)["]) \/[>]/, "@$1 $3 $5");
            }
            //Graphics-toggle, example:
            //<graphics toggle="overlay" value="on" />
            if(entities[i].match(/<(graphics)[^>](toggle="(.*?)["]) (value="(.*?)["]) \/>/g)){
                entities[i] = entities[i].replace(/<(graphics)[^>](toggle="(.*?)["]) (value="(.*?)["]) \/>/, "@$1 $3 $5");
            }
            //Graphics-action, example:
            //<graphics action="overlay" key="alpha" value="255,255,255" />
            if(entities[i].match(/<(graphics)[^>](action="(.*?)["]) (key="(.*?)["]) (value="(.*?)["]) \/>/g)){
                entities[i] = entities[i].replace(/<(graphics)[^>](action="(.*?)["]) (key="(.*?)["]) (value="(.*?)["]) \/>/, "@$1 $3 $5 $7");
            }
            //End alpha-scene, example:
            //<end type="terminate" />
            if(entities[i].match(/<(end)[^>](type="(.*?)["]) \/>/g)){
                entities[i] = entities[i].replace(/<(end)[^>](type="(.*?)["]) \/>/, "@$1 $3");
            }
            //Dialog-type, example:
            //<dialog title="???" duration="1000">Hi, I'm a regex</dialog>
            if(entities[i].match(/<(dialog)[^>](title="(.*?)["]) (duration="(.*?)["])>(.*?)<\/dialog>/g)){
                entities[i] = entities[i].replace(/<(dialog)[^>](title="(.*?)["]) (duration="(.*?)["])>(.*?)<\/dialog>/, '@$1 "$3" 5 "$6" $5');
            }
            if(entities[i].match(/<(dialog)[^>](action="(.*?)["]) \/>g/)){
                entities[i] = entities[i].replace(/<(dialog)[^>](action="(.*?)["]) \/>/, "@$1 $3");
            }
            if(entities[i].match(/<(dialog3p)[^>](duration="(.*?)["])>(.*?)<\/dialog3p>/g)){
                entities[i] = entities[i].replace(/<(dialog3p)[^>](duration="(.*?)["])>(.*?)<\/dialog3p>/, '@$1 "$4" $3');
            }
            if(entities[i].match(/<(dialog3p)[^>](action="(.*?)["]) \/>/g)){
               entities[i] = entities[i].replace(/<(dialog3p)[^>](action="(.*?)["]) \/>/, "@$1 $3"); 
            }
            //$('#xml').val(entities[i]);
            $('#alpha').val(entities[i]);
        }
    });
    
    $("#xml").keydown(function(e) {
        if(e.keyCode === 9) { // tab was pressed
            // get caret position/selection
            var start = this.selectionStart;
            var end = this.selectionEnd;

            var $this = $(this);
            var value = $this.val();

            // set textarea value to: text before caret + tab + text after caret
            $this.val(value.substring(0, start)
                        + "\t"
                        + value.substring(end));

            // put caret at right position again (add one for the tab)
            this.selectionStart = this.selectionEnd = start + 1;

            // prevent the focus lose
            e.preventDefault();
        }
    });
    
});
    
</script>
    </head>
    <body>
        <div id="toolbar">
            <img src="assets/logo.png" id="logo" height ="32" width="32" />
            <span class="active">Converter</span> | 
            <a href="about.php" id="aboutLink">About</a>
        </div>
        <div id="xmlScript">
            <textarea id="xml" cols="80" rows="40">XML goes in here</textarea>
        </div>
        <div id="alpahScript">
            <textarea id="alpha" cols="80" rows="40">SCP comes out here</textarea>
        </div>
    </body>
</html>
