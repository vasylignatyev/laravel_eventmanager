<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CustomerController extends Controller
{
    private const ROW = '`id`,`email`,UNHEX(`password`),`first_name`,`second_name`,`last_name`,`sex`,UNXEX(`token`),`options`';

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        $customers = Customer::with('company')->paginate();
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|Response|View
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector|void
     */
    public function store(Request $request)
    {
        $validatedDate = $this->validateCustomer($request);
        $logoPath = null;
        if(request('logo')) {
            $logoPath = request('logo')->store('uploads', 'public');
        }

        $customer = new Customer();

        $customer->setAttrs($this->validateCustomer($request))->save();

        return redirect('/customer/');
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return void
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * select com.title, cus.first_name from companies com left join customers cus ON com.id = cus.company_id and cus.id = 17;
     *
     * @param Customer $customer
     * @return Application|Factory|View|void
     */
    public function edit(Customer $customer)
    {
        $companies = DB::table('companies')
            ->leftJoin('customers', function($join) use ($customer)
                {
                    $join->on('companies.id', '=', 'customers.company_id');
                    $join->on('customers.id', '=', DB::raw($customer->id));
                })
            ->select([
                'companies.id as company_id',
                'companies.title',
                'customers.id as customer_id',
            ])
            ->orderBy('companies.title', 'desc')
            ->get();
        //dd($companies);
        return view('customers.edit', compact('customer','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Customer $customer
     * @return void
     */
    public function update(Request $request, Customer $customer)
    {
        $validatedData = $request->validate([
            'first_name' => ['required','max:50'],
            'second_name' => ['max:50'],
            'last_name' => ['max:50'],
            'email' => ['required','email'],
            //'password' => ['required','confirmed'],
            'sex' => ['required','in:F,M'],
            'company_id' => ['integer']
        ]);
        if(empty($validatedData['company_id'])) {
            $validatedData['company_id'] = null;
        }
        //dd($validatedData);
        $customer->setAttrs($validatedData)->save();
        return redirect('/customer/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param Request $request
     * @return array
     */
    private function validateCustomer (Request $request)
    {
        return $request->validate([
            'first_name' => ['required','max:50'],
            'second_name' => ['max:50'],
            'last_name' => ['max:50'],
            'email' => ['required','email','unique:customers'],
            'password' => ['required','confirmed'],
            'sex' => ['required','in:F,G'],
            'company' => ['integer']
        ]);
    }
}
