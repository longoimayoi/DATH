
$(document).ready(function(){

        $('#formcttk').validate({
        rules:{
                    TenDangNhap:{
                        required:true,minlength:8,
                    },
                    SDT:{
                      maxlength:10,minlength:10,
                    },
                    password:{
                        required:true,minlength:8,
                    },
                    confirm:{
                        required:true,minlength:8,equalTo:'#password',
                    },
                },
               messages:{
                    TenDangNhap:{
                        required:'Mời bạn nhập dô đây',minlength:'Độ dài lớn hơn 8 ký tự',
                    },
                    SDT:{
                      maxlength:'Không được lớn hơn 10 ký tự',minlength:'Không được nhỏ hơn 10 ký tự',
                    },
                    password:{
                        required:'Mời bạn nhập dô đây',minlength:'Độ dài lớn hơn 8 ký tự',
                    },
                    confirm:{
                        required:'Mời bạn nhập dô đây',minlength:'Độ dài lớn hơn 8 ký tự',equalTo:'Mật khẩu không giống nhau',
                    },
                }
         });
         $("#TenDangNhap").keyup(function(){
          var TenDangNhap=$('#TenDangNhap').val();
          $.post("checkuser.php",{'TenDangNhap':TenDangNhap},function(data){
            $("#validate-user").html(data);
          });
        });
         $('#checkchangepassword').change(function(){
               $('#checkpass').removeClass('check');
              if ($(this).is(':checked')) 
              {
                $('#checkpass').removeClass('check');
                  $('.password').removeAttr('disabled');
              }
              else
              {
                 $('#checkpass').addClass('check');
                  $('.password').attr('disabled','');

              }
          });
         $('#checkvohieuhoa').change(function(){
               $('#checkvohieu').removeClass('check');
              if ($(this).is(':checked')) 
              {
                $('#checkvohieu').removeClass('check');
                  $('.vohieu').removeAttr('disabled');
              }
              else
              {
                 $('#checkvohieu').addClass('check');
                  $('.vohieu').attr('disabled','');

              }
          });
         $('#checkmokhoa').change(function(){
               $('#checkmo').removeClass('check');
              if ($(this).is(':checked')) 
              {
                $('#checkmo').removeClass('check');
                  $('.mokhoa').removeAttr('disabled');
              }
              else
              {
                 $('#checkmo').addClass('check');
                  $('.mokhoa').attr('disabled','');

              }
          });
         $('#checkedit').change(function(){
             
              if ($(this).is(':checked')) 
              {
                  $('#show').removeClass('hidden');
                  $('.edit').removeAttr('disabled');
              }
              else
              {
                
                $('#show').addClass('hidden');
                  $('.edit').attr('disabled','');

              }
          });
       /*  $('#formdk').validate({
      rules:{
                  TenDangNhap:{
                      required:true,minlength:8,email:true,
                  },
                  SDT:{
                    maxlength:10,minlength:10,
                  },
                  password:{
                      required:true,minlength:8,
                  },
                  confirm:{
                      required:true,minlength:8,equalTo:'#password',
                  },
              },
              messages:{
                  TenDangNhap:{
                      required:'Mời bạn nhập dô đây',minlength:'Độ dài lớn hơn 8 ký tự',email:'Xin nhập đúng định dạng email',
                  },
                  SDT:{
                    maxlength:'Không được lớn hơn 10 ký tự',minlength:'Không được nhỏ hơn 10 ký tự',
                  },
                  password:{
                      required:'Mời bạn nhập dô đây',minlength:'Độ dài lớn hơn 8 ký tự',
                  },
                  confirm:{
                      required:'Mời bạn nhập dô đây',minlength:'Độ dài lớn hơn 8 ký tự',equalTo:'Mật khẩu không giống nhau',
                  },
              }
       });*/
      
    });
