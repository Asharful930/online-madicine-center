<?php

namespace App\Http\Controllers;

use App\medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;
use ArrayObject;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medicine.medicineEntry');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show(medicine $medicine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function editMedicine(medicine $medicine)
    {
        return view('medicine.updateMedicine', compact('medicine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function updateMedicine(Request $request, medicine $medicine)
    {
        $shop = Auth::guard('manager')->user();
        $shopID = $shop->id;
        $this->validate($request, [
            'medicine_id' => ['required', 'string', 'max:255'],
            'medicine_name' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'generic_name' => ['required', 'string', 'max:255'],
            'medicine_type' => ['required', 'string', 'max:255'],
            'medicine_price' => ['required', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/shops/' . $shop->shop_name . '/medicine/' . $filename;
            $file->move(public_path() . "/shops/" . $shop->shop_name . "/medicine/", $filename);
        } else {
            $path = $medicine->image;
        }
        $medicine->update([
            'medicine_id' => $request['medicine_id'],
            'medicine_name' => $request['medicine_name'],
            'company_name' => $request['company_name'],
            'generic_name' => $request['generic_name'],
            'medicine_type' => $request['medicine_type'],
            'medicine_price' => $request['medicine_price'],
            'description' => $request['description'],
            'image' => $path,
            'shop_id' => $shopID,

        ]);
        return redirect()->route('medicine.medicineList')->with('status', 'Update successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function delete(medicine $medicine)
    {
        $medicine->delete();
        return redirect()->route('manager.medicineList')->with('status', 'Item Deleted Successfully');
    }


    protected function MedicineEntry(Request $request)
    {
        $shop = Auth::guard('manager')->user();
        $shopID = $shop->id;
        $this->validate($request, [
            'medicine_id' => ['required', 'string', 'max:255', 'unique:medicines'],
            'medicine_name' => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'generic_name' => ['required', 'string', 'max:255'],
            'medicine_type' => ['required', 'string', 'max:255'],
            'medicine_price' => ['required', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'image' =>  'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $path = '/shops/' . $shop->shop_name . '/medicine/' . $filename;
            $file->move(public_path() . "/shops/" . $shop->shop_name . "/medicine/", $filename);
        }
        $medicine = medicine::create([
            'medicine_id' => $request['medicine_id'],
            'medicine_name' => $request['medicine_name'],
            'company_name' => $request['company_name'],
            'generic_name' => $request['generic_name'],
            'medicine_type' => $request['medicine_type'],
            'medicine_price' => $request['medicine_price'],
            'description' => $request['description'],
            'image' => $path,
            'shop_id' => $shopID,

        ]);
        return redirect()->route('medicine.medicineList')->with('status', 'Medicine successfully!');
    }
    public function medicineList()
    {
        $medicines = Auth::guard('manager')->user()->medicines;
        return view('medicine.medicineList', compact('medicines'));
    }
    public function searchMedicines(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $lat = $request->lat;
        $lon = $request->lng;
        $medicines = Medicine::where('medicine_name', 'like', '%' . $request->name . '%')->get();

        if ($lat == null || $lon == null) {
            foreach ($medicines as $medicine) {
                $medicine->distance = "We had some problems during counting 'Distance' from Shop!";
            }
        } else {
            $shops = $medicines->unique('shop');
            $distances = new ArrayObject();
            $shopDistance = array();
            foreach ($shops as $shop) {
                $shopDistance['shop_id'] = $shop->shop->id;
                $shopDistance['distance'] = $this->distance($lat, $lon, $shop->shop->latitude, $shop->shop->longitude);
                $distances->append($shopDistance);
            }
            foreach ($medicines as $medicine) {
                foreach ($distances as $distance) {
                    if ($medicine->shop->id == $distance['shop_id']) {
                        $medicine->distance = $distance['distance'];
                    }
                }
            }
            $medicines = $medicines->sortBy('distance');
        }
        return view('searchresult',compact('medicines'));
    }

    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $client = new \GuzzleHttp\Client();
        $request = $client->get('https://graphhopper.com/api/1/route?point=' . $lat1 . ',' . $lon1 . '&point=' . $lat2 . ',' . $lon2 . '&vehicle=car&debug=true&key=81ec716b-80d8-48a3-a971-792151d05978&type=json&points_encoded=false');
        $response = json_decode($request->getBody());
        return $response->paths[0]->distance;
    }
}
