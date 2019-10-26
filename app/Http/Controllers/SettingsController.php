<?php

namespace App\Http\Controllers;

use App\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SettingsController extends Controller
{
    public function BankListv2()
    {
        $datas = Bank::where('is_active', [1,0])->orderBy('id', 'desc')
            ->get(['id','name', 'is_active','email','location']);
        return $datas;

        return Datatables::of($datas)
            ->addColumn('action', function ($datas) use ($mode) {
                if ($mode) {
                    $url = "ConfirmDelete('" . $datas->id . "')";
                    return '<a href="/settings/edit-park-info/' . $datas->id .
                        '" class="btn btn-xs btn-success"><i class="fa fa-folder-open-o"></i> Open</a>'
                        . ' <a href="javascript:void(0)" ' .
                        " class='btn btn-xs btn-danger' onclick=$url><i class='fa fa-times'></i></a>";
                }
            })
            ->editColumn('is_active', function ($datas) {
                if ($datas->is_active == 1) {
                    $class = 'text-success';
                    $status = 'Active';
                } else {
                    $class = 'text-danger';
                    $status = 'Inactive';
                }
                return '<span class="' . $class . '"><b>' . $status . '</b></span>';
            })
            ->rawColumns(['is_active','action'])
            ->make(true);
    }

    public function storeBankv2(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required',
            'location' => 'required',
            'email' => 'required|email',
            'phone' => 'required|Max:50|regex:/[0-9+,-]$/',
        ]);

        try {
            $insert = Bank::create(
                array(
                    'name' => $request->get('name'),
                    'bank_code' => $request->get('code'),
                    'location' => $request->get('location'),
                    'email' => $request->get('email'),
                    'phone' => $request->get('phone'),
                    'address' => $request->get('address'),
                    'website' => $request->get('website'),
                    'is_active' => 1
                ));
            return response()->json(['success'=>'Done!']);

            Session::flash('success', 'Data is stored successfully!');
            return redirect('/settings/edit-bank/' . $insert->id);
        } catch (\Exception $e) {
            dd($e->getMessage());
            Session::flash('error', 'Sorry! Somthing Wrong.');
            return Redirect::back()->withInput();
        }
    }

    public function editBankv2($bank_id) {
        $data = Bank::where('id', $bank_id)->first();
        return $data;
    }

    public function updateBankv2($bank_id, Request $request) {
        try{
            Bank::where('id', $bank_id)->update([
                'name' => $request->get('name'),
                'bank_code' => $request->get('bank_code'),
                'location' => $request->get('location'),
                'email' => $request->get('email'),
                'phone' => $request->get('phone'),
                'address' => $request->get('address'),
                'website' => $request->get('website'),
                'is_active' => $request->get('is_active')
            ]);
            return response()->json(['status'=>'true']);
        } catch (\Exception $e) {
            return response()->json(['status'=>'false']);
        }
    }

    public function deleteBank($bank_id, Request $request){
        $bank = Bank::find($bank_id);
        $bank->delete();
        Session::flash('success', 'Data is Delete successfully!');
        return redirect('/settings/bank-list-v2');
    }
}
