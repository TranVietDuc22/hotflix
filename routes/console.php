<?php

use Illuminate\Support\Facades\Schedule;
use App\Console\Commands\CrawlMovies;

Schedule::command(CrawlMovies::class)->everyTwoHours();
