<?php


namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;


class TenantScope implements Scope
{

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Database\Eloquent\Model $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {

//        if(session()->has('tenant_id') )
//        {
//            $builder->where('tenant_id', session()->get('tenant_id'));
//        }
        if (Auth::guard('e-ticket')->hasUser()) {
            $user = Auth::guard('e-ticket')->user();
            $builder->where('tenant_id', $user->tenant_id);
        }


    }
}
