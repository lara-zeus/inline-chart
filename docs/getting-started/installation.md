---
title: Installation
weight: 3
---

## Installation

Install @zeus Inline Chart by running the following commands in your Laravel project directory.

```bash
composer require lara-zeus/inline-chart
```

## Usage:

### Create a New widget:

- first create a new widget using filament command:

`art make:filament-widget MyTableWidgetChart`

- change the extend of the class to use the abstract:

`\LaraZeus\InlineChart\InlineChartWidget`

- available properties:

```php
protected static ?string $maxHeight = '50px';

protected int | string | array $columnSpan = 'full';

protected static ?string $heading = 'Chart';

public ?string $maxWidth = '!w-[150px]';
```

and you can access the current row record using: `$this->record` in your chart data:

```php
Model::where('child_id',$this->record->id)
```

### use it in your table:

```php
\LaraZeus\InlineChart\Tables\Columns\InlineChart::make('last activities')
                        ->chart(MiniChart::class)
                        ->maxWidth('!w-[150px]')
                        ->description('description')
                        ->toggleable(),
```
