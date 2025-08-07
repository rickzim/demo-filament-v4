<?php

namespace App\Filament\Clusters\Alpha\Resources\Customers\Pages;

use Filament\Schemas\Schema;
use App\Services\CustomerApi;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\CreateRecord;
use Filament\Schemas\Components\Utilities\Set;
use App\Filament\Clusters\Alpha\Resources\Customers\CustomerResource;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('externalSource')
                    ->belowContent('Options: John Doe, Jane Doe, Acme Company')
                    ->columnSpanFull()
                    ->searchable()
                    ->live()
                    ->dehydrated(false)
                    /**
                     * Will not work without `getOptionLabelUsing`
                     * Will not work when null
                     * Will not work when ''
                     * */
                    ->getOptionLabelUsing(fn() => 'some-label')
                    ->getSearchResultsUsing(function (string $search): array {
                        return new CustomerApi()
                            ->search($search)
                            ->pluck('name', 'id')
                            ->toArray();
                    })
                    ->afterStateUpdated(function (Set $set, $state) {
                        if (!$state) {
                            return;
                        }

                        $user = new CustomerApi()
                            ->find($state);

                        $set('name', $user->name);
                        $set('email', $user->email);
                    }),

                TextInput::make('name')
                    ->readOnly()
                    ->required(),

                TextInput::make('email')
                    ->readOnly()
                    ->required(),
            ]);
    }
}
