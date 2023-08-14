<?php

namespace Morethingsdigital\VercelStatamic\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Morethingsdigital\VercelStatamic\Dtos\Deployments\CreateDeploymentDto;
use Morethingsdigital\VercelStatamic\Services\Vercel\DeploymentService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class DeploymentController extends Controller
{


    public function __construct(private readonly DeploymentService $deploymentService)
    {
    }

    public function index(Request $request)
    {
        $page = $request->has('page') ? $request->get('page') : 1;
        $target = $request->has('target') ? $request->get('target') : null;

        $data = $this->deploymentService->find(projectId: $this->deploymentService->getProjectId(), limit: 10 * $page, target: $target);

        $latestDeployment = $data && $data->deployments ? $data->deployments[0] : null;

        return view('vercel-statamic::deployments.index', [
            'title' =>  $this->generateTitle(['Vercel', 'Deployments']),
            'deployments' => $data->deployments,
            'pagination' => $data->pagination,
            'target' => $target,
            'latestDeploymentId' => $latestDeployment ? $latestDeployment->id : null
        ]);
    }

    public function redeploy(string $id)
    {
        try {
            if (!$id) throw new HttpException(Response::HTTP_BAD_REQUEST, 'id is required');

            $deployment = $this->deploymentService->findOne($id);

            if (!$deployment) throw new HttpException(Response::HTTP_NOT_FOUND, 'deployment not found');

            Log::info('deployment abgeholt');

            $createDploymentDto = new CreateDeploymentDto($deployment->name, $deployment->id);

            Log::info('dto erstellt');

            $redeployment = $this->deploymentService->redeploy($createDploymentDto);

            Log::info('redeploy getriggert');

            if (!$redeployment) throw new HttpException(Response::HTTP_INTERNAL_SERVER_ERROR, 'redeployment failed');

            Log::info('redeploy ergebnis gechekct');

            return redirect()->route('statamic.cp.vercel-statamic.deployments.index');
        } catch (HttpException $exception) {
            Log::info($exception->__toString());
        } catch (\Exception $exception) {
            Log::info($exception->__toString());
        }
    }

    public function show()
    {
        $data = $this->deploymentService->find($this->deploymentService->getProjectId());

        return view('vercel-statamic::deployments.index', [
            'title' =>  $this->generateTitle(['Vercel', 'Deployments']),
            'deployments' => $data['deployments'],
            'pagination' => $data['pagination']
        ]);
    }
}
