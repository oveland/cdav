<?php

namespace App\Http\Controllers;

use PDF;
use App\InventoryProcess;
use Illuminate\Http\Request;

class InventoryReportController extends Controller
{
    /* ******************** PHASE 2 ******************** */

    /**
     * @return mixed
     */
    public function downloadReportPersonalPhase2()
    {
        $inventoryProcesses = InventoryProcess::phase2()->personal()->get()->sortBy('inventory_id');
        $pdf = PDF::loadView('inventories.reports.personal-phase-2', ['inventoryProcesses' => $inventoryProcesses]);
        return $pdf->download(__('Abandonment - Personal') . ' - ' . date('Y-m-d') . '.pdf');
    }

    /**
     * @return mixed
     */
    public function downloadReportNoticePhase2()
    {
        $inventoryProcesses = InventoryProcess::phase2()->notice()->get()->sortBy('inventory_id');
        $pdf = PDF::loadView('inventories.reports.notice-phase-2', ['inventoryProcesses' => $inventoryProcesses]);
        return $pdf->download(__('Abandonment - Notice') . ' - ' . date('Y-m-d') . '.pdf');
    }

    /**
     * @return mixed
     */
    public function downloadReportPhase2()
    {
        $inventoryProcesses = InventoryProcess::phase2()->started()->get()->sortBy('inventory_id');
        $pdf = PDF::loadView('inventories.reports.phase-2', ['inventoryProcesses' => $inventoryProcesses]);
        return $pdf->download(__('Abandonment state') . ' - ' . date('Y-m-d') . '.pdf');
    }


    /* ******************** PHASE 3 ******************** */

    /**
     * @return mixed
     */
    public function downloadReportPersonalPhase3()
    {
        $inventoryProcesses = InventoryProcess::phase3()->personal()->get()->sortBy('inventory_id');
        $pdf = PDF::loadView('inventories.reports.personal-phase-3', ['inventoryProcesses' => $inventoryProcesses]);
        return $pdf->download(__('Estrangement - Personal') . ' - ' . date('Y-m-d') . '.pdf');
    }

    /**
     * @return mixed
     */
    public function downloadReportNoticePhase3()
    {
        $inventoryProcesses = InventoryProcess::phase3()->notice()->get()->sortBy('inventory_id');
        $pdf = PDF::loadView('inventories.reports.notice-phase-3', ['inventoryProcesses' => $inventoryProcesses]);
        return $pdf->download(__('Estrangement - Notice') . ' - ' . date('Y-m-d') . '.pdf');
    }

    /**
     * @return mixed
     */
    public function downloadReportPhase3()
    {
        $inventoryProcesses = InventoryProcess::phase3()->started()->get()->sortBy('inventory_id');
        $pdf = PDF::loadView('inventories.reports.phase-3', ['inventoryProcesses' => $inventoryProcesses]);
        return $pdf->download(__('Estrangement state') . ' - ' . date('Y-m-d') . '.pdf');
    }
}
