<?php


namespace App\Repositories;


use App\Models\Donor;
use App\Models\Project;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany as HasManyAlias;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DonorProjectRepository
{
    /**
     * @param Donor $donor
     * @return BelongsToMany
     */
    public function getByDonorId( Donor $donor)
    {
        return $donor->projects();
    }

    /**
     * @param Project $project
     * @return BelongsToMany
     */
    public function getByProjectId(Project $project)
    {
        return $project->donors();

    }

    /**
     * @param $carry
     * @param $item
     * @return mixed
     */
    private static function red($carry, $item)
    {
        array_push( $carry,array_values(get_object_vars($item))[0]);
        return $carry;
    }

    /**
     * SELECT * FROM `donors` where `id` NOT IN (SELECT `donor_id` from `donor_project` WHERE `project_id` = $project_id) ORDER BY `title`
     * @param int $projectId
     * @return Collection
     */
    public static function getAvailableDonors(int $projectId)
    {
        return(DB::table('donors')
            ->whereNotIn('id', array_reduce(DB::table('donor_project')
                ->where('project_id', $projectId)
                ->get('donor_id')
                ->toArray(), 'self::red', []))
            ->orderBy('title')
            ->get());
    }

    /**
     * SELECT * FROM `projects` where `id` NOT IN (SELECT `project_id` from `donor_project` WHERE `donor_id` = $donor_id) ORDER BY `title`
     * @param int $donorId
     * @return Collection
     */
    public static function getAvailableProjects(int $donorId)
    {
        return(DB::table('projects')
            ->whereNotIn('id', array_reduce(DB::table('donor_project')
                ->where('donor_id', $donorId)
                ->get('project_id')
                ->toArray(), 'self::red', []))
            ->orderBy('title')
            ->get());
    }

    /**
     * DELETE FROM `donor_project` WHERE `project_id` = $projectId
     * INSERT INTO `donor_project`(`project_id`, `donor_id`)
     *      VALUES ($projectId,$donorId)
     * @param int $projectId
     * @param array $donorsId
     * @return bool
     */
    public static function saveDonors(int $projectId, array $donorsId)
    {
        $donorProjectTable = DB::table('donor_project');
        $donorProjectTable
            ->where('project_id','=', $projectId)
            ->delete();

        $donorProjectArr = [];
        foreach ($donorsId as $donorId) {
            $donorProjectArr[] = ['project_id' => $projectId, 'donor_id' => $donorId];
        }
        (count($donorProjectArr) > 0) && $donorProjectTable->insert($donorProjectArr);
        return true;
    }

    /**
     * DELETE FROM `donor_project` WHERE `donor_id` = $projectId
     * INSERT INTO `donor_project`(`project_id`, `donor_id`)
     *      VALUES ($projectId,$donorId)
     * @param int $donorId
     * @param array $projectsId
     * @return bool
     */
    public static function saveProjects(int $donorId, array $projectsId)
    {
        //dd($projectsId);
        $donorProjectTable = DB::table('donor_project');
        $donorProjectTable
            ->where('donor_id','=', $donorId)
            ->delete();

        $donorProjectArr = [];
        foreach ($projectsId as $projectId) {
            $donorProjectArr[] = ['project_id' => $projectId, 'donor_id' => $donorId];
        }
        (count($donorProjectArr) > 0) && $donorProjectTable->insert($donorProjectArr);
        return true;
    }
}
