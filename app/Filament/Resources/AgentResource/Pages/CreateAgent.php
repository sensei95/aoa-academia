<?php

namespace App\Filament\Resources\AgentResource\Pages;

use App\DataTransferObjects\ProfileDTO;
use App\DataTransferObjects\UserDTO;
use App\Enums\User\UserRole;
use App\Filament\Resources\AgentResource;
use App\Services\AgentService;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CreateAgent extends CreateRecord
{
    protected static string $resource = AgentResource::class;

    protected function handleRecordCreation(array $data): Model
    {

        $agentService = new AgentService();

        $tempPassword = Str::substr(Str::random(8), 0, 8);

        $userDto = UserDTO::fromArray(array_merge(
            Arr::only($data, ['first_name', 'last_name', 'email']),
            ['password' => $tempPassword, 'temporary_password' => $tempPassword]
        ));

        $user = $agentService->createAgentUserAccount($userDto);

        $profileDto = ProfileDTO::fromArray(array_merge(
            Arr::only($data, [
                'post_name',
                'place_of_birth',
                'date_of_birth',
                'sex',
                'civil_state',
                'phone',
                'country',
                'postal_code',
                'state',
                'city',
                'number',
                'street',
                'commune'
            ]),
            ['user_id' => $user->id]
        ));

        $profile = $agentService->createAgentProfile($profileDto);

        $agentService->attachRoleToAgentUserAccount(UserRole::AGENT, $user);

        $agentService->sendUserRegisteredNotification($user);

        return $agentService->createAgent($profile);
    }
}
