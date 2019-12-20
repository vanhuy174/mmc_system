$(document).ready(function(){
    // Get value on button click and show alert
    $("#inputGV").click(function(){

        //lấy url img
        var filename = $('#avatar').attr('src');
        $("#mmc_avatar1").attr('src',filename);
        
        //Họ và tên
        var mmc_name = $("#mmc_name").val();
        $("#mmc_name1").text(mmc_name);
        $("#mmc_name11").text(mmc_name);
        //Mã giảng viên
        var mmc_employeeid = $("#mmc_employeeid").val();
        $("#mmc_employeeid1").text(mmc_employeeid);
        $("#mmc_employeeid11").text(mmc_employeeid);

        //Tên bộ môn
        var mmc_deptname = $("#mmc_deptid option:selected").text();
        $("#mmc_deptname").text(mmc_deptname);
        
        //Chức vụ hiện tại
        var mmc_position = $("#mmc_position option:selected").text();
        $("#mmc_position1").text(mmc_position);

        //Ngày tháng và năm sinh
        var mmc_dateofbirth = $("#mmc_dateofbirth").val();
        $("#mmc_dateofbirth1").text(mmc_dateofbirth);
        //Giới tính
        var radio1 = $("#radio1").val();
        var check1 = $("#radio1").prop("checked");
        
        if( (radio1==0)&&(check1 ==true) ){
            $("#mmc_gender1").text("Nam");
        }else{
            $("#mmc_gender1").text("Nữ");
        }
        
        //Số chứng minh nhân dân
        var mmc_personalid = $("#mmc_personalid").val();
        $("#mmc_personalid1").text(mmc_personalid);
        //Ngày cấp
        var mmc_dateofpid = $("#mmc_dateofpid").val();
        $("#mmc_dateofpid1").text(mmc_dateofpid);
        //Số bảo hiểm xã hội
        var mmc_socialinsuranceid = $("#mmc_socialinsuranceid").val();
        $("#mmc_socialinsuranceid1").text(mmc_socialinsuranceid);
        //Số điện thoại
        var mmc_phone = $("#mmc_phone").val();
        $("#mmc_phone1").text(mmc_phone);
        $("#mmc_phone11").text(mmc_phone);
        //Email
        var email = $("#email").val();
        $("#email1").text(email);
        $("#email11").text(email);
        //Dân tộc
        var mmc_religion = $("#mmc_religion").val();
        $("#mmc_religion1").text(mmc_religion);
        //Tôn giáo
        var mmc_ethnic = $("#mmc_ethnic").val();
        $("#mmc_ethnic1").text(mmc_ethnic);
        //Nơi Sinh
        var mmc_placeofbirth = $("#mmc_placeofbirth").val();
        $("#mmc_placeofbirth1").text(mmc_placeofbirth);
        //Quê quán
        var mmc_hometown = $("#mmc_hometown").val();
        $("#mmc_hometown1").text(mmc_hometown);
        //Hộ khẩu thường trú
        var mmc_address = $("#mmc_address").val();
        $("#mmc_address1").text(mmc_address);
        //Ngày tuyển dụng
        var mmc_dateofrecruit = $("#mmc_dateofrecruit").val();
        $("#mmc_dateofrecruit1").text(mmc_dateofrecruit);
        //Chức vụ hiện tại
        var mmc_position = $("#mmc_position").val();
        $("#mmc_position1").text(mmc_position);
        //Công việc chính được giao
        var mmc_maintask = $("#mmc_maintask").val();
        $("#mmc_maintask1").text(mmc_maintask);
        //Ngạch công chức
        var mmc_nameofjob = $("#mmc_nameofjob").val();
        $("#mmc_nameofjob1").text(mmc_nameofjob);
        //Mã ngạch
        var mmc_codeofjob = $("#mmc_codeofjob").val();
        $("#mmc_codeofjob1").text(mmc_codeofjob);
        //Bậc lương
        var mmc_salarylevel = $("#mmc_salarylevel").val();
        $("#mmc_salarylevel1").text(mmc_salarylevel);
        //Hệ số
        var mmc_salaryratio = $("#mmc_salaryratio").val();
        $("#mmc_salaryratio1").text(mmc_salaryratio);
        //Phụ cấp chức vụ
        var mmc_salaryposition = $("#mmc_salaryposition").val();
        $("#mmc_salaryposition1").text(mmc_salaryposition);
        //Phụ cấp khác
        var mmc_salaryother = $("#mmc_salaryother").val();
        $("#mmc_salaryother1").text(mmc_salaryother);
        //Trình độ chuyên môn cao nhất
        var mmc_degree = $("#mmc_degree").val();
        $("#mmc_degree1").text(mmc_degree);
        //Ngoại ngữ
        var mmc_language = $("#mmc_language").val();
        $("#mmc_language1").text(mmc_language);
        //Tin học
        var mmc_itlevel = $("#mmc_itlevel").val();
        $("#mmc_itlevel1").text(mmc_itlevel);
        //Lý luận chính trị
        var mmc_politiclevel = $("#mmc_politiclevel").val();
        $("#mmc_politiclevel1").text(mmc_politiclevel);
        //Quản lý nhà nước
        var mmc_managementlevel = $("#mmc_managementlevel").val();
        $("#mmc_managementlevel1").text(mmc_managementlevel);
        //Ngày vào Đảng Cộng sản Việt Nam
        var mmc_partydate = $("#mmc_partydate").val();
        $("#mmc_partydate1").text(mmc_partydate);
        //Ngày chính thức
        var mmc_partydateprimary = $("#mmc_partydateprimary").val();
        $("#mmc_partydateprimary1").text(mmc_partydateprimary);
        //Khen thưởng
        var mmc_reward = $("#mmc_reward").val();
        $("#mmc_reward1").text(mmc_reward);
        //Kỷ luật
        var mmc_discipline = $("#mmc_discipline").val();
        $("#mmc_discipline1").text(mmc_discipline);
        //Tình trạng sức khoẻ
        var mmc_heathlevel = $("#mmc_heathlevel").val();
        $("#mmc_heathlevel1").text(mmc_heathlevel);
        //Nhóm máu
        var mmc_bloodgroup = $("#mmc_bloodgroup").val();
        $("#mmc_bloodgroup1").text(mmc_bloodgroup);
        //Chiều cao
        var mmc_tall = $("#mmc_tall").val();
        $("#mmc_tall1").text(mmc_tall);
        //Cân nặng
        var mmc_weight = $("#mmc_weight").val();
        $("#mmc_weight1").text(mmc_weight);

    });
});