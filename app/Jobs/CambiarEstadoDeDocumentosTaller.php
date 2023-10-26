<?php

namespace App\Jobs;

use App\Traits\docTallerTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CambiarEstadoDeDocumentosTaller implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels,docTallerTrait;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    protected $taller,$documentos;

    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

    }
}
