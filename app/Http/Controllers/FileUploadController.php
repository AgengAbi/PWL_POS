<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    //
    public function fileUpload()
    {
        return view('file-upload');
    }

    public function prosesFileUpload(Request $request)
    {
        $request->validate([
            'berkas' => 'required|file|image|max:5000',
            'nama_berkas' => 'required',
        ]);
        $extFile = $request->berkas->extension();
        $namaFile = $request->nama_berkas . '.' . $extFile;

        $path = $request->berkas->storeAs('gambar', $namaFile);
        $path = str_replace("\\", "//", $path);
        $pathBaru = asset('storage/gambar/' . $namaFile);
        echo "Gambar berhasil di upload ke <a href='$pathBaru'>$path</a><br><br>";

        echo "Tampilan gambar:<br>";
        echo "<img src='$pathBaru' alt='Gambar yang diunggah' style='max-width: 50%; height: auto;'>";

        // percobaan js
        // $request->validate(['berkas' => 'required|file|image|max:5000',]);
        // $extFile = $request->berkas->getClientOriginalName();
        // $namaFile = 'web-' . time() . '.' . $extFile;

        // $path = $request->berkas->storeAs('gambar', $namaFile);
        // $path = str_replace("\\", "//", $path);
        // echo "Variable path berisi: $path <br>";

        // $pathBaru = asset('storage/gambar/' . $namaFile);
        // echo "proses upload berhasil, data disimpan pada: $path";
        // echo "<br>";
        // echo "Tampilan link:<a href='$pathBaru'>$pathBaru</a>";

        // echo $request->berkas->getClientOriginalName() . " lolos validasi";

        // dump($request->berkas);
        // return "Pemrosesan file upload di sini";

        // if ($request->hasFile('berkas')) {
        //     echo "path(): " . $request->berkas->path();
        //     echo "<br>";
        //     echo "extension(): " . $request->berkas->extension();
        //     echo "<br>";
        //     echo "getClientOriginalExtension(): " . $request->berkas->getClientOriginalExtension();
        //     echo "<br>";
        //     echo "getMimeType(): " . $request->berkas->getMimeType();
        //     echo "<br>";
        //     echo "getClientOriginalName(): " . $request->berkas->getClientOriginalName();
        //     echo "<br>";
        //     echo "getSize(): " . $request->berkas->getClientOriginalName();
        // } else {
        //     echo "Tidak ada berkas yang upload";
        // }
    }
}
