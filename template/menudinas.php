<header class="main-header">
            <!-- Logo -->
            <a href="index.php" class="logo">
               <!-- mini logo for sidebar mini 50x50 pixels -->
               <span class="logo-mini"><b>A</b>DN</span>
               <!-- logo for regular state and mobile devices -->
               <span class="logo-lg"><b>Admin</b>DINAS</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
               <!-- Sidebar toggle button-->
               <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
               <span class="sr-only">Toggle navigation</span>
               </a>
               <div class="navbar-custom-menu">
                  <ul class="nav navbar-nav">
                    
                     <!-- User Account: style can be found in dropdown.less -->
                     <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="../assets/img/user2-160x160.jpg" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo $_SESSION['nama_lengkap'];?></span>
                        </a>
                        <ul class="dropdown-menu">
                           <!-- User image -->
                           <li class="user-header">
                              <img src="../assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                              <p>
                                 <?php echo $_SESSION['nama_lengkap'];?> - Web Developer
                                 <small>Member since Nov. 2012</small>
                              </p>
                           </li>
                          
                           <!-- Menu Footer-->
                           <li class="user-footer">
                              <div class="pull-left">
                                 <a href="profil.php" class="btn btn-default btn-flat">Profile</a>
                              </div>
                              <div class="pull-right">
                                 <a href="cek_login.php?aksi=logout" class="btn btn-default btn-flat">Sign out</a>
                              </div>
                           </li>
                        </ul>
                     </li>
                     <!-- Control Sidebar Toggle Button -->
                     <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                     </li>
                  </ul>
               </div>
            </nav>
         </header>
         <!-- Left side column. contains the logo and sidebar -->
         <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
               <!-- Sidebar user panel -->
               <div class="user-panel">
                  <div class="pull-left image">
                     <img src="../assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                  </div>
                  <div class="pull-left info">
                     <p><?php echo $_SESSION['nama_lengkap'];?></p>
                     <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                  </div>
               </div>
               <!-- search form -->
               <form action="#" method="get" class="sidebar-form">
                  <div class="input-group">
                     <input type="text" name="q" class="form-control" placeholder="Search...">
                     <span class="input-group-btn">
                     <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                     </button>
                     </span>
                  </div>
               </form>
               <!-- /.search form -->
               <!-- sidebar menu: : style can be found in sidebar.less -->
               <ul class="sidebar-menu" data-widget="tree">
                  <li class="header">MAIN NAVIGATION</li>
                  <li>
                     <a href="index.php">
                     <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                     <span class="pull-right-container">                     
                     </span>
                     </a>
                  </li>                 
                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-laptop"></i>
                     <span>Data Sekolah</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="data_sekolah.php"><i class="fa fa-circle-o"></i> Data Sekolah</a></li>
                        <li><a href="data_guru.php"><i class="fa fa-circle-o"></i> Data Guru</a></li>
                     </ul>
                  </li>
                  <li class="treeview">
                     <a href="#">
                     <i class="fa fa-table"></i>
                     <span>Master Data</span>
                     <span class="pull-right-container">
                     <i class="fa fa-angle-left pull-right"></i>
                     </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="data_indikator_laporan.php"><i class="fa fa-circle-o"></i> Indikator Laporan</a></li>
                        <li><a href="data_subindikator_laporan.php"><i class="fa fa-circle-o"></i> Sub Indikator Laporan</a></li>
                         <li><a href="data_indikator_kinerja.php"><i class="fa fa-circle-o"></i> Indikator Kinerja</a></li>
                        <li><a href="data_pemeriksa.php"><i class="fa fa-circle-o"></i> Data Pemeriksa</a></li>
                     </ul>
                  </li>
                  <li>
                     <a href="laporan_bulanan.php">
                     <i class="fa fa-folder"></i> <span>Laporan Bulanan</span>
                     <span class="pull-right-container">                     
                     </span>
                     </a>
                  </li>  
                  <li>
                     <a href="kinerja_guru.php">
                     <i class="fa fa-envelope"></i> <span>Kinerja Guru</span>
                     <span class="pull-right-container">                     
                     </span>
                     </a>
                  </li>    
                  <li>
                     <a href="keluhan.php">
                     <i class="fa fa-th"></i> <span>Keluhan/ Pesan</span>
                     <span class="pull-right-container">
                     <small class="label pull-right bg-green">new</small>
                     </span>
                     </a>
                  </li>                   
               </ul>
            </section>
            <!-- /.sidebar -->
         </aside>
         <!-- Content Wrapper. Contains page content -->