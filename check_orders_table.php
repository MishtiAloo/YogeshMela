<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$columns = DB::select('DESCRIBE orders');
echo "Orders table structure:\n";
foreach ($columns as $col) {
    $null = $col->Null === 'NO' ? 'REQUIRED' : 'nullable';
    $default = $col->Default !== null ? "default: {$col->Default}" : 'no default';
    echo "- {$col->Field} ({$col->Type}) [$null] [$default]\n";
}
