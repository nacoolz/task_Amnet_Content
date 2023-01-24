<?php
class canvas {
    public function create($width, $height, $color) {
        $canvas = imagecreate($width, $height);
        list($r, $g, $b) = sscanf($color, "#%02x%02x%02x");
        $fill = imagecolorallocate($canvas, $r, $g, $b);
        imagefill($canvas, 0, 0, $fill);
        imagejpeg($canvas);
        imagedestroy($canvas);
        return $canvas;
    }

    public function resize($resizing, $canvasA, $canvasB, $imageA, $imageB) {
        $imageA = 'data:image/jpeg;base64,'.$imageA;
        $imageB = 'data:image/jpeg;base64,'.$imageB;
        list($width, $height) = getimagesize($imageA);
        $response['Canvas A'] = ['width' => $width, 'height' => $height];
        list($width, $height) = getimagesize($imageB);
        $response['Canvas B'] = ['width' => $width, 'height' => $height];
        if($resizing == "contain") {
            $new_width = $response['Canvas A']['width'];
            $new_height = intval(($new_width * $response['Canvas B']['height']) / $response['Canvas B']['width']);
            imagescale($canvasA, $new_width, $new_height);
            $response['Resizied B Contain'] = ['width' => $new_width, 'height' => $new_height];
        }
        if($resizing == 'cover') {
            $new_height = $response['Canvas A']['height'];
            $new_width = intval(($new_height * $response['Canvas B']['width']) / $response['Canvas B']['height']);
            imagescale($canvasA, $new_width, $new_height);
            $response['Resizied B Cover'] = ['width' => $new_width, 'height' => $new_height];
        }
        return json_encode($response);
    }
}