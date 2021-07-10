<?php
session_start();
if(isset($_SESSION['photo']) && !empty($_SESSION['photo'])){ ?>    		
    <img name="passportSizePhoto" id="passportSizePhoto" src="takephoto/<?php echo($_SESSION['photo']); ?>" alt="طالب العلم" width="200" height="200" hspace="5" vspace="5" />
    <div style="clear:left; position:relative; top:-0px;"> 
    <a href="#" onclick="deletePhoto('<?php echo($_SESSION['photo']); ?>'); return false;" style="color:#F00" title="اس فوٹو کو ہٹا دو"> ہٹادو </a> 
    </div>
<?php } ?>