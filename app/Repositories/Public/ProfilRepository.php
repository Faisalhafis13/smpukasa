<?php

namespace App\Repositories\Public;

use App\Models\Profil;

class ProfilRepository
{
    public function getProfil(): ?Profil
    {
        return Profil::latest()->first();
    }
}