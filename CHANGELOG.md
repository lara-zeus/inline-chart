# Changelog

All notable changes to `Inline Chart` will be documented in this file

## 1.1.0 - 2024-02-07

### What's Changed

* fix chart width and height by @atmonshi in https://github.com/lara-zeus/inline-chart/pull/3

changing the maxWidth and maxHeight:

the usage will be:

```php
\LaraZeus\InlineChart\Tables\Columns\InlineChart::make('last activities')
    ->chart(MiniChart::class)
    ->maxWidth(350)// int, default 200
    ->maxHeight(90)// int, default 50
    ->description('description')
    ->toggleable(),

```
**Full Changelog**: https://github.com/lara-zeus/inline-chart/compare/1.0.2...1.1.0

## 1.0.2 - 2024-02-06

### What's Changed

* fix firefox bug by @atmonshi in https://github.com/lara-zeus/inline-chart/pull/2

**Full Changelog**: https://github.com/lara-zeus/inline-chart/compare/1.0.1...1.0.2

## 1.0.1 - 2024-01-31

### What's Changed

* fix reactive column and UI by @atmonshi in https://github.com/lara-zeus/inline-chart/pull/1

### New Contributors

* @atmonshi made their first contribution in https://github.com/lara-zeus/inline-chart/pull/1

**Full Changelog**: https://github.com/lara-zeus/inline-chart/compare/1.0.0...1.0.1

## 1.0.0 - 2024-01-19

### What's Changed

- initial release
