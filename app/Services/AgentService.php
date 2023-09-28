<?php

namespace App\Services;

use App\DataTransferObjects\ProfileDTO;
use App\DataTransferObjects\UserDTO;
use App\Enums\User\UserRole;
use App\Models\Agent;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

class AgentService
{
    public function createAgentUserAccount(UserDTO $userDTO): User
    {
        return User::create($userDTO->toArray());
    }

    public function createAgentProfile(ProfileDTO $profileDTO): Profile
    {
        return Profile::create($profileDTO->toArray());
    }

    public function attachRoleToAgentUserAccount(UserRole $userRole, User $user): void
    {
        $user->roles()->attach(
            Role::where('name', $userRole->value)
                ->pluck('id')
                ->first()
        );
    }

    public function sendUserRegisteredNotification(User $user): void
    {
        event(new Registered($user));
    }

    public function createAgent(Profile $profile): Agent
    {
        return Agent::create(['profile_id' => $profile->id]);
    }
}
