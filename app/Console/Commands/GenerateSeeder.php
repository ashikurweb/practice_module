<?php 
namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\Command;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GenerateSeeder extends Command
{
    protected $signature = 'custom:seeders
                            {table?* : List of tables to seed. Leave empty to seed all tables.}
                            {--path= : Relative folder inside database/seeders to save generated seeders}';

    protected $description = 'Generate seeder classes for specified tables';

    protected array $excludedTables = [
        'migrations',
        'jobs',
        'failed_jobs',
    ];

    public function handle()
    {
        $tables     = $this->argument('tables');
        $customPath = $this->option('path') ?? '';
        $savePath   = base_path('database/seeders/' . $customPath);

        // Ensure the save path exists
        File::ensureDirectoryExists($savePath);

        if (empty($tables)) {
            $tables = $this->getTables();
            $this->info("No tables specified. Seeding all tables...");
        }

        foreach($tables as $table) {
            if (in_array(strtolower($table), $this->excludedTables)) {
                $this->warn("⏩ Skipped excluded table: '$table'");
                continue;
            }
            $this->generateSeederForTable($table, $savePath);
        }

        $this->info("✅ Seeder generation completed!");
        return Command::SUCCESS;
    }

    protected function getTables()
    {
        $dbName = DB::getDatabaseName();
        $tables = DB::select("SHOW FULL TABLES WHERE Table_Type = 'BASE TABLE'");
        $key    = 'Tables_in_' . $dbName;

        return array_map(fn($row) => $row->$key, $tables);
    }

    protected function generateSeederForTable(string $table, string $savePath)
    {
        if (!Schema::hasTable($table)) {
            $this->warn("⚠️ '$table' does not exist. Skipping...");
            return;
        }

        $data = DB::table($table)->get();

        if ($data->isEmpty()) {
            $this->warn("⚠️ No data found in '$table' . Skipping...");
        }

        $records   = $data->map(fn($row) =>(array) $row)->toArray();
        $formatted = $this->formatRecords($records);
        $className = Str::studly($table) . 'Seeder';

        $namespace    = 'Database\\Seeders' . ($this->option('path') ? '\\' . str_replace('/', '\\', trim($this->option('path'), '/')) : '');
        $truncateLine = strtolower($table) === 'settings' ? "        DB::table('$table')->truncate();\n\n" : '';


    $seederStub = <<<PHP
    <?php
    namespace $namespace;

    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\DB;

    class $className extends Seeder
    {
        public function run()
        {
    $truncateLine        DB::table('$table')->insert([
    $formatted
            ]);
        }
    }
    PHP;

    $filePath = $savePath . '/' . $className . '.php';
    File::put($filePath, $seederStub);
    $this->info("✅ Seeder created for table '$table': " . str_replace(base_path() . '/', '', $filePath));

    }

    protected function formatRecords(array $records)
    {
        $formatted = "";
        foreach ($records as $record) {
            $formatted .= "            [\n";
            foreach ($record as $key => $value) {
                $exportedValue = var_export($value, true);
                $formatted .= "                '$key' => $exportedValue,\n";
            }
            $formatted .= "            ],\n";
        }
        return rtrim($formatted, ",\n") . "\n";
    }
}