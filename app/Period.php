<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Period extends Model
{
    private $color = 'black';
    private $mercurialColor = 'black';
    private $amount = 0.0;
    private $mercurialAmount = 0.0;

    protected $fillable = ['title', 'period_start'];

    /**
     * @param $user
     */
    public function setUser($user)
    {
        $this->user_id = $user;
    }

    /**
     * @param Account $account
     */
    public function addAccount(Account $account)
    {
        $this->accounts()->save($account);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function setAmounts()
    {
        $amount = 0;
        $mercurialAmount = 0;

        foreach ($this->accounts as $account) {
            $amount += $account->balance;
            if ($account->category == 1 ||
                $account->category == 2 ||
                $account->category == 3) {
                $mercurialAmount += $account->balance;
            }
        }

        $this->amount = $amount;
        $this->mercurialAmount = $mercurialAmount;
    }


    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->amount;
    }

    public function getMercurialAmount()
    {
        return $this->mercurialAmount;
    }

    /**
     *  Make sure every time we want the color we explicitly check for it.
     *  The color should be determined by the account balance.
     *
     *  @return string
     */
    public function getMercurialColor()
    {
        if ($this->getMercurialAmount() == 0) {
            $this->setMercurialColor('black');
        } else {
            $this->getMercurialAmount() > 0 ? $this->setMercurialColor('green') : $this->setMercurialColor('red');
        }

        return $this->mercurialColor;
    }

    /**
     *  Make sure every time we want the color we explicitly check for it.
     *  The color should be determined by the account balance.
     *
     *  @return string
     */
    public function getColor()
    {
        if ($this->getAmount() == 0) {
            $this->setColor('black');
        } else {
            $this->getAmount() > 0 ? $this->setColor('green') : $this->setColor('red');
        }

        return $this->color;
    }

    /**
     *
     */
    public function setMercurialColor($color)
    {
        $this->mercurialColor = $color;
    }

    /**
     * @param $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return Collection
     */
    public function getMercurialChartVars()
    {
        $filtered = $this->accounts->filter(function ($value) { // Can be function ($value, $key)
            return $value->category == 2 || $value->category == 3;
        });

        return $filtered->sortBy('balance');
    }
}
