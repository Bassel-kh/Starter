<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return false
     */
    public function handle(VideoViewer $event)
    {
        if(!session()->has('videoIsVisited')) {
            $this->updateViewer($event->video);
        }else{
            return false;
        }

    }
    public function updateViewer($videoModel){
        $videoModel -> viewers = $videoModel -> viewers + 1;
        $videoModel -> save();

        session() ->put('videoIsVisited', $videoModel -> id);

    }

}
