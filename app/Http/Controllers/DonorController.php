<?php

namespace App\Http\Controllers;

use App\Models\Donor;
use App\Repositories\DonorProjectRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DonorController extends Controller
{

    /**
     * @var DonorProjectRepository
     */
    private DonorProjectRepository $donorProjectRepository;

    /**
     * DonorController constructor.
     * @param DonorProjectRepository $donorProjectRepository
     */
    public function __construct(DonorProjectRepository $donorProjectRepository)
    {
        $this->donorProjectRepository = $donorProjectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $donors = DB::table('donors')->paginate();
        return view('donors.index', compact('donors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('donors.create');
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateDonor(Request $request)
    {
        return $request->validate([
            'title' => 'required|max:127',
            'short_desc' => 'max:127',
            'full_desc' => 'max:2047',
            'logo_url' => 'max:255',
            'tagline' => 'max:255',
            'country' => 'required|max:127',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(Request $request)
    {
        $validatedDate = $this->validateDonor($request);
        $logoPath = null;
        if(request('logo')) {
            $logoPath = request('logo')->store('uploads', 'public');
        }
        $donor = new Donor;

        //dd($validatedDate);
        $donor->setAttrs([
            'title' => $validatedDate['title'],
            'short_desc' => $validatedDate['short_desc'] ?? null,
            'full_desc' => $validatedDate['full_desc'] ?? null,
            'tagline' => $validatedDate['tagline'] ?? null,
            'country' => $validatedDate['country'] ?? null,
            'logo_url' => $logoPath,
        ])->save();

        return redirect('/donor')->with('success', 'Donor Created');
    }

    /**
     * Display the specified resource.
     *
     * @param Donor $donor
     * @return Application|Factory|Response|View
     */
    public function show(Donor $donor)
    {
        $projects = $donor->projects()->get();
        return view('donors.show', compact(['donor','projects']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Donor $donor
     * @return Application|Factory|Response|View
     */
    public function edit(Donor $donor)
    {
        return view('donors.edit', compact('donor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Donor $donor
     * @return Application|RedirectResponse|Redirector|void
     */
    public function update(Request $request, Donor $donor)
    {
        $validatedDate = $this->validateDonor($request);
        $logoPath = null;
        if(request('logo')) {
            $logoPath = request('logo')->store('uploads', 'public');
        }
        $donor->setAttrs([
            'title' => $validatedDate['title'],
            'short_desc' => $validatedDate['short_desc'],
            'full_desc' => $validatedDate['full_desc'],
            'tagline' => $validatedDate['tagline'],
            'country' => $validatedDate['country'],
            'logo_url' => $logoPath,
        ])->save();

        return redirect('/donor')->with('success', 'Donor Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Donor $donor
     * @return Application|RedirectResponse|Redirector
     * @throws \Exception
     */
    public function destroy(Donor $donor)
    {
        $donor->delete();
        return redirect("/donor")->with('success', 'Donor Deleted');
    }
}
