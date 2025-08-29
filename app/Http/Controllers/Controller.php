<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * Convert Google Drive share link to direct image link.
     *
     * @param  string  $url
     * @return string|null
     */
    public function googleDriveImageUrl(string $url): ?string
    {
        //param: https://drive.google.com/file/d/FILE_ID/view?usp=sharing

        // Extract the file ID from the URL
        if (preg_match('/\/d\/(.*?)\//', $url, $matches)) {
            $fileId = $matches[1];
            return "https://drive.google.com/uc?export=view&id={$fileId}";
        }

        return null; // Invalid link

        //output: https://drive.google.com/uc?export=view&id=FILE_ID
    }
}
