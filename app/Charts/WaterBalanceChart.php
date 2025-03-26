<?php

namespace App\Charts;
use App\Models\WaterMeterReading;

use marineusde\LarapexCharts\LarapexChart;
use marineusde\LarapexCharts\Charts\AreaChart AS OriginalAreaChart;
use marineusde\LarapexCharts\Options\XAxisOption;


class WaterBalanceChart
{
    public function build($poolID): OriginalAreaChart
    {
        

        $readings = WaterMeterReading::all();
        //$poolName = PoolList::where('pool_id', $poolID)->value('pool_name');
        $watermeterreadings = WaterMeterReading::where('plantroom_id', $poolID)->orderBy('created_at', 'desc')->get();
        $labels = [];
        $values = [];

        foreach ($watermeterreadings as $watermeterreading){
            $labels[]=$watermeterreading['created_at'];
            $values[]=$watermeterreading['difference'];

        }
        return (new OriginalAreaChart)
            ->setTitle('Water Balance Readings.')
            ->setSubtitle('Pool')
            ->addData('Daily Usage (Litres.)', $values)
            ->setXAxisOption(new XAxisOption($labels));
    }
}
