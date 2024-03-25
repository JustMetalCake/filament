<?php

use Filament\Forms\Components\Field;
use Filament\Forms\Components\TextInput;
use Filament\Schema\ComponentContainer;
use Filament\Tests\Forms\Fixtures\Livewire;
use Filament\Tests\TestCase;
use Illuminate\Support\Str;

uses(TestCase::class);

it('sets its state path from its name', function () {
    $field = (new Field($name = Str::random()))
        ->container(ComponentContainer::make(Livewire::make()));

    expect($field)
        ->getStatePath()->toBe($name);
});

it('sets its fallback label from its name', function () {
    $field = (new Field($name = Str::random()))
        ->container(ComponentContainer::make(Livewire::make()));

    expect($field)
        ->getLabel()->toBe(
            (string) Str::of($name)
                ->afterLast('.')
                ->kebab()
                ->replace(['-', '_'], ' ')
                ->ucfirst(),
        );
});

it('can be instantiated with a default name', function () {
    $field = IdField::make();

    expect($field->getName())
        ->toBe('id');
});

it('can ignore the default name if another is specified', function () {
    $field = IdField::make('identifier');

    expect($field->getName())
        ->toBe('identifier');
});

class IdField extends TextInput
{
    public static function getDefaultName(): ?string
    {
        return 'id';
    }
}
