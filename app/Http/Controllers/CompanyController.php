<?php

namespace App\Http\Controllers;

use App\DataTables\CompanyDataTable;
use Illuminate\Http\Request;
use App\Models\Company;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;
use App\Traits\Support\ResolveMedia;
use Illuminate\Support\Facades\File;

class CompanyController extends Controller
{
    use ResolveMedia;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(CompanyDataTable $dataTable)
    {
        return $dataTable->render('companies.index');
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
		$trigger = false;
		if ($request->exists('company_image')) {
			$trigger = true;
			$request->validate(['company_image' => 'image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=100,min_height=100']);
		}
		
        $request->validate([
			'company_name'=>'required',
        ]);
		
        $company = new Company([
            'name' => $request['company_name'],
            'email' => $request['company_email'],
            'website' => $request['company_website'],
        ]);
		
		if ($trigger) {
            $fileName = $request['company_name'] . '.' . request()->company_image->getClientOriginalExtension();
            $imagePath = $request->file('company_image')->storeAs('public/Logo', $fileName);
            $company->logo = Storage::url($imagePath);
		}

        $company->save();

        Alert::success('', 'Company created successfully!');

        return redirect()->route('companies.index');
    }

    public function edit($id)
    {
        $company = Company::where('id', $id)->first();

        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {
		$trigger = false;
		if ($request->exists('company_image')) {
			$trigger = true;
			$request->validate(['company_image' => 'image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=100,min_height=100']);
		}
		
        $request->validate([
			'company_name'=>'required',
        ]);

        $company = Company::find($id);
		$company->name = $request['company_name'];
		$company->email = $request['company_email'];
		$company->website = $request['company_website'];
		
		if ($trigger) {
            $fileName = $request['company_name'] . '.' . request()->company_image->getClientOriginalExtension();
            $imagePath = $request->file('company_image')->storeAs('public/Logo', $fileName);
            $company->logo = Storage::url($imagePath);
		}

        $company->save();

        Alert::success('', 'Company updated successfully!');

        return redirect()->route('companies.index');
    }

    public function destroy($id)
    {
        $company = Company::find($id);
		
        $company->delete();

        Alert::success('', 'Company deleted successfully!');

        return redirect()->route('companies.index');
    }

    public function export()
    {
        $file = Company::REPORT_FILE_NAME . time() . '.csv';
        $path = Company::CSV_PATH;

        $full_path = $this->createDirectory(public_path('storage/' . $path));
        $full_file_path = $full_path . '/' . $file;

        if (!File::exists($full_file_path)) {
            $handle = fopen($full_file_path, 'ab');
            fputcsv($handle, [
                'Name',
                'Email Address',
                'Website',
            ]); 

            Company::query()
                ->lazyById(2000, 'id')->each(function ($company) use ($handle) {
                    $data =  [
                        $company->name,
                        $company->email ?? '',
                        $company->website ?? '',
                    ];
                    fputcsv($handle, $data);
                });
        }

        return response()->download($full_file_path);
    }
}