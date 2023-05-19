<form method='POST' action='' style='margin-right:5px; margin-top:0px' class='pull-right'>
                  <div class="form-group">
                    <select name='bulan' style='padding:4px'>
                            <option value="">- Filter Bulan -</option>
                            <option value="01">Januari</option>
                            <option value="02">Februari</option>
                            <option value="03">Maret</option>
                            <option value="04">April</option>
                            <option value="05">Mei</option>
                            <option value="06">Juni</option>
                            <option value="07">Juli</option>
                            <option value="08">Agustus</option>
                            <option value="09">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                    </select>
                    <button id="search" name="search" style='margin-top:-4px' 
                    class="btn btn-info btn-sm">Lihat</button>
                  </div>
                  </form>







                  <?php
            $no = 1;
              if (isset($_POST ['filter'])){
                $dari_tgl = mysqli_real_escape_string($conn, $_POST['dari_tgl']);
                $sampai_tgl = mysqli_real_escape_string($conn, $_POST['sampai_tgl']);
                $data = mysqli_query($conn,"SELECT * FROM neraca WHERE tanggal BETWEEN 'dari_tgl' 
                AND 'sampai_tgl'");
              }else{
                $data = mysqli_query($conn,"SELECT * FROM neraca");
            }while
                ($tampil = mysqli_fetch_array($data))
              
?>