<?php

namespace App\Filament\Dashboard\Resources;

use App\Enums\SchoolRequestStatus;
use App\Filament\Dashboard\Resources\SchoolRequestResource\Pages;
use App\Filament\Dashboard\Resources\SchoolRequestResource\RelationManagers;
use App\Models\SchoolRequest;
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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('request_code')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default('draft'),
                Forms\Components\Select::make('level_id')
                    ->required()
                    ->relationship('level', 'name'),
                Forms\Components\Select::make('user_id')
                    ->required()
                    ->relationship('user', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        $query = SchoolRequest::query()
            ->where('status', '!=', SchoolRequestStatus::Draft)
            ->where('departement_id', auth()->user()->getDepartment()->id );
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\TextColumn::make('request_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                // Tables\Actions\EditAction::make(),
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
