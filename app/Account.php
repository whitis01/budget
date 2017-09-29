<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Account extends Model
{
    private $color = 'green';

    protected $fillable = ['title', 'balance', 'category'];

    public function setUser($user = 1)
    {
        $this->user_id = $user;
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function setTitle($title)
    {
        if ($title == null) {
            throw new NotFoundHttpException;
        }

        $this->title = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setBalance($balance)
    {
        $this->balance = $balance;
    }

    public function getBalance()
    {
        return $this->balance;
    }

    /**
    *  Make sure every time we want the color we explicitly check for it.
    *  The color should be determined by the account balance.
     *
     * Since we check every time, special checks must be made for absolutes.
    *
    *  @return string
    */
    public function getColor()
    {
        if ($this->category == 2 || $this->category == 3 || $this->category == 4) $color = 'red'; else $color = 'green';

        $this->getBalance() == 0 ? $this->setColor('black') : $this->setColor($color);

        return $this->color;
    }

    /**
    *  This is private to make sure no one can set it outside of the value on the server.
    *
    *  @param string
    */
    private function setColor($color)
    {
        $this->color = $color;
    }
}
