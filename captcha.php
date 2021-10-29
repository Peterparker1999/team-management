<?php
if(isset($_POST['submit'])){
    $clgname = $_POST['clgname'];
    $clgname= ucwords(strtolower($clgname));
    $font="BRUSHSCI.TTF";
    if(strlen($clgname)<15)
    {
        $image = imagecreatefromjpeg("certificate4.jpg");
        $color = imagecolorallocate($image,19,21,22);
        $image_width = imagesx($image);
        $text_box = imagettfbbox(150,0,$font,$clgname);
        $text_width = $text_box[2]-$text_box[0];
        $x = ($image_width/2) - ($text_width/2);
        imagettftext($image,150,0,$x,1615,$color,$font,$clgname);
    }
    else
    {
        $image = imagecreatefromjpeg("certificate5.jpg");
        $color = imagecolorallocate($image,19,21,22);
        $new_clg = explode("\n",wordwrap($clgname,24));
        $img_width = imagesx($image);
        for($i=0;$i<2;++$i) {
            $textbox = imagettfbbox(150,0,$font,$new_clg[$i]);
            $textwidth = $textbox[2]-$textbox[0];
            $x = ($img_width/2)-($textwidth/2);
            imagettftext($image,150,0,$x,1500+$i*225,$color,$font,$new_clg[$i]);
        }        
    }
    header('content-type:image/jpeg');
    $file=time();
    imagejpeg($image);
    imagedestroy($image);
}
?>
<body>
    <div>
        <form method="post">
            <input type="textbox" name="clgname"/>
            <input type="submit" name="submit"/>
        </form>
    </div>
</body>
