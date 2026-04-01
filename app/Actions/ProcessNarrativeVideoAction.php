<?php

namespace App\Actions;

use FFMpeg\FFMpeg;
use FFMpeg\Format\Video\X264;
use Illuminate\Support\Facades\Storage;

/**
 * Optimizes educational story videos for low-bandwidth Nigerian mobile users.
 */
class ProcessNarrativeVideoAction
{
    public function execute(string $originalPath): string
    {
        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries'  => '/usr/bin/ffmpeg',
            'ffprobe.binaries' => '/usr/bin/ffprobe',
        ]);

        $video = $ffmpeg->open(Storage::path($originalPath));
        $outputPath = 'processed/' . basename($originalPath);

        // Transcode to 480p H.264 for high efficiency on 2G/3G
        $format = new X264();
        $format->setAudioCodec('libmp3lame')
               ->setVideoCodec('libx264')
               ->setKiloBitrate(1000); // 1Mbps for 480p

        $video->save($format, Storage::path($outputPath));

        return $outputPath;
    }
}
