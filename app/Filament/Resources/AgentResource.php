<?php

namespace App\Filament\Resources;

use App\Enums\User\CivilState;
use App\Enums\User\Sex;
use App\Filament\Resources\AgentResource\Pages;
use App\Filament\Resources\AgentResource\RelationManagers;
use App\Models\Agent;
use App\Models\Profile;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction as ActionsDeleteAction;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\BaseFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AgentResource extends Resource
{
    protected static ?string $model = Agent::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Personal information')
                    ->icon('heroicon-o-pencil-square')
                    ->schema([
                        TextInput::make('first_name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('last_name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('post_name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Select::make('sex')
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female'
                            ])
                            ->required(),
                        Select::make('civil_state')
                            ->options(CivilState::class)
                            ->required()
                    ])
                    ->columns(2),
                Section::make('Date and place of birth')
                    ->icon('heroicon-o-cake')
                    ->schema([
                        TextInput::make('place_of_birth')
                            ->required()
                            ->maxLength(255),
                        DatePicker::make('date_of_birth')
                            ->required()
                            ->native(false)
                    ])
                    ->columns(2),
                Section::make('Location')
                    ->icon('heroicon-o-map-pin')
                    ->schema([
                        TextInput::make('country')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('postal_code')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('state')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('city')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2),
                Section::make('Address')
                    ->icon('heroicon-o-building-office')
                    ->schema([
                        TextInput::make('number')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('street')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('commune')
                            ->required()
                            ->maxLength(255),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('profile.user.first_name')
                    ->label('First name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('profile.user.last_name')
                    ->label('Last name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('profile.post_name')
                ->searchable()
                    ->label('Post name')
                    ->sortable(),
                Tables\Columns\TextColumn::make('profile.sex')
                    ->label('Sex')
                    ->sortable(),
                Tables\Columns\TextColumn::make('profile.status')
                    ->label('Status')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('created_at')
                    ->form([
                        DatePicker::make('created_from')->native(false),
                        DatePicker::make('created_until')->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                })
            ],layout: FiltersLayout::AboveContentCollapsible)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgents::route('/'),
            'create' => Pages\CreateAgent::route('/create'),
            'edit' => Pages\EditAgent::route('/{record}/edit'),
        ];
    }
}
