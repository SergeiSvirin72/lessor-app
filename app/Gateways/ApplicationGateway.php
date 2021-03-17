<?php

namespace App\Gateways;

use App\Http\Requests\Applications\ApplicationWebCreateRequest;
use App\Models\Application;

class ApplicationGateway
{
    public function create(ApplicationWebCreateRequest $request)
    {
        $application = new Application($request->validated());
        $request->room->applications()->save($application);
        return $application;
    }

    public function update(Application $application)
    {
        $application->update(['status' => false]);
        return $application;
    }
}