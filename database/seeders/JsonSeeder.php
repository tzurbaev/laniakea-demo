<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

abstract class JsonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = realpath(__DIR__.'/json/'.$this->getJsonFileName());

        if (!file_exists($file) || !is_readable($file)) {
            throw new \RuntimeException('File ['.$this->getJsonFileName().'] does not exist or not readable.');
        }

        $now = Carbon::now()->format('Y-m-d H:i:s');
        $data = collect(json_decode(file_get_contents($file), true))->map(fn (array $item) => [
            ...$item,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table($this->getTableName())->insert($data->toArray());
    }

    abstract protected function getTableName(): string;

    abstract protected function getJsonFileName(): string;
}
