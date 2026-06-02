<?php
 
namespace App\Models;
 
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
 
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
 
    protected $fillable = ['name', 'email', 'password'];
    protected $hidden   = ['password', 'remember_token'];
 
    // ── Wajib diimplementasi untuk JWT ──────────────────────
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
 
    public function getJWTCustomClaims(): array
    {
        return [];
    }
 
    // Relasi ke catatan
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
