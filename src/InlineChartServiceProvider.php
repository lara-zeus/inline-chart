<?php

namespace LaraZeus\InlineChart;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class InlineChartServiceProvider extends PackageServiceProvider
{
    public static string $name = 'zeus-inline-chart';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasViews();
    }
}
