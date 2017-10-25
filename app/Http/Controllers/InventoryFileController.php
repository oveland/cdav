<?php

namespace App\Http\Controllers;
use Storage;
use Image;
use PDF;
use App\Inventory;
use App\InventoryFile;
use Illuminate\Http\Request;

class InventoryFileController extends Controller
{
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
        return response()->file(Storage::url($inventoryFile->url));
    }

    /**
     * @param InventoryFile $inventoryFile
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadFile(InventoryFile $inventoryFile)
    {
        return response()->download(Storage::url($inventoryFile->url));
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
        } catch (\Exception $e) {
            return 'error';
        }
    }
}
