<?php

namespace App\Filament\Resources\AgentResource\Pages;

use App\Filament\Resources\AgentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;

class EditAgent extends EditRecord
{
    protected static string $resource = AgentResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $this->record->load(['profile','profile.user:id,first_name,last_name,email']);

        $data = array_merge($data, [
            'first_name' => $this->record->profile->user->first_name,
            'last_name' => $this->record->profile->user->last_name,
            'post_name' => $this->record->profile->post_name,
            'phone' => $this->record->profile->phone,
            'email' => $this->record->profile->user->email,
            'sex' => $this->record->profile->sex,
            'civil_state' => $this->record->profile->civil_state,
            'date_of_birth' => $this->record->profile->date_of_birth,
            'place_of_birth' => $this->record->profile->place_of_birth,
            'country' => $this->record->profile->country,
            'postal_code' => $this->record->profile->postal_code,
            'state' => $this->record->profile->state,
            'city' => $this->record->profile->city,
            'number' => $this->record->profile->address['number'],
            'commune' => $this->record->profile->address['commune'],
            'street' => $this->record->profile->address['street'],
        ]);

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->profile()->update([

            'post_name' => $data['post_name'],
            'place_of_birth' => $data['place_of_birth'],
            'date_of_birth' => $data['date_of_birth'],
            'sex' => $data['sex'],
            'civil_state' => $data['civil_state'],
            'phone' => $data['phone'],
            'country' => $data['country'],
            'postal_code' => $data['postal_code'],
            'state' => $data['state'],
            'city' => $data['city'],
            'address->number' => $data['number'],
            'address->street' => $data['street'],
            'address->commune' => $data['commune'],
        ]);

        $record->profile->user()->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email']
        ]);

        return $record;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
