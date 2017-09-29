<?php

namespace App\Http\Controllers\Periods;

use App\AccountNameEnum;
use App\CategoryEnum;
use ConsoleTVs\Charts\Facades\Charts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Period;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PeriodsController extends Controller
{
    public function api() {
        return ['data' => Period::all('id', 'title', 'period_start')->sortByDesc('period_start')->first()];
    }

    public function index()
    {
        $periods = Period::all('id', 'title', 'period_start')->sortByDesc('period_start');

        $period = $periods->first() !== null ? $periods->first() : new Period;

        	
        $period->setAmounts();
        $chartValues = $period->getMercurialChartVars();
        $values = $chartValues->pluck('balance');
        $balances = [];
        foreach ($values as $balance) { $balances[] = abs($balance);}

        $chart = Charts::create('pie', 'highcharts')
//            ->view('custom.line.chart.view') // Use this if you want to use your own template
            ->title($period->title . ' || $' . $period->getMercurialAmount())
            ->labels($chartValues->pluck('title')->toArray())
            ->values($balances)
            ->dimensions(500,500)
            ->responsive(true);

        return view('periods.index', compact('periods', 'chart'));
    }

    public function show(Period $period)
    {
        $period->setAmounts();

        $accountCategories = AccountNameEnum::all();

        $category = CategoryEnum::all();

        $chartValues = $period->getMercurialChartVars();

        $values = $chartValues->pluck('balance');
        $balances = [];
        foreach ($values as $balance) { $balances[] = abs($balance);}

        $chart = Charts::create('pie', 'highcharts')
//            ->view('custom.line.chart.view') // Use this if you want to use your own template
            ->title($period->title . ' || $' . $period->getMercurialAmount())
            ->labels($chartValues->pluck('title')->toArray())
            ->values($balances)
            ->dimensions(500,500)
            ->responsive(true);

        return view('periods.show', compact('period', 'accountCategories', 'category', 'chart'));
    }

    public function store(Request $request)
    {
        if ($request->title == '') {
            throw new NotFoundHttpException('You suck at naming things.');
        }

        $period = new Period(['title' => $request->title, 'period_start' => new \DateTime($request->periodStart)]);
        $period->setUser(1);
        $period->save();

        return back();
    }

    public function destroy(Period $period)
    {
        $period->delete();
        return back();
    }
}
