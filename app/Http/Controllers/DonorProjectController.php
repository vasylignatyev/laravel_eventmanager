<?php


namespace App\Http\Controllers;


use App\Models\Donor;
use App\Models\Project;
use App\Repositories\DonorProjectRepository;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class DonorProjectController
{
    private DonorProjectRepository $donorProjectRepository;

    public function __construct()
    {
        $donorProjectRepository = new DonorProjectRepository();
    }

    /**
     * @param Donor $donor
     * @return Application|Factory|View
     */
    public function addProjectToDonor(Donor $donor)
    {
        return view('donors_projects.addProject', compact('donor'));
    }

    /**
     * @param Donor $donor
     * @param Project $project
     */
    public function create(Donor $donor, Project $project)
    {

    }

    /**
     * @param Donor $donor
     * @param Project $project
     */
    public function update(Donor $donor, Project $project)
    {

    }

    /**
     * @param Project $project
     * @return Application|Factory|View
     */
    public function editDonors(Project $project)
    {
        $currentDonors = $project->donors()->get();
        $availableDonors = DonorProjectRepository::getAvailableDonors($project->id);
        return view('donors_projects.editDonors', compact('project', 'currentDonors','availableDonors'));
    }

    /**
     * @param Request $request
     * @param int $project_id
     */
    public function saveDonors(Request $request, int $project_id)
    {
        $request->request->add(['project_id' => $project_id]);
        $validatedValues =$request->validate([
            'donors'   => 'array',
            'donors.*' => 'integer',
            'project_id' => 'integer',
        ]);
        DonorProjectRepository::saveDonors($validatedValues['project_id'], $validatedValues['donors']);
    }

    /**
     * @param Donor $donor
     */
    public function editProjects(Donor $donor)
    {
        $currentProjects = $donor->projects()->get();
        $availableProjects = DonorProjectRepository::getAvailableProjects($donor->id);
        return view('donors_projects.editProjects', compact('donor', 'currentProjects','availableProjects'));
    }

    public function saveProjects(Request $request, int $donor_id)
    {
        $request->request->add(['donor_id' => $donor_id]);
        $validatedValues =$request->validate([
            'projects'   => 'required|array',
            'projects.*' => 'integer',
            'donor_id' => 'required|integer',
        ]);
        DonorProjectRepository::saveProjects($validatedValues['donor_id'], $validatedValues['projects']);
    }


}
