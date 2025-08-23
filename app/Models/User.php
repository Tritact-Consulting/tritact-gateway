<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Auth;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function company(){
        return $this->hasOne('App\Models\Company');
    }

    public function user_list(){
        return $this->hasMany(User::class, 'user_id', 'id')->where('status', 0)->orderBy('id', 'desc');
    }

    public function added_name(){
        return $this->hasOne(User::class, 'added_by', 'id');
    }

    public function tags(){
        return $this->belongsToMany(Tags::class, 'company_tags', 'user_id', 'tag_id');
    }

    public function certification_category(){
        return $this->belongsToMany(CertificationCategory::class, 'company_certifications', 'user_id', 'certifications_id');
    }

    public function categories(){
        return $this->belongsToMany(Category::class, 'company_categories', 'user_id', 'category_id');
    }

    public function get_total_users(){
        if(Auth::user()->is_company == 1){
            $user_id = Auth::user()->id;
        }else{
            $user = User::find(Auth::user()->user_id);
            $user_id = $user->id;
        }
        $total = User::where('user_id', $user_id)->count();
        echo $total;
    }

    public function get_total_tags(){
        if(Auth::user()->is_company == 1){
            $user = Auth::user();
        }else{
            $user = User::find(Auth::user()->user_id);
        }
        
        echo count($user->tags);
    }

    public function supportive_document(){
        return $this->hasMany(SupportiveDocument::class, 'user_id', 'id')->orderBy('id', 'desc');
    }

    public function getRole(){
        return $this->getRoleNames()->toArray();
    }

    public function assign_audit(){
        return $this->hasMany(AssignAudit::class, 'user_id', 'id');
    }

    public function assignedUsers()
    {
        return $this->belongsToMany(
            User::class,
            'user_assign_company',
            'parent_user_id',
            'company_user_id'
        )->withTimestamps();
    }

    public function assignedTo()
    {
        return $this->belongsToMany(
            User::class,
            'user_assign_company',
            'company_user_id',
            'parent_user_id'
        )->withTimestamps();
    }

}
