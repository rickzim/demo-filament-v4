<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use App\Filament\Forms\Components\RichEditor\RichContentCustomBlocks\HeroBlock;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required(),

                TextInput::make('title')
                    ->required(),

                RichEditor::make('content')
                    ->customBlocks([
                        HeroBlock::class,
                    ])
                    ->columnSpanFull()
                    ->required(),
            ]);
    }
}
