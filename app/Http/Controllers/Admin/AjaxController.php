<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\item;
use App\mmc_class;
use App\mmc_department;
use App\mmc_education;
use App\mmc_employee;
use App\mmc_major;
use App\mmc_student;
use App\scienceemployee;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getEducation(Request $request)
    {
        $education=mmc_education::where('mmc_majorid','=',$request->id)->get();
        foreach ($education as $item)
        {
            echo "<option>".$item->mmc_course."</option>";
        }
    }
    public function getMission(Request $request)
    {
        $items=item::where('listitems_id','=',$request->id)->get();
        foreach ($items as $item)
        {
            echo "<option value='".$item->id."'>".$item->mmc_mission."</option>";
        }
    }
    public function getUpdate(Request $request)
    {
        $scienceemployee = scienceemployee::findOrFail($request->id);
        $scienceemployee['mmc_status']=1;
        $scienceemployee->update();
    }
    public function getMajor(Request $request)
    {
        $department=mmc_department::where('mmc_deptname','=',$request->name)->get('mmc_deptid');
        $major=mmc_major::where('mmc_deptid','=',$department[0]->mmc_deptid)->get();
        $i =1;
        echo "<h4 style='text-align: center'>".$request->name."</h4>";
        echo "Trưởng bộ môn : ".$this->getemployeetbm($department[0]->mmc_deptid)." <br>";
        echo "Phó bộ môn : ".$this->getemployeepbm($department[0]->mmc_deptid)." <br>";
        echo "Số giảng viên : ".$this->getsumemployee($department[0]->mmc_deptid)." <br>";
        echo "<table class='table'>";
        echo "<thead><tr><th>STT</th><th>Ngành</th><th>Số lớp</th></tr></thead>";
        foreach ($major as $item)
        {
            if($i==1)
            {
                echo "<tr>";
                echo "<td  style='border-top: none;'>".$i."</td>";
                echo "<td style='border-top: none;'>".$item->mmc_majorname."</td>";
                echo "<td style='border-top: none;'>".$this->getsumclass($item->mmc_majorid)."</td>";
                echo "</tr>";
            }
            else
            {
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td>".$item->mmc_majorname."</td>";
                echo "<td>".$this->getsumclass($item->mmc_majorid)."</td>";
                echo "</tr>";
            }
            $i++;
        }
        echo "</table>";
    }
    public function getCTDT(Request $request)
    {
        $majorid=mmc_major::where('mmc_majorname','=',$request->name)->value('mmc_majorid');
        $education=mmc_education::where('mmc_majorid','=',$majorid)->get();
        $i=1;
        echo "<h4 style='text-align: center'>".$request->name."</h4>";
        echo "<table class='table'>";
        echo "<thead><tr><th>STT</th><th>Khóa</th><th>Số tín chỉ</th></tr></thead>";
        foreach ($education as $item)
        {
            $url=route("educationprogram.show",$item->id);
            if($i==1)
            {
                echo "<tr>";
                echo "<td  style='border-top: none;'>".$i."</td>";
                echo "<td style='border-top: none;'><a href='{$url}' style='color:gray;'>".$item->mmc_course."</a></td>";
                echo "<td style='border-top: none;'>".$item->mmc_total."</td>";
                echo "</tr>";
            }
            else
            {
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td><a href='{$url}' style='color:gray;'>".$item->mmc_course."</a></td>";
                echo "<td>".$item->mmc_total."</td>";
                echo "</tr>";
            }
            $i++;
        }
        echo "</table>";
    }
    public function getClass(Request $request)
    {
        $classid=mmc_class::where('mmc_classname','=',$request->name)->get();
        $students=mmc_student::where('mmc_classid','=',$classid[0]->mmc_classid)->get();
        $i=1;
        $idgv=ClassController::getidemployee($classid[0]->mmc_headteacher);
        $url=route('giangvien.show',$idgv);
        echo "<h4 style='text-align: center'>".$request->name."</h4>";
        echo "Giáo viên chủ nhiệm : <a href='{$url}' style='color:gray;'>".ClassController::getemployee($classid[0]->mmc_headteacher)."</a><br>";
        echo "Số sinh viên : ".$this->getsumstudent($classid[0]->mmc_classid)."<br>";
        echo "<table class='table'>";
        echo "<thead><tr><th>STT</th><th>Mã sinh viên</th><th>Tên sinh viên</th></tr></thead>";
        foreach ($students as $item)
        {
            $urlsd=route("showStudent",$item->id);
            if($i==1)
            {
                echo "<tr>";
                echo "<td  style='border-top: none;'>".$i."</td>";
                echo "<td style='border-top: none;'><a href='{$urlsd}' style='color:gray;'>".$item->mmc_studentid."</a></td>";
                echo "<td style='border-top: none;'><a href='{$urlsd}' style='color:gray;'>".$item->mmc_fullname."</a></td>";
                echo "</tr>";
            }
            else
            {
                echo "<tr>";
                echo "<td>".$i."</td>";
                echo "<td><a href='{$urlsd}' style='color:gray;'>".$item->mmc_studentid."</a></td>";
                echo "<td><a href='{$urlsd}' style='color:gray;'>".$item->mmc_fullname."</a></td>";
                echo "</tr>";
            }
            $i++;
        }
        echo "</table>";
    }
    public function getsumclass($id)
    {
        return mmc_class::where('mmc_major','=',$id)->count();
    }
    public function getsumstudent($id)
    {
        return mmc_student::where('mmc_classid','=',$id)->count();
    }
    public function getsumemployee($id)
    {
        return mmc_employee::where('mmc_deptid','=',$id)->count();
    }
    public function getemployeetbm($id)
    {
        return mmc_employee::where('mmc_deptid','=',$id)->where('mmc_position','=','tbm')->value('mmc_name');
    }
    public function getemployeepbm($id)
    {
        return mmc_employee::where('mmc_deptid','=',$id)->where('mmc_position','=','pbm')->value('mmc_name');
    }
}
