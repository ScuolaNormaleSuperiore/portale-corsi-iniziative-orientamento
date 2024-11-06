<?php namespace App\Http\Controllers;

use Gecche\Cupparis\ModelSkeleton\Controllers\ModelSkeletonController as CupparisModelSkeletonController;
use Illuminate\Http\Request;


class ModelSkeletonController extends CupparisModelSkeletonController
{
    public function __construct(Request $request)
    {

        parent::__construct($request);

        $this->middleware('superuser');

    }
}
