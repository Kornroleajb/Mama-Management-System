

<nav class="navbar navbar-expand-lg bg-white sticky-top">
  <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">
            <i class="fas fa-home"></i>
            <span>HOME</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-current="page" href="index.php?option=stock&task=def">Purchase</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?option=PR&task=def">PR</a></li>
            <li><a class="dropdown-item" href="index.php?option=PO&task=def">PO</a></li>
            <li><a class="dropdown-item" href="index.php?option=receive_order&task=def&type=1">Recieve Purchase</a></li>
            <li><a class="dropdown-item" href="index.php?option=supplier_data&task=def">Supplier</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-current="page" href="index.php?option=stock&task=def">HR</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?option=employee&task=def">Employee</a></li>
            <li><a class="dropdown-item" href="index.php?option=in_out_working&task=def">Working</a></li>
            <li><a class="dropdown-item" href="index.php?option=leaved&task=def">Leave</a></li>
            <li><a class="dropdown-item" href="index.php?option=salary&task=def">Salary</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-current="page" href="index.php?option=stock&task=def">Sale</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?option=quotation&task=def">Quotation</a></li>
            <li><a class="dropdown-item" href="index.php?option=purchase_order&task=def">Purchase Order</a></li>
            <li><a class="dropdown-item" href="index.php?option=requisition&task=def&type=1">Requisition Sale</a></li>
            <li><a class="dropdown-item" href="index.php?option=delivery&task=def">Delivery</a></li>
            <li><a class="dropdown-item" href="index.php?option=receipt&task=def">Receipt</a></li>
            <li><a class="dropdown-item" href="index.php?option=customer_data&task=def">Customer</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-current="page" href="index.php?option=stock&task=def">WMS</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?option=location&task=def">Location</a></li>
            <li><a class="dropdown-item" href="index.php?option=inspection&task=def">Inspection</a></li>
            <li><a class="dropdown-item" href="index.php?option=receive_order&task=def&type=3">Recieve All</a></li>
            <li><a class="dropdown-item" href="index.php?option=requisition&task=def&type=3">Requisition All</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-current="page" href="index.php?option=stock&task=def">R & D</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?option=open_batch&task=def">Open Batch</a></li>
            <li><a class="dropdown-item" href="index.php?option=product&task=def">Product</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-current="page" href="index.php?option=stock&task=def">Production</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?option=production&task=def">Production</a></li>
            <li><a class="dropdown-item" href="index.php?option=production_lost&task=def">Lost</a></li>
            <li><a class="dropdown-item" href="index.php?option=production_result&task=def">Result</a></li>
            <li><a class="dropdown-item" href="index.php?option=receive_order&task=def&type=2">Recieve Production</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-current="page" href="index.php?option=stock&task=def">Back End</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?option=users&task=def">Users</a></li>
            <li><a class="dropdown-item" href="index.php?option=user_in_group&task=def">User In Group</a></li>
            <li><a class="dropdown-item" href="index.php?option=logs&task=def">Logs</a></li>
            <li><a class="dropdown-item" href="index.php?option=user_group&task=def">User Group</a></li>
            <li><a class="dropdown-item" href="index.php?option=application&task=def">Application</a></li>
            <li><a class="dropdown-item" href="index.php?option=access_control_list&task=def">Access</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-current="page" href="index.php?option=stock&task=def">Accounting</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="index.php?option=accOUNTING&task=def">Accounting</a></li>
            <li><a class="dropdown-item" href="index.php?option=accounting_type&task=def">Accounting_typ</a></li>
            <li><a class="dropdown-item" href="index.php?option=payment&task=def">Payment</a></li>
          </ul>
        </li>
        <?php 
          if(isset($_SESSION['uid']))
          {
          ?>
          <li class="nav-item ">
            <a class="nav-link" href="index.php?option=logs&task=logout">
            <i class='fas fa-sign-out-alt' style='font-size:24px'></i>
              <span>ออกสู่ระบบ</span>
            </a>
          </li>
          <?php 
          }
          else {
            ?>
            <li class="nav-item ">
            <a class="nav-link" href="index.php?option=logs&task=logs_form">
            <i class='fas fa-sign-in-alt' style='font-size:24px'></i>
              <span>เข้าสู่ระบบ</span>
            </a>
          </li>
            <?php
          }
          ?>
      </ul>
  </div>
</nav>