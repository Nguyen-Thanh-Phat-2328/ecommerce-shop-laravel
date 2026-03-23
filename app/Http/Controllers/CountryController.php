<?php

namespace App\Http\Controllers;

use App\Http\Requests\InsertCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('admin/country/country', compact('countries'));
    }

    public function add() {
        
        return view('admin/country/add-country');
    }

    public function insert(InsertCountryRequest $request) {
        $newCountry = new Country();

        $newCountry->name = $request->name;
        $newCountry->save();

        return redirect('admin/country');
    }

    public function edit($id) {
        $country = Country::where('id', $id)->get();
        return view('admin/country/edit-country', compact('country'));
    }

    public function update(UpdateCountryRequest $request, $id) {
        if(Country::where('id', $id)->update(['name' => $request->name])) {
            return redirect() -> back() -> with('success', __('Update country thành công'));
        } else {
            return redirect() -> back() -> withErrors('Update thất bại');
        }
    }

    public function delete($id) {
        if(Country::where('id', $id)->delete()) {
            return redirect('/admin/country');
        } else {
            return redirect() -> back() -> withErrors('Delete thất bại');
        }
    }
}
