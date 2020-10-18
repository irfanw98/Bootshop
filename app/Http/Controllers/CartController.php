<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produk;
use App\Alamat;

class CartController extends Controller
{
    public function add($id)
    {
        $produk = Produk::find($id);

        //Cek isi keranjang apakah produk sudah ada atau belum
        $cek = \Cart::get($id);

        if ($cek == null) {
            \Cart::add([
                'id' => $id,
                'name' => $produk->nama,
                'price' => $produk->harga,
                'quantity' => 1,
                'attributes' => ['berat' => $produk->berat],
            ]);
        } else {
            $qty_now = $cek->quantity + 1;
            \Cart::update($id, ['quantity' => ['relative' => false, 'value' => $qty_now]]);
        }

        return redirect()->back()->with('status', 'Data berhasil disimpan kedalam keranjang');
    }

    public function detail()
    {
        $data = \Cart::getContent();
        $totalQuantity = \Cart::getTotalQuantity();
        $totalHarga = \Cart::getSubTotal();
        $provinsi = $this->getProvinsi();
        $alamat = Alamat::first();
        $kota_asal = $alamat->kota;
        return view('beranda.cart', compact('data', 'totalQuantity', 'totalHarga', 'provinsi', 'kota_asal'));
    }

    public function getOngkir($asal, $tujuan, $kurir, $berat)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "origin=$asal&destination=$tujuan&weight=$berat&courier=$kurir",
            CURLOPT_HTTPHEADER => array(
                "content-type: application/x-www-form-urlencoded",
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

    public function hapus($id)
    {
        \Cart::remove($id);
        return redirect()->back();
    }
}
