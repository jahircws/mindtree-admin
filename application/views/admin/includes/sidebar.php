<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="<?= base_url('masteradmin/dashboard'); ?>"> <img alt="image" src="<?= base_url(); ?>assets/images/mindtreeinc.png" class="header-logo" />
      </a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Main</li>
      <li class="dropdown active">
        <a href="<?= base_url('masteradmin/dashboard'); ?>" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
      </li>
      <li class='menu-header'>Common</a></li>
      <li><a class="nav-link" href="<?= base_url('masteradmin/states'); ?>">States</a></li>
      <li><a class="nav-link" href="<?= base_url('masteradmin/districts'); ?>">Districts</a></li>
      <li class="menu-header">Manage LMS</li>

      <li><a class="nav-link" href="<?= base_url('masteradmin/coupons'); ?>">Coupons</a></li>
      <li><a class="nav-link" href="<?= base_url('masteradmin/candidates'); ?>">Candidates</a></li>
      <!-- <li><a class="nav-link" href="<?php // base_url('masteradmin/subjects'); ?>">Subjects</a></li> -->
      <li><a class="nav-link" href="<?= base_url('courseadmin/course_categories'); ?>"><i data-feather="anchor"></i><span> Course Category</span></a></li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="monitor"></i><span>Short Courses</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="<?= base_url('courseadmin/short_courses_add'); ?>">Add</a></li>
          <li><a class="nav-link" href="<?= base_url('courseadmin/short_courses_list'); ?>">List</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="monitor"></i><span>Main Courses</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="<?= base_url('courseadmin/main_courses_add'); ?>">Add</a></li>
          <li><a class="nav-link" href="<?= base_url('courseadmin/main_courses_list'); ?>">List</a></li>
        </ul>
      </li>
      <!-- <li><a class="nav-link" href="<?php // base_url('courseadmin/course_enquiries'); ?>"><i data-feather="anchor"></i><span> Enquiries</span></a></li> -->
      
    </ul>
  </aside>
</div>