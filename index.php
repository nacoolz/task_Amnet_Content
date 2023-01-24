<?php
    ob_start();
    include('app/canvas.php');
    $canvas = new canvas();
    $canvasA = $canvas->create(150, 250, '#F8D210');
    $imageA = base64_encode(ob_get_clean());
    //echo '<img src="data:image/jpeg;base64,'.$imgA.'">';
    ob_flush();
    $canvasB = $canvas->create(200, 150, '#2FF3E0');
    $imageB = base64_encode(ob_get_clean());
    // echo '<img src="data:image/jpeg;base64,'.$imgB.'">';
    $resize = new canvas();
    $resizing = 'contain';
    $contain = $resize->resize($resizing, $canvasA, $canvasB, $imageA, $imageB);
    $resizing = 'cover';
    $cover = $resize->resize($resizing, $canvasA, $canvasB, $imageA, $imageB);
    print_r($contain.'<br>'.$cover);
?>
<div>

</div>


    