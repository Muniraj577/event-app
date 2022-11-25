<?php

namespace App\Console\Commands;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateEventStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:eventstatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update past date events to completed status';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Event::where('end_date', '<', Carbon::now())
        ->chunk(200, function($events){
            foreach ($events as $event){
                $event->update([
                   'is_completed' => 1,
                ]);
            }
        });
        $this->info('Event updated to completed successfully');

    }
}
