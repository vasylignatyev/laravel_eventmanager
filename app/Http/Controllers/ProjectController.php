<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $projects = DB::table('projects')->orderBy('start_date')->paginate();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function store(Request $request)
    {
        $project = new Project();
        $project->setAttrs($this->validateProject($request))->save();
        return redirect('/project');
    }

    /**
     * Display the specified resource.
     *
     * @param Project $project
     * @return Application|Factory|Response|View
     */
    public function show(Project $project)
    {
        $donors = $project->donors()->get();
        return view('projects.show', compact('project', 'donors'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Project $project
     * @return Application|Factory|Response|View
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Project $project
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function update(Request $request, Project $project)
    {
        //dd($request);
        $project->setAttrs($this->validateProject($request))->save();
        //dd($project);
        return redirect('/project');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Project $project
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy(Project $project)
    {
        try {
            $project->delete();
            return redirect('/project')->with("Deleted Successfully");
        } catch (\Exception $e) {
            return redirect('/project')->withErrors("Deleted Unsuccessfully");
        }
    }

    /**
     * @param Request $request
     */
    private function validateProject(Request $request) {
        $validatedDate = $request->validate([
            'title' => ['required','max:255'],
            'short_desc' => ['max:255'],
            'full_desc' => ['max:4095'],
            'logo' => ['max:255'],
            'start_date' => ['date'],
            'end_date' => ['date'],
        ]);

        $logoPath = null;
        if(request('logo')) {
            $logoPath = request('logo')->store('uploads', 'public');
        }

        unset($validatedDate['logo']);
        $validatedDate['logo_url'] = $logoPath;

        return $validatedDate;
    }
}
