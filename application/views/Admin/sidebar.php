<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $nm_user; ?></p>
          
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
      <?php	
        $mymenu = new mymenu;
        $mymenu->new_header('01','MENU'); 
        
        $mymenu->new_menu('1','Admin','')
                              ->add_righticon('fa fa-dashboard')
                              ->add_lefticon('fa fa-angle-left pull-right','')       
                              ->setheader('01');
        if(in_array('1', $menu_active)){ $mymenu->setactive(); }
        $mymenu->addmenutomainmenu();
                 $mymenu->new_menu('11','Login List',base_url().'Admin/user_log')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('11', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('1');
                 $mymenu->new_menu('12','Summary Executive',base_url().'Admin/sum_exec')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('12', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('1');
                 $mymenu->new_menu('13','List File',base_url().'Admin/list_file')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('13', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('1');

        $mymenu->new_menu('2','Skripsi','')
                              ->add_righticon('fa fa-folder')
                              ->add_lefticon('fa fa-angle-left pull-right','')       
                              ->setheader('01');
        if(in_array('2', $menu_active)){ $mymenu->setactive(); }
        $mymenu->addmenutomainmenu();          
                  $mymenu->new_menu('21','Bimbingan',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('21', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('2');
                 $mymenu->new_menu('22','Sidang',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('22', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('2');
        $mymenu->new_menu('3','Kuliah','')
                              ->add_righticon('fa fa-calendar')
                              ->add_lefticon('fa fa-angle-left pull-right','')       
                              ->setheader('01');
        if(in_array('3', $menu_active)){ $mymenu->setactive(); }
        $mymenu->addmenutomainmenu();
                 $mymenu->new_menu('31','Sebaran Matakuliah',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('31', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('3');
                 $mymenu->new_menu('32','Riwayat Sebaran Matakuliah',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('32', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('3');
                 $mymenu->new_menu('33','Jadwal Kuliah',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('33', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('3');
                 $mymenu->new_menu('34','Riwayat Jadwal Kuliah',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('34', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('3');
                 $mymenu->new_menu('35','Cetak Perangkat Kuliah',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('35', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('3');
                 $mymenu->new_menu('36','Rekap BAP dan DHMD',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('36', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('3');
        $mymenu->new_menu('4','Ujian','')
                              ->add_righticon('fa fa-calendar-plus-o')
                              ->add_lefticon('fa fa-angle-left pull-right','')       
                              ->setheader('01');
        if(in_array('4', $menu_active)){ $mymenu->setactive(); }
        $mymenu->addmenutomainmenu();
                 $mymenu->new_menu('41','Cetak Perangkat Ujian',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('41', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('4');
                 $mymenu->new_menu('42','Cetak Kartu Ujian',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('42', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('4');
        $mymenu->new_menu('5','Nilai','')
                              ->add_righticon('fa fa-edit')
                              ->add_lefticon('fa fa-angle-left pull-right','')       
                              ->setheader('01');
        if(in_array('5', $menu_active)){ $mymenu->setactive(); }
        $mymenu->addmenutomainmenu();
                 $mymenu->new_menu('51','Publish Nilai',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('51', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('5');
                 $mymenu->new_menu('52','Edit Publish Nilai',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('52', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('5');
        $mymenu->new_menu('6','EPSBED','')
                              ->add_righticon('fa fa-table')
                              ->add_lefticon('fa fa-angle-left pull-right','')       
                              ->setheader('01');
        if(in_array('6', $menu_active)){ $mymenu->setactive(); }
        $mymenu->addmenutomainmenu();
                 $mymenu->new_menu('61','Master Mahasiswa',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('61', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('6');
                 $mymenu->new_menu('62','Aktivitas Dosen',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('62', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('6');
                 $mymenu->new_menu('63','Nilai Mahasiswa',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('63', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('6');
                 $mymenu->new_menu('64','Nilai Mahasiswa Pindahan',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('64', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('6');
                         $mymenu->new_menu('65','Kurikulum',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('65', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('6');
                  $mymenu->new_menu('66','Aktivitas Mahasiswa',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('66', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('6');
                 $mymenu->new_menu('67','Mahasiswa Lulus/Cuti/Non-Aktif',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('67', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('6');
                 $mymenu->new_menu('68','Data Forlap',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('68', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('6');
        $mymenu->new_menu('7','Mahasiswa','')
                              ->add_righticon('fa fa-th')
                              ->add_lefticon('fa fa-angle-left pull-right','')       
                              ->setheader('01');
        if(in_array('7', $menu_active)){ $mymenu->setactive(); }
        $mymenu->addmenutomainmenu();
                 $mymenu->new_menu('71','Summary',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('71', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('7');
                 $mymenu->new_menu('72','Data Mahasiswa',base_url().'Admin/dt_mhs')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('72', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('7');
                 $mymenu->new_menu('73','Nilai Konversi',base_url().'Admin/dt_konversi')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('73', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('7');
                 $mymenu->new_menu('74','Status Mahasiswa',base_url().'Admin/dt_stat_mhs')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('74', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('7');
                 $mymenu->new_menu('75','Hasil Studi',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('75', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('7');
                 $mymenu->new_menu('76','Transkrip Nilai',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('76', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('7');
                  $mymenu->new_menu('77','Kartu Rencana Studi (KRS)',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('77', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('7');
                 $mymenu->new_menu('78','Riwayat Kartu Rencana Studi (KRS)',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('78', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('7');
        $mymenu->new_menu('8','Dosen','')
                              ->add_righticon('fa fa-graduation-cap')
                              ->add_lefticon('fa fa-angle-left pull-right','')       
                              ->setheader('01');
        if(in_array('8', $menu_active)){ $mymenu->setactive(); }
        $mymenu->addmenutomainmenu();
                 $mymenu->new_menu('81','Data Dosen',base_url().'Admin/dt_dosen')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('81', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('8');
                 $mymenu->new_menu('82','Riwayat Mengajar',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('82', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('8');
                 $mymenu->new_menu('83','Nilai Belum Masuk',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('83', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('8');
                 $mymenu->new_menu('84','Kesediaan Mengajar',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('84', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('8');
                 $mymenu->new_menu('85','Riwayat Kesediaan Mengajar',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('85', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('8');
                 $mymenu->new_menu('86','Kuosioner',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('86', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('8');
        $mymenu->new_menu('9','Kurikulum','')
                              ->add_righticon('fa fa-files-o')
                              ->add_lefticon('fa fa-angle-left pull-right','')       
                              ->setheader('01');
        if(in_array('9', $menu_active)){ $mymenu->setactive(); }
        $mymenu->addmenutomainmenu();
                 $mymenu->new_menu('91','Matakuliah',base_url().'Admin/dt_mtk')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('91', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('9');
        
        $mymenu->new_menu('10','Keuangan','')
                              ->add_righticon('fa fa-dollar')
                              ->add_lefticon('fa fa-angle-left pull-right','')       
                              ->setheader('01');
        if(in_array('10', $menu_active)){ $mymenu->setactive(); }
        $mymenu->addmenutomainmenu();
                 $mymenu->new_menu('101','Kewajiban Perangkatan',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('101', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('10');
                 $mymenu->new_menu('102','Kewajiban Permahasiswa',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('102', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('10');
                 $mymenu->new_menu('103','Transaksi Keuangan Mahasiswa',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('103', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('10');
                 $mymenu->new_menu('104','Total Trans. Keu. Mahasiswa',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('104', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('10');
                 $mymenu->new_menu('105','Rekap Trans. Keu. Mahasiswa',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('105', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('10');
                 $mymenu->new_menu('106','Ajuan Keuangan',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('106', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('10');
                  $mymenu->new_menu('107','Laporan Keuangan',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('107', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('10');
        $mymenu->new_menu('1101','Menu User','')
                              ->add_righticon('fa fa-user')
                              ->add_lefticon('fa fa-angle-left pull-right','')       
                              ->setheader('01');
        if(in_array('1101', $menu_active)){ $mymenu->setactive(); }
        $mymenu->addmenutomainmenu();  
        $mymenu->new_menu('111','User Profile',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('111', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('1101');
                 $mymenu->new_menu('112','Ganti Password',base_url().'Admin/#')
                                  ->add_righticon('fa fa-circle-o')
                                  ->setheader('01');                                  
        if(in_array('112', $menu_active)){ $mymenu->setactive(); }
                                  $mymenu->addmenuassubmenu('1101');


        echo $mymenu->display();   

      ?>  
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>