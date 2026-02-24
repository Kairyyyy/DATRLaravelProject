<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class Admin extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;
    
    protected $guard = "admin";

    protected $fillable = [
        'name',
        'email',
        'password',
        'verification_code',
        'verification_code_expires_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'verification_code',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'verification_code_expires_at' => 'datetime',
        ];
    }

    /**
     * Generate a 6-digit verification code
     */
    public function generateVerificationCode(): string
    {
        $this->verification_code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $this->verification_code_expires_at = now()->addMinutes(30);
        $this->save();
        
        return $this->verification_code;
    }

    /**
     * Verify the provided code
     */
    public function verifyCode(string $code): bool
    {
        if ($this->verification_code === $code && 
            $this->verification_code_expires_at && 
            $this->verification_code_expires_at->isFuture()) {
            
            $this->email_verified_at = now();
            $this->verification_code = null;
            $this->verification_code_expires_at = null;
            $this->save();
            
            return true;
        }
        
        return false;
    }

    /**
     * Check if verification code is expired
     */
    public function isVerificationCodeExpired(): bool
    {
        return !$this->verification_code_expires_at || 
               $this->verification_code_expires_at->isPast();
    }
}