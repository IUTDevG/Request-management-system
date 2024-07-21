<?php

namespace App\Filament\Admin\Resources;

use App\Enums\SchoolRequestStatus;
use App\Filament\Admin\Resources\SchoolRequestResource\Pages;
use App\Filament\Admin\Resources\SchoolRequestResource\RelationManagers;
use App\Models\SchoolRequest;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchoolRequestResource extends Resource
{
    protected static ?string $model = SchoolRequest::class;


    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    public static function getNavigationGroup(): string
    {
        return (__('School'));
    }

    public static function getModelLabel(): string
    {
        return (__('School Requests'));
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->label(__('Title'))
                    ->required()
                    ->disabled()
                    ->maxLength(255),
                Forms\Components\TextInput::make('request_code')
                    ->label(__('Request code'))
                    ->disabled()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label(__('Description'))
                    ->disabled()
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->label(__('Status'))
                    ->options(fn() => collect(SchoolRequestStatus::cases())->mapWithKeys(function ($status) {
                        return [$status->value => $status->label()];
                    })->toArray())
                    ->default(SchoolRequestStatus::Draft->value)
                    ->required(),
                Forms\Components\TextInput::make('level_id')
                    ->label(__('Level'))
                    ->disabled()
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('department_id')
                    ->label(__('Department'))
                    ->disabled()
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('user_id')
                    ->label(__('User'))
                    ->disabled()
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('Title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('request_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('Status'))
                    ->badge()
                    ->fontFamily('Poppins')
                    ->tooltip(fn(SchoolRequest $record) => __('By') . ' ' . $record->user->full_name)
                    ->color(fn(string $state) => match ($state) {
                        'draft' => 'primary',
                        'submitted' => 'secondary',
                        'cancelled' => 'danger',
                        'in_review' => 'warning',
                        'escalated' => 'success',
                        'rejected' => 'danger',
                        'completed' => 'success',
                        default => 'primary'
                    })
                    ->formatStateUsing(fn(string $state) => match ($state) {
                        'draft' => __('Draft'),
                        'submitted' => __('Submitted'),
                        'cancelled' => __('Cancelled'),
                        'in_review' => __('In review'),
                        'escalated' => __('Escalated'),
                        'rejected' => __('Rejected'),
                        'completed' => __('Completed'),
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('level.name')
                    ->label(__('Level'))
                    ->sortable()
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('departments.name')
                    ->label(__('Department'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('User'))
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label(__('Updated at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->filtersTriggerAction(
                fn (Action $action) => $action
                    ->button()
                    ->label('Filter'),
            )
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\Action::make('change_state')
                        ->label(__('Cancel Request'))
                        ->icon('heroicon-o-arrow-right-on-rectangle')
                        ->color('success')
                        ->visible(fn(SchoolRequest $record) => $record->status !== SchoolRequestStatus::Cancelled)
                        ->requiresConfirmation()
                        ->action(function (SchoolRequest $record) {
//                            Faire un modal de confirmation pour changer le status

                            $record->status = SchoolRequestStatus::Cancelled;
                            $record->update();
                        })
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListSchoolRequests::route('/'),
//            'edit' => Pages\EditSchoolRequest::route('/{record}/edit'),
        'view' => Pages\ViewSchoolRequest::route('/{record}/view'),
        ];
    }
}
