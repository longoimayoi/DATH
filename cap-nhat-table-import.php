<style>
  .callback{
    font-size: 16px;
    padding: 5px 40px;
    position: relative;
    background-color: #ff0000d6;
    color: #FFF;
    border: none;
    border-radius: 0px;
    outline: none;
    float: none;
    cursor: pointer;
    border-radius: 25px;
    box-shadow: 0px 14px 80px rgba(34, 35, 58, 0.2);
    overflow: hidden;
    opacity: 0.9;
}
</style>
<?php include 'header.php';
  ob_start();
include('connect/myconnect.php');?>
<body>  
  <?php include 'leftpanel.php' ; ?>
  <div class="container">  
    <br />
    <div class="table-responsive">  
      <h3 align="center">Cập nhật chi tiết</h3><br />
    
    <form method="post" id="update_form">
        <div align="left">
          <input type="button" id="savedl" onclick="window.location.href='chitiet-phieu-yeu-cau-trangbi.php?MaHD=<?php echo $_GET['MaHD']?>'" value="Xong"/>

     <!--    	<a class="btn btn-success" href="save-all-import.php?ngaylap=<?php// echo $_GET['ngaylap']  ?>">Gửi phiếu</a> -->
     <button type="submit" id = "submit">Lưu dữ liệu</button>
       <button type="reset" id = "delete">Xóa dữ liệu</button>
         <!--  <input type="submit" name="multiple_update" id="multiple_update" class="btn btn-info" value="Lưu dữ liệu" /> -->
          <a class="callback" style="float:right;" onclick="window.location.href='chitiet-phieu-yeu-cau-trangbi.php?MaHD=<?php echo $_GET['MaHD']?>'">Trở lại</a>
        </div>
      
        <br />
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <th></th>
                  <th width="20%">Tên Vật tư</th>
                  <th width="10%">Đơn vị tính</th>
                  <th width="10%">Số lượng</th>
                  <th width="20%">Thông số KT</th>
                  <th width="20%">Xuất xứ</th>
                  <th width="20%">Ghi chú</th>
                </thead> 
                <tbody>
                </tbody>
              </table>
            </div>
            
          </form>
      </div>
  </div>
  <?php include 'scriptindex.php'; ?>
</body>  

</html>
<?php ob_flush(); ?>
<script >

      (function($){  
        function fetch_data()
        {

          $.ajax({
            url:"yeucautrangbi.php?MaHD=<?php echo $_GET['MaHD'] ?>",
            method:"GET",
            dataType:"json",
            success:function(data)
            {
              var html = '';
              for(var count = 0; count < data.length; count++)
              {
                html += '<tr>';
                html += '<td><input type="checkbox" STT="'+data[count].STT+'"data-TenVatTu="'+data[count].TenVatTu+'" data-DVT="'+data[count].DVT+'" data-SL="'+data[count].SL+'" data-ThongSoKT="'+data[count].ThongSoKT+'" data-XuatXu="'+data[count].XuatXu+'"data-GhiChu="'+data[count].GhiChu+'" class="check_box"  /></td>';
                html += '<td>'+data[count].TenVatTu+'</td>';
                html += '<td>'+data[count].DVT+'</td>';
                html += '<td>'+data[count].SL+'</td>';
                html += '<td>'+data[count].ThongSoKT+'</td>';
                html += '<td>'+data[count].XuatXu+'</td>';
                html += '<td>'+data[count].GhiChu+'</td></tr>';

              }
              $('tbody').html(html); 
            }
          });
        }

        fetch_data();
        $(document).on('click', '.check_box', function(){

          var html = '';

          if(this.checked)
          {
            html = '<td><input type="checkbox" STT="'+$(this).attr('stt')+'" data-TenVatTu="'+$(this).data('tenvattu')+'" data-DVT="'+$(this).data('dvt')+'" data-SL="'+$(this).data('sl')+'" data-ThongSoKT="'+$(this).data('thongsokt')+'" data-XuatXu="'+$(this).data('xuatxu')+'" data-GhiChu="'+$(this).data('ghichu')+'" class="check_box" checked /></td>';
            html += '<td><input type="text" name="TenVatTu[]" class="form-control" value="'+$(this).data("tenvattu")+'" /></td>';
            html += '<td><input type="text" name="DVT[]" class="form-control" value="'+$(this).data("dvt")+'" /></td>';
            html += '<td><input  type="text" name="SL[]" class="form-control" value="'+$(this).data("sl")+'" /></td>';
            html += '<td><input type="text" name="ThongSoKT[]" class="form-control" value="'+$(this).data("thongsokt")+'" /></td>';
            html += '<td><input  type="text" name="XuatXu[]" class="form-control" value="'+$(this).data("xuatxu")+'" /></td>';
            html += '<td><input type="text" name="GhiChu[]" class="form-control" value="'+$(this).data("ghichu")+'" /><input type="hidden" name="hidden_id[]" value="'+$(this).attr('stt')+'" /></td>';
          }
          else
          {
            html = '<td><input type="checkbox" STT="'+$(this).attr('stt')+'" data-TenVatTu="'+$(this).data('tenvattu')+'" data-DVT="'+$(this).data('dvt')+'" data-SL="'+$(this).data('sl')+'" data-ThongSoKT="'+$(this).data('thongsokt')+'" data-XuatXu="'+$(this).data('xuatxu')+'" data-GhiChu="'+$(this).data('ghichu')+'" class="check_box" /></td>';
            html += '<td>'+$(this).data('tenvattu')+'</td>';
            html += '<td>'+$(this).data('dvt')+'</td>';
            html += '<td>'+$(this).data('sl')+'</td>';
            html += '<td>'+$(this).data('thongsokt')+'</td>';
            html += '<td>'+$(this).data('xuatxu')+'</td>';
            html += '<td>'+$(this).data('ghichu')+'</td>';

          }
          $(this).closest('tr').html(html);

        })  ;
        $('#update_form').on('submit', function(event){
          if (confirm("Xác nhận lưu dữ liệu !"))
          {
            event.preventDefault();
            if($('.check_box:checked').length > 0)
            {
              $.ajax({
                url:"save-table-import.php",
                method:"POST",
                data:$(this).serialize(),
                success:function()
                {

                  alert('Cập nhật dữ liệu thành công !');
                  fetch_data();

                }
              })

            }
          }

        });
          $('#update_form').on('reset', function(event){
          
          if (confirm("Xác nhận xóa dữ liệu !"))
          {
            event.preventDefault();
            if($('.check_box:checked').length > 0)
            {
              $.ajax({
                url:"xoa-trong-phieu-import.php",
                method:"POST",
                data:$(this).serialize(),
                success:function()
                {

                  alert('Cập nhật dữ liệu thành công !');
                  fetch_data();

                }
              })

            }
          }

        });
      })(jQuery);  
    </script>
    <script>
     function goBack() {
      window.history.back();
    }
</script>