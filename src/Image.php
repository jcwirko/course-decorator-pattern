<?php

namespace Styde;


class Image
{
    protected $path;
    private $height;
    private $width;
    private $grayscale;
    private $framed;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function setWidth($width)
    {
        $this->width = $width;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function setGrayscale($grayscale)
    {
        $this->grayscale = $grayscale;
    }

    public function setFramed($framed)
    {
        $this->framed = $framed;
    }

    public function draw()
    {
        $img = imagecreatefromjpeg($this->path);

        if ($this->width && $this->height) {
            $img = imagescale($img, $this->width, $this->height);
        }

        if ($this->grayscale) {
            imagefilter($img, IMG_FILTER_GRAYSCALE);
        }

        if ($this->framed) {
            for ($i = 0; $i < $this->framed; $i++) {
                imagerectangle($img, $i, $i, imagesx($img) - $i - 1, imagesy($img) - $i - 1, imagecolorallocate($img, 0, 0, 0));
            }
        }

        return $img;
    }


}