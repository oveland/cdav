<?php

namespace App\Http\Controllers;

use App\CarsInventory;
use App\CarsProprietary;
use App\Http\Requests\StoreInventory;
use App\Inventory;
use App\InventoryProcess;
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
            switch ($action) {
                case 'newInventory':
                    return view('inventories.ajax.create_inventory');
                    break;
                case 'processToPhase2':
                    $inventoryProcess = InventoryProcess::find($request->get('id'));
                    $inventoryProcess->phase = 2;
                    $inventoryProcess->save();
                    return "success";
                    break;
                case 'processToPhase3':
                    $inventoryProcess = InventoryProcess::find($request->get('id'));
                    $inventoryProcess->phase = 3;
                    $inventoryProcess->save();
                    return "success";
                    break;
                case 'loadCarProcessView':
                    $inventoryProcess = InventoryProcess::find($request->get('id'));
                    return view('inventories.ajax.inventory_detail',compact('inventoryProcess'));
                    break;
                case 'loadPhase1Table':
                    $inventoryProcesses = InventoryProcess::phase1()->get();
                    return view('inventories.ajax.phase1-table', compact('inventoryProcesses'));
                    break;
                case 'loadPhase2Table':
                    $inventoryProcesses = InventoryProcess::phase2()->get();
                    return view('inventories.ajax.phase2-table', compact('inventoryProcesses'));
                    break;
                case 'loadPhase3Table':
                    $inventoryProcesses = InventoryProcess::phase3()->get();
                    return view('inventories.ajax.phase3-table', compact('inventoryProcesses'));
                    break;
            }
        }
        return view('inventories.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $response = (object)['error' => false, 'message' => ''];

        try {
            $inventory = Inventory::create($params);
            $proprietary = CarsProprietary::create($params);

            $car = new CarsInventory($params);
            $car->inventory()->associate($inventory);
            $proprietary->car()->save($car);

            $inventory->inventoryProcesses()->save(new InventoryProcess(['phase' => 1]));

            $response->message = __('Inventory created successfully');
        } catch (Exception $e) {
            $response->error = true;
            $response->message = __('Error saving inventory register');
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Inventory $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Inventory $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Inventory $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Inventory $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}
