<?php

namespace App\Http\Controllers;

use App\CarsInventory;
use App\CarsProprietary;
use App\Http\Requests\StoreInventory;
use App\Inventory;
use App\InventoryFile;
use App\InventoryProcess;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
use PDF;
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
                    $inventoryProcess->started = false;
                    $inventoryProcess->save();
                    return "success";
                    break;
                case 'processToPhase3':
                    $inventoryProcess = InventoryProcess::find($request->get('id'));
                    $inventoryProcess->phase = 3;
                    $inventoryProcess->started = false;
                    $inventoryProcess->notification_phase = 0;
                    $inventoryProcess->date_notification_phase = Carbon::now();
                    $inventoryProcess->save();
                    return "success";
                    break;
                case 'loadCarProcessView':
                    $inventoryProcess = InventoryProcess::find($request->get('id'));
                    return view('inventories.ajax.inventory_detail', compact('inventoryProcess'));
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
                case 'startInventoryPhaseProcess':
                    $inventoryProcess = InventoryProcess::find($request->get('id'));
                    $inventoryProcess->started = true;
                    $inventoryProcess->save();
                    return "success";
                    break;
                case 'startNextEstrangementProcess':
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

            $inventory->inventoryProcesses()->save(new InventoryProcess(['phase' => 1, 'started' => true]));

            $response->message = __('Inventory created successfully');
        } catch (Exception $e) {
            $response->success = false;
            $response->message = __('Error saving inventory register');
        }

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Inventory $inventory
     * @param  Request $request
     * @return \Illuminate\Http\Response
     * @internal param CarsInventory $carsInventory
     */
    public function storeFiles(Inventory $inventory, Request $request)
    {
        $file = $request->file('file');
        if ($file && $file->isValid()) {
            $path = $file->store('inventory/files/' . $inventory->id, 'public');
            $inventory->files()->save(new InventoryFile([
                'name' => $file->getClientOriginalName(),
                'type' => $file->getMimeType(),
                'url' => $path,
            ]));
        }

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * @param Inventory $inventory
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function refreshPanelFiles(Inventory $inventory)
    {
        return view('inventories.ajax.inventory_files', compact('inventory'));
    }

    /**
     * @param InventoryFile $inventoryFile
     * @param Request $request
     * @return mixed
     */
    public function getImageFile(InventoryFile $inventoryFile, Request $request)
    {
        $image = Image::make($inventoryFile->getUrlFileImage());
        if ($request->get('thumbnail')) {
            $image->resize(200, 200);
        }
        return $image->response('jpg');
    }

    /**
     * @param InventoryFile $inventoryFile
     * @return mixed
     */
    public function previewFile(InventoryFile $inventoryFile)
    {
        return response()->file(\Storage::url($inventoryFile->url));
    }

    /**
     * @param InventoryFile $inventoryFile
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadFile(InventoryFile $inventoryFile)
    {
        return response()->download(\Storage::url($inventoryFile->url));
    }

    /**
     * @param InventoryFile $inventoryFile
     * @return string
     */
    public function deleteFormFile(InventoryFile $inventoryFile)
    {
        return view('inventories.ajax.inventory_delete_files', compact('inventoryFile'));
    }

    /**
     * @param InventoryFile $inventoryFile
     * @return string
     */
    public function deleteFile(InventoryFile $inventoryFile)
    {
        try {
            $inventoryFile->delete();
            return 'success';
        } catch (Exception $e) {
            return 'error';
        }
    }

    public function downloadReportPhase2()
    {
        $inventoryProcesses = InventoryProcess::phase2()->started()->get();
        //return view('inventories.reports.phase-2', compact('inventoryProcesses'));


        $pdf = PDF::loadView('inventories.reports.phase-2', ['inventoryProcesses' => $inventoryProcesses]);
        return $pdf->download(__('Abandonment Declaration') .' - '.date('Y-m-d'). '.pdf');
    }
}
