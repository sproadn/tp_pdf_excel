<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class TpController extends Controller
{
    public function userList() {
        $users = User::all();
        //return view('pdf', ['users' => $users]);
        $data = [
            "users" => $users
        ];

        //Generate pdf
        // La fonction static loadView de la classe Barryvdh\DomPDF\Facade\Pdf
        // fonctionne exactement comme la function view de Laravel
        // Elle prend en paramêtre la vue et la data si il y en a
        $pdf = Pdf::loadView('pdf', $data);
        $pdf->setPaper('A4', "landscape");

        //Afficher le PDf dans le navigateur
        return $pdf->stream();

        //Télécharger le PDF
        //return $pdf->download('user_list.pdf');
    }

    public function exportUserListToExcel() {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import(Request $request) {
        if ($request->isMethod('GET')) {
            return view('import');
        }

        try {
            //dd($request->file('file'));
            Excel::import(new UsersImport, $request->file('file'));
        } catch (\Throwable $th) {
            Log::error($th);
        }

    }
}
