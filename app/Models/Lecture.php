<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    // Define the columns that can be mass-assigned
    protected $fillable = ['title', 'video_url'];

    /**
     * Get the video URL formatted for embedding (e.g., YouTube).
     *
     * @return string
     */
    public function getEmbedUrlAttribute()
    {
        // Example for YouTube URLs, adjust this logic for other platforms if needed
        return 'https://www.youtube.com/embed/' . $this->getVideoIdFromUrl($this->video_url);
    }

    /**
     * Extracts the video ID from a YouTube URL.
     *
     * @param string $url
     * @return string
     */
    private function getVideoIdFromUrl($url)
    {
        preg_match('/(?:https?:\/\/(?:www\.)?youtube\.com\/(?:[^\/\n\s]+\/\S+\/\S+|(?:v|e(?:mbed)?)\/([a-zA-Z0-9_-]+)))/', $url, $matches);
        return $matches[1] ?? '';
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    
}
