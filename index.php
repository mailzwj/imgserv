<?php
    /*
     * Request: ?size=400x200&bgc=333&fz=20&text=abcde&fc=f00
     * Params:
     *      size: 生成图片的尺寸 Width x Height，
     *      bgc: background-color 生成图片背景颜色，支持abc和abcdef两种十六进制格式
     *      fz: font-size 绘制文本的字体大小，默认 20
     *      fc: font-color 绘制文本的颜色，默认 fff
     *      text: 绘制的文本内容，默认为传入的尺寸
     */
    header("Content-type: image/png");
    header("Cache-Control: no-cache");

    function colorFormat($color) {
        $len = strlen($color);
        $cArr = array();
        if ($len == 3) {
            $cArr[0] = str_repeat(substr($color, 0, 1), 2);
            $cArr[1] = str_repeat(substr($color, 1, 1), 2);
            $cArr[2] = str_repeat(substr($color, 2, 1), 2);
        } else {
            $cArr[0] = substr($color, 0, 2);
            $cArr[1] = substr($color, 2, 2);
            $cArr[2] = substr($color, 4, 2);
        }
        return $cArr;
    }

    // 背景颜色
    $bgc = empty($_REQUEST['bgc']) ? "333" : $_REQUEST['bgc'];
    // 图片尺寸
    $size = empty($_REQUEST['size']) ? "300x150" : $_REQUEST['size'];
    // 字体颜色
    $fc = empty($_REQUEST['fc']) ? "fff" : $_REQUEST['fc'];
    // 显示文本
    $text = empty($_REQUEST['text']) ? $size : $_REQUEST['text'];
    // 字体大小
    $fz = empty($_REQUEST['fz']) ? 20 : $_REQUEST['fz'];

    $yahei = './fonts/msyh.ttf';
    $arial = './fonts/arial.ttf';
    $reg = "/[\x{4e00}-\x{9fa5}]/u";

    $font = $arial;
    if (preg_match($reg, $text)) {
        $font = $yahei;
    }

    $sizeArr = explode("x", $size);
    $bgcRgb = colorFormat($bgc);
    $fcRgb = colorFormat($fc);

    $textbox = imagettfbbox($fz, 0, $font, $text);
    // var_dump($textbox);
    $textWidth = $textbox[2] - $textbox[0];
    $textHeight = $textbox[7] - $textbox[1];

    $left = intval(($sizeArr[0] - $textWidth) / 2);
    $top = intval(($sizeArr[1] - $textHeight) / 2);

    // echo $textHeight . "  " . $top;
    // echo $text . "---" . $textWidth . "->" . $textHeight;

    $img = imagecreatetruecolor($sizeArr[0], $sizeArr[1]);

    $bgcolor = imagecolorallocate($img, hexdec($bgcRgb[0]), hexdec($bgcRgb[1]), hexdec($bgcRgb[2]));
    $textcolor = imagecolorallocate($img, hexdec($fcRgb[0]), hexdec($fcRgb[1]), hexdec($fcRgb[2]));

    imagefill($img, 0, 0, $bgcolor);
    imagettftext($img, $fz, 0, $left, $top, $textcolor, $font, $text);

    imagepng($img);
    imagedestroy($img);
?>