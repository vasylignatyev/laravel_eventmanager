<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AddressController extends Controller
{
    private const ROW = '`id`,`zip`,`country`,`region`,`locality`,`street`,`office`,`email`';
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $addresses = DB::table('addresses')->select(DB::raw(self::ROW))->paginate(10);
        return view('addresses.index', compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('addresses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     * @throws \Throwable
     */
    public function store(Request $request)
    {
        $address = new Address();
        $address->setAttrs($this->validateAddress($request))->save();

        return redirect("/address")->with('success', 'Address Added');
    }

    /**
     * Display the specified resource.
     *
     * @param Address $address
     * @return Application|Factory|Response|View
     */
    public function show(Address $address)
    {
        return view('addresses.show', compact('address'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Address $address
     * @return Application|Factory|View|void
     */
    public function edit(Address $address)
    {
        return view('addresses.edit', compact('address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Address $address
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Address $address)
    {
        $address->setAttrs($this->validateAddress($request))->save();
        return redirect(dirname(url()->previous()))->with('success', 'Address Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Address $address
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy(Address $address)
    {
        try {
            $address->delete();
        } catch (\Exception $e) {
            return redirect("/address")->with('error', 'Error');
        }
        return redirect("/address")->with('success', 'Address Deleted');
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateAddress(Request $request)
    {
        return $request->validate([
            'zip' => 'required|max:30',
            'country' => 'required|max:255',
            'region' => 'required|max:255',
            'locality' => 'required|max:255',
            'street' => 'required|max:255',
            'office' => 'required|max:255',
            'email' => 'required|email|max:50',
        ]);
    }
}
