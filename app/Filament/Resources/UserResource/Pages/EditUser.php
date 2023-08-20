<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //desabila o botão exclir da tela de edição
            //Actions\DeleteAction::make(),
        ];
    }

    /**
     * rediciona para a listagem 
     */  
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
