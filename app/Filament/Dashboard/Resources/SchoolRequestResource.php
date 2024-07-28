<?php

namespace App\Filament\Dashboard\Resources;

use App\Enums\RoleType;
use App\Enums\SchoolRequestStatus;
use App\Filament\Dashboard\Resources\SchoolRequestResource\Pages;
use App\Filament\Dashboard\Resources\SchoolRequestResource\RelationManagers;
use App\Models\SchoolRequest;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Colors\Color;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchoolRequestResource extends Resource
{
    protected static ?string $model = SchoolRequest::class;

    public static function getModelLabel(): string{
        return (__('Request'));
    }

    public static function getPluralModelLabel(): string{
        return (__('Requests'));
    }

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('level_id')
                    ->required()
                    ->relationship('level', 'name'),
                Forms\Components\Select::make('user_id')
                    ->required()
                    ->label(__(''))
                    ->relationship('user', 'name'),

                Forms\Components\SpatieMediaLibraryFileUpload::make('files')
                    ->collection('school-request')
                    ->disk('private')
                    ->multiple()
                    // ->conversion('thumb')
                    ->previewable(true)
                    ->openable(true),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                ]);
    }

    public static function table(Table $table): Table
    {
        $query = SchoolRequest::query();
        $user = User::find(auth()->user()->id);
        if ($user->hasRole(RoleType::ACADEMIC_MANAGER) || $user->hasRole(RoleType::HEAD_OF_DEPARTMENT) ) {
            $query
                ->where('status', '=', SchoolRequestStatus::Submitted->value)
                ->orwhere('status', '=', SchoolRequestStatus::Completed->value)
                ->orwhere('status', '=', SchoolRequestStatus::InReview->value)
                ->where('department_id', $user->getDepartment()->id )
                ->orWhere('assigned_to', $user->getRole());

        } elseif($user->hasRole(RoleType::DIRECTOR) || $user->hasRole(RoleType::SCHOOLING) || $user->hasRole(RoleType::DEPUTY_DIRECTOR)) {
            $query
                ->where('status', '=', SchoolRequestStatus::Escalated->value)
                ->where('assigned_to', '=', $user->getRole());
            }
            // dd($query->get());


        return $table
            ->query($query)
            ->emptyStateHeading(__('Aucune requete pour l\'instant'))
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
                    ->sortable(),
                Tables\Columns\TextColumn::make('departments.name')
                    ->label(__('Department'))
                    ->numeric()
                    ->visible(function(){
                        $user = User::find(auth()->user()->id);
                        return ($user->getRole() == RoleType::DIRECTOR->value || $user->getRole() == RoleType::DEPUTY_DIRECTOR->value);
                    } )
                    ->sortable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->label(__('User'))
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
            Tables\Actions\ActionGroup::make([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\Action::make('change_state'),
            ])
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
            'index' => Pages\ListSchoolRequests::route('/'),
            // 'create' => Pages\CreateSchoolRequest::route('/create'),
            'view' => Pages\ViewSchoolRequest::route('/{record}'),
            // 'edit' => Pages\EditSchoolRequest::route('/{record}/edit'),
        ];
    }


}
