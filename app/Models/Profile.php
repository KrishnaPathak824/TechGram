<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    //
    protected $guarded = [];

    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : "profile/pngtree-admin-and-customer-service-job-vacancies-vector-png-image_6650726.png";
        return '/storage/' . $imagePath;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
