<?php

declare(strict_types=1);

namespace App\Services\Auth;

use App\DataTransferObjects\Auth\ProfileDto;
use App\Models\Auth\Profile;
use Illuminate\Database\Eloquent\Collection;

class ProfileService {
    public function index():Collection
    {
        return Profile::get();
    }

    public function show($Profile):Collection
    {
        return Profile::find($Profile);
    }

    public function store(ProfileDto $dto): Profile
    {
        return Profile::create($dto->toArray());
    }

    public function update(ProfileDto $dto, Profile $Profile): Profile
    {
        $Profile->update($dto->toArray());
        return $Profile;
    }

    public function destroy(Profile $Profile): void
    {
        $Profile->delete();
    }
}
