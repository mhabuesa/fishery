<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
/**
 * image intervention v3
 */

use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

trait ImageSaveTrait
{
    private function saveImage($file_destination, $image_attribute, $width = null, $height = null): string
    {
        /**
         * Check and create directory if not exists
         */
        if (! File::isDirectory(public_path('uploads/'.$file_destination))) {
            File::makeDirectory(public_path('uploads/'.$file_destination), 0777, true, true);
        }

        /**
         * SVG conditions
         */
        if ($image_attribute->extension() == 'svg') {
            $file_name = time().Str::random(10).'.'.$image_attribute->extension();
            $path = 'uploads/'.$file_destination.'/'.$file_name;
            $image_attribute->move(public_path('uploads/'.$file_destination.'/'), $file_name);

            return $path;
        }

        /**
         * make the image accessible in image intervention
         */
        $manager = new ImageManager(Driver::class);
        $image = $manager->read($image_attribute);

        if ($width != null && $height != null && is_int($width) && is_int($height)) {
            /**
             * resize the image and save it
             */
            $image->scale($width, $height);
            $image->pad($width, $height, 'fff');

            $encoded = $image->encode(new WebpEncoder);
            $return_path = 'uploads/'.$file_destination.'/'.time().'-'.Str::random(10).'.webp';
            $encoded->save(public_path($return_path));

            return $return_path;
        } else {
            /**
             * just save it (not recommended)
             */
            $encoded = $image->encode(new WebpEncoder);
            $return_path = 'uploads/'.$file_destination.'/'.time().'-'.Str::random(10).'.webp';
            $encoded->save(public_path($return_path));

            return $return_path;
        }
    }

    private function updateImage($image_old_attribute, $file_destination, $image_new_attribute, $width = null, $height = null): string
    {
        /**
         * Check and create directory if not exists
         */
        if (! File::isDirectory(public_path('uploads/'.$file_destination))) {
            File::makeDirectory(public_path('uploads/'.$file_destination), 0777, true, true);
        }

        /**
         * SVG conditions
         */
        if ($image_new_attribute->extension() == 'svg') {
            $file_name = time().Str::random(10).'.'.$image_new_attribute->extension();
            $path = 'uploads/'.$file_destination.'/'.$file_name;
            $image_new_attribute->move(public_path('uploads/'.$file_destination.'/'), $file_name);

            return $path;
        }

        /**
         * make the image accessible in image intervention
         */
        $manager = new ImageManager(Driver::class);
        $image = $manager->read($image_new_attribute);

        if ($width != null && $height != null && is_int($width) && is_int($height)) {
            /**
             * resize the image and save it
             */
            $image->scale($width, $height);
            $image->pad($width, $height, 'fff');

            $encoded = $image->encode(new WebpEncoder);
            $return_path = 'uploads/'.$file_destination.'/'.time().'-'.Str::random(10).'.webp';
            $encoded->save(public_path($return_path));

            File::delete($image_old_attribute);

            return $return_path;
        } else {
            /**
             * just save it (not recommended)
             */
            $encoded = $image->encode(new WebpEncoder);
            $return_path = 'uploads/'.$file_destination.'/'.time().'-'.Str::random(10).'.webp';
            $encoded->save(public_path($return_path));

            File::delete($image_old_attribute);

            return $return_path;
        }
    }

    private function deleteImage($path)
    {
        if ($path == null || $path == '') {
            return null;
        }

        try {
            File::delete($path);
        } catch (\Exception $e) {
            //
        }

        File::delete($path);
    }

    private function processImageFromPath(
        $sourcePath,
        $destination,
        $width = null,
        $height = null
    ): string {

        if (! File::isDirectory(public_path('uploads/'.$destination))) {
            File::makeDirectory(public_path('uploads/'.$destination), 0777, true);
        }

        $manager = new ImageManager(Driver::class);
        $image = $manager->read($sourcePath);

        if ($width && $height) {
            $image->scale($width, $height);
            $image->pad($width, $height, 'fff');
        }

        $fileName = time().'-'.Str::random(10).'.webp';
        $finalPath = 'uploads/'.$destination.'/'.$fileName;

        $image->encode(new WebpEncoder)->save(public_path($finalPath));

        return $finalPath;
    }
}
