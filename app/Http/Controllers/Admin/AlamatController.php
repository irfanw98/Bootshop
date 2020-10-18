<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Alamat;

class AlamatController extends Controller
{
    public function index()
    {
        $title = 'Alamatku';
        $provinsi = $this->getProvinsi();
        return view('admin.alamat.index', compact('title', 'provinsi'));
    }

    public function getProvinsi()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 611c7ae969a1b48f0dfe5cb808e0d04a"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // echo "cURL Error #:" . $err;
        } else {
            // echo $response;
        }
        return json_decode($response);
    }

    public function getKotaAjax($provinsi)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=$provinsi",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "key: 611c7ae969a1b48f0dfe5cb808e0d04a"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            // echo "cURL Error #:" . $err;
        } else {
            // echo $response;
        }
        return response()->json([
            'data' =>  json_decode($response)
        ]);
    }

    public function store(Request $request)
    {
        $data = new Alamat();
        $data->provinsi = $request->provinsi;
        $data->kota = $request->kota;
        $data->save();
        // $Alamat() = Alamat()::create($request->all());
        return redirect()->back()->with('status', 'Data berhasil ditambahkan');
    }
}
