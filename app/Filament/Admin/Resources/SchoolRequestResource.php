<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\SchoolRequest;
use Filament\Resources\Resource;
use App\Enums\SchoolRequestStatus;
use App\Filament\Admin\Resources\SchoolRequestResource\Pages;

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
        return (__('School Request'));
    }


    public static function getPluralModelLabel(): string
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
                    ->options(fn () => collect(SchoolRequestStatus::cases())->mapWithKeys(function ($status) {
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
                    ->required(),
                Forms\Components\TextInput::make('user_id')
                    ->label(__('User'))
                    ->disabled()
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $user = User::find(auth()->user()->id);
        // dd($user->getRole());
        $query = SchoolRequest::query()
            ->where('status', '!=', SchoolRequestStatus::Draft->value)
            ->where('status', '=', SchoolRequestStatus::Cancelled->value)
            ->orWhere('status', '=', SchoolRequestStatus::Completed->value)
            ->orwhere('status', '=', SchoolRequestStatus::Escalated->value)
            ->where('assigned_to', '=', $user->getRole());
        return $table
            ->query($query)
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->label(__('Title'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('Status'))
                    ->tooltip(fn (SchoolRequest $record) => __('By') . ' ' . $record->user->full_name)
                    ->badge()
                    ->fontFamily('Poppins')
                    ->tooltip(fn (SchoolRequest $record) => __('By') . ' ' . $record->user->full_name)
                    ->color(fn (string $state) => match ($state) {
                        'draft' => 'primary',
                        'submitted' => 'secondary',
                        'cancelled' => 'danger',
                        'in_review' => 'warning',
                        'escalated' => 'success',
                        'rejected' => 'danger',
                        'completed' => 'success',
                        default => 'primary'
                    })
                    ->formatStateUsing(fn (string $state) => match ($state) {
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
                    ->tooltip(fn (SchoolRequest $record) => __('By') . ' ' . $record->user->full_name)
                    ->sortable(),
                Tables\Columns\TextColumn::make('departments.name')
                    ->label(__('Department'))
                    ->numeric()
                    ->tooltip(fn (SchoolRequest $record) => __('By') . ' ' . $record->user->full_name)
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('User'))
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(function () {
                        $vals = (collect(SchoolRequestStatus::cases())->mapWithKeys(function ($status) {
                            return [$status->value => $status->label()];
                        })->toArray());

                        // array_($vals, );
                    })
            ], layout: Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\Action::make('change_state')
                        ->label(__('Cancel Request'))
                        ->icon('heroicon-o-arrow-right-on-rectangle')
                        ->color('success')
                        ->hidden(function ($record) {
                            $state = $record->status;
                            if ($state === SchoolRequestStatus::Rejected->value) {
                                return true;
                            }
                        })
                        ->requiresConfirmation()
                        ->action(function (SchoolRequest $record) {
                            //                            Faire un modal de confirmation pour changer le status

                            $record->status = SchoolRequestStatus::Rejected;
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
