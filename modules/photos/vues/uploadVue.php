<form method="post" action="<?php echo URL;?>/photos/upload" enctype="multipart/form-data">
<input type='text' name='nom' placeholder='le nom de la photo' required/>
<input type='text' name='style' placeholder='le style de la photo' required/>
    <input type='file' name='photo'/>
    <input type="submit" name="Go">
       </form>