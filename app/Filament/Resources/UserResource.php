<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use App\Models\Unidade;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TextInput\Mask;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Filters\TernaryFilter;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
   
   /*  protected function getRedirectUrl(): string
    {
       // return $this->getResource()::getUrl('index');
       return $this->previousUrl ?? $this->getResource()::getUrl('index');
    } */

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                ->required()
                ->autofocus()
                ->placeholder('Digite o nome'),
                
                TextInput::make('email')
                ->required()
                ->unique()
                ->placeholder('Digite o e-mail'),
                
                TextInput::make('st_perfil')->label('Perfil'),
                //Toggle::make('st_perfil')->disabled(! auth()->user()->st_perfil != 'Administrador'),
                
               /*  TextInput::make('ce_unidade')
                ->label('Unidade'), */

               /*  Select::make('ce_unidade')
                    ->label('Unidade')
                    ->options(Unidade::all()->pluck('name', 'id'))
                    ->searchable(), */
                Select::make('ce_unidade')
                    ->relationship(name: 'st_unidade', titleAttribute: 'name'),

                TextInput::make('created_at')
                ->label('Cadastro')
                ->disabled()
                ->mask(fn (TextInput\Mask $mask) => $mask->pattern('00/00/0000'))
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('E-mail')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('ce_unidade')->label('Unidade'),
                //Tables\Columns\TextColumn::make('st_perfil')->label('Perfil'),
                Tables\Columns\TextColumn::make('created_at')
                ->label('Cadastro')
                ->datetime('d/m/Y H:i:s'),
                
                Tables\Columns\ToggleColumn::make('bo_admin')
                    ->label('Admin')
                    ->disabled(! auth()->user()->isAdmin()),

                Tables\Columns\SelectColumn::make('st_perfil')
                    ->options([
                        'Administrador' => 'Administrador',
                        'Anciao' => 'Ancião',
                        'Familia' => 'Família',
                        'Lider' => 'Líder',
                    ])->label('Perfil')
                    ->disabled(! auth()->user()->isAdmin()),
            ])
            ->filters([
                TernaryFilter::make('st_perfil')
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }    
}
