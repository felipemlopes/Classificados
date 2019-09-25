<?php

namespace App\Observers;

use App\Models\Advertisement;
use App\Models\Artist;
use App\Models\ArtistMusicalStyle;
use App\Models\Professional;
use App\Models\User;
use App\Notifications\AdvertisementSuspended;

class AdvertisementObserver
{
    /**
     * Handle the advertisement "created" event.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return void
     */
    public function created(Advertisement $advertisement)
    {
        //
    }

    /**
     * Handle the advertisement "updated" event.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return void
     */
    public function updated(Advertisement $advertisement)
    {
        $user = User::find($advertisement->user_id);
        if($advertisement->suspended==true){
            $user->notify(new AdvertisementSuspended($advertisement));
        }
    }

    /**
     * Handle the advertisement "deleted" event.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return void
     */
    public function deleted(Advertisement $advertisement)
    {
        if($advertisement->embedded_type=="App\Models\Artist"){
            $musicstyles = ArtistMusicalStyle::where('artist_id',$advertisement->embedded_id)->delete();

            $artist= Artist::find($advertisement->embedded_id);
            $artist->delete();
        }
        if($advertisement->embedded_type=="App\Models\Professional"){
            $professional = Professional::find($advertisement->embedded_id);
            $professional->delete();
        }
    }

    /**
     * Handle the advertisement "restored" event.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return void
     */
    public function restored(Advertisement $advertisement)
    {
        //
    }

    /**
     * Handle the advertisement "force deleted" event.
     *
     * @param  \App\Models\Advertisement  $advertisement
     * @return void
     */
    public function forceDeleted(Advertisement $advertisement)
    {
        //
    }
}
