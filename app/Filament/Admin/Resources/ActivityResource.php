<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use Livewire\Component as Livewire;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Split;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Models\Activity;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Placeholder;
use App\Filament\Admin\Resources\ActivityResource\Pages;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\HtmlString;
use Rmsramos\Activitylog\RelationManagers\ActivitylogRelationManager;

class ActivityResource extends Resource
{
    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Split::make([
                    Section::make([
                        TextInput::make('causer_id')
                            ->afterStateHydrated(function ($component, ?Model $record) {
                                /** @phpstan-ignore-next-line */
                                return $component->state($record->causer?->name);
                            })
                            ->label(__('activitylog::forms.fields.causer.label')),

                        TextInput::make('subject_type')
                            ->afterStateHydrated(function ($component, ?Model $record, $state) {
                                /** @var Activity $record */
                                return $state ? $component->state(Str::of($state)->afterLast('\\')->headline() . ' # ' . $record->subject_id) : '-';
                            })
                            ->label(__('activitylog::forms.fields.subject_type.label')),

                        Textarea::make('description')
                            ->label(__('activitylog::forms.fields.description.label'))
                            ->rows(2)
                            ->columnSpan('full'),
                    ]),
                    Section::make([
                        Placeholder::make('log_name')
                            ->content(function (?Model $record): string {
                                /** @var Activity $record */
                                return $record->log_name ? ucwords($record->log_name) : '-';
                            })
                            ->label(__('activitylog::forms.fields.log_name.label')),

                        Placeholder::make('event')
                            ->content(function (?Model $record): string {
                                /** @phpstan-ignore-next-line */
                                return $record?->event ? __($record->event) : '-';
                            })
                            ->formatStateUsing(fn(string $state): string => match ($state) {
                                'draft'   => __('draft'),
                                'updated' => __('updated'),
                                'created' => __('created'),
                                'deleted' => __('deleted'),
                                default   => ucwords($state),
                            })
                            ->label(__('activitylog::forms.fields.event.label')),

                        Placeholder::make('created_at')
                            ->label(__('activitylog::forms.fields.created_at.label'))
                            ->content(function (?Model $record): string {
                                /** @var Activity $record */
                                return $record->created_at ? "{$record->created_at->format('d/m/Y')}" : '-';
                            }),
                    ])->grow(false)
                    ->columns(2),
                ])->from('md'),

                Section::make()
                    ->columns()
                    ->visible(fn($record) => $record->properties?->count() > 0)
                    ->schema(function (?Model $record) {
                        /** @var Activity $record */
                        $properties = $record->properties->except(['attributes', 'old']);

                        $schema = [];

                        if ($properties->count()) {
                            $schema[] = KeyValue::make('properties')
                                ->label(__('activitylog::forms.fields.properties.label'))
                                ->columnSpan('full');
                        }

                        if ($old = $record->properties->get('old')) {
                            $schema[] = KeyValue::make('old')
                                ->afterStateHydrated(fn(KeyValue $component) => $component->state($old))
                                ->label(__('activitylog::forms.fields.old.label'));
                        }

                        if ($attributes = $record->properties->get('attributes')) {
                            $schema[] = KeyValue::make('attributes')
                                ->afterStateHydrated(fn(KeyValue $component) => $component->state($attributes))
                                ->label(__('activitylog::forms.fields.attributes.label'));
                        }

                        return $schema;
                    }),
            ])->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('log_name')
                    ->label(__('activitylog::tables.columns.log_name.label'))
                    ->badge()
                    ->formatStateUsing(fn($state) => ucwords($state))
                    ->sortable(),
                TextColumn::make('event')
                    ->label(__('activitylog::tables.columns.event.label'))
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'draft'   => 'gray',
                        'updated' => 'warning',
                        'created' => 'success',
                        'deleted' => 'danger',
                        default   => 'primary',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'draft'   => __('draft'),
                        'updated' => __('updated'),
                        'created' => __('created'),
                        'deleted' => __('deleted'),
                        default   => ucwords($state),
                    })
                    ->sortable(),
                TextColumn::make('subject_type')
                    ->label(__('activitylog::tables.columns.subject_type.label'))
                    ->formatStateUsing(function ($state, Model $record) {
                        /** @var Activity&ActivityModel $record */
                        if (! $state) {
                            return '-';
                        }

                        return Str::of($state)->afterLast('\\')->headline() . ' # ' . $record->subject_id;
                    })
                    ->hidden(fn(Livewire $livewire) => $livewire instanceof ActivitylogRelationManager),
                TextColumn::make('causer.name')
                    ->label(__('activitylog::tables.columns.causer.label'))
                    ->getStateUsing(function (Model $record) {

                        if ($record->causer_id == null) {
                            return new HtmlString('&mdash;');
                        }

                        return $record->causer->name;
                    })
                    ->searchable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([]);
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
            'index' => Pages\ListActivities::route('/'),
            // 'create' => Pages\CreateActivity::route('/create'),
            'view' => Pages\ViewActivity::route('/{record}'),
            // 'edit' => Pages\EditActivity::route('/{record}/edit'),
        ];
    }
}
