<?php

use Illuminate\Console\Command;

class ResetCommentCountCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'stats:resetCount';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Re-calculate number of comments for all courses';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $this->info('Re-calculate number of comments for all courses');
        Course::recalculateCommentCount();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array();
    }

}
