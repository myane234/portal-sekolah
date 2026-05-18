<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $fillable = ['name', 'logo'];

    public function getLogoUrlAttribute(): ?string
    {
        if (!$this->logo) {
            return null;
        }

        if (str_starts_with($this->logo, 'http')) {
            return $this->logo;
        }

        return asset('storage/' . $this->logo);
    }
}
