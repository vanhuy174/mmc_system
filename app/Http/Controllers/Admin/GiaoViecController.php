<?php

namespace App\Http\Controllers\Admin;
use App\mmc_employee;
use App\mmc_congviec;
use App\mmc_department;
// use App\mmc_major;
use Auth;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GiaoViecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $keyword = $request->get('search');
        $perPage = 5;
        $id = Auth::user()->mmc_employeeid;
        //dd(mmc_congviec::distinct()->get('mmc_cv'));
        if (!empty($keyword)) {
           
            $nguoinhan = mmc_employee::where('mmc_name', 'LIKE', "%$keyword%")->get();
            $ma = $nguoinhan[0]->mmc_employeeid;
            $danhsach = mmc_congviec::where('mmc_nguoinhan',$ma)->where('mmc_nguoigui', $id)->latest()->paginate($perPage);
        } else {
            $danhsach = mmc_congviec::where('mmc_nguoigui', $id)->latest()->paginate($perPage);
        }
        return view('admin.giaoviec.danhsach',compact('danhsach'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ids  = DB::table('mmc_congviecs')->max('id');
        $cvc = "CV_".$ids;

        $employee=mmc_employee::select('mmc_employeeid','mmc_name','mmc_deptid')->get();
        $department = mmc_department::select('mmc_deptid','mmc_deptname')->get();
        //$major = mmc_major::select('mmc_majorid','mmc_majorname')->pluck('mmc_majorname','mmc_majorid');
        return view("admin.giaoviec.them",compact('employee','department','cvc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arr = $request->mmc_nguoinhan;
        foreach($arr as $item){
            $congviec = new mmc_congviec;
            $congviec ->mmc_nguoinhan = $item;
            $congviec ->mmc_nguoigui = Auth::user()->mmc_employeeid;
            $congviec ->mmc_batdau = $request->mmc_batdau;
            $congviec ->mmc_ketthuc = $request->mmc_ketthuc;
            $congviec ->mmc_tieude = $request->mmc_tieude;
            $congviec ->mmc_noidung = $request->mmc_noidung;
            $congviec ->mmc_ghichu = $request->mmc_ghichu;
            $congviec ->mmc_trangthai = 1;
            $congviec ->mmc_cv = $request->mmc_cv;

            $congviec ->save();
            
        }
        return redirect()->route('giaoviec.index')->with('thongbao','đã giao công việc');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $xem = mmc_congviec::find($id);
        return view('admin.giaoviec.xem',compact('xem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sua = mmc_congviec::find($id);
        // dd($sua ->mmc_cv);
        return view('admin.giaoviec.sua',compact('sua'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $congviec =  mmc_congviec::find($id);
        $congviec ->mmc_batdau = $request->mmc_batdau;
        $congviec ->mmc_ketthuc = $request->mmc_ketthuc;
        $congviec ->mmc_tieude = $request->mmc_tieude;
        $congviec ->mmc_noidung = $request->mmc_noidung;
        $congviec ->mmc_ghichu = $request->mmc_ghichu;

        $congviec ->update();
        return redirect()->route('giaoviec.index')->with('thongbao','đã cập nhật công việc');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        mmc_congviec::destroy($id);
        return redirect()->route('giaoviec.index')->with('thongbao','xóa công việc đã giao');
    }

    public function getdanhgia($id){
        $danhgia =  mmc_congviec::find($id);
        return view('admin.giaoviec.danhgia',compact('danhgia'));
    }

    public function postdanhgia(Request $request, $id){
        $danhgia =  mmc_congviec::find($id);
        $danhgia ->mmc_ketqua = $request->mmc_ketqua;
        $danhgia ->mmc_nhanxet = $request->mmc_nhanxet;
        $danhgia->save();

        return redirect()->route('giaoviec.index')->with('thongbao','đánh gia công việc hoàn thành');     

    }
}
