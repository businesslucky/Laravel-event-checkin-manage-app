<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvitedGuest extends Model
{
    //
    protected $table = "invitedguest";
    protected $fillable = ['notes','types','guestId','eventId','invited_by'];
}
