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
        $query = SchoolRequest::query()
            ->where('status', '!=', SchoolRequestStatus::Cancelled->value)
            ->where('status', '!=', SchoolRequestStatus::Draft->value);
        $user = User::find(auth()->user()->id);
        if ($user->hasRole(RoleType::ACADEMIC_MANAGER) || $user->hasRole(RoleType::HEAD_OF_DEPARTMENT) ) {
            $query
                ->where('status', '!=', SchoolRequestStatus::Escalated->value)
                ->where('department_id', $user->getDepartment()->id );
            ;
        } elseif($user->hasRole(RoleType::DIRECTOR)  ) {
            $query
                ->where('status', '==', SchoolRequestStatus::Escalated->value);
        }

        return $table
            ->query($query)
            ->emptyStateHeading(__('Aucune requete pour l\'instant'))
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable()
                    ->badge()
                    ->color(fn(string $state) => match($state){
                            'submitted' => Color::Sky,
                            'in_review' => Color::Yellow,
                            'rejected' => Color::Red,
                            'completed'=> Color::Emerald,
                            'escalated' => Color::Lime,
                    }
                     )
                    ,
                Tables\Columns\TextColumn::make('user.name')
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
