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

### use it in your table:

```php
\LaraZeus\InlineChart\Tables\Columns\InlineChart::make('last activities')
                        ->chart(MiniChart::class)
                        ->maxWidth('!w-[150px]')
                        ->description('description')
                        ->toggleable(),
```