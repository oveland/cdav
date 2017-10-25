<?php

namespace App\Http\Controllers;

use App\CarsInventory;
use App\CarsProprietary;
use App\Http\Requests\StoreInventory;
use App\Inventory;
use App\InventoryProcess;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Mockery\Exception;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inventories.index');
    }

    public function ajax($action, Request $request)
    {
        if ($request->isXmlHttpRequest() || true) {
            /* **** ACTIONS RETURNING A VIEW TEMPLATE **** */
            switch ($action) {
                /* Load view for create a new inventory */
                case 'newInventory':
                    return view('inventories.ajax.create_inventory');
                    break;
                /* Load inventory detail view */
                case 'loadCarProcessDetail':
                    $inventoryProcess = InventoryProcess::find($request->get('id'));
                    return view('inventories.ajax.inventory_detail', compact('inventoryProcess'));
                    break;
                /* Load phase 1 table */
                case 'loadPhase1Table':
                    $abandonedVehicles = InventoryProcess::abandoned()->get()->filter(function ($abandonedVehicle, $key) {
                        return $abandonedVehicle->canPassToPhase2();
                    });
                    $inventoryProcesses = InventoryProcess::phase1()->get();
                    return view('inventories.ajax.phase1-table', compact(['inventoryProcesses', 'abandonedVehicles']));
                    break;
                /* Load phase 2 table */
                case 'loadPhase2Table':
                    $inventoryProcesses = InventoryProcess::phase2()->get();
                    return view('inventories.ajax.phase2-table', compact('inventoryProcesses'));
                    break;
                /* Load phase 3 table */
                case 'loadPhase3Table':
                    $inventoryProcesses = InventoryProcess::phase3()->get();
                    return view('inventories.ajax.phase3-table', compact('inventoryProcesses'));
                    break;
                /* Load View for notification description */
                case 'loadViewDescriptionNotification':
                    $inventoryProcess = InventoryProcess::find($request->get('id'));
                    $viewName = 'inventories.ajax.generate_personal_notification';
                    if ($inventoryProcess->withPersonalNotification()) $viewName = 'inventories.ajax.generate_notice_notification';
                    return view($viewName, compact('inventoryProcess'));
                    break;
            }

            /* **** ACTIONS RETURNING A SIMPLE RESPONSE **** */
            switch ($action) {
                /* Process inventories to phase 2 if your date created is a year ago */
                case 'autoPassToPhase2':
                    $abandonedVehicles = InventoryProcess::abandoned()->get()->filter(function ($abandonedVehicle, $key) {
                        $canPassToPhase2 = $abandonedVehicle->canPassToPhase2();
                        if ($canPassToPhase2) {
                            $abandonedVehicle->phase = InventoryProcess::ABANDONMENT_PHASE;
                            $abandonedVehicle->started = false;
                        }
                        return $canPassToPhase2 && $abandonedVehicle->save();
                    });

                    return $abandonedVehicles->count() . ' ' . __('vehicles passed to phase 2');
                    break;

                /* Set Abandonment State */
                case 'setAbandonmentstate':
                    $abandonedVehicles = InventoryProcess::isEndAbandonedState()->get()->filter(function ($abandonedVehicle, $key) {
                        $abandonedVehicle->phase = InventoryProcess::ESTRANGEMENT_PHASE;
                        $abandonedVehicle->started = false;
                        return $abandonedVehicle->save();
                    });

                    return $abandonedVehicles->count() . ' ' . __('vehicles passed to phase 3');
                    break;
                /* Process inventory to phase 2 */
                case 'processToPhase2':
                    $inventoryProcess = InventoryProcess::find($request->get('id'));
                    if ($inventoryProcess->canPassToPhase2()) {
                        $inventoryProcess->phase = InventoryProcess::ABANDONMENT_PHASE;
                        $inventoryProcess->setStateToInitialPhase()->save();
                    }
                    return "success";
                    break;
                /* Process inventory to phase 3 */
                case 'processToPhase3':
                    $inventoryProcess = InventoryProcess::find($request->get('id'));
                    $inventoryProcess->phase = InventoryProcess::ESTRANGEMENT_PHASE;
                    $inventoryProcess->setStateToInitialPhase()->save();
                    return "success";
                    break;
                /* Start Next Phase for Notification Process */
                case 'startNextNotificationPhaseProcess':
                    $inventoryProcess = InventoryProcess::find($request->get('id'));
                    $inventoryProcess->notification_phase++;
                    $inventoryProcess->date_notification_phase = Carbon::now();
                    $inventoryProcess->observations = $request->get('observations');
                    $inventoryProcess->save();
                    return "success";
                    break;
                /* Response to Sub-Phase Process */
                case 'responseToNotificationPhaseProcess':
                    $inventoryProcess = InventoryProcess::find($request->get('id'));
                    $inventoryProcess->setStateToInitialPhase()->save();
                    return "success";
                    break;
                /* Start Inventory Phase Process */
                case 'startInventoryPhaseProcess':
                    $inventoryProcess = InventoryProcess::find($request->get('id'));
                    $inventoryProcess->started = true;
                    $inventoryProcess->save();
                    return "success";
                    break;
            }
        }
        return view('inventories.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreInventory|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInventory $request)
    {
        $params = $request->all();
        $response = (object)['success' => true, 'message' => ''];

        try {
            $inventory = Inventory::create($params);
            $proprietary = CarsProprietary::create($params);

            $car = new CarsInventory($params);
            $car->inventory()->associate($inventory);
            $proprietary->car()->save($car);

            $inventory->inventoryProcesses()->save(new InventoryProcess(['phase' => InventoryProcess::INIT_INVENTORY_PHASE, 'started' => true]));

            $response->message = __('Inventory created successfully');
        } catch (Exception $e) {
            $response->success = false;
            $response->message = __('Error saving inventory register');
        }

        return response()->json($response);
    }
}
