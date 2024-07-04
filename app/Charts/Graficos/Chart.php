<?php

namespace App\Charts\Graficos;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class Chart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

        public function index(Chart $chart)
    {
        
        return view('livewire.modulo.modulo-component1', ['chart' => $chart->build()]);
    } 
    // eturn view('livewire.modulo.modulo-component',$this->modulos)->extends('layouts.adminlte')
    // ->section('content');
    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        return $this->chart->areaChart()
            ->setTitle('Sales during 2021.')
            ->setSubtitle('Physical sales vs Digital sales.')
            ->addData('Physical sales', [40, 93, 35, 42, 18, 82])
            ->addData('Digital sales', [70, 29, 77, 28, 55, 45])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    }
}
