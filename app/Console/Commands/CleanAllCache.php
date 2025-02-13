<?php
namespace App\Console\Commands;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
class CleanAllCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clean-all-cache';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears all caches including views, route, config, and application cache';
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('Clearing caches...');
        Artisan::call('view:clear');
        $this->info('View cache cleared.');
        Artisan::call('cache:clear');
        $this->info('Application cache cleared.');
        Artisan::call('route:clear');
        $this->info('Route cache cleared.');
        Artisan::call('config:clear');
        $this->info('Config cache cleared.');
        $this->info('All caches cleared successfully!');
    }
}
