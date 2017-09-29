<?php

namespace App\Http\Controllers\Periods\Accounts;

use App\AccountNameEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Period;
use App\Model\Account;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AccountsController extends Controller
{
    public function store(Request $request, Period $period)
    {
        if ($request->id == '') {
            throw new NotFoundHttpException('You suck at naming things.');
        }

        $collection = AccountNameEnum::getAccountNameCollection($request->id);

        $account = new Account([
            'title' => $collection->name,
            'balance' => $request->balance,
            'category' => $collection->category_enum_id
        ]);

        $account->setUser(1);

        $period->addAccount($account);

        return back();
    }

    public function index(Period $period, Account $account)
    {
        $accountCategories = AccountNameEnum::all();
        return view('periods.accounts.index', compact('account', 'accountCategories'));
    }

    public function edit(Request $request, Period $period, Account $account)
    {
        $collection = AccountNameEnum::getAccountNameCollection($request->id);

        $account->setTitle($collection->name);
        $account->setBalance($request->balance);
        $account->category = $collection->category_enum_id;

        $account->save();

        $period->setAmounts();
        return redirect()->route('periods.periodId', ['period' => $period->id]);
    }

    public function destroy(Period $period, Account $account)
    {
        $account->delete();
        return redirect()->route('periods.periodId', ['period' => $period->id]);
    }

}
