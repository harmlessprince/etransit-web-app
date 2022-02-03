<?php


namespace App\Http\ViewComposers;
use App\Models\Tenant;
use Illuminate\View\View;

class TenantComposer
{

    public $companyName = '';
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        $name  = Tenant::where('id', session()->get('tenant_id'))->first();
        $this->companyName = $name->company_name ?? '';
    }
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('tenantCompanyName', $this->companyName);
    }

}
