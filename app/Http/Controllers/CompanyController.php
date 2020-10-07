<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class CompanyController extends Controller
{
    private const ROW = '`id`,`title`,`description`';

    /**
     * Display a listing of the resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function index()
    {
        $companies = DB::table('companies')->select(DB::raw(self::ROW))->paginate(10);
        return view('companies.index', compact('companies'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(Request $request)
    {
        $validatedDate = $this->validateCompany($request);
        $logoPath = null;
        if(request('logo')) {
            $logoPath = request('logo')->store('uploads', 'public');
        }

        //dd($logoPath);

        //$logo = Image::make(public_path("storage/{$logoPath}"))->fit(1200, 1200);
        //$logo->save();

        $company = new Company();

        $company->setAttrs([
            'title' => $validatedDate['title'],
            'description' => $validatedDate['description'],
            'logo_url' => $logoPath,
        ])->save();

        return redirect('/company/');
    }

    /**
     * Display the specified resource.
     *
     * @param Company $company
     * @return void
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Company $company
     * @return Response
     */
    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Company $company
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Company $company)
    {
        $validatedDate = $this->validateCompany($request);
        $logoPath = null;
        if(request('logo')) {
            $logoPath = request('logo')->store('uploads', 'public');
        }
        $company->setAttrs([
            'title' => $validatedDate['title'],
            'description' => $validatedDate['description'],
            'logo_url' => $logoPath ,
        ])->save();

        return redirect(dirname(url()->previous()))->with('success', 'Address Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Company $company
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy(Company $company)
    {
        try {
            $company->delete();
        } catch (\Exception $e) {
            return redirect("/company/" . $company->id)->with('error', 'Error');
        }
        return redirect("/company")->with('success', 'Deleted successfully');
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateCompany (Request $request)
    {
        return $request->validate([
            'description' => ['required','max:1024'],
            'title' => ['required','max:255'],
            'logo' => ['image'],
        ]);
    }
}
