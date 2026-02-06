<?php

namespace App\Filament\Resources\Incidents\Schemas;

use Filament\Forms\Components\RichEditor\RichContentRenderer;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class IncidentInfolist
{
  public static function configure(Schema $schema): Schema
  {
    return $schema
      ->components([
        Section::make('Información General')
          ->schema([
            TextEntry::make('title')
              ->label('Título'),
            TextEntry::make('department.name')
              ->label('Departamento'),
            TextEntry::make('created_at')
              ->label('Fecha Reporte'),
              TextEntry::make('status')
              ->label('Estatus')
              ->badge(),
            TextEntry::make('priority')
              ->label('Prioridad')
              ->badge(),
          ])
          ->columns(2),
        Section::make('Descripción')
          ->schema([
            TextEntry::make('description')
              ->hiddenLabel()
              ->markdown()
              ->prose(),
            ]),
        Section::make('Evidencias Adjuntas')
          ->schema([
            ImageEntry::make('attachments')
              ->label('')
              ->hiddenLabel()
              ->imageSize(240)
              ->limit(3)
              ->limitedRemainingText()
              ->square(),
            ])
            ->hidden(fn ($record) => empty($record->attachments))
            ->collapsible(),
      ]);
  }
}

