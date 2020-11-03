<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait SlugTrait
{   
    /**
     *  Unique Slugs
     */
    public function uniqueSlug($slug)
    {
        $matches = $this->whereRaw("slug REGEXP '^{$slug}(-[0-9]*)?$'")->count();            
        return $matches;
    }
   
    /**
     *  Mutators
     */
    public function setNameAttribute($n)
    {
        $slug = Str::slug($n, '-');
        $matches = $this->uniqueSlug($slug);
        
        $this->attributes['name'] = ucfirst($n);

        $this->attributes['slug'] = $matches ? $slug . '-' . rand() : $slug;
        // $this->attributes['slug'] = $matches ? $slug . '-' . $matches : $slug;
        // $this->attributes['slug'] = $matches ? $slug . '-' . Str::uuid() : $slug;
    }

    public function setDescriptionAttribute($d)
    {
        $this->attributes['description'] = ucfirst($d);
    }

}
