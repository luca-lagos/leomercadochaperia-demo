<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeRepairRequest;
use App\Http\Requests\updateRepairRequest;
use App\Models\Repair;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class repairController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $repairs = DB::table('repairs')->latest()->get();
        /*dd($repairs);*/
        return view('repairs.index', ['repairs' => $repairs]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('repairs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeRepairRequest $request)
    {
        try {
            DB::beginTransaction();
            $repair = new Repair();
            if ($request->hasFile('image_path')) {
                $name = $repair->handleUploadImage($request->file('image_path'));
            } else {
                $name = null;
            }
            $repair->fill([
                'fullname' => $request->fullname,
                'dni' => $request->dni,
                'phone' => $request->phone,
                'location' => $request->location,
                'vehicle' => $request->vehicle,
                'image_path' => $name,
                'type_repair' => $request->type_repair,
                'price' => $request->price,
                'details' => $request->details,
            ]);
            $repair->save();
            DB::commit();
        } catch (Exception $e) {
            error_log($e);
            info($e);
            DB::rollBack();
        }
        return redirect()->route('repairs.index')->with('success', 'Presupuesto creado correctamente :)');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Repair $repair)
    {
        return view('repairs.edit', ['repair' => $repair]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateRepairRequest $request, Repair $repair)
    {
        try {
            DB::beginTransaction();
            if ($request->hasFile('image_path')) {
                $name = $repair->handleUploadImage($request->file('image_path'));
                if (Storage::disk('public')->exists('repairs/' . $repair->image_path)) {
                    Storage::disk('public')->delete('repairs/' . $repair->image_path);
                }
            } else {
                $name = $repair->image_path;
            }
            $repair->fill([
                'fullname' => $request->fullname,
                'dni' => $request->dni,
                'phone' => $request->phone,
                'location' => $request->location,
                'vehicle' => $request->vehicle,
                'image_path' => $name,
                'type_repair' => $request->type_repair,
                'price' => $request->price,
                'details' => $request->details,
            ]);
            $repair->save();
            DB::commit();
        } catch (Exception $e) {
            error_log($e);
            info($e);
            DB::rollBack();
        }
        return redirect()->route('repairs.index')->with('success', 'Presupuesto actualizado correctamente :)');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $repair = Repair::find($id);
        if ($repair->status == 1) {
            Repair::where('id', $repair->id)->update([
                'status' => '0'
            ]);
        } else {
            Repair::where('id', $repair->id)->update([
                'status' => '1'
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Estado actualizado correctamente :)');
    }

    public function confirm_repaired(string $id)
    {
        $repair = Repair::find($id);
        if ($repair->status != 2) {
            Repair::where('id', $repair->id)->update([
                'status' => '2'
            ]);
        } else {
            Repair::where('id', $repair->id)->update([
                'status' => '1'
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Estado actualizado correctamente :)');
    }
}
